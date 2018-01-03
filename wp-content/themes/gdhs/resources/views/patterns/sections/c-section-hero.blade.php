@php
  $thumb_id = get_post_thumbnail_id();
  $caption = get_the_post_thumbnail_caption();
@endphp
@if ($thumb_id)
<section class="c-section c-section__hero @if (get_field('hero_background') != 1) {{ 'u-overlay--full' }} @endif l-container @if ($thumb_id) {{ 'u-background--cover u-background-image--' . $thumb_id }} @endif">
  <style>
    .u-background-image--{{ $thumb_id }} {
      background-image: url({{ wp_get_attachment_image_src($thumb_id, "featured__hero--xl")[0] }});
    }
    @media (min-width: 800px) {
      .u-background-image--{{ $thumb_id }} {
        background-image: url({{ wp_get_attachment_image_src($thumb_id, "featured__hero--xl")[0] }});
      }
    }
    @media (min-width: 800px) {
      .u-background-image--{{ $thumb_id }} {
        background-image: url({{ wp_get_attachment_image_src($thumb_id, "featured__hero--xl")[0] }});
      }
    }
    @media (min-width: 1100px) {
      .u-background-image--{{ $thumb_id }} {
        background-image: url({{ wp_get_attachment_image_src($thumb_id, "featured__hero--xl")[0] }});
      }
    }
  </style>
  @if ($caption)
    <div class="c-section__hero-caption u-caption l-narrow l-narrow--l">
      {{ $caption }}
    </div>
  @endif
  <div class="c-section__hero-content u-spacing--double u-text-align--center u-color--white @if (get_field('hero_background') == 1) {{ 'u-background-color--black' }} @endif">
    @include('partials.page-title')
    <span class="c-section__hero-icon u-icon u-icon--l u-center-block">@include('patterns.icons.o-icon-arrow--down')</span>
  </div>
</section>
@else
  <div class="c-article__header l-narrow l-narrow--l u-padding--double-bottom u-text-align--center">
    @include('partials.page-title')
  </div>
@endif
