@extends('layouts.dashboard')
@section('page_title', 'Doctors - Certificat Medical')
@section('page_name', 'Certificat Médical')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2> {{ Str::upper($patient->f_name) }}&nbsp;{{ Str::upper($patient->l_name) }}</h2>
                        <h5>{{ \Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y ans') }}
                        </h5>
                        <h5>{{ $patient->phone }}</h5>
                        <h5>{{ $patient->getWilaya->lib_wilaya }}</h5>

                    </div>
                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header">L'état de santé du patient nécessite un arrêt du travail de
                    </h3>
                    <div class="card-body">
                            <form action="{{route('doc.patients.storeCertificat_medical')}}" method="POST">
                                @csrf
                                @method('post')

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input name="time" type="text"
                                                class="form-control @error('time')  is-invalid @enderror" placeholder="Durée"
                                                value="{{ old('time') }}" required>
                                            @error('time')
                                                <span class="invalid-feedback" role="alert">
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input name="date" type="date"
                                                class="form-control @error('date')  is-invalid @enderror" placeholder="date"
                                                value="{{ old('date') }}" value="" required>
                                            @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-block bg-gradient-success ">Imprimer</button>

                                    </div>
                                </div>


                            </form>


                    </div>
                </div>

            </div>

        </div>
    </div><!-- /.container-fluid -->

@endsection





@section('style')



@endsection

@section('script')


@endsection
