<article @php(post_class('c-article l-narrow u-spacing'))>
  <header>
    <h2 class="o-entry-title"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
    @if (get_post_type() === 'post')
      @include('partials/entry-meta')
    @endif
  </header>
  <div class="o-entry-summary">
    @php(the_excerpt())
  </div>
</article>
