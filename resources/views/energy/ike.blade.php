@extends('layout.topbar')
@section('content')
<div class="page-content">
    <!-- Page Header-->
    <div class="bg-dash-dark-1 py-4">
        <div class="container-fluid">
            <h2 class="h5 mb-0">Statistic</h2>
        </div>
    </div>
    <div class="container-fluid">
        <section class="pt-3">
            <div class="row d-flex align-items-stretch gy-4">
                <div class="col-lg">
                    <!-- Sales bar chart-->
                    <div class="card">
                        <div class="card-body">
                            <div id="daily-ike" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div id="monthly-ike" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div id="annual-ike" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.stock.min.js"></script>

<script type="text/javascript">
    window.onload = function () {
        var dailyData = [];
        var monthlyData = [];
        var annualData = [];

        // Fetch Daily Data
        var dailyApiSource = "api/daily-energy";
        $.getJSON("api/daily-energy", function (data) {
            for (var i = 0; i < data.length; i++) {
                dailyData.push({
                    x: new Date(data[i].date),
                    y: Number((data[i].today_energy) / 1000),
                    indexLabel: data[i].ike,
                    indexLabelFontColor: data[i].color,
                    indexLabelFontSize: 14,
                    indexLabelFontWeight: "bolder",
                    indexLabelMaxWidth: 50,
                    color: data[i].color
                });
            }
            renderDailyChart();
        });

        // Fetch Monthly Data
        // var monthlyApiSource = "api/monthly-energy";
        var monthlyApiSource = "api/ike-dummy";
        $.getJSON(monthlyApiSource, function (data) {
            for (var i = 0; i < data.length; i++) {
                var formattedDate = new Date(data[i].tahun, data[i].month - 1, 1).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short'
                });

                monthlyData.push({
                    x: new Date(data[i].tahun, data[i].month - 1, 1),
                    y: Number(data[i].monthly_kwh),
                    label: formattedDate,
                    indexLabel: data[i].ike,
                    indexLabelFontColor: data[i].color,
                    indexLabelFontSize: 14,
                    indexLabelFontWeight: "bolder",
                    indexLabelMaxWidth: 50,
                    color: data[i].color
                });
            }
            renderMonthlyChart();
        });

        // Fetch Annual Data
        var annualApiSource = "api/ike-dummy-annual";
        $.getJSON(annualApiSource, function (data) {
            for (var i = 0; i < data.length; i++) {
                var formattedDate = new Date(data[i].tahun, 0, 1).toLocaleDateString('en-US', {
                    year: 'numeric'
                });

                annualData.push({
                    x: new Date(data[i].tahun, 0, 1), // Use 0 for the month (January)
                    y: Number(data[i].annual_kwh),
                    label: formattedDate,
                    indexLabel: data[i].ike,
                    indexLabelFontColor: data[i].color,
                    indexLabelFontSize: 14,
                    indexLabelFontWeight: "bolder",
                    indexLabelMaxWidth: 50,
                    color: data[i].color
                });
            }
            renderAnnualChart();
        });

        function renderDailyChart() {
            var dailyChart = new CanvasJS.StockChart("daily-ike", {
                theme: "dark2", //"light1", "dark1", "dark2" "light2",
                exportEnabled: true,
                exportFileName: "Chart IKE Lab IoT",
                backgroundColor: "#2d3035",
                title: {
                    text: "Standar IKE per Hari"
                },
                charts: [{
                    axisX: {
                        valueFormatString: "DD MMM YYYY",
                        interval: 1,
                        intervalType: "day",
                    },
                    axisY: {
                        title: "Total Energi (kWh)",
                        prefix: "",
                        valueFormatString: "##,###.##",
                    },
                    toolTip: {
                        shared: true
                    },
                    data: [{
                        type: "line",
                        dataPoints: dailyData,
                        name: "Total Energy",
                        yValueFormatString: "##,##0.## KWH",
                    }]
                }],
                navigator: {
                    enabled: false,
                    slider: {
                    }
                }
            });
            // var dailyChart = new CanvasJS.Chart("daily-ike", {
            //     theme: "dark2",
            //     exportFileName: "Chart IKE Lab IoT",
            //     exportEnabled: true,
            //     backgroundColor: "#2d3035",
            //     title: {
            //         text: "Standar IKE per Hari"
            //     },
            //     axisX: {
            //         valueFormatString: "DD MMM YYYY",
            //         interval: 1,
            //         intervalType: "day"
            //     },
            //     axisY: {
            //         title: "Total Energi (kWh)",
            //         prefix: "",
            //         valueFormatString: "##,###.##"
            //     },
            //     data: [
            //         {
            //             type: "area",
            //             dataPoints: dailyData,
            //             yValueFormatString: "##,##0.## KWH",
            //         }
            //     ]
            // });

            dailyChart.render();
        }

        function renderMonthlyChart() {
            var monthlyChart = new CanvasJS.Chart("monthly-ike", {
                theme: "dark2",
                exportFileName: "Chart IKE Lab IoT",
                exportEnabled: true,
                backgroundColor: "#2d3035",
                title: {
                    text: "Standar IKE per Bulan"
                },
                axisX: {
                    valueFormatString: "MMM YYYY",
                    interval: 1, // Format for the x-axis labels
                    intervalType: "month"
                },
                axisY: {
                    title: "Total Energi (kWh)",
                    prefix: "",
                    valueFormatString: "##,###.##"
                },
                data: [
                    {
                        type: "column",
                        dataPoints: monthlyData,
                        yValueFormatString: "##,##0.## KWH",
                    }
                ]
            });

            monthlyChart.render();
        }

        function renderAnnualChart() {
            var annualChart = new CanvasJS.Chart("annual-ike", {
                theme: "dark2",
                exportFileName: "Chart IKE Lab IoT",
                exportEnabled: true,
                backgroundColor: "#2d3035",
                title: {
                    text: "Standar IKE per Tahun"
                },
                axisX: {
                    interval: 1, // Format for the x-axis labels
                    intervalType: "year",
                    valueFormatString: "YYYY" // Format for the x-axis labels
                },
                axisY: {
                    title: "Total Energi (kWh)",
                    prefix: "",
                    valueFormatString: "##,###.##"
                },
                data: [
                    {
                        type: "column",
                        dataPoints: annualData,
                        yValueFormatString: "##,##0.## KWH",
                    }
                ]
            });

            annualChart.render();
        }
    }
</script>

</body>
@stop

</html>