@php
  global $post;
  $id = get_queried_object_id();

  if (is_front_page()) {
    $icon = true;
    $kicker = get_field('display_title', $id);
    $title = false;
    $intro = get_field('intro', $id);
  } elseif (is_page_template('views/template-landing.blade.php')) {
    $icon = true;
    $kicker = 'In this section';
    $title = false;
    $intro = get_field('intro', $id);
    $link = get_field('cta_link', $id);
    $nav = true;
  } elseif (is_page('calendar')) {
    $icon = true;
    $kicker = 'All Upcoming Programs & Events';
    $title = false;
  } elseif (is_home() || is_page_template('views/template-exhibitions.blade.php') || is_page_template('views/template-research.blade.php') || is_page_template('views/template-shop.blade.php')) {
    $icon = true;
    $kicker = 'Refine ' . get_the_title($id);
    $title = false;
    $filter = true;
  } elseif (is_page()) {
    $breadcrumbs = true;
    $hr = true;
    $intro = get_field('intro', $id);
    $link = get_field('cta_link', $id);
    if ($post->post_parent == 0) {
      $kicker = '';
      $title = true;
    } else {
      $kicker = get_the_title($post->post_parent);
      $title = true;
    }
  } elseif (is_singular('events')) {
    $breadcrumbs = true;
    $title = true;
    $meta = true;
    // Find date time now
    date_default_timezone_set('America/New_York');
    $date_now = date('Y-m-d 24:00:00', mktime(date('H'),date('i'),date('s'), date('m'),date('d')-1,date('Y')));
    if (get_field('event_start_date', false, false) >= $date_now) {
      $kicker = 'Upcoming Event';
    } else {
      $kicker = 'Past Event';
    }
  } elseif (is_singular('exhibit')) {
    $kicker = 'Exhibition';
    $breadcrumbs = true;
    $title = true;
    $meta = true;
  } elseif (is_singular('library')) {
    $kicker = 'Research Library';
    $breadcrumbs = true;
    $title = true;
    $meta = true;
  } elseif (is_single()) {
    $breadcrumbs = true;
    $title = true;
    $meta = true;

    // SHOW YOAST PRIMARY CATEGORY, OR FIRST CATEGORY
    $category = get_the_category($id);
    // If post has a category assigned.
    if ($category) {
      $kicker = '';
      if (class_exists('WPSEO_Primary_Term')) {
        // Show the post's 'Primary' category, if this Yoast feature is available, & one is set
        $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
        $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
        $term = get_term($wpseo_primary_term);
        if (is_wp_error($term)) {
          // Default to first category (not Yoast) if an error is returned
          $kicker = $category[0]->name;
        } else {
          // Yoast Primary category
          if ($term->parent != 0) {
            $term_parent = get_term($term->parent, 'category')->name;
            $kicker = $term_parent;
          } else {
            $kicker = $term->name;
          }
        }
      } else {
        // Default, display the first category in WP's list of assigned categories
        $kicker = $category[0]->name;
      }
    }
  } elseif (is_author()) {
    $title = get_the_author() ;
    $kicker = 'Author';
  } elseif (is_archive()) {
    $title = single_cat_title("", false);
    $kicker = 'Category';
  }
@endphp
<header class="c-page-header l-container l-narrow l-narrow--l u-text-align--center u-spacing--double">
  @if (!empty($breadcrumbs))
    <div class="c-page-header__breadcrumbs">
      @include('patterns.components.c-breadcrumbs')
    </div>
  @endif
  <div class="u-spacing--half">
    @if (isset($icon))
      <div class="c-page-header__icon">
        <span class="u-icon u-icon--l u-path-fill--primary">@include('patterns.icons.o-icon--leaf')</span>
      </div>
    @endif
    @if (!empty($kicker))
      <span class="c-page-header__kicker o-kicker u-font--secondary--s u-color--primary">
        {!! $kicker !!}
      </span>
    @endif
    @if (is_home() || is_page('calendar') || is_page_template('views/template-exhibitions.blade.php') || is_page_template('views/template-research.blade.php') || is_page_template('views/template-shop.blade.php'))
    @else
      @if (!is_front_page() && !is_archive() && !is_author() && get_field('display_title', $id) && !is_author() )
        <h1 class="c-page-header__title u-font--primary--xl u-color--secondary">{{ the_field('display_title', $id) }}</h1>
      @elseif ($title != false && !is_archive() && !is_author())
        <h1 class="c-page-header__title u-font--primary--xl u-color--secondary">{!! get_the_title() !!}</h1>
      @else
        <h1 class="c-page-header__title u-font--primary--xl u-color--secondary">{!! $title !!}</h1>
      @endif
    @endif
    @if (isset($meta))
      <div class="c-page-header__meta u-font--s">
        @include('partials.entry-meta')
      </div>
    @endif
  </div>

  @if (isset($hr))
    <hr class="u-hr--small u-hr--gray"/>
  @endif

  @if (isset($filter))
    <div class="c-page-header__filter u-font--xl">
      @include('patterns.components.c-filter')
    </div>
  @endif

  @if (isset($nav))
    <div class="c-page-header__filter u-font--xl">
      @include('patterns.components.c-navigation-children')
    </div>
    <hr class="u-hr--black u-hr--small"/>
  @endif

  @if (!empty($intro))
    <div class="c-page-header__intro u-font--l l-narrow">{{ $intro }}</div>
  @endif

  @if (!empty($link))
    <p>
      <a class="u-link--cta u-center-block" href="{{ $link }}">
        @if (get_field('cta_text', $id))
          {{ the_field('cta_text', $id) }}
        @else
          Read More
        @endif
        <span class="u-icon u-icon--m">@include('patterns.icons.o-arrow--short')</span>
      </a>
    </p>
  @endif
</header>
