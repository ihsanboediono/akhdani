{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Layanan')

@section('content')

<body>
    

	<div class="main-panel">
		<div class="content">
			<div class="panel-header bg-primary-gradient">
				<div class="page-inner py-5">
					<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
						<div>
							<h2 class="text-white pb-2 fw-bold">Perjalanan Dinas </h2>
							<h5 class="text-white op-7 mb-2">Kelola Perjalanan Dinas yang disediakan disini.</h5>
						</div>
						<div class="ml-md-auto py-2 py-md-0">
							<a href="{{ route('admin.perdin.add') }}" class="btn btn-secondary btn-round"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Tambah Perjalanan</a>
						</div>
					</div>
				</div>
			</div>
			<div class="page-inner mt--5">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="table-responsive">
									<table id="basic-datatables" class="display table table-striped table-hover" >
										<thead>
											<tr>
												<th width="5%">No</th>
												<th width="16%">Kota</th>
												<th width="25%">Tanggal</th>
												<th>Keterangan</th>
												<th width="10%">Status</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>No</th>
												<th>Kota</th>
												<th>Tanggal</th>
												<th>Keterangan</th>
												<th>Status</th>
											</tr>
										</tfoot>
										<tbody>
											{{-- <tr>
												<td>1</td>
												<td><img class="img-product" src="{{ asset('assets/img/examples/product8.jpg') }}" alt=""></td>
												<td>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</td>
												<td>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Pariatur amet voluptas excepturi veniam corporis deserunt quos nostrum non rem esse, dolore laudantium assumenda nisi cupiditate! Dolorem velit commodi fugiat quae.</td>
												<td>
													<a href="{{ route('edit-services') }}" class="btn btn-warning btn-sm m-1"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
													<button type="button" id="delete1" class="btn btn-danger btn-sm m-1"><i class="fas fa-trash mr-1"></i> Hapus</button>
												</td>
											</tr> --}}
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer class="footer">
			<div class="container-fluid">
				
				<div class="copyright ml-auto">
					{{ date("Y") }}, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.tupaitech.net">Tupai Tech</a>
				</div>				
			</div>
		</footer>
	</div>

@endsection


@section('js')
<script>
	var table;
	var title = 'Layanan';
	var columns = [0, 1, 3];
	$(document).ready( function () {
		var _token = "{{ csrf_token() }}";
		table =  $('#basic-datatables').DataTable({
			processing: true,
			serverSide: true,
			responsive: true,
			
			ajax: {
				url : '{!! route('pegawai.perdin.data') !!}',
				type : 'POST',
				data: {_token:_token},
			},
			columns: [
				{ data: 'id',
					render: function (data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					} 
				},
				{ 
					data: 'hometown',
					render: function(data, type, row){
						return data.name+'    <i class="fas fa-long-arrow-alt-right"></i>     '+ row.destination.name;
					}
				},
				{ 
					data: 'tanggal',
					render: function(data, type, row){ 
						return data.departure+'    <i class="fas fa-long-arrow-alt-right"></i>    '+ data.return +' ('+row.duration+' Hari)';
					}
				},
				{ data: 'description' },
				
				{ 
					data: 'status',
					render: function(data, type, row){
						
						if (data == "pending") {
							return '<span class="btn btn-warning" >Pending</span>';
						} else if (data == "approved") {
							return '<span class="btn btn-primary" >Approved</span>';
						} else if (data == "rejected") {
							return '<span class="btn btn-danger" >Approved</span>';
						} 
								
					}
				},
			]
		});
	} );
</script>
@include('admin.layouts.swal')
@endsection
