<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Manajemen Ruangan Universitas Jambi</title>
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Canonical SEO -->
  <link rel="canonical" href="https://www.creative-tim.com/product/argon-dashboard-pro" />
  <!--  Social tags      -->
  <meta name="keywords" content="dashboard, bootstrap 4 dashboard, bootstrap 4 design, bootstrap 4 system, bootstrap 4, bootstrap 4 uit kit, bootstrap 4 kit, argon, argon ui kit, creative tim, html kit, html css template, web template, bootstrap, bootstrap 4, css3 template, frontend, responsive bootstrap template, bootstrap ui kit, responsive ui kit, argon dashboard">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <!-- Schema.org markup for Google+ -->
  <meta itemprop="name" content="Argon - Premium Dashboard for Bootstrap 4 by Creative Tim">
  <meta itemprop="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta itemprop="image" content="https://s3.amazonaws.com/creativetim_bucket/products/137/original/opt_adp_thumbnail.jpg">
  <!-- Open Graph data -->
  <meta property="fb:app_id" content="655968634437471">
  <meta property="og:title" content="Argon - Premium Dashboard for Bootstrap 4 by Creative Tim" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="https://demos.creative-tim.com/argon-dashboard/index.html" />
  <meta property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/137/original/opt_adp_thumbnail.jpg" />
  <meta property="og:description" content="Start your development with a Dashboard for Bootstrap 4." />
  <meta property="og:site_name" content="Creative Tim" />
  <!-- Favicon -->
  <link rel="icon" href="#" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{asset('assets_frontend/vendor/nucleo/css/nucleo.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('assets_frontend/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
  <!-- Page plugins -->
  <link rel="stylesheet" href="{{asset('assets_frontend/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets_frontend/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets_frontend/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}">

  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{asset('assets_frontend/css/argon.min-v=1.0.0.css')}}" type="text/css">
  <style>
    .navbar {
    background-color: #e6680e;
    }
    .header {
    background-color: #e6680e;
    }
 </style>
</head>

<body>
  <!-- Navabr -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-main navbar-expand-lg navbar-dark ">
    <div class="container">
      <a class="navbar-brand" href="{{url('/')}}">
        <img src="{{asset('assets_frontend/img/brand/white.png')}}">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="#">
                <img src="{{asset('assets_frontend/img/brand/blue.png')}}">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="{{url('/')}}" class="nav-link">
              <span class="nav-link-inner--text">Beranda</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <span class="nav-link-inner--text">Cek Ruangan</span>
            </a>
          </li>
        </ul>
        <hr class="d-lg-none" />
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          <li class="nav-item d-none d-lg-block ml-lg-4">
            <a href="{{route('login')}}" class="btn btn-neutral btn-icon">
              <!-- <span class="btn-inner--icon">
                <i class="fas fa-circle-08"></i>
              </span> -->
              <span class="nav-link-inner--text">Login</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  @yield('content')
  @yield('tambahan')
  <!-- Footer -->
  <footer class="py-5" id="footer-main">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; 2023 <a href="https://lptik.unja.ac.id/" class="font-weight-bold ml-1" target="_blank">LPTIK Universitas Jambi </a>
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
              <a href="https://lptik.unja.ac.id/" class="nav-link" target="_blank">LPTIK Universitas Jambi</a>
            </li>
            <li class="nav-item">
              <a href="{{url('/')}}" class="nav-link" target="_blank">Beranda</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" target="_blank">Cek Ruangan</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{asset('assets_frontend/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('assets_frontend/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets_frontend/vendor/js-cookie/js.cookie.js')}}"></script>
  <script src="{{asset('assets_frontend/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
  <script src="{{asset('assets_frontend/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
  <script src="{{asset('assets_frontend/vendor/lavalamp/js/jquery.lavalamp.min.js')}}"></script>
  <!-- Optional JS -->
  <script src="{{asset('assets_frontend/vendor/onscreen/dist/on-screen.umd.min.js')}}"></script>
  <script src="{{asset('assets_frontend/vendor/chart.js/dist/Chart.min.js')}}"></script>
  <script src="{{asset('assets_frontend/vendor/chart.js/dist/Chart.extension.js')}}"></script>

  <script src="{{asset('assets_frontend/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets_frontend/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('assets_frontend/vendor/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('assets_frontend/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{asset('assets_frontend/vendor/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{asset('assets_frontend/vendor/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
  <script src="{{asset('assets_frontend/vendor/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{asset('assets_frontend/vendor/datatables.net-select/js/dataTables.select.min.js')}}"></script>
  <!-- Argon JS -->
  <script src="{{asset('assets_frontend/js/argon.min-v=1.0.0.js')}}"></script>
  <!-- Demo JS - remove this in your project -->
  <script src="{{asset('assets_frontend/js/demo.min.js')}}"></script>
</body>

</html>
