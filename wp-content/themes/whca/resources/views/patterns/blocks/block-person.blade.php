<div class="block block-person">
  <a href="{{ $link }}" class="spacing">
    <?php if (!empty($thumb_id)): ?>
      <picture class="block__thumb">
        <img src="<?php echo wp_get_attachment_image_src($thumb_id, "thumbnail")[0]; ?>" alt="<?php echo get_post_meta($thumb_id, '_wp_attachment_image_alt', true); ?>">
      </picture>
    <?php endif; ?>
    <h4 class="font--m block__title"><?php echo $title; ?></h4>
  </a>
</div>
