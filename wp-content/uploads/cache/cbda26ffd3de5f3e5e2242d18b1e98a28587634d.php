<div class="c-utility l-container">
  <div class="c-utility--left">
    <div class="c-utility__social-icons">
      <a href="https://www.facebook.com/peggybancrofthall/" target="_blank"><span class="u-icon u-icon--s u-path-fill--gray"><?php echo $__env->make('patterns.icons.o-icon--facebook', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?><span></a>
      <a href="https://www.youtube.com/@greene-dreherhistoricalsoc7326" target="_blank"><span class="u-icon u-icon--s u-path-fill--gray"><?php echo $__env->make('patterns.icons.o-icon--youtube', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?><span></a>
    </div>
    <div class="c-utility__newsletter u-hide-until--m">
      <a href="http://eepurl.com/dg-F85" target="_blank" class="u-font--secondary--xs u-color--gray">Join Our Mailing List</a>
    </div>
  </div>
  <div class="c-utility__search c-utility--right">
    <?php echo $__env->make('patterns.forms.c-form-search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
</div>
<header class="c-header l-container js-this u-background-color--primary js-sticky">
  <div class="c-header--left">
    <a href="/" class="c-logo">
      <?php echo $__env->make('patterns.icons.c-logo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </a>
  </div>
  <div class="c-header--right">
    <?php echo $__env->make('partials.navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
</header>
