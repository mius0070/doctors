@extends('layouts.print')
@section('page_title', 'Ordonnace')
@section('title_left')
    <div class="card">
        <div class="card-body text-center">
            <b> {{ Str::upper($ordonnance->getPatient->l_name) }} &nbsp; {{ Str::upper($ordonnance->getPatient->f_name) }}</b>
            <br>
            <b>{{ \Carbon\Carbon::parse($ordonnance->getPatient->birthday)->diff(\Carbon\Carbon::now())->format('%y ans') }}</b>
            <br>
            <img src="data:image/png;base64,{{ base64_encode($barcode) }} ">
            <br>
            <small>CA: {{ $ordonnance->getPatient->code_archive }}</small>
        </div>
    </div>
@endsection

@section('title_right')
    <h2 class="text-primary"><b>ORDONNANCE</b></h2>
    <hr>
    <h4>Date : {{ date('d-m-Y', strtotime($ordonnance->created_at)) }}</h4>
@endsection

@section('content')

    <div class="table-responsive">
        <table class="table borderless">
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($ordonnance->orDetail as $item)
                    <tr>
                        <th style="width:50%">{{ $i++ }}-{{ $item->med_lib }} &nbsp; {{ $item->dosage }}</th>
                        <td>{{ $item->nbr_p_j }} *j</td>
                        <td>pendnat <b>{{ $item->nbr_j }} jours </b></td>
                    </tr>
                @endforeach


            </tbody>
        </table>

    </div>
    <br>
    <br><br><br>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 text-right">
            <h6>Le {{ $ordonnance->created_at }} à {{ $entete->getWilaya->lib_wilaya }}</h6>
            <br>
            <u> Signature et cachet du docteur:</u><br>
            <b>Dr.{{ $ordonnance->getUser->name }}</b>


        </div>
    </div>



@endsection

@section('footer')
    <footer>
        qsdqsd
    </footer>
@endsection

@section('style')
    <style>
        .borderless td,
        .borderless th {
            border: none;
        }

    </style>
@endsection
