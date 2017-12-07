@php
  $id = get_queried_object();
  $page_parent = $id->post_parent;
@endphp
<div class="page-header spacing">
  <div class="kicker color--gray">
    @if ($page_parent != 0)
      @if (get_field('page_icon', $page_parent))
        <span class="icon icon--s icon--{{ the_field('page_icon', $page_parent) }} space--half-right"></span>
      @endif
      <p class="font--m font-weight--700">{{ get_the_title($page_parent) }}</p>
    @endif
  </div>
  <h1 class="font--primary--l">{!! App\title() !!}</h1>
</div>
