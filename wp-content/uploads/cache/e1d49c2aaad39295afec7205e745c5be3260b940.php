<?php
  $id = get_queried_object_id();
  $thumb_id = get_post_thumbnail_id($id);
  $caption = get_the_post_thumbnail_caption($id);
  if ($thumb_id) {
    $classes = 'c-section-hero--tall u-overlay u-background--cover u-background-image--' . $thumb_id;
  } else {
    $classes = 'c-section-hero--short u-background-color--secondary';
  }
  if (get_field('display_title', $id)) {
    $title = get_field('display_title', $id);
    $description = get_field('intro', $id);
    $link_text = get_field('cta_text', $id);
    $link_url = get_field('cta_link', $id);
  } else {
    $title = get_the_title($id);
  }
?>
<section class="c-section c-section-hero u-padding--zero <?php echo e($classes); ?>">
  <style>
    .u-background-image--<?php echo e($thumb_id); ?> {
      background-image: url(<?php echo e(wp_get_attachment_image_src($thumb_id, "featured__hero--s")[0]); ?>);
    }
    @media (min-width: 500px) {
      .u-background-image--<?php echo e($thumb_id); ?> {
        background-image: url(<?php echo e(wp_get_attachment_image_src($thumb_id, "featured__hero--m")[0]); ?>);
      }
    }
    @media (min-width: 800px) {
      .u-background-image--<?php echo e($thumb_id); ?> {
        background-image: url(<?php echo e(wp_get_attachment_image_src($thumb_id, "featured__hero--l")[0]); ?>);
      }
    }
    @media (min-width: 1100px) {
      .u-background-image--<?php echo e($thumb_id); ?> {
        background-image: url(<?php echo e(wp_get_attachment_image_src($thumb_id, "featured__hero--xl")[0]); ?>);
      }
    }
  </style>
  <div class="c-section-hero__content u-color--white u-spacing u-text-align--center l-container l-narrow l-narrow--m">
    <?php if($title): ?>
      <h1 class="c-section-hero__content-title u-font--primary--xl">
        <?php echo $title; ?>

      </h1>
    <?php endif; ?>
    <?php if(isset($description)): ?>
      <hr class="u-hr--small u-hr--white"/>
      <div class="c-section-hero__content-description"><?php echo wpautop($description); ?></div>
    <?php endif; ?>
    <?php if(isset($link_url)): ?>
      <p>
        <a href="<?php echo e($link_url); ?>" class="u-link--cta u-link--white u-center-block">
          <?php if($link_text): ?>
            <?php echo e($link_text); ?>

          <?php else: ?>
            Learn More
          <?php endif; ?>
          <span class="u-icon u-icon--m u-path-fill--white"><?php echo $__env->make('patterns.icons.o-arrow--short', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></span>
        </a>
      </p>
    <?php endif; ?>
  </div>
  <?php if($caption): ?>
    <span class="c-section-hero__caption o-caption u-font--s u-color--white">
      <?php echo e($caption); ?>

    </span>
  <?php endif; ?>
</section>
