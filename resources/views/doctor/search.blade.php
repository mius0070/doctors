@extends('layouts.dashboard')
@section('full_name', 'CHIBANE Mourad')
@section('page_title', 'Recherche avancée')
@section('page_name', 'Recherche avancée')
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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Rechercher un patient
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <form method="POST" action="{{ route('doc.search.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Nom</label>
                            <input name="f_name" type="text" class="form-control @error('f_name')  is-invalid @enderror"
                                placeholder="Nom" value="{{ old('f_name') }}">
                            @error('f_name')
                                <span class="invalid-feedback" role="alert">
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Prénom</label>
                            <input name="l_name" type="text" class="form-control @error('l_name')  is-invalid @enderror"
                                placeholder="Prénom" value="{{ old('l_name') }}">
                            @error('l_name')
                                <span class="invalid-feedback" role="alert">
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Code archive</label>
                            <input name="code_archive" type="text"
                                class="form-control @error('code_archive')  is-invalid @enderror" placeholder="Code archive"
                                value="{{ old('code_archive') }}">
                            @error('code_archive')
                                <span class="invalid-feedback" role="alert">
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Rechercher</button>

                    </form>

                </div>
                <div class="col-md-8">
                    @if ($find = Session::get('success'))

                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nom & Prénom</th>
                                    <th>Date de naissance</th>
                                    <th>Sexe</th>
                                    <th>Téléphone</th>
                                    <th>Code archive</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($find as $item)
                                    <tr>
                                        <td><a
                                                href="{{ route('doc.patients.show', $item->id) }}">{{ $item->f_name }}&nbsp;{{ $item->l_name }}</a>
                                        </td>
                                        <td>{{ $item->birthday }}</td>
                                        <td>

                                            {{ $item->gender == 1 ? 'Homme' : null }}
                                            {{ $item->gender == 2 ? 'Femme' : null }}
                                            {{ $item->gender == 3 ? 'Garçon' : null }}
                                            {{ $item->gender == 4 ? 'Fille' : null }}
                                        </td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->code_archive }}</td>
                                    </tr>
                                @endforeach
                            </tbody>



                        </table>
                    @endif
                </div>
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
    <script>
        $(function() {
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
                    "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau"

                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
@endsection
