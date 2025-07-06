<?php $__env->startSection('content'); ?>
  <header class="c-page-header l-container l-narrow u-text-align--center u-spacing--double">
    <div class="u-spacing--half">
      <span class="c-page-header__kicker o-kicker u-font--secondary--s u-color--primary">Search</span>
      <h1 class="c-page-header__title u-font--primary--xl u-color--secondary"><?php echo get_the_title(); ?></h1>
    </div>
    <hr class="u-hr--small u-hr--black"/>
  </header>
  <article <?php post_class('c-article l-container l-narrow l-narrow--l') ?>>
    <?php if(have_posts()): ?>
      <div class="l-grid l-grid--4-col">
        <?php while(have_posts()): ?> <?php the_post() ?>
          <div class="l-grid-item">
            <?php echo $__env->make('partials.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          </div>
        <?php endwhile; ?>
        <?php wp_reset_query() ?>
      </div>
    <?php else: ?>
      <div class="l-narrow l-narrow--m u-text-align--center u-spacing">
        <p><?php echo e(__('Sorry, no results were found.', 'sage')); ?></p>
        <?php echo $__env->make('patterns.forms.c-form-search-block', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </div>
    <?php endif; ?>
  </article>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>