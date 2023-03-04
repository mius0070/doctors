@extends('layouts.dashboard')
@section('full_name', 'CHIBANE Mourad')
@section('page_title', 'Doctors - Code barre du patient')
@section('page_name', 'Code barre du patient')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body print-content">

                        {{ Str::upper($patient->l_name) }} &nbsp; {{ Str::upper($patient->f_name) }}
                        <br>
                        <small>{{ $patient->birthday }}&nbsp;({{ \Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y ans') }})</small>
                        <br>
                       <center> {!! DNS1D::getBarcodeHTML("$patient->id", 'C128') !!}</center>
                        <small>NIP: 3001020{{ $patient->id }}</small>
                        <br>
                        <small>CA: {{ $patient->code_archive }}</small>
                    </div>


                </div>
                <button onclick="window.print();" type="submit"
                    class="btn btn-outline-success btn-lg btn-block">Imprimer</button>

            </div>
        </div>


    </div><!-- /.container-fluid -->

@endsection





@section('style')

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .print-content,
            .print-content * {
                visibility: visible;
                margin: 0;
                -webkit-print-color-adjust: exact;

            }

        }

    </style>

@endsection

@section('script')


@endsection
