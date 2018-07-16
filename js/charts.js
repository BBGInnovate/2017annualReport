// i INDEX IS FOR DYNAMIC IDs
// var i = 0;
// function displayChart(hasChart, jsonTitle, jsonType, jsData, jsLabels) {
// 	if (hasChart) {
// 		jQuery('#financials-chart').append('<canvas id=chart_test' + i + '></canvas>');
// 		jsonTitle = jsonTitle;
// 		jsonType = jsonType.replace(/\"/g, "");
// 		jsData = encodedStrToArr(jsonData, 'number');
// 		jsLabels = encodedStrToArr(jsonLabels, 'text');
// 		// CHART TEST
// 		var dynamicChart = document.getElementById('chart_test' + i).getContext('2d');
// 		Chart.scaleService.updateScaleDefaults('linear', {
// 			ticks: {
// 				min: 0
// 			}
// 		});

// 		var testChart = new Chart(dynamicChart, {
// 			type: jsonType,
// 			ticks: {
// 				min: 0
// 			},
// 			data: {
// 				labels: jsLabels,
// 				datasets: [{
// 					label: 'Testing ChartJS',
// 					data: jsData,
// 					backgroundColor: [
// 						'#9f1d25',
// 						'#147bd1',
// 						'#c0bb87',
// 						'#283266',
// 						'#8b8278'
// 					]
// 				}]
// 			},
// 			options: {
// 				title: {
// 					display: true,
// 					text: jsonTitle,
// 					fontSize: 25
// 				},
// 				legend: {
// 					display: false,
// 					position: 'right',
// 				}
// 			},
// 			layout: {
// 				padding: {}
// 			}
// 		});
// 		i++;
// 	}
// }


// // THIS WRAPPER FUNCTION MAKES $ AVAILABLE
// (function($) {

// // DYNAMIC CHARTS: ACCEPT VALUES FROM PHP AND CUSTOM POST TYPES
// // STRIP JSON STRING OF BRACKETS, SEPARATE AT COMMAS, MAKE NUMBERS
// function stripEncodedEnds(str) {
// 	str = str.substr(1);
// 	str = str.substr(0, str.length -1);
// 	return str;
// }
// function encodedStrToArr(str, dataType) {
// 	var arr = [];
// 	str = str.substr(1);
// 	str = str.substr(0, str.length -1);
// 	arr = str.split(",");

// 	if (dataType == "number") {
// 		for (var i = 0; i < arr.length; i++) {
// 			arr[i] = Number(arr[i]);
// 		}
// 	}
// 	return arr;
// }

// var canvasDiv = document.getElementById('chart_test');
// if (canvasDiv != null) {
// 	var canvasDivW = canvasDiv.width;
// 	canvasDiv.style.marginRight = 'auto';
// 	canvasDiv.style.marginLeft = 'auto';
// }

// })( jQuery );