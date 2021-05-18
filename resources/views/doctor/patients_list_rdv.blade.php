@extends('layouts.dashboard')
@section('full_name', 'CHIBANE Mourad')
@section('page_title', 'Rendez-vous par jour')
@section('page_name', 'Rendez-vous par jour')
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
            <div class="card-header">
                <h3 class="card-title">
                    Sélectionner un jour
                </h3>

            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('doc.rdv.store') }}">
                    @csrf
                    @method('post')
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    </div>
                                    <input name="date" type="text" class="form-control @error('date')  is-invalid @enderror"
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy"
                                        placeholder="jj-mm-aaaa" data-mask value="{{ old('date') }}">
                                    @error('date')
                                        <span class="invalid-feedback" role="alert"></span>

                                    @enderror
                                </div>
                                <!-- /.input group -->
                            </div>

                        </div>
                        <div class="col-md-3">
                            <br>
                            <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Rechercher</button>

                        </div>

                    </div>
                </form>
                @if ($rdv = Session::get('success'))

                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Code archive</th>
                                <th style="width: 200px;">Patient</th>
                                <th>Medecin</th>
                                <th>Etat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($rdv as $item)
                            <tbody>
                                <td>{{ $item->getPatients->code_archive }}</td>
                                <td>{{ $item->getPatients->f_name }}
                                    {{ $item->getPatients->l_name }}
                                    <br>
                                    <small>{{ $item->getPatients->phone }}</small></td>
                                <td>{{ $item->getDoctor->name }}</td>
                                <td>@switch($item)
                                        @case($item->etat === 0)
                                            <span class="badge bg-danger">Annulé</span>
                                        @break
                                        @case($item->etat === 1)
                                            <span class="badge bg-success">Validé</span>

                                        @break
                                        @case($item->etat === 2)
                                            <span class="badge badge-primary">en cours</span>

                                        @break
                                        @case($item->etat === 3)
                                            <span class="badge badge-warning">absente</span>

                                        @break
                                        @default

                                    @endswitch
                                </td>
                                <td style="width: 20px;">
                                    <a href="{{ route('doc.rdv.destroy', $item->id) }}" data-method="DELETE"
                                        onclick="return confirm('Voulez vous vraiment supprimer ce compte?')" type="submit"
                                        class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                        title="Supprimer">annuler</i></a>

                                </td>
                            </tbody>
                        @endforeach

                    </table>
                @endif


            </div>
        </div>

    </div>

@endsection
@section('style')

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

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
<!-- date-range-picker -->
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
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
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L',
            dateFormat: 'yyyy-mm-dd'
        }).format();


    });

</script>
@endsection
