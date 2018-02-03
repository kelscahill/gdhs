@php($gallery = get_field('gallery'))
@if($gallery)
  <div class="l-narrow c-gallery l-grid--photos">
    @foreach($gallery as $image)
      @php
        $width = $image['width'];
        $height = $image['height'];
        $thumb_size = '';
        if ($width > $height) {
          $thumb_size = 'horiz-thumb';
        } else {
          $thumb_size = 'vert-thumb';
        }
      @endphp
      <div class="l-grid-item">
        <a href="{{ $image['url'] }}" title="{{ $image['caption'] }}" class="c-gallery__image-link">
          <picture class="c-gallery__image">
            <!--[if IE 9]><video style="display: none"><![endif]-->
            <source srcset="{{ $image['sizes'][$thumb_size] }}" media="(min-width: 500px)">
            <!--[if IE 9]></video><![endif]-->
            <img src="{{ $image['sizes'][$thumb_size] }}" alt="{{ $image['alt'] }}" />
          </picture>
        </a>
      </div>
    @endforeach
  </div>
@endif
