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

	$('.menu-icon').click(function() {
		$('#secondarymenu').toggleClass('stashed');
	});

	var highCol = Math.max($(".productdetail").height());
	$(".productdetail").height(highCol).addClass("equalheight");


});