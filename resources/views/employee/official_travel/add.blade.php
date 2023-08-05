{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Tambah Perjalanan Dinas')

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
                                    <div class="card-title">Form Tambah Perjalanan Dinas Baru</div>
                                </div>
								<div class="card-body">
                                <form action="{{ route('pegawai.perdin.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row row-demo-grid">
                                        <div class="form-group col-lg-6">
                                            <label for="tanggal_berangkat">Tanggal Berangkat</label>
                                            <input type="date" class="form-control" id="tanggal_berangkat" name="tanggal_berangkat" placeholder="Tanggal Berangkat" value="{{ old('tanggal_berangkat') }}">
                                            @error('tanggal_berangkat') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <label for="tanggal_pulang">Tanggal Pulang</label>
                                            <input type="date" class="form-control" id="tanggal_pulang" name="tanggal_pulang" placeholder="Tanggal Pulang" value="{{ old('tanggal_pulang') }}">
                                            @error('tanggal_pulang') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <label for="kota_asal">Kota Asal</label>
                                            <select name="kota_asal" id="kota_asal" class="form-control">
                                                <option value="">- Pilih Kota Asal -</option>
                                                @foreach ($masters as $master)
                                                    <option value="{{ $master->id }}" @selected(old('kota_asal') == $master->id)>{{ $master->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('kota_asal') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="kota_tujuan">Kota Tujuan</label>
                                            <select name="kota_tujuan" id="kota_tujuan" class="form-control">
                                                <option value="">- Pilih Kota Tujuan -</option>
                                                @foreach ($masters as $master)
                                                    <option value="{{ $master->id }}" @selected(old('kota_tujuan') == $master->id)>{{ $master->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('kota_tujuan') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea class="form-control" name="keterangan" id="keterangan" rows="8">{{ old('keterangan') }}</textarea>
                                            @error('keterangan') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="card card-light  card-primary card-round col-md-6 mx-auto">
                                            <div class="card-body text-center">
                                                <div class="card-opening" style="font-size: 20px;">Total Perjalanan Dinas</div>
                                                <div class="card-desc" style="font-size: 40px;">
                                                    @php
                                                        if (old('tanggal_berangkat') != null && old('tanggal_pulang') != null) {
                                                            $date1 = strtotime(old('tanggal_berangkat'));
                                                            $date2 = strtotime(old('tanggal_pulang'));
                                                            $diff = $date2 - $date1;
                                                            $days = floor($diff / (60 * 60 * 24));
                                                        }else{
                                                            $days = 0;
                                                        }
                                                    @endphp
                                                    <b><span id="hari">{{ $days }}</span> Hari</b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button class="btn btn-primary btn-rounded">Tambah Perjalanan </button>
                                    <a href="{{ route('admin.perdin.index') }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
                                </form>
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

        $(document).on('change', '#tanggal_berangkat, #tanggal_pulang', function() {
            var start_date = new Date($('#tanggal_berangkat').val());
            var end_date = new Date($('#tanggal_pulang').val());

            if (start_date != 'Invalid Date' && end_date != 'Invalid Date'){
                //Here we will use getTime() function to get the time difference
                var time_difference = end_date.getTime() - start_date.getTime();
                //Here we will divide the above time difference by the no of miliseconds in a day
                var days_difference = time_difference / (1000*3600*24);
                //alert(days);
                $('#hari').text(days_difference) ;
            };
        });


        function langlat(lat,lang) {
            $("#latitude").val(lat)
            $("#longitude").val(lang)
        }
        
    </script>
@endsection
