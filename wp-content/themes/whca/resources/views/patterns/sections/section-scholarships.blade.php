@php
  // Display scholarship winners by date
  $posts = new WP_Query(array(
    'post_type' => 'scholarships',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'order' => 'DESC',
  ));
@endphp
@if ($posts->have_posts())
  <section class="section section__scholarships background-color--primary color--white">
    <div class="section--inner layout-container spacing--double">
      <h2 class="section-title text-align--center font--primary--m">2017 Scholarships</h2>
      <p class="section-dek narrow narrow--l">Pellentesque dignissim vel purus nec tristique. Sed a elit tristique, venenatis magna et, efficitur erat. Nunc enim metus, lobortis vitae nibh at, tempor facilisis velit. Aenean et eleifend lorem. In hac habitasse platea dictumst. Suspendisse semper ultrices lectus nec luctus. Phasellus volutpat purus id lectus cursus, in gravida mi ullamcorper. Duis eget pulvinar velit, sit amet euismod augue. Fusce iaculis sed est at volutpat. Fusce vestibulum nec est et mattis. Cras laoreet eget orci nec suscipit. Phasellus dictum ligula quis felis dapibus mollis. Aliquam erat volutpat.</p>

      <div class="grid grid--6-col">
        @while ($posts->have_posts()) @php($posts->the_post())
          @php
            $id = get_the_ID();
            $title = get_the_title($id);
            $thumb_id = get_post_thumbnail_id($id);
            $link = get_permalink($id);
          @endphp
          <div class="grid-item">
            @include('patterns.blocks.block-person')
          </div>
        @endwhile
        @php(wp_reset_query())
      </div>
    </div>
  </section>
@endif