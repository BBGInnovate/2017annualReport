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

// CHART TEST
var chart1 = document.getElementById('chart_test').getContext('2d');
var testChart = new Chart(chart1, {
	type: 'bar',
	data: {
		labels: ['Miami', 'Sarasota', 'Niceville'],
		datasets: [{
			label: 'Testing ChartJS',
			data: [
				3210,
				2510,
				2213
			],
			// backgroundColor: '#ff00ff',
			backgroundColor: [
				'#00ffff',
				'#ff00ff',
				'#ffff00'
			]
		}]
	},
	options: {
		title: {
			display: true,
			text: 'BBG and ChartJS',
			fontSize: 25
		},
		legend: {
			display: true,
			position: 'right',
		}
	},
	layout: {

	}
});

}); // END READY
})( jQuery );