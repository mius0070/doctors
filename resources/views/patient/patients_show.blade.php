@extends('layouts.dashboard')
@section('full_name', 'CHIBANE Mourad')
@section('page_title', 'Doctors - Dossier du patient')
@section('page_name', 'Dossier du patient')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1> {{ Str::upper($patient->f_name) }}&nbsp;{{ Str::upper($patient->l_name) }}</h1>
                        <h4>{{ \Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y ans') }}
                        </h4>
                        <h4>{{ $patient->phone }}</h4>
                        <h4>{{ $patient->getWilaya->lib_wilaya }}</h4>

                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-clock"></i></span>

                    <div class="info-box-content ">
                        <span class="info-box-number">
                            <h5>{{ $patient->code_archive }}</h5>
                        </span>
                        <span class="info-box-text"><strong> Code archive</strong></span>

                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fa fa-stethoscope"></i></span>

                    <div class="info-box-content ">
                        <span class="info-box-number">
                            <h5>10</h5>
                        </span>
                        <span class="info-box-text"><strong> Consultations</strong></span>

                    </div>

                    <!-- /.info-box-content -->
                </div>
                @php
                    $date_rdv = \Carbon\Carbon::parse($rdv->date_rdv);
                @endphp
                @if ($date_rdv->isFuture() || $date_rdv->isToday())
                    <!-- /.info-box -->
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-calendar"></i></span>

                        <div class="info-box-content ">
                            <span class="info-box-number">
                                <h5>{{ $rdv->date_rdv }}</h5>
                            </span>
                            <span class="info-box-text"><strong> {{ $rdv->getTypeCons->lib }}</strong></span>

                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                @endif



            </div>
        </div>


    </div><!-- /.container-fluid -->

@endsection





@section('style')



@endsection

@section('script')


@endsection
