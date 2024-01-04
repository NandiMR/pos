
<?php $__env->startSection('title', 'Profil'); ?>

<?php $__env->startSection('content'); ?>

<section class="content pt-2">
	<div class="row">

		<div class="col-md-3">
			<div class="card card-primary card-outline">
				<div class="card-body box-profile">
					<div class="text-center">
						<img class="profile-user-img img-fluid img-circle"
						src="<?php echo e(asset('uploads')); ?>/<?php echo e($user->foto); ?>"
						alt="User profile picture">
					</div>

					<h3 class="profile-username text-center"><?php echo e($user->name); ?></h3>

				</div>
			</div>
		</div>

		<div class="col-md-9">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title"><?php echo $__env->yieldContent('title'); ?></h3>
				</div>
				<div class="card-body">
					<form action="#" enctype="multipart/form-data" id="form" class="form-horizontal">
						<div class="form-group row">
							<label for="username" class="col-sm-2 col-form-label">Username</label>
							<div class="col-sm-10">
								<input type="text" name="username" class="form-control" readonly="" value="<?php echo e($user->username); ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="nama_user" class="col-sm-2 col-form-label">Nama</label>
							<div class="col-sm-10">
								<input type="text" name="nama_user" id="nama_user" class="form-control" value="<?php echo e($user->name); ?>">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group row">
							<label for="email_user" class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-10">
								<input type="text" name="email_user" id="email_user" class="form-control" value="<?php echo e($user->email); ?>">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group row">
							<label for="foto_baru" class="col-sm-2 col-form-label">Ganti Foto</label>
							<div class="col-sm-10">
								<input type="file" name="foto_baru" id="foto_baru" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-10 offset-sm-2">
								<button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>
</section>

<script type="text/javascript">
	function simpan(){
		swal({
			title: 'Simpan perubahan?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak',
			buttons: true,
			allowOutsideClick: false,
			allowEscapeKey: false,
			allowEnterKey: false,
		}).then(function () {
			$.ajax({
				url : "<?php echo e(url('user/simpan-profil')); ?>",
				type: "POST",
				data: new FormData($('#form')[0]),
				dataType: "JSON",
				async: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data){
					if(data.status){
						swal({
							title: 'Berhasil',
							type: 'success',
							allowOutsideClick: false,
							allowEscapeKey: false,
							allowEnterKey: false,
						})
						.then(function(){
							location.reload();
						})
					}else{
						for (var i = 0; i < data.inputerror.length; i++) {
							$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
							$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
						}
					}
				},
				error: function (jqXHR, textStatus, errorThrown){
					swal({
						title: 'Terjadi kesalahan',
						type: 'error',
						allowOutsideClick: false,
						allowEscapeKey: false,
						allowEnterKey: false,
					});

				}
			});

		}, function (dismiss) {
			if (dismiss === 'cancel') {
				swal({
					title: 'Batal',
					type: 'error',
					allowOutsideClick: false,
					allowEscapeKey: false,
					allowEnterKey: false,
				});
			}
		});
	}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('../template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Hp\Desktop\pos\resources\views/user/index.blade.php ENDPATH**/ ?>