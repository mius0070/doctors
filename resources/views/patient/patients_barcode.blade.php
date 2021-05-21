
@extends('layouts.dashboard')
@section('full_name', 'CHIBANE Mourad')
@section('page_title', 'Doctors - Code barre du patient')
@section('page_name', 'Code barre du patient')
@section('content')

    <div class="container-fluid">
   <div class="row">
       <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                {{ Str::upper($patient->l_name) }} &nbsp; {{ Str::upper($patient->f_name) }}<br>
                <small>{{ $patient->birthday }}&nbsp;({{ \Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y ans') }})</small>
                <br>
                <img src="data:image/png;base64,{{ base64_encode($barcode) }} "><br>
                <small>NIP: 3001020{{ $patient->id }}</small>
                <br>
                <small>CA: {{ $patient->code_archive }}</small>
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


          