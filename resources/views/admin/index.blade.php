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
						<h5 class="text-white op-7 mb-2">Selamat datang di dashboard admin website PT. BASE. Kelola semua informasi di website PT. BASE dengan mudah disini.</h5>
					</div>
					<div class="ml-md-auto py-2 py-md-0">
					</div>
				</div>
			</div>
		</div>
		<div class="page-inner mt--5">
			<div class="row">
				<div class="col-sm-6 col-md-3">
					<div class="card card-stats card-primary card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="flaticon-shopping-bag"></i>
									</div>
								</div>
								<div class="col-7 col-stats">
									<div class="numbers">
										<p class="card-category">Produk</p>
										<h4 class="card-title">{{ "20" }}</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="card card-stats card-info card-round">
						<div class="card-body">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="flaticon-star"></i>
									</div>
								</div>
								<div class="col-7 col-stats">
									<div class="numbers">
										<p class="card-category">Partner</p>
										<h4 class="card-title">{{ "30" }}</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="card card-stats card-success card-round">
						<div class="card-body ">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="flaticon-analytics"></i>
									</div>
								</div>
								<div class="col-7 col-stats">
									<div class="numbers">
										<p class="card-category">Proyek</p>
										<h4 class="card-title">{{ "50" }}</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="card card-stats card-secondary card-round">
						<div class="card-body ">
							<div class="row">
								<div class="col-5">
									<div class="icon-big text-center">
										<i class="flaticon-interface-6"></i>
									</div>
								</div>
								<div class="col-7 col-stats">
									<div class="numbers">
										<p class="card-category">Berita</p>
										<h4 class="card-title">{{ "70" }}</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			{{-- <div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">Grafik perkembangan jumlah (Produk, Penghargaan, Proyek, Berita)</div>
						</div>
						<div class="card-body">
							<div class="chart-container">
								<canvas id="multipleLineChart"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div> --}}
		</div>
	</div>
	<footer class="footer">
		<div class="container-fluid">
			
			<div class="copyright ml-auto">
				{{ date("Y") }}, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.tupaitech.net">Tupai Tech</a>
			</div>				
		</div>
	</footer>
</div>


@endsection

@section('js')
<script>

	// multiple line chart
		// let multipleLineChart = document.getElementById('multipleLineChart').getContext('2d');
		// var myMultipleLineChart = new Chart(multipleLineChart, {
		// 	type: 'line',
		// 	data: {
		// 		labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
		// 		datasets: [{
		// 			label: "Produk",
		// 			borderColor: "#1d7af3",
		// 			pointBorderColor: "#FFF",
		// 			pointBackgroundColor: "#1d7af3",
		// 			pointBorderWidth: 2,
		// 			pointHoverRadius: 4,
		// 			pointHoverBorderWidth: 1,
		// 			pointRadius: 4,
		// 			backgroundColor: 'transparent',
		// 			fill: true,
		// 			borderWidth: 2,
		// 			data: 
		// 		},{
		// 			label: "Proyek",
		// 			borderColor: "#59d05d",
		// 			pointBorderColor: "#FFF",
		// 			pointBackgroundColor: "#59d05d",
		// 			pointBorderWidth: 2,
		// 			pointHoverRadius: 4,
		// 			pointHoverBorderWidth: 1,
		// 			pointRadius: 4,
		// 			backgroundColor: 'transparent',
		// 			fill: true,
		// 			borderWidth: 2,
		// 			data: 
		// 		}, {
		// 			label: "Partner",
		// 			borderColor: "#48abf7",
		// 			pointBorderColor: "#FFF",
		// 			pointBackgroundColor: "#48abf7",
		// 			pointBorderWidth: 2,
		// 			pointHoverRadius: 4,
		// 			pointHoverBorderWidth: 1,
		// 			pointRadius: 4,
		// 			backgroundColor: 'transparent',
		// 			fill: true,
		// 			borderWidth: 2,
		// 			data: 
		// 		},
		// 		{
		// 			label: "Berita",
		// 			borderColor: "#6861ce",
		// 			pointBorderColor: "#FFF",
		// 			pointBackgroundColor: "#6861ce",
		// 			pointBorderWidth: 2,
		// 			pointHoverRadius: 4,
		// 			pointHoverBorderWidth: 1,
		// 			pointRadius: 4,
		// 			backgroundColor: 'transparent',
		// 			fill: true,
		// 			borderWidth: 2,
		// 			data: 
		// 		}]
		// 	},
		// 	options : {
		// 		responsive: true, 
		// 		maintainAspectRatio: false,
		// 		legend: {
		// 			position: 'top',
		// 		},
		// 		tooltips: {
		// 			bodySpacing: 4,
		// 			mode:"nearest",
		// 			intersect: 0,
		// 			position:"nearest",
		// 			xPadding:10,
		// 			yPadding:10,
		// 			caretPadding:10
		// 		},
		// 		layout:{
		// 			padding:{left:15,right:15,top:15,bottom:15}
		// 		}
		// 	}
		// });

		// let i = 1;
		// while (i < 4) {
		// 	console.log("vehicle"+ i);
		// 	i++
		// }
</script>
@endsection
