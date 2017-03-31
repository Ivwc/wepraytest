

<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
</style>
<div class="row">
	<div id="container" class="col-xs-6 col-md-6">
		<canvas id="canvas"></canvas>
	</div>
	<div id="container"  class="col-xs-6 col-md-6">
		<canvas id="canvas2"></canvas>
	</div>
</div>
<div class="row">
	<div id="container"  class="col-xs-6 col-md-6">
		<canvas id="canvas3"></canvas>
	</div>
</div>
<script>
	var MONTHS = ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"];

	var randomScalingFactor = function() {
		return (Math.random() > 0 ? 1.0 : 0) * Math.round(Math.random() * 100);
	};
	var randomScalingFactor2 = function() {
		return (Math.random() > 0 ? 1.0 : 0) * Math.round(Math.random() * 10);
	};
	var randomColorFactor = function() {
		return Math.round(Math.random() * 255);
	};
	var randomColor = function() {
		return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',.7)';
	};

	var barChartData = {
		labels: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
		datasets: [{
			label: '点击率',
			backgroundColor: "rgba(151,187,205,0.5)",
			data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(),randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
		}]

	};
	var barChartData2 = {
		labels: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
		datasets: [{
			label: '点击率',
			backgroundColor: "rgba(151,187,205,0.5)",
			data: [randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(),randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor(), randomScalingFactor()]
		}]

	};


	var config = {
		type: 'line',
		data: {
			labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"],
			datasets: [{
				label: "本月来访人次",
				data: [randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(),randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(),randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2(), randomScalingFactor2()],
			}]
		},
		options: {
			responsive: true,
			title:{
				display:true,
				text:"本月来访人次"
			},
			scales: {
				xAxes: [{
					display: true,
					ticks: {
						userCallback: function(dataLabel, index) {
							return index % 2 === 0 ? dataLabel : '';
						}
					}
				}],
				yAxes: [{
					display: true,
					beginAtZero: false
				}]
			}
		}
	};

	$.each(config.data.datasets, function(i, dataset) {
		dataset.borderColor = "rgb(0,88,255)";
		dataset.backgroundColor = "rgb(255,255,120)";
		dataset.pointBorderColor = "rgb(0,88,255)";
		dataset.pointBackgroundColor = "rgb(0,88,255)";
		dataset.pointBorderWidth = 1;
	});
	window.onload = function() {
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myBar = new Chart(ctx, {
			type: 'bar',
			data: barChartData,
			options: {
                    // Elements options apply to all of the options unless overridden in a dataset
                    // In this case, we are setting the border of each bar to be 2px wide and green
                    elements: {
                    	rectangle: {
                    		borderWidth: 2,
                    		borderColor: 'rgb(255, 255, 255)',
                    		borderSkipped: 'bottom'
                    	}
                    },
                    responsive: true,
                    legend: {
                    	position: 'top',
                    },
                    title: {
                    	display: true,
                    	text: '我的庙宇上个年点击率'
                    }
                }
            });
		var ctx = document.getElementById("canvas2").getContext("2d");
		window.myBar = new Chart(ctx, {
			type: 'bar',
			data: barChartData2,
			options: {
                    // Elements options apply to all of the options unless overridden in a dataset
                    // In this case, we are setting the border of each bar to be 2px wide and green
                    elements: {
                    	rectangle: {
                    		borderWidth: 2,
                    		borderColor: 'rgb(255, 255, 255)',
                    		borderSkipped: 'bottom'
                    	}
                    },
                    responsive: true,
                    legend: {
                    	position: 'top',
                    },
                    title: {
                    	display: true,
                    	text: '我的庙宇这个年点击率'
                    }
                }
            });

		var ctx = document.getElementById("canvas3").getContext("2d");
		window.myLine = new Chart(ctx, config);
	};

</script>