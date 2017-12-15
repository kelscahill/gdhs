@include('patterns.sections.section-hero')
<div class="layout-container">
  <article @php(post_class('article narrow narrow--l spacing'))>
    @php(the_content())
  </article>
</div>
@include('patterns.sections.section-officers')
@include('patterns.sections.section-promotion')
@if (is_page('scholarships'))
  @include('patterns.sections.section-scholarships')
@endif
