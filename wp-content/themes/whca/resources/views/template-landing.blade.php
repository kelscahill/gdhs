{{--
  Template Name: Landing Page Template
--}}
@php($id = get_queried_object_id())
@extends('layouts.app')
@include('patterns.hero-image')
<div class="nav-bar nav-bar--landing background-color--quaternary color--white">
  <div class="nav-bar--inner nav-bar--inner--landing layout-container js-this">
    <div class="nav-bar__toggle js-toggle" data-prefix="nav-bar--inner" data-toggled="this">
      @if (get_field('page_icon'))
        <span class="icon icon--s icon--{{ the_field('page_icon') }} space--half-right"></span>
      @endif
      <p class="font--m font-weight--700">In this Section</p>
      <span class="icon icon--xs icon--arrow path-fill--white space--left hide-after--xl">
        @include('patterns.icon--arrow')
      </span>
    </div>
    <ul class="nav-bar__list secondary-nav">
      @php
        $args = array(
          'child_of' => $id,
          'depth' => 1,
          'sort_column' => 'menu_order',
          'sort_order' => 'ASC'
        );
        $pages = get_pages($args);
      @endphp
      @if ($pages)
        @foreach ($pages as $page)
          <li class="secondary-nav__list-item nav-bar__list-item">
            <a href="{{ $page->guid }}" class="secondary-nav__link">{{ $page->post_title }}</a>
          </li>
        @endforeach
      @endif
    </ul>
  </div>
</div>
@section('content')
  @while(have_posts()) @php(the_post())
    <section class="section page-content grid--50-50">
      <article @php(post_class('narrow article spacing'))>
        @php(the_content())
      </article>
      @if (get_field('freeform_title') || get_field('freeform_body'))
        <aside class="sidebar spacing">
          @if (get_field('freeform_kicker'))
            <div class="kicker">
              @if (get_field('freeform_kicker_icon'))
                <span class="icon icon--s icon--{{ the_field('freeform_kicker') }} space--half-right"></span>
              @endif
              <p class="font--m color--gray">{{ the_field('freeform_kicker') }}</p>
            </div>
          @endif
          <div class="sidebar--inner background-color--white border padding">
            @if (get_field('freeform_title'))<h3 class="font--l">{{ the_field('freeform_title') }}</h3>@endif
            {{ the_field('freeform_body') }}
            @if (get_field('freeform_link_url'))
              <a href="{{ the_field('freeform_link_url') }}" class="link--cta">
                @if (get_field('freeform_link_text'))
                  {{ the_field('freeform_link_text') }}
                @else
                  Learn More
                @endif
              </a>
            @endif
          </div>
        </aside>
      @endif
    </section>
    <section class="section section__link-blocks">
    </section>
    <section class="section section__numbers">
    </section>
    <section class="section section__testimonials">
    </section>
    <section class="section section__faqs">
    </section>
  @endwhile
@endsection
