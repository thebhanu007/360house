$(document).ready(function (){
	//Смена фона на Главной
	// var x = 1;
	// var slides = $('.animate-slider li img');
 	
	// setInterval(function () {
	//    $(slides).fadeOut(0);
	//    $(slides).parents(".animate-slider>li:nth-child(" + x + ")").find("img").fadeIn(1000);
	 
	//     if (x == slides.length)
	//         x = 1;
	//     else
	//         x++;
	// }, 9000);

	//Моб сайдбар
	$('.sidebar-btn').click(function (){
		openSidebar();
	});

	$('.sidebar .close-btn').click(function (){
		closeSidebar();
	});

	function openSidebar() {
		$('.sidebar').addClass('show');
		$('html').css('overflow', 'hidden');
		$("body").append("<div class='overlay'></div>");
	};

	function closeSidebar() {
		$('.sidebar').removeClass('show');
		$('html').css('overflow', 'auto');
		$('.overlay').remove();
	};

	jQuery(function($){
		$(document).mouseup(function (e){ 
			if ($(".sidebar").hasClass('show')) {
				var div = $(".sidebar");
				if (!div.is(e.target)
				    && div.has(e.target).length === 0) {
					closeSidebar();
				}
			}
		});
	});

	//Фильтр
	$('.filter-btn').click(function (){
		$(this).toggleClass('active');
		$(this).parents('.tabs').find('.search-filter').slideToggle();
	});

	//Стилизаци Селектов
	(function($) {
		$(function() {
			$('select, .input_file').styler({
				selectSearch: false,
				fileBrowse: 'Загрузить изображение',
			});
		});
	})(jQuery);

	//Меню
	$('header .mobMenu-btn').click(function (){
		openSlideMenu();
	});

	$('.mobMenu-btn.open').click(function (){		
		closeSlideMenu();
	});

	function openSlideMenu() {
		$('header .mobMenu-btn').addClass('open');
		$('.mob-menu').addClass('open');
		$('html').css('overflow', 'hidden');
		$("body").append("<div class='overlay'></div>");
	};

	function closeSlideMenu() {
		$('header .mobMenu-btn').removeClass('open');
		$('.mob-menu').removeClass('open');
		$('html').css('overflow', 'auto');
		$('.overlay').remove();
	};

	jQuery(function($){
		$(document).mouseup(function (e){ 
			if ($(".mob-menu").hasClass('open')) {
				var div = $(".mob-menu");
				if (!div.is(e.target)
				    && div.has(e.target).length === 0) {
					closeSlideMenu();
				}
			}
		});
	});

	$(function() {
		$(".dotted__hidden").dotdotdot();
		$('.dotted__read').click(function (){
			if ($(this).hasClass('show')) {
				$(this).text('Читать полностью >>');
				$(this).removeClass('show');
				$(this).parents('.dotted').find('.dotted__hidden').removeClass('show').dotdotdot();
			} else {
				$(this).addClass('show');
				$(this).text('Свернуть');
				$(this).parents('.dotted').find('.dotted__hidden').addClass('show').trigger('destroy');
			}
		});
	});

	//ТАБЫ
	$('ul.tabs__caption').on('click', 'li:not(.active)', function() {
		$(this).addClass('active').siblings().removeClass('active')
		.closest('div.tabs').find('div.tabs__content').removeClass('active')
		.eq($(this).index()).addClass('active');
	});

	$('#select-tarrifs .tabs__caption li').click(function (){
		if ($('#select-tarrifs .banner-trigger').hasClass('active')) {
			$('#select-tarrifs .banner').removeClass('show');
			
		} else {
			$('#select-tarrifs .banner').addClass('show');
		}
	});

	//Вертикальные табы
	$('.vertical-tabs__title').click(function () {
		$(this).next('.vertical-tabs__body').slideToggle();
		$(this).toggleClass('open');
	});

	$('.card-slider').slick({
		infinite: false,
		slidesToShow: 5,
		slidesToScroll: 1,
		swipeToSlide: true,
		infinite: true,
		prevArrow: "<div class='prev-btn'></div>",
		nextArrow: "<div class='next-btn'></div>",
		responsive: [
			{breakpoint: 1199, settings: {slidesToShow: 4,}},
			{breakpoint: 992, settings: {slidesToShow: 3,}},
			{breakpoint: 768, settings: {slidesToShow: 2,}},
			{breakpoint: 576, settings: {slidesToShow: 1,}}
		]
	});

	$('.reviews-slider').slick({
		infinite: false,
		slidesToShow: 2,
		rows: 2,
		slidesToScroll: 1,
		swipeToSlide: true,
		infinite: true,
		prevArrow: "<div class='prev-btn'></div>",
		nextArrow: "<div class='next-btn'></div>",

		responsive: [
			{breakpoint: 992, settings: {rows: 1, slidesToShow: 1}},
		]
	});	

	$('.article').each(function() {
		$('.article__slider', this).slick({
			slidesToShow: 1,
			arrows: false,
			dots: false,
			asNavFor: $('.article__sliderNav', this),
			infinite: true,
			speed: 500,
			fade: true,
			cssEase: 'linear',
			prevArrow: "<div class='prev-btn'></div>",
			nextArrow: "<div class='next-btn'></div>",

			responsive: [
				{breakpoint: 991, settings: {slidesToShow: 1, arrows: true,}}
			]
		});

		$('.article__sliderNav', this).slick({
			slidesToShow: 3,
			asNavFor: $('.article__slider', this),
			vertical: true,
			verticalSwiping: true,
			swipeToSlide: true,
			arrows: true,
			dots: false,
			focusOnSelect: true,
			autoplay: false,
			infinite: true,
			prevArrow: "<div class='top-btn'></div>",
			nextArrow: "<div class='bot-btn'></div>",
			responsive: [
				{breakpoint: 1199, settings: {slidesToShow: 3,}},
				{breakpoint: 991, settings: {vertical: false,  slidesToShow: 3,}},
				{breakpoint: 576, settings: {vertical: false,  slidesToShow: 3,}},
			]
		});
	});

	$('.announcement').each(function() {
		$('.announcement__slider', this).slick({
			slidesToShow: 1,
			arrows: false,
			dots: false,
			asNavFor: $('.announcement__navSlider', this),
			infinite: true,
			speed: 500,
			fade: true,
			cssEase: 'linear',
			prevArrow: "<div class='prev-btn'></div>",
			nextArrow: "<div class='next-btn'></div>",

			responsive: [
				{breakpoint: 991, settings: {slidesToShow: 1, arrows: true,}}
			]
		});

		$('.announcement__navSlider', this).slick({
			slidesToShow: 3,
			asNavFor: $('.announcement__slider', this),
			swipeToSlide: true,
			arrows: true,
			dots: false,
			// focusOnSelect: true,
			autoplay: false,
			infinite: true,
			prevArrow: "<div class='prev-btn'></div>",
			nextArrow: "<div class='next-btn'></div>",
			responsive: [
				{breakpoint: 1199, settings: {slidesToShow: 3,}},
				{breakpoint: 991, settings: {vertical: false,  slidesToShow: 3,}},
				{breakpoint: 576, settings: {vertical: false,  slidesToShow: 3,}},
			]
		});
	});

	$('.zoom-gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		closeOnContentClick: false,
		closeBtnInside: false,
		mainClass: 'mfp-with-zoom mfp-img-mobile',
		image: {
			verticalFit: true,
			// titleSrc: function(item) {
			// 	return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
			// }
		},
		gallery: {
			enabled: true
		},
		zoom: {
			enabled: true,
			duration: 300, // don't foget to change the duration also in CSS
			opener: function(element) {
				return element.find('img');
			}
		}
	});

	//Чексбокс, персон данные
	$('.person-data input').change(function (){
		var button = $(this).parents('form').find('button');

		if ($(this).prop('checked')){
			button.attr('disabled', false);
		} else{
			button.attr('disabled', true);
		}
	});





	/* ============== */

});