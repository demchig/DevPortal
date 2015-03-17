<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<h1><?php the_title(); ?></h1>
	<section class="content">
		<?php the_content(); ?>
	</section>
<?php endwhile; else: ?>
<div class="entry">
		<p>Sorry, no posts matched your criteria.</p>
</div>
<?php endif; ?>

<?php get_footer(); ?>