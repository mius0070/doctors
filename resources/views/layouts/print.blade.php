<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <style>
        body {
            background: rgb(204, 204, 204);
        }

        page[size="A4"] {
            width: 22cm;
            height: 29.7cm;
            background: white;
            display: block;
            margin: 0 auto;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
            padding: 15px;

        }



        @media print {

            body,
            page {

                margin: 0;
                padding: 0;
                box-shadow: 0;
            }
            .dropdown ,.dropdown *{
                visibility: hidden;
            }
        }

    </style>
    @yield('style')
</head>

<body>
    <center >
        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Option
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
              <button class="dropdown-item" type="button" onclick="window.print()">Imprimer</button>
              <a href="{{route('doc.patients.list_doc')}}" class="dropdown-item" type="button">Retour</a>
            </div>
          </div>
        </center>
    <page size="A4">

        <div class="row ">
            <div class="col-md-5 text-center">
                <h5 class="text-primary ">{{ Str::upper($entete->titre) }}</h5>
                <h6> <small class="">{{ $entete->desc }}</small></h6>
                <h6> <small class="">N° {{ $entete->code_etablissement }} / GH</small></h6>
            </div>
            <div class="col-md-2 text-center">
                <img src="{{ asset($entete->logo) }}" width="100" alt="Logo" class="brand-image img-circle"
                    style="opacity: .8">
            </div>
            <div class="col-md-5 text-right">
                <h5> <small class="">{{ $entete->adresse }} - {{ $entete->getWilaya->lib_wilaya }}</small></h5>
                <h5> <small class="">
                        @if ($entete->phone != null)
                            Tél: {{ $entete->phone }}
                        @endif
                        /
                        @if ($entete->fax != null)
                            Fax: {{ $entete->fax }}
                        @endif
                    </small></h5>
                <h5> <small class="">{{ $entete->email }}</small></h5>

            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4">
                @yield('title_left')


            </div>
            <div class="col-md-8 text-right">

                @yield('title_right')
            </div>
        </div>
        <div class="container">
            @yield('content')
        </div>

    </page>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
</body>

</html>
