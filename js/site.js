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

	//.parallax(xPosition, speedFactor, outerHeight) options:
	//xPosition - Horizontal position of the element
	//inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling
	//outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport
	if (!jQuery.browser.mobile) {
		var parapic = $('.parapic');
		if (!$(".testimonials").length > 0) {
			parapic.css("background-attachment", "fixed");
			parapic.parallax("50%", 0.4);
		}
	}

	//qcontent should be hovered paragraphs whilst qcite would be cite
	//grab those pieces when use hovers over blockquote

	function fancyTesti(ele) {
		if (!$(ele).hasClass('active')) {
			$(ele).addClass('active').siblings().removeClass('active');
			var qcontent = $(ele).find("p").clone();
			var qcite = $(ele).find("cite").clone();
			$("#quoteplaceholder p, #quoteplaceholder cite").fadeTo('400', 0.1,
				function() {
					$(this).remove();
					qcontent.prependTo('#quoteplaceholder').fadeTo('400', 1);
					qcite.prependTo('#quoteplaceholder footer').fadeTo('400', 1);
				});
		}
	}
	$(".testimonials blockquote").hoverIntent(function() {
		fancyTesti($(this));
	}, function() {
		/* do nothing */
	});

	$(".testimonials blockquote").click(function() {
		fancyTesti($(this));
	});

	var highCol = Math.max($(".productdetail").height());
	$(".productdetail").height(highCol).addClass("equalheight");

	//paypal popup
	$(".price").click(function() {
		var ppalId = "/" + ($(this).attr("data-ppal-id")) + ".html";
		var ww = $(window).width(),
			ph = $("#ppal");
		var pleft = ((ww - ph.width()) / 2) - 20;
		$("#ppal").load(ppalId,
			function(response, status, xhr) {
				if (status == "error") {
					var msg = "Sorry but there was an error: ";
					$("#error").html(msg + xhr.status + " " + xhr.statusText);
				} else {
					ph.css({
						top: "20%",
						left: pleft
					})
						.show();
					$(".exit").click(function() {
						$("#ppal").hide().empty();
					});
				}
			});

	});
});