@extends('../template')
@section('title', 'Penjualan')

@section('content')

<section class="content pt-2">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body form">
					<div class="row">
						<div class="col-md-4">
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Infromasi Transaksi</h3>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<label class="col-lg-4">No Penjualan</label>
										<div class="col-lg-8">
											<input type="text" name="no_penjualan" value="{{ $no_penjualan }}" id="no_penjualan" readonly class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-4">Tanggal</label>
										<div class="col-lg-8">
											<input type="text" name="tanggal" class="form-control" value="{{ date('d-m-Y') }}" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-4">Kasir</label>
										<div class="col-lg-8">
											<input type="text" name="kasir" class="form-control" value="{{ Auth::user()->username }}" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Informasi Pelanggan</h3>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<label class="col-lg-4">Pelanggan</label>
										<div class="col-lg-8">
											<select class="form-control" name="pelanggan" id="pelanggan">
												<option value="">Umum</option>
												@foreach($pelanggan as $p)
												<option value="{{ $p->nama_pelanggan }}">{{ $p->nama_pelanggan }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-4">Telp/HP</label>
										<div class="col-lg-8">
											<input type="text" name="telp" id="telp" class="form-control" value="-" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-4">Alamat</label>
										<div class="col-lg-8">
											<input type="text" name="alamat" id="alamat" class="form-control" value="-" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Informasi Produk</h3>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<label class="col-lg-4">Kode Produk</label>
										<div class="col-lg-8">
											<div class="input-group">
												<input type="hidden" name="" id="id">
												<input type="text" class="form-control" id="produk" readonly>
												<span class="input-group-prepend">
													<button type="button" class="btn btn-info" onclick="produk()">
														<i class="fa fa-search"></i>
													</button>
												</span>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-4">Qty</label>
										<div class="col-lg-8">
											<input type="number" value="1" min="1" name="qty" id="qty" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<div class="col-lg-4"></div>
										<div class="col-lg-8">
											<button type="button" class="btn btn-primary" onclick="tambah()">Tambah</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12">
			<div class="card">
				<div class="card-body table-responsive">
					<table class="table table-bordered" id="table-keranjang">
						<thead>
							<tr>
								<th>#</th>
								<th>Kode</th>
								<th>Nama</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>Diskon</th>
								<th>Total</th>
								<th width="10%">Aksi</th>
							</tr>
						</thead>
						<tbody id="detail">
						</tbody>
					</table>
				</div>	
			</div>
		</div>

		<div class="col-12">
			<div class="card">
				<div class="card-body form">
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-lg-4">Total</label>
										<div class="col-lg-8">
											<input type="text" name="total" id="total" value="0" class="form-control" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-4">Diskon</label>
										<div class="col-lg-8">
											<input type="number" min="0" value="0" name="diskon" id="diskon" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-4">Subtotal</label>
										<div class="col-lg-8">
											<input type="text" name="subtotal" id="subtotal" class="form-control" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-lg-4">Uang</label>
										<div class="col-lg-8">
											<input type="number" name="uang" id="uang" min="0" value="0" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-4">Kembali</label>
										<div class="col-lg-8">
											<input type="text" name="kembali" id="kembali" class="form-control" readonly>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-lg-4"></div>
										<div class="col-lg-4">
											<button type="button" class="btn btn-warning" onclick="batal()">Batal</button>
										</div>
										<div class="col-lg-4">
											<button type="button" class="btn btn-primary" onclick="proses()">Proses</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="modal-produk">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-bordered table-striped" id="table-produk">
					<thead>
						<tr>
							<th>Kode</th>
							<th>Nama</th>
							<th>Unit</th>
							<th>Harga</th>
							<th>Stok</th>
							<th>Aksi</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title-edit"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form" class="form-horizontal">
					<input type="hidden" name="id_edit">

					<div class="form-group row">
						<label class="col-lg-3">Kode</label>
						<div class="col-lg-9">
							<input type="text" name="kode_edit" class="form-control" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3">Nama</label>
						<div class="col-lg-9">
							<input type="text" name="nama_edit" class="form-control" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3">Harga</label>
						<div class="col-lg-9">
							<input type="number" name="harga_edit" id="harga_edit" class="form-control" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3">Qty</label>
						<div class="col-lg-9">
							<input type="number" name="qty_edit" id="qty_edit" class="form-control">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3">Diskon</label>
						<div class="col-lg-9">
							<input type="number" name="diskon_edit" id="diskon_edit" class="form-control">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3">Total</label>
						<div class="col-lg-9">
							<input type="number" name="total_edit" id="total_edit" class="form-control" readonly>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer float-right">
				<button type="button" class="btn btn-primary" onclick="edit()">Simpan</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		
		table1 = $('#table-produk').DataTable({
			processing : true,
			serverside : true,
			ajax : "{{ url('penjualan/produk') }}",
			columns: [
			{data: 'kode_produk', name:'kode_produk'},
			{data: 'nama_produk', name:'nama_produk'},
			{data: 'unit', name:'unit'},
			{data: 'harga', name:'harga'},
			{data: 'stok_produk', name:'stok_produk'},
			{data: 'action', name: 'action', orderable: false, searchable: false},
			],
			order: [[0, 'asc']]
		});

		table = $('#table-keranjang').DataTable({
			searching : false,
			paging : false,
			showing : false,
			ordering : false,
			info : false,
		});

		$('#pelanggan').on('change', function(){
			var pelanggan = $('#pelanggan').val();

			$.ajax({
				url: "{{ url('penjualan/get-pelanggan') }}",
				type: "GET",
				dataType: "JSON",
				data: {pelanggan:pelanggan},
				success: function(data){
					if (pelanggan == "") {
						$('#telp').val("-");
						$('#alamat').val("-");
					} else {
						$('#telp').val(data.no_telp_pelanggan);
						$('#alamat').val(data.alamat_pelanggan);
					}
				}
			})
		})

		hitung();

		$('#qty_edit').on('keyup mouseup', function(){
			hitung();
		})

		$('#diskon_edit').on('keyup mouseup', function(){
			hitung();
		})

		$('#diskon').on('keyup mouseup', function(){
			hitung();
		})

		$('#uang').on('keyup mouseup', function(){
			hitung();
		})

		$('#detail').load("{{ url('penjualan/tampil-keranjang') }}", function(){
			hitung();
		});

	})


	function produk(){
		$('#modal-produk').modal('show');
		$('.modal-title').text('Daftar Produk');
	}

	function select(id){
		$.ajax({
			url: "{{ route('produk.index') }}"+"/"+id+"/edit",
			type: "GET",
			dataType: "JSON",
			success: function(data){
				$('#id').val(data.id);
				$('#produk').val(data.nama_produk);
				$('#modal-produk').modal('hide');
			}
		})
	}

	function tambah(){
		var id = $('#id').val();
		var qty = $('#qty').val();

		$.ajax({
			url: "{{ url('penjualan/keranjang') }}"+"/"+id,
			type: "POST",
			dataType: "JSON",
			data: {
				qty : qty
			},
			success: function(data){
				if (data.status == true) {
					$('#detail').load("{{ url('penjualan/tampil-keranjang') }}", function(){
						hitung();
					});
					$('#id').val('');
					$('#produk').val('');
					$('#qty').val('1');
					table1.ajax.reload(null,false);
				} else {
					swal({
						title: 'Stok Produk Kurang',
						type: 'error',
						allowOutsideClick: false,
						allowEscapeKey: false,
						allowEnterKey: false,
					}).then(function(){
						$('#id').val('');
						$('#produk').val('');
						$('#qty').val('1');
					});
				}
			}
		})
	}

	function get(id){
		$.ajax({
			url: "{{ url('penjualan/get-keranjang') }}"+"/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data){
				$('[name="id_edit"]').val(data.id);
				$('[name="kode_edit"]').val(data.kode_produk);
				$('[name="nama_edit"]').val(data.nama_produk);
				$('[name="harga_edit"]').val(data.harga);
				$('[name="qty_edit"]').val(data.qty);
				$('[name="diskon_edit"]').val(data.diskon);
				$('[name="total_edit"]').val(data.total);
				$('#modal-edit').modal('show');
				$('.modal-title-edit').text('Edit Produk');
			}
		})
	}

	function edit(){
		$.ajax({
			url: "{{ url('penjualan/edit-keranjang') }}",
			type: "POST",
			dataType: "JSON",
			data: $("#form").serialize(),
			success: function(data){
				if (data.status == true) {
					$('#modal-edit').modal('hide');
					$('#detail').load("{{ url('penjualan/tampil-keranjang') }}", function(){
						hitung();
					});
				} else {
					swal({
						title: 'Stok Produk Kurang',
						type: 'error',
						allowOutsideClick: false,
						allowEscapeKey: false,
						allowEnterKey: false,
					});
				}
			}
		})
	}

	function hitung(){
		var total = 0;

		$('#detail tr').each(function(){
			total += parseInt($(this).find('#total_keranjang').text())
		})

		isNaN(total) ? $('#total').val(0) : $('#total').val(total)

		var diskon = $('#diskon').val();
		var subtotal = total - diskon;

		if (isNaN(subtotal)) {
			$('#subtotal').val(0)
		} else {
			$('#subtotal').val(subtotal)
		}

		var uang = $('#uang').val();
		var kembali = uang - subtotal;

		uang != 0 ? $('#kembali').val(kembali) : $('#kembali').val(0)

		var harga_edit = $('#harga_edit').val();
		var qty_edit = $('#qty_edit').val();
		var diskon_edit = $('#diskon_edit').val();
		var total_seb_dis = harga_edit * qty_edit;
		var total_set_dis = (harga_edit - diskon_edit) * qty_edit;

		if (diskon_edit == '') {
			$('#total_edit').val(total_seb_dis);
		} else {
			$('#total_edit').val(total_set_dis);
		}
	}

	function del(id){
		$.ajax({
			url: "{{ url('penjualan/hapus') }}"+"/"+id,
			type: "DELETE",
			dataType: "JSON",
			success: function(data){
				if (data.status == true) {
					$('#detail').load("{{ url('penjualan/tampil-keranjang') }}", function(){
						hitung();
					});
					table1.ajax.reload(null,false);
				}
			}
		})
	}

	function proses(){
		var no_penjualan = $('#no_penjualan').val();
		var pelanggan = $('#pelanggan').val();
		var telp = $('#telp').val();
		var alamat = $('#alamat').val();
		var total = $('#total').val();
		var diskon = $('#diskon').val();
		var subtotal = $('#subtotal').val();
		var uang = $('#uang').val();
		var kembali = $('#kembali').val();

		if (total < 1) {
			swal({
				title: 'Produk kosong',
				type: 'error',
				allowOutsideClick: false,
				allowEscapeKey: false,
				allowEnterKey: false,
			})
		} else if (uang < 1) {
			swal({
				title: 'Input uang',
				type: 'error',
				allowOutsideClick: false,
				allowEscapeKey: false,
				allowEnterKey: false,
			})
		} else if (kembali < 0) {
			swal({
				title: 'Jumlah uang kurang',
				type: 'error',
				allowOutsideClick: false,
				allowEscapeKey: false,
				allowEnterKey: false,
			})
		} else {
			$.ajax({
				url: "{{ url('penjualan/proses') }}",
				type: "POST",
				dataType: "JSON",
				data: {
					no_penjualan: no_penjualan,
					pelanggan: pelanggan,
					telp: telp,
					alamat: alamat,
					total: total,
					diskon: diskon,
					subtotal: subtotal,
					uang: uang,
					kembali: kembali
				},
				success: function(data){
					if (data.status == true) {
						swal({
							title: 'Berhasil',
							type: 'success',
							allowOutsideClick: false,
							allowEscapeKey: false,
							allowEnterKey: false,
						}).then(function(){
							window.open("{{ url('penjualan/cetak') }}"+"/"+ data.no_penjualan, '_blank')
							location.reload();
						})
					}
				}
			})
		}
	}

	function batal(){
		$.ajax({
			url: "{{ url('penjualan/reset') }}",
			type: "POST",
			success: function(){
				location.reload();
			}
		})
	}
</script>

@endsection