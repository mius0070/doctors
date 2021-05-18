<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    @yield('style')
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div>

        {{-- navbar --}}
        @include('layouts.navbar')
        {{-- /navbar --}}

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../../index3.html" class="brand-link">
                <img src="{{ asset('/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Doctors</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <span class="fas fa-user-md fa-2x text-white"></span>
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"> {{auth()->user()->name}}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        @section('menu')
                            @if (request()->session()->has('pat'))

                            <li class="nav-header"> <i class="nav-icon fas fa-folder-open"></i> &nbsp; Dossier du patient </li>
                                <li class="nav-item">
                                    <a href="{{ route('doc.patients.show', session()->get('pat')) }}" class="nav-link">
                                        <i class="nav-icon fas fa-user"></i>
                                        <p>
                                            {{ Str::upper(session()->get('pat_f_name')) }}
                                            &nbsp;{{ Str::upper(session()->get('pat_l_name')) }}
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-barcode"></i>
                                        <p>
                                            Code barre
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('doc.patients.history')}}" class="nav-link">
                                        <i class="nav-icon fas fa-history"></i>
                                        <p>
                                            Historique
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-calendar-alt"></i>
                                        <p>
                                            Rendez-vous
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link ">
                                                {{-- <i class="far fa-circle nav-icon"></i> --}}
                                                <p>Nouveau</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('doc.patients.list_rdv')}}" class="nav-link ">
                                                {{-- <i class="far fa-circle nav-icon"></i> --}}
                                                <p>Liste</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                              </li>
                              <li class="nav-item">
                                  <a href="#" class="nav-link">
                                      <i class="nav-icon fas fa-stethoscope"></i>
                                      <p>
                                          Consultations
                                          <i class="fas fa-angle-left right"></i>
                                      </p>
                                  </a>
                                  <ul class="nav nav-treeview">
                                      <li class="nav-item">
                                          <a href="#" class="nav-link ">
                                              {{-- <i class="far fa-circle nav-icon"></i> --}}
                                              <p>Nouveau</p>
                                          </a>
                                      </li>
                                      <li class="nav-item">
                                          <a href="#" class="nav-link ">
                                              {{-- <i class="far fa-circle nav-icon"></i> --}}
                                              <p>Liste</p>
                                          </a>
                                      </li>
                                  </ul>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        Document
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('doc.patients.list_rdv')}}" class="nav-link ">
                                            {{-- <i class="far fa-circle nav-icon"></i> --}}
                                            <p>Liste</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link ">
                                            {{-- <i class="far fa-circle nav-icon"></i> --}}
                                            <p>Nouveau</p>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </li>
                                <li class="nav-item">
                                    <a href="{{ route('doc.destroy.session') }}" class="nav-link active bg-danger">
                                        <i class="nav-icon fas fa-times-circle"></i>
                                        <p>
                                            Fermier le dossier
                                        </p>
                                    </a>
                                </li>
                                
                            @endif
                            <li class="nav-header"> <i class="nav-icon fas fa-tachometer-alt"></i> &nbsp; Accueil</li>
                            <li class="nav-item">
                                <a href="{{ route('doc.index') }}"
                                    class="nav-link {{ request()->segment(2) == '' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Tableau de bord
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('doc.search.index') }}"
                                    class="nav-link {{ request()->segment(2) == 'search' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-search"></i>
                                    <p>
                                        Recherche avancée
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('doc.patients.salle') }}" class="nav-link {{ Route::is('doc.patients.salle') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-clock"></i>
                                    <p>
                                        Salle d'attente
                                    </p>
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{route('doc.calendar.index')}}" class="nav-link {{ Route::is('doc.calendar.index') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-calendar-alt "></i>
                                    <p>
                                        Agedna
                                    </p>
                                </a>

                            </li>
                            <li class="nav-item  {{ Route::is('doc.patients.index') || Route::is('doc.patients.create') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ Route::is('doc.patients.index')|| Route::is('doc.patients.create') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Patients
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('doc.patients.create') }}"
                                            class="nav-link {{ request()->segment(3) == 'create' ? 'active' : '' }}">
                                            {{-- <i class="far fa-circle nav-icon"></i> --}}
                                            <p>Nouveau Patient</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('doc.patients.index') }}"
                                            class="nav-link {{ request()->segment(2) == 'patients' && request()->segment(3) == '' ? 'active' : '' }}">
                                            {{-- <i class="far fa-circle nav-icon"></i> --}}
                                            <p>Liste des patients</p>
                                        </a>
                                    </li>
                                 
                                    
                                </ul>
                                <li class="nav-item  {{ Route::is('doc.rdv.index')  ? 'menu-open' : '' }}">
                                  <a href="#" class="nav-link {{  Route::is('doc.rdv.index') ? 'active' : '' }}">
                                      <i class="nav-icon fas fa-user"></i>
                                      <p>
                                          Rendez-vous
                                          <i class="fas fa-angle-left right"></i>
                                      </p>
                                  </a>
                                  <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                      <a href="{{ route('doc.rdv.index') }}"
                                          class="nav-link {{ request()->segment(2) == 'rdv' ? 'active' : '' }}">
                                          {{-- <i class="far fa-circle nav-icon"></i> --}}
                                          <p>Liste RDV/JOUR</p>
                                      </a>
                                  </li>
                                  </ul>
                                </li>
                            </li>
                        @show




                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('page_name')</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('doc.index') }}">Tableau de bord</a></li>
                                <li class="breadcrumb-item active">@yield('page_name')</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        {{-- footer --}}
        @include('layouts.footer')
        {{-- /footer --}}

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    @yield('script')
</body>

</html>
