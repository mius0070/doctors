@extends('layouts.dashboard')
@section('full_name', 'CHIBANE Mourad')
@section('page_title', 'Agenda')
@section('page_name', 'Agenda')
@section('content')

    <div class="container-fluid ">
      <div class="card">
        <div class="card-body">
          {!! $calendar->calendar() !!}

        </div>
      </div>
    

       
       
    </div><!-- /.container-fluid -->

@endsection



 

@section('style')
<!-- fullCalendar -->
<link rel="stylesheet" href="{{asset('plugins/fullcalendar/main.css')}}">

    
@endsection

@section('script')
<!-- jQuery UI -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- fullCalendar 2.2.5 -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/fullcalendar/main.js')}}"></script>
{!! $calendar->script() !!}

@endsection
