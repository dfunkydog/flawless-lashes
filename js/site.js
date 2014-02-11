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

	$('#menutoggle').click(function() {
		if ($("nav").is(":visible")) {
			$("nav").slideUp(function() {
				$(this).removeAttr("style");
			});
		} else {
			$("nav").slideDown();
		}
	});

	//supersized stuff
	if ($(".home").length > 0) {
		console.log("its home");
		$.supersized({

			// Functionality
			fit_portrait: 0,
			slide_interval: 4000, // Length between transitions
			transition: 3, // 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
			transition_speed: 700, // Speed of transition
			vertical_center: 0, // display image from top
			// Components
			slide_links: 'false', // Individual links for each slide (Options: false, 'num', 'name', 'blank')
			slides: [ // Slideshow Images
				{
					image: 'http://eueyelashinstitute.com/wp-content/uploads/2014/01/eyestk.jpg',
					title: '<p>Gorgeous lashes that give you stunning eyes.</p>'
				}, {
					image: 'http://eueyelashinstitute.com/wp-content/uploads/2013/12/IMG_7835X.jpg',
					title: '<p>Classic or Volume? Nothing is impossible for us!</p>'
				}, {
					image: 'http://eueyelashinstitute.com/wp-content/uploads/2014/01/4Dspecial.jpg',
					title: '<p>"Love my 6D eyelashes and highly recommend them! FANTASTIC!"</p>'
				}, {
					image: 'http://eueyelashinstitute.com/wp-content/uploads/2014/01/IMG_7919-res.jpg',
					title: '<p>Emphasis on striving to create 100% FLAWLESS masterpieces</p>'
				}, {
					image: 'http://www.eueyelashinstitute.com/wp-content/uploads/2013/12/ausra.jpg',
					title: '<p>"Im utterly over the moon with my lashes!"</p>'
				}
			]

		});
	}

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