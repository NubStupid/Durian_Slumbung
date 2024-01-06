@extends('template.customerTemplate')
@section('title')
    <title>Profile</title>
    @php
        $title = "Profile";
    @endphp
@endsection

@push('style')
<style>
    .preview {
        text-align: center;
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }
    input{
        margin-top:40px;
    }
    .section{
        margin-top:150px;
        background:#fff;
        padding:50px 30px;
    }
    .modal-lg{
        max-width: 1000px !important;
    }
</style>
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
</head>
@endpush
@section('content')

<div class="row mt-3 mb-5 mx-5">
    <h3 class="text-center">
        Profile
    </h3>
    <div class="col-1"></div>
    <div class="col-3">
        <div class="shadow p-3 mb-5 mt-5 me-2 bg-body-tertiary rounded">
            @isset(Auth::user()->img_url)
                <img class="img-fluid pb-2" src={{ Auth::user()->img_url}} alt="Profile Picture">
            @else
                <img class="img-fluid pb-2" src="https://t4.ftcdn.net/jpg/04/38/19/57/360_F_438195737_KifWlRKIKOYEwrbEXwUwLnVQoIeQM1iW.jpg" alt="Profile Picture">
            @endisset
            <form action="{{ route('update.gambar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label class="btn btn-outline-success w-100 fw-bold" for="image">
                    <input type="file" name="image" class="image" placeholder="Ganti Gambar!" accept=".jpeg,.jpg,.png">
                </label>
                <input type="hidden" name="image_base64">
                <button class="btn btn-success w-100 text-center mt-2">Ubah</button>
            </form>
        </div>
    </div>
    <div class="col-7">
        <div class="row mt-5">
            <div class="col-3 my-3">
                <h5 class="pt-1 pb-3">Username</h5>
                <h5 class="pb-1 pt-1">Nomor Telepon</h5>
            </div>
            <div class="col-9">
                <h5 class="my-3">{{ Auth::user()->username}} <button class="btn btn-link text-decoration-none" style="color: green;" data-bs-toggle="modal" data-bs-target="#updateUsername">Ubah</button></h5>
                @isset(Auth::user()->telp)
                <h5 class="my-3">{{ Auth::user()->telp}} <button class="btn btn-link text-decoration-none" style="color: green;" data-bs-toggle="modal" data-bs-target="#updateNoTelp">Ubah</button></h5>
                @else
                <h5><button class="btn btn-link text-decoration-none" style="color: green;" data-bs-toggle="modal" data-bs-target="#updateNoTelp">Tambahkan!</button></h5>
                @endisset
            </div>
        </div>
        <button class="btn btn-outline-success fw-bold px-5 mt-2" data-bs-toggle="modal" data-bs-target="#updatePassword">Ganti Password</button>
    </div>
    <div class="col-1"></div>
