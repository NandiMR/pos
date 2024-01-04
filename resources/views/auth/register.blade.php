@extends('layouts.app')
@section('title', 'Register Page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="login-box">
            <div class="login-logo">
                <h3><b>Toko </b>Kebutuhan</h3>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Silahkan Register</p>

                    <form action="#" id="form">

                        <div class="input-group pb-3">
                            <input id="nama" type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus placeholder="Nama">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group pb-3">
                            <input id="username" type="text" class="form-control" name="username" id="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group pb-3">
                            <input id="email" type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group pb-3">
                            <input id="password" type="password" class="form-control" name="password" id="password" autocomplete="new-password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group pb-3">
                            <input id="password-confirm" type="password" class="form-control" name="password-confirm" id="password-confirm" autocomplete="new-password" placeholder="Konfirmasi Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary btn-block" onclick="register()">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function register(){
        const nama = $('#nama').val();
        const username = $('#username').val();
        const email = $('#email').val();
        const password = $('#password').val();
        const password_confirm = $('#password-confirm').val();

        if (nama.length == '') {
            swal({
                title: 'Nama wajib isi',
                type: 'error',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            });
        } else if (username.length == '') {
            swal({
                title: 'Username wajib isi',
                type: 'error',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            });
        } else if (email.length == '') {
            swal({
                title: 'Email wajib isi',
                type: 'error',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            });
        } else if (IsEmail(email) == false) {
            swal({
                title: 'Format email salah',
                type: 'error',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            });
        } else if (password.length == '') {
            swal({
                title: 'Password wajib isi',
                type: 'error',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            });
        } else if (password_confirm.length == '') {
            swal({
                title: 'Konfirmasi password wajib isi',
                type: 'error',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            });
        } else if (password != password_confirm) {
            swal({
                title: 'Password tidak sama',
                type: 'error',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            });
        } else {
            $.ajax({
                url : "{{ route('register') }}",
                type : "POST",
                data : $('#form').serialize(),
                success : function(data){
                    if (data == "success") {
                        swal({
                            title: 'Berhasil',
                            type: 'success',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                        }).then(function(){
                            window.location.href = "{{ url('login') }}"
                        });
                    }
                }
            })
        }
    }

    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
            return false;
        } else{
            return true;
        }
    }
</script>
@endsection
