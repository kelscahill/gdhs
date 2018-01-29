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
</ul>
