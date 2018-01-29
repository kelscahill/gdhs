@include('partials.page-header')
<article @php(post_class('c-article l-container l-narrow l-narrow--l u-spacing--double'))>
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
    <img src="{{ $image_small }}" alt="{{ $image_alt }}" class="u-center-block u-display--block">
    @if ($caption)
      <div class="o-caption u-font--s">{{ $caption }}</div>
    @endif
  </picture>
  <div class="c-article__content js-sticky-parent l-narrow">
    <div class="c-article__content--left js-sticky-social">
      @include('patterns.components.c-share-tools')
    </div>
    <div class="c-article__content--right u-spacing--double">
      @php(the_content())
    </div>
  </div>
  <footer class="c-article__footer">
    @include('patterns.components.c-navigation-posts')
  </footer>
</article>
@php related_posts() @endphp
