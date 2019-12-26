<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">

  <!-- CSS Custum -->
  <style>
    .action2 {
      min-width: 180px;
    }
    .action3 {
      min-width: 240px;
    }
    .th-md {
      min-width: 180px;
    }
    .btn-insearch {
      background: white;
      border-color: #e4e6fc;
    }
    .trFilter > th {
      background-color: white !important;
    }
    .linkMaster {
      font-size: 20px !important;
    }
  </style>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Login as Manager</div>
              <a href="#" class="dropdown-item has-icon"><i class="far fa-user"></i> Profile</a>
              <a href="#" class="dropdown-item has-icon"><i class="fas fa-cog"></i> Settings</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-head').submit();"><i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}</a>
              <form id="logout-form-head" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </div>
          </li>
        </ul>
      </nav>
      @section('sidebar')
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="/">{{ config('app.name', 'Laravel') }}</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">Hs</a>
          </div>
          <ul class="sidebar-menu">
              <hr>
              <li class="active"><a href="/" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
              <li><a class="nav-link" href="/"><i class="fas fa-cart-plus"></i> <span>POS</span></a></li>
              <li><a class="nav-link" href="/"><i class="fas fa-box-open"></i> <span>Produk</span></a></li>
              <li><a class="nav-link" href="/"><i class="fas fa-ambulance"></i> <span>Pembelian</span></a></li>
              <li><a class="nav-link" href="{{ url('inventories') }}"><i class="fas fa-cubes"></i> <span>Inventori</span></a></li>
              <li><a class="nav-link" href="/"><i class="fas fa-chalkboard-teacher"></i> <span>Monitor Inventori</span></a></li>
              <li><a class="nav-link" href="/"><i class="fas fa-pencil-ruler"></i> <span>Keuangan</span></a></li>
              <li><a class="nav-link" href="/"><i class="fas fa-paste"></i> <span>Laporan Penjualan</span></a></li>
              <li><a class="nav-link" href="/"><i class="fas fa-paste"></i> <span>Laporan Pembelian</span></a></li>
              <li><a class="nav-link" href="/"><i class="fas fa-paste"></i> <span>Laporan Inventori</span></a></li>
              <li><a class="nav-link" href="/"><i class="fas fa-file-invoice-dollar"></i> <span>Laba Rugi</span></a></li>
              <li class="nav-item dropdown">
                <a href="{{ url('masters') }}" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cogs"></i> <span>Master</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ url('categories') }}">Kategori</a></li>
                  <li><a class="nav-link" href="{{ url('masters?do=payment') }}">Tipe Pembayaran</a></li>
                  <li><a class="nav-link" href="{{ url('masters?do=order') }}">Tipe Order</a></li>
                  <li><a class="nav-link" href="{{ url('users') }}">User Akses</a></li>
                </ul>
              </li>
            </ul>

            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a class="btn btn-primary btn-lg btn-block btn-icon-split" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
        </aside>
      </div>
      @show

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>

      <footer class="main-footer">
        <div class="footer-left">Copyright &copy; 2018 <div class="bullet"></div> Allright reserved</div>
        <div class="footer-right">1.0.3</div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('js/stisla.js') }}"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="{{ asset('js/scripts.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>

  <!-- Page Specific JS File -->
</body>
</html>
