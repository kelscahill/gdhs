@extends('layouts.app')
@section('content')
  @while(have_posts()) @php the_post() @endphp
    @php
      $subtitle = get_field('product_subtitle');
      $gallery = get_field('product_gallery');
      $details = get_field('product_details');
      $button = get_field('paypal_link');
      if (get_field('pdf_download')) {
        $pdf = get_field('pdf_download')['url'];
      } else {
        $pdf = NULL;
      }
    @endphp
    <header class="c-page-header l-container l-narrow l-narrow--l u-text-align--center u-spacing--double">
      <div class="c-page-header__breadcrumbs">
        @include('patterns.components.c-breadcrumbs')
      </div>
      <div class="u-spacing--half">
        <span class="c-page-header__kicker o-kicker u-font--secondary--s u-color--primary">Shop</span>
        <h1 class="c-page-header__title u-font--primary--xl u-color--secondary">{!! get_the_title() !!}</h1>
        <div class="c-page-header__meta u-font--s">
          {{ get_field('product_subtitle') }}
        </div>
      </div>
    </header>
    <article @php post_class('c-article c-article-product l-container l-narrow l-narrow--l') @endphp>
      <div class="c-article__body">
        <div class="c-article--left">
          @if ($gallery)
            <div class="slick-gallery">
              @foreach ($gallery as $item)
                <picture class="c-article__image">
                  <source srcset="{{ $item['sizes']['flex-height--m'] }}" media="(min-width:350px)">
                  <img src="{{ $item['sizes']['flex-height--s'] }}" alt="{{ $item['alt'] }}" class="u-center-block">
                </picture>
              @endforeach
            </div>
          @else
            @php
              $thumb_id = get_post_thumbnail_id();
              $caption = get_the_post_thumbnail_caption();
              $image_small = wp_get_attachment_image_src($thumb_id, 'flex-height--s')[0];
              $image_medium = wp_get_attachment_image_src($thumb_id, 'flex-height--m')[0];
              $image_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
            @endphp
            <picture class="c-article__image u-spacing--half">
              <source srcset="{{ $image_medium }}" media="(min-width:350px)">
              <img src="{{ $image_small }}" alt="{{ $image_alt }}" class="u-center-block">
              @if ($caption)
                <div class="o-caption u-font--s">{{ $caption }}</div>
              @endif
            </picture>
          @endif
        </div>
        <div class="c-article--right u-spacing--double">
          <div class="u-clear-fix">
            @php the_content() @endphp
          </div>
          @if (have_rows('product_details'))
            <span class="u-list__title u-font--secondary--s u-color--secondary u-display--block u-space--double--top">Details</span>
            <ul class="u-list__details">
              @while (have_rows('product_details'))
                @php the_row() @endphp
                <li>{{ the_sub_field('product_detail') }}</li>
              @endwhile
            </ul>
          @endif
          <footer class="c-article__footer">
            @if ($button || $pdf)
              <div class="c-article__footer--left">
                @if ($button)
                  <a href="{{ $button }}" class="o-button u-button--red" target="_blank">Order Now</a>
                @endif
                @if ($pdf)
                  <a href="{{ $pdf }}" class="u-link u-font--m u-font-style--italic" target="_blank">PDF Download</a>
                @endif
              </div>
            @endif
            <div class="c-article__footer--right">
              @include('patterns.components.c-share-tools')
            </div>
          </footer>
        </div><!-- ./c-article--right -->
      </div><!-- ./c-article__body -->
    </article>
    @include('patterns.sections.c-section-related-posts')
  @endwhile
@endsection
