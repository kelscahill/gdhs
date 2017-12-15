<footer class="footer layout-container">
  <div class="footer__nav">
    @php
    wp_nav_menu( array(
      'theme_location' => 'footer_navigation',
      'menu_class' => 'footer-nav',
      'depth' => 1
    ));
    @endphp
  </div>
  <div class="footer__copyright font--s color--gray">
    © 2017 White House Correspondents' Association.
  </div>
</footer>
