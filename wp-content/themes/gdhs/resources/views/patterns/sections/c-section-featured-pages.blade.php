@php($featured_pages = get_field('featured_pages'))
@if ($featured_pages)
  <section class="l-container c-section c-section__featured-pages u-spacing u-padding--zero">
    <div class="l-grid l-grid--3-col">
      @foreach ($featured_pages as $page)
        @php
          $id = $page->ID;
          $link = $page->guid;
          $excerpt = $page->post_excerpt;
          $thumb_id = get_post_thumbnail_id($id);

          if (get_field('display_title', $id)) {
            $title = get_field('display_title', $id);
          } else {
            $title = $page->post_title;
          }
        @endphp
        <a href="{{ $link }}" class="l-grid-item c-block-featured-page c-block u-overlay">
          @if ($thumb_id)
            <div class="c-block__media u-background--cover u-background-image--{{ $thumb_id }} u-background-color--secondary">
              <style>
                .u-background-image--{{ $thumb_id }} {
                  background-image: url({{ wp_get_attachment_image_src($thumb_id, "vert__4x3--s")[0] }});
                }
                @media (min-width: 600px) {
                  .u-background-image--{{ $thumb_id }} {
                    background-image: url({{ wp_get_attachment_image_src($thumb_id, "vert__4x3--m")[0] }});
                  }
                }
              </style>
            </div>
          @endif
          <div class="c-block__content u-spacing u-padding--double">
            <div class="u-block__header u-spacing">
              <h2 class="u-font--secondary--s u-color--tan">{{ $title }}</h2>
              @if ($excerpt)
                <p class="u-font--primary--l u-color--white">{{ $excerpt }}</p>
              @endif
            </div>
            <div class="u-block__link">
              <span class="o-button u-button--outline">Learn More</span>
            </div>
          </div><!-- ./c-block -->
        </a>
      @endforeach
    </div>
  </section>
@endif
