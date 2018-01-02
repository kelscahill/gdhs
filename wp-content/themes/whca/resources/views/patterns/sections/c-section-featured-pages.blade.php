@if (have_rows('featured_pages'))
  <section class="l-container c-section c-section__featured-pages u-spacing">
    <h3 class="u-font--primary--s u-color--white">Public Pool</h3>
    <div class="l-grid l-grid--3-col">
      @while (have_rows('featured_pages'))
        @php
          the_row();
          $pages = get_sub_field('featured_page');
        @endphp
        @foreach ($pages as $page)
          @php
            $id = $page->ID;
            $link = $page->guid;
            $title = $page->post_title;
            $excerpt = $page->post_excerpt;
          @endphp
          <a href="{{ $link }}" class="l-grid-item u-spacing">
            <h2 class="u-font--primary--l">{{ $title }}</span>
            <p class="u-font--s">{{ $excerpt }}</p>
          </a>
        @endforeach
      @endwhile
    </div>
  </section>
@endif
