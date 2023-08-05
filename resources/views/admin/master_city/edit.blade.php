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
                                <div class="card-title">Form edit layanan</div>
                            </div>
                            <div class="card-body">
                            <form action="{{ route('admin.service.update', ['service' => $service->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="name_id">Nama layanan</label>
                                    <input type="text" class="form-control" id="name_id" name="name_id" placeholder="Nama layanan" value="{{ old('name_id', $service->name_id) }}">
                                    @error('name_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                {{-- <div class="form-group">
                                    <label for="name_en">Nama layanan (English)</label>
                                    <input type="text" class="form-control" id="name_en" name="name_en" placeholder="Nama layanan bahasa inggris" value="{{ old('name_en', $service->name_en) }}">
                                    @error('name_en') <span class="text-danger">{{ $message }}</span> @enderror
                                </div> --}}
                                <div class="form-group">
                                    <label for="description_id">Deskripsi layanan</label>
                                    <textarea class="form-control" id="editor1" rows="5" name="description_id" placeholder="">{{ old('description_id', $service->description_id) }}</textarea>
                                    @error('description_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                {{-- <div class="form-group">
                                    <label for="description_en">Deskripsi layanan (English)</label>
                                    <textarea class="form-control" id="editor2" rows="5" name="description_en" placeholder="">{{ old('description_en', $service->description_en) }}</textarea>
                                    @error('description_en') <span class="text-danger">{{ $message }}</span> @enderror
                                </div> --}}
                                <div class="row form-group">
                                    <div class="form-group col-md-6">
                                        <p style="font-weight: 600">Gambar</p>
                                        <img src="{{ $service->image_url }}" class="img-preview img-fluid mb-3">
                                        <p id="file-name"></p>
                                        <label class="image-label" for="image"><i class="fas fa-file-upload"></i><span>Cari File</span></label>
                                        <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage()">
                                        <div class="info">
                                            <p>Max size : 1MB</p>
                                        </div>
                                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <p style="font-weight: 600">Icon</p>
                                        <img src="{{ $service->icon_url }}" class="img-fluid mb-3 icon-preview" id="iconx" >
                                        <p id="icon-name"></p>
                                        <label class="image-label" for="icon"><i class="fas fa-file-upload"></i><span>Cari File</span></label>
                                        <input type="file" class="form-control-file icon-image" id="icon" name="icon" onchange="previewIcon()">
                                        <div class="info">
                                            <p>Max size : 1MB</p>
                                        </div>
                                        @error('icon') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-rounded">Edit layanan </button>
                                <a href="{{ route('admin.service.index') }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
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
