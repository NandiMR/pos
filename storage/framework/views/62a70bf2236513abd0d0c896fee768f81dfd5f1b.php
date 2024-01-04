
<?php $__env->startSection('title', 'Laporan Penjualan'); ?>

<?php $__env->startSection('content'); ?>

<section class="content pt-2">
	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<h3 class="card-title"> <?php echo $__env->yieldContent('title'); ?> </h3>
				</div>
				<div class="card-body table-responsive">

					<table class="table table-bordered table-stripped table-hover" id="table">
						<thead>
							<tr>
								<th width="5%">No</th>
								<th>No Penjualan</th>
								<th>Nama</th>
								<th>Subtotal</th>
								<th>Tanggal</th>
								<th width="5%">Action</th>
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

<div class="modal fade" id="modal-detail" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"></h4>
				<input type="hidden" name="id" id="id">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="content-detail">

				</div>
			</div>
			<div class="modal-footer float-right">
				<button type="button" class="btn btn-primary btn-sm" onclick="cetak()">Cetak</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		table = $('#table').DataTable({
			processing : true,
			serverside : true,
			ajax : "<?php echo e(url('penjualan/laporan')); ?>",
			columns: [
			{data: 'DT_RowIndex', name:'DT_RowIndex'},
			{data: 'no_penjualan', name:'no_penjualan'},
			{data: 'pelanggan', name:'pelanggan'},
			{data: 'subtotal', name:'subtotal'},
			{data: 'tanggal', name:'tanggal'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			],
			order: [[0, 'asc']]
		});
	})

	function get(id){
		$.ajax({
			url: "<?php echo e(url('penjualan/get-laporan')); ?>"+"/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data){
				$('[name="id"]').val(data.no_penjualan);
			}
		})

		$.ajax({
			url: "<?php echo e(url('penjualan/detail')); ?>"+"/"+id,
			type: "POST",
			dataType: "html",
			cache: false,
			success: function(res){
				$('#content-detail').html(res);
			}
		})

		$('#modal-detail').modal('show')
		$('.modal-title').text('Detail')
	}

	function cetak(){
		var id = $('#id').val();

		$.ajax({
			url: "<?php echo e(url('penjualan/get-laporan')); ?>"+"/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data){
              window.open("<?php echo e(url('penjualan/cetak')); ?>"+"/"+ data.no_penjualan, '_blank')
			}
		})
	}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('../template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Hp\Desktop\pos\resources\views/transaksi/penjualan/laporan.blade.php ENDPATH**/ ?>