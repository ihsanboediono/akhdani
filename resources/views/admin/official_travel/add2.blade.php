{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Tambah layanan')

@section('content')

        <div class="main-panel">
			<div class="content">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white pb-2 fw-bold"></h2>
                                <h5 class="text-white op-7 mb-2"></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row">
						<div class="col-md-8">
							<div class="card">
                                <div class="card-header card-info">
                                    <div class="card-title">Form Tambah Kota Baru</div>
                                </div>
								<div class="card-body">
                                <form action="{{ route('admin.kota.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="provinsi">Provinsi</label>
                                            <select name="provinsi" id="provinsi" class="form-control" >
                                                <option value="">- Pilih Provinsi -</option>
                                                @foreach ($provincies as $province)
                                                    <option value="{{ $province->id }}" @selected( old('provinsi') == $province->id )>{{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('provinsi') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="nama_kota">Nama Kota</label>
                                            <select name="nama_kota" id="nama_kota" class="form-control" >
                                                <option value="">- Silahkan Pilih Provinsi -</option>
                                            </select>
                                            @error('nama_kota') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <label for="pulau">Pulau</label>
                                            <input type="text" class="form-control" id="pulau" name="pulau" placeholder="Pulau" value="{{ old('pulau') }}">
                                            @error('pulau') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="luar_negeri">Luar Negeri</label>
                                            <select name="luar_negeri" id="luar_negeri" class="form-control">
                                                <option value="">- Pilih Opsi -</option>
                                                <option value="1">Ya</option>
                                                <option value="0">Tidak</option>
                                            </select>
                                            @error('luar_negeri') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="latitude">Latitude</label>
                                            <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude" value="{{ old('latitude') }}">
                                            @error('latitude') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="longitude">Longitude</label>
                                            <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude" value="{{ old('longitude') }}">
                                            @error('longitude') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    
                                    <button class="btn btn-primary btn-rounded">Tambah Kota </button>
                                    <a href="{{ route('admin.kota.index') }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
                                </form>
								</div>
							</div>
						</div>
                        <div class="col-md-4">
							<div class="card">
                                <div class="card-header card-info">
                                    <div class="card-title">Bantuan Mendapatkan Latitude dan Langitude</div>
                                </div>
								<div class="card-body">
									<div class="card-list">
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

        $("#provinsi").on('change', function(e) {
            console.log($(this).val());
            var id = $(this).val();
            var kota = $('#nama_kota');
            kota.empty();
            fetch('{{ route('admin.kota.index') }}/kota/'+id)
                .then(response => response.json())
                .then(data => {
                    // console.log(data);
                    var kota = data.data
                    $('#nama_kota').append('<option value="">- Pilih Kota -</option>')
                    $.each( kota, function( key, value ) {
                        $('#nama_kota').append('<option value="'+value.name+'">'+value.name+'</option>')
                        // console.log(value);
                    });
                })
            
        })

        $("#nama_kota").on('change', function(e) {
            console.log($(this).val());
            var id = $(this).val();
            var latlang = $('.card-list');
            fetch('{{ route('admin.kota.index') }}/search/'+id)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    var lat = data.data.results;
                    latlang.empty();
                    $.each( lat, function( key, value ) {
                        $('.card-list')
                        .append('<div class="item-list">\
                            <div class="info-user ml-3 mr-3">\
                                <div >'+value.displayName+'</div>\
                                <div >'+value.coordinate+'</div>\
                            </div>\
                            <button class="btn btn-icon btn-primary btn-round btn-xs"  onclick="langlat(\''+value.lat+'\',\''+value.lng+'\')">\
                                <i class="fa fa-plus"></i>\
                            </button>\
                            <hr>\
                        </div>');
                    });
                })
            
        })

        function langlat(lat,lang) {
            $("#latitude").val(lat)
            $("#longitude").val(lang)
        }
        
    </script>
@endsection
