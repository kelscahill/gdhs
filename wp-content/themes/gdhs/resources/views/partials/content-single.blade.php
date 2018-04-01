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
  <div class="c-article__content js-sticky-parent l-narrow">
    <div class="c-article__content--left js-sticky-social">
      @include('patterns.components.c-share-tools')
    </div>
    <div class="c-article__content--right c-article__body u-spacing--double @if (get_field('hide_dropcap') != 1){{ 'has-dropcap' }}@endif">
      @php(the_content())
      @php($blocks = get_field('block'))
      @if ($blocks)
        @foreach ($blocks as $block)
          @php
            $title = $block['block_title'];
            $excerpt = $block['block_description'];
            $thumb_id = $block['block_image']['id'];
            $img_s = $block['block_image']['sizes']['horiz__4x3--s'];
            $img_m = $block['block_image']['sizes']['horiz__4x3--m'];
            $link = $block['block_url'];
          @endphp
          @include('patterns.blocks.c-block')
        @endforeach
      @endif
    </div>
  </div>
  <footer class="c-article__footer">
    @include('patterns.components.c-navigation-posts')
  </footer>
</article>
@include('patterns.sections.c-section-related-posts')
