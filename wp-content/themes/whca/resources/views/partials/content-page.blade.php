<section class="section page-content">
  <article @php(post_class('article narrow spacing'))>
    <?php if ( function_exists('yoast_breadcrumb') ) {
  	yoast_breadcrumb('<p id="breadcrumbs">','</p>');
  } ?>
    @php(the_content())
  </article>

  @if (get_field('sidebar_title') || get_field('sidebar_body'))
    <aside class="sidebar spacing">
      <h3>{{ the_field('sidebar_title') }}</h3>
      <hr />
      <p>{{ the_field('sidebar_body') }}</p>
      @if (get_field('sidebar_link_url'))
        <a href="{{ the_field('sidebar_link_url') }}" class="btn">
          @if (get_field('sidebar_link_text'))
            {{ the_field('sidebar_link_text') }}
          @else
            Learn More
          @endif
        </a>
      @endif
    </aside>
  @endif
</section>
