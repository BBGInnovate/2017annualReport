// THIS WRAPPER FUNCTION MAKES $ AVAILABLE
(function($) {
$(document).ready(function() {

// VIDEO: MAKE IFRAME YOUTUBE VIDEOS FULL WITDH OF PARENT COLUMN
function iframeSizer() {
	if ($('iframe').length > 0) {
		$.each($('iframe'), function() {
			var mainColumnWidth = $(this).parent().width();
			var dynamicHeight = mainColumnWidth / 1.77778
			$(this).attr('width', mainColumnWidth);
			$(this).attr('height', dynamicHeight);
		});
	}
}
iframeSizer();

// FEATURE IMAGE: NETWORK TEMPLATE. HD SCALE
function networkFeatureImageSizer() {
	if ($('.full-feature-image').length > 0) {
		var featureImageW = $('.full-feature-image').width();
		var dynamicHeight = featureImageW / 1.77778;
		$('.full-feature-image').height(dynamicHeight);
	}
}
networkFeatureImageSizer();

// LOGO SIZE
function changeLogoOnSmallLargeScreens() {
	var navLogoImg = $('.side-logo a span img'),
		navLogoImgRetina = $('.side-logo a span img.retina'),
		mediaPath = "http://annual-report2017.localhost/wp-content/uploads/2018/03/";
	if ($(window).width() < 1010) {
		navLogoImg.attr('src', mediaPath + 'BBG-AR_Logo_Default.png');
		navLogoImgRetina.attr('src', mediaPath + 'BBG-AR_Logo_Retina.png');
	}
	else {
		navLogoImg.attr('src', mediaPath + 'BBG-AR_Logo_Default_White_Text.png');
		navLogoImgRetina.attr('src', mediaPath + 'BBG-AR_Logo_Retina_White_Text.png');
	}
};
changeLogoOnSmallLargeScreens();

// POST CATEGORY TEXT BOX HEIGHT CONSISTENT WITH THUMBNAIL
// WILL THIS BE REPLACED BY RELATED SIDE POSTS?
function sizePostCats() {
	var postCatTextBox = $('.aside-text');
	var postCatImgH = $('.aside-image').height();
	postCatTextBox.css('height', postCatImgH);
}
sizePostCats();

// BACKGROUND SCROLL FADER
if ($('.scroll-fader').length != 0) {
	$('#footer').add('#hb-side-navigation').hide(); // TESTING
	// INIT OPACITY DIV OVER BACKGROUND IMAGE
	var fullBGDiv = $('<div class="full-bg"></div>');
	var fullBGInner = $('<div class="full-bg-inner"></div>');
	fullBGDiv.append(fullBGInner);
	$('body').prepend(fullBGDiv);

	// INIT OTHER SCROLL-FADER ELEMENTS WITH $.EACH WHEN READY

	// INIT SCROLL, FADE VARS
	var lastScroll = 0;
	var fade = Number(fullBGInner.css('opacity'));
	var maxFade = 1;
	var minFade = Number(fullBGInner.css('opacity'));
	var fadeGroup = (maxFade - minFade) * 100;
	var newFade;

	function scrollFade(elem) {
		fade = Number(elem.css('opacity'));
		var bodyPx = ($(this).scrollTop() / $('body').height());
		newFade = ((bodyPx * fadeGroup) / 100) + minFade;
		elem.css('opacity', newFade);
		// UPDATE VALUES
		fade = elem.css('opacity');
		lastScroll = $(this).scrollTop();
	}
	scrollFade(fullBGInner);
	
	$(window).scroll(function(event){
		scrollFade(fullBGInner);
	});
}

// PROFILE EXPAND
if ($('.profile').length > 0) {
	var revealers = $('.profile .show-more.reveal');
	var addtlContent = $('.reveal-content');
	addtlContent.hide();
	$.each(revealers, function() {
		var curRevealer = $(this);
		curRevealer.on('click', function() {
			if (curRevealer.prev().css('display') == 'none') {
				curRevealer.text('Show Less');
				curRevealer.prev().slideDown();
			}
			else {
				curRevealer.text('Show More');
				curRevealer.prev().slideUp();
			}
		})
	})
}

// KEEPS FEATURED MEDIA SCALED AT HD PROPORTIONS
function featuredMediaHD() {
	if ($('.featured-image-wrapper').length > 0) {
		var hd_scale = 1.77778;
		var containerW = $(window).width();
		var dynHeight = containerW / hd_scale;
		$('.featured-image-wrapper').width(containerW);
		$('.featured-image-wrapper').height(dynHeight);
		var contentTopMargin = dynHeight;
		$('.main-row').first().css('margin-top', contentTopMargin);
	}
}
featuredMediaHD();

// CLICK TO INITIATE "VIDEO PLAY"
if ($('video').length > 0) {
	var video = $('video');
	var videoElement = video.get(0);
	$('.video-directions').on('click', function() {
		var curScroll = $(window).scrollTop();
		$(window).scrollTop(curScroll + 1);
		if (videoElement.paused) {
			$('.video-directions').hide();
		}
	});
}
// REMOVE VIDEO CONTROLS ON SMALL SIZES
function videoControlsByWindowSize() {
	if ($(window).width() < 768) {
		if ($('.standalone-video-bg').children('.inner-video').attr('autoplay', '')) {
			$('.standalone-video-bg').children('.inner-video').removeAttr('autoplay');
		}
		$('.standalone-video-bg').children('.inner-video').attr('controls', '');
		$('.background-video').hide();
		$('.video-directions').hide();
	} else {
		$('.standalone-video-bg').children('.inner-video').removeAttr('controls');
		$('.standalone-video-bg').children('.inner-video').attr('autoplay', '');
		$('.background-video').show();
		$('.video-directions').show();
	}
}
videoControlsByWindowSize()

// FUNCTIONS TO RUN ON RESIZE
$(window).on('resize', function() {
	networkFeatureImageSizer();
	iframeSizer();
	changeLogoOnSmallLargeScreens();
	sizePostCats();
	featuredMediaHD();
	videoControlsByWindowSize();
});

}); // END READY
})( jQuery );