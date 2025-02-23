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
    <div class="c-nav__primary-toggle c-nav__toggle toggle js-toggle-parent">
      <span class="c-nav__toggle-span c-nav__toggle-span--1"></span>
      <span class="c-nav__toggle-span c-nav__toggle-span--2"></span>
      <span class="c-nav__toggle-span c-nav__toggle-span--3"></span>
      <span class="c-nav__toggle-span c-nav__toggle-span--4 u-font-weight--800"></span>
    </div>
    <ul class="c-primary-nav__list">
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
          @php $parent_id = $nav['ID'] @endphp
          <li class="c-primary-nav__list-item js-this">
            <div class="c-primary-nav__list-toggle">
              <a href="{{ $nav['url'] }}" title="{!! $nav['title'] !!}" class="c-primary-nav__list-link u-font--secondary--s">{!! $nav['title'] !!}</a>
              <span class="u-icon u-icon--xs js-toggle" data-toggled="this">@include('patterns.icons.o-arrow--small')</span>
            </div>
        @endif
        @if ($parent_id == $nav['menu_item_parent'])
          @if (!$submenu)
            @php $submenu = true @endphp
            <ul class="c-sub-nav__list">
          @endif
              <li class="c-sub-nav__list-item">
                <a href="{{ $nav['url'] }}" class="c-sub-nav__list-link">{!! $nav['title'] !!}</a>
              </li>
          @if ($parent != $parent_id && $submenu)
            </ul>
            @php $submenu = false @endphp
          @endif
        @endif
        @if ($parent != $parent_id)
          </li>
          @php $submenu = false @endphp
        @endif
        @php $count++ @endphp
      @endforeach
      @php wp_reset_postdata() @endphp
    </ul>
  </nav>
@endif
