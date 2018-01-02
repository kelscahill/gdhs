@php // Get RSS Feed(s)
  include_once(ABSPATH . WPINC . '/feed.php');

  // Get a SimplePie feed object from the specified feed source.
  $rss = fetch_feed('http://abcnews.go.com/abcnews/mostreadstories');
  $maxitems = 0;

  if (!is_wp_error($rss)): // Checks that the object is created correctly
    // Figure out how many total items there are, but limit it to 5.
    $maxitems = $rss->get_item_quantity(4);

    // Build an array of all the items, starting with element 0 (first element).
    $rss_items = $rss->get_items(0, $maxitems);
  endif;
@endphp
<section class="l-container c-section c-section__public-pool u-background-color--primary u-color--white u-spacing">
  <h3 class="u-font--primary--s u-color--white">Public Pool</h3>
  @if ($maxitems == 0)
    <p class="u-font--s">No Items</p>
  @else
    <div class="l-grid l-grid--4-col">
      @foreach ($rss_items as $item)
        @php
          $link = $item->get_permalink();
          $title = $item->get_title();

          // Get post date and print by minutes, days, months, or years.
          $today = date_create(date('D, d M Y H:i:s'));
          $post_date = date_create($item->get_date('D, d M Y H:i:s'));
          $date = date_diff($post_date,$today);

          if ($date->format("%h") < 1) {
            $date = $date->format("%i" . "m");
          }
          elseif ($date->format("%h") < 24) {
            $date = $date->format("%h" . "h");
          }
          elseif ($date->format("%a") <= 31) {
            $date = $date->format("%a" . "d");
          }
          elseif ($date->format("%a") > 31) {
            $date = $date->format("%m" . "month");
          }
          elseif ($date->format("%m") > 12) {
            $date = $date->format("%y" . "y");
          }
        @endphp
        <a href="{{ $link }}" class="l-grid-item">
          <span class="u-color--white">{{ $date }}</span>
          <span class="u-color--gray-light">{{ $title }}</span>
        </a>
      @endforeach
    </div>
  @endif
</section>
