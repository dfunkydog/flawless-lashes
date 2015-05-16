jQuery(document).ready(function($) {

	$(".sub-menu").parent().hoverIntent(function() {
		$(this).find(".sub-menu").slideDown();
	}, function() {
		$(this).find(".sub-menu").slideUp();
	});
	$(".sub-menu").parent().on('touchmove', function(event) {
		event.preventDefault();
		if (!$(this).hasClass("down")) {
			$(this).find(".sub-menu").slideDown().addClass("down");
		}
	});
	$(document).on('click', function(event) {
		if ($(".sub-menu").hasClass("down")) {
			$(".sub-menu").slideUp().removeClass("down");
		}
	});

	$('.menu-icon').on("click",function(e){
		$(this).parent().toggleClass('active');
		$("#global-menu ul.menu").toggleClass("hidden");
	})
	var highCol = Math.max($(".productdetail").height());
	$(".productdetail").height(highCol).addClass("equalheight");


	function viewport() {
	    var e = window, a = 'inner';
	    if (!('innerWidth' in window )) {
	        a = 'client';
	        e = document.documentElement || document.body;
	    }
	    return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
	}
	$(window).on("debouncedresize", function(e){
		if( viewport().width > 960 ) {
			if( $("#global-menu ul.menu").hasClass("hidden") ) {
				$("#global-menu ul.menu").removeClass("hidden");
			}
		}
	});

});