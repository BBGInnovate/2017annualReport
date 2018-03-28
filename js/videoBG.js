(function($) {
$(document).ready(function() {

var winW = $(window).width();
var winH = $(window).height();

// KEEP VIDEO HD PROPORTIONS (PERCENTAGE)
var pcx = 1.77778;
var dynWidth = winH * pcx;
var dynHeight = winW / pcx;

var videoBox = $('.video-box');
var videoWrapper = $('.video-wrapper');
var video = $('.video-tag');

function sizeVideo(videoW, videoH) {
	videoWrapper.css({
		'width': videoW,
		'height': videoH
	});
	video.css({
		'width': videoW,
		'height': videoH
	});
}

function windowVideoSize() {
	winW = $(window).width();
	winH = $(window).height();
	dynWidth = winH * pcx;
	dynHeight = winW / pcx;
	if (winH > dynHeight) {
		// SIZE HEIGHT FIRST
		sizeVideo(dynWidth, winH);
	}
	else {
		// SIZE WIDTH FIRST
		sizeVideo(winW, dynHeight);
	}
}
windowVideoSize();

$(window).on('resize', function(){
	windowVideoSize();
});

// ELEMENT INSIDE VIEWPORT?
$.fn.isInViewport = function() {
	var elementTop = $(this).offset().top,
		elementBottom = elementTop + $(this).outerHeight(),
		viewportTop = $(window).scrollTop(),
		viewportBottom = viewportTop + $(window).height();

	return elementBottom > viewportTop && elementTop < viewportBottom;
};

$(window).on('resize scroll', function() {
// BOTTOM POS OF VIDEO STILL FISHY WITH WP MENU BAR
	if ($('.move_video').isInViewport()) {
		var setTop = $('.move_video').offset().top;
		setTop = setTop - video.height();

		if ($(window).width() < 1010) {
			setTop = setTop - $('.hb-resp-bg').outerHeight();
		}

		videoWrapper.css({'position': 'absolute', 'top': setTop});
	} else {
		videoWrapper.css({'position': 'fixed', 'top': 0});
	}
	($('.move_video').offset().top < $(window).scrollTop()) ? video.hide() : video.show();
});

// TESTING
// ------------------------------------------------------------------------------------------
console.log("browser window: " + winW + " x " + winH);

// GET COORDS OF MOUSE POS
function printMousePos(event) {
  console.log("clientX: " + event.clientX + " - clientY: " + event.clientY);
}
document.addEventListener("click", printMousePos);
// ------------------------------------------------------------------------------------------

}); // END READY
})( jQuery );