<?php get_header(); ?>

<!-- <section class="sec_mainimage">
	<img src="<?php bloginfo('template_url'); ?>/images/sample/01.jpg" alt="sample" width="790" height="248" />
</section>
 -->

 <section class="sec_01">
	<nav>
		<ul>
			<li class="menu_01">
				<a href="/developer/usecase/appdev/">
					<dl>
						<dt><img src="<?php bloginfo('template_url'); ?>/images/common/menu_icon_01.png" alt="出品" width="80" height="74" /></dt>
						<dd>出品</dd>
					</dl>
				</a>
			</li>
			<li class="menu_02">
				<a href="/developer/usecase/appdev/">
					<dl>
						<dt><img src="<?php bloginfo('template_url'); ?>/images/common/menu_icon_02.png" alt="受注" width="80" height="74" /></dt>
						<dd>受注</dd>
					</dl>
				</a>
			</li>
			<li class="menu_03">
				<a href="/developer/api/other/">
					<dl>
						<dt><img src="<?php bloginfo('template_url'); ?>/images/common/menu_icon_03.png" alt="検索" width="80" height="74" /></dt>
						<dd>検索</dd>
					</dl>
				</a>
			</li>
			<li class="menu_04 edge">
				<a href="/developer/usecase/">
					<dl>
						<dt><img src="<?php bloginfo('template_url'); ?>/images/common/menu_icon_04.png" alt="連携" width="80" height="74" /></dt>
						<dd>連携</dd>
					</dl>
				</a>
			</li>
		</ul>
	</nav>
</section>
<section class="sec_02">
	<dl>
		<dt class="gradient">
			<h2>Products</h2>
		</dt>
		<dd>
			<ul>
				<li><a href="/developer/usecase/">用途にあったAPIを選ぶ</a></li>
				<li><a href="/developer/usecase/appdev/">セラー向けツール</a></li>
				<li><a href="/developer/usecase/largemerch/">ラージマーチャント</a></li>
			</ul>
		</dd>
	</dl>
	<dl>
		<dt class="gradient">
			<h2>API</h2>
		</dt>
		<dd>
			<ul>
				<li><a href="/developer/api/">API紹介</a></li>
				<li><a href="/developer/api/trading/">Trading API</a></li>
				<li><a href="/developer/api/largemerch/">Large Merchant API</a></li>
				<li class="edge"><a href="/developer/api/other/#Finding API">Finding API</a></li>
				<li><a href="/developer/api/other/#Shopping API">Shopping API</a></li>
				<li><a href="/developer/api/other/#Business Policies Mnagement API">その他API</a></li>
			</ul>
		</dd>
	</dl>
	<dl>
		<dt class="gradient">
			<h2>導入ガイド</h2>
		</dt>
		<dd>
			<ul>
				<li><a href="/developer/guide/">API導入ガイド</a></li>
				<li><a href="/developer/guide/usertoken/">ユーザトークン</a></li>
			</ul>
		</dd>
	</dl>
</section>

<section class="sec_02">

	<dl>
		<dt class="gradient">
			<h2><a href="/developer/blog/">最新ブログ投稿</a></h2>
		</dt>

		<dd>
		<?php query_posts('showposts=5'); ?>
		<?php while (have_posts()) { the_post(); ?>
		<div class="entry-archive">
			<div class="post" id="post-<?php the_ID(); ?>">

				<div class="post-date">
					<span><?php the_time('Y/n/j') ?></span>
				</div>

				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
				<?php //the_category(', ') ?>
				
				<div id="line"></div>

				<?php echo mb_substr(strip_tags($post->post_content),0,200) . "..."; ?>

				<div class="readMoreLink">
					<a href="<?php echo get_permalink(); ?>"><?php _e('続きを読む', 'semplicemente') ?><i class="fa spaceLeft fa-angle-double-right"></i></a>
				</div>

				<div class="archive-line"></div>
			</div>
		</div>
		<?php } ?>
		</dd>
	</dl>

</section>

<?php get_footer(); ?>