@extends('layouts.dashboard')
@section('page_title', 'Doctors - Code barre du patient')
@section('page_name', 'Ordonnance du patient')
@section('content')

    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                <form action="{{ route('doc.patients.storeOrdonnance') }}" method="POST">
                    @csrf
                    @method('POST')

                    <table class="table table-bordered table-hover table-sortable">
                        <thead>
                            <tr>

                                <th style="width: 600px;">
                                    Medicaments
                                </th>

                                <th>
                                    Nombre de fois par jour
                                </th>
                                <th>
                                    Nombre de jours
                                </th>
                                <th>
                                    <a href="#" type="button" class="btn btn-outline-primary btn-sm " id="addRow"><i
                                            class="fas fa-plus"></i></a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="tableRow">
                                <td>
                                    <div class="form-group" style="width: 100%;">
                                        <select name="medicaments[]" class="form-control select2 ">
                                            @foreach ($medicaments as $item)
                                                @php
                                                    $medic = $item->DCI_LIB . ' ' . $item->DCI_SPEC;
                                                @endphp
                                                <option value="{{ $item->DCI_LIB }}&nbsp;{{ $item->DCI_SPEC }}">
                                                    {{ $item->DCI_LIB }} &nbsp;
                                                    {{ $item->DCI_SPEC }}</option>
                                            @endforeach



                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input name="nbrpj[]" type="text"
                                            class="form-control @error('nbrpj[]')  is-invalid @enderror" placeholder=""
                                            value="{{ old('nbrpj[]') }}" required>
                                        @error('nbrpj[]')
                                            <span class="invalid-feedback" role="alert">
                                            </span>
                                        @enderror
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input name="nbrj[]" type="text"
                                            class="form-control @error('nbrj[]')  is-invalid @enderror" placeholder=""
                                            value="{{ old('nbrj[]') }}" required>
                                        @error('nbrj[]')
                                            <span class="invalid-feedback" role="alert">
                                            </span>
                                        @enderror
                                    </div>
                                </td>
                                <td>
                                    <a href="#" type="button" class="btn btn-outline-danger btn-sm remove"><i
                                            class="fas fa-times"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <Button type="submit" class="btn btn-outline-success btn-sm " style="width: 20%;">Enregistrer</Button>
                </form>
            </div>
        </div>



    </div><!-- /.container-fluid -->

@endsection



@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {

            //Initialize Select2 Elements
            $('.select2').select2({})

        })

        $('#addRow').on('click', function() {
            addRow();

        });

        function addRow() {
            var tr =
                '<tr>' +
                '<td><div class="form-group"><select name="medicaments[]" class="form-control select2">' +
                '@foreach ($medicaments as $item)  <option value="{{ $item->DCI_LIB }}" >{{ $item->DCI_LIB }} &nbsp;{{ $item->DCI_SPEC }}</option> @endforeach' +
                '</select></div>' +
                '<td><input name="nbrpj[]" type="text" class="form-control @error('nbrpj[]') is-invalid @enderror" placeholder="" value="{{ old('nbrpj[]') }}" required>' +
                '<td><input name="nbrj[]" type="text" class="form-control @error('nbrj[]') is-invalid @enderror" placeholder="" value="{{ old('nbrj[]') }}" required>' +
                '<td><a href="#" type="button" class="btn btn-outline-danger btn-sm remove"><i class="fas fa-times"></i></a></td>'
            '</th>';

            var last = $('tbody tr').length;
            if (last < 10) {
                $('tbody').append(tr);
                $('.select2').select2({})
            }

        }
        $(document).on('click', '.remove', function() {
            var last = $('tbody tr').length;
            if (last == 1) {
                alert('Errur');
            } else {
                $(this).parent().parent().remove();

            }
        });
    </script>


@endsection
