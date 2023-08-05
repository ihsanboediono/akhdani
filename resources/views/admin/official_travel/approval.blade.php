{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Edit layanan')

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
                                @if (request()->routeIs('admin.perdin.history.*'))
                                    <div class="card-title">History Perdin Pegawai</div>
                                @else
                                    <div class="card-title">Approval Perdin Pegawai</div>
                                @endif
                            </div>
                            <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row row-demo-grid">
                                    <div class="form-group col-lg-6">
                                        <label for="tanggal_berangkat">Tanggal Berangkat</label>
                                        <input type="date" class="form-control" id="tanggal_berangkat" name="tanggal_berangkat" placeholder="Tanggal Berangkat" value="{{ old('tanggal_berangkat', $officialTravel->departure_date) }}" disabled style="background-color: white !important; color: black !important;">
                                        @error('tanggal_berangkat') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="form-group col-lg-6">
                                        <label for="tanggal_pulang">Tanggal Pulang</label>
                                        <input type="date" class="form-control" id="tanggal_pulang" name="tanggal_pulang" placeholder="Tanggal Pulang" value="{{ old('tanggal_pulang', $officialTravel->return_date) }}" disabled style="background-color: white !important; color: black !important;">
                                        @error('tanggal_pulang') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="form-group col-lg-6">
                                        <label for="kota_asal">Kota Asal</label>
                                        <select name="kota_asal" id="kota_asal" class="form-control" disabled style="background-color: white !important; color: black !important;">
                                            <option value="">- Pilih Kota Asal -</option>
                                            @foreach ($masters as $master)
                                                <option value="{{ $master->id }}" @selected(old('kota_asal', $officialTravel->hometown_id) == $master->id)>{{ $master->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('kota_asal') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="kota_tujuan">Kota Tujuan</label>
                                        <select name="kota_tujuan" id="kota_tujuan" class="form-control" disabled style="background-color: white !important; color: black !important;">
                                            <option value="">- Pilih Kota Tujuan -</option>
                                            @foreach ($masters as $master)
                                                <option value="{{ $master->id }}" @selected(old('kota_tujuan', $officialTravel->destination_id) == $master->id)>{{ $master->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('kota_tujuan') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control" name="keterangan" id="keterangan" rows="8" disabled style="background-color: white !important; color: black !important;">{{ old('keterangan', $officialTravel->description) }}</textarea>
                                        @error('keterangan') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card col-md-10 mx-auto">
                                        <div class="card-body text-center">
                                            <div class="table-responsive">
                                                <table id="basic-datatables" class="display table table-striped table-hover" >
                                                    <thead>
                                                        <tr  class="table-primary">
                                                            <th>Total Hari</th>
                                                            <th>Jarak Tempuh</th>
                                                            <th>Total Uang PerDin</th>
                                                            @if (request()->routeIs('admin.perdin.history.*'))
                                                                <th >Status </th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-primary" style="font-size: 20px">{{ $officialTravel->duration }} Hari</td>
                                                            <td style="height: 100px;">
                                                                <b class="text-primary" style="font-size: 17px">{{ $distance }} KM </b><br>
                                                                <span class="text-secondary">Rp. {{ $uang }}.- / Hari <br></span>
                                                                <span class="text-muted">({{ $ukur }})</span>
                                                            </td>
                                                            <td class="text-primary" style="font-size: 17px">Rp. {{ $total }},- </td>
                                                            @if (request()->routeIs('admin.perdin.history.*'))
                                                                <td >
                                                                    @if ($officialTravel->status == 'approved')
                                                                        <span class="btn btn-success" >Approved</span>
                                                                    @elseif ($officialTravel->status == 'rejected')
                                                                        <span class="btn btn-danger" >Rejected</span>
                                                                    @else
                                                                        <span class="btn btn-warning" >Pending</span>
                                                                    @endif
                                                                </td>
                                                                
                                                            @endif
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                                @if ($officialTravel->status == 'pending')
                                    <div class="d-flex justify-content-center">
                                        <form action="{{ route('admin.perdin.reject', ["officialTravel" => $officialTravel->id]) }}" method="post">
                                            @csrf
                                            <button type="submit"  class="btn btn-lg btn-danger" style="cursor: pointer;">Reject </button>
                                        </form>
                                        <form action="{{ route('admin.perdin.approve', ["officialTravel" => $officialTravel->id]) }}" method="post">
                                            @csrf
                                            <button type="submit"  class="btn btn-primary btn-lg ml-2" style="cursor: pointer;">Approve </button>
                                        </form>
                                    </div>
                                @else
                                    
                                @endif
                                
                            
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
            // thumbnail
        function previewImage() {
            const image = document.querySelector('#image');
            const imagePreview = document.querySelector('.img-preview');
            let filename = document.getElementById('file-name');
            imagePreview.style.display='block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            filename.innerHTML = image.files[0].name;

            oFReader.onload =function (oFREvent) {
                imagePreview.src = oFREvent.target.result;					
            }
        }
        function previewIcon() {
            const icon = document.querySelector('#icon');
            const iconPreview = document.querySelector('.icon-preview');
            let filename = document.getElementById('icon-name');
            iconPreview.style.display='block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(icon.files[0]);
            filename.innerHTML = icon.files[0].name;

            oFReader.onload =function (oFREvent) {
                iconPreview.src = oFREvent.target.result;					
            }
        }

        var editor = CKEDITOR.replace("editor1", {
                height: 200,
            });
            CKFinder.setupCKEditor(editor);
            var editor2 = CKEDITOR.replace("editor2", {
                height: 200,
            });
            CKFinder.setupCKEditor(editor2);
    </script>
@endsection
