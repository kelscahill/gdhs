<h1 class="hero__content-title page-title font--primary--l">
  @if (get_field('display_title', $post->ID))
    {{ the_field('display_title', $post->ID) }}
  @else
    {!! App\title() !!}
  @endif
</h1>
