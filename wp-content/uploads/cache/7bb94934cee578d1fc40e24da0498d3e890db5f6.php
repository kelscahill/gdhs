<?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<article <?php post_class('c-article l-container l-narrow l-narrow--l u-spacing--double') ?>>
  <?php if(!is_page_template('views/template-landing.blade.php') && get_field('hide_featured_image') != 1): ?>
    <?php $thumb_id = get_post_thumbnail_id(); ?>
    <?php if($thumb_id): ?>
      <?php
        $image_small = wp_get_attachment_image_src($thumb_id, 'horiz__16x9--s')[0];
        $image_medium = wp_get_attachment_image_src($thumb_id, 'horiz__16x9--m')[0];
        $image_large = wp_get_attachment_image_src($thumb_id, 'horiz__16x9--l')[0];
        $image_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
        $caption = get_the_post_thumbnail_caption();
      ?>
      <picture class="c-article__image u-spacing--half">
        <source srcset="<?php echo e($image_large); ?>" media="(min-width:800px)">
        <source srcset="<?php echo e($image_medium); ?>" media="(min-width:500px)">
        <img src="<?php echo e($image_small); ?>" alt="<?php echo e($image_alt); ?>" class="u-width--100p u-center-block u-display--block">
        <?php if($caption): ?>
          <div class="o-caption u-font--s"><?php echo e($caption); ?></div>
        <?php endif; ?>
      </picture>
    <?php endif; ?>
  <?php endif; ?>
  <div class="c-article__body u-spacing--double <?php if(get_field('hide_dropcap') != 1): ?><?php echo e('has-dropcap'); ?><?php endif; ?>">
    <?php the_content() ?>
  </div>
  <?php if(is_page('gallery')): ?>
    <?php echo $__env->make('patterns.components.c-gallery', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php endif; ?>
</article>
