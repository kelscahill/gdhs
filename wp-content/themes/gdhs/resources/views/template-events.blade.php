{{--
  Template Name: Events Page Template
--}}
@php
  // Display events by date greater than today

  // Find date time now
  $date_now = date('Y-m-d H:i:s');

  $posts = new WP_Query(array(
    'posts_per_page' => -1,
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

@extends('layouts.app')
@section('content')
  @include('partials.page-header')
  <article @php(post_class('c-article l-container l-narrow l-narrow--l u-spacing--double'))>
    @if ($posts->have_posts())
      @while ($posts->have_posts()) @php($posts->the_post())
        @include ('partials.content')
      @endwhile
      @php(wp_reset_query())
      <a href="" class="o-button u-button--red u-center-block">Load More (Ajax)</a>
    @else
      <p>Sorry there are no events at this time.</p>
    @endif
  </article>
  {!! get_the_posts_navigation() !!}
@endsection
