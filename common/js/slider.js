$(function () {
	var $slider = $(".slider"),
		$slider_nav_container = $(".slider-nav-container"),
		$slider_nav = $(".slider-nav");
	$slider_nav.append($slider.contents().clone());
	$slider.slick({
		asNavFor: $slider_nav,
		waitForAnimate: false,
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: false,
		arrows: false,
		pauseOnFocus: false,
		pauseOnHover: false,
		customPaging: function (slick, index) {
			var num = slick.$slides.eq(index).html();
			return "●";
		},
		dots: true,
	});
	$slider_nav.slick({
		appendArrows: $slider_nav_container,
		slidesToShow: 4,
		asNavFor: $slider,
		focusOnSelect: true,
	});
});
