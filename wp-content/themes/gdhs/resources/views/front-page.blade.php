@extends('layouts.app')
@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('patterns.sections.c-section-slideshow')
    @include('partials.page-header')
    @include('patterns.sections.c-section-events')
    @include('patterns.sections.c-section-news')
    @include('patterns.sections.c-section-featured-pages')
  @endwhile
@endsection
