<div class="c-block c-block__default u-border">
  <div class="l-grid @if($thumb_id){{ 'l-grid--50-50' }}@endif">
    @if (!empty($thumb_id))
      <a href="{{ $link }}" class="l-grid-item c-block__media u-background-image--{{ $thumb_id }} u-background--cover">
        <style>
          .u-background-image--{{ $thumb_id }} {
            background-image: url({{ $img_s }});
          }
          @media (min-width: 500px) {
            .u-background-image--{{ $thumb_id }} {
              background-image: url({{ $img_m }});
            }
          }
        </style>
      </a>
    @endif
    <a href="{{ $link }}" class="l-grid-item c-block__content u-spacing u-padding @if(empty($link)){{ 'disable-link' }}@endif" target="_blank">
      <div class="c-block__header u-spacing">
        <h3 class="c-block__title">{!! $title !!}</h3>
        @if(!empty($excerpt))
          <p class="c-block__excerpt">{!! wp_trim_words($excerpt, 100, '...') !!}</p>
        @endif
      </div>
      @if ($link)
        <span class="u-link--cta">View More<span class="u-icon u-icon--m u-path-fill--secondary">@include('patterns.icons.o-arrow--short')</span></span>
      @endif
    </a>
  </div>
</div>
