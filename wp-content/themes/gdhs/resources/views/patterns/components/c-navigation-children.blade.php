<ul class="c-secondary-nav__list">
  @php
    $args = array(
      'child_of' => $id,
      'parent' => $id,
      'sort_column' => 'menu_order',
      'sort_order' => 'ASC',
      'hierarchical' => 0,
    );
    $pages = get_pages($args);
  @endphp
  @if ($pages)
    @foreach ($pages as $page)
      <li class="c-secondary-nav__list-item">
        <a href="{{ $page->guid }}" class="c-secondary-nav__link u-font--xl">{{ $page->post_title }}</a>
      </li>
    @endforeach
  @endif
</ul>
