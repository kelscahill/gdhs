<?php $__env->startSection('content'); ?>
  <?php while(have_posts()): ?> <?php the_post() ?>
    <?php echo $__env->make('patterns.sections.c-section-slideshow', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('patterns.sections.c-section-events', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('patterns.sections.c-section-news', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('patterns.sections.c-section-featured-pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php endwhile; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>