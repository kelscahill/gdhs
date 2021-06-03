@extends('layouts.app')
@section('content')
  @include('patterns.sections.c-section-hero')
  @include('partials.page-header')
  <article @php post_class('c-article l-container l-narrow l-narrow--l') @endphp>
    @if (have_posts())
      <div class="l-grid l-grid--4-col">
        @while (have_posts()) @php the_post() @endphp
          <div class="l-grid-item">
            @include ('partials.content')
          </div>
        @endwhile
        @php wp_reset_query() @endphp
      </div>
      @php echo do_shortcode('[ajax_load_more container_type="div" post_type="post" scroll="false" transition_container="false" button_label="Load More" posts_per_page="12" offset="12"]'); @endphp
    @else
      <p>Sorry, there are no posts at this time.</p>
    @endif
  </article>
@endsection
