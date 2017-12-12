@if (has_nav_menu('primary_navigation'))
  <nav class="nav__primary background-color--primary" role="navigation">
    @php
      $menu_locations = get_nav_menu_locations();
      $menu_id = $menu_locations['primary_navigation'];
      $primary_nav = wp_get_nav_menu_items($menu_id);
      $count = 0;
      $submenu = false;
    @endphp
    <div class="js-toggle-parent">
      <span>White House</span>
      <span>Correspondents'</span>
      <span>Assocation</span>
      <span>Menu</span>
    </div>
    <ul class="primary-nav__list">
      @foreach ($primary_nav as $nav)
        @php
          if (!$nav->menu_item_parent) {
            $parent_id = $nav->ID;
            echo '<li class="primary-nav__list-item js-this"><div class="primary-nav__toggle"><a href="'.$nav->url.'" title="'.$nav->title.'" class="font--s">'.$nav->title.'</a><span class="js-toggle" data-prefix="primary-nav__list-item" data-toggled="this"></span></div>';
          }
        @endphp
        @if ($parent_id == $nav->menu_item_parent)
          @if (!$submenu)
            @php($submenu = true)
            <ul class="subnav__list">
            @endif
              <li class="subnav__list-item">
                <a href="{{ $nav->url }}" class="subnav__link">{{ $nav->title }}</a>
              </li>
            @if ($primary_nav[$count + 1]->menu_item_parent != $parent_id && $submenu)
            </ul>
            @php($submenu = false)
          @endif
        @endif
        @if ($primary_nav[$count + 1]->menu_item_parent != $parent_id)
          </li>
        @php
          $submenu = false;
          endif;
          $count++;
        @endphp
      @endforeach
      @php(wp_reset_postdata())
    </ul>
  </nav>
@endif
