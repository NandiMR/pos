<?php $__env->startSection('title', 'Login Page'); ?>

<?php $__env->startSection('content'); ?>
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
                            <input id="username" type="text" class="form-control" name="username" id="username" value="<?php echo e(old('username')); ?>" required autocomplete="username" autofocus placeholder="Username">
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
                                    <?php echo e(__('Login')); ?>

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
                url : "<?php echo e(route('login')); ?>",
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
                            window.location.href = "<?php echo e(url('home')); ?>"
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pos\resources\views/auth/login.blade.php ENDPATH**/ ?>