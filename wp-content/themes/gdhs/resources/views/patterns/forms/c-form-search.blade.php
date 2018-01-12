<form action="/" method="get" class="c-search-form">
  <input placeholder="search" type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
  <button class="u-button--search"><span class="u-icon u-icon--s">@include('patterns.icons.o-icon--search')</span></button>
</form>
