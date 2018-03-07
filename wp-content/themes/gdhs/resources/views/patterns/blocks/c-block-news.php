<?php
  $id = get_the_ID();
  $title = get_the_title($id);
  $body = strip_tags(get_the_content());
  $body = strip_shortcodes($body);
  $excerpt = get_the_excerpt($id);
  $excerpt_length = 14;
  $thumb_id = get_post_thumbnail_id($id);
  $link = get_permalink($id);
  $date = get_the_date('F j, Y');
  $date_formatted = get_the_date('c');
  if (is_search()) {
    $category = '';
  } else {
    if (get_post_type($id) != 'post') {
      $cat_name = get_post_type($id) . '_category';
    } else {
      $cat_name = 'category';
    }
    $category = get_the_terms($id, $cat_name);
  }
  if ($category) {
    if (class_exists('WPSEO_Primary_Term')) {
      $wpseo_primary_term = new WPSEO_Primary_Term($cat_name, $id);
      $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
      $term = get_term($wpseo_primary_term);
      if (is_wp_error($term)) {
        $kicker = $category[0]->name;
      } else {
        $kicker = $term->name;
      }
    }
    else {
      $kicker = $category[0]->name;
    }
  } elseif (get_post_type($id) == 'post') {
    $kicker = 'News';
  } elseif (get_post_type($id) == 'exhibit') {
    $kicker = 'Exhibition';
  } elseif (get_post_type($id)) {
    $kicker = get_post_type($id);
  } else {
    $kicker = 'Page';
  }
?>
<div class="l-grid-item">
  <div class="c-block c-block-news u-background-color--tan u-border <?php if ($thumb_id): echo 'has-hover'; endif; ?>">
    <a href="<?php echo $link; ?>" class="c-block__link">
      <?php if ($thumb_id): ?>
        <div class="c-block__media">
          <picture class="c-block__thumb">
            <img src="<?php echo wp_get_attachment_image_src($thumb_id, "horiz__4x3--s")[0]; ?>" alt="<?php echo get_post_meta($thumb_id, '_wp_attachment_image_alt', true); ?>">
          </picture>
        </div>
      <?php endif; ?>
      <div class="c-block__content u-padding--half u-spacing">
        <div class="c-block__header u-spacing--half">
          <?php if (!empty($kicker)): ?>
            <h4 class="c-block__kicker o-kicker u-font--secondary--s u-color--primary"><?php echo $kicker; ?></h4>
          <?php endif; ?>
          <h3 class="c-block__title u-font--primary--s">
            <?php echo $title; ?>
          </h3>
          <p class="c-block__excerpt">
            <?php if (!empty($excerpt)): ?>
              <?php echo wp_trim_words($excerpt, $excerpt_length, ' &hellip;'); ?>
            <?php else: ?>
              <?php echo wp_trim_words($body, $excerpt_length, ' &hellip;'); ?>
            <?php endif; ?>
          </p>
        </div>
        <div class="c-block__date">
          <time class="u-font--s" datetime="<?php echo $date_formatted; ?>"><?php echo $date; ?></time>
        </div>
      </div>
    </a>
    <a href="<?php echo $link; ?>" class="c-block__button u-padding--half u-font--secondary--s">Read More<span class="u-icon u-icon--s"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 9.53"><title>o-arrow--black</title><path d="M21.85,4.39,17.61.15a.5.5,0,0,0-.71.71l3.39,3.39H.5a.5.5,0,0,0,0,1H20.3L16.86,8.68a.5.5,0,1,0,.71.71l4.24-4.24,0,0h0A.5.5,0,0,0,21.85,4.39Z" fill="#31302e"/></svg></span></a>
  </div>
</div>
