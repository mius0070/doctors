@extends('layouts.dashboard')
@section('full_name', 'CHIBANE Mourad')
@section('page_title', 'Doctors - NOUVEAU RENDEZ VOUS')
@section('page_name', 'Nouveau rendez-vous')
@section('content')
    {{-- alert message from session --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Création réussie</h5>
          <strong>  <h1>{{ $message }}</h1></strong>
        </div>
    @endif
     {{-- alert message from session --}}
     @if ($message = Session::get('error'))
     <div class="alert alert-primary alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <h5><i class="icon fas fa-check"></i> Création réussie</h5>
       <strong>  <h1>{{ $message }}</h1></strong>
     </div>
 @endif
    {{-- alert message from error default --}}
    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible ">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <ul style="list-style: none;">
                @foreach ($errors->all() as $error)
                    <li><i class="icon fas fa-exclamation-triangle"></i>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('doc.patients.store_rdv') }}" method="POST">
                    @csrf
                    @method('post')
                    <div class="row">
                        <div class="col-md-4">
                            <h3> {{ Str::upper($patient->f_name) }}&nbsp;{{ Str::upper($patient->l_name) }}</h3>
                            <h6>{{ \Carbon\Carbon::parse($patient->birthday)->diff(\Carbon\Carbon::now())->format('%y ans') }}
                            </h6>
                            <h6>{{ $patient->phone }}</h6>
                            <h6>{{ $patient->getWilaya->lib_wilaya }}</h6>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Type de rendez-vous</label>
                                <select name="cons_type" class="form-control select2" style="width: 100%;">
                                    @foreach ($cons_type as $item)
                                        <option value="{{ $item->id }}">{{ $item->lib }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Médecins</label>
                                <select name="doctors" class="form-control select2" style="width: 100%;">
                                    @foreach ($doctors as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Date</label>
                                <input name="date" type="text" class="form-control @error('date')  is-invalid @enderror"
                                 id="datepicker" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" placeholder="yyyy-mm-dd" data-mask autocomplete="off" required>
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-block bg-gradient-success">Ajouter</button>

                        </div>
                        
                    </div>
                </form>
            </div>


        </div>


    </div><!-- /.container-fluid -->

@endsection





@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- datepicker -->
    <link rel="stylesheet" href="{{ asset('plugins/picker/jquery-ui.css') }}">

@endsection

@section('script')
<!-- datepicker -->
    <script src="{{ asset('plugins/picker/external/jquery/jquery.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('plugins/picker/jquery-ui.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/plugins/inputmask/jquery.inputmask.min.js') }}"></script>

    <script>
        $(function() {

            //Initialize Select2 Elements
            $('.select2').select2()


            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });
            $("#datepicker").datepicker({
                "dateFormat": "yy-mm-dd",

            });
            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('yyyy-mm-dd', {
                'placeholder': 'yyyy-mm-jj'
            })
            //Money Euro
            $('[data-mask]').inputmask();

        });

    </script>
@endsection
