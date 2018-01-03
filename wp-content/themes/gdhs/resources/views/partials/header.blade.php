<header class="c-header l-container js-this">
  <div class="c-header--left">
    @include('partials.navigation')
  </div>
  <div class="c-header--right">
    @if (has_nav_menu('secondary_navigation'))
      <nav class="c-nav__secondary" role="navigation">
        @php
        wp_nav_menu( array(
          'theme_location' => 'secondary_navigation',
          'menu_class' => 'c-secondary-nav__list',
          'depth' => 1
        ));
        @endphp
      </nav>
    @endif
  </div>
</header>
