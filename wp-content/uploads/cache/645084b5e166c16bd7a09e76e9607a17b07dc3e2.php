<?php if(has_nav_menu('primary_navigation')): ?>
  <nav class="c-nav__primary" role="navigation">
    <?php
      $menu_name = 'primary_navigation';
      $menu_locations = get_nav_menu_locations();
      $menu = wp_get_nav_menu_object( $menu_locations[ $menu_name ] );
      $primary_nav = wp_get_nav_menu_items( $menu->term_id);
      $count = 0;
      $submenu = false;
    ?>
    <div class="c-nav__primary-toggle c-nav__toggle toggle js-toggle-parent">
      <span class="c-nav__toggle-span c-nav__toggle-span--1"></span>
      <span class="c-nav__toggle-span c-nav__toggle-span--2"></span>
      <span class="c-nav__toggle-span c-nav__toggle-span--3"></span>
      <span class="c-nav__toggle-span c-nav__toggle-span--4 u-font-weight--800"></span>
    </div>
    <ul class="c-primary-nav__list">
      <?php
        $primary_nav = json_decode(json_encode($primary_nav), true);
      ?>
      <?php $__currentLoopData = $primary_nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(isset($primary_nav[$count + 1])): ?>
          <?php
            $parent = $primary_nav[$count + 1]['menu_item_parent'];
          ?>
        <?php endif; ?>
        <?php if(!$nav['menu_item_parent']): ?>
          <?php $parent_id = $nav['ID'] ?>
          <li class="c-primary-nav__list-item js-this">
            <div class="c-primary-nav__list-toggle">
              <a href="<?php echo e($nav['url']); ?>" title="<?php echo $nav['title']; ?>" class="c-primary-nav__list-link u-font--secondary--s"><?php echo $nav['title']; ?></a>
              <span class="u-icon u-icon--xs js-toggle" data-toggled="this"><?php echo $__env->make('patterns.icons.o-arrow--small', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></span>
            </div>
        <?php endif; ?>
        <?php if($parent_id == $nav['menu_item_parent']): ?>
          <?php if(!$submenu): ?>
            <?php $submenu = true ?>
            <ul class="c-sub-nav__list">
          <?php endif; ?>
              <li class="c-sub-nav__list-item">
                <a href="<?php echo e($nav['url']); ?>" class="c-sub-nav__list-link"><?php echo $nav['title']; ?></a>
              </li>
          <?php if($parent != $parent_id && $submenu): ?>
            </ul>
            <?php $submenu = false ?>
          <?php endif; ?>
        <?php endif; ?>
        <?php if($parent != $parent_id): ?>
          </li>
          <?php $submenu = false ?>
        <?php endif; ?>
        <?php $count++ ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php wp_reset_postdata() ?>
    </ul>
  </nav>
<?php endif; ?>
