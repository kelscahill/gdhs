@php
  $thumb_id = get_post_thumbnail_id();
  $id = $post->ID;
  $class_background = '';
  $class_overlay = '';
  $class_alignment = '';
  if (is_home()) {
    $id = get_queried_object_id();
  }
  if (is_front_page()) {
    $class_background = ' height--vh background--cover background-image--'.$thumb_id;
  }
  if (!is_page_template("views/template-landing.blade.php")) {
    $class_overlay = 'overlay';
    $class_alignment = ' hero__header--center';
  } else {
    $class_overlay = 'overlay--bottom';
    $class_alignment = ' hero__header--left';
  }
@endphp
<div class="hero">
  <div class="hero--inner{{ $class_background }}">
    @if (is_front_page())
      <style>
        .background-image--{{ $thumb_id }} {
          background-image: url({{ wp_get_attachment_image_src($thumb_id, "flex-height--m")[0] }});
        }
        @media (min-width: 700px) {
          .background-image--{{ $thumb_id }} {
            background-image: url({{ wp_get_attachment_image_src($thumb_id, "flex-height--l")[0] }});
          }
        }
        @media (min-width: 1100px) {
          .background-image--{{ $thumb_id }} {
            background-image: url({{ wp_get_attachment_image_src($thumb_id, "flex-height--xl")[0] }});
          }
        }
      </style>
    @else
      <picture class="hero__image">
        <!--[if IE 9]><video style="display: none"><![endif]-->
        <source srcset="{{ wp_get_attachment_image_src($thumb_id, "featured__hero--xl")[0] }}" media="(min-width: 1100px)">
        <source srcset="{{ wp_get_attachment_image_src($thumb_id, "featured__hero--l")[0] }}" media="(min-width: 800px)">
        <source srcset="{{ wp_get_attachment_image_src($thumb_id, "featured__hero--m")[0] }}" media="(min-width: 500px)">
        <!--[if IE 9]></video><![endif]-->
        <img src="{{ wp_get_attachment_image_src($thumb_id, "featured__hero--s")[0] }}" alt="{{ get_post_meta($thumb_id, '_wp_attachment_image_alt', true) }}" />
      </picture>
    @endif
    <div class="hero__header page-header {{ $class_overlay }}">
      <div class="hero__header--inner layout-container color--white spacing--quarter {{ $class_alignment }}">
        <h1 class="page-header__title">
          @if (get_field('display_title', $id))
            {{ the_field('display_title', $id) }}
          @else
            {!! App\title() !!}
          @endif
        </h1>
        @if (get_field('intro', $id))
          <p class="page-header__subtitle">{{ the_field('intro', $id) }}</p>
        @endif
        @if (get_field('link_url', $id) && get_field('link_text', $id))
          <a href="{{ the_field('link_url', $id) }}" class="page-header__link link--cta font--s">{{ the_field('link_text', $id) }}<span class="icon icon--s space--half-left">@include('patterns.icon--cta-arrow')</span></a>
        @endif
      </div>
    </div>
  </div>
</div>
