<?php get_header(); ?>

<?php if (isset($_REQUEST['lastupdate']) && $_REQUEST['lastupdate']) { ?>
<?php
	$items = get_posts('numberposts=6&cat=-2');
?>
	<?php if ($items) { ?>
	<?php foreach ($items as $row) { ?>
	<div class="entry-archive">
		<div class="post" id="post-<?php echo $row->ID; ?>">
			<div class="post-date">
				<span><?php echo date('Y/n/j', strtotime($row->post_date)); ?></span>
				<?php echo ''; ?>
			</div>

			<h2><a href="<?php echo $row->guid ?>" rel="bookmark" title="Permanent Link to <?php echo ''; ?>"><?php echo $row->post_title; ?></a></h2>
			<div class="post-content"><?php echo mb_strimwidth($row->post_content, 0, 200) . "..."; ?></div>
			<div class="archive-line"></div>
<?php /*
			<?php the_category(', ') ?>
			<div id="line"></div>

			<?php the_content('Read the rest of this entry &raquo;'); ?>

			<p>Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
*/ ?>
		</div>
	</div>
	<?php } ?>
	<?php } ?>
<?php } else { ?>
	<div class="page-ttl"><h2>ブログ</h2></div>

	<?php $cnt = 0; ?>
	<?php if (have_posts()) { ?>
	<?php while (have_posts()) { the_post(); ?>
	<div class="entry-archive">
		<div class="post" id="post-<?php the_ID(); ?>">

			<div class="title-date clearfix">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

				<div class="post-date">
					<span><?php the_time('Y/n/j') ?></span>
				</div>
			</div>

			<?php //the_category(', ') ?>

			<?php echo mb_substr(strip_tags($post->post_content),0,200) . "...";; ?>

			<div class="readMoreLink">
				<a href="<?php echo get_permalink(); ?>"><?php _e('続きを読む', 'semplicemente') ?><i class="fa spaceLeft fa-angle-double-right"></i></a>
			</div>
		</div>
	</div>
<?php } ?>

	<article class="pagination">
	<?php pagination(); ?>
	</article>

<?php } else { ?>
	<div class="entry">
		<h2>Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
	</div>
<?php } ?>
<?php } ?>


<?php get_footer(); ?>