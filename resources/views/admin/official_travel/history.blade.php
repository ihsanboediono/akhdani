{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'History Pengajuan Perjalanan Dinas')

@section('content')

<body>
    

	<div class="main-panel">
		<div class="content">
			<div class="panel-header bg-primary-gradient">
				<div class="page-inner py-5">
					<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
						<div>
							<h2 class="text-white pb-2 fw-bold">History Pengajuan Perjalanan Dinas </h2>
							<h5 class="text-white op-7 mb-2">Kelola History Pengajuan Perjalanan Dinas yang disediakan disini.</h5>
						</div>
						<div class="ml-md-auto py-2 py-md-0">
							@if (auth()->user()->role != 'root')
								<a href="{{ route('admin.perdin.add') }}" class="btn btn-secondary btn-round"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Tambah Perjalanan</a>
							@endif
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
												<th width="16%">Nama</th>
												<th width="16%">Kota</th>
												<th width="25%">Tanggal</th>
												<th>Keterangan</th>
												<th width="10%">status</th>
												<th width="10%">Aksi</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>No</th>
												<th>Nama</th>
												<th>Kota</th>
												<th>Tanggal</th>
												<th>Keterangan</th>
												<th>Status</th>
												<th>Aksi</th>
											</tr>
										</tfoot>
										<tbody>
											
											
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
					{{ date("Y") }}, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.linkedin.com/in/ihsan-boediono/">Ihsan Budiono</a>
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
				url : '{!! route('admin.perdin.history.data') !!}',
				type : 'POST',
				data: {_token:_token},
			},
			columns: [
				{ data: 'id',
					render: function (data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					} 
				},
				{ data: 'user.name' },
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
							return '<span class="btn btn-success" >Approved</span>';
						} else if (data == "rejected") {
							return '<span class="btn btn-danger" >Rejected</span>';
						} 
								
					}
				},
				{
					data: 'id',
					render: function(data, type, row){
						var url_edit = "{{ \Request::url().'/' }}"+data;
						return '\
						<a href="'+url_edit+'" class="btn btn-xs btn-primary my-1">Detail</a>';
					}
				},
	
			]
		});
	} );
</script>
@include('admin.layouts.swal')
@endsection
