{{--
  Template Name: Past Events Page Template
--}}
@php
  // Display events by date less than today
  // Find date time now
  date_default_timezone_set('America/New_York');
  $date_now = date('Y-m-d 24:00:00', mktime(date('H'),date('i'),date('s'), date('m'),date('d')-1,date('Y')));
  $year_from_now = date('Y-m-d 24:00:00', mktime(date('H'),date('i'),date('s'), date('m'),date('d')-1,date('Y')-1));
  $posts = new WP_Query(array(
    'posts_per_page' => -1,
    'post_type' => 'events',
    'meta_query' => array(
      array(
        'key' => 'event_start_date',
        'compare' => '<',
        'value' => $date_now,
        'type' => 'DATETIME'
      ),
      array(
        'key' => 'event_start_date',
        'compare' => '>=',
        'value' => $year_from_now,
        'type' => 'DATETIME'
      )
    ),
    'order' => 'DESC',
    'orderby' => 'meta_value',
    'meta_key' => 'event_start_date',
    'meta_type' => 'DATETIME'
  ));
@endphp
@extends('layouts.app')
@section('content')
  @include('partials.page-header')
  <article @php post_class('c-article l-container l-narrow l-narrow--l u-spacing--double') @endphp>
    @if ($posts->have_posts())
      @while ($posts->have_posts()) @php $posts->the_post() @endphp
        @include ('partials.content')
      @endwhile
      @php wp_reset_query() @endphp
    @else
    <p>Sorry, there are no past programs or events at this time.</p>
    @endif
  </article>
  @include('patterns.sections.c-section-events')
@endsection
