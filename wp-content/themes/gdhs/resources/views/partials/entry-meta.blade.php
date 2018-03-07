<div class="o-meta u-font--s">
  @if (is_singular('events'))
    @php
      $id = get_the_ID();
      $location = get_field('event_location', $id);
      $start_date = get_field('event_start_date', false, false);
      $start_date = new DateTime($start_date);
      $start_time = $start_date->format('g:ia');
      $end_date = get_field('event_end_date', false, false);
      if ($end_date) {
        $end_date = new DateTime($end_date);
        $end_time = $end_date->format('g:ia');
      }
      $date = $start_date->format('F j, Y');
      $date_month = $start_date->format('M');
      $date_day = $start_date->format('l');
      $date_date = $start_date->format('d');
    @endphp
    {{ $date }}, @if(!empty($start_time)){{ $start_time }}@endif
    @if(!empty($end_time)){{ ' to ' . $end_time }}@endif
    @if($location){{ '- ' . $location }}@endif
  @else
    {{ __('By', 'sage') }} <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" rel="author" class="fn">{{ get_the_author_meta('display_name') }}</a><span class="o-divider">|</span><time datetime="{{ get_post_time('c', true) }}">{{ get_the_date() }}</time>
  @endif
</div>
