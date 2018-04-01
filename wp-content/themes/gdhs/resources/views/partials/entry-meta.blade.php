<div class="o-meta u-font--s">
  @if (is_singular('events'))
    @php
      date_default_timezone_set('US/Eastern');
      $id = get_the_ID();
      $location = get_field('event_location', $id);
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
    @endphp
    {{ $start_date_formatted }}, @if(!empty($start_time)){{ $start_time }}@endif
    @if(!empty($end_time))
      @if($start_date_formatted != $end_date_formatted)
        {{ ' to ' . $end_date_formatted . ', ' . $end_time }}
      @else
        {{ ' to ' . $end_time }}
      @endif
    @endif
    @if($location){{ '- ' . $location }}@endif
  @else
    @if (get_field('hide_author') != 1)
      <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" rel="author" class="fn">{{ get_the_author_meta('display_name') }}</a><span class="o-divider">|</span>
    @endif
    <time datetime="{{ get_post_time('c', true) }}">{{ get_the_date() }}</time>
  @endif
</div>
