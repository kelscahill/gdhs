<div class="c-page-title">
  <h1 class="c-hero__content-title c-page-title u-font--primary--l">
    @if (get_field('display_title', $post->ID))
      {{ the_field('display_title', $post->ID) }}
    @else
      {!! App\title() !!}
    @endif
  </h1>
</div>
