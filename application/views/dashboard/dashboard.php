<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                <div class="page-body">
                    <div class="row">
                        <!-- task, page, download counter  start -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-yellow update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white">$30200</h4>
                                            <h6 class="text-white m-b-0">All Earnings</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-1" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-green update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white">290+</h4>
                                            <h6 class="text-white m-b-0">Page Views</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-2" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-pink update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white">145</h4>
                                            <h6 class="text-white m-b-0">Task Completed</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-3" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-lite-green update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white">500</h4>
                                            <h6 class="text-white m-b-0">Downloads</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-4" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                                </div>
                            </div>
                        </div>
                        <!-- task, page, download counter  end -->

                        <div class="col-xl-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Application Sales</h5>
                                </div>
                                <div class="card-block">
                                    <div id="chartContainer" style="height: 370px; margin: 0px auto;"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div id="styleSelector">

            </div>
        </div>
    </div>
    </div>

<script>
$(document).ready(function(){
	// $('#<?=$link_active?>').addClass("active");

var chart = new CanvasJS.Chart("chartContainer", {
	theme:"light2",
	animationEnabled: true,
	title:{
		text: "Game of Thrones Viewers of the First Airing on HBO"
	},
	axisY :{
		includeZero: false,
		title: "Number of Viewers",
		suffix: "mn"
	},
	toolTip: {
		shared: "true"
	},
	legend:{
		cursor:"pointer",
		itemclick : toggleDataSeries
	},
	data: [{
		type: "spline",
		visible: false,
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 1",
		dataPoints: [
			{ label: "Ep. 1", y: 2.22 },
			{ label: "Ep. 2", y: 2.20 },
			{ label: "Ep. 3", y: 2.44 },
			{ label: "Ep. 4", y: 2.45 },
			{ label: "Ep. 5", y: 2.58 },
			{ label: "Ep. 6", y: 2.44 },
			{ label: "Ep. 7", y: 2.40 },
			{ label: "Ep. 8", y: 2.72 },
			{ label: "Ep. 9", y: 2.66 },
			{ label: "Ep. 10", y: 3.04 }
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		visible: false,
		yValueFormatString: "##.00mn",
		name: "Season 2",
		dataPoints: [
			{ label: "Ep. 1", y: 3.86 },
			{ label: "Ep. 2", y: 3.76 },
			{ label: "Ep. 3", y: 3.77 },
			{ label: "Ep. 4", y: 3.65 },
			{ label: "Ep. 5", y: 3.90 },
			{ label: "Ep. 6", y: 3.88 },
			{ label: "Ep. 7", y: 3.69 },
			{ label: "Ep. 8", y: 3.86 },
			{ label: "Ep. 9", y: 3.38 },
			{ label: "Ep. 10", y: 4.20 }
		]
	},
	{
		type: "spline",
		visible: false,
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 3",
		dataPoints: [
			{ label: "Ep. 1", y: 4.37 },
			{ label: "Ep. 2", y: 4.27 },
			{ label: "Ep. 3", y: 4.72 },
			{ label: "Ep. 4", y: 4.87 },
			{ label: "Ep. 5", y: 5.35 },
			{ label: "Ep. 6", y: 5.50 },
			{ label: "Ep. 7", y: 4.84 },
			{ label: "Ep. 8", y: 4.13 },
			{ label: "Ep. 9", y: 5.22 },
			{ label: "Ep. 10", y: 5.39 }
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 4",
		dataPoints: [
			{ label: "Ep. 1", y: 6.64 },
			{ label: "Ep. 2", y: 6.31 },
			{ label: "Ep. 3", y: 6.59 },
			{ label: "Ep. 4", y: 6.95 },
			{ label: "Ep. 5", y: 7.16 },
			{ label: "Ep. 6", y: 6.40 },
			{ label: "Ep. 7", y: 7.20 },
			{ label: "Ep. 8", y: 7.17 },
			{ label: "Ep. 9", y: 6.95 },
			{ label: "Ep. 10", y: 7.09 }
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 5",
		dataPoints: [
			{ label: "Ep. 1", y: 8 },
			{ label: "Ep. 2", y: 6.81 },
			{ label: "Ep. 3", y: 6.71 },
			{ label: "Ep. 4", y: 6.82 },
			{ label: "Ep. 5", y: 6.56 },
			{ label: "Ep. 6", y: 6.24 },
			{ label: "Ep. 7", y: 5.40 },
			{ label: "Ep. 8", y: 7.01 },
			{ label: "Ep. 9", y: 7.14 },
			{ label: "Ep. 10", y: 8.11 }
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 6",
		dataPoints: [
			{ label: "Ep. 1", y: 7.94 },
			{ label: "Ep. 2", y: 7.29 },
			{ label: "Ep. 3", y: 7.28 },
			{ label: "Ep. 4", y: 7.82 },
			{ label: "Ep. 5", y: 7.89 },
			{ label: "Ep. 6", y: 6.71 },
			{ label: "Ep. 7", y: 7.80 },
			{ label: "Ep. 8", y: 7.60 },
			{ label: "Ep. 9", y: 7.66 },
			{ label: "Ep. 10", y: 8.89 }
		]
	},
	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "##.00mn",
		name: "Season 7",
		dataPoints: [
			{ label: "Ep. 1", y: 10.11 },
			{ label: "Ep. 2", y: 9.27 },
			{ label: "Ep. 3", y: 9.25 },
			{ label: "Ep. 4", y: 10.17 },
			{ label: "Ep. 5", y: 10.72 },
			{ label: "Ep. 6", y: 10.24 },
			{ label: "Ep. 7", y: 12.07 }
		]
	}]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible ){
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	chart.render();
}
});
	

</script>