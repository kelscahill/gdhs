@include('partials.page-header')
<article @php(post_class('c-article l-container l-narrow l-narrow--l'))>
  <div class="c-article__body u-spacing--double">
    @php(the_content())
  </div>
</article>
