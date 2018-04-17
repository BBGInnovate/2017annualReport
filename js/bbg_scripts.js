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

var canvasDiv = document.getElementById('chart_test');
if (canvasDiv != null) {
	var canvasDivW = canvasDiv.width;
	canvasDiv.style.marginRight = 'auto';
	canvasDiv.style.marginLeft = 'auto';
}
// DYNAMIC CHARTS: ACCEPT VALUES FROM PHP AND CUSTOM POST TYPES
// STRIP JSON STRING OF BRACKETS, SEPARATE AT COMMAS, MAKE NUMBERS
function stripEncodedEnds(str) {
	str = str.substr(1);
	str = str.substr(0, str.length -1);
	return str;
}
function encodedStrToArr(str, dataType) {
	var arr = [];
	str = str.substr(1);
	str = str.substr(0, str.length -1);
	arr = str.split(",");

	if (dataType == "number") {
		for (var i = 0; i < arr.length; i++) {
			arr[i] = Number(arr[i]);
		}
	}
	return arr;
}

if (hasChart == true) {
	jsonTitle = stripEncodedEnds(jsonTitle);
	jsData = encodedStrToArr(jsonData, 'number');
	jsLabels = encodedStrToArr(jsonLabels, 'text');

	// CHART TEST
	var chart1 = document.getElementById('chart_test').getContext('2d');
	var testChart = new Chart(chart1, {
		type: 'bar',
		data: {
			labels: jsLabels,
			datasets: [{
				label: 'Testing ChartJS',
				data: jsData,
				backgroundColor: [
					'#9f1d25',
					'#147bd1',
					'#c0bb87',
					'#283266',
					'#8b8278'
				]
			}]
		},
		options: {
			title: {
				display: true,
				text: jsonTitle,
				fontSize: 25
			},
			legend: {
				display: false,
				position: 'right',
			}
		},
		layout: {
			padding: {}
		}
	});
}

// GIVE STYLE TO PARAGRAPHS IN VIDEO REALM
if ($('.video-wrapper').length != 0) {
	var level1_ptags = $('.grid-contents').children('p');
	level1_ptags.each(function() {
		$(this).css('margin-bottom','4em');
		if ($(this).next().hasClass('move_video')) {
			return false;
		}
	});
}

// TESTS 
// -------------------------
if ($('.bg_scroll').length != 0) {
	$('#footer').add('#hb-side-navigation').hide();
	var fullBGDiv = $('<div class="full-bg"></div>');
	var fullBGInner = $('<div class="full-bg-inner"></div>');
	fullBGDiv.append(fullBGInner);
	$('body').prepend(fullBGDiv);
	
	var lastScroll = 0;
	$(window).scroll(function(event){
		var st = $(this).scrollTop();
		var opc = (st) / 100000;
		var fade = fullBGInner.css('opacity');
		var newFade;
		if (st > lastScroll){
			newFade = Number(fade) + opc;
		}
		else {
			newFade = Number(fade) - opc;
		}
		if (newFade > 0.5 && opc < 1) {
			fullBGInner.css('opacity', newFade);
		}
		console.log(newFade);
		lastScroll = st;
	});
}
// -------------------------

}); // END READY
})( jQuery );