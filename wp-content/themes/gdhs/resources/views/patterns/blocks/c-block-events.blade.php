@php
  date_default_timezone_set('America/New_York');
  $id = get_the_ID();
  $title = get_the_title($id);
  $body = strip_tags(get_the_content());
  $body = strip_shortcodes($body);
  $excerpt = get_the_excerpt($id);
  $excerpt_length = 30;
  $thumb_id = get_post_thumbnail_id($id);
  $link = get_permalink($id);
  $disable_link = get_field('disable_link', $id);
  $location = get_field('event_location', $id);

  $date_override = get_field('event_date_override', false, false);
  $start_date = get_field('event_start_date', false, false);
  $start_date = new DateTime($start_date);
  $start_date_formatted = $start_date->format('F j, Y');
  $start_time = $start_date->format('g:ia');
  $end_date = get_field('event_end_date', false, false);
  if ($end_date) {
    $end_date = new DateTime($end_date);
    $end_date_formatted = $end_date->format('F j, Y');
    $end_time = $end_date->format('g:ia');
  }

  $date_month = $start_date->format('M');
  $date_day = $start_date->format('l');
  $date_date = $start_date->format('d');

  // Find date time now
  $date_now = date('Y-m-d 00:00:00', mktime(date('H'),date('i'),date('s'), date('m'),date('d')-1,date('Y')));
  if (get_field('event_start_date', false, false) >= $date_now) {
    $kicker = 'Upcoming Event';
  } else {
    $kicker = 'Past Event';
  }
@endphp
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
            <h4 class="c-block__kicker o-kicker u-font--secondary--s u-color--primary">{!! $kicker !!}</h4>
          @endif
          <h3 class="c-block__title u-font--primary--s">
            {!! $title !!}
          </h3>
          <span class="u-font--s">
            @if($date_override)
              {{ $date_override }}
            @else
              {{ $start_date_formatted }}, @if(!empty($start_time)){{ $start_time }}@endif
              @if(!empty($end_time))
                @if($start_date_formatted != $end_date_formatted)
                  {{ ' to ' . $end_date_formatted . ', ' . $end_time }}
                @else
                  {{ ' to ' . $end_time }}
                @endif
              @endif
            @endif
            @if($location){{ '- ' . $location }}@endif
          </span>
        </div>
        @if (!empty($excerpt))
          <p class="c-block__excerpt">
            {!! wp_trim_words($excerpt, $excerpt_length, ' ...') !!}
          </p>
        @elseif (!empty($body))
          <p class="c-block__excerpt">
            {!! wp_trim_words($body, $excerpt_length, ' ...') !!}
          </p>
        @endif
      </div>
      <span class="u-icon u-icon--l u-path-fill--black">@include('patterns.icons.o-arrow--long')</span>
    </div>
  </a>
</div>
