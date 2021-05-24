@extends('layouts.dashboard')
@section('page_title', 'Doctors - Code barre du patient')
@section('page_name', 'Ordonnance du patient')
@section('content')

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
                <form action="#" method="POST">
                    @csrf
                    @method('POST')
                </form>
                <table class="table table-bordered table-hover table-sortable">
                    <thead>
                        <tr>
                            <th>
                                Medicaments
                            </th>
                            <th>
                                Dosage
                            </th>
                            <th>
                                Nombre de fois par jour
                            </th>
                            <th>
                                Nombre de jours
                            </th>
                            <th>
                                <a href="#" type="button" class="btn btn-outline-success btn-sm " id="addRow"><i
                                    class="fas fa-plus"></i></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input name="medi[]" type="text" class="form-control @error('medi[]')  is-invalid @enderror"
                                        placeholder="" value="{{ old('medi[]') }}">
                                    @error('medi[]')
                                        <span class="invalid-feedback" role="alert">
                                        </span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input name="dosage[]" type="text" class="form-control @error('dosage[]')  is-invalid @enderror"
                                        placeholder="" value="{{ old('dosage[]') }}">
                                    @error('dosage[]')
                                        <span class="invalid-feedback" role="alert">
                                        </span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input name="nbrpj[]" type="text" class="form-control @error('nbrpj[]')  is-invalid @enderror"
                                        placeholder="" value="{{ old('nbrpj[]') }}">
                                    @error('nbrpj[]')
                                        <span class="invalid-feedback" role="alert">
                                        </span>
                                    @enderror
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input name="nbrj[]" type="text" class="form-control @error('nbrj[]')  is-invalid @enderror"
                                        placeholder="" value="{{ old('nbrj[]') }}">
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
            </div>
        </div>



    </div><!-- /.container-fluid -->

@endsection



@section('style')

@endsection

@section('script')
<script>
     $('#addRow').on('click', function() {
            addRow();

        });
</script>


@endsection
