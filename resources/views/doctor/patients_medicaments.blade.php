@extends('layouts.dashboard')
@section('full_name', 'CHIBANE Mourad')
@section('page_title', 'Medicaments')
@section('page_name', 'Liste des medicaments')
@section('content')
    {{-- alert message from session --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Création réussie</h5>
            {{ $message }}
        </div>
    @endif
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
    {{-- Contents --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                    Ajouter un nouveau medicament
                </button>
            </h3>

        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Code</th>
                        <th style="width: 200px;">Medicament</th>
                        <th>Dosage</th>
                        <th>Prix</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($medicament as $item)
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->DCI_COD }}</td>
                        <td>{{ $item->DCI_LIB }}</td>
                        <td>{{ $item->DCI_SPEC }}</td>
                        <td>{{ $item->DCI_PU }}</td>
                        <td style="width: 120px;">
                            <a href="#" data-method="DELETE"
                                onclick="return confirm('Voulez vous vraiment supprimer ce compte?')" type="submit"
                                class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                title="Supprimer"><i class="far fa-trash-alt"></i></a>
                            <a href="#" type="button" class="btn btn-outline-primary btn-sm" data-toggle="tooltip"
                                data-placement="top" title="Modifier"><i class="far fa-edit"></i></a>

                        </td>
                        </tr>

                    @endforeach

                </tbody>

            </table>
        </div>
        {{-- Modal add new medicament --}}
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Nouveau medicament</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('doc.medicaments.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label>Code</label>
                                <input name="code" type="text" class="form-control @error('code')  is-invalid @enderror"
                                    placeholder="Code" value="{{ old('code') }}" required>
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Medicament</label>
                                <input name="med" type="text" class="form-control @error('med')  is-invalid @enderror"
                                    placeholder="Medicament" value="{{ old('med') }}" required>
                                @error('med')
                                    <span class="invalid-feedback" role="alert">
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Dosage</label>
                                <input name="dosage" type="text" class="form-control @error('dosage')  is-invalid @enderror"
                                    placeholder="Dosage" value="{{ old('dosage') }}" required>
                                @error('dosage')
                                    <span class="invalid-feedback" role="alert">
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Prix</label>
                                <input name="prix" value="0.00" type="text"
                                    class="form-control @error('prix')  is-invalid @enderror" placeholder="Prix"
                                    value="{{ old('prix') }}" required>
                                @error('prix')
                                    <span class="invalid-feedback" role="alert">
                                    </span>
                                @enderror
                            </div>


                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" style="width: 100%;" class="btn btn-success">Ajouter </button>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
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
                    "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",


                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
@endsection
