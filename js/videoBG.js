(function($) {
$(document).ready(function() {

var viewportTop = $(window).scrollTop();
var viewportBottom = viewportTop + $(window).height();
var videoMovers;

// INITIALIZE VIDEO RELATED VARS IF NEEDED
if ($('.video-wrapper').length != 0) {
	var videoWrappers = $('.video-wrapper');
console.log('videoWrappers lenght: ' + videoWrappers.length);
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


// CONTROL VIDEO SCROLL
// ELEMENT INSIDE VIEWPORT?
$.fn.isInViewport = function() {
	var elementTop = $(this).offset().top;
	var elementBottom = elementTop + $(this).outerHeight();
	viewportTop = $(window).scrollTop();
	viewportBottom = viewportTop + $(window).height();
	
	if (elementBottom > viewportTop && elementTop < viewportBottom) {
		return true;
	} else {
		return false;
	}
};

var videos = [];
var videoClassTargets = [];
var setTop = 0;
var hitMover = false;
var i = 0;

$.each($('.video-wrapper'), function() {
	var classList = $(this).attr('class');
	classList = classList.split(" ");
	var curVideoClass = classList[0];
	videos[i] = $('.' + curVideoClass + '.video-wrapper');
	i++;
});

function unlockVideo(video, mover) {
	video.removeClass('freeze-video-position');
	setTop = mover.offset().top;
	setTop = setTop - video.height();
	video.css('top', setTop);
}
function lockVideo(video) {
	video.addClass('freeze-video-position');
}

function checkVideoPositions() {
	var i = 0;
	$.each(videos, function() {
		var curVideo = $(this);
		if (curVideo.isInViewport()) {
			var classList = curVideo.attr('class');
			classList = classList.split(" ");
			var curVideoName = classList[0];
			var curMover = $('.move-video.' + curVideoName);
			var videoAnchor = "";
			var previousDiv = curVideo.prev();
			var previousContent = previousDiv.children().children();
			// if (previousContent.length == 1) {
			// 	curVideo.css('top', 0);
			// 	videoAnchor = 0;
			// } else {
			// 	videoAnchor = previousDiv.offset().top + previousDiv.outerHeight();
			// }
			if (curVideo.hasClass('top')) {
				curVideo.css('top', 0);
				videoAnchor = 0;
			} else {
				videoAnchor = previousDiv.offset().top + previousDiv.outerHeight();
			}

			if (videoAnchor < viewportTop) {
				if (curMover.isInViewport()) {
					hitMover = true;
					curVideo.removeClass('freeze-video-position');
					setTop = curMover.offset().top;
					setTop = setTop - curVideo.height();
					curVideo.removeClass('freeze-video-position');
					curVideo.css('top', setTop);
console.log('1');
				}
				else {
					if (hitMover) {
						curVideo.css('top', 0);
console.log('2');
					}
					curVideo.addClass('freeze-video-position');
console.log('3');
				}
			}
			if (hitMover && videoAnchor > viewportTop) {
				curVideo.removeClass('freeze-video-position');
				curVideo.css('top', videoAnchor);
console.log('4');
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
