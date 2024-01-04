@extends('layouts.app')
@section('title', 'Login Page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="login-box">
            <div class="login-logo">
                <h3><b>Toko </b>Kebutuhan</h3>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Silahkan login</p>

                    <form action="#" id="form">

                        <div class="input-group pb-3">
                            <input id="username" type="text" class="form-control" name="username" id="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group pb-3">
                            <input id="password" type="password" class="form-control" name="password" id="password" autocomplete="current-password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary btn-block" onclick="login()">
                                    {{ __('Login') }}
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
    function login(){
        const username = $('#username').val();
        const password = $('#password').val();

        if (username.length == '') {
            swal({
                title: 'Username wajib isi',
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
        } else {
            $.ajax({
                url : "{{ route('login') }}",
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
                            window.location.href = "{{ url('home') }}"
                        });
                    } else {
                        swal({
                            title: 'Username atau Password salah',
                            type: 'error',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                        });
                    }
                }
            })
        }
    }
</script>
@endsection
