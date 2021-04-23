jQuery(document).ready(function() {
	"use strict";
	/* -------------------------------------
			MOBILE MENU
	-------------------------------------- */
	function collapseMenu(){
		$('.th-navigation ul li.th-hasdropdown').prepend('<span class="th-dropdowarrow"><i class="fa fa-angle-down"></i></span>');
		$('.th-navigation ul li.th-hasdropdown span').on('click', function() {
			$(this).next().next().slideToggle(300);
		});
	}
	collapseMenu();
	/* -------------------------------------
			HOME SLIDER
	-------------------------------------- */
	jQuery("#th-homeslider").owlCarousel({
		slideSpeed : 300,
		autoPlay : true,
		paginationSpeed : 400,
		singleItem:true,
		navigation : true,
		pagination : false,
		navigationText: [
			"<span class='th-btncurveprev'><i class='fa fa-long-arrow-left'></i></span>",
			"<span class='th-btncurvenext'><i class='fa fa-long-arrow-right'></i></span>"
		],
	});
	/* ---------------------------------------
			STATISTICS
	 -------------------------------------- */
	try {
		jQuery('.th-counter').appear(function () {
			jQuery('.th-count h3').countTo();
		});
	} catch (err) {}
	/* -------------------------------------
			PRETTY PHOTO GALLERY
	-------------------------------------- */
	jQuery("a[data-rel]").each(function () {
		jQuery(this).attr("rel", jQuery(this).data("rel"));
	});
	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 'normal',
		theme: 'dark_square',
		slideshow: 3000,
		autoplay_slideshow: false,
		social_tools: false
	});
	/* ---------------------------------------
			PORTFOLIO FILTERABLE
	-------------------------------------- */
	function doIsotopeFilter() {
		var $container = jQuery('.th-projects');
		var $optionSets = jQuery('.option-set');
		var $optionLinks = $optionSets.find('a');
		if (jQuery().isotope) {
			var isotopeFilter = '';
			$optionLinks.each(function () {
				var selector = jQuery(this).attr('data-filter');
				var link = window.location.href;
				var firstIndex = link.indexOf('filter=');
				if (firstIndex > 0) {
					var id = link.substring(firstIndex + 7, link.length);
					if ('.' + id == selector) {
						isotopeFilter = '.' + id;
					}
				}
			});
			$container.isotope({
				filter: isotopeFilter
			});
			$optionLinks.each(function () {
				var $this = jQuery(this);
				var selector = $this.attr('data-filter');
				if (selector == isotopeFilter) {
					if (!$this.hasClass('th-active')) {
						var $optionSet = $this.parents('.option-set');
						$optionSet.find('.th-active').removeClass('th-active');
						$this.addClass('th-active');
					}
				}
			});
			$optionLinks.on('click', function () {
				var $this = jQuery(this);
				var selector = $this.attr('data-filter');
				$container.isotope({itemSelector: '.th-project', filter: selector});
				if (!$this.hasClass('th-active')) {
					var $optionSet = $this.parents('.option-set');
					$optionSet.find('.th-active').removeClass('th-active');
					$this.addClass('th-active');
				}
				return false;
			});
		}
	}
	var isotopeTimer = window.setTimeout(function () {
		window.clearTimeout(isotopeTimer);
		doIsotopeFilter();
	}, 1000);
	/* -------------------------------------
			SLIDER
	-------------------------------------- */
	jQuery("#th-docteamslider").owlCarousel({
		autoPlay : false,
		slideSpeed : 300,
		navigation : true,
		pagination : false,
		navigationText: [
			"<span class='th-btnsquareprev'><i class='fa fa-long-arrow-left'></i></span>",
			"<span class='th-btnsquarenext'><i class='fa fa-long-arrow-right'></i></span>"
		],
		itemsCustom : [
			[0, 1],
			[480, 2],
			[992, 3],
			[1200, 4],
		],
	});
	/* -------------------------------------
			TESTIMONIALS SLIDER
	-------------------------------------- */
	jQuery("#th-testimonialslider").owlCarousel({
		slideSpeed : 300,
		paginationSpeed : 400,
		singleItem:true,
		navigation : true,
		pagination : false,
		navigationText: [
			"<span class='th-btnroundprev'><i class='fa fa-angle-left'></i></span>",
			"<span class='th-btnroundnext'><i class='fa fa-angle-right'></i></span>"
		],
	});
	/* -------------------------------------
			Google Map
	-------------------------------------- */
	jQuery("#th-locationmap").gmap3({
		map:{
			options:{
				center:[46.578498,2.457275],
				zoom: 6,
				scrollwheel: false,
				disableDoubleClickZoom: true,
			}
		},
		marker:{
			values:[
				{latLng:[48.8620722, 2.352047], data:"Paris !", options:{icon: "images/mapmarker.png"}},
				{address:"86000 Poitiers, France", data:"Poitiers : great city !", options:{icon: "images/mapmarker.png"}},
				{address:"66000 Perpignan, France", data:"Perpignan ! GO USAP !", options:{icon: "images/mapmarker.png"}}
			],
			options:{
				draggable: false
			},
			events:{
				mouseover: function(marker, event, context){
					var map = $(this).gmap3("get"),
					infowindow = $(this).gmap3({get:{name:"infowindow"}});
					if (infowindow){
						infowindow.open(map, marker);
						infowindow.setContent(context.data);
					} else {
						$(this).gmap3({
							infowindow:{
								anchor:marker,
								options:{content: context.data}
							}
						});
					}
				},
				mouseout: function(){
					var infowindow = $(this).gmap3({get:{name:"infowindow"}});
					if (infowindow){
						infowindow.close();
					}
				}
			}
		}
	});
	/* -------------------------------------
			BRANDS SLIDER
	-------------------------------------- */
	jQuery("#th-brandsslider").owlCarousel({
		autoPlay : false,
		slideSpeed : 300,
		navigation : false,
		pagination : false,
		navigationText: [
			"<span class='th-btnsquareprev'><i class='fa fa-long-arrow-left'></i></span>",
			"<span class='th-btnsquarenext'><i class='fa fa-long-arrow-right'></i></span>"
		],
		itemsCustom : [
			[0, 2],
			[480, 3],
			[992, 4],
			[1200, 6],
		],
	});
	/* -------------------------------------
			ACCORDION
	-------------------------------------- */
	function accordion() {
		jQuery('.th-panelcontent').hide();
		jQuery('#th-accordion h4:first').addClass('active').next().slideDown('slow');
		jQuery('#th-accordion h4').on('click', function() {
			if(jQuery(this).next().is(':hidden')) {
				jQuery('#th-accordion h4').removeClass('active').next().slideUp('slow');
				jQuery(this).toggleClass('active').next().slideDown('slow');
			}
		});
	}
	accordion();
	/* -------------------------------------
			FAQ SMOOTH SCROLL
	-------------------------------------- */
	function scrollTop() {
		$('#th-content').on('click', 'a[href*="#"]:not([href="#"])', function(e) {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('html, body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
				}
			}
		});
	}
	scrollTop();
	/* -------------------------------------
			DATE PICKER
	-------------------------------------- */
	$('.th-datetimepicker').datetimepicker();
});