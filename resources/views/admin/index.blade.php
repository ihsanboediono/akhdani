@extends('admin.layouts.main')

@section('title') Dashboard @endsection


@section('content')


<div class="main-panel">
	<div class="content">
		<div class="panel-header bg-primary-gradient">
			<div class="page-inner py-5">
				<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
					<div>
						<h2 class="text-white pb-2 fw-bold">Hai <span class="text-warning">{{ auth()->user()->name }}!</span></h2>
						<h5 class="text-white op-7 mb-2">Selamat datang di dashboard admin website <b>PerdinKu</b> Kelola semua informasi Perjalanan Dinas dengan mudah disini.</h5>
					</div>
					<div class="ml-md-auto py-2 py-md-0">
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

</script>
@endsection
