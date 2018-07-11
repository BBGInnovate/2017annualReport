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
	
	if (elementBottom > viewportTop && elementTop < viewportBottom) {
		return true;
	} else {
		return false;
	}
};

var videos = [];
var i = 0;
$.each($('.video-wrapper'), function() {
	var classList = $(this).attr('class');
	classList = classList.split(" ");
	var curVideoClass = classList[0];
	videos[i] = $('.' + curVideoClass + '.video-wrapper');
	i++;
});

var setTop = 0;
var lockedVideo = false;
function unlockVideo(video, mover) {
	video.removeClass('freeze-video-position');
	setTop = mover.offset().top;
	setTop = setTop - video.height();
	video.css('top', setTop);
	lockedVideo = false;
}
function lockVideo(video) {
	video.addClass('freeze-video-position');
	video.css('top', 0);
	var lockedVideo = true;
}

// BUG WHEN WP TOOLBAR IS PRESENT (DISABLE WHEN TESTING)
var hitMover = false;
function checkVideoPositions() {
	var i = 0;
	$.each(videos, function() {
		var curVideo = $(this);
		if (curVideo.isInViewport()) {
			// VIDEO NAME CLASS, PAIR TO ITS MOVER
			var classList = curVideo.attr('class');
			classList = classList.split(" ");
			var curVideoName = classList[0];
			var curMover = $('.move-video.' + curVideoName);
			// ORIGINAL PLACE OF VIDEO FOR LOCKING, UNLOCKING
			var videoAnchor = "";
			var previousDiv = curVideo.prev();
			var previousContent = previousDiv.children().children();
			if (curVideo.hasClass('top')) {
				curVideo.css('top', 0);
				videoAnchor = 0;
				console.log('videoAnchor: ' + videoAnchor);
			} else {
				videoAnchor = previousDiv.offset().top + previousDiv.outerHeight();
				console.log('videoAnchor: ' + videoAnchor);
			}

			if (videoAnchor <= viewportTop) {
				if (curMover.isInViewport()) {
					hitMover = true;
					unlockVideo(curVideo, curMover);
					// TESTS
					console.log('1');
					console.log('hitMover: ' + hitMover);
				}
				else {
					if (hitMover) {
						curVideo.css('top', 0);
						// TESTS
						console.log('2');
						console.log('hitMover: ' + hitMover);
					}
					// else {
					// 	hitMover = false;
					// }
					lockVideo(curVideo);
					// TESTS
					console.log('3');
					console.log('hitMover: ' + hitMover);
				}
			}
			// if (hitMover && videoAnchor > viewportTop) {
			if (videoAnchor > viewportTop) {
				curVideo.removeClass('freeze-video-position');
				curVideo.css('top', videoAnchor);
				// TESTS
				console.log('4');
				console.log('hitMover: ' + hitMover);
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
