<?php
/**
 * Block Name: Page Hero
 *
 */
?>
<div class="b-page-hero hero-p-t <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>">

  <div class="b-page-hero__wrapper container-fluid">
    <div class="b-page-hero__content">
      <h1 class="b-page-hero__title h2 h-info">
        <?php 
          if (get_field('title')) {
            the_field('title');
          } else { 
            the_title();
          }
        ?>
      </h1>
      <p><?php the_field('desc'); ?></p>
    </div>
  </div>

</div> <!-- .b-page-hero -->

