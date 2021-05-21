<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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

        page {
            background: white;
            display: block;
            margin: 0 auto;
            box-shadow: 0 0 0.2cm rgba(0, 0, 0, 0.5);
            padding: 15px;

        }

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
        }

        page[size="A4"][layout="portrait"] {
            width: 29.7cm;
            height: 21cm;
        }

        @media print {

            body,
            page {
                margin: 0;
                box-shadow: 0;
            }
        }

    </style>
</head>

<body>
    <page size="A4">
            <div class="row">
                <div class="col-md-5 text-center">
                    <h5 class="text-primary ">Dr.ADDOURI S. Eps Bouamama</h5>
                    <h6> <small class="">SPECIALISTE Gynécologie-Obstétrique</small></h6>
                    <h6> <small class="">N° 302355 / GH</small></h6>
                </div>
                <div class="col-md-2 text-center">
                    <img src="{{ asset('/dist/img/logo.png') }}" width="100" alt="Logo"
                    class="brand-image img-circle" style="opacity: .8">
                </div>
                <div class="col-md-5 text-right">
                    <h5> <small class="">Cité ifri la silisse - ouargla</small></h5>
                    <h5> <small class="">tel:029715346 / fax:029715337</small></h5>
                    <h5> <small class="">dr.kaddouri@gmail.com</small></h5>

                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <h3 class="text-primary">Liste Rendez-vous | 16-05-2021</h3>

                </div>
            </div>
        <div class="jumbotron bg-">
            qsqs
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
