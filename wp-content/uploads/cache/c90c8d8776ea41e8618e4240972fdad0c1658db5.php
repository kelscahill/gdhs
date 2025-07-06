<?php
  if (isset($_GET['orderby'])) {
    // Display posts based on the query_var
    $orderby = ($_GET['orderby']);
    $order = ($_GET['order']);
    $posts = new WP_Query(array(
      'post_type' => 'product',
      'posts_per_page' => 12,
      'post_status' => 'publish',
      'orderby' => $orderby,
      'order' => $order,
    ));
  } else {
    // Display news post by date
    $posts = new WP_Query(array(
      'posts_per_page' => 12,
      'post_type' => 'product',
    ));
  }
?>

<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('patterns.sections.c-section-hero', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <article <?php post_class('c-article l-container l-narrow l-narrow--l') ?>>
    <?php if($posts->have_posts()): ?>
      <div class="l-grid l-grid--4-col">
        <?php while($posts->have_posts()): ?> <?php $posts->the_post() ?>
          <div class="l-grid-item">
            <?php echo $__env->make('partials.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          </div>
        <?php endwhile; ?>
      </div>
      <?php wp_reset_query() ?>
      <?php echo do_shortcode('[ajax_load_more container_type="div" post_type="product" pause="false" transition_container="false" button_label="Load More" posts_per_page="12" offset="12"]'); ?>
    <?php else: ?>
      <p class="u-text-align--center">Sorry, there are no products at this time.</p>
    <?php endif; ?>
  </article>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>