<?php 

global $wp_query;
$search_query = get_search_query();

$args_page = array(
	'post_type' => 'page',
	'posts_per_page' => -1,
	's' => $search_query
);
$page_query = new WP_Query($args_page);

$args_resource = array(
	'post_type' => 'resource',
	'posts_per_page' => -1,
	's' => $search_query
);
$resource_query = new WP_Query($args_resource);

$args_post = array(
	'post_type' => 'post',
	'posts_per_page' => -1,
	's' => $search_query
);
$post_query = new WP_Query($args_post);

$total_results = $page_query->found_posts + $resource_query->found_posts + $post_query->found_posts;

get_header(); ?>

<div class="b-page-hero b-page-hero--search">

  <div class="b-page-hero__wrapper container-fluid">

		<div class="b-page-hero__content">
			<h1 class="h2 u-mb-64">Search results</h1>
			<div class="c-search-form">
				<form action="/" class="result-form">
						<div class="c-search-form__row">
							<input type="text" name="s" placeholder="Search for a topic or keyword..." value="<?php echo esc_attr($search_query); ?>" required>
							<button class="btn btn-primary">Search</button>
						</div>
						<input type="hidden" name="sort" value="" id="js-field-sort">
						<input type="hidden" name="type" value="" id="js-field-type">
						<input type="hidden" name="action" value="search">
				</form>
			</div>
		</div>

  </div>

</div> <!-- .b-page-hero -->




<section class="u-p-64 b-search">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-12 col-md-12 col-lg-8">

				<div class="c-filter">
					<div class="c-filter__total" id="js-result-total">
						<?php echo $total_results ?> result<?php echo $total_results != 1 ? 's' : ''; ?> found
					</div>
					<a href="#" class="btn btn-default c-filter__button" id="js-filter-button"><i class="icon-filter"></i> Filter</a>
					<div class="c-filter__dropdown">

						<div class="c-filter__title">
							<i class="icon-filter"></i> Filter
							<a class="c-filter__close" id="js-filter-close"><i class="icon-times"></i></a>
						</div>

						<div class="c-dropdown single search" id="js-search-sorting">
							<div class="c-dropdown__label search">Relevance</div>
							<div class="c-dropdown__list search">
								<div class="c-dropdown__item selected" data-value="relevance">Relevance</div>
								<div class="c-dropdown__item" data-value="a-z">Alphabetical (A-Z)</div>
								<div class="c-dropdown__item" data-value="z-a">Alphabetical (Z-A)</div>
								<div class="c-dropdown__item" data-value="new">Newest to oldest</div>
								<div class="c-dropdown__item" data-value="old">Oldest to newest</div>
							</div>
						</div> <!-- .c-dropdown -->
						<div class="c-dropdown multiple search" id="js-search-type">
							<div class="c-dropdown__label search" data-label="Filter by type">Filter by type</div>
							<div class="c-dropdown__list search">
								<div class="c-dropdown__item" data-value="page">Pages</div>
								<div class="c-dropdown__item" data-value="post">News</div>
								<div class="c-dropdown__item" data-value="resource">Resources</div>
							</div>
						</div> <!-- .c-dropdown -->

						<div class="c-filter__save">
							<a class="btn btn-primary" id="js-filter-save">Save and close</a>
						</div>

					</div>
				</div> <!-- .c-filter -->

				<div class="c-result" id="js-search-result">


				<?php if ($page_query->have_posts()) : ?>
					<div class="c-result__section u-p-64">
						<h3>Pages</h3>
						<div class="b-pages">
						<?php while ($page_query->have_posts()) : $page_query->the_post(); ?>	
							<div class="b-page">
								<div class="b-page__item">
									<div class="b-page__content">
										<a href="<?php the_permalink() ?>" class="b-page__title"><?php the_title() ?></a>
										<div class="b-page__desc"><?php the_excerpt(); ?></div>
										<a href="<?php the_permalink(); ?>" class="text-link">Read more</a>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
						</div>
					</div>
					<?php endif; ?>

					<?php if ($post_query->have_posts()) : ?>
					<div class="c-result__section u-p-64">
						<h3>News</h3>
						<div class="b-pages">
						<?php while ($post_query->have_posts()) : $post_query->the_post(); ?>	
							<div class="b-page b-page--post">
								<div class="b-page__item">
									<div class="b-page__image" style="background-image:url(<?php echo getPostImage(); ?>)"></div>
									<div class="b-page__content">
										<a href="<?php the_permalink() ?>" class="b-page__title"><?php the_title() ?></a>
										<div class="b-page__desc"><?php the_excerpt(); ?></div>
										<a href="<?php the_permalink(); ?>" class="text-link">Read more</a>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
						</div>
					</div>
					<?php endif; ?>


					<?php if ($resource_query->have_posts()) : ?>
					<div class="c-result__section u-p-64">
						<h3>Resources</h3>
						<div class="b-resources">
						<?php while ($resource_query->have_posts()) : $resource_query->the_post(); ?>	
				
						<?php
							$id = get_the_ID();
							$type = get_field('res_type', $id);
							if ($type == 'file') {
								$file = get_field('res_file', $id);
								$link = $file['url'];
								$type = 'PDF';
								$icon = 'icon-file-pdf';
							} elseif ($type == 'link') {
								$link = get_field('res_link', $id);
								$type = 'Link';
								$icon = 'icon-link';
							} else if ($type == 'url') {
								$link = get_field('res_url', $id);
								$type = 'Link';
								$icon = 'icon-link';
							}
						?>
						<div class="b-resources__item u-p-32">
							<div class="b-resources__wrapper">
								<div class="b-resources__meta"><i class="<?php echo $icon; ?>"></i> <?php echo $type; ?> &bull; <?php echo date('M Y', strtotime(get_the_date())); ?></div>
								<div class="b-resources__title"><?php the_title(); ?></div>
								<a href="<?php echo $link ?>" class="text-link" target="_blank">View resource</a>
							</div>
						</div>

						<?php endwhile; ?>
						</div>
					</div>
					<?php endif; ?>


				</div> <!-- .c-search-result -->


			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>