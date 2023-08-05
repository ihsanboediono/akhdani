{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Tambah pengguna')

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
						<div class="col-md-7">
							<div class="card">
                                <div class="card-header card-info">
                                    <div class="card-title">Form tambah user</div>
                                </div>
								<div class="card-body">
                                    <form action="{{ route('admin.users.store') }}" method="POST"  enctype="multipart/form-data">
										@csrf
                                        <div class="form-group">
                                            <label for="nama">Name</label>
                                            <input type="text" class="form-control" id="nama" name="nama" aria-describedby="nama" placeholder="Nama" value="{{ old('nama') }}" >
                                            @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" aria-describedby="username" placeholder="Username" value="{{ old('username') }}" >
                                            @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Email" value="{{ old('email') }}"  >
                                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Hak Akses</label>
                                            <select name="role" id="role" class="form-control">
                                                <option value="">- Pilih Role -</option>
                                                <option value="devisi-sdm">DIVISI-SDM</option>
                                                <option value="pegawai">PEGAWAI</option>
                                            </select>
                                            @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" aria-describedby="password" placeholder="Password" value="{{ old('password') }}" >
                                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="re-password">Re-password</label>
                                            <input type="password" class="form-control" id="re-password" name="re-password" aria-describedby="re-password" placeholder="Ulangi Password" value="{{ old('re-password') }}"  >
                                            @error('re-password') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary btn-rounded ml-2">Tambah user</button>
                                            <a type="button" href="{{ route('admin.users.index') }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
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
