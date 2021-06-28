<?php get_header(); ?>
<?php 
  $current_id = get_the_ID();
  $cat = get_the_category(); 
  $link = array();
  foreach ($cat as $c) {
    if ($c->slug != 'featured')
    $link[count($link)] = '<a href="' . get_category_link($c) . '">' . $c->name . '</a>';
  } 

  $image='';
  if (@has_post_thumbnail( $current_id ) ) {
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $current_id ), 'single-post-thumbnail' );
    $image = $image[0];
  }		
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php

$id = get_the_author_meta('ID');
$desc = get_the_author_meta('user_description');
$first = get_the_author_meta('user_firstname');
$last = get_the_author_meta('user_lastname');
$author_url = get_the_author_meta('user_url');
?>

<div class="b-post-hero u-pb-80 u-pt-32">

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <div class="b-post-hero__wrapper">
          <div class="b-post-hero__content">

            <div class="b-post-hero__cont-wrapper">
              <div class="b-post-hero__cat u-mb-48"><?php echo implode(', ', $link); ?></div>
              <h1 class="h3 u-mb-48"><?php the_title(); ?></h1>

              <div class="e-author-small">
                <?php echo get_avatar($id); ?>
                <div class="e-author-small__content">
                  <div class="e-author-small__read"><?php the_field('post_reading_time'); ?> minutes read</div>
                  <div class="e-author-small__name">
                  <?php if ($first || $last) : ?>
                  <?php echo $first; ?> <?php echo $last; ?> &bull; 
                  <?php endif; ?>
                  <?php the_date(); ?></div>
                </div>
              </div>
            </div>

            <div class="b-post-hero__image" style="background-image:url(<?php echo $image; ?>)"></div>

            <!-- <div class="e-social-small js-social-share u-mt-64 d-xs-block d-sm-block d-lg-none">
              Share
              <a href="<?php the_permalink(); ?>" class="so fb" data-type="fb" data-text="<?php the_title(); ?>" data-url="<?php the_permalink(); ?>"><i class="icon-facebook"></i></a> 
              <a href="<?php the_permalink(); ?>" class="so li" data-type="li" data-text="<?php the_title(); ?> <?php the_permalink(); ?>" data-url="<?php the_permalink(); ?>"><i class="icon-linkedin"></i></a>
              <a href="<?php the_permalink(); ?>" class="so tt" data-type="tt" data-text="<?php the_title(); ?> <?php the_permalink(); ?>" data-url="<?php the_permalink(); ?>"><i class="icon-twitter"></i></a>
            </div> -->

          </div>
        </div>

      </div>
    </div>
  </div>

</div>

<section class="b-post-body u-p-80">
  <div class="container-fluid">

    <div class="row justify-content-center">
      <div class="col-12 col-lg-7">

          <div class="b-post-body__content">
            <?php the_content(); ?>

            <div class="b-post-body__cta u-mt-40">
              <h5><?php the_field('post_cta_title'); ?></h5>
              <?php if (get_field('button')) : ?>
              <div class="b-cont-image__buttons u-mt-24">
                <?php 
                  $button = make_link('button', 'btn btn-primary' );
                  render('link', $button); 
                ?>
              </div>     
              <?php endif; ?>
            </div>


            <div class="e-social js-social-share d-xs-none d-md-none d-lg-block" id="js-social-sticky">
              <b>Share</b>
              <a href="<?php the_permalink(); ?>" class="so fb" data-type="fb" data-text="<?php the_title(); ?>" data-url="<?php the_permalink(); ?>"><i class="icon-facebook"></i></a> 
              <a href="<?php the_permalink(); ?>" class="so li" data-type="li" data-text="<?php the_title(); ?> <?php the_permalink(); ?>" data-url="<?php the_permalink(); ?>"><i class="icon-linkedin"></i></a>
              <a href="<?php the_permalink(); ?>" class="so tt" data-type="tt" data-text="<?php the_title(); ?> <?php the_permalink(); ?>" data-url="<?php the_permalink(); ?>"><i class="icon-twitter"></i></a>
              <a href="mailto:?subject=<?php the_title(); ?>&body=Hi,%0D%0A%0D%0A<?php echo get_the_title(); ?>%0D%0A<?php the_permalink() ?>" class="so"><i class="icon-mail-alt"></i></a>
            </div>

          </div>
        
      </div>
    </div>
  </div>
</section>


<?php if ($first && $last && $desc) : ?>
<div class="e-author u-mb-80">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

      <div class="e-author__container">

      <div class="row justify-content-center">
      <div class="col-12 col-lg-7">
      <div class="e-author__wrapper">
        <?php echo get_avatar($id); ?>

        <div class="e-author__content">
          <h6 class="e-author__name u-mb-16">About <?php echo $first . ' ' . $last; ?></h6>

          <div class="e-author__meta u-mb-16">
            <?php if (get_field('job_position', 'user_' . $id)) : ?>
              <span class="e-author__pos"><?php the_field('job_position', 'user_' . $id); ?></span>
            <?php endif; ?>
            <?php if (get_field('linkedin_url', 'user_' . $id)) : ?>
            <span class="bull">|</span>
            <span class="e-author__linked">
              <a href="<?php the_field('linkedin_url', 'user_' . $id); ?>" target="_blank"><i class="icon-linkedin"></i></a>
            </span>
            <?php endif; ?>
          </div>

          <?php if ($desc) : ?>
          <div class="e-author__desc u-mb-24">
            <?php  echo $desc; ?>
          </div>
          <?php endif; ?>

          <a href="<?php echo $author_url ?>" class="text-link">Read more articles</a>
         

        </div>
      </div>

      </div>
      </div>
    </div>

      </div>
    </div>
  </div>
</div> <!-- .author -->
<?php endif; ?>

<?php endwhile; endif; ?>



<div class="u-p-64 b-latest-posts">

  <div class="container-fluid">

    <div class="b-latest-posts__header">
      <h3 class="b-latest-posts__title">Continue reading</h3>
      <div class="b-latest-posts__nav">
        <button class="slick-arrow slick-prev"></button>
        <button class="slick-arrow slick-next"></button>
      </div>
    </div>

    <?php
        $args = array(
          'post_type' => 'post',
          'posts_per_page' => 6,
          'post_status' => 'publish',
          'post__not_in' => array($current_id)
        );

        $the_query = new WP_Query( $args );
      ?>
      <?php if( $the_query->have_posts() ) : ?>

        <div class="b-posts b-latest-posts__carousel">
            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>	

            <?php
              $post_type = 'post';
              $id = get_the_ID();
              $tags = array();
              $cats = get_the_category();  
              
              if ($cats) {
                foreach ($cats as $c) {
                  $tags[] = $c->name;
                }          
              }    
            ?>
            
            <?php include get_template_directory() . '/module-post-item.php'; ?>

            <?php endwhile; ?>
          </div>      

      <?php endif; ?>


    <div class="b-latest-posts__button">
      <a href="/news" class="b-latest-posts__link btn btn-primary">View all articles</a>          
    </div>


  </div>

</div> <!-- .acf-block -->




<?php get_footer(); ?>
