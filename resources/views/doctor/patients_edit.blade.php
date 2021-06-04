@extends('layouts.dashboard')
@section('full_name', 'CHIBANE Mourad')
@section('page_title', 'Patients')
@section('page_name', 'Ajouter des patients')
@section('content')
    {{-- alert message from session --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Modification réussie</h5>
            {{ $message }}
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
    <div class="card">

        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <form method="POST" action="{{ route('doc.patients.update',$patient->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label>Nom</label>
                            <input name="f_name" type="text" class="form-control @error('f_name')  is-invalid @enderror"
                                placeholder="Nom" value="{{ $patient->f_name }}">
                            @error('f_name')
                                <span class="invalid-feedback" role="alert">
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Prénom</label>
                            <input name="l_name" type="text" class="form-control @error('l_name')  is-invalid @enderror"
                                placeholder="Prénom" value="{{ $patient->l_name }}">
                            @error('l_name')
                                <span class="invalid-feedback" role="alert"></span>

                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Sexe</label>

                            <div class="custom-control custom-radio">
                                <input name="gender" value="1"  class="custom-control-input custom-control-input-info "
                                    type="radio" id="customRadio4" name="customRadio2" {{
                                    $patient->gender===1 ? 'checked' : ''
                                    }}>
                                <label for="customRadio4" class="custom-control-label">Homme</label>
                                
                            </div>
                            <div class="custom-control custom-radio">
                                <input name="gender" value="2" 
                                    class="custom-control-input custom-control-input-info custom-control-input-outline"
                                    type="radio" id="customRadio5" name="customRadio2"  {{
                                        $patient->gender===2 ? 'checked' : ''
                                        }}>
                                <label for="customRadio5" class="custom-control-label">Femme </label>

                            </div>
                        </div>
                </div>
                <div class="col-md-3">
                    <!-- Date dd/mm/yyyy -->
                    <div class="form-group">
                        <label>Date de naissance</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input name="birthday" type="text" class="form-control @error('birthday')  is-invalid @enderror"
                                data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy"
                                placeholder="jj-mm-aaaa" data-mask value="{{ $birthday }}">
                            @error('birthday')
                                <span class="invalid-feedback" role="alert"></span>

                            @enderror
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>Groupe sanguin</label>
                        <select name="group_sang" class="form-control select2 @error('group_sang')  is-invalid @enderror"
                            style="width: 100%;">
                            <option value="O+"{{$patient->group_sang=='O+' ? 'selected' : ''}}>O+</option>
                            <option value="O-"{{$patient->group_sang=='O-' ? 'selected' : ''}}>O-</option>
                            <option value="B+"{{$patient->group_sang=='B+' ? 'selected' : ''}}>B+</option>
                            <option value="B-"{{$patient->group_sang=='B-' ? 'selected' : ''}}>B-</option>
                            <option value="A+"{{$patient->group_sang=='A+' ? 'selected' : ''}}>A+</option>
                            <option value="A-"{{$patient->group_sang=='A-' ? 'selected' : ''}}>A-</option>
                            <option value="AB+"{{$patient->group_sang=='AB+' ? 'selected' : ''}}>AB+</option>
                            <option value="AB-"{{$patient->group_sang=='AB-' ? 'selected' : ''}}>AB-</option>


                        </select>

                    </div>
                    @error('group_sang')
                        <span class="invalid-feedback" role="alert"></span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input name="phone" type="text" class="form-control @error('phone')  is-invalid @enderror"
                            placeholder="Téléphone" value="{{ $patient->phone }} " data-inputmask="&quot;mask&quot;: &quot;9999999999&quot;" data-mask="" im-insert="true">
                        @error('phone')
                            <span class="invalid-feedback" role="alert"></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Wilaya</label>
                        <select name="wilaya" class="form-control select2" style="width: 100%;">
                            @foreach ($wilaya as $item)
                                <option value="{{ $item->id }}" {{$item->id==$patient->wilaya ? 'selected' : ''}}>{{ $item->lib_wilaya }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Adresse</label>
                        <input type="text" class="form-control" placeholder="Adresse" name="adresse" value="{{ $patient->adresse }}">
                    </div>
                    <div class="form-group">
                        <label>Code archive</label>
                        <input name="code_archive" type="text"
                            class="form-control @error('code_archive')  is-invalid @enderror" placeholder="Code archive"
                            value="{{ $patient->code_archive }}">
                        @error('code_archive')
                            <span class="invalid-feedback" role="alert"></span>

                        @enderror
                    </div>
                </div>


            </div>
        </div>

    </div>
    <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Modifier</button>

    </form>

@endsection
@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endsection

@section('script')

    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script>
        $(function() {

            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            $(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
  });
            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('yyyy-mm-dd', {
                'placeholder': 'yyyy-mm-dd'
            })
            //Money Euro
            $('[data-mask]').inputmask()


        })

    </script>

@endsection
