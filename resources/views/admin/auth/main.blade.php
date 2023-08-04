<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Admin PT. BASE | @yield('title', '')</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('assets/admin/img/icon.ico') }}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ asset('assets/admin/js/plugin/webfont/webfont.min.js')}}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ["{{ asset('assets/admin/css/fonts.min.css')}}"]},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/admin/css/atlantis.min.css')}}">

	{{-- datepicker --}}
	<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datedropper/datedropper.min.css') }} ">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ asset('assets/admin/css/style.css')}}">

	{{-- ck editor --}}
	<script src="{{ asset('assets/admin/ckeditor/ckeditor.js') }}"></script>
	<script src="{{ asset('assets/admin/ckeditor/config.js') }}"></script>
	<script src="{{ asset('assets/admin/ckfinder/ckfinder.js') }}"></script>

	
</head>
<body>
	
    @yield('content')
		


	@include('sweetalert::alert')

	<!--   Core JS Files   -->
	<script src="{{ asset('assets/admin/js/core/jquery.3.2.1.min.js')}}"></script>
	<script src="{{ asset('assets/admin/js/core/popper.min.js')}}"></script>
	<script src="{{ asset('assets/admin/js/core/bootstrap.min.js')}}"></script>

	<!-- jQuery UI -->
	<script src="{{ asset('assets/admin/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
	<script src="{{ asset('assets/admin/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{ asset('assets/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>


	<!-- Chart JS -->
	<script src="{{ asset('assets/admin/js/plugin/chart.js/chart.min.js')}}"></script>

	<!-- jQuery Sparkline -->
	<script src="{{ asset('assets/admin/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

	<!-- Chart Circle -->
	<script src="{{ asset('assets/admin/js/plugin/chart-circle/circles.min.js')}}"></script>

	<!-- Datatables -->
	<script src="{{ asset('assets/admin/js/plugin/datatables/datatables.min.js')}}"></script>

	<!-- Bootstrap Notify -->
	{{-- <script src="{{ asset('assets/admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script> --}}

	<!-- jQuery Vector Maps -->
	<script src="{{ asset('assets/admin/js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
	<script src="{{ asset('assets/admin/js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script>

	<!-- Sweet Alert -->
	<script src="{{ asset('assets/admin/js/plugin/sweetalert/sweetalert.min.js')}}"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	{{-- datepicker --}}
	<script src="{{ asset('assets/admin/plugins/moment/moment.js') }}"></script>
	<script src="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') }}"></script>
	<script src="{{ asset('assets/admin/plugins/datedropper/datedropper.min.js') }}"></script>
	<script src="{{ asset('assets/admin/plugins/js/form-picker.js') }}"></script>

	<!-- Atlantis JS -->
	<script src="{{ asset('assets/admin/js/atlantis.min.js')}}"></script>

	@yield('js')
</body>
</html>