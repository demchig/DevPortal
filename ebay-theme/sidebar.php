<?php
	$menu_list = get_posts('numberposts=6&cat=1');
?>
<aside>
	<?php
	if(!$post->post_parent){
		// will display the subpages of this top level page
		$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
	}
	else{

		if($post->ancestors) {
			// now you can get the the top ID of this page
			// wp is putting the ids DESC, thats why the top level ID is the last one
			$ancestors = get_post_ancestors($this_page);
			$children = wp_list_pages("title_li=&child_of=".$ancestors[0]."&echo=0");
		}
	}

	if( !empty($_REQUEST['s']) ){
		// Search result page
		$children = '';
	}

	if ($children) { ?>
	<section class="page_list">
		<ul>
			<?php echo str_replace('</a>', '<span></span></a>', $children); ?>
		</ul>
	</section>
	<?php 
	}
	?>

	<section class="blog_list">
		<?php dynamic_sidebar('sidebar1'); ?>
	</section>
</aside>