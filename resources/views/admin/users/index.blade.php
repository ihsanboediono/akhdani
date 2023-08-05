{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Pengguna')

@section('content')

        <div class="main-panel">
			<div class="content">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white pb-2 fw-bold">Pengguna</h2>
                                <h5 class="text-white op-7 mb-2">Kelola informasi Pengguna.</h5>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                <a href="{{ route('admin.users.add') }}" class="btn btn-secondary btn-round"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Tambah Pengguna</a>
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
                                                    <th>No</th>
													<th>Nama</th>
													<th>Email</th>
													<th>Level</th>
													<th>Aktif</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>No</th>
													<th>Nama</th>
													<th>Email</th>
													<th>Level</th>
													<th>Aktif</th>
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
		var _token = "{{ csrf_token() }}";
		var title = 'Pengguna';
		var columns = [0, 1, 2, 3];
        $(document).ready(function() {
			table =  $('#basic-datatables').DataTable({
				processing: true,
				serverSide: true,
                responsive: true,
				
				ajax: {
					url : '{!! route('admin.users.data') !!}',
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
						data: 'name',
						render: function(data, type, row){
							return '<div class="text-capitalize">'+data+'</div>\
							<div >Username: '+row.username+'</div>';
						}
					},
					{ data: 'email' },
					{ 
						data: 'role',
						render: function(data, type, row){
							return '<div class="text-capitalize">'+data+'</div>';
						}
					},
					{
						data: 'id',
						render: function(data, type, row) {
							let url = "'" + "{!! url('users/dete/delete/') !!}" + data + "'";
							
							if(row.is_active == 1){
								// id,isactive
								return '\
								<a onclick="set_switch('+ data +','+ row.is_active +')" data-toggle="tooltip" title="Aktif">\
									<button type="button" class="btn btn-sm btn-success mt-1 mb-1"><i class="fas fa-toggle-on"></i> Aktif</button>\
								</a>';
							}else{
								return '\
								<a onclick="set_switch('+ data +','+ row.is_active +')" data-toggle="tooltip" title="Non Aktif">\
									<button type="button" class="btn btn-sm btn-black mt-1 mb-1"><i class="fas fa-toggle-off"></i> Non Aktif</button>\
								</a>'; 
								
							}
						}
					},
					{
						data: 'id',
						render: function(data, type, row){
							var url_edit = "{{url('/admin/users/edit')}}"+"/"+data;
							return '\
							<a href="'+url_edit+'" class="btn btn-xs btn-warning my-1">Edit</a>\
							<button class="btn btn-xs btn-danger my-1" id="delete" onclick="delete_data('+data+', \'users\')">Delete</button>';
						}
					},
				]
			});
			
		})
		// Switch Active
		function set_switch(id,isactive){
			$.ajax({
				type: 'POST',
				data: { 
					_token : _token,
					id: id,
					isactive: isactive,
				},
				url: '{!! route('admin.users.switch') !!}',
				dataType: 'JSON',
				success: function (data) {
					if (data.status == 'success') {
						table.ajax.reload(null, false);
						Swal.fire(
							'Success!',
							data.message,
							'success',
						)
					} else {
						table.ajax.reload(null, false);
						Swal.fire(
							'Oops...',
							data.message,
							'error',
						)
					}
				},
				error: function (ajaxContext) {
					Swal.fire(
						'Oops...',
						'The action you have requested is not allowed.',
						'error',
					)
				}
			});
		}
		
		</script>
		@include('admin.layouts.swal')
@endsection
