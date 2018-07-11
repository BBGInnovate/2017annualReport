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

// GET ALL THE VIDEOS BY THEIR CLASS (NAME)
var videos = [];
var i = 0;
$.each($('.video-wrapper'), function() {
	var classList = $(this).attr('class');
	classList = classList.split(" ");
	var curVideoClass = classList[0];
	videos[i] = $('.' + curVideoClass + '.video-wrapper');
	// videos[i].siblings('.video-overlay').css({
	// 	'top': videos[i].offset().top,
	// });
	var videoChildrenSet = videos[i].nextUntil('.move-video.' + curVideoClass);
	$.each(videoChildrenSet, function() {
		$(this).children().addClass('text-in-video-bg');
	});
	i++;
});
// BUG WHEN TOOLBAR IS PRESENT (DISABLE WHEN TESTING)
function checkVideoPositions() {
	$.each(videos, function() {
		var curVideo = $(this);
		if (curVideo.isInViewport()) {
			// GET VIDEO CLASS(NAME), PIN IT TO ITS MOVER CLASS (NAME)
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
			} else {
				videoAnchor = previousDiv.offset().top + previousDiv.outerHeight();
			}
			console.log('two');
			curVideo.siblings('.video-overlay').css({
				'top': videoAnchor,
				'height': curVideo.height()
			});
			// WHEN TO LOCK, UNLOCK VIDEO
			if (videoAnchor <= viewportTop) {
				if (curMover.isInViewport()) {
					unlockVideo(curVideo, curMover);
				}
				else {
					lockVideo(curVideo);
				}
			}
			else {
				curVideo.removeClass('freeze-video-position');
				curVideo.css('top', videoAnchor);
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
