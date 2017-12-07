@php($id = get_queried_object_id())
@extends('layouts.app')
@include('patterns.hero-image')
<div class="nav-bar nav-bar background-color--quaternary color--white">
  <div class="nav-bar--inner flex-justify--space-between layout-container js-this">
    <div class="nav-bar--left">
      <div class="nav-bar__toggle js-toggle" data-prefix="nav-bar--inner" data-toggled="this">
        @if (get_field('page_icon', $id))
          <span class="icon icon--s icon--{{ the_field('page_icon', $id) }} space--half-right"></span>
        @endif
        <p class="font--m font-weight--700">Refine News</p>
        <p class="space--double-left">By Month</p>
        <span class="icon icon--xs icon--arrow path-fill--white space--half-left">
          @include('patterns.icon--arrow')
        </span>
      </div>
      <ul class="nav-bar__list secondary-nav">
        <li class="secondary-nav__list-item nav-bar__list-item">
          <a href="" class="secondary-nav__link">By Date</a>
        </li>
        <li class="secondary-nav__list-item nav-bar__list-item">
          <a href="" class="secondary-nav__link">By Title</a>
        </li>
      </ul>
    </div>
    <div class="nav-bar--right hide-until--m">
      <a href="" class="nav-bar__subscribe link--cta font--m color--white">Sign up for updates<span class="icon icon--s space--half-left">@include('patterns.icon--cta-arrow')</span></a>
    </div>
  </div>
</div>
@section('content')
  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif

  @while (have_posts()) @php(the_post())
    @include ('partials.content-'.(get_post_type() === 'post' ?: get_post_type()))
  @endwhile

  {!! get_the_posts_navigation() !!}
@endsection
