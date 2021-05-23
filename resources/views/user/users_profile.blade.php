@extends('layouts.dashboard')
@section('full_name', 'CHIBANE Mourad')
@section('page_title', 'Profil')
@section('page_name', 'Mon Profil')
@section('content')
 {{-- alert message from session --}}
 @if ($message = Session::get('success'))
 <div class="alert alert-success alert-dismissible">
     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
     <h5><i class="icon fas fa-check"></i> Création réussie</h5>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
           <div class="card">
               <div class="card-body">

                        <form action="{{ route('doc.profile.update',$user->id) }}"  method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Identifiat</label>
                                <input name="user" type="text" class="form-control @error('user')  is-invalid @enderror"
                                    placeholder="user"  value="{{ $user->username }}" disabled>

                                    <span class="text-warning" role="alert">
                                       &nbsp; <small> Votre identifiant ne peut pas être changer</small>
                                    </span>

                            </div>
                            <div class="form-group">
                                <label>Nom et Prénom</label>
                                <input name="name" type="text" class="form-control @error('name')  is-invalid @enderror"
                                    placeholder="Nom" value="{{ $user->name }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    </span>
                                @enderror
                            </div>
                            <!-- Date dd/mm/yyyy -->
                    <div class="form-group">
                        <label>Date de naissance</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <input name="birthday" type="text" class="form-control @error('birthday')  is-invalid @enderror"
                                data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy"
                                placeholder="jj-mm-aaaa" data-mask value="{{ $user->birthday }}">
                            @error('birthday')
                                <span class="invalid-feedback" role="alert"></span>

                            @enderror
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control @error('email')  is-invalid @enderror"
                            placeholder="email" value="{{ $user->email }}" >
                        @error('email')
                            <span class="invalid-feedback" role="alert"></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nouveau mot de passe</label>
                        <input name="password" type="password" class="form-control @error('password')  is-invalid @enderror"
                             value="{{ old('password') }}" >
                        @error('password')
                            <span class="invalid-feedback" role="alert"></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirmation de mot de passe</label>
                        <input name="passwordconf" type="password" class="form-control @error('passwordconf')  is-invalid @enderror"
                         value="{{ old('passwordconf') }}" >
                        @error('passwordconf')
                            <span class="invalid-feedback" role="alert"></span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Enregistrer</button>

                        </form>
                    </div>
                </div>

               </div>
           </div>


    </div><!-- /.container-fluid -->

@endsection





@section('style')



@endsection

@section('script')

<!-- InputMask -->
<script src="{{ asset('/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<script>
    $(function() {


        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('yyyy-mm-dd', {
            'placeholder': 'yyyy-mm-dd'
        })
        //Money Euro
        $('[data-mask]').inputmask()


    })

</script>
@endsection
