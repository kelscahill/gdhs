<?php

namespace DeliciousBrains\WPMDB\Container\DI\Definition\Helper;

use DeliciousBrains\WPMDB\Container\DI\Definition\ArrayDefinitionExtension;
/**
 * Helps extending the definition of an array.
 *
 * For example you can add new entries to the array.
 *
 * @since 5.0
 * @author Matthieu Napoli <matthieu@mnapoli.fr>
 */
class ArrayDefinitionExtensionHelper implements \DeliciousBrains\WPMDB\Container\DI\Definition\Helper\DefinitionHelper
{
    /**
     * @var array
     */
    private $values = [];
    /**
     * @param array $values Values to add to the array.
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }
    /**
     * @param string $entryName Container entry name
     *
     * @return ArrayDefinitionExtension
     */
    public function getDefinition($entryName)
    {
        return new \DeliciousBrains\WPMDB\Container\DI\Definition\ArrayDefinitionExtension($entryName, $this->values);
    }
}
