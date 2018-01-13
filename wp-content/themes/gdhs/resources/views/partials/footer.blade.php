<footer class="c-footer l-container u-background-color--black">
  <div class="c-footer--inner l-narrow l-narrow--l u-spacing--double">
    <div class="c-footer__links u-spacing--double">
      <div class="c-footer__question u-spacing">
        <h3 class="u-font--xl u-color--white">Have a question?</h3>
        <p class="u-color--gray">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut molestie nunc magna, eu posuere nisi fermentum nec.</p>
        <p><a href="/contact" class="u-link--cta u-link--white">Get in touch<span class="u-icon u-icon--m u-path-fill--white">@include('patterns.icons.o-arrow--short')</span></a></p>
      </div>
      <div class="c-footer__nav u-spacing">
        <h3 class="u-font--xl u-color--white">Navigate</h3>
        @php
        wp_nav_menu( array(
          'theme_location' => 'footer_navigation',
          'menu_class' => 'c-footer__nav-list',
          'depth' => 1
        ));
        @endphp
      </div>
    </div>
    <div class="c-footer__social">
      <a href="https://www.facebook.com/peggybancrofthall/" target="_blank"><span class="u-icon u-icon--s u-path-fill--white u-link--white">@include('patterns.icons.o-icon--facebook')<span></a>
    </div>
    <div class="c-footer__copyright">
      <div class="c-footer__annual-report">
        @if (get_field('footer_annual_report', 'option'))
          <a href="{{ the_field('footer_annual_report', 'option') }}" class="u-link--white u-font--secondary--xs">Annual Report</a>
        @endif
      </div>
      <div class="c-footer__rights u-font--secondary--xs u-color--gray">
        All Rights Reserved / Copyright 2017
      </div>
      <div class="c-footer__credit u-font--secondary--xs u-color--gray">
        Design & Code: <a class="u-link--white" href="http://cahillscreative.com" target="_blank">Cahill's Creative</a>
      </div>
      <div class="c-footer__affiliate u-path-fill--gray">
        @include('patterns.icons.c-logo--amazon-smile')
      </div>
    </div>
    <div class="c-footer__scroll">
      <a href="#top" class="u-link--cta u-link--white">To Top<span class="u-icon u-icon--l u-path-fill--white">@include('patterns.icons.o-arrow--long')</span></a>
    </div>
  </div>
</footer>
