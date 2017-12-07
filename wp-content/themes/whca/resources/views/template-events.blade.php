{{--
  Template Name: Events Template
--}}

@extends('layouts.app')
@include('patterns.hero-image')
<div class="nav-bar nav-bar background-color--quaternary color--white">
  <div class="nav-bar--inner flex-justify--space-between layout-container js-this">
    <div class="nav-bar--left">
      <div class="nav-bar__toggle js-toggle" data-prefix="nav-bar--inner" data-toggled="this">
        @if (get_field('page_icon'))
          <span class="icon icon--s icon--@php(the_field('page_icon')) space--half-right"></span>
        @endif
        <p class="font--m font-weight--700">Refine Calendar</p>
        <p class="space--double-left">April 2017</p>
        <span class="icon icon--xs icon--arrow path-fill--white space--half-left">
          @include('patterns.icon--arrow')
        </span>
      </div>
      <ul class="nav-bar__list secondary-nav">
        <li class="secondary-nav__list-item nav-bar__list-item">
          <a href="" class="secondary-nav__link">May 2017</a>
        </li>
        <li class="secondary-nav__list-item nav-bar__list-item">
          <a href="" class="secondary-nav__link">June 2017</a>
        </li>
        <li class="secondary-nav__list-item nav-bar__list-item">
          <a href="" class="secondary-nav__link">July 2017</a>
        </li>
      </ul>
    </div>
    <div class="nav-bar--right hide-until--m">
      <a href="" class="nav-bar__subscribe link--cta font--m color--white">Subscribe to Calendar<span class="icon icon--s space--half-left">@include('patterns.icon--cta-arrow')</span></a>
    </div>
  </div>
</div>
@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.content-page')
  @endwhile
@endsection
