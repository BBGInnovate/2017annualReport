// THIS WRAPPER FUNCTION MAKES $ AVAILABLE
(function($) {
$(document).ready(function() {

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


// FUNCTIONS TO RUN ON RESIZE
$(window).on('resize', function() {
	changeLogoOnSmallLargeScreens();
	sizePostCats();
});

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

if ($('.featured-image-wrapper').length > 0) {
	$('.main-row').first().css('margin-top', '60rem');
}

}); // END READY
})( jQuery );