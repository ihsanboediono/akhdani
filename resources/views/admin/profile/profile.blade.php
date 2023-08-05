{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Profil')

@section('content')

<body>
    <div class="wrapper">
        {{-- call header --}}
        @include('admin.layouts.header')
        {{-- call sidebar --}}
        @include('admin.layouts.sidebar')

        <div class="main-panel">
			<div class="content">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white pb-2 fw-bold">Profil {{ auth()->user()->name }}</h2>
                                <h5 class="text-white op-7 mb-2">Kelola informasi pribadi anda disini</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row">
						<div class="col-md-6">
							<div class="card">
                                <div class="card-header bg-success">
                                    <h4 class="card-title text-white">Profil</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.profile.edit') }}" method="POST" enctype="multipart/form-data">                                                                                                    
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <input type="text" id="name" name="name" placeholder="Nama anda" class="form-control form-control-md" value="{{ old('name', auth()->user()->name) }}">
													@error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    			</div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email" name="email" class="form-control form-control-md" placeholder="Email anda" value="{{ old('email', auth()->user()->email) }}" >
													@error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    			</div>
                                                <div class="form-group">
													<p style="font-weight: 600">Gambar</p>
													<img src="{{ auth()->user()->image != null ? auth()->user()->image_url : asset('assets/admin/img/default.png') }}" class="img-preview img-fluid mb-3" width="200px" height="200px"><br>
													<label class="image-label" for="image"><i class="fas fa-file-upload"></i><span>Cari File</span></label>
													<input type="file" class="form-control-file" id="image" name="image" onchange="previewImage()">
													<div class="mt-2">
														<p class="text-left">Ukuran Maksimal Gambar : 3 MB</p>
														<p class="text-left">Format Gambar : JPG, JPEG, PNG</p>
													</div>
													@error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                    			</div>
                                            </div>
                                            <div class="col-lg-5 col-md-6 profile-admin">
                                                
                                            </div>
                                        </div>
                                        <div class="text-left mt-3 mb-3">
                                            <button class="btn btn-primary m-1 btn-rounded">Simpan Profil</button>
                                            {{-- <button class="btn btn-warning m-1 btn-rounded">Kembali</button> --}}
                                        </div>
										@csrf
                                    </form>                                    
                                </div>
                            </div>
						</div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h4 class="card-title text-white">Ubah password</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.profile.password') }}" method="POST"> 
										@csrf                                                                                         
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" id="password" name="password" class="form-control form-control-md" value="" placeholder="Password saat ini">
                                                	@error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                    			</div>
                                                <div class="form-group">
                                                    <label for="new_password">Password Baru</label>
                                                    <input type="password" id="new_password" name="new_password" class="form-control form-control-md" value="" placeholder="Password baru">
                                                	@error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
                                    			</div>
                                                <div class="form-group">
                                                    <label for="password_confirmation">Konfirmasi password</label>
                                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-md" value="" placeholder="Konfirmasi password baru">
                                                	@error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                                    			</div>
                                            </div>
                                        </div>
                                        <div class="text-left mt-3 mb-3">
                                            <button class="btn btn-primary m-1 btn-rounded">Simpan password</button>
                                            {{-- <button class="btn btn-warning m-1 btn-rounded">Kembali</button> --}}
                                        </div>
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
    </div>
</body>

@endsection

@section('js')

	<script>
		function previewImage() {
            const image = document.querySelector('#image');
            const imagePreview = document.querySelector('.img-preview');
            let filename = document.getElementById('file-name');
            // imagePreview.style.display='block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
			console.log(image.files[0].name);
            // filename.innerHTML = image.files[0].name;

            oFReader.onload =function (oFREvent) {
                imagePreview.src = oFREvent.target.result;					
            }
        }
		

		
	</script>
@endsection
