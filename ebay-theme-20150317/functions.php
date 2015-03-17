<?php
/*==================================================
	wp_enqueue_style と wp_enqueue_script からバージョン削除
================================================== */
add_filter('style_loader_src', 'remove_version');
add_filter('script_loader_src', 'remove_version');
if (!function_exists('remove_version')) {
	function remove_version($src) {
		if (strpos($src, '?ver=')) $src = remove_query_arg('ver', $src);
		return $src;
	}
}
/*==================================================
	wp_enqueue_style で出力される<link>から、idを削除		PHP5.3~
================================================== */
add_filter( 'style_loader_tag', 'func_style_loader_tag', 10, 2 );
function func_style_loader_tag( $html, $handle ) {
	return str_replace( " id='$handle-css'", '', $html );
}
/*==================================================
	自動整形（記事のpタグ・brタグの自動挿入）を無効化（投稿タイプ別）
================================================== */
	add_filter('the_content', 'wpautop_filter', 9);
	function wpautop_filter($content) {
	    global $post;
	    $remove_filter = false;
	     
	    $arr_types = array('page');						//wpautop（自動整形）を無効にする投稿タイプを配列で用意
	    $post_type = get_post_type( $post->ID );
	    if (in_array($post_type, $arr_types)) $remove_filter = true;
	    if ( $remove_filter ) {
	        remove_filter('the_content', 'wpautop');
	        remove_filter('the_excerpt', 'wpautop');
	    }
	    return $content;
	}
/*==================================================
	自動整形（記事のpタグ・brタグの自動挿入）を無効化（全投稿）
================================================== */
	/* remove_filter('the_content', 'wpautop'); */
	
/*==================================================
	wp_titleの$sepが空文字または半角スペースの場合は余分な空白削除
================================================== */
	function my_title_fix($title, $sep, $seplocation){
		if(!$sep || $sep == " "){
			$title = str_replace(' '.$sep.' ', $sep, $title);
		}
		return $title;
	}
	add_filter('wp_title', 'my_title_fix', 10, 3);


/*==================================================
	<head>内の不要項目を消す
================================================== */
	remove_action('wp_head','feed_links_extra',3);
	remove_action('wp_head','rsd_link');
	remove_action('wp_head','wlwmanifest_link');
	remove_action('wp_head','index_rel_link');
	remove_action('wp_head','adjacent_posts_rel_link_wp_head',10,0);
	remove_action('wp_head','parent_post_rel_link',10,0);
	remove_action('wp_head','start_post_rel_link',10,0);
	remove_action('wp_head','wp_generator');

/*==================================================
	Detection	※must active PHP-class "browser.php"
================================================== */
require_once(TEMPLATEPATH . "/php/class/Browser.php");
$browser = new Browser();
require_once(TEMPLATEPATH . "/php/class/Mobile_Detect.php");
$detect = new Mobile_Detect;
	/* ===== Detect Legacy IE(6/7/8/9) ===== */
	function is_lte_ie($version){
		global $browser;
		if( $browser->getBrowser() == Browser::BROWSER_IE && $browser->getVersion() <= $version ) {
			return true;
		}else{
			return false;
		}
	}
	/* ===== IE(>=9) ===== */
	function is_gte_ie($version){
		global $browser;
		if( $browser->getBrowser() == Browser::BROWSER_IE && $browser->getVersion() >= $version ) {
			return true;
		}else{
			return false;
		}
	}
	
	/* ===== Detect Desktop ===== */
	function is_desktop(){
		global $detect;
		if(!$detect->isMobile()){
			return true;
		}else{
			return false;
		}
	}
	/* ===== Detect Phone & Tablet ===== */
	function is_mobile(){
		global $detect;
		if($detect->isMobile()){
			return true;
		}else{
			return false;
		}
	}
	/* ===== Detect Phone ===== */
	function is_phone(){
		global $detect;
		if($detect->isMobile() && !$detect->isTablet()){
			return true;
		}else{
			return false;
		}
	}
	/* ===== Detect Tablet ===== */
	function is_tablet(){
		global $detect;
		if($detect->isTablet()){
			return true;
		}else{
			return false;
		}
	}

/*==================================================
	<body>タグにカスタムなclassを追加
================================================== */
	function custom_body_class($classes){
		global $browser;
	    if($browser->getBrowser() == Browser::BROWSER_IE){		//	ALL IE
			$classes[] = "ie"; 
	    }else{
			$classes[] = "no-ie"; 
	    }
	    if(is_page() && !is_front_page()){
		    $classes[] = "page-static"; 
	    }

	    if(is_single() && !is_front_page()){
		    $classes[] = "page-static";
	    }

		return $classes;
	}
	add_filter('body_class', 'custom_body_class');

	register_nav_menu('mainmenu', 'グローバルメニュー');

	if (function_exists('register_sidebar')) {
		register_sidebar(array(
			'name' => 'サイドバー1',
			'id' => 'sidebar1',
			'description' => 'サイドバー1',
			'before_widget' => '<div class="latest-post">',
			'after_widget' => '</div>',
			'before_title' => '<div class="ttl"><a href="' . get_site_url() . '/blog/' . '" class="gradient">',
			'after_title' => '<span></span></a></div>',
		));
	}

/*==================================================
	ページ送り
================================================== */
function pagination($pages = '', $range = 2) {
	 $showitems = ($range * 2) + 1;
 
	 global $paged;
	 if (empty($paged)) $paged = 1;
 
	 if ($pages == '') {
		 global $wp_query;
		 $pages = $wp_query->max_num_pages;
		 if (!$pages) {
			 $pages = 1;
		 }
	 }
 
	if (1 != $pages) {
		echo '<div class="pagination"><div class="pagination-inner">';

		if ($paged > 1 && $showitems < $pages) {
			echo '<span class="prev"><a href="' . get_pagenum_link($paged - 1) . '">前へ</a></span>';
		}
 		if ($paged > 2 && $paged > $range+1 && $showitems < $pages) {
			echo '<span class="first"><a href="' . get_pagenum_link(1) . '">1</a></span>';
			echo '<span class="between">&nbsp;</span>';
		}

		for ($i = 1; $i <= $pages; $i++) {
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
				echo ($paged == $i) ? '<span class="active">' . $i. '</span>' : '<span><a href="' . get_pagenum_link($i) . '">' . $i . '</a></span>';
			}
		}
 
		if ($paged + $range < $pages) {
			echo '<span class="between">&nbsp;</span>';
			echo '<span class="last"><a href="' . get_pagenum_link($pages) . '">' . $pages . '</a></span>';
		}
		if ($paged < $pages && $showitems < $pages) {
			echo '<span class="next"><a href="' . get_pagenum_link($paged + 1) . '">次へ</a></span>';
		}

		echo '</div></div>';
	 }
}

function new_excerpt_more($more) {
    return '…';
}
add_filter('excerpt_more', 'new_excerpt_more');

?>
