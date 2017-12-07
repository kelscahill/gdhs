@extends('layouts.app')
@include('patterns.hero-image')
@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.content-page')
  @endwhile
@endsection
