<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php the_content(); ?>
<?php endwhile; endif; ?>

  
<div id="home">
  <div class="o-wrapper">
    <div class="o-layout">
      <div class="o-layout__item">
        <h1>Test</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto culpa expedita beatae voluptatum non debitis incidunt alias illo fugiat reprehenderit, impedit, ab maiores ea, ipsum a! Quod vitae nihil <a href="https://www.youtube.com/watch?v=5yx6BWlEVcY" class="link-video">consectetur</a>.</p>

        <p>
          ICONS: <i class="icon-pinterest"></i> <i class="icon-mail"></i>
        </p>

        <div id="test">
          <div class="test-col">Dolores voluptatibus debitis accusantium amet tenetur ab saepe, eaque blanditiis atque rerum.</div>
          <div class="test-col">adipisicing elit. Nesciunt consectetur laboriosam recusandae libero aliquam quod.
            <a href="#" class="c-button">Submit</a>
          </div>
          <div class="test-col">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt consectetur laboriosam recusandae libero aliquam quod, totam nihil facere. Dolores voluptatibus debitis accusantium amet tenetur ab saepe, eaque blanditiis atque rerum.</div>
        </div>

		<div class="main-carousel">
			<div class="carousel-cell">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt consectetur laboriosam recusandae libero aliquam quod, totam nihil facere. Dolores voluptatibus debitis accusantium amet tenetur ab saepe, eaque blanditiis atque rerum.</div>
			<div class="carousel-cell">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt consectetur laboriosam recusandae libero aliquam quod, totam nihil facere. Dolores voluptatibus debitis accusantium amet tenetur ab saepe, eaque blanditiis atque rerum.</div>
			<div class="carousel-cell">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt consectetur laboriosam recusandae libero aliquam quod, totam nihil facere. Dolores voluptatibus debitis accusantium amet tenetur ab saepe, eaque blanditiis atque rerum.</div>
		</div>

      </div>
    </div>
  </div>
</div>


<?php get_footer(); ?>
