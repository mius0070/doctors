@extends('layouts.dashboard')
@section('full_name', 'CHIBANE Mourad')
@section('page_title', 'Doctors - Salle d\'attente')
@section('page_name', 'Salle d\'attente')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card-body">
                    <ul class="todo-list ui-sortable" data-widget="todo-list">

                        @foreach ($patients as $item)
                            <li>
                                <!-- todo text -->
                                <h4 class="text">{{ $item->getPatients->f_name }}&nbsp;{{ $item->getPatients->l_name }}</h4>
                                <!-- Emphasis label -->
                                <!-- General tools such as edit or delete-->
                                <div class="tools">
                                    <a href="{{ route('doc.patients.show', $item->getPatients->id) }}"><i
                                            class="fas fa-sign-in-alt fa-2x text-success"></i></a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    {{-- if collection is empty --}}
                    @if ($patients->isEmpty())
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-danger">La salle d'attente est vide</h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>


    </div><!-- /.container-fluid -->

@endsection





@section('style')



@endsection

@section('script')


@endsection
