@extends('layouts.app')
@section('content')
  <header class="c-page-header l-container l-narrow u-text-align--center u-spacing--double">
    <div class="u-spacing--half">
      <span class="c-page-header__kicker o-kicker u-font--secondary--s u-color--primary">Search</span>
      <h1 class="c-page-header__title u-font--primary--xl u-color--secondary">{!! App\title() !!}</h1>
    </div>
    <hr class="u-hr--small u-hr--black"/>
  </header>
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
      @php /* echo do_shortcode('[ajax_load_more container_type="div" search="get_search_query()" post_type="post, page" scroll="false" transition_container="false" button_label="Load More" posts_per_page="12" offset="12"]'); */ @endphp
    @else
      <div class="l-narrow l-narrow--m u-text-align--center u-spacing">
        <p>{{  __('Sorry, no results were found.', 'sage') }}</p>
        @include('patterns.forms.c-form-search-block')
      </div>
    @endif
  </article>
@endsection
