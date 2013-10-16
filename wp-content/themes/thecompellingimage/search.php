<?php get_header(); ?>
<div class="row_inner">   
	<?php if (have_posts()) : ?>
		<h1>Search Results</h1>
		<?php while (have_posts()) : the_post(); ?>
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<h2><?php the_title(); ?></h2>
				<div class="entry">
					<?php the_excerpt(); ?>
				</div>
			</div>
		<?php endwhile; ?>
	<?php else : ?>
		<h2>No posts found.</h2>
	<?php endif; ?>
</div><!-- Close Content -->
<?php get_footer(); ?>