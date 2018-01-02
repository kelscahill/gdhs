<article @php(post_class('c-article l-narrow u-spacing'))>
  <header>
    <h2 class="o-entry-title"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
    @include('partials/entry-meta')
  </header>
  <div class="o-entry-summary">
    @php(the_excerpt())
  </div>
</article>
