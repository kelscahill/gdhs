@if (have_rows('slideshow'))
  <section class="c-section c-section-slideshow u-padding--zero">
    <div class="slick slick-slideshow c-slideshow">
      @while (have_rows('slideshow'))
        @php
          the_row();
          $title = get_sub_field('slideshow_title');
          $description = get_sub_field('slideshow_description');
          $link_url = get_sub_field('slideshow_cta_link');
          $link_text = get_sub_field('slideshow_cta_text');
          $thumb_id = get_sub_field('slideshow_image')['ID'];
        @endphp
        <div class="c-slideshow__slide">
          <div class="c-slideshow__image u-overlay slick-background u-background--cover u-background-image--{{ $thumb_id }}"></div>
          <style>
            .u-background-image--{{ $thumb_id }} {
              background-image: url({{ wp_get_attachment_image_src($thumb_id, "flex-height--m")[0] }});
            }
            @media (min-width: 700px) {
              .u-background-image--{{ $thumb_id }} {
                background-image: url({{ wp_get_attachment_image_src($thumb_id, "flex-height--l")[0] }});
              }
            }
            @media (min-width: 1100px) {
              .u-background-image--{{ $thumb_id }} {
                background-image: url({{ wp_get_attachment_image_src($thumb_id, "flex-height--xl")[0] }});
              }
            }
          </style>
          <div class="c-slideshow__content">
            <div class="c-slideshow__content--inner l-container u-color--white u-spacing u-text-align--center l-narrow l-narrow--m">
              @if ($title)
                <h1 class="c-slideshow__content-title u-font--primary--xl">
                  {{ $title }}
                </h1>
                <hr class="u-hr--small u-hr--white"/>
              @endif
              @if ($description)
                <div class="c-slideshow__content-description">@php echo wpautop($description); @endphp</div>
              @endif
              @if ($link_url)
                <p>
                  <a href="{{ $link_url }}" class="u-link--cta u-link--white u-center-block">
                    @if ($link_text)
                      {{ $link_text }}
                    @else
                      Learn More
                    @endif
                    <span class="u-icon u-icon--m u-path-fill--white">@include('patterns.icons.o-arrow--short')</span>
                  </a>
                </p>
              @endif
            </div>
          </div>
        </div>
      @endwhile
    </div>
  </section>
@endif
