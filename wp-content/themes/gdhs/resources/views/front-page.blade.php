@extends('layouts.app')
@section('content')
  @while(have_posts()) @php(the_post())
    @include('patterns.sections.c-section-hero')
    @include('partials.content-page')
    @include('patterns.sections.c-section-news')
    @include('patterns.sections.c-section-events')
    @include('patterns.sections.c-section-featured-pages')
  @endwhile
@endsection
