<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package semplicemente
 */
?>

<article class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( '検索結果0件', 'semplicemente' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'semplicemente' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'このキーワードに対する結果は見つかりません。キーワードを変更して再度検索して下さい', 'semplicemente' ); ?></p>
			<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
				<span class="search_text"><input type="text" value="<?php echo $_REQUEST['s']; ?>" name="s" id="s" placeholder="search" /></span>
				<span class="search_btn"><input type="submit" id="searchsubmit" value="検索" /></span>
			</form>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'semplicemente' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
</article><!-- .no-results -->
