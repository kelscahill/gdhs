<?php
/*
YARPP Template: Thumbnails
Description: Requires a theme which supports post thumbnails
Author: mitcho (Michael Yoshitaka Erlewine)
*/
?>
<?php if (have_posts()): ?>
  <section class="c-section c-section-related u-background--texture">
    <div class="c-section--inner l-container u-spacing">
      <h2 class="u-font--primary--m u-color--white u-text-align--center">Related Items</h2>
      <div class="l-narrow l-narrow--l">
        <?php while (have_posts()) : the_post(); ?>
          <div class="l-grid l-grid--4-col">
            <?php include(locate_template('patterns/blocks/c-block-news.php')); ?>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>
      </div><!-- ./l-narrow -->
    </div><!-- ./l-container -->
  </section>
<?php endif; ?>
