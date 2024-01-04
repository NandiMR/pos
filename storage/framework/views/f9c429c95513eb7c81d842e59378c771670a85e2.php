
<?php $__env->startSection('title', 'Produk'); ?>

<?php $__env->startSection('content'); ?>

<section class="content pt-2">
	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<h3 class="card-title"> <?php echo $__env->yieldContent('title'); ?> </h3>
					<div class="float-right">
						<a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="tambah()">Tambah</a>
						<a href="javascript:void(0)" class="btn btn-default btn-sm" onclick="reload()">Reload</a>
					</div>
				</div>
				<div class="card-body table-responsive">

					<table class="table table-bordered table-stripped table-hover" id="table">
						<thead>
							<tr>
								<th width="5%">No</th>
								<th>Kode</th>
								<th>Produk</th>
								<th>Unit</th>
								<th>Harga Jual</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>

					</table>

				</div>
			</div>

		</div>
	</div>
</section>

<div class="modal fade" id="modal-form" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body form">
				<form id="form" action="#" class="form-horizontal">
					<input type="hidden" value="" name="id">

					<div class="form-group row">
						<label class="col-lg-3">Kode</label>
						<div class="col-lg-9">
							<input type="text" name="kode" class="form-control">
							<div class="help-block text-danger"></div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3">Nama</label>
						<div class="col-lg-9">
							<input type="text" name="nama" class="form-control">
							<div class="help-block text-danger"></div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3">Unit</label>
						<div class="col-lg-9">
							<select class="form-control" name="unit">
								<option value="">- Pilih -</option>
								<?php $__currentLoopData = $unit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($u->id); ?>"><?php echo e($u->nama_unit); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							<div class="help-block text-danger"></div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3">Harga Beli</label>
						<div class="col-lg-9">
							<input type="number" name="harga_beli" class="form-control">
							<div class="help-block text-danger"></div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3">Harga Jual</label>
						<div class="col-lg-9">
							<input type="number" name="harga_jual" class="form-control">
							<div class="help-block text-danger"></div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3">Stok</label>
						<div class="col-lg-9">
							<input type="number" name="stok" class="form-control" readonly>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		table = $('#table').DataTable({
			processing : true,
			serverside : true,
			ajax : "<?php echo e(route('produk.index')); ?>",
			columns: [
			{data: 'DT_RowIndex', name:'DT_RowIndex'},
			{data: 'kode_produk', name:'kode_produk'},
			{data: 'nama_produk', name:'nama_produk'},
			{data: 'unit', name:'unit'},
			{data: 'harga', name:'harga'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			],
			order: [[0, 'asc']]
		});
	})

	function tambah(){
		$('#id').val('');
		$('#form').trigger("reset");
		$('.help-block').empty();
		$('.modal-title').html("Tambah Produk");
		$('#modal-form').modal('show');
	}

	function reload(){
		table.ajax.reload(null,false);
	}

	function get(id){
		$.ajax({
			url : "<?php echo e(route('produk.index')); ?>"+"/"+id+"/edit",
			type: "GET",
			dataType: "JSON",
			success: function(data){

				$('[name="id"]').val(data.id);
				$('[name="kode"]').val(data.kode_produk);
				$('[name="nama"]').val(data.nama_produk);
				$('[name="unit"]').val(data.id_unit);
				$('[name="harga_beli"]').val(data.harga_produk_beli);
				$('[name="harga_jual"]').val(data.harga_produk_jual);
				$('[name="stok"]').val(data.stok_produk);
				$('#modal-form').modal('show');
				$('.modal-title').text('Edit Produk');
				$('.help-block').empty();

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
	}

	function simpan(){
		$.ajax({
			url: "<?php echo e(route('produk.store')); ?>",
			data: $('#form').serialize(),
			type: "POST",
			dataType: 'json',
			success: function (data) {

				if (data.status == true) {
					$('#form').trigger("reset");
					$('#modal-form').modal('hide');
					swal({
						title: 'Berhasil',
						type: 'success',
						allowOutsideClick: false,
						allowEscapeKey: false,
						allowEnterKey: false,
					}).then(function(){
						reload();
					});
				} else {
					for (var i = 0; i < data.inputerror.length; i++){
						$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
						$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
					}
				}
				
			},
			error: function (jqXHR, textStatus, errorThrown) {
				swal({
					title: 'Terjadi kesalahan',
					type: 'error',
					allowOutsideClick: false,
					allowEscapeKey: false,
					allowEnterKey: false,
				});
			}
		});
	}

	function del(id){
		swal({
			title: 'Apakah kamu yakin?',
			type: 'warning',
			showCancelButton: true,
			allowOutsideClick: false,
			allowEscapeKey: false,
			allowEnterKey: false,
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak',
			buttons: true
		}).then(function(){
			$.ajax({
				url: "/produk/"+id,
				type: "delete",
				success: function (data) {
					swal({
						title: 'Berhasil',
						type: 'success',
						allowOutsideClick: false,
						allowEscapeKey: false,
						allowEnterKey: false,
					}).then(function(){
						reload();
					});
				},
				error: function (data) {
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
				})
			}
		});

	}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('../template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Hp\Desktop\pos\resources\views/produk/data/index.blade.php ENDPATH**/ ?>