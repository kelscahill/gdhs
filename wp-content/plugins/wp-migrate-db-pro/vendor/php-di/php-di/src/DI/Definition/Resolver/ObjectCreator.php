<?php

namespace DeliciousBrains\WPMDB\Container\DI\Definition\Resolver;

use DeliciousBrains\WPMDB\Container\DI\Definition\Definition;
use DeliciousBrains\WPMDB\Container\DI\Definition\Exception\DefinitionException;
use DeliciousBrains\WPMDB\Container\DI\Definition\Helper\DefinitionHelper;
use DeliciousBrains\WPMDB\Container\DI\Definition\ObjectDefinition;
use DeliciousBrains\WPMDB\Container\DI\Definition\ObjectDefinition\PropertyInjection;
use DeliciousBrains\WPMDB\Container\DI\DependencyException;
use DeliciousBrains\WPMDB\Container\DI\Proxy\ProxyFactory;
use Exception;
use DeliciousBrains\WPMDB\Container\Interop\Container\Exception\NotFoundException;
use DeliciousBrains\WPMDB\Container\ProxyManager\Proxy\LazyLoadingInterface;
use ReflectionClass;
use ReflectionProperty;
/**
 * Create objects based on an object definition.
 *
 * @since 4.0
 * @author Matthieu Napoli <matthieu@mnapoli.fr>
 */
