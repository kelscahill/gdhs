<form action="/" method="get" class="search-form js-hover">
  <input placeholder="search" type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
  <button><span class="icon icon--s">@include('patterns.icon--search')</span></button>
</form>
