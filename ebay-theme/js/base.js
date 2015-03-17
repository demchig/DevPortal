jQuery(function(){
	jQuery('#header .sec_02 nav').meanmenu({
		meanMenuContainer	: "#header",
		meanScreenWidth		: "800"
	});
	jQuery("a[href^='#']").smoothScroll({
		easing: "easeOutQuint",
		duration: 500
	});
});