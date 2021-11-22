@extends('layouts.print')
@section('page_title', 'Certificat médical')
@section('title_left')
    <div class="card">
        <div class="card-body text-center">
            <b> {{ Str::upper($patient->l_name) }} &nbsp; {{ Str::upper($patient->f_name) }}</b>
            <br>
            <b>{{ \Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y ans') }}</b>
            <br>
            <img src="data:image/png;base64,{{ base64_encode($barcode) }} ">
            <br>
            <small>CA: {{ $patient->code_archive }}</small>
        </div>
    </div>
@endsection

@section('title_right')
    <h2 class="text-primary"><b>CERTIFICAT MEDICAL</b></h2>
    <hr>
    <h4>Date : {{ date('d-m-Y', strtotime(\Carbon\Carbon::now())) }}</h4>
@endsection

@section('content')





    <p>
    <h4> &nbsp; Je soussigné <strong>Dr.{{ $certificat->Getuser->name }}</strong> certifie avoir examiné :</h4>
    </p>

    <p>
    <h5>Mr, Mlle, Mme :<b> {{ Str::upper($patient->l_name) }} &nbsp; {{ Str::upper($patient->f_name) }}</b></h5>
    </p>

    <p>
    <h5>Né (e) le : {{ $patient->birthday }}</p>
    </h5>

    <p>
    <h5> et je déclare que son êtat de santé nécessite un arrêt du travail de : <strong>{{ $certificat->nbr_j }}</strong> jours</p>
    </h5>
    <p>
    <h5> à compter de :<strong>{{ date('d-m-Y', strtotime($certificat->date)) }} </strong> sauf complications.</p>
    </h5>
    <br>
    <br><br><br>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 text-right">
            <h6>Le {{ \Carbon\Carbon::now() }} à {{ $entete->getWilaya->lib_wilaya }}</h6>
            <br>
            <u> Signature et cachet du docteur:</u><br>
            <b>Dr.{{ $certificat->Getuser->name }}</b>


        </div>
    </div>



@endsection


@section('style')

@endsection
