<?php
  // Display events by date greater than today

  // Find date time now
  date_default_timezone_set('America/New_York');
  $date_now = date('Y-m-d 00:00:00', mktime(date('H'),date('i'),date('s'), date('m'),date('d')-1,date('Y')));
  $posts = new WP_Query(array(
    'posts_per_page' => 3,
    'post_type' => 'events',
    'meta_query' => array(
      array(
        'key' => 'event_start_date',
        'compare' => '>=',
        'value' => $date_now,
        'type' => 'DATETIME'
      )
    ),
    'order' => 'ASC',
    'orderby' => 'meta_value',
    'meta_key' => 'event_start_date',
    'meta_type' => 'DATETIME'
  ));
?>
<?php if($posts->have_posts()): ?>
  <section class="c-section c-section-events u-background--texture">
    <div class="c-section--inner l-container u-spacing--double u-text-align--center">
      <h3 class="u-font--primary--m u-color--white c-section-events__title">Upcoming Programs & Events</h3>
      <div class="c-section-events__feed c-section-events--inner u-spacing--double l-narrow l-narrow--l ">
        <div class="c-section-events__blocks">
          <?php while($posts->have_posts()): ?> <?php $posts->the_post() ?>
            <?php echo $__env->make('patterns.blocks.c-block-events', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php endwhile; ?>
          <?php wp_reset_query() ?>
        </div>
        <a href="/calendar/upcoming-events" class="o-button u-button--green u-center-block">View All Upcoming Programs & Events</a>
      </div><!-- ./l-narrow -->
    </div><!-- ./l-container -->
  </section>
<?php endif; ?>
