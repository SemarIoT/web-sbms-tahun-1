@extends('layout.topbar')
@section('content')
<div class="page-content">
    <!-- Page Header-->
    <div class="bg-dash-dark-1 py-4">
        @php
        $energy_system = App\Models\Energy::latest()->first();
        if($energy_system){
            $energy_created_at = Carbon\Carbon::parse($energy_system->created_at);
            $now = Carbon\Carbon::now();
        }else{
            $energy_created_at = null;
            $now = null;
        }
    @endphp
    
    @if($energy_created_at && $now)
        @if ($now->diffInHours($energy_created_at) > 3)
            <div class="container-fluid">
                <h2 class="h5 mb-0">Monitor <span class="dot-offline mb-0"></span> </h2>
                <p class="text-sm lh-1 mb-0">Terakhir Online {{$energy_created_at}}</p>
            </div>
        @else
            <div class="container-fluid">
                <h2 class="h5 mb-0">Monitor <span class="dot-online mb-0"></span> </h2>
                <p class="text-sm lh-1 mb-0">Online</p>
            </div>
        @endif
    @endif
    </div>

  <div class="container-fluid">

            <section class="mt-3">
                <div class="container-fluid">
                    <div class="row gy-4">
                        <div class="col-md-6 col-sm-6">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-end justify-content-between mb-2">
                                        <div class="me-2">
                                            <p class="text-sm text-uppercase text-gray-600 lh-1 mb-0">Energi Current</p>
                                        </div>
                                        @forelse ($energy as $ener)
                                        <p class="text-xxl lh-1 mb-0 text-success">{{$ener -> active_power }}</p>
                                        @empty
                                        @endforelse
                                    </div>
                                    <div class="progress" style="height: 3px">
                                        <div class="progress-bar" role="progressbar" style="width: 30%; background-color: #28a745;"
                                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-end justify-content-between mb-2">
                                        <div class="me-2">
                                            <p class="text-sm text-uppercase text-gray-600 lh-1 mb-0">Electricity Price</p>
                                        </div>
                                        @foreach ($energy_cost_pokok as $energy_costs)
                                        <p class="text-xxl lh-1 mb-0 text-success">Rp. @php echo number_format($energy_costs); @endphp</p>
                                        
                                        @endforeach
                                    </div>
                                    <div class="progress" style="height: 3px">
                                        <div class="progress-bar" style="width: 75%; background-color: #28a745;" role="progressbar"
                                            aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
             
            <section class="mt-0 pt-0">
                <div class="container-fluid">
                    <div class="row d-flex align-items-stretch gy-4">
                        <div class="col-lg-4">
                            <!-- Sales bar chart-->
                            <div class="card">
                                
                                <div class="card-body">
                                    <h3 class="h4 mb-3">Energy Usage</h3>
                                    <!-- <p class="text-sm fw-light">Lorem ipsum dolor sit</p> -->
                                    <div class="row align-items-center mb-0">
                                        @forelse ($energy_today as $energy_todays)
                                        @foreach ($energy_cost_delay as $energy_cost_delays)
                                        <div class="col-lg-6">
                                            <p class="text-xl fw-light mb-0 text-dash-color-1">
                                                @php
                                                    echo number_format((float)($energy_todays/(3600/$energy_cost_delays)),2,'.','');
                                                @endphp
                                            </p>
                                            <p>Today</p>
                                        </div>
                                        @endforeach
                                        @empty
                                        @endforelse
                                        @forelse ($energy_month as $energy_months)
                                        @foreach ($energy_cost_delay as $energy_cost_delays) 
                                        <div class="col-lg-6">
                                            <p class="text-xl fw-light mb-0 text-dash-color-1">
                                                @php
                                                    echo number_format((float)($energy_months/(3600/$energy_cost_delays)),2,'.','');
                                                @endphp
                                            </p>
                                            <p>This Month</p>
                                        </div>
                                        @endforeach
                                        @empty
                                        @endforelse
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Sales bar chart-->
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h4 mb-3">This Month Cost</h3>
                                    <div class="row align-items-end">
                                        @foreach ($energy_cost as $energy_costs)
                                            @foreach($energy_month as $energy_months)
                                        <div class="col-lg-12">
                                            <p class="text-xl fw-light mb-0 text-info">
                                                @php
                                                echo number_format($energy_costs*$energy_months);
                                                @endphp
                                            </p>
                                            <p>IDR</p>
                                        </div>
                                            @endforeach
                                        @endforeach
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Sales bar chart-->
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h4 mb-3">Previous Month Cost</h3>
                                    <div class="row align-items-end">
                                        @forelse ($energy_submonth as $energy_submonths)
                                        <div class="col-lg-12">
                                            <p class="text-xl fw-light mb-0 text-warning">
                                                @php
                                                echo number_format($energy_costs*$energy_submonths);
                                                @endphp
                                            </p>
                                            <p>IDR</p>
                                        </div>
                                        @empty
                                        @endforelse
                                       
                                      
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </section>
            <section class="pt-0 mt-0">
                <div class="container-fluid">
                    <div class="row d-flex align-items-stretch gy-4">
                        <div class="col-lg">
                            <!-- Sales bar chart-->
                            <div class="card">
                                <div class="card-body">
                                    <div class="row d-flex justify-content-center pt-3">
                                        <h3 class="h4 mb-3">Status</h3>
                                         <div class="row align-items-end">
                                            @foreach($energy_outlet_master as $energy_outlet_masters)
                                                    <div class="col-lg-6">
                                                        <p class="text-xl fw-light mb-0 text-info">Outlet Master</p><span>
                                                    </div> 
                                                    @if($energy_outlet_masters->status==1)
                                                    <div class="col-lg-6">
                                                        <p class="text-xl fw-light mb-0 text-end text-success">Online</p><span>
                                                    </div>
                                                    @else
                                                    <div class="col-lg-6">
                                                        <p class="text-xl fw-light mb-0 text-end text-dash-color-3">Offline</p><span>
                                                    </div>
                                                    @endif
                                            @endforeach
                                            @foreach($energy_panel as $energy_panels)
                                                    <div class="col-lg-6">
                                                        <p class="text-xl fw-light mb-0 text-info">{{$energy_panels->nama}}</p><span>
                                                    </div> 
                                                    @if($energy_panels->status==1)
                                                    <div class="col-lg-6">
                                                        <p class="text-xl fw-light mb-0 text-end text-success">Online</p><span>
                                                    </div>
                                                    @else
                                                    <div class="col-lg-6">
                                                        <p class="text-xl fw-light mb-0 text-end text-dash-color-3">Offline</p><span>
                                                    </div>
                                                    @endif
                                            @endforeach
                                            {{-- @foreach($energy_outlet as $energy_outlets)
                                                    <div class="col-lg-6">
                                                        <p class="text-xl fw-light mb-0 text-info">{{$energy_outlets->nama}}</p><span>
                                                    </div> 
                                                    @if($energy_outlets->status==1)
                                                    <div class="col-lg-6">
                                                        <p class="text-xl fw-light mb-0 text-end text-success">Online</p><span>
                                                    </div>
                                                    @else
                                                    <div class="col-lg-6">
                                                        <p class="text-xl fw-light mb-0 text-end text-dash-color-3">Offline</p><span>
                                                    </div>
                                                    @endif
                                            @endforeach --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @if (Auth::user()->level == 'Admin' || Auth::user()->level == 'Developer')
            <section class="mt-3 pt-0">
                <div class="container-fluid">
                    <div class="row d-flex align-items-stretch gy-4">
                        <div class="col-lg-4">
                            <!-- Sales bar chart-->
                            <div class="card">
                                
                                <div class="card-body">
                                    <h3 class="h4 mb-3">Voltage</h3>
                                    <!-- <p class="text-sm fw-light">Lorem ipsum dolor sit</p> -->
                                    <div class="row align-items-center mb-0">
                                        @forelse ($energy as $energies)
                                        <div class="col-lg-6">
                                            <p class="text-xl fw-light mb-0 text-dash-color-1">{{ $energies->tegangan }}</p>
                                            <p>Master</p>
                                        </div>
                                        @empty
                                        @endforelse
                                        @forelse ($energy2 as $energies2) 
                                        <div class="col-lg-6">
                                            <p class="text-xl fw-light mb-0 text-dash-color-1">{{ $energies2->tegangan }}</p>
                                            @foreach ($energy_panel as $energy_panels) 
                                            <p>{{$energy_panels->nama}}</p>
                                            @endforeach
                                        </div>
                                        @empty
                                        @endforelse
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Sales bar chart-->
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h4 mb-3">Current</h3>
                                    <div class="row align-items-center mb-0">
                                        @forelse ($energy as $energies)
                                        <div class="col-lg-6">
                                            <p class="text-xl fw-light mb-0 text-info">{{ $energies->arus }}</p>
                                            <p>Master</p>
                                        </div>
                                        @empty
                                        @endforelse
                                        @forelse ($energy2 as $energies2) 
                                        <div class="col-lg-6">
                                            <p class="text-xl fw-light mb-0 text-info">{{ $energies2->arus }}</p>
                                            @foreach ($energy_panel as $energy_panels) 
                                            <p>{{$energy_panels->nama}}</p>
                                            @endforeach
                                        </div>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Sales bar chart-->
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h4 mb-3">Frequency</h3>
                                    <div class="row align-items-center mb-0">
                                        @forelse ($energy as $energies)
                                        <div class="col-lg-6">
                                            <p class="text-xl fw-light mb-0 text-warning">{{ $energies->frekuensi }}</p>
                                            <p>Master</p>
                                        </div>
                                        @empty
                                        @endforelse
                                        @forelse ($energy2 as $energies2) 
                                        <div class="col-lg-6">
                                            <p class="text-xl fw-light mb-0 text-warning">{{ $energies2->frekuensi }}</p>
                                            @foreach ($energy_panel as $energy_panels) 
                                            <p>{{$energy_panels->nama}}</p>
                                            @endforeach
                                        </div>
                                        @empty
                                        @endforelse
                                      
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </section>
            <section class="pt-0">
                <div class="container-fluid">
                    <div class="row d-flex align-items-stretch gy-4">
                        <div class="col-lg-4">
                            <!-- Sales bar chart-->
                            <div class="card">
                                
                                <div class="card-body">
                                    <h3 class="h4 mb-3">Active Power</h3>
                                    <!-- <p class="text-sm fw-light">Lorem ipsum dolor sit</p> -->
                                    <div class="row align-items-center mb-0">
                                        @forelse ($energy as $energies)
                                        <div class="col-lg-6">
                                            <p class="text-xl fw-light mb-0 text-dash-color-2">{{ $energies->active_power }}</p>
                                            <p>Master</p>
                                        </div>
                                        @empty
                                        @endforelse
                                        @forelse ($energy2 as $energies2) 
                                        <div class="col-lg-6">
                                            <p class="text-xl fw-light mb-0 text-dash-color-2">{{ $energies2->active_power }}</p>
                                            @foreach ($energy_panel as $energy_panels) 
                                            <p>{{$energy_panels->nama}}</p>
                                            @endforeach
                                        </div>
                                        @empty
                                        @endforelse
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Sales bar chart-->
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h4 mb-3">Reactive Power</h3>
                                    <div class="row align-items-center mb-0">
                                        @forelse ($energy as $energies)
                                        <div class="col-lg-6">
                                            <p class="text-xl fw-light mb-0 text-info">{{ $energies->reactive_power }}</p>
                                            <p>Master</p>
                                        </div>
                                        @empty
                                        @endforelse
                                        @forelse ($energy2 as $energies2) 
                                        <div class="col-lg-6">
                                            <p class="text-xl fw-light mb-0 text-info">{{ $energies2->reactive_power }}</p>
                                            @foreach ($energy_panel as $energy_panels) 
                                            <p>{{$energy_panels->nama}}</p>
                                            @endforeach
                                        </div>
                                        @empty
                                        @endforelse
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Sales bar chart-->
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h4 mb-3">Apparent Power</h3>
                                    <div class="row align-items-center mb-0">
                                        @forelse ($energy as $energies)
                                        <div class="col-lg-6">
                                            <p class="text-xl fw-light mb-0 text-warning">{{ $energies->apparent_power }}</p>
                                            <p>Master</p>
                                        </div>
                                        @empty
                                        @endforelse
                                        @forelse ($energy2 as $energies2) 
                                        <div class="col-lg-6">
                                            <p class="text-xl fw-light mb-0 text-warning">{{ $energies2->apparent_power }}</p>
                                            @foreach ($energy_panel as $energy_panels) 
                                            <p>{{$energy_panels->nama}}</p>
                                            @endforeach
                                        </div>
                                        @empty
                                        @endforelse
                                      
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                    
                
            </section>
            @endif
            
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
<script type="text/javascript">
        function autoRefreshPage()
        {
            window.location = window.location.href;
        }
        setInterval('autoRefreshPage()', 120000);
</script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</body>
@stop
</html>
