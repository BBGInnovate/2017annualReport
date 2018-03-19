// THIS WRAPPER FUNCTION MAKES $ AVAILABLE
(function($) {
$(document).ready(function() {

// POST CAT TEXT BOX HEIGHT CONSISTENT WITH THUMBNAIL
function sizePostCats() {
	var postCatTextBox = $('.aside-text');
	var postCatImgH = $('.aside-image').height();
	postCatTextBox.css('height', postCatImgH);
}
sizePostCats();

// FUNCTIONS TO RUN ON RESIZE
$(window).on('resize', function() {
	sizePostCats();
});

var canvasDiv = document.getElementById('chart_test');
if (canvasDiv != null) {
	var canvasDivW = canvasDiv.width;
	canvasDiv.style.marginRight = 'auto';
	canvasDiv.style.marginLeft = 'auto';
}
// ACCEPT VALUES FROM PHP AND CUSTOM POST TYPES FOR DYNAMIC CHARTS
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
// hasChart = stripEncodedEnds(hasChart);
if (hasChart) {
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
				// backgroundColor: '#ff00ff',
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

}); // END READY
})( jQuery );