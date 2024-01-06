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

<script type="text/javascript">
    window.onload = function () {
        var monthlyData = [];
        var annualData = [];

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
                var formattedDate = new Date(data[i].tahun, 11, 1).toLocaleDateString('en-US', {
                    year: 'numeric'
                });

                annualData.push({
                    x: new Date(data[i].tahun, 11, 30), // Use 0 for the month (January)
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
                    valueFormatString: "MMM YYYY" // Format for the x-axis labels
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