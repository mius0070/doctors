@extends('layouts.dashboard')
@section('full_name', 'CHIBANE Mourad')
@section('page_title', 'Patients')
@section('page_name', 'Liste des patients')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Liste des patients
            </h3>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th style="width: 200px;">Nom & Prénom</th>
                        <th>Age</th>
                        <th >Sexe</th>
                        <th>Wilaya</th>
                        <th>Code archive</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @php
                      $i = 1;
                  @endphp
                    @foreach ($patient as $item)
                    <td>{{$i++}}</td>
                            <td>{{ $item->f_name }}&nbsp;{{ $item->l_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->birthday)->diff(\Carbon\Carbon::now())->format('%y ans') }}
                                
                            </td>
                            <td>@if ($item->gender === 1 )
                                Homme
                            @elseif($item->gender === 2)
                                Femme
                            @endif</td>
                            <td>{{$item->getWilaya->lib_wilaya}} </td>
                            <td>{{$item->code_archive}}</td>
                            <td style="width: 120px;">
                                <a href="{{route('doc.patients.del',$item->id)}}"
                                    data-method="DELETE"
                                    onclick="return confirm('Voulez vous vraiment supprimer ce compte?')"
                                    type="submit" class="btn btn-outline-danger btn-sm" data-toggle="tooltip"
                                    data-placement="top" title="Supprimer"><i class="far fa-trash-alt"></i></a>
                                <a href="{{route('doc.patients.edit',$item->id)}}"  type="button"
                                    class="btn btn-outline-primary btn-sm" data-toggle="tooltip"
                                    data-placement="top" title="Modifier"><i class="far fa-edit"></i></a>
                                    <a href="{{route('doc.patients.show',$item->id)}}"  type="button"
                                        class="btn btn-outline-warning btn-sm" data-toggle="tooltip"
                                        data-placement="top" title="ouvrir"><i class="fas fa-arrow-right"></i></a>
                            </td>
                        </tr>

                    @endforeach

                </tbody>

            </table>
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
                    "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                    

                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            
        });

    </script>
@endsection
