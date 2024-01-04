
<?php $__env->startSection('title', 'Pembelian'); ?>

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
								<th>Nama</th>
								<th>Jumlah</th>
								<th>Tanggal</th>
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
						<label class="col-lg-3">Kode Produk</label>
						<div class="col-lg-9">
							<select class="form-control" id="produk" name="produk">
								<option value=" ">- Pilih -</option>
								<?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($p->id); ?>"><?php echo e($p->kode_produk); ?> - <?php echo e($p->nama_produk); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							<div class="help-block text-danger"></div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3">Unit</label>
						<div class="col-lg-3">
							<input type="text" name="unit" id="unit" value="-" class="form-control" readonly>
						</div>
						<label class="col-lg-3">Stok</label>
						<div class="col-lg-3">
							<input type="text" name="stok" id="stok" value="-" class="form-control" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3">Pemasok</label>
						<div class="col-lg-9">
							<select class="form-control" name="pemasok">
								<option value="">- Pilih -</option>
								<?php $__currentLoopData = $pemasok; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($p->id); ?>"><?php echo e($p->nama_pemasok); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							<div class="help-block text-danger"></div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3">Jumlah</label>
						<div class="col-lg-9">
							<input type="number" min="1" value="1" name="jumlah" id="jumlah" class="form-control">
							<div class="help-block text-danger"></div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3">Harga Beli</label>
						<div class="col-lg-9">
							<input type="text" name="harga" id="harga" class="form-control" value="-" readonly>
							<div class="help-block text-danger"></div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3">Subtotal</label>
						<div class="col-lg-9">
							<input type="text" name="subtotal" id="subtotal" class="form-control" readonly>
							<div class="help-block text-danger"></div>
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

<div class="modal fade" id="modal-detail" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-stripped">
					<tbody>
						<tr>
							<th>Kode</th>
							<td><span id="kode"></span></td>
						</tr>
						<tr>
							<th>Nama</th>
							<td><span id="produk_detail"></span></td>
						</tr>
						<tr>
							<th>Pemasok</th>
							<td><span id="pemasok"></span></td>
						</tr>
						<tr>
							<th>Jumlah</th>
							<td><span id="jumlah"></span></td>
						</tr>
						<tr>
							<th>Harga Beli</th>
							<td><span id="harga"></span></td>
						</tr>
						<tr>
							<th>Subtotal</th>
							<td><span id="subtotal"></span></td>
						</tr>
						<tr>
							<th>Tanggal</th>
							<td><span id="tanggal"></span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		table = $('#table').DataTable({
			processing : true,
			serverside : true,
			ajax : "<?php echo e(route('pembelian.index')); ?>",
			columns: [
			{data: 'DT_RowIndex', name:'DT_RowIndex'},
			{data: 'kode', name:'kode'},
			{data: 'nama', name:'nama'},
			{data: 'jumlah', name:'jumlah'},
			{data: 'tanggal', name:'tanggal'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			],
			order: [[0, 'asc']]
		});

		$('#produk').on('change', function(){
			var id = $('#produk').val();

			$.ajax({
				url: "<?php echo e(route('produk.index')); ?>"+"/"+id+"/edit",
				type: "GET",
				dataType: "JSON",
				success: function(data){
					if (id == " ") {
						$('#unit').val("-");
						$('#stok').val("-");
						$('#harga').val("-");
					} else {
						$('#unit').val(data.id_unit);
						$('#stok').val(data.stok_produk);
						$('#harga').val(data.harga_produk_beli);
					}
				}
			})
		})
	})

	$(document).on('keyup mouseup', '#harga', function(){
		hitung();
	});

	$(document).on('keyup mouseup', '#jumlah', function(){
		hitung();
	});

	function tambah(){
		$('#id').val('');
		$('#form').trigger("reset");
		$('.help-block').empty();
		$('.modal-title').html("Tambah Pembelian");
		$('#modal-form').modal('show');
	}

	function reload(){
		table.ajax.reload(null,false);
	}

	function get(id){
		$.ajax({
			url : "<?php echo e(route('pembelian.index')); ?>"+"/"+id+"/edit",
			type: "GET",
			dataType: "JSON",
			success: function(data){
				var date = new Date(data.created_at);

				$('[id="kode"]').text(data.kode_produk);
				$('[id="produk_detail"]').text(data.nama_produk);
				$('[id="pemasok"]').text(data.nama_pemasok);
				$('[id="jumlah"]').text(data.jumlah);
				$('[id="harga"]').text(rupiah(data.harga_satuan));
				$('[id="subtotal"]').text(rupiah(data.subtotal));
				$('[id="tanggal"]').text(date.toLocaleString('id-ID'));
				$('#modal-detail').modal('show');
				$('.modal-title').text('Detail Pembelian');
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
			url: "<?php echo e(route('pembelian.store')); ?>",
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

	function rupiah(number){
		return new Intl.NumberFormat("id-ID", {
			style: "currency",
			currency: "IDR"
		}).format(number);
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
				url: "/pembelian/"+id,
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

	function hitung(){
		var jumlah = $('#jumlah').val();
		var harga = $('#harga').val();
		var subtotal = jumlah * harga;

		harga != 0 ? $('#subtotal').val(subtotal) : $('#subtotal').val(0);

		if (jumlah == '') {
			$('#jumlah').val(1);
		}
	}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('../template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Hp\Desktop\pos\resources\views/transaksi/pembelian/index.blade.php ENDPATH**/ ?>