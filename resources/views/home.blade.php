@extends('../template')
@section('title', 'Home')

@section('content')
<section class="content pt-2">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-4 col-6">
				<div class="small-box bg-info">
					<div class="inner">
						<h3>{{ $produk }}</h3>

						<p>Produk</p>
					</div>
					<div class="icon">
						<i class="fas fa-box"></i>
					</div>
					<a href="{{ url('produk') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-4 col-6">
				<div class="small-box bg-success">
					<div class="inner">
						<h3>{{ $pemasok }}</h3>

						<p>Pemasok</p>
					</div>
					<div class="icon">
						<i class="fas fa-truck"></i>
					</div>
					<a href="{{ url('pemasok') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<div class="col-lg-4 col-6">
				<div class="small-box bg-warning">
					<div class="inner">
						<h3>{{ $pelanggan }}</h3>

						<p>Pelanggan</p>
					</div>
					<div class="icon">
						<i class="fas fa-users"></i>
					</div>
					<a href="{{ url('pelanggan') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-6">
				<div class="info-box">
					<span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill-wave"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Pendapatan Hari Ini</span>
						<span class="info-box-number">Rp. {{ number_format($pendapat_hari) }}</span>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-6">
				<div class="info-box">
					<span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-bill-wave"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Pendapatan Bulan Ini</span>
						<span class="info-box-number">Rp. {{ number_format($pendapat_bulan) }}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Transaksi Terbaru</h3>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-stripped" id="table">
							<thead>
								<tr>
									<th>No</th>
									<th>No Penjualan</th>
									<th>Nama</th>
									<th>Subtotal</th>
									<th>Tanggal</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
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
		$('#table').DataTable({
			processing : true,
			serverside : true,
			ajax : "{{ url('home/tampil') }}",
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
			url: "{{ url('penjualan/get-laporan') }}"+"/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data){
				$('[name="id"]').val(data.no_penjualan);
			}
		})

		$.ajax({
			url: "{{ url('penjualan/detail') }}"+"/"+id,
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
			url: "{{ url('penjualan/get-laporan') }}"+"/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data){
              window.open("{{ url('penjualan/cetak') }}"+"/"+ data.no_penjualan, '_blank')
			}
		})
	}
</script>

@endsection
