@php
  $thumb_id = get_post_thumbnail_id();
  $caption = get_the_post_thumbnail_caption();
@endphp
@if ($thumb_id)
<section class="section section__hero @if (get_field('hero_background') != 1) {{ 'overlay--full' }} @endif layout-container">
  <picture class="section__hero-image">
    <!--[if IE 9]><video style="display: none"><![endif]-->
    <source srcset="{{ wp_get_attachment_image_src($thumb_id, "featured__hero--xl")[0] }}" media="(min-width: 1100px)">
    <source srcset="{{ wp_get_attachment_image_src($thumb_id, "featured__hero--l")[0] }}" media="(min-width: 800px)">
    <source srcset="{{ wp_get_attachment_image_src($thumb_id, "featured__hero--m")[0] }}" media="(min-width: 500px)">
    <!--[if IE 9]></video><![endif]-->
    <img src="{{ wp_get_attachment_image_src($thumb_id, "featured__hero--s")[0] }}" alt="{{ get_post_meta($thumb_id, '_wp_attachment_image_alt', true) }}" />
  </picture>
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
