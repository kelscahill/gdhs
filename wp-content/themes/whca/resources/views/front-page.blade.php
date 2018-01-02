@extends('layouts.app')
@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.content-page')
    
    @include('patterns.sections.c-section-public-pool')
  @endwhile
@endsection
