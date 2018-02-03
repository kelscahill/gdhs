@php
  $post_type = get_post_type($post->ID);
  $category = get_the_category();
  if ($category) {
    if (class_exists('WPSEO_Primary_Term')) {
      $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
      $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
      $term = get_term($wpseo_primary_term);
      if (is_wp_error($term)) {
        $category = $category[0]->slug;
      } else {
        $category = $term->slug;
      }
    }
    else {
      $category = $category[0]->slug;
    }
  }
  $args = array(
    'post_type' => $post_type,
    'category_name' => $category,
    'posts_per_page' => 4,
    'post__not_in' => array($post->ID)
  );
  $related = new WP_Query($args);
@endphp
@if ($related->have_posts())
  <section class="c-section c-section-related u-background--texture">
    <div class="c-section--inner l-container u-spacing">
      <h2 class="u-font--primary--m u-color--white u-text-align--center">Related {{ ucwords($post_type) . 's' }}</h2>
      <div class="l-narrow l-narrow--l">
        <div class="l-grid l-grid--4-col">
          @while ($related->have_posts())
            @php($related->the_post())
            <div class="l-grid-item">
              @include('patterns.blocks.c-block-news')
            </div>
          @endwhile; @php(wp_reset_query())
        </div>
      </div><!-- ./l-narrow -->
    </div><!-- ./l-container -->
  </section>
@endif
