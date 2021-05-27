@extends('layouts.dashboard')
@section('page_title', 'Doctors - Analyse ')
@section('page_name', 'Analyse a faire')
@section('content')

    <div class="container-fluid">

        <div class="card">
            <div class="card-body">

                <form action="{{ route('doc.patients.storeAnalyse') }}" method="POST">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <select name="analyse[]" class="duallistbox" multiple="multiple">
                            @foreach ($analyse as $item)
                                <option value="{{ $item->lib_ana }}" >{{ $item->lib_ana }}</option>

                            @endforeach

                        </select>
                    </div>

                    <Button type="submit" class="btn btn-outline-success btn-sm " style="width: 20%;">Enregistrer</Button>

                </form>

            </div>
        </div>



    </div><!-- /.container-fluid -->

@endsection



@section('style')
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">

@endsection

@section('script')
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script>
        $(function() {


            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox({
                moveOnSelect: false,
                preserveSelectionOnMove: 'false',
                filterPlaceHolder: 'Filtre',
                infoText: '',
                selectorMinimalHeight: '200',
                nonSelectedListLabel: 'Liste des analyses',
                selectedListLabel: 'à faire',

            })



        });

    </script>
@endsection
