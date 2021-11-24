@extends('layouts.dashboard')
@section('full_name', 'CHIBANE Mourad')
@section('page_title', 'Nouveau document')
@section('page_name', 'Nouveau document')
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
            <div class="col-md-12">
                <div class="card">
                    <h3 class="card-header">Ajouter un nouveau document
                    </h3>
                    <div class="card-body">
                        <form action="{{ route('doc.patients.storeRadio') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Sélectionner l'image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input name="img" type="file" class="custom-file-input"
                                                            id="exampleInputFile" required>
                                                        <label class="custom-file-label" for="exampleInputFile">Choisir le
                                                            fichier</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select name="typeradio" class="form-control select2 js-states"
                                                    style="width: 100%;">
                                                    @foreach ($type_radio as $item)
                                                        <option value="{{ $item->id }}" selected>
                                                            {{ $item->lib_radio }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input name="note" type="text"
                                                    class="form-control @error('note')  is-invalid @enderror"
                                                    placeholder="Description" value="{{ old('note') }}">
                                                @error('note')
                                                    <span class="invalid-feedback" role="alert">
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit"
                                                class="btn btn-block bg-gradient-success btn-lg">Enregistrer</button>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="image-preview" id="imgPreview">
                                        <img src="" alt="Image preview" class="image-preview__image">
                                        <span class="image-preview__default-text"> Aperçu de l'image</span>
                                    </div>
                                </div>
                            </div>


                        </form>



                    </div>
                </div>

            </div>

        </div>
    </div><!-- /.container-fluid -->
@endsection
@section('style')
    <style>
        .image-preview {
            width: 100%;
            min-height: 100%;
            border: 2px solid #dddddd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #cccccc;
            margin-top: 15px;
        }

        .image-preview__image {
            display: none;
            width: 100%;

        }

    </style>

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();

            //Initialize Select2 Elements
            $('.select2').select2({
                placeholder: "Select a state",
            })

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });



        })
    </script>
    <script>
        const file = document.getElementById("exampleInputFile");
        const imgcontainer = document.getElementById("imgPreview");
        const imgpreview = imgcontainer.querySelector(".image-preview__image");
        const text = imgcontainer.querySelector(".image-preview__default-text");


        file.addEventListener("change", function() {
            const f = this.files[0];

            if (f) {
                const reader = new FileReader();
                text.style.display = "none";
                imgpreview.style.display = "block";
                reader.addEventListener("load", function() {
                    imgpreview.setAttribute("src", this.result);
                });
                reader.readAsDataURL(f);
            } else {
                text.style.display = null;
                imgpreview.style.display = null;
                imgpreview.setAttribute("src", "");
            }

        });
    </script>

@endsection
