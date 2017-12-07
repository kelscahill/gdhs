<div class="block spacing">
  <div class="block__media">
    <?php if (!empty($date)): ?>
      <div class="block__meta background-color--secondary">
        <div class="block__date date color--white">
          <div class="date--month font-weight--700"><?php echo $day; ?></div>
          <div class="date--day font--primary--s font-weight--700"><?php echo $month; ?></div>
        </div>
      </div>
    <?php endif; ?>
    <?php if (!empty($thumb_id)): ?>
      <a href="<?php echo $link; ?>" class="block__link space--bottom-half">
        <picture class="block__thumb">
          <img src="<?php echo wp_get_attachment_image_src($thumb_id, "horiz__4x3--xs")[0]; ?>" alt="<?php echo get_post_meta($thumb_id, '_wp_attachment_image_alt', true); ?>">
        </picture>
      </a>
    <?php endif; ?>
  </div>
  <div class="block__header">
    <?php if ($subtitle): ?>
      <span class="font--primary--xs block__kicker"><?php echo $subtitle; ?></span>
    <?php endif; ?>
    <a href="<?php echo $link; ?>" class="block__link color--primary--hover">
      <h4 class="font--primary--m font-weight--700 block__title"><?php echo $title; ?></h4>
    </a>
  </div>
  <?php if (isset($button_text)): ?>
    <hr class="hr--small background-color--secondary"/>
  <?php endif; ?>
  <p class="block__excerpt" style="text-transform: initial;">
    <?php if (!empty($excerpt)): ?>
      <?php echo wp_trim_words($excerpt, $excerpt_length, ' &hellip;' . ' <a class="color--black color--secondary--hover" href="'. $link . '"><em>Read More</em></a>'); ?>
    <?php else: ?>
      <?php echo wp_trim_words($body, $excerpt_length, ' &hellip;' . ' <a class="color--black color--secondary--hover" href="'. $link . '"><em>Read More</em></a>'); ?>
    <?php endif; ?>
  </p>
  <?php if (isset($button_text)): ?>
    <a href="<?php echo $link; ?>" class="btn"><?php echo $button_text; ?></a>
  <?php else: ?>
    <hr class="hr--small background-color--secondary"/>
  <?php endif; ?>
</div>
