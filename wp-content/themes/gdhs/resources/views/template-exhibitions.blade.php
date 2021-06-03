{{--
  Template Name: Exhibitions Page Template
--}}
@php
  if (isset($_GET['orderby'])) {
    // Display posts based on the query_var
    $orderby = ($_GET['orderby']);
    $order = ($_GET['order']);
    $posts = new WP_Query(array(
      'post_type' => 'exhibit',
      'posts_per_page' => 12,
      'post_status' => 'publish',
      'orderby' => $orderby,
      'order' => $order
    ));
  } else if (isset($_GET['category'])) {
    // Display posts based on the query_var
    $cat = ($_GET['category']);
    $posts = new WP_Query(array(
      'post_type' => 'exhibit',
      'posts_per_page' => 12,
      'post_status' => 'publish',
      'tax_query' => array(
        array(
          'taxonomy' => 'exhibit_category',
          'field'    => 'slug',
          'terms'    => $cat,
        ),
      )
    ));
  } else {
    // Display news post by date
    $posts = new WP_Query(array(
      'posts_per_page' => 12,
      'post_type' => 'exhibit'
    ));
  }
@endphp
@extends('layouts.app')
@section('content')
  @include('patterns.sections.c-section-hero')
  @include('partials.page-header')
  <article @php post_class('c-article l-container l-narrow l-narrow--l') @endphp>
    @if ($posts->have_posts())
      <div class="l-grid l-grid--4-col">
        @while ($posts->have_posts()) @php $posts->the_post() @endphp
          <div class="l-grid-item">
            @include ('partials.content')
          </div>
        @endwhile
      </div>
      @php wp_reset_query() @endphp
      @php echo do_shortcode('[ajax_load_more container_type="div" post_type="exhibit" scroll="false" transition_container="false" button_label="Load More" posts_per_page="12" offset="12"]'); @endphp
    @else
      <p class="u-text-align--center">Sorry, there are no exhibitions at this time.</p>
    @endif
  </article>
@endsection
