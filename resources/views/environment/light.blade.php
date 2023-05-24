@extends('layout.topbar')
@section('content')
@if (Auth::user()->level == 'Admin' || Auth::user()->level == 'Developer')
    <style>
     
    </style>

<div class="page-content">
    <!-- Page Header-->
    <div class="bg-dash-dark-1 py-4">
      <div class="container-fluid">
        <h2 class="h5 mb-0">Light</h2>
      </div>
    </div>
  <div class="container-fluid">

            <section class="mt-3">
                <div class="container-fluid">
                    <div class="row gy-4">
                        <div class="col-md col-sm">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-end justify-content-between mb-2">
                                        @foreach($posts as $key=>$item)
                                        
                                        <div class="me-2">
                                            <p class="text-lg text-uppercase text-success lh-1 mb-0">Light Master</p>
                                        </div>                                     
                                        @if($item->status==1)
                                        <label class="switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch2" checked>
                                            <a href="{{ url('change-light-master-status/'.$item->id) }}" class="slider round" ></a>
                                        </label>
                                        @else
                                        <label class="switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch2" disabled>
                                            <a href="{{ url('change-light-master-status/'.$item->id) }}" class="slider round" ></a>
                                        </label>
                                        @endif
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
                        <div class="col-lg">
                            <!-- Sales bar chart-->
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h4 mb-3 text">Light Dimmer</h3>
                                    @foreach ($dimmer as $nilai)
                                    <div class="d-flex align-items-end justify-content-between pt-2 pb-2">
                                        
                                        <div class="me-2">
                                            <h3 class="text-sm d-block text-dash-color-2 text-uppercase">{{$nilai->nama}}</h3>
                                        </div>
                                        
                                        @if($nilai->status==1)
                                        <div >
                                        <label class="switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch2" checked>
                                            <a href="{{ url('change-light-dimmer-status/'.$nilai->id) }}" class="slider round" ></a>
                                        </label>
                                        </div>
                                        <div class="row">
                                            <div class="slidecontainer">
                                                <form method="POST" action="{{ url('/change-light-dimmer-value/'.$nilai->id) }}" enctype="multipart/form-data" oninput="return onsubmitForm(this);" onchange="return onsubmitForm(this));">
                                                    {{ csrf_field() }}
                                            <input type="range" name="nilai" min="25" max="90" value={{$nilai->nilai}} class="slide" id="myRangbe">
                                            <span id="demob"></span>
                                                </form>                                                
                                            </div>
                                        </div>
                                                         
                                        @else
                                        <div class="row align-items-end">
                                        <label class="switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch2" disabled>
                                            <a href="{{ url('change-light-dimmer-status/'.$nilai->id) }}" class="slider round" ></a>
                                        </label>
                                        </div>
                                        <div class="row">
                                            <div class="slidecontainer">
                                            <input type="range" name="nilai" min="0" max="100" value="0" class="slidemati">                                                                                           
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <!-- Sales bar chart-->
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h4 mb-3 text">Light Control</h3>
                                    @foreach($controls as $key=>$control)
                                    <div class="d-flex align-items-end justify-content-between pt-2 pb-2">
                                        <div class="me-2">
                                            <h3 class="text-sm d-block text-dash-color-2 text-uppercase">{{$control->nama}}</h3>
                                        </div>
                                        @if($control->status==1)
                                        <label class="switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch2" checked>
                                            <a href="{{ url('change-light-status/'.$control->id) }}" class="slider round" ></a>
                                        </label>
                                        @else
                                        <label class="switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch2" disabled>
                                            <a href="{{ url('change-light-status/'.$control->id) }}" class="slider round" ></a>
                                        </label>
                                        @endif
                                    </div>
                                    @endforeach
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


@endforeach
            
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

        <script>
            var slider = document.getElementById("myRange");
            var output = document.getElementById("demo");
            output.innerHTML = slider.value;
            slider.oninput = function() {
                output.innerHTML = this.value;
            }

            function onsubmitForm(form) {
                
                // create AJAX instance
                var ajax = new XMLHttpRequest();

                // open the request
                ajax.open("POST", form.getAttribute("action"), true);

                // listen for response from server
                ajax.onreadystatechange = function () {
                    // when the request is successfull
                    if (this.readyState == 4 && this.status == 200) {
                        // convert the JSON response into Javascript object
                        var data = JSON.parse(this.responseText);

                        // show the response
                        alert(data.status + " - " + data.message);
                    }

                    // if the request fails
                    if (this.status == 500) {
                        alert(this.responseText);
                    }
                };

                // create form data object
                var formData = new FormData(form);

                // send the request
                ajax.send(formData);

                // prevent the form from submitting
                return false;
                }                                                                                                                                  
              </script>
</body>

@else
<div class="page-content">
    <!-- Page Header-->
    <div class="bg-dash-dark-1 py-4">
      <div class="container-fluid">
        <h2 class="h5 mb-0">Light</h2>
      </div>
    </div>
  <div class="container-fluid">

            
            <section class="pt-3">
            
                <div class="container-fluid">
                    <div class="row d-flex align-items-stretch gy-4">
                        <div class="col-lg">
                            <!-- Sales bar chart-->
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h4 mb-3 text">Light Dimmer</h3>
                                    @foreach ($dimmer as $nilai)
                                    <div class="d-flex align-items-end justify-content-between pt-2 pb-2">
                                        
                                        <div class="me-2">
                                            <h3 class="text-sm d-block text-dash-color-2 text-uppercase">{{$nilai->nama}}</h3>
                                        </div>
                                        
                                        @if($nilai->status==1)
                                        <div class="col-lg-6">
                                            <p class="text-xl fw-light mb-0 text-end text-success">On</p><span>
                                        </div>
                                        @else
                                        <div class="col-lg-6">
                                            <p class="text-xl fw-light mb-0 text-end text-dash-color-3">Off</p><span>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <!-- Sales bar chart-->
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="h4 mb-3 text">Light Control</h3>
                                    @foreach($controls as $key=>$control)
                                    <div class="d-flex align-items-end justify-content-between pt-2 pb-2">
                                        <div class="me-2">
                                            <h3 class="text-sm d-block text-dash-color-2 text-uppercase">{{$control->nama}}</h3>
                                        </div>
                                        @if($control->status==1)
                                        <div class="col-lg-6">
                                            <p class="text-xl fw-light mb-0 text-end text-success">On</p><span>
                                        </div>
                                        @else
                                        <div class="col-lg-6">
                                            <p class="text-xl fw-light mb-0 text-end text-dash-color-3">Off</p><span>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
@endif
@stop
</html>
