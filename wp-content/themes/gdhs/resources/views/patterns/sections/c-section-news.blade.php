@php
  // Display news posts by date
  $posts = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 4,
    'post_status' => 'publish',
    'order' => 'DESC',
    'category' => 'news'
  ));
@endphp
@if ($posts->have_posts())
  <section class="c-section c-section-news">
    <div class="c-section--inner l-container u-spacing">
      <div class="l-narrow l-narrow--l">
        <div class="c-section-news__grid l-grid l-grid--4-col">
          @while ($posts->have_posts()) @php($posts->the_post())
            @php
              $id = get_the_ID();
              $title = get_the_title($id);
              $body = strip_tags(get_the_content());
              $body = strip_shortcodes($body);
              $excerpt = get_the_excerpt($id);
              $excerpt_length = 100;
              $thumb_id = get_post_thumbnail_id($id);
              $link = get_permalink($id);
              $date = get_the_date('F j, Y');
              $date_formatted = get_the_date('c');

              $category = get_the_category();
              if ($category) {
                $kicker = '';
                if (class_exists('WPSEO_Primary_Term')) {
                  $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
                  $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
                  $term = get_term($wpseo_primary_term);
                  if (is_wp_error($term)) {
                    $kicker = $category[0]->name;
                  } else {
                    $kicker = $term->name;
                  }
                }
                else {
                  $kicker = $category[0]->name;
                }
              }
            @endphp
            <div class="c-section-news__grid-item l-grid-item">
              @include('patterns.blocks.c-block-news')
            </div>
          @endwhile
          @php(wp_reset_query())
        </div>
        <a href="/about/news" class="o-button u-button--red u-center-block">View All News</a>
      </div><!-- ./l-narrow -->
    </div><!-- ./l-container -->
  </section>
@endif
