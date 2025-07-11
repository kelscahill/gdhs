<?php
  // Display news posts by date
  $posts = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 4,
    'post_status' => 'publish',
    'order' => 'DESC',
    'category_name' => 'featured'
  ));
?>
<?php if($posts->have_posts()): ?>
  <section class="c-section c-section-news">
    <div class="c-section--inner l-container u-spacing">
      <h3 class="u-text-align--center">Announcements</h3>
      <div class="l-narrow l-narrow--l">
        <div class="c-section-news__grid l-grid l-grid--4-col">
          <?php while($posts->have_posts()): ?> <?php $posts->the_post() ?>
            <div class="c-section-news__grid-item l-grid-item">
              <?php echo $__env->make('partials.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
          <?php endwhile; ?>
          <?php wp_reset_query() ?>
        </div>
        <a href="/about/news" class="o-button u-button--red u-center-block">View All News</a>
      </div><!-- ./l-narrow -->
    </div><!-- ./l-container -->
  </section>
<?php endif; ?>
