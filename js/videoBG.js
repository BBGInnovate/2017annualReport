(function($) {
$(document).ready(function() {

var winW = $(window).width();
var winH = $(window).height();
console.log(winW + " x " + winH);

// KEEP VIDEO HD PROPORTIONS (PERCENTAGE)
var pcx = 1.77778;
var dynWidth = winH * pcx;
var dynHeight = winW / pcx;

var videoBox = $('.video-box');
var videoWrapper = $('.video-wrapper');
var video = $('.video-tag');

function resizeVideo(videoW, videoH) {
	videoWrapper.css({
		'width': videoW,
		'height': videoH
	});
	video.css({
		'width': videoW,
		'height': videoH
	});
}
resizeVideo(dynWidth, winH);

$(window).on('resize', function(){
	winW = $(window).width();
	winH = $(window).height();
	dynWidth = winH * pcx;
	dynHeight = winW / pcx;
	if (winH > dynHeight) {
		// SIZE HEIGHT FIRST
		resizeVideo(dynWidth, winH);
	}
	else {
		// SIZE WIDTH FIRST
		resizeVideo(winW, dynHeight);
	}
});


// TEST VIEWPORT DIVS TO CHANGE VIDEO POSITIONING
// https://medium.com/talk-like/detecting-if-an-element-is-in-the-viewport-jquery-a6a4405a3ea2
$.fn.isInViewport = function() {
	var elementTop = $(this).offset().top;
	var elementBottom = elementTop + $(this).outerHeight();

	var viewportTop = $(window).scrollTop();
	var viewportBottom = viewportTop + $(window).height();

	return elementBottom > viewportTop && elementTop < viewportBottom;
};

// var bottomPos;
// function findVideoPosToSet() {
// 	var windowSize = $(window).scrollTop();
// 	var eleFromTop = $('#move_video').offset().top;
// 	bottomPos = eleFromTop - windowSize;
// 	console.log('windowSize:' + windowSize);
// 	console.log('eleFromTop:' + eleFromTop);
// 	console.log('bottomPos:' + bottomPos);
// 	return eleFromTop - windowSize;
// }
// var vbp = 0;
// if ($('#move_video').isInViewport()) {
// 	vbp = findVideoPosToSet();
// }

// $(window).on('resize', function() {
// 	bottomPos = findVideoPosToSet();
// });

$(window).on('resize scroll', function() {
	// TEST MORE INSTANCES WITH CLASS (MOVERS) AND IDS (WHICH TO MOVE WHAT VIDEO)
	if ($('#move_video').isInViewport()) {
		var videoH = video.outerHeight();
		videoWrapper.css({
			'position': 'absolute',
			'bottom': winH,
		});
	} else {
		videoWrapper.css({
			'position': 'fixed',
			'bottom': 0
		});
	}
});


function printMousePos(event) {
  console.log("clientX: " + event.clientX + " - clientY: " + event.clientY);
}
document.addEventListener("click", printMousePos);


}); // END READY
})( jQuery );