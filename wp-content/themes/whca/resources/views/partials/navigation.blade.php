@if (has_nav_menu('primary_navigation'))
  <nav class="nav__primary js-this" role="navigation">
    @php
      $menu_locations = get_nav_menu_locations();
      $menu_id = $menu_locations['primary_navigation'];
      $primary_nav = wp_get_nav_menu_items($menu_id);
      $count = 0;
      $submenu = false;
    @endphp
    <div class="nav__primary-branding">
      <a href="/" class="nav__primary-logo">
        <span class="logo-text">White House</span>
        <span class="logo-text">Correspondents'</span>
        <span class="logo-text">Assocation</span>
      </a>
      <span class="nav__primary-toggle js-toggle" data-prefix="this" data-toggled="nav__primary">Menu</span>
    </div>
    <ul class="primary-nav__list">
      @foreach ($primary_nav as $nav)
        @php
          if (!$nav->menu_item_parent) {
            $parent_id = $nav->ID;
            echo '<li class="primary-nav__list-item js-hover"><a href="'.$nav->url.'" title="'.$nav->title.'" class="primary-nav__list-link font--primary--m"><span></span>'.$nav->title.'</a>';
          }
        @endphp
        @if ($parent_id == $nav->menu_item_parent)
          @if (!$submenu)
            @php($submenu = true)
            <ul class="subnav__list">
            @endif
              <li class="subnav__list-item">
                <a href="{{ $nav->url }}" class="subnav__link font--primary--m"><span></span>{{ $nav->title }}</a>
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
