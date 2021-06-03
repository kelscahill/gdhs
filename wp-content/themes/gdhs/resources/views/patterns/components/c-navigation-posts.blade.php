@php
  $prev_post = get_previous_post();
  $next_post = get_next_post();
@endphp
<div class="c-article__nav">
  <div class="c-article__nav--inner">
    @if (!empty($prev_post))
      @php
        $prev_link = $prev_post->guid;
        $prev_title = $prev_post->post_title;
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
    @if (!empty($next_post))
      @php
        $next_link = $next_post->guid;
        $next_title = $next_post->post_title;
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
