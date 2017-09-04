<?php
    
?>
<canvas class="chart" id="elevation" ></canvas>
<canvas class="chart" id="speed" ></canvas>
<script src="node_modules/chart.js/dist/Chart.js"></script>
<script>

	var elevation = <?php echo $elevation_js; ?>;
	var time = <?php echo $time_js; ?>;
	var speed = <?php echo $speed_js; ?>;

	Array.prototype.max = function() {
    return Math.max.apply(null, this);
	};
	
  Array.prototype.min = function() {
    return Math.min.apply(null, this);
	};
	
	var elevationMax = elevation.max();
	var elevationMin = elevation.min();

	var difference = elevationMax-elevationMin;
	var yAxisMin = Math.round((elevationMin-difference/10)/10)*10;
	var yAxisMax = Math.round((elevationMax+difference/10)/10)*10;
	var height = yAxisMax-yAxisMin;

	var ctx1 = document.getElementById("elevation");
	var elevationChart = new Chart(ctx1, {
		type: 'line',
    data: {
			labels: time,
			datasets: [
				{
					radius: 0,
					label: "Höhe",
					borderColor: "#919191",
					data: elevation
				}
			]
		},
		options: {
			//pointRadius: 0,
			//pointHitRadius: 5,
			scales: {
				yAxes: [
					{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Meter über Meer'
						},
						ticks: {
							//beginAtZero: false,
							//stepSize: 50
						}
					}
				],
				xAxes: [
					{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Zeit'
						},
						ticks: {
							min: time[0],
							max: time[time.length-1]
						}
					}
				]
			}
    }
	});
	console.log(elevation);
	console.log(speed);
	var ctx2 = document.getElementById("speed");
	var elevationChart = new Chart(ctx2, {
		type: 'line',
    data: {
			labels: time,
			datasets: [
				{
					radius: 0,
					label: "Geschwindigkeit",
					borderColor: "#919191",
					data: speed
				}
			]
		},
		options: {
			scales: {
				yAxes: [
					{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'km/h'
						},
						ticks: {
							beginAtZero: true,
							//stepSize: 50
						}
					}
				],
				xAxes: [
					{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Zeit'
						},
						ticks: {
							min: time[0],
							max: time[time.length-2]
						}
					}
				]
			}
    }
	});
</script>
