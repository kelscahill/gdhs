<div class="c-block c-block-person">
  <a href="{{ $link }}" class="u-spacing">
    @if ($kicker)
      <div class="c-block__kicker">
        <span class="o-kicker u-font u-color--white">{{ $kicker }}</span>
        <hr class="u-border--white u-border--thick" />
      </div>
    @else
      <hr class="u-border--gray-light u-border--thick" />
    @endif
    @if (!empty($thumb_id))
      <picture class="c-block__thumb">
        <img src="{{ wp_get_attachment_image_src($thumb_id, "thumbnail")[0] }}" alt="{{ get_post_meta($thumb_id, '_wp_attachment_image_alt', true) }}">
      </picture>
    @endif
    <div class="c-block__dek">
      @if (!empty($title))
        <h4 class="u-font--l c-block__title u-color--white">{{ $title }}</h4>
      @endif
      @if (!empty($tag))
        <div class="u-font c-block__tag u-color--gray-light">{{ $tag }}</div>
      @endif
    </div>
  </a>
</div>
