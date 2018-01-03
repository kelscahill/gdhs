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
    © 2017 Greene-Dreher Historical Society.
  </div>
  <?php the_field('footer_annual_report', 'option'); ?>
  https://www.facebook.com/peggybancrofthall/
</footer>
