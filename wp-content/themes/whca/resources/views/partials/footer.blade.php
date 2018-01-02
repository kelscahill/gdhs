<footer class="c-footer l-container">
  <div class="c-footer__nav">
    @php
    wp_nav_menu( array(
      'theme_location' => 'footer_navigation',
      'menu_class' => 'c-footer-nav',
      'depth' => 1
    ));
    @endphp
  </div>
  <div class="c-footer__copyright u-font--s u-color--gray">
    © 2017 White House Correspondents' Association.
  </div>
</footer>
