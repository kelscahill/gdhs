<div class="c-block u-spacing">
  <div class="c-block__media">
    <?php if (!empty($date)): ?>
      <div class="c-block__meta u-background-color--secondary">
        <div class="c-block__date o-date u-color--white">
          <div class="o-date--month u-font-weight--700"><?php echo $day; ?></div>
          <div class="o-date--day u-font--primary--s u-font-weight--700"><?php echo $month; ?></div>
        </div>
      </div>
    <?php endif; ?>
    <?php if (!empty($thumb_id)): ?>
      <a href="<?php echo $link; ?>" class="c-block__link u-space--half--bottom">
        <picture class="c-block__thumb">
          <img src="<?php echo wp_get_attachment_image_src($thumb_id, "horiz__4x3--xs")[0]; ?>" alt="<?php echo get_post_meta($thumb_id, '_wp_attachment_image_alt', true); ?>">
        </picture>
      </a>
    <?php endif; ?>
  </div>
  <div class="c-block__header">
    <?php if ($subtitle): ?>
      <span class="u-font--primary--xs c-block__kicker o-kicker"><?php echo $subtitle; ?></span>
    <?php endif; ?>
    <a href="<?php echo $link; ?>" class="c-block__link u-color--primary--hover">
      <h4 class="u-font--primary--m u-font-weight--700 c-block__title"><?php echo $title; ?></h4>
    </a>
  </div>
  <?php if (isset($button_text)): ?>
    <hr class="o-hr--small u-background-color--secondary"/>
  <?php endif; ?>
  <p class="c-block__excerpt" style="text-transform: initial;">
    <?php if (!empty($excerpt)): ?>
      <?php echo wp_trim_words($excerpt, $excerpt_length, ' &hellip;' . ' <a class="u-color--black u-color--secondary--hover" href="'. $link . '"><em>Read More</em></a>'); ?>
    <?php else: ?>
      <?php echo wp_trim_words($body, $excerpt_length, ' &hellip;' . ' <a class="u-color--black u-color--secondary--hover" href="'. $link . '"><em>Read More</em></a>'); ?>
    <?php endif; ?>
  </p>
  <?php if (isset($button_text)): ?>
    <a href="<?php echo $link; ?>" class="o-button"><?php echo $button_text; ?></a>
  <?php else: ?>
    <hr class="o-hr--small u-background-color--secondary"/>
  <?php endif; ?>
</div>
