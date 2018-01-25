<div class="c-block c-block-events u-background-color--white u-border--black">
  <a href="{{ $link }}" class="c-block__link @if($disable_link == true){{ 'disable' }}@endif">
    <div class="c-block__day u-background-color--black u-color--gray" data-content="{{ $date_day }}"></div>
    <div class="c-block__date">
      <span class="u-font--secondary--s">{{ $date_month }}</span>
      <span class="u-font--primary--l">{{ $date_date }}</span>
    </div>
    @if (!empty($thumb_id))
      <div class="c-block__media u-background--cover u-background-image--{{ $thumb_id }}">
        <style>
          .u-background-image--{{ $thumb_id }} {
            background-image: url({{ wp_get_attachment_image_src($thumb_id, "horiz__4x3--s")[0] }});
          }
        </style>
      </div>
    @endif
    <div class="c-block__content u-padding">
      <div class="c-block__header u-spacing">
        <div class="c-block__header u-spacing--half">
          @if ($kicker)
            <h4 class="c-block__kicker o-kicker u-font--secondary--s u-color--primary">{{ $kicker }}</h4>
          @endif
          <h3 class="c-block__title u-font--primary--s">
            {{ $title }}
          </h3>
          <span class="u-font--s">
            {{ $date }}, @if(!empty($start_time)){{ $start_time }}@endif
            @if(!empty($end_time)){{ ' to ' . $end_time }}@endif
            @if($location){{ '- ' . $location }}@endif
          </span>
        </div>
        @if (!empty($excerpt))
          <p class="c-block__excerpt">
            {{ wp_trim_words($excerpt, $excerpt_length, ' &hellip;') }}
          </p>
        @elseif (!empty($body))
          <p class="c-block__excerpt">
            {{ wp_trim_words($body, $excerpt_length, ' &hellip;') }}
          </p>
        @endif
      </div>
      <span class="u-icon u-icon--l u-path-fill--black">@include('patterns.icons.o-arrow--long')</span>
    </div>
  </a>
</div>
