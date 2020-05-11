// Global variables
var display_mode = "w"; // "w" or "n"
var resize_eventname = "resize"; // "resize" or "orientationchange"
var device = "pc"; // "pc" or "sp"
var touch_device = false;
var user_agent = window.navigator.userAgent.toLowerCase();
/* prettier-ignore */
if ((user_agent.match(/(iphone|iPhone)/) > 0 && user_agent.match(/(ipad|iPad)/) == -1) || user_agent.match(/(ipod|iPod)/) > 0 ||
	user_agent.match(/(android|Android)/) > 0) { resize_eventname = 'orientationchange'; device = 'sp'; }
if (window.ontouchstart === null) {
	touch_device = true;
}
/* ---------------------- function ---------------------- */
function set_display_mode() {
	var break_point = 767;
	display_mode = $(window).innerWidth() <= break_point ? "n" : "w";
}
/* ---------------------- DOM_ready ---------------------- */
$(function () {
	"user strict";
	if (touch_device) {
		$("body").addClass("touch");
	}
	/* resize_event -------------------- */
	var resize_event = function () {
		set_display_mode();
	};
	resize_event();
	$(window).on("load " + resize_eventname, resize_event);
	/* IE,Edgeでのカクつき対応 -------------------- */
	if (
		navigator.userAgent.match(/MSIE 10/i) ||
		navigator.userAgent.match(/Trident\/7\./) ||
		navigator.userAgent.match(/Edge\/12\./)
	) {
		$("body").on("mousewheel", function () {
			event.preventDefault();
			var wd = event.wheelDelta;
			var csp = window.pageYOffset;
			window.scrollTo(0, csp - wd);
		});
	}
	/* prettier-ignore */
	$(".ham__menu").click(function() {
		$(".overlay").stop().fadeToggle();
		$(this).stop().toggleClass("btn-open").stop().toggleClass("btn-close");
		$(".header-btm").stop().toggleClass("is-active");
		$("body").stop().toggleClass("oh-open");
	});
	// PC,Search,  .main-navigation .icon-search
	// console.log(display_mode);
	$(".icon-search").click(function () {
		if ((display_mode = "w")) {
			$(".header-searchbox").stop().toggleClass("is-active");
			$("body").stop().toggleClass("search-open");
		}
	});
	// search__close
	$(".search__close").click(function () {
		if ((display_mode = "w")) {
			$(".header-searchbox").stop().removeClass("is-active");
			$("body").stop().removeClass("search-open");
		}
	});
});
/* ---------------------- DOM_load ---------------------- */
$(window).on("load", function () {
	/* prettier-ignore */
	$(".js-load").delay(400).queue(function() {$(this).addClass("js-load--on").dequeue();});
	/* prettier-ignore */
	$("a[href^='#']").click(function() {var href = $($(this).attr("href")),position = href.offset().top;
		$("body,html").stop(true, false).animate({ scrollTop: position }, 480, "swing");
		return false;
	});
});
/* prettier-ignore */
$(function() {
	$(".overlay").on("click", function(e) {
		if ($("body").hasClass("oh-open")) {
			$(".overlay").stop().fadeToggle();
			$(".ham__menu").stop().toggleClass("btn-open").stop().toggleClass("btn-close");
			$(".ham-inner").stop().toggleClass("is-active");
			$("body").stop().toggleClass("oh-open");
		}
	});
});
$(window).on("load scroll", function () {
	var headNav = $("#masthead");
	if ($(this).scrollTop() > 50 && headNav.hasClass("fixed") == false) {
		headNav.addClass("fixed");
		$("#page").addClass("header_fix");
	} else if ($(this).scrollTop() < 50 && headNav.hasClass("fixed") == true) {
		$("#page").removeClass("header_fix");

		headNav.removeClass("fixed");
	}
});
