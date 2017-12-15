<header class="header layout-container js-this">
  <div class="header--left">
    @include('partials.navigation')
  </div>
  <div class="header--right">
    @if (has_nav_menu('secondary_navigation'))
      <nav class="nav__secondary" role="navigation">
        @php
        wp_nav_menu( array(
          'theme_location' => 'secondary_navigation',
          'menu_class' => 'secondary-nav__list',
          'depth' => 1
        ));
        @endphp
      </nav>
    @endif
  </div>
</header>
