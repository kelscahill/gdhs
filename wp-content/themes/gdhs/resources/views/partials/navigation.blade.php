@if (has_nav_menu('primary_navigation'))
  <nav class="c-nav__primary" role="navigation">
    @php
      $menu_name = 'primary_navigation';
      $menu_locations = get_nav_menu_locations();
      $menu = wp_get_nav_menu_object( $menu_locations[ $menu_name ] );
      $primary_nav = wp_get_nav_menu_items( $menu->term_id);
      $count = 0;
      $submenu = false;
    @endphp
    <div class="c-nav__primary-toggle">
      <div class="c-nav__toggle toggle js-toggle-parent">
        <span class="c-nav__toggle-span c-nav__toggle-span--1"></span>
        <span class="c-nav__toggle-span c-nav__toggle-span--2"></span>
        <span class="c-nav__toggle-span c-nav__toggle-span--3"></span>
        <span class="c-nav__toggle-span c-nav__toggle-span--4 u-font-weight--800"></span>
      </div>
    </div>
    <ul class="c-primary-nav__list has-fade-in-border">
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
          <li class="c-primary-nav__list-item has-fade-in-text js-hover js-toggle">
            <a href="{{ $nav['url'] }}" title="{{ $nav['title'] }}" class="c-primary-nav__list-link"><span></span>{{ $nav['title'] }}</a>
        @endif
        @if ($parent_id == $nav['menu_item_parent'])
          @if (!$submenu)
            @php($submenu = true)
            <ul class="c-sub-nav__list has-fade-in-border">
          @endif
            <li class="c-sub-nav__list-item has-fade-in-text">
              <a href="{{ $nav['url'] }}" class="c-sub-nav__list-link"><span></span>{{ $nav['title'] }}</a>
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
