<?php
/**
 * The template for displaying accordion blocks
 */
  $title = get_field('gallery_title');
  $description = get_field('gallery_description');
  $images = get_field('gallery');
?>

<div class="c-block-gallery u-spacing">
  <div class="c-block-gallery__heading u-spacing--half">
    <?php if ($title): ?>
      <h3><?php echo $title; ?></h3>
    <?php endif; ?>
    <?php if ($description): ?>
      <div class="c-block-gallery__description"><?php echo $description; ?></div>
    <?php endif; ?>
  </div>
  <?php if ($images): ?>
    <div class="c-block-gallery__images">
      <div class="c-block-gallery__image js-block-gallery">
        <?php foreach($images as $image): ?>
          <figure>
            <picture>
              <!--[if IE 9]><video style="display: none"><![endif]-->
              <source srcset="<?php echo $image['sizes']['horiz__4x3--l']; ?>" media="(min-width: 800px)">
              <!--[if IE 9]></video><![endif]-->
              <img src="<?php echo $image['sizes']['horiz__4x3--m']; ?>" alt="<?php echo $image['alt']; ?>" />
            </picture>
            <?php if ($image['caption']): ?>
              <figcaption><?php echo $image['caption']; ?></figcaption>
            <?php endif; ?>
          </figure>
        <?php endforeach; ?>
      </div>
      <div class="c-block-gallery__nav js-block-gallery-nav">
        <?php foreach($images as $image): ?>
          <picture>
            <img src="<?php echo $image['sizes']['horiz__4x3--s']; ?>" alt="<?php echo $image['alt']; ?>" />
          </picture>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>
</div>
