<?php
/**
 * The template for displaying search results pages.
 *
 * @package semplicemente
 */

get_header(); ?>

	<section id="main" class="site-main page-static" role="main">

		<?php if ( have_posts() ) : ?>

			<article>
			<header class="search-page-header">
				<h1 class="page-title"><?php printf( __( '<p> %s　で検索した結果 </p>', 'semplicemente' ), '<strong>“' . get_search_query() . '“</strong>' ); ?></h1>
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

			<?php ebay_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

	</section><!-- #main -->

<?php get_footer(); ?>

<?php
function ebay_paging_nav() {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="search-paging-nav" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentytwelve' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?></div>
		</nav><!-- .navigation -->
<?php 
	endif;
}