(function($) {
$(document).ready(function() {

// INITIALIZE VIDEO RELATED VARS IF NEEDED
if ($('.video-wrapper').length != 0) {
	var videoWrapper = $('.video-wrapper'),
		video = $('.video-tag'),
		// HD PROPORTIONS (PERCENTAGE)
		pcx = 1.77778,
		videoOverlay = $('<div class="video-overlay"></div>');
	windowVideoSize();
	videoWrapper.prepend(videoOverlay);
}

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

$(window).on('resize', function() {
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
	videoPusher = $('.move_video');
	if (videoPusher.isInViewport()) {
		var setTop = videoPusher.offset().top;
		setTop = setTop - video.height();

		// WITH HB MEDIA QUERY, WHEN NAV MOVES TO TOP
		if ($(window).width() < 1010) {
			setTop = setTop - $('.hb-resp-bg').outerHeight();
		}

		videoWrapper.add(videoWrapper).css({'position': 'absolute', 'top': setTop});
	} else {
		videoWrapper.css({'position': 'fixed', 'top': 0});
	}
	(videoPusher.offset().top < $(window).scrollTop()) ? video.hide() : video.show();
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