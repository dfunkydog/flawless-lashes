jQuery(document).ready(function($) {

	function viewport() {
	    var e = window, a = 'inner';
	    if (!('innerWidth' in window )) {
	        a = 'client';
	        e = document.documentElement || document.body;
	    }
	    return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
	}

	// declaring here because will need to use in different functions
	var subMenu = $('.sub-menu'),
		hasSubMenu = subMenu.parent();

		if( viewport().width > 960 ){
			subMenu.slideUp();
		}

	function dropMenu(){
			hasSubMenu.hoverIntent(function() {
				if( viewport().width > 960 ) {
					$(this).find('.sub-menu').slideDown();
				}
			}, function() {
				if( viewport().width > 960 ) {
					$(this).find('.sub-menu').slideUp();
				}
			});
	}
	dropMenu();

	$('.menu-icon').on('click',function(){
		$(this).parent().toggleClass('active');
		$('#global-menu ul.menu').toggleClass('hidden');
	});

	var highCol = Math.max($('.productdetail').height());
	$('.productdetail').height(highCol).addClass('equalheight');

	/* when resized if viewport is larger than 960 & menu is hidden
	 	please unhide the menu but only show top level items
	 */
	$(window).on('debouncedresize', function(){
		if( viewport().width > 960 ) {
			if( $('#global-menu ul.menu').hasClass('hidden') ) {
				$('#global-menu ul.menu').removeClass('hidden');
			}
			subMenu.slideUp();
			dropMenu();
		} else {
			//show all submenus at smaller screen sizes
			subMenu.css({'display':'block'});
		}
	});
});