jQuery(document).ready(function() {

	jQuery("#upsell-products-slider .slider-items").owlCarousel({
		items : 4, //10 items above 1000px browser width
		itemsDesktop : [1024,3], //5 items between 1024px and 901px
		itemsDesktopSmall : [900,3], // 3 items betweem 900px and 601px
		itemsTablet: [600,2], //2 items between 600 and 0;
		itemsMobile : [320,1],
		navigation : true,
		navigationText : ["<a class=\"flex-prev\"></a>","<a class=\"flex-next\"></a>"],
		slideSpeed : 500,
		pagination : false
	});

	var ocClients2 = $("#slider");
	ocClients2.owlCarousel({
		navigationText: false,
		slideSpeed : 300,
		pagination: false,
		paginationSpeed : 400,
		singleItem:true,
		autoPlay: 3000
	});
	$(".slider .next").click(function(){
		ocClients2.trigger('owl.next');
	})
	$(".slider .prev").click(function(){
		ocClients2.trigger('owl.prev');
	})


	var ocClients = $("#productIndex");
	ocClients.owlCarousel({
		navigation : false, // Show next and prev buttons
		navigationText: false,
		slideSpeed : 300,
		pagination: false,
		paginationSpeed : 400,
		itemsCustom : [
			[0, 1],
			[480, 1],
			[700, 3],
			[1000, 3],
			[1200, 3]
		],
		autoPlay: 5000,
	});
	$(".productIndex .next").click(function(){
		ocClients.trigger('owl.next');
	})
	$(".productIndex .prev").click(function(){
		ocClients.trigger('owl.prev');
	})

	var ocClients3 = $("#brand");

	ocClients3.owlCarousel({
		navigation : false, // Show next and prev buttons
		navigationText: false,
		slideSpeed : 300,
		pagination: false,
		paginationSpeed : 400,
		itemsCustom : [
			[0, 2],
			[480, 2],
			[700, 3],
			[1000, 3],
			[1200, 4]
		],
		autoPlay: 5000,
	});


	/* slide ý kiến khách hàng */

	$(".commentlist").owlCarousel({
		navigationText: false,
		slideSpeed : 300,
		pagination: false,
		paginationSpeed : 400,
		singleItem:true,
		autoPlay: 3000
	});



	$('.icon-search').click(function(e){
		e.stopPropagation();
		$(this).toggleClass('open');
		$('.search_mini_form').toggleClass('open');
		$('.cate-overlay2').toggleClass('open');
	});

	$('.cate-overlay2').click(function(e){
		$('.cate-overlay2.open').removeClass('open');
		$('.search_mini_form.open').toggleClass('open');
		$('#open-filters.openf').toggleClass('openf');

	});



	$('.icon-search2').on('click', function(){
		$('#search_mini_form2').slideToggle("300");
	});

	$(".bars").click(function(){
		$(".menu-mb-list").slideToggle("fast");

	});
	$('.menu-mb-list .open-close').click(function(){
		$(this).closest('li').find('>ul').slideToggle("fast");
	});
	$('.toggle-heading .fa').click(function(){
		$(this).closest('li').find('>ul').slideToggle("fast");
	});

	$('.collapsed > i').click(function(){
		$(this).closest('.collapsed > i').toggleClass('active')
	});
	$('.icon-sub-collection').on('click', function() {
		$(this).closest('li').find('>ul').slideToggle("fast");
	});

	/* Slide ảnh nhỏ */ 
	$("#gallery_01").owlCarousel({
		navigation : false, // Show next and prev buttons
		navigationText: false,
		slideSpeed : 300,
		pagination: false,
		paginationSpeed : 400,
		itemsCustom : [
			[0, 3],
			[480, 3],
			[767, 3],
			[1000, 3],
			[1200, 3]
		],
		autoPlay: false,
	});

});




if ($('#back-to-top').length) {
	var scrollTrigger = 100, // px
		backToTop = function () {
			var scrollTop = $(window).scrollTop();
			if (scrollTop > scrollTrigger) {
				$('#back-to-top').addClass('show');
			} else {
				$('#back-to-top').removeClass('show');
			}
		};
	backToTop();
	$(window).on('scroll', function () {
		backToTop();
	});
	$('#back-to-top').on('click', function (e) {
		e.preventDefault();
		$('html,body').animate({
			scrollTop: 0
		}, 700);
	});
}