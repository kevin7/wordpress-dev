<?php
  $subHero = true;
  $title = get_field('news_title', 'option');
  $subtitle = get_field('news_text', 'option');
  if ( is_category() ) {
    $title = single_cat_title( '', false );
    $subtitle = 'Category';
  } elseif ( is_tag() ) {
    $title = single_tag_title( '', false );
    $subtitle = 'Tag';
  } elseif ( is_author() ) {
    $title = ucwords(get_the_author());
    $subtitle = 'Author';
  } elseif ( is_post_type_archive() ) {
    $title = post_type_archive_title( '', false );
    $subtitle = 'Archive';
  } elseif ( is_tax() ) {
    $title = single_term_title( '', false );
    $subtitle = 'Category';
  }
?>
<?php get_header(); ?>
<?php
$page_for_posts = get_option( 'page_for_posts' );
$image = get_field('fh_image', $page_for_posts);
?>
<div class="b-page-hero hero-p-t <?php echo $image ? 'has-image' : ''; ?> <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>">

<div class="b-page-hero__wrapper container-fluid">
  <div class="b-page-hero__content">
    <h1 class="b-page-hero__title h2 h-info">
      <?php echo $title ?>
    </h1>
    <p><?php echo $subtitle; ?></p>
  </div>
</div>

</div> <!-- .b-page-hero -->

<?php

$posts_per_page = get_field('posts_per_page');
$paged = get_query_var('paged');
$args = array(
  'posts_per_page' => $posts_per_page,
  'paged' => $paged,
  'post_type' => 'post',
  'post_status' => 'publish'
);

if (isset($_GET['category'])) {
  $args['tax_query'] = array(
    array(
      'taxonomy' => 'store_cat',
      'field'    => 'term_id',
      'terms'    => array($_GET['category'])
    )
  );
}

$the_query = new WP_QUERY($args);		

if ($the_query->have_posts()) : 
?>

<div class="blog-list u-p-64">

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

      <div class="post-filter u-mb-16">
          <form id="js-filter-form">
            <input type="text" name="action" value="get_articles">
            <input type="text" name="posts_per_page" value="<?php echo $posts_per_page; ?>">
            <input type="text" name="paged" id="js-field-paged" value="<?php echo $paged; ?>">
            <input type="text" name="cats" id="js-field-cats" value="">
            <input type="text" name="sort" id="js-field-sort" value="new">
          </form>
          <div class="post-filter__left">
            <div class="post-filter__cats">
              <span class="post-filter__label">Optional filters</span>
              <?php $cats = get_categories(array('hide_empty' => false)); ?>
              <?php foreach ($cats as $c) : ?>
                <a href="<?php echo get_category_link($c->term_id) ?>" class="post-filter__cat js-filter-cat <?php echo (isset($_GET['category']) && $_GET['category'] == $c->term_id) ? 'selected' : '' ?>" data-tid="<?php echo $c->term_id; ?>"><?php echo $c->name; ?></a>
              <?php endforeach; ?>
            </div>
            <?php if (count($cats) > 5) : ?>
            <div class="post-filter__cat-toggle u-mt-16" id="js-cat-toggle">More categories +</div>
            <?php endif; ?>
          </div>

          <div class="post-filter__right">
            <div class="post-filter__select">
              <div class="c-dropdown multiple" id="js-filter-cats">
                <div class="c-dropdown__label" data-label="Filter by categories">Filter by categories</div>
                <div class="c-dropdown__list">
                  <?php foreach ($cats as $c) : ?>
                    <div class="c-dropdown__item" data-value="<?php echo $c->term_id; ?>"><?php echo $c->name; ?></div>
                  <?php endforeach; ?>

                </div>
              </div> <!-- .c-dropdown -->
              <div class="c-dropdown single" id="js-filter-sort">
                <div class="c-dropdown__label">Sort by</div>
                <div class="c-dropdown__list">
                  <div class="c-dropdown__item" data-value="a-z">Alphabetical (A-Z)</div>
                  <div class="c-dropdown__item" data-value="z-a">Alphabetical (Z-A)</div>
                  <div class="c-dropdown__item selected" data-value="new">Newest to oldest</div>
								  <div class="c-dropdown__item" data-value="old">Oldest to newest</div>
                </div>
              </div> <!-- .c-dropdown -->
            </div>
            
            <?php /*
            <div class="post-filter__show">
              <?php
                $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
                $pagenum = $paged < 1 ? 1 : $paged;
                $first = ( ( $pagenum - 1 ) * $posts_per_page ) + 1;
                $last = $first + $the_query->post_count - 1;
                echo "Showing $first - $last of $the_query->found_posts articles";
              ?>
            </div>
            */ ?>
          </div>

        </div>

        <div id="js-post-results">
            
          <div class="blog-list__wrapper">

            <div class="b-posts">
            <?php while (have_posts()) : the_post(); ?>	
            <?php include get_template_directory() . '/module-post-item.php'; ?>
            <?php endwhile; ?>
            </div>
            

          </div> <!-- .blog-list__wrappe -->

          <div class="blog-list__pages">
            <?php bones_page_navi(); ?>
          </div>

        </div>

      </div>
    </div>
  </div>

</div>
<?php endif; ?>

<?php get_footer(); ?>
