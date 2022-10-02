@extends('layouts.print')
@section('page_title', 'Analyse')
@section('title_left')
    <div class="card">
        <div class="card-body text-center">
            <b> {{ Str::upper($analyse->getPatient->l_name) }} &nbsp; {{ Str::upper($analyse->getPatient->f_name) }}</b>
            <br>
            <b>{{ \Carbon\Carbon::parse($analyse->getPatient->birthday)->diff(\Carbon\Carbon::now())->format('%y ans') }}</b>
            <br>
            <center>{!! DNS1D::getBarcodeSVG($barcode, 'C128', 2, 50, 'black', true) !!}</center>
            <br>
            <small>CA: {{ $analyse->getPatient->code_archive }}</small>
        </div>
    </div>
@endsection

@section('title_right')
    <h2 class="text-primary"><b>ANALYSE A FAIRE</b></h2>
    <hr>
    <h4>Date : {{ date('d-m-Y', strtotime($analyse->created_at)) }}</h4>
@endsection

@section('content')

    <div class="table-responsive">
        <table class="table borderless">
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($analyse->anaDetail as $item)
                    <tr>
                        <th style="width:50%">{{ $i++ }}-{{ $item->ana_lib }}</th>

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
            <h6>Le {{ $analyse->created_at }} à {{ $entete->getWilaya->lib_wilaya }}</h6>
            <br>
            <u> Signature et cachet du docteur:</u><br>
            <b>Dr.{{ $analyse->getUser->name }}</b>


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