</div>

    {{-- Modal Username --}}
    <div class="modal fade" id="updateUsername" tabindex="-1" role="dialog" aria-labelledby="updateUsernameLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Ganti Username</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update.username') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="newUsername">New Username</label>
                            <input type="text" class="form-control" id="tempuser" name="tempuser">
                        </div>

                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" id="passuser" name="passuser">
                        </div>
                        <button type="submit" class="btn btn-primary my-2">Update Username</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal NoTelepon --}}
    <div class="modal fade" id="updateNoTelp" tabindex="-1" role="dialog" aria-labelledby="updateTelephoneLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Ganti Nomor Telepon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update.notelp') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="newTelephone">Nomor Telepon Baru</label>
                            <input type="text" class="form-control" id="temptelp" name="temptelp">
                        </div>
                        <div class="form-group">
                            <label for="passconfirm">Confirm Password</label>
                            <input type="password" class="form-control" id="passtelp" name="passtelp">
                        </div>
                        <button type="submit" class="btn btn-primary my-2">Update Telephone</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Update Password -->
    <div class="modal fade" id="updatePassword" tabindex="-1" role="dialog" aria-labelledby="updatePasswordLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Ganti Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update.password') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="passlama">Password Lama</label>
                            <input type="password" class="form-control" id="passlama" name="passlama">
                        </div>
                        <div class="form-group">
                            <label for="passbaru">Password Baru</label>
                            <input type="password" class="form-control" id="passbaru" name="passbaru">
                        </div>
                        <div class="form-group">
                            <label for="passconfirm">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="passconfirm" name="passconfirm">
                        </div>
                        <button type="submit" class="btn btn-primary my-2">Update Telephone</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(session('error')||session('successpass')||session('successgambar')||session('successemail')||session('successtelp')||session('successpassword'))
    <div class="modal fade" id="HasilUpdate" tabindex="-1" aria-labelledby="HasilUpdate" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body text-center">
                @if(session('error'))
                    <img src="{{asset('assets/misc/gagaladdtocart.gif')}}" class="my-2" alt="" width="150vw" height="max-content">
                    <h5 class="py-2">{{ session('error') }}</h5>
                @elseif(session('successpass'))
                    <img src="{{asset('assets/misc/berhasileditfoto.gif')}}" class="my-4" alt="" width="70vw" height="max-content">
                    <h5 class="py-2">Berhasil Mengupdate Profile Picture!</h5>
                @elseif(session('successgambar'))
                    <img src="{{asset('assets/misc/berhasileditfoto.gif')}}" class="my-4" alt="" width="70vw" height="max-content">
                    <h5 class="py-2">Berhasil Mengupdate Profile Picture!</h5>
                @elseif(session('successemail'))
                    <img src="{{asset('assets/misc/berhasileditusername.gif')}}" class="my-4" alt="" width="70vw" height="max-content">
                    <h5 class="py-2">Berhasil Mengupdate Username!</h5>
                @elseif(session('successtelp'))
                    <img src="{{asset('assets/misc/berhasileditnotelp.gif')}}" class="my-4" alt="" width="70vw" height="max-content">
                    <h5 class="py-2">Berhasil Mengupdate Nomor Telepon!</h5>
                @elseif(session('successpassword'))
                    <img src="{{asset('assets/misc/berhasileditnotelp.gif')}}" class="my-4" alt="" width="70vw" height="max-content">
                    <h5 class="py-2">Berhasil Mengupdate Password!</h5>
                @endif
              <button type="button" class="btn btn-secondary mx-5 w-0" data-bs-dismiss="modal" aria-label="Close" id="okayButton">Oke!</button>
            </div>
          </div>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="modal fade" id="HasilUpdate" tabindex="-1" aria-labelledby="HasilUpdate" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body text-center">
                <img src="{{asset('assets/misc/gagaladdtocart.gif')}}" class="my-2" alt="" width="150vw" height="max-content">
                <h5 class="py-2">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
                </h5>
              <button type="button" class="btn btn-secondary mx-5 w-0" data-bs-dismiss="modal" aria-label="Close" id="okayButton">Oke!</button>
            </div>
          </div>
        </div>
    </div>
    @endif

    {{-- EXPERIMENTAL - Ganti Gambar pake Crop --}}
    {{-- <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 section text-center">
                <form action="{{ route('update.gambar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="btn btn-outline-success w-100 fw-bold" for="image">
                        <input type="file" name="image" class="image" placeholder="Ganti Gambar!" accept=".jpeg,.jpg,.png">
                    </label>
                    <input type="hidden" name="image_base64">
                    <button class="btn btn-success">Ubah</button>
                </form>
            </div>
        </div>
    </div> --}}
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749" style="max-height: 400px; max-width:max-content;">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Pilih</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Ganti Gambar tanpa crop --}}
    {{-- <div class="shadow p-3 mb-5 mt-5 me-2 bg-body-tertiary rounded">
        <img class="img-fluid pb-2" src={{ Auth::user()->img_url}} alt="Profile Picture">
        <form action="{{ route('update.gambar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="tempgambar" id="img" style="display:none;" accept=".jpeg,.jpg,.png" onchange="this.form.submit()" >
            <label class="btn btn-outline-success w-100 fw-bold" for="img">Ganti Gambar!</label>
        </form>
    </div> --}}
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#HasilUpdate').modal('show');

            $('#modal').on('hidden.bs.modal', function (e) {
                $('#image').val('');
            });
        });
        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;

        $("body").on("change", ".image", function(e){
            var files = e.target.files;
            var done = function (url) {
                $modal.modal('show');
                image.src = url;
            };

            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                reader.readAsDataURL(file);
                }
            }
        });

        $modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 2,
                autoCropArea: 0.5,
                preview: '.preview'
            });

        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function(){
            canvas = cropper.getCroppedCanvas({
                width: 300,
                height: 300,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $("input[name='image_base64']").val(base64data);
                    $(".show-image").show();
                    $(".show-image").attr("src",base64data);
                    $("#modal").modal('toggle');
                }
            });
        });
    </script>


@endpush
