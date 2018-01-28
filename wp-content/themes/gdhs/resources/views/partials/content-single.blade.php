@include('partials.page-header')
<article @php(post_class('c-article l-narrow u-spacing--double'))>
  @php(the_content())
  {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="c-page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
</article>
