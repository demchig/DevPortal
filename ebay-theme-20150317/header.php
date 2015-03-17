<?php
	$menu_list = get_posts('numberposts=10&category=2&orderby=post_date&order=ASC');
	$cur_post_id = get_the_ID();
?>
<!DOCTYPE HTML>
<!--[if IE 6]>
<html id="ie6" class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="no-js lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="robots" content="index,follow">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="keywords" content="xxxxx,xxxxx,xxxxx" />
	<meta name="description" content="xxxxxxxxxxxxxxxxxx" />

	<title><?php if(!is_front_page()): ?><?php wp_title(''); ?> | <?php endif; ?><?php bloginfo('name'); ?></title>
	<link href="<?php bloginfo('template_url'); ?>/images/common/favicon.ico" rel="shortcut icon">
<?php
if(!is_admin()){
	wp_enqueue_style('reset',get_bloginfo('template_url').'/css/reset.css', array());
	wp_enqueue_style('base',get_bloginfo('template_url').'/css/base.css', array('reset'));
	wp_enqueue_style('meanmenu',get_bloginfo('template_url').'/css/meanmenu.css', array('base'));
	wp_enqueue_style('mobile',get_bloginfo('template_url').'/css/mobile.css', array('base'), '', 'screen and (max-width: 800px)');
	
	wp_deregister_script('jquery');
	if(is_lte_ie(8)){
		wp_enqueue_script('jquery','//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', array());
	}else{
		wp_enqueue_script('jquery','//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js', array());
	}
	wp_enqueue_script('easing',get_bloginfo('template_url').'/js/jquery.easing.min.js', array('jquery'));
	wp_enqueue_script('smoothScroll',get_bloginfo('template_url').'/js/jquery.smoothScroll.offset.js', array('easing'));
	wp_enqueue_script('meanmenu',get_bloginfo('template_url').'/js/jquery.meanmenu.js', array('jquery'));
	wp_enqueue_script('base',get_bloginfo('template_url').'/js/base.js', array('jquery'));
}
if(is_front_page()){
	
}elseif(is_404()){
	
}
if(is_lte_ie(8)){
	wp_enqueue_script('html5shiv','//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js', array());
	wp_enqueue_script('respond','//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js', array());
}
if(is_gte_ie(9)){
	echo '<style type="text/css">.gradient{filter: none;}</style>';
}
wp_head();
?>
</head>
<body <?php body_class(); ?>>
<div id="wrap">
	<header id="header">
    	<section class="sec_01">
        	<div class="inner">
        		<div id="logo">
        			<a href="<?php echo home_url('/'); ?>">
        				<img src="<?php bloginfo('template_url'); ?>/images/common/logo.png" alt="<?php bloginfo('name'); ?>" width="255" height="38">
        			 </a>
        		</div>
        		<nav>
        			<ul>
        				<li id="ln_01"><a href="/developer/definitions/">用語集</a></li>
        				<li id="ln_02"><a href="/developer/sitemap/">サイトマップ</a></li>
        				<li id="ln_03"><a href="/" target="_blank">セラーポータルサイトへ</a></li>
        			</ul>
        		</nav>
        	</div>
    	</section>
    	<section class="sec_02">
        	<div class="inner">
<?php /*
        		<nav>
		        	<ul>
	        			<li class="<?php echo is_front_page() ? 'active' : 'normal'; ?>"><a href="<?php echo home_url('/'); ?>"<?php if(is_front_page()): ?> class="selected"<?php endif; ?>>ホーム</a></li>
						<?php if ($menu_list) { ?>
						<?php foreach ($menu_list as $menu) { ?>
						<li class="<?php echo $cur_post_id == $menu->ID ? 'active' : 'normal'; ?>"><a href="<?php echo $menu->guid; ?>"><?php echo $menu->post_title; ?></a></li>
						<?php } ?>
						<?php } ?>
	        			<li class="mobile_only"><a href="#">用語集</a></li>
	        			<li class="mobile_only"><a href="#">サイトマップ</a></li>
	        		</ul>
        		</nav>
*/ ?>
				<nav>
					<?php
						function ps_get_root_page( $cur_post, $cnt = 0 ) {
							if ( $cnt > 100 ) { return false; }
							$cnt++;
							if ( $cur_post->post_parent == 0 ) {
								$root_page = $cur_post;
							} else {
								$root_page = ps_get_root_page( get_post( $cur_post->post_parent ), $cnt );
							}
							return $root_page;
						}

						$root = ps_get_root_page($post);
						$child_list = wp_list_pages('echo=0&depth=1&child_of=' . $root->ID . '&title_li=');
						$child_list = urldecode($child_list);
					?>
					<?php wp_nav_menu( array(
						'theme_location'=>'mainmenu',
						'container'     =>'', 
						'menu_class'    =>'',
						'items_wrap'    =>'<ul id="main-nav">%3$s<div class="mobile-submenu"><div class="mobile-submenu-list">' . $child_list . '</div></div></ul>'));
					?>
				</nav>
        		<?php get_search_form(); ?>
        	</div>
    	</section>
	</header>
	<main>
		<article>