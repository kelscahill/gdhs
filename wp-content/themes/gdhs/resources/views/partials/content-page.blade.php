@include('partials.page-header')
<article @php(post_class('c-article l-container l-narrow l-narrow--l u-spacing--double'))>
  @if (!is_page_template('views/template-landing.blade.php') && get_field('hide_featured_image') != 1)
    @php
      $thumb_id = get_post_thumbnail_id();
      $caption = get_the_post_thumbnail_caption();
      $image_small = wp_get_attachment_image_src($thumb_id, 'horiz__16x9--s')[0];
      $image_medium = wp_get_attachment_image_src($thumb_id, 'horiz__16x9--m')[0];
      $image_large = wp_get_attachment_image_src($thumb_id, 'horiz__16x9--l')[0];
      $image_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
    @endphp
    @if ($thumb_id)
      <picture class="c-article__image u-spacing--half">
        <source srcset="{{ $image_large }}" media="(min-width:800px)">
        <source srcset="{{ $image_medium }}" media="(min-width:500px)">
        <img src="{{ $image_small }}" alt="{{ $image_alt }}" class="u-width--100p u-center-block u-display--block">
        @if ($caption)
          <div class="o-caption u-font--s">{{ $caption }}</div>
        @endif
      </picture>
    @endif
  @endif
  <div class="c-article__body u-spacing--double">
    @php(the_content())
  </div>
  @if (is_page('gallery'))
    @include('patterns.components.c-gallery')
  @endif
</article>
