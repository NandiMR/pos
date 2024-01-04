
<?php $__env->startSection('title', 'Password'); ?>

<?php $__env->startSection('content'); ?>

<section class="content pt-2">

	<div class="card">
		<div class="card-header">
			<h3 class="card-title"><?php echo $__env->yieldContent('title'); ?></h3>
		</div>
		<div class="card-body">
			<div class="col-md-6 offset-md-3">

				<form id="form" action="#">
					<div class="form-group">
						<label for="pass_lama">Password Lama</label>
						<input type="password" name="pass_lama" id="pass_lama" class="form-control">
						<span class="help-block text-danger"></span>
					</div>
					<div class="form-group">
						<label for="pass_baru">Password Baru</label>
						<input type="password" name="pass_baru" id="pass_baru" class="form-control">
						<span class="help-block text-danger"></span>
					</div>
					<div class="form-group">
						<label for="conf_pass">Konfirmasi Password</label>
						<input type="password" name="conf_pass" id="conf_pass" class="form-control">
						<span class="help-block text-danger"></span>
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-primary" id="btnSave" onclick="simpan()">Simpan</button>
					</div>
				</form>

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
				url : "<?php echo e(url('user/simpan-password')); ?>",
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
						}).then(function(){
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
<?php echo $__env->make('../template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Hp\Desktop\pos\resources\views/user/password.blade.php ENDPATH**/ ?>