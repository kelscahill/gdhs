<header class="header layout-container js-this">
  <div class="header--left">
    @include('partials.navigation')
  </div>
  <div class="header--right">
    @if (has_nav_menu('secondary_navigation'))
      <nav class="nav__secondary" role="navigation">
        @php
          $menu_name = 'secondary_navigation';
          $menu_locations = get_nav_menu_locations();
          $menu = wp_get_nav_menu_object( $menu_locations[ $menu_name ] );
          $secondary_nav = wp_get_nav_menu_items( $menu->term_id);
          $count = 0;
          $submenu = false;
        @endphp
        <ul class="secondary-nav__list">
          @php
            $secondary_nav = json_decode(json_encode($secondary_nav), true);
          @endphp

          @foreach ($secondary_nav as $nav)
            @if (isset($secondary_nav[$count + 1]))
              @php
                $parent = $secondary_nav[$count + 1]['menu_item_parent'];
              @endphp
            @endif
            @if (!$nav['menu_item_parent'])
              @php($parent_id = $nav['ID'])
              <li class="secondary-nav__list-item js-this">
                <div class="secondary-nav__toggle">
                  <a href="{{ $nav['url'] }}" title="{{ $nav['title'] }}" class="secondary-nav__link font--s font-weight--800">{{ $nav['title'] }}</a>
                  <span class="js-toggle" data-prefix="secondary-nav__list-item" data-toggled="this"></span>
                </div>
            @endif
            @if ($parent_id == $nav['menu_item_parent'])
              @if (!$submenu)
                @php($submenu = true)
                <ul class="subnav__list">
              @endif
                <li class="subnav__list-item">
                  <a href="{{ $nav['url'] }}" class="subnav__link">{{ $nav['title'] }}</a>
                </li>
                @if ($parent != $parent_id && $submenu)
                  </ul>
                  @php($submenu = false)
                @endif
            @endif
            @if ($parent != $parent_id)
              </li>
              @php($submenu = false)
            @endif
            @php($count++)
          @endforeach
          @php(wp_reset_postdata())
        </ul>
      </nav>
    @endif
  </div>
</header>
