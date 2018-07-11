(function($) {
$(document).ready(function() {

var viewportTop = $(window).scrollTop();
var viewportBottom = viewportTop + $(window).height();
var videoMovers;

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


// INITIALIZE FULL WIDTH BACKGROUND VIDEO
if ($('.video-wrapper').length != 0) {
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


// CONTROL VIDEO SCROLL
// ELEMENT INSIDE VIEWPORT?
$.fn.isInViewport = function() {
	var elementTop = $(this).offset().top;
	var elementBottom = elementTop + $(this).outerHeight();
	viewportTop = $(window).scrollTop();
	viewportBottom = viewportTop + $(window).height();
	
	return elementBottom > viewportTop && elementTop < viewportBottom;

};

var setTop = 0;
function unlockVideo(video, mover) {
	video.removeClass('freeze-video-position');
	setTop = mover.offset().top;
	setTop = setTop - video.height();
	video.css('top', setTop);
}
function lockVideo(video) {
	video.addClass('freeze-video-position');
	video.css('top', 0);
}

// GET ALL VIDEOS
var videos = $('.video-wrapper');
// MAKE CONTENT OVER VIDEO WIDER
$.each(videos, function() {
	var thisVideo = $(this);
	var classList = thisVideo.attr('class');
	classList = classList.split(" ");
	var videoName = classList[0];
	var videoChildrenSet = thisVideo.nextUntil('.move-video.' + videoName);
	$.each(videoChildrenSet, function() {
		$(this).children().addClass('text-in-video-bg');
	});
});

function displayVideoOverlay(video, anchor) {
	video.siblings('.video-overlay').css({
		'top': anchor,
		'height': video.height()
	});
}

function findVideoAnchor(video) {
	if (video.hasClass('top')) {
		video.css('top', 0);
		return 0;
	} else {
		var previousDiv = video.prev();
		var previousContent = previousDiv.children().children();
		return previousDiv.offset().top + previousDiv.outerHeight();
	}
}

function linkVideoToMover(elem) {
	var classList = elem.attr('class');
	classList = classList.split(" ");
	return videoName = classList[0];
}
var curMoverLink = "";
var videoAnchor = "";
var overlayIndex = 0;

$.each($('.move-video'), function() {
	mover = $(this);
	if (mover.isInViewport()) {
		curMoverLink = linkVideoToMover(mover);
		unlockVideo($('.video-wrapper.' + curMoverLink), $('.move-video.' + curMoverLink));
		console.log('curMoverLink: ' + curMoverLink);
	}
});

// BUG WHEN TOOLBAR IS PRESENT (DISABLE WHEN TESTING)
function checkVideoPositions() {
	$.each(videos, function() {
		var curVideo = $(this);
		curMoverLink = linkVideoToMover(curVideo);
		if (curVideo.isInViewport() || $('.move-video.' + curMoverLink).isInViewport()) {
			videoAnchor = findVideoAnchor(curVideo);
			if (overlayIndex < videos.length) {
				displayVideoOverlay(curVideo, videoAnchor);
				overlayIndex++;
			}
			// WHEN TO LOCK, UNLOCK VIDEO
			if (videoAnchor <= viewportTop) {
				console.log('0');
				if ($('.move-video.' + curMoverLink).isInViewport()) {
					unlockVideo(curVideo, $('.move-video.' + curMoverLink));
					console.log('1');
				}
				else {
					lockVideo(curVideo);
					console.log('2');
				}
			}
			else {
				curVideo.removeClass('freeze-video-position');
				curVideo.css('top', videoAnchor);
				console.log('3');
			}
		}
	});
}
checkVideoPositions();

$(window).on('resize scroll', function() {
	checkVideoPositions();
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
