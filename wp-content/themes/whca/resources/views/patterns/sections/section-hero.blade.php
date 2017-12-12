@php
  $thumb_id = get_post_thumbnail_id();
@endphp
<section class="section section__hero narrow narrow--xl">
  @if ($thumb_id)
    <picture class="section__hero-image">
      <!--[if IE 9]><video style="display: none"><![endif]-->
      <source srcset="{{ wp_get_attachment_image_src($thumb_id, "featured__hero--xl")[0] }}" media="(min-width: 1100px)">
      <source srcset="{{ wp_get_attachment_image_src($thumb_id, "featured__hero--l")[0] }}" media="(min-width: 800px)">
      <source srcset="{{ wp_get_attachment_image_src($thumb_id, "featured__hero--m")[0] }}" media="(min-width: 500px)">
      <!--[if IE 9]></video><![endif]-->
      <img src="{{ wp_get_attachment_image_src($thumb_id, "featured__hero--s")[0] }}" alt="{{ get_post_meta($thumb_id, '_wp_attachment_image_alt', true) }}" />
    </picture>
    <div class="ection__hero-caption caption narrow narrow--l">
      Caption
    </div>
  @endif
  <div class="section__hero-content color--white spacing--double padding--double text-align--center @if(get_field('hero_background')) {{ 'background-color--black' }} @endif">
    @include('partials.page-title')
    <span class="icon icon--m center-block">@include('patterns.icons.icon-arrow--down')</span>
  </div>
</section>
