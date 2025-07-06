<?php if(have_rows('slideshow')): ?>
  <section class="c-section c-section-slideshow u-padding--zero">
    <div class="slick slick-slideshow c-slideshow">
      <?php while(have_rows('slideshow')): ?>
        <?php
          the_row();
          $title = get_sub_field('slideshow_title');
          $description = get_sub_field('slideshow_description');
          $link_url = get_sub_field('slideshow_cta_link');
          $link_text = get_sub_field('slideshow_cta_text');
          $thumb_id = get_sub_field('slideshow_image')['ID'];
        ?>
        <div class="c-slideshow__slide">
          <div class="c-slideshow__image u-overlay slick-background u-background--cover u-background-image--<?php echo e($thumb_id); ?>"></div>
          <style>
            .u-background-image--<?php echo e($thumb_id); ?> {
              background-image: url(<?php echo e(wp_get_attachment_image_src($thumb_id, "featured__hero--s")[0]); ?>);
            }
            @media (min-width: 500px) {
              .u-background-image--<?php echo e($thumb_id); ?> {
                background-image: url(<?php echo e(wp_get_attachment_image_src($thumb_id, "featured__hero--m")[0]); ?>);
              }
            }
            @media (min-width: 800px) {
              .u-background-image--<?php echo e($thumb_id); ?> {
                background-image: url(<?php echo e(wp_get_attachment_image_src($thumb_id, "featured__hero--l")[0]); ?>);
              }
            }
            @media (min-width: 1100px) {
              .u-background-image--<?php echo e($thumb_id); ?> {
                background-image: url(<?php echo e(wp_get_attachment_image_src($thumb_id, "featured__hero--xl")[0]); ?>);
              }
            }
          </style>
          <div class="c-slideshow__content">
            <div class="c-slideshow__content--inner l-container u-color--white u-spacing u-text-align--center l-narrow l-narrow--m">
              <?php if($title): ?>
                <h1 class="c-slideshow__content-title u-font--primary--xl">
                  <?php echo $title; ?>

                </h1>
                <hr class="u-hr--small u-hr--white"/>
              <?php endif; ?>
              <?php if($description): ?>
                <div class="c-slideshow__content-description"><?php echo wpautop($description); ?></div>
              <?php endif; ?>
              <?php if($link_url): ?>
                <p>
                  <a href="<?php echo e($link_url); ?>" class="u-link--cta u-link--white u-center-block">
                    <?php if($link_text): ?>
                      <?php echo e($link_text); ?>

                    <?php else: ?>
                      Learn More
                    <?php endif; ?>
                    <span class="u-icon u-icon--m u-path-fill--white"><?php echo $__env->make('patterns.icons.o-arrow--short', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></span>
                  </a>
                </p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
<?php endif; ?>
