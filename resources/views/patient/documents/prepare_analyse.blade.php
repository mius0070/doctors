@extends('layouts.print')
@section('page_title', 'Analyse')
@section('title_left')
<div class="card">
    <div class="card-body text-center">
        <b> {{ Str::upper($patient->l_name) }} &nbsp;
            {{ Str::upper($patient->f_name) }}</b>
        <br>
        <b>{{ \Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y ans') }}</b>
        <center>{!! DNS1D::getBarcodeSVG($barcode, 'C128', 2, 50, 'black', true) !!}</center>
        <small>CA: {{ $patient->code_archive }}</small>
    </div>
</div>
@endsection

@section('title_right')
    <h2 class="text-primary"><b>ANALYSE A FAIRE</b></h2>
    <hr>
    <h4>Date : {{ date('d-m-Y') }}</h4>
@endsection

@section('content')

    @php
        $content = "
                        <div class='table-responsive'>
                                <table class='table borderless'>
                                    <tbody>";
        foreach ($analyse as $item => $val) {
            for ($i = 0; $i < count($analyse[$item]['analyse']); $i++) {
                $content .= '<tr>';
                $content .= "<th style='padding-left:4rem;'>" . ($i + 1) . '- ' . $analyse[$item]['analyse'][$i] . '</th>';
                $content .= '</tr>';
            }
        }

        $content .= '</tbody></table></div>';

        echo $content;
    @endphp
    <br>
    <br><br><br>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 text-right">
            <h6>Le {{ now() }} à {{ $entete->getWilaya->lib_wilaya }}</h6>
            <br>
            <u> Signature et cachet du docteur:</u><br>
            <b>Dr.{{ Auth()->user()->name }}</b>


        </div>
    </div>



@endsection
@section('button')
    <form action="{{ route('doc.patients.storeAnalyse') }}" method="POST">
        @csrf
        @method('post')
        <textarea class="d-none" name="content">
     {{ $content }}
  </textarea>

        <button class="dropdown-item" type="submit">Enregistrer</button>
    </form>
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
