<footer class="c-footer l-container u-background-color--black">
  <div class="c-footer--inner l-narrow l-narrow--l u-spacing--double">
    <div class="c-footer__links u-spacing--double">
      <div class="c-footer__question u-spacing">
        <h3 class="u-font--xl u-color--white">Have a question?</h3>
        <p class="u-color--gray">Please let us know if you have a question or comment about our organization or this website.</p>
        <p><a href="/contact" class="u-link--cta u-link--white">Get in touch<span class="u-icon u-icon--m u-path-fill--white"><?php echo $__env->make('patterns.icons.o-arrow--short', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></span></a></p>
      </div>
      <div class="c-footer__nav u-spacing">
        <h3 class="u-font--xl u-color--white">Navigate</h3>
        <?php
        wp_nav_menu( array(
          'theme_location' => 'footer_navigation',
          'menu_class' => 'c-footer__nav-list',
          'depth' => 1
        ));
        ?>
      </div>
    </div>
    <div class="c-footer__social">
      <div class="c-footer__social-icons">
        <a href="https://www.facebook.com/peggybancrofthall/" target="_blank"><span class="u-icon u-icon--s u-path-fill--white u-link--white"><?php echo $__env->make('patterns.icons.o-icon--facebook', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?><span></a>
        <a href="https://www.youtube.com/@greene-dreherhistoricalsoc7326" target="_blank"><span class="u-icon u-icon--s u-path-fill--white u-link--white"><?php echo $__env->make('patterns.icons.o-icon--youtube', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?><span></a>
      </div>
    </div>
    <div class="c-footer__copyright">
      <?php if(get_field('footer_annual_report', 'option')): ?>
        <div class="c-footer__annual-report">
            <a href="<?php echo e(the_field('footer_annual_report', 'option')); ?>" class="u-link--white u-font--secondary--xs">Annual Report</a>
        </div>
      <?php endif; ?>
      <div class="c-footer__rights u-font--secondary--xs u-color--gray">
        All Rights Reserved / Copyright <?php echo e(date("Y")); ?>

      </div>
      <div class="c-footer__credit u-font--secondary--xs u-color--gray">
        Design & Code: <a class="u-link--white" href="https://cahillscreative.com" target="_blank">Cahill's Creative LLC.</a>
      </div>
      <div class="c-footer__affiliate">
        <a href="https://smile.amazon.com/" class="u-path-fill--gray" target="_blank">
          <?php echo $__env->make('patterns.icons.c-logo--amazon-smile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </a>
      </div>
    </div>
    <div class="c-footer__scroll">
      <a href="#top" class="u-link--cta u-link--white">To Top<span class="u-icon u-icon--l u-path-fill--white"><?php echo $__env->make('patterns.icons.o-arrow--long', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></span></a>
    </div>
  </div>
</footer>
