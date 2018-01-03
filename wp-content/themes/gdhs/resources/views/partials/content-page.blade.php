@include('patterns.sections.c-section-hero')
<div class="l-container">
  <article @php(post_class('c-article l-narrow l-narrow--l u-spacing--double'))>
    @php(the_content())
  </article>
</div>
@include('patterns.sections.c-section-officers')
@include('patterns.sections.c-section-promotion')
@if (is_page('scholarships'))
  @include('patterns.sections.c-section-winners')
@endif
