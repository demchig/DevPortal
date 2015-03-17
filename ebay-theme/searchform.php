<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<div class="search_text"><input type="text" value="<?php echo $_REQUEST['s']; ?>" name="s" id="s" placeholder="search" /></div>
	<div class="search_btn"><input type="submit" id="searchsubmit" value="Search" /></div>
</form>