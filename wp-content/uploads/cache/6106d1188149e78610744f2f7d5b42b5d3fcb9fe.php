<form action="/" method="get" class="c-search-form">
  <input placeholder="search" type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
  <button class="u-button--search"><span class="u-icon u-icon--s"><?php echo $__env->make('patterns.icons.o-icon--search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></span></button>
</form>
