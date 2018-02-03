@extends('layouts.app')
@section('content')
  @while(have_posts()) @php(the_post())
    @php
      $subtitle = get_field('product_subtitle');
      $gallery = get_field('product_gallery');
      $details = get_field('product_details');
      $button = get_field('paypal_link');
      $pdf = get_field('pdf_download')['url'];
    @endphp
    <header class="c-page-header l-container l-narrow l-narrow--l u-text-align--center u-spacing--double">
      <div class="c-page-header__breadcrumbs">
        @include('patterns.components.c-breadcrumbs')
      </div>
      <div class="u-spacing--half">
        <span class="c-page-header__kicker o-kicker u-font--secondary--s u-color--primary">Shop</span>
        <h1 class="c-page-header__title u-font--primary--xl u-color--secondary">{!! App\title() !!}</h1>
        <div class="c-page-header__meta u-font--s">
          {{ get_field('product_subtitle') }}
        </div>
      </div>
    </header>
    <article @php(post_class('c-article c-article-product l-container l-narrow l-narrow--l'))>
      <div class="c-article__body">
        <div class="c-article--left">
          @if ($gallery)
            <div class="slick-gallery">
              @foreach ($gallery as $item)
                <picture class="c-article__image u-spacing--half">
                  <source srcset="{{ $item['sizes']['vert__3x4--m'] }}" media="(min-width:600px)">
                  <img src="{{ $item['sizes']['vert__3x4--s'] }}" alt="{{ $item['alt'] }}" class="u-center-block">
                </picture>
              @endforeach
            </div>
          @else
            @php
              $thumb_id = get_post_thumbnail_id();
              $caption = get_the_post_thumbnail_caption();
              $image_small = wp_get_attachment_image_src($thumb_id, 'vert__3x4--s')[0];
              $image_medium = wp_get_attachment_image_src($thumb_id, 'vert__3x4--m')[0];
              $image_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
            @endphp
            <picture class="c-article__image u-spacing--half">
              <source srcset="{{ $image_medium }}" media="(min-width:600px)">
              <img src="{{ $image_small }}" alt="{{ $image_alt }}" class="u-center-block">
              @if ($caption)
                <div class="o-caption u-font--s">{{ $caption }}</div>
              @endif
            </picture>
            @endif
        </div>
        <div class="c-article--right u-spacing--double">
          @php(the_content())
          @if (have_rows('product_details'))
            <h4 class="u-font--secondary--s u-color--secondary">Details</h4>
            <ul class="u-list__details">
              @while (have_rows('product_details'))
                @php(the_row())
                <li>{{ the_sub_field('product_detail') }}</li>
              @endwhile
            </ul>
          @endif
          <footer class="c-article__footer">
            @if ($button || $pdf)
              <div class="c-article__footer--left">
                @if ($button)
                  <a href="{{ $button }}" class="o-button u-button--red" target="_blank">Buy Now</a>
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
