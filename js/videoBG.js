(function($) {
$(document).ready(function() {

var viewportTop = $(window).scrollTop();
var viewportBottom = viewportTop + $(window).height();
var videoMovers;

// INITIALIZE VIDEO RELATED VARS IF NEEDED
if ($('.video-wrapper').length != 0) {
	console.log($('.video-wrapper').length);
	var videoWrappers = $('.video-wrapper');
	var videoTags = $('.video-tag');
	if ($('.move-video')) {
		videoMovers = $('.move-video');
	}
		// HD PROPORTIONS (PERCENTAGE)
		pcx = 1.77778,
		videoOverlay = $('<div class="video-overlay"></div>');

	windowVideoSize();
	videoWrappers.prepend(videoOverlay);
}

function getVideoTop() {
	$.each(videoWrappers, function() {
		var curVideoTop = $(this).offset().top;
		console.log('curVideoTop: ' + curVideoTop);
	});
}

function sizeVideo(videoW, videoH) {
	videoWrappers.css({
		'width': videoW,
		'height': videoH
	});
	videoTags.css({
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
	viewportTop = $(window).scrollTop();
	viewportBottom = viewportTop + $(window).height();
	windowVideoSize();
});

// ELEMENT INSIDE VIEWPORT?
$.fn.isInViewport = function() {
	var elementTop = $(this).offset().top;
	var elementBottom = elementTop + $(this).outerHeight();
	viewportTop = $(window).scrollTop();
	viewportBottom = viewportTop + $(window).height();
	
	if (elementBottom > viewportTop && elementTop < viewportBottom) {
		return true;
	}
	// return elementBottom > viewportTop && elementTop < viewportBottom;
};

// KEEP VIDEO TAG AND MOVE-VIDEO BLOCK TOGETER
var curVideo = "";
var curVideoName = "";
var curVideoTop = "";
var videoMovers = $('.move-video');
var curVideoMover = "";
var setTop = 0;
$(window).on('resize scroll', function() {
	// TESTING
	$.each($('.video-wrapper'), function() {
		if ($('.video-wrapper').isInViewport()) {
			curVideo = $(this);
			var curVideoTag = curVideo.children('video');
			curVideoTop = curVideo.offset().top;
			var classList = curVideo.attr('class');
			var classList = classList.split(" ");
			// THE FIRST CLASS IS THE NAME OF THE VIDEO
			curVideoName = classList[0];
			var videoMover = $('.move-video.' + curVideoName);

			// CHECK VIDEO, MOVER POSITIONS
			if (curVideo.isInViewport()) {
				console.log("The video is here");
			}
			if (curVideoTop <= viewportTop) {
				console.log("The video has hit the top");
				curVideo.addClass('freeze-video-position');
			}
			if (videoMover.isInViewport()) {
				setTop = videoMover.offset().top;
				setTop = setTop - curVideo.height();
			}
			if (videoMover.offset().top <= viewportBottom) {
				console.log('MOVE IT');
				curVideo.removeClass('freeze-video-position');
				curVideo.css('top', setTop);
				// curVideo.css('top', 0);
			}
		}
	});

// 	if ($('.video-wrapper').length != 0) {
// 		// BOTTOM POS OF VIDEO STILL FISHY WITH WP MENU BAR
// 		videoPusher = $('.move-video');
// 		if ($('.video-wrapper').isInViewport()) {
// 			console.log('I see the video.');
// 		}
// 		if (videoPusher.isInViewport()) {
// 			var setTop = videoPusher.offset().top;
// 			setTop = setTop - videoTags.height();

// 			// WITH HB MEDIA QUERY, WHEN NAV MOVES TO TOP
// 			if ($(window).width() < 1010) {
// 				setTop = setTop - $('.hb-resp-bg').outerHeight();
// 			}

// 			videoWrappers.add(videoWrappers).css({'position': 'absolute', 'top': setTop});
// 		} else {
// 			videoWrappers.css({'position': 'fixed', 'top': 0, 'left': 0});
// 		}
// 		(videoPusher.offset().top < $(window).scrollTop()) ? videoTags.hide() : videoTags.show();
// 	}
});






// TESTING
// ------------------------------------------------------------------------------------------
console.log("browser window: " + $(window).width() + " x " + $(window).height());

// GET COORDS OF MOUSE POS
function printMousePos(event) {
  console.log("clientX: " + event.clientX + " - clientY: " + event.clientY);
}
document.addEventListener("click", printMousePos);
// ------------------------------------------------------------------------------------------

}); // END READY
})( jQuery );