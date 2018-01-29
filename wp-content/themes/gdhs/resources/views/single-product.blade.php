@extends('layouts.app')
@section('content')
  @while(have_posts()) @php(the_post())
    <header class="c-page-header l-container l-narrow u-text-align--center u-spacing--double">
      <div class="c-page-header__breadcrumbs">
        @include('patterns.components.c-breadcrumbs')
      </div>
      <div class="u-spacing--half">
        <span class="c-page-header__kicker o-kicker u-font--secondary--s u-color--primary">Shop</span>
        <h1 class="c-page-header__title u-font--primary--xl u-color--secondary">{!! App\title() !!}</h1>
        <div class="c-page-header__meta u-font--s">
          @include('partials.entry-meta')
        </div>
      </div>
    </header>
    <article @php(post_class('c-article c-article-shop l-container l-narrow l-narrow--l u-spacing--double'))>
      <div class="c-article--left">
        @php
          $thumb_id = get_post_thumbnail_id();
          $caption = get_the_post_thumbnail_caption();
          $image_small = wp_get_attachment_image_src($thumb_id, 'horiz__16x9--s')[0];
          $image_medium = wp_get_attachment_image_src($thumb_id, 'horiz__16x9--m')[0];
          $image_large = wp_get_attachment_image_src($thumb_id, 'horiz__16x9--l')[0];
          $image_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
        @endphp
        <picture class="c-article__image u-spacing--half">
          <source srcset="{{ $image_large }}" media="(min-width:800px)">
          <source srcset="{{ $image_medium }}" media="(min-width:500px)">
          <img src="{{ $image_small }}" alt="{{ $image_alt }}" class="u-center-block">
          @if ($caption)
            <div class="o-caption u-font--s">{{ $caption }}</div>
          @endif
        </picture>
      </div>
      <div class="c-article--right">
        @php(the_content())
        @include('patterns.components.c-share-tools')
      </div>
    </article>
  @endwhile
@endsection
