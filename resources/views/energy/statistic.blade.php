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
                                <div class="card">
                                    <div class="card-body">
                                       
                                        <div class="row d-flex justify-content-center pt-3">
                                             <div class="row d-flex justify-content-center pt-0" id="grafik"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="pt-3 mt-3">
                <div class="container-fluid">
                    <div class="row d-flex align-items-stretch gy-4">
                        <div class="col-lg">
                            <!-- Sales bar chart-->
                            <div class="card">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <div class="row d-flex justify-content-center pt-3">
                                             <div class="row d-flex justify-content-center pt-0" id="grafik2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Hidden section for chart canvas -->
            <section hidden>
                <div class="container-fluid">
                    <canvas id="salesBarChart1"></canvas>
                    <canvas id="salesBarChart2"></canvas>
                    <canvas id="pieChartHome1"></canvas>
                    <canvas id="pieChartHome2"></canvas>
                    <canvas id="pieChartHome3"></canvas>
                    <canvas id="barChartExample1"></canvas>
                    <canvas id="barChartExample2"></canvas>
                    <canvas id="lineChart"></canvas>
                    <canvas id="lineChart1"></canvas>
                </div>
            </section>
        </div>
    </div>
    
    <script>
        // ------------------------------------------------------- //
        //   Inject SVG Sprite - 
        //   see more here 
        //   https://css-tricks.com/ajaxing-svg-sprite/
        // ------------------------------------------------------ //
        function injectSvgSprite(path) {

            var ajax = new XMLHttpRequest();
            ajax.open("GET", path, true);
            ajax.send();
            ajax.onload = function (e) {
                var div = document.createElement("div");
                div.className = 'd-none';
                div.innerHTML = ajax.responseText;
                document.body.insertBefore(div, document.body.childNodes[0]);
            }
        }
        // this is set to BootstrapTemple website as you cannot 
        // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
        // while using file:// protocol
        // pls don't forget to change to your domain :)
        injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');

    </script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
     <!-- Script chart form highchart-->
     <script src="https://code.highcharts.com/highcharts.js"></script>
     <script src="https://code.highcharts.com/themes/dark-unica.js"></script>
     <script type="text/javascript">
        
         var cost_energy = <?php echo json_encode($cost_energy) ?>;
         var waktu = <?php echo json_encode($waktu) ?>;
         Highcharts.chart('grafik',{
             title : {
                 text: 'Statistik Bulanan'
             },
             xAxis : {
                 title:{
                     text : 'Bulan'
                 },
                 
                 categories : waktu
                 
             },
             yAxis : {
                 title:{
                     text : 'Energy'
                 }
             },
             plotOptions:{
                 series:{
                     allowPointSelect: true
                 }
             },
             series : [{
                 name: 'Total Energy',    
                 data: cost_energy
             }],
         });
     </script>
     <script type="text/javascript">
        var cost_energy2 = <?php echo json_encode($cost_energy2) ?>;
        var waktu = <?php echo json_encode($waktu2) ?>;
        Highcharts.chart('grafik2',{
            title : {
                text: 'Statistic Harian'
            },
            xAxis : {
                title:{
                    text : 'Tanggal'
                },
                
                categories : waktu
                
            },
            yAxis : {
                title:{
                    text : 'Energy'
                }
            },
            plotOptions:{
                series:{
                    allowPointSelect: true
                }
            },
            series : [{
                name: 'Total Energy',    
                data: cost_energy2
            }],
        });
    </script>
     
    </body>
@stop
</html>
