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
        <section class="pt-3 mt-3">
            <div class="container-fluid">
                <div class="row d-flex align-items-stretch gy-4">
                    <div class="col-lg">
                        <!-- Sales bar chart-->
                        <div class="card">
                            <div class="card-body">
                                <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                                <div class="mt-3">
                                    <a class="btn btn-success " href="energyexportxlxs">Export xlxs</a>
                                    <a class="btn btn-info " href="energyexportcsv">Export csv</a>
                                </div>
                            </div>
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
        var dataEnergy = [];
        // var apiSource = "api/monthly-energy";
        var apiSource = "api/ike-dummy";
        $.getJSON(apiSource, function (data) {
            for (var i = 0; i < data.length; i++) {
                // Format the date to MMM YYYY format
                var formattedDate = new Date(data[i].tahun, data[i].month - 1, 1).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short' // Use 'short' for abbreviated month names (Jan, Feb, Mar, etc.)
                });

                dataEnergy.push({ x: new Date(data[i].tahun, data[i].month - 1, 1), y: Number(data[i].monthly_kwh), label: formattedDate, indexLabel: data[i].ike, indexLabelFontColor: data[i].color, indexLabelFontSize:14 , indexLabelFontWeight: "bolder", indexLabelMaxWidth: 50, color: data[i].color });
            }
            chart.render();
        });

        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "dark2",
            exportFileName: "Chart IKE Lab IoT",
            exportEnabled: true,
            backgroundColor: "#2d3035",
            title: {
                text: "Standar IKE"
            },
            axisX: {
                valueFormatString: "MMM YYYY" // Format for the x-axis labels
            },
            axisY: {
                prefix: "",
                valueFormatString: "##,###.##"
            },
            data: [
                {
                    type: "column",
                    dataPoints: dataEnergy,
                    yValueFormatString: "##,##0.## KWH",
                }
            ]
        });

        chart.render();
    }

</script>

</body>
@stop

</html>