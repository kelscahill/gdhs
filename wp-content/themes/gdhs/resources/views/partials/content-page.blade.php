<div class="l-container">
  <article @php(post_class('c-article l-narrow l-narrow--l u-spacing--double'))>
    <div class="c-page-header l-narrow l-narrow--m u-text-align--center">
      <div class="c-page-header__icon">
        <span class="u-icon u-icon--l u-path-fill--primary">@include('patterns.icons.o-icon--leaf')</span>
      </div>
      <div class="u-spacing">
        <h1 class="c-page-header__title u-font--secondary--s u-color--primary">
          @if (get_field('display_title', $post->ID))
            {{ the_field('display_title', $post->ID) }}
          @else
            {!! App\title() !!}
          @endif
        </h1>
        @if (get_field('intro', $post->ID))
          <div class="c-page-header__intro u-font--xl">{{ the_field('intro', $post->ID) }}</div>
        @endif
      </div>
    </div>
    @php(the_content())
  </article>
</div>
@include('patterns.sections.c-section-promotion')
