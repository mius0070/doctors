@extends('layouts.dashboard')
@section('full_name', 'CHIBANE Mourad')
@section('page_title', 'Liste des documents')
@section('page_name', 'Liste des documents')
@section('content')
    {{-- alert message from error default --}}
    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible ">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <ul style="list-style: none;">
                @foreach ($errors->all() as $error)
                    <li><i class="icon fas fa-exclamation-triangle"></i>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4> {{ Str::upper($patient->f_name) }}&nbsp;{{ Str::upper($patient->l_name) }}</h4>
                <h6>{{ \Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y ans') }}</h6>
                <h6>{{ $patient->phone }}</h6>
                <h6>{{ $patient->getWilaya->lib_wilaya }}</h6>

            </div>
        </div>
        <div class="card">
            <div class="card-body">



                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Type document</th>
                            <th>Medecin</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- show ordonannce --}}
                        @foreach ($ordonnance as $item)
                            <tr>
                                <td>ordonnance</td>
                                <td>{{ $item->getUser->name }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td> <a href="{{ route('doc.patients.showOrdonnance', $item->id) }}" type="button"
                                        class="btn btn-outline-warning btn-sm" data-toggle="tooltip" data-placement="top"
                                        title="ouvrir"><i class="fas fa-arrow-right"></i></a></td>

                            </tr>
                        @endforeach
                        {{-- show analyses --}}
                        @foreach ($analyse as $item)
                            <tr>
                                <td>Analyse</td>
                                <td>{{ $item->getUser->name }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td> <a href="{{ route('doc.patients.showAnalyse', $item->id) }}" type="button"
                                        class="btn btn-outline-warning btn-sm" data-toggle="tooltip" data-placement="top"
                                        title="ouvrir"><i class="fas fa-arrow-right"></i></a></td>

                            </tr>
                        @endforeach
                        {{-- show Certificat Médical --}}
                        @foreach ($certificat_medical as $item)
                            <tr>
                                <td>Certificat Medical</td>
                                <td>{{ $item->getUser->name }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td> <a href="{{ route('doc.patients.showCertificat_medical', $item->id) }}"
                                        type="button" class="btn btn-outline-warning btn-sm" data-toggle="tooltip"
                                        data-placement="top" title="ouvrir"><i class="fas fa-arrow-right"></i></a></td>

                            </tr>
                        @endforeach
                        {{-- show Certificat Médical --}}
                        @foreach ($radio as $item)
                            <tr>
                                <td>{{ $item->getTypeRadio->lib_radio }}</td>
                                <td>{{ $item->getUser->name }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td> <a href="{{ route('doc.patients.showCertificat_medical', $item->id) }}"
                                        type="button" class="btn btn-outline-warning btn-sm" data-toggle="tooltip"
                                        data-placement="top" title="ouvrir"><i class="fas fa-arrow-right"></i></a></td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>


            </div>
        </div>

    </div>

@endsection
@section('style')

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('script')


    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script>
        $(function() {

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('yyyy-mm-dd', {
                'placeholder': 'yyyy-mm-dd'
            })
            //Money Euro
            $('[data-mask]').inputmask()
            $("#example1").DataTable({

                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "language": {
                    "search": "Recherche : ",
                    "oPaginate": {
                        "sFirst": "Premier",
                        "sPrevious": "Pr&eacute;c&eacute;dent",
                        "sNext": "Suivant",
                        "sLast": "Dernier"
                    },
                    "sProcessing": "Traitement en cours...",
                    "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
                    "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                    "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                    "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    "sInfoPostFix": "",
                    "sLoadingRecords": "Chargement en cours...",
                    "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",


                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');



        });
    </script>
@endsection
