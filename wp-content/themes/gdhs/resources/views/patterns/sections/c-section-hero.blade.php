@php
  $id = get_queried_object_id();
  $thumb_id = get_post_thumbnail_id($id);
  if ($thumb_id) {
    $classes = 'c-section-hero--tall u-overlay u-background--cover u-background-image--' . $thumb_id;
  } else {
    $classes = 'c-section-hero--short u-background-color--secondary';
  }
  if (get_field('display_title', $id)) {
    $title = get_field('display_title', $id);
    $description = get_field('intro', $id);
    $link_text = get_field('cta_text', $id);
    $link_url = get_field('cta_link', $id);
  } else {
    $title = get_the_title($id);
  }
@endphp
<section class="c-section c-section-hero u-padding--zero {{ $classes }}">
  <style>
    .u-background-image--{{ $thumb_id }} {
      background-image: url({{ wp_get_attachment_image_src($thumb_id, "featured__hero--s")[0] }});
    }
    @media (min-width: 500px) {
      .u-background-image--{{ $thumb_id }} {
        background-image: url({{ wp_get_attachment_image_src($thumb_id, "featured__hero--m")[0] }});
      }
    }
    @media (min-width: 800px) {
      .u-background-image--{{ $thumb_id }} {
        background-image: url({{ wp_get_attachment_image_src($thumb_id, "featured__hero--l")[0] }});
      }
    }
    @media (min-width: 1100px) {
      .u-background-image--{{ $thumb_id }} {
        background-image: url({{ wp_get_attachment_image_src($thumb_id, "featured__hero--xl")[0] }});
      }
    }
  </style>
  <div class="c-section-hero__content u-color--white u-spacing u-text-align--center l-container l-narrow l-narrow--m">
    @if ($title)
      <h1 class="c-section-hero__content-title u-font--primary--xl">
        {{ $title }}
      </h1>
    @endif
    @if (isset($description))
      <hr class="u-hr--small u-hr--white"/>
      <div class="c-section-hero__content-description">@php echo wpautop($description); @endphp</div>
    @endif
    @if (isset($link_url))
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
</section>
