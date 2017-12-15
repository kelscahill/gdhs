@if (has_nav_menu('primary_navigation'))
  <nav class="nav__primary" role="navigation">
    @php
      $menu_name = 'primary_navigation';
      $menu_locations = get_nav_menu_locations();
      $menu = wp_get_nav_menu_object( $menu_locations[ $menu_name ] );
      $primary_nav = wp_get_nav_menu_items( $menu->term_id);
      $count = 0;
      $submenu = false;
    @endphp
    <div class="nav__primary-branding">
      <a href="/" class="nav__primary-logo">
        <span class="logo-text">White House</span>
        <span class="logo-text">Correspondents'</span>
        <span class="logo-text">Assocation</span>
      </a>
      <span class="nav__primary-toggle js-toggle" data-prefix="this" data-toggled="header">Menu</span>
    </div>
    <ul class="primary-nav__list has-fade-in-border">
      @php
        $primary_nav = json_decode(json_encode($primary_nav), true);
      @endphp
      @foreach ($primary_nav as $nav)
        @if (isset($primary_nav[$count + 1]))
          @php
            $parent = $primary_nav[$count + 1]['menu_item_parent'];
          @endphp
        @endif
        @if (!$nav['menu_item_parent'])
          @php($parent_id = $nav['ID'])
          <li class="primary-nav__list-item has-fade-in-text js-hover js-toggle">
            <a href="{{ $nav['url'] }}" title="{{ $nav['title'] }}" class="primary-nav__list-link font--primary--m"><spam></span>{{ $nav['title'] }}</a>
        @endif
        @if ($parent_id == $nav['menu_item_parent'])
          @if (!$submenu)
            @php($submenu = true)
            <ul class="sub-nav__list has-fade-in-border">
          @endif
            <li class="sub-nav__list-item has-fade-in-text">
              <a href="{{ $nav['url'] }}" class="sub-nav__list-link font--primary--m"><span></span>{{ $nav['title'] }}</a>
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
