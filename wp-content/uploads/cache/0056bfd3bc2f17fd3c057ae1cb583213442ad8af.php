<?php $featured_pages = get_field('featured_pages') ?>
<?php if($featured_pages): ?>
  <section class="l-container c-section c-section__featured-pages u-spacing u-padding--zero">
    <div class="l-grid l-grid--3-col">
      <?php $__currentLoopData = $featured_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $id = $page->ID;
          $link = $page->guid;
          $excerpt = $page->post_excerpt;
          $thumb_id = get_post_thumbnail_id($id);

          if (get_field('display_title', $id)) {
            $title = get_field('display_title', $id);
          } else {
            $title = $page->post_title;
          }
        ?>
        <a href="<?php echo e($link); ?>" class="l-grid-item c-block-featured-page c-block u-overlay">
          <?php if($thumb_id): ?>
            <div class="c-block__media u-background--cover u-background-image--<?php echo e($thumb_id); ?> u-background-color--secondary">
              <style>
                .u-background-image--<?php echo e($thumb_id); ?> {
                  background-image: url(<?php echo e(wp_get_attachment_image_src($thumb_id, "vert__4x3--s")[0]); ?>);
                }
                @media (min-width: 600px) {
                  .u-background-image--<?php echo e($thumb_id); ?> {
                    background-image: url(<?php echo e(wp_get_attachment_image_src($thumb_id, "vert__4x3--m")[0]); ?>);
                  }
                }
              </style>
            </div>
          <?php endif; ?>
          <div class="c-block__content u-spacing u-padding--double">
            <div class="u-block__header u-spacing">
              <?php if($excerpt): ?>
                <h2 class="u-font--secondary--s u-color--tan"><?php echo $title; ?></h2>
                <p class="u-font--primary--l u-color--white"><?php echo e($excerpt); ?></p>
              <?php else: ?>
                <h2 class="u-font--primary--l u-color--white"><?php echo $title; ?></h2>
              <?php endif; ?>
            </div>
            <div class="u-block__link">
              <span class="o-button u-button--outline">Learn More</span>
            </div>
          </div><!-- ./c-block -->
        </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </section>
<?php endif; ?>
