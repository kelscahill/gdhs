<div class="c-block c-block-news u-background-color--tan u-border">
  <a href="{{ $link }}" class="c-block__link">
    <div class="c-block__media">
      @if (!empty($thumb_id))
        <picture class="c-block__thumb">
          <img src="{{ wp_get_attachment_image_src($thumb_id, "horiz__4x3--s")[0] }}" alt="{{ get_post_meta($thumb_id, '_wp_attachment_image_alt', true) }}">
        </picture>
      @endif
    </div>
    <div class="c-block__content u-padding--half u-spacing">
      <div class="c-block__header u-spacing--half">
        @if ($kicker)
          <h4 class="c-block__kicker o-kicker u-font--secondary--s u-color--primary">{{ $kicker }}</h4>
        @endif
        <h3 class="c-block__title u-font--primary--s">
          {{ $title }}
        </h3>
        <p class="c-block__excerpt">
          @if (!empty($excerpt))
            {{ wp_trim_words($excerpt, $excerpt_length, ' &hellip;') }}
          @else
            {{ wp_trim_words($body, $excerpt_length, ' &hellip;') }}
          @endif
        </p>
      </div>
      <div class="c-block__date">
        <time class="u-font--s" datetime="{{ $date_formatted }}">{{ $date }}</time>
      </div>
    </div>
  </a>
  <a href="{{ $link }}" class="c-block__button u-padding--half u-font--secondary--s">Read More<span class="u-icon u-icon--s">@include('patterns.icons.o-arrow--short')</span></a>
</div>
