@php
  $prev_post = get_posts(array(
    'posts_per_page' => 1,
    'post_type' => 'events',
    'meta_query' => array(
      array(
        'key' => 'event_start_date',
        'compare' => '<',
        'value' => get_field('event_start_date', false, $post->id),
        'type' => 'DATETIME'
      ),
    ),
    'order' => 'DESC',
    'orderby' => 'meta_value',
    'meta_key' => 'event_start_date',
    'meta_type' => 'DATETIME'
  ));
@endphp
@php
  $next_post = get_posts(array(
    'posts_per_page' => 1,
    'post_type' => 'events',
    'meta_query' => array(
      array(
        'key' => 'event_start_date',
        'compare' => '>',
        'value' => get_field('event_start_date', false, $post->id),
        'type' => 'DATETIME'
      ),
    ),
    'order' => 'ASC',
    'orderby' => 'meta_value',
    'meta_key' => 'event_start_date',
    'meta_type' => 'DATETIME'
  ));
@endphp
<div class="c-article__nav">
  <div class="c-article__nav--inner">
    @if ($prev_post)
      @php
        $prev_link = $prev_post[0]->guid;
        $prev_title = $prev_post[0]->post_title;
      @endphp
      <a href="{!! $prev_link !!}" class="c-article__nav-item previous">
        <div class="c-article__nav-item-label u-font--secondary--s u-color--gray">
          Previous
        </div>
        <div class="u-font--l">{!! $prev_title !!}</div>
      </a>
    @endif
  </div>
  <div class="c-article__nav--inner">
    @if ($next_post)
      @php
        $next_link = $next_post[0]->guid;
        $next_title = $next_post[0]->post_title;
      @endphp
      <a href="{!! $next_link !!}" class="c-article__nav-item next u-text-align--right">
        <div class="c-article__nav-item-label u-font--secondary--s u-color--gray">
          Next
        </div>
        <div class="u-font--l">{!! $next_title !!}</div>
      </a>
    @endif
  </div>
</div>
