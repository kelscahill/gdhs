@php
  $id = get_the_ID();
  $title = get_the_title($id);
  $body = strip_tags(get_the_content());
  $body = strip_shortcodes($body);
  $excerpt = get_the_excerpt($id);
  $excerpt_length = 14;
  $thumb_id = get_post_thumbnail_id($id);
  $link = get_permalink($id);
  $date = get_the_date('F j, Y');
  $date_formatted = get_the_date('c');
  $category = get_the_category();
  if ($category) {
    if (class_exists('WPSEO_Primary_Term')) {
      $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
      $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
      $term = get_term($wpseo_primary_term);
      if (is_wp_error($term)) {
        $kicker = $category[0]->name;
      } else {
        $kicker = $term->name;
      }
    }
    else {
      $kicker = $category[0]->name;
    }
  } elseif (get_post_type($id)) {
    $kicker = get_post_type($id);
  } else {
    $kicker = 'Page';
  }
@endphp
<div class="c-block c-block-news u-background-color--tan u-border @if ($thumb_id){{ 'has-hover' }}@endif">
  <a href="{{ $link }}" class="c-block__link">
    @if ($thumb_id)
      <div class="c-block__media">
        <picture class="c-block__thumb">
          <img src="{{ wp_get_attachment_image_src($thumb_id, "horiz__4x3--s")[0] }}" alt="{{ get_post_meta($thumb_id, '_wp_attachment_image_alt', true) }}">
        </picture>
      </div>
    @endif
    <div class="c-block__content u-padding--half u-spacing">
      <div class="c-block__header u-spacing--half">
        @if (!empty($kicker))
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