(function($) {
$(document).ready(function() {

var viewportTop = $(window).scrollTop();
var viewportBottom = viewportTop + $(window).height();
var videoMovers;

// INITIALIZE VIDEO RELATED VARS IF NEEDED
if ($('.video-wrapper').length != 0) {
	console.log($('.video-wrapper').length);
	var videoWrappers = $('.video-wrapper');
	// $.each()
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
var setTop = 0;
var hitMover = false;
$(window).on('resize scroll', function() {
	$.each($('.video-wrapper'), function() {
		if ($('.video-wrapper').isInViewport()) {
			var curVideo = $(this);
			// STARTING POSITION OF VIDEO
			var previousDiv = curVideo.prev();
			var videoAnchor = previousDiv.offset().top + previousDiv.outerHeight();
			
			var curVideoTag = curVideo.children('video');
			var curVideoTop = curVideo.offset().top;
			var curVideoBottom = curVideoTop + curVideo.height();
			var classList = curVideo.attr('class');
			var classList = classList.split(" ");
			// THE FIRST CLASS IS THE NAME OF THE VIDEO
			var curVideoName = classList[0];
			var videoMover = $('.move-video.' + curVideoName);

			// LOCK, UNLOCK VIDEO IN PLACE
			if ((hitMover == false) && videoAnchor < viewportTop) {
				curVideo.addClass('freeze-video-position');
			}
			if (videoAnchor > viewportTop) {
				curVideo.removeClass('freeze-video-position');
			}
			if ((curVideo.hasClass('freeze-video-position')) && (videoMover.offset().top < viewportBottom) && (videoAnchor < viewportTop)) {
				hitMover = true;
				setTop = videoMover.offset().top;
				setTop = setTop - curVideo.height();
				curVideo.removeClass('freeze-video-position');
				curVideo.css('top', setTop);
			}
			if ((hitMover) && (videoMover.offset().top > viewportBottom)) {
				curVideo.css('top', 0);
				curVideo.addClass('freeze-video-position');
			}
			if ((hitMover) && (curVideo.hasClass('freeze-video-position')) && (videoAnchor > viewportTop)) {
				curVideo.removeClass('freeze-video-position');
				curVideo.css('top', videoAnchor);
			}
		}
	});
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