<ul class="c-secondary-nav__list">
  <?php
    $args = array(
      'child_of' => $id,
      'parent' => $id,
      'sort_column' => 'menu_order',
      'sort_order' => 'ASC',
      'hierarchical' => 0,
    );
    $pages = get_pages($args);
  ?>
  <?php if($pages): ?>
    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <li class="c-secondary-nav__list-item">
        <a href="<?php echo e($page->guid); ?>" class="c-secondary-nav__link u-font--xl"><?php echo e($page->post_title); ?></a>
      </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>
</ul>
