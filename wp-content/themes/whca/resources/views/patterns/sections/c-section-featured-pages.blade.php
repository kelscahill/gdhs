@php($featured_pages = get_field('featured_pages'))
@if ($featured_pages)
  <section class="l-container c-section c-section__featured-pages u-spacing">
    <div class="l-grid l-grid--3-col">
      @foreach ($featured_pages as $page)
        @php
          $id = $page->ID;
          $link = $page->guid;
          $excerpt = $page->post_excerpt;

          if (get_field('display_title', $id)) {
            $title = get_field('display_title', $id);
          } else {
            $title = $page->post_title;
          }
        @endphp
        <a href="{{ $link }}" class="l-grid-item u-spacing">
          <h2 class="u-font--primary--l u-color--black u-text-align--center">{{ $title }}</h2>
          <p class="u-font--s u-text-align--left">{{ $excerpt }}</p>
        </a>
      @endforeach
    </div>
  </section>
@endif
