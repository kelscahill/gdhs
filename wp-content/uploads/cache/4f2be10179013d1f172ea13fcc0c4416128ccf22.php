<?php if(is_page_template('views/template-events.blade.php') || is_page_template('views/template-past-events.blade.php')): ?>
  <?php echo $__env->make('patterns.blocks.c-block-events', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php else: ?>
  <?php echo $__env->make('patterns.blocks.c-block-news', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
