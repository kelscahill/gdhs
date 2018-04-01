@php($id = get_queried_object_id())
<ul class="c-secondary-nav__list">
  <li class="c-secondary-nav__list-item">
    <a href="{{ get_permalink($id) }}?orderby=date&order=DESC" class="filter-link c-secondary-nav__link">By Newer Posts</a>
  </li>
  <li class="c-secondary-nav__list-item">
    <a href="{{ get_permalink($id) }}?orderby=date&order=ASC" class="filter-link c-secondary-nav__link">By Older Posts</a>
  </li>
  <li class="c-secondary-nav__list-item">
    <a href="{{ get_permalink($id) }}?orderby=title&order=ASC" class="filter-link c-secondary-nav__link">By Title</a>
  </li>
  @if(is_page_template('views/template-exhibitions.blade.php'))
    <li class="c-secondary-nav__list-item">
      <select class="o-filter-select">
        <option>By Category</option>
        @php
          $args_cat = [
            'taxonomy' => 'exhibit_category',
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => 0,
          ];
          $categories = get_terms($args_cat);
          if (!empty($categories)):
            foreach ($categories as $category):
              $args = [
                'post_type' => 'exhibit',
                'posts_per_page' => -1,
                'order' => 'ASC',
                'orderby' => 'title',
                'cat' => $category->term_id
              ];
              echo '<option data-filter="?category=' . $category->slug . '">' . $category->name . '</option>';
            endforeach;
          endif;
        @endphp
      </select>
    </li>
  @endif
</ul>
