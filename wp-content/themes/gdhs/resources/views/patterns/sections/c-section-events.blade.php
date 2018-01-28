@php
  // Display events by date greater than today

  // Find date time now
  $date_now = date('Y-m-d H:i:s');

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
    'meta_type' => 'DATE'
  ));
@endphp

@if ($posts->have_posts())
  <section class="c-section c-section-events">
    <div class="c-section--inner l-container u-spacing--double u-text-align--center">
      <h3 class="u-font--primary--m u-color--white c-section-events__title">Upcoming Events</h3>
      <div class="c-section-events__feed c-section-events--inner u-spacing--double l-narrow l-narrow--l ">
        <div class="c-section-events__blocks">
          @while ($posts->have_posts()) @php($posts->the_post())
            @include('patterns.blocks.c-block-events')
          @endwhile
          @php(wp_reset_query())
        </div>
        <a href="/visit/events" class="o-button u-button--green u-center-block">View All Events</a>
      </div><!-- ./l-narrow -->
    </div><!-- ./l-container -->
  </section>
@endif
