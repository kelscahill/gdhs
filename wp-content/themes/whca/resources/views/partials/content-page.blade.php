@include('patterns.sections.section-hero')
<article @php(post_class('article narrow narrow--l spacing'))>
  @php(the_content())
</article>
@include('patterns.sections.section-officers')
@include('patterns.sections.section-promotion')
