<?php
/**
 * The template for displaying search results pages.
 *
 * @package semplicemente
 */

get_header(); ?>

	<section id="main" class="site-main page-static" role="main">

		<?php if ( have_posts() ) : ?>

			<div class="page-ttl"><h2>検索結果</h2></div>

			<article>
			<header class="search-page-header">
				<h1 class="page-title"><?php printf( __( '<p>キーワード：%s</p>', 'semplicemente' ), '<strong>' . get_search_query() . '</strong>' ); ?></h1>
			</header><!-- .page-header -->
			</article>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<article class="pagination">
			<?php pagination(); ?>
			</article>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

	</section><!-- #main -->

<?php get_footer(); ?>