class ObjectCreator implements \DeliciousBrains\WPMDB\Container\DI\Definition\Resolver\DefinitionResolver
{
    /**
     * @var ProxyFactory
     */
    private $proxyFactory;
    /**
     * @var ParameterResolver
     */
    private $parameterResolver;
    /**
     * @var DefinitionResolver
     */
    private $definitionResolver;
    /**
     * @param DefinitionResolver $definitionResolver Used to resolve nested definitions.
     * @param ProxyFactory       $proxyFactory       Used to create proxies for lazy injections.
     */
    public function __construct(\DeliciousBrains\WPMDB\Container\DI\Definition\Resolver\DefinitionResolver $definitionResolver, \DeliciousBrains\WPMDB\Container\DI\Proxy\ProxyFactory $proxyFactory)
    {
        $this->definitionResolver = $definitionResolver;
        $this->proxyFactory = $proxyFactory;
        $this->parameterResolver = new \DeliciousBrains\WPMDB\Container\DI\Definition\Resolver\ParameterResolver($definitionResolver);
    }
    /**
     * Resolve a class definition to a value.
     *
     * This will create a new instance of the class using the injections points defined.
     *
     * @param ObjectDefinition $definition
     *
     * {@inheritdoc}
     */
    public function resolve(\DeliciousBrains\WPMDB\Container\DI\Definition\Definition $definition, array $parameters = [])
    {
        // Lazy?
        if ($definition->isLazy()) {
            return $this->createProxy($definition, $parameters);
        }
        return $this->createInstance($definition, $parameters);
    }
    /**
     * The definition is not resolvable if the class is not instantiable (interface or abstract)
     * or if the class doesn't exist.
     *
     * @param ObjectDefinition $definition
     *
     * {@inheritdoc}
     */
    public function isResolvable(\DeliciousBrains\WPMDB\Container\DI\Definition\Definition $definition, array $parameters = [])
    {
        return $definition->isInstantiable();
    }
    /**
     * Returns a proxy instance.
     *
     * @param ObjectDefinition $definition
     * @param array           $parameters
     *
     * @return LazyLoadingInterface Proxy instance
     */
    private function createProxy(\DeliciousBrains\WPMDB\Container\DI\Definition\ObjectDefinition $definition, array $parameters)
    {
        /** @noinspection PhpUnusedParameterInspection */
        $proxy = $this->proxyFactory->createProxy($definition->getClassName(), function (&$wrappedObject, $proxy, $method, $params, &$initializer) use($definition, $parameters) {
            $wrappedObject = $this->createInstance($definition, $parameters);
            $initializer = null;
            // turning off further lazy initialization
            return \true;
        });
        return $proxy;
    }
    /**
     * Creates an instance of the class and injects dependencies..
     *
     * @param ObjectDefinition $definition
     * @param array            $parameters      Optional parameters to use to create the instance.
     *
     * @throws DefinitionException
     * @throws DependencyException
     * @return object
     */
    private function createInstance(\DeliciousBrains\WPMDB\Container\DI\Definition\ObjectDefinition $definition, array $parameters)
    {
        $this->assertClassExists($definition);
        $classname = $definition->getClassName();
        $classReflection = new \ReflectionClass($classname);
        $this->assertClassIsInstantiable($definition);
        $constructorInjection = $definition->getConstructorInjection();
        try {
            $args = $this->parameterResolver->resolveParameters($constructorInjection, $classReflection->getConstructor(), $parameters);
            if (\count($args) > 0) {
                $object = $classReflection->newInstanceArgs($args);
            } else {
                $object = new $classname();
            }
            $this->injectMethodsAndProperties($object, $definition);
        } catch (\DeliciousBrains\WPMDB\Container\Interop\Container\Exception\NotFoundException $e) {
            throw new \DeliciousBrains\WPMDB\Container\DI\DependencyException(\sprintf('Error while injecting dependencies into %s: %s', $classReflection->getName(), $e->getMessage()), 0, $e);
        } catch (\DeliciousBrains\WPMDB\Container\DI\Definition\Exception\DefinitionException $e) {
            throw \DeliciousBrains\WPMDB\Container\DI\Definition\Exception\DefinitionException::create($definition, \sprintf('Entry "%s" cannot be resolved: %s', $definition->getName(), $e->getMessage()));
        }
        if (!$object) {
            throw new \DeliciousBrains\WPMDB\Container\DI\DependencyException(\sprintf('Entry "%s" cannot be resolved: %s could not be constructed', $definition->getName(), $classReflection->getName()));
        }
        return $object;
    }
    protected function injectMethodsAndProperties($object, \DeliciousBrains\WPMDB\Container\DI\Definition\ObjectDefinition $objectDefinition)
    {
        // Property injections
        foreach ($objectDefinition->getPropertyInjections() as $propertyInjection) {
            $this->injectProperty($object, $propertyInjection);
        }
        // Method injections
        foreach ($objectDefinition->getMethodInjections() as $methodInjection) {
            $methodReflection = new \ReflectionMethod($object, $methodInjection->getMethodName());
            $args = $this->parameterResolver->resolveParameters($methodInjection, $methodReflection);
            $methodReflection->invokeArgs($object, $args);
        }
    }
    /**
     * Inject dependencies into properties.
     *
     * @param object            $object            Object to inject dependencies into
     * @param PropertyInjection $propertyInjection Property injection definition
     *
     * @throws DependencyException
     * @throws DefinitionException
     */
    private function injectProperty($object, \DeliciousBrains\WPMDB\Container\DI\Definition\ObjectDefinition\PropertyInjection $propertyInjection)
    {
        $propertyName = $propertyInjection->getPropertyName();
        $className = $propertyInjection->getClassName();
        $className = $className ?: \get_class($object);
        $property = new \ReflectionProperty($className, $propertyName);
        $value = $propertyInjection->getValue();
        if ($value instanceof \DeliciousBrains\WPMDB\Container\DI\Definition\Helper\DefinitionHelper) {
            /** @var Definition $nestedDefinition */
            $nestedDefinition = $value->getDefinition('');
            try {
                $value = $this->definitionResolver->resolve($nestedDefinition);
            } catch (\DeliciousBrains\WPMDB\Container\DI\DependencyException $e) {
                throw $e;
            } catch (\Exception $e) {
                throw new \DeliciousBrains\WPMDB\Container\DI\DependencyException(\sprintf('Error while injecting in %s::%s. %s', \get_class($object), $propertyName, $e->getMessage()), 0, $e);
            }
        }
        if (!$property->isPublic()) {
            $property->setAccessible(\true);
        }
        $property->setValue($object, $value);
    }
    private function assertClassExists(\DeliciousBrains\WPMDB\Container\DI\Definition\ObjectDefinition $definition)
    {
        if (!$definition->classExists()) {
            throw \DeliciousBrains\WPMDB\Container\DI\Definition\Exception\DefinitionException::create($definition, \sprintf('Entry "%s" cannot be resolved: the class doesn\'t exist', $definition->getName()));
        }
    }
    private function assertClassIsInstantiable(\DeliciousBrains\WPMDB\Container\DI\Definition\ObjectDefinition $definition)
    {
        if (!$definition->isInstantiable()) {
            throw \DeliciousBrains\WPMDB\Container\DI\Definition\Exception\DefinitionException::create($definition, \sprintf('Entry "%s" cannot be resolved: the class is not instantiable', $definition->getName()));
        }
    }
}
