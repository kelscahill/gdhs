<?php $__env->startSection('content'); ?>
  <?php while(have_posts()): ?> <?php the_post() ?>
    <?php
      $subtitle = get_field('product_subtitle');
      $gallery = get_field('product_gallery');
      $details = get_field('product_details');
      $product_categories = get_the_terms(get_the_ID(), 'product_category');
      $is_digital_download = false;

      if ($product_categories && !is_wp_error($product_categories)) {
        foreach ($product_categories as $category) {
          if ($category->slug === 'digital-download') {
            $is_digital_download = true;
            break;
          }
        }
      }
    ?>
    <header class="c-page-header l-container l-narrow l-narrow--l u-text-align--center u-spacing--double">
      <div class="c-page-header__breadcrumbs">
        <?php echo $__env->make('patterns.components.c-breadcrumbs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      </div>
      <div class="u-spacing--half">
        <span class="c-page-header__kicker o-kicker u-font--secondary--s u-color--primary">Shop</span>
        <h1 class="c-page-header__title u-font--primary--xl u-color--secondary"><?php echo get_the_title(); ?></h1>
        <div class="c-page-header__meta u-font--s">
          <?php echo e(get_field('product_subtitle')); ?>

        </div>
      </div>
    </header>
    <article <?php post_class('c-article c-article-product l-container l-narrow l-narrow--l') ?>>
      <div class="c-article__body">
        <div class="c-article--left">
          <?php if($gallery): ?>
            <div class="slick-gallery">
              <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <picture class="c-article__image">
                  <source srcset="<?php echo e($item['sizes']['flex-height--m']); ?>" media="(min-width:350px)">
                  <img src="<?php echo e($item['sizes']['flex-height--s']); ?>" alt="<?php echo e($item['alt']); ?>" class="u-center-block">
                </picture>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php else: ?>
            <?php
              $thumb_id = get_post_thumbnail_id();
              $caption = get_the_post_thumbnail_caption();
              $image_small = wp_get_attachment_image_src($thumb_id, 'flex-height--s')[0];
              $image_medium = wp_get_attachment_image_src($thumb_id, 'flex-height--m')[0];
              $image_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
            ?>
            <picture class="c-article__image u-spacing--half">
              <source srcset="<?php echo e($image_medium); ?>" media="(min-width:350px)">
              <img src="<?php echo e($image_small); ?>" alt="<?php echo e($image_alt); ?>" class="u-center-block">
              <?php if($caption): ?>
                <div class="o-caption u-font--s"><?php echo e($caption); ?></div>
              <?php endif; ?>
            </picture>
          <?php endif; ?>
        </div>
        <div class="c-article--right u-spacing--double">
          <div class="u-clear-fix">
            <?php the_content() ?>
          </div>
          <?php if(have_rows('product_details')): ?>
            <span class="u-list__title u-font--secondary--s u-color--secondary u-display--block u-space--double--top">Details</span>
            <ul class="u-list__details">
              <?php while(have_rows('product_details')): ?>
                <?php the_row() ?>
                <li><?php echo e(the_sub_field('product_detail')); ?></li>
              <?php endwhile; ?>
            </ul>
          <?php endif; ?>
          <footer class="c-article__footer">
            <div class="c-article__footer--left">
              <?php if($is_digital_download): ?>
                <a href="<?php echo e(home_url('/digital-download-checkout?product_id=' . get_the_ID())); ?>" class="o-button u-button--red" target="_blank">Order Now</a>
              <?php else: ?>
                <a href="<?php echo e(home_url('/checkout?product_id=' . get_the_ID())); ?>" class="o-button u-button--red" target="_blank">Order Now</a>
              <?php endif; ?>
            </div>
            <div class="c-article__footer--right">
              <?php echo $__env->make('patterns.components.c-share-tools', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
          </footer>
        </div><!-- ./c-article--right -->
      </div><!-- ./c-article__body -->
    </article>
    <?php echo $__env->make('patterns.sections.c-section-related-posts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php endwhile; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>