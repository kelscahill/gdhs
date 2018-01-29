@extends('layouts.app')
@section('content')
  @include('partials.page-header')
  <article @php(post_class('c-article l-container l-narrow l-narrow--l'))>
    @if (have_posts())
      <div class="l-grid l-grid--4-col">
        @while (have_posts()) @php(the_post())
          <div class="l-grid-item">
            @include ('partials.content')
          </div>
        @endwhile
        @php(wp_reset_query())
      </div>
    @else
      <p>Sorry there are no posts at this time.</p>
    @endif
  </article>
@endsection
