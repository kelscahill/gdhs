@php
  $thumb_id = get_post_thumbnail_id();
  $caption = get_the_post_thumbnail_caption();
@endphp
@if ($thumb_id)
<section class="section section__hero @if (get_field('hero_background') != 1) {{ 'overlay--full' }} @endif layout-container @if ($thumb_id) {{ 'background--cover background-image--' . $thumb_id }} @endif">
  <style>
    .background-image--{{ $thumb_id }} {
      background-image: url({{ wp_get_attachment_image_src($thumb_id, "featured__hero--xl")[0] }});
    }
    @media (min-width: 800px) {
      .background-image--{{ $thumb_id }} {
        background-image: url({{ wp_get_attachment_image_src($thumb_id, "featured__hero--xl")[0] }});
      }
    }
    @media (min-width: 800px) {
      .background-image--{{ $thumb_id }} {
        background-image: url({{ wp_get_attachment_image_src($thumb_id, "featured__hero--xl")[0] }});
      }
    }
    @media (min-width: 1100px) {
      .background-image--{{ $thumb_id }} {
        background-image: url({{ wp_get_attachment_image_src($thumb_id, "featured__hero--xl")[0] }});
      }
    }
  </style>
  @if ($caption)
    <div class="section__hero-caption caption narrow narrow--l">
      {{ $caption }}
    </div>
  @endif
  <div class="section__hero-content spacing--double text-align--center padding--double color--white @if (get_field('hero_background') == 1) {{ 'background-color--black' }} @endif">
    @include('partials.page-title')
    <span class="icon icon--m center-block">@include('patterns.icons.icon-arrow--down')</span>
  </div>
</section>
@else
  <div class="article__header narrow narrow--l padding--double-bottom text-align--center">
    @include('partials.page-title')
  </div>
@endif
