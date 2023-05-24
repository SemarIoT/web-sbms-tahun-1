<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Smart Building Management System</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Choices.js-->
    <link rel="stylesheet" href="{{asset('vendor/choices.js/public/assets/styles/choices.min.css')}}">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="{{asset('https://fonts.googleapis.com/css?family=Muli:300,400,700')}}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('css/style.default.css')}}" id="theme-stylesheet">
    
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <!-- Favicon-->
    {{-- <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">  --}}
    <!-- DataTable Styles -->
    <link rel="stylesheet" href="{{asset('table/dist/style.css')}}">
                      
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <header class="header">   
      <nav class="navbar navbar-expand-lg py-3 bg-dash-dark-2 border-bottom border-dash-dark-1 z-index-10">
        <div class="container-fluid d-flex align-items-center justify-content-between py-1">
          <div class="navbar-header d-flex align-items-center"><a class="navbar-brand text-uppercase text-reset" href="{{url('dashboard')}}">
              <div class="brand-text brand-big"><small class="text-primary"style="font-size:15px;">Smart</small><small class="text-secondary"style="font-size:15px;"> Building Management System</small></div>
              <div class="brand-text brand-sm"><strong class="text-primary">S</strong><strong>BMS</strong></div></a>
            <button class="sidebar-toggle">
                  <svg class="svg-icon svg-icon-sm svg-icon-heavy transform-none">
                    <use xlink:href="#arrow-left-1"> </use>
                  </svg>
            </button>
          </div>
          
          @php 
          $name_about = App\Models\About::oldest()->get();
          @endphp
          @foreach ($name_about as $name_abouts)
          <div class="mx-auto" ><strong class="text-success">{{$name_abouts->nama}}</strong></div>
          @endforeach
            
          <ul class="list-inline mb-0">
            </li>
                <li class="list-inline-item logout px-lg-2">               
                    <a class="nav-link text-sm text-reset px-1 px-lg-0" id="logout" href="{{url('logout')}}"> 
                      <span class="d-none d-sm-inline-block">Logout </span>
                    <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                      <use xlink:href="#disable-1"> </use>
                    </svg></a></li>
          </ul>
        </div>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center p-4">
            <a href="{{url('profile')}}">
            <div class="ms-3 title ">
            <h1 class="h5 mb-1 text">{{ Auth::user()->name }}</h1>
            <p class="text-sm text-gray-700 mb-0 lh-1">{{ Auth::user()->level }}</p>
            </a>
          </div>
        </div>
        <hr class="sidebar-divider my-0">
        <ul class="list-unstyled">
              <li class="sidebar-item"><a class="sidebar-link" href="{{url('dashboard')}}"> 
                      <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                        <use xlink:href="#real-estate-1"> </use>
                      </svg><span>Dashboard </span></a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="#energidropdown" data-bs-toggle="collapse"> 
                      <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                        <use xlink:href="#browser-window-1"> </use>
                      </svg><span>Energy</span></a>
                <ul class="collapse list-unstyled " id="energidropdown">
                  <li><a class="sidebar-link" href="{{url('monitor')}}">Monitor</a></li>
                  @if (Auth::user()->level == 'Admin' || Auth::user()->level == 'Developer')
                  <li><a class="sidebar-link" href="{{url('control')}}">Control</a></li>
                  @endif
                 <!-- <li><a class="sidebar-link" href="{{url('statistic')}}">Statistic</a></li> -->
                  <li><a class="sidebar-link" href="{{url('cost')}}">Statistic</a></li>
                </ul>
              </li>
              <li class="sidebar-item"><a class="sidebar-link" href="#securitydropdown" data-bs-toggle="collapse"> 
                <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                  <use xlink:href="#security-shield-1"> </use>
                </svg><span>Security</span></a>
                <ul class="collapse list-unstyled " id="securitydropdown">
                  <li><a class="sidebar-link" href="{{url('camera')}}">Camera</a></li>
                  <li><a class="sidebar-link" href="{{url('fire-alarm')}}">Fire Alarm</a></li>
                </ul>
              </li>
              <li class="sidebar-item"><a class="sidebar-link" href="#enviDropdown" data-bs-toggle="collapse"> 
                <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                        <use xlink:href="#stack-1"> </use>
                </svg><span>Enviroment</span></a>
                <ul class="collapse list-unstyled " id="enviDropdown">
                  <li><a class="sidebar-link" href="{{url('temperature')}}">Temperature</a></li>
                  <li><a class="sidebar-link" href="{{url('humidity')}}">Humidity</a></li>
                  <li><a class="sidebar-link" href="{{url('light')}}">Light</a></li>
                  {{-- <li><a class="sidebar-link" href="{{url('kontrol')}}">Control</a></li> --}}
                  
                </ul>
              </li>
              <li class="sidebar-item"><a class="sidebar-link" href="{{url('pinpoint')}}"> 
                <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                  <use xlink:href="#portfolio-grid-1"> </use>
                </svg><span>Pin Point </span></a></li>
              <hr class="sidebar-divider my-0">
              @if (Auth::user()->level == 'Admin' || Auth::user()->level == 'Developer')
              <ul class="list-unstyled">
                <li class="sidebar-item"><a class="sidebar-link" href="{{url('daftar-admin')}}"> 
                        <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                          <use xlink:href="#survey-1"> </use>
                        </svg><span>List of Permissions</span></a></li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{url('daftar-sensor')}}"> 
                          <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                            <use xlink:href="#portfolio-grid-1"> </use>
                          </svg><span>List of Devices</span></a></li>
                <li class="sidebar-item"><a class="sidebar-link" href="#doorlockdropdown" data-bs-toggle="collapse"> 
                  <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                    <use xlink:href="#security-shield-1"> </use>
                  </svg><span>Doorlock</span></a>
                  <ul class="collapse list-unstyled " id="doorlockdropdown">
                    <li><a class="sidebar-link" href="{{url('doorlock_list')}}">Permission List</a></li>
                    <li><a class="sidebar-link" href="{{url('doorlock_list_room')}}">Room List</a></li>
                    <li><a class="sidebar-link" href="{{url('doorlock_history')}}">History</a></li>
                  </ul>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{url('setting-admin')}}"> 
                            <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                              <use xlink:href="#paper-stack-1"> </use>
                            </svg><span>Setting</span></a></li>

              </ul>
              @endif
              <hr class="sidebar-divider my-0">
              <li class="sidebar-item"><a class="sidebar-link" href="{{url('integratedsystem')}}"> 
                <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                  <use xlink:href="#survey-1"> </use>
                </svg><span>Integrated System </span></a></li>
              <li class="sidebar-item"><a class="sidebar-link" href="{{url('about')}}"> 
                  <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                    <use xlink:href="#survey-1"> </use>
                  </svg><span>About </span></a></li>
              <footer class="position-absolute bottom-0 text-end py-3 text-xs" id="footer">
                <div class="container-fluid text-center">
                   <p class="mb-0 text-dash-gray">2022 &copy; Created by <a href="https://elektro.ft.uns.ac.id/laboratorium-internet-of-things-iot/">IoT Lab UNS</a></p>
                </div>
              </footer>
          </nav>


    {{-- <button class="btn btn-warning btn-sm d-none d-md-inline-block" type="button" data-bs-toggle="collapse" data-bs-target="#style-switch" id="style-switch-button"><i class="fas fa-cog fa-2x"></i></button>
    <div class="collapse" id="style-switch">
      <h5 class="mb-3">Select theme colour</h5>
      <form class="mb-3">
        <select class="form-select" name="colour" id="colour">
          <option value="default">dark</option>
          <option value="changeup">light</option>
        </select>
      </form>
      </div> --}}

      @yield('content')



        <!-- Page Footer-->
        
        
    </div>
    
  
    <!-- JavaScript files-->
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/just-validate/js/just-validate.min.js')}}"></script>
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('vendor/choices.js/public/assets/scripts/choices.min.js')}}"></script>
    <script src="{{asset('js/charts-home.js')}}"></script>
    <!-- Main File-->
    <script src="{{asset('js/front.js')}}"></script>
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
          ajax.onload = function(e) {
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
    <script>
      document.querySelector('#colour').addEventListener('change', function() {
        const theme = this.value;
        document.querySelector('#theme-stylesheet').setAttribute('href', '/css/style.' + theme + '.css');
      });
    </script>

    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>