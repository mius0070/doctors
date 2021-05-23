@extends('layouts.dashboard')
@section('full_name', 'CHIBANE Mourad')
@section('page_title', 'Liste des Rendez-vous')
@section('page_name', 'Liste des Rendez-vous')
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
                <h4> {{Str::upper($patient->f_name) }}&nbsp;{{Str::upper($patient->l_name)}}</h4>
                <h6>{{ \Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y ans') }}</h6>
                <h6>{{$patient->phone}}</h6>
                <h6>{{$patient->getWilaya->lib_wilaya}}</h6>

            </div>
        </div>
        <div class="card">
            <div class="card-body">
                   
    

                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Date RDV</th>
                                <th >Type RDV</th>
                                <th>Medecin</th>
                                <th>Fait par</th>
                                <th>Etat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($rdv as $item)
                            <tbody>
                                <td>{{ $item->date_rdv }}</td>
                                <td>{{ $item->getTypeCons->lib}}</td>
                                <td>{{ $item->getDoctor->name }}</td>
                                <td>{{$item->made_by}}</td>
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
                                    @if ($item->etat === 2 && $item->made_by === auth()->user()->name )
                                    <a href="{{ route('doc.rdv.cancel', $item->id) }}" data-method="DELETE"
                                        onclick="return confirm('Voulez vous vraiment supprimer ce compte?')" type="submit"
                                        class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                        title="Supprimer">annuler</i></a>
                                    @endif
                                   

                                </td>
                            </tbody>
                        @endforeach

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
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L',
            dateFormat: 'yyyy-mm-dd'
        }).format();


    });

</script>
@endsection
