@extends('layout.master')

@section('content')

<!-- container -->
<div class="main-container container-fluid">

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
        <span class="main-content-title mg-b-0 mg-b-lg-1">DASHBOARD</span>
        </div>
        <div class="justify-content-center mt-2">
            <form action="{{ route('dashboard') }}" method="GET">
                <div class="d-flex">
                    <div class="w-100 me-2">
                        <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" value="{{$fechaInicio2}}">
                    </div>
                    <div class="w-100">
                        <input type="date" name="fechaFin" id="fechaFin" class="form-control" value="{{$fechaFin2}}">
                    </div>
                    <button id="BotonFiltro" class="btn btn-primary me-2">
                        <i class="fas fa-search"></i><b> &nbsp; Buscar</b>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- /breadcrumb -->
    <!-- row -->
    <div class="row">
        <div class="col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <div class="main-content-label tx-12 mg-b-15">
                                Reservas por Usuarios
                            </div>
                            <div class="ht-200 ht-lg-250">
                                <canvas id="ChartPaquetesVendidos"></canvas>
                            </div>
                        </div><!-- col-6 -->
                    </div>
                </div><!-- col-12 -->
            </div><!-- col-12 -->
        </div><!-- col-12 -->
		<div class="col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-sm-12 col-md-12 col-xl-12">
							<div class="main-content-label tx-12 mg-b-15">
                                Personal
                            </div>
                            <div class="table-responsive ht-200 ht-lg-250">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Nombre</th>
											<th>Sueldo</th>
											<th>F. Ingreso</th>
											<th>H. Ingreso</th>
											<th>H. Salida</th>
											<th>Dia Descanso</th>
											<th>Cumpleaños</th>
											<th>Cargo</th>
										</tr>
									</thead>
									<tbody>
										@foreach($usuarios as $user)
											<tr>
												<td>{{$user->nombre}}</td>
												<td>{{$user->sueldo}}</td>
												<td>{{date('d/m/Y',strtotime($user->fecha_inicio))}}</td>
												<td>{{$user->hora_ingreso ? date('H:i',strtotime($user->hora_ingreso)):''}}</td>
												<td>{{$user->hora_salida ? date('H:i',strtotime($user->hora_salida)): ''}}</td>
												<td>{{$user->dia_descanso}}</td>
												<td>{{$user->fecha_nacimiento ? date('d/m',strtotime($user->fecha_nacimiento)): ''}}</td>
												<td>{{$user->roles[0]->name}}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
                        </div><!-- col-6 -->
                    </div>
                </div><!-- col-12 -->
            </div><!-- col-12 -->
        </div><!-- col-12 -->
        <div class="col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <div class="main-content-label tx-12 mg-b-15">
                                Reservas total por Usuarios
                            </div>
                            <div class="ht-200 ht-lg-250">
                                <canvas id="ChartPaquetesTotal"></canvas>
                            </div>
                        </div><!-- col-6 -->
                    </div>
                </div><!-- col-12 -->
            </div><!-- col-12 -->
        </div><!-- col-12 -->
		<div class="col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <div class="main-content-label tx-12 mg-b-15">
                                Consumo por pais
                            </div>
                            <div class="ht-200 ht-lg-250">
                                <canvas id="ChartConsumoPais"></canvas>
                            </div>
                        </div><!-- col-6 -->
                    </div>
                </div><!-- col-12 -->
            </div><!-- col-12 -->
        </div><!-- col-12 -->
		<div class="col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <div class="main-content-label tx-12 mg-b-15">
                                Tours mas Vendidos
                            </div>
                            <div class="ht-200 ht-lg-250">
                                <canvas id="CharttourmasVendido"></canvas>
                            </div>
                        </div><!-- col-6 -->
                    </div>
                </div><!-- col-12 -->
            </div><!-- col-12 -->
        </div><!-- col-12 -->
		<div class="col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <div class="main-content-label tx-12 mg-b-15">
                                Paquetes mas Vendidos
                            </div>
                            <div class="ht-200 ht-lg-250">
                                <canvas id="ChartpaquetemasVendido"></canvas>
                            </div>
                        </div><!-- col-6 -->
                    </div>
                </div><!-- col-12 -->
            </div><!-- col-12 -->
        </div><!-- col-12 -->
		<div class="col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <div class="main-content-label tx-12 mg-b-15">
                                Frecuencia Guias
                            </div>
                            <div class="ht-200 ht-lg-250">
                                <canvas id="frecuenciaGuias"></canvas>
                            </div>
                        </div><!-- col-6 -->
                    </div>
                </div><!-- col-12 -->
            </div><!-- col-12 -->
        </div><!-- col-12 -->
		<div class="col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <div class="main-content-label tx-12 mg-b-15">
                                Frecuencia Transportes
                            </div>
                            <div class="ht-200 ht-lg-250">
                                <canvas id="frecuenciaTransporte"></canvas>
                            </div>
                        </div><!-- col-6 -->
                    </div>
                </div><!-- col-12 -->
            </div><!-- col-12 -->
        </div><!-- col-12 -->
		<div class="col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <div class="main-content-label tx-12 mg-b-15">
                                Frecuencia Agencias
                            </div>
                            <div class="ht-200 ht-lg-250">
                                <canvas id="frecuenciaAgencias"></canvas>
                            </div>
                        </div><!-- col-6 -->
                    </div>
                </div><!-- col-12 -->
            </div><!-- col-12 -->
        </div><!-- col-12 -->
		<div class="col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <div class="main-content-label tx-12 mg-b-15">
                                Frecuencia Hoteles
                            </div>
                            <div class="ht-200 ht-lg-250">
                                <canvas id="frecuenciaHoteles"></canvas>
                            </div>
                        </div><!-- col-6 -->
                    </div>
                </div><!-- col-12 -->
            </div><!-- col-12 -->
        </div><!-- col-12 -->
		<div class="col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <div class="main-content-label tx-12 mg-b-15">
                                Incidencias
                            </div>
                            <div class="ht-200 ht-lg-250">
                                <canvas id="incidencias"></canvas>
                            </div>
                        </div><!-- col-6 -->
                    </div>
                </div><!-- col-12 -->
            </div><!-- col-12 -->
        </div><!-- col-12 -->
		<div class="col-md-6">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="row row-sm">
                        <div class="col-sm-12 col-md-12 col-xl-12">
                            <div class="main-content-label tx-12 mg-b-15">
                                Activo Fijo
                            </div>
                            <div class="ht-200 ht-lg-250">
                                <canvas id="activoFijo"></canvas>
                            </div>
                        </div><!-- col-6 -->
                    </div>
                </div><!-- col-12 -->
            </div><!-- col-12 -->
        </div><!-- col-12 -->
    </div>




</div>
<!-- /Container -->
@endsection

@push('custom-scripts')
    <script src="{{ asset('../plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('../plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('../plugins/jquery.flot/jquery.flot.pie.js') }}"></script>

@endpush
@push('custom-scripts')
<script>
    $(function () {
	'use strict';
	var ctx1 = document.getElementById('ChartPaquetesVendidos').getContext('2d');
	new Chart(ctx1, {
		type: 'bar',
		data: {
            labels: [<?php foreach($reservasPorUsuario as $reservas)
                    {echo '"'.$reservas->usuario.'",';} ?>],
            datasets: [
            {
                label:"Cantidad",
                backgroundColor: ["#68da3e","#00c6ab","#6aa3b4","#416864","#223026","#ebb7ce","#b38471","#5c5e36","#1d3d33","#fc8526"],
                data: [<?php foreach($reservasPorUsuario as $reservas)
                    {echo '"'.$reservas->cantidad_reservas.'",';} ?>]
            }]
		},
		options: {
			maintainAspectRatio: false,
			responsive: true,
			legend: {
				display: false,
				labels: {
					display: false
				}
			},
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true,
						fontSize: 10,
						fontColor: "rgba(171, 167, 167,0.9)",
					},
					gridLines: {
						display: true,
						color: 'rgba(171, 167, 167,0.2)',
						drawBorder: false
					},
				}],
				xAxes: [{
					barPercentage: 0.6,
					ticks: {
						beginAtZero: true,
						fontSize: 11,
						fontColor: "rgba(171, 167, 167,0.9)",
					},
					gridLines: {
						display: true,
						color: 'rgba(171, 167, 167,0.2)',
						drawBorder: false
					},
				}]
			}
		}
	});

	var ctx3 = document.getElementById('ChartConsumoPais').getContext('2d');
	new Chart(ctx3, {
		type: 'horizontalBar',
		data: {
            labels: [<?php foreach($paisesconsumo as $reservas)
                    {echo '"'.$reservas->nombre.'",';} ?>],
            datasets: [
            {
                label:"Cantidad",
                backgroundColor: ["#68da3e","#00c6ab","#6aa3b4","#416864","#223026","#ebb7ce","#b38471","#5c5e36","#1d3d33","#fc8526"],
                data: [<?php foreach($paisesconsumo as $reservas)
                    {echo '"'.$reservas->total.'",';} ?>]
            }]
		},
		options: {
			maintainAspectRatio: false,
			responsive: true,
			legend: {
				display: false,
				labels: {
					display: false
				}
			},
			
		}
	});

	var ctx4 = document.getElementById('CharttourmasVendido');
	var myPieChart7 = new Chart(ctx4, {
		type: 'pie',
		data: {
			labels: [<?php foreach($tourmasVendido as $reservas)
                    {echo '"'.$reservas->titulo.'",';} ?>],
			datasets: [{
			data: [<?php foreach($tourmasVendido as $reservas)
                    {echo '"'.$reservas->total.'",';} ?>],
			backgroundColor: ["#68da3e","#00c6ab","#6aa3b4","#416864","#223026","#ebb7ce","#b38471","#5c5e36","#1d3d33","#fc8526"],
			}],
		},
		options:{
			maintainAspectRatio: false,
			responsive: true,
			legend: {
				display: false,
			},
			animation: {
				animateScale: true,
				animateRotate: true
			}
		}
	});

	var ctx5 = document.getElementById('ChartpaquetemasVendido');
	var myPieChart6 = new Chart(ctx5, {
		type: 'doughnut',
		data: {
			labels: [<?php foreach($paquetemasVendido as $reservas)
                    {echo '"'.$reservas->titulo.'",';} ?>],
			datasets: [{
			data: [<?php foreach($paquetemasVendido as $reservas)
                    {echo '"'.$reservas->total.'",';} ?>],
			backgroundColor: ["#68da3e","#00c6ab","#6aa3b4","#416864","#223026","#ebb7ce","#b38471","#5c5e36","#1d3d33","#fc8526"],
			}],
		},
		options:{
			maintainAspectRatio: false,
			responsive: true,
			legend: {
				display: false,
			},
			animation: {
				animateScale: true,
				animateRotate: true
			}
		}
	});

	var ctx6 = document.getElementById('frecuenciaGuias').getContext('2d');
	new Chart(ctx6, {
		type: 'bar',
		data: {
            labels: [<?php foreach($frecuenciaGuias as $reservas)
                    {echo '"'.$reservas->nombre.'",';} ?>],
            datasets: [
            {
                label:"Cantidad",
                backgroundColor: ["#68da3e","#00c6ab","#6aa3b4","#416864","#223026","#ebb7ce","#b38471","#5c5e36","#1d3d33","#fc8526"],
                data: [<?php foreach($frecuenciaGuias as $reservas)
                    {echo '"'.$reservas->total.'",';} ?>]
            }]
		},
		options: {
			maintainAspectRatio: false,
			responsive: true,
			legend: {
				display: false,
				labels: {
					display: false
				}
			},
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true,
						fontSize: 10,
						fontColor: "rgba(171, 167, 167,0.9)",
					},
					gridLines: {
						display: true,
						color: 'rgba(171, 167, 167,0.2)',
						drawBorder: false
					},
				}],
				xAxes: [{
					barPercentage: 0.6,
					ticks: {
						beginAtZero: true,
						fontSize: 11,
						fontColor: "rgba(171, 167, 167,0.9)",
					},
					gridLines: {
						display: true,
						color: 'rgba(171, 167, 167,0.2)',
						drawBorder: false
					},
				}]
			}
		}
	});

	var ctx7 = document.getElementById('frecuenciaTransporte').getContext('2d');
	new Chart(ctx7, {
		type: 'bar',
		data: {
            labels: [<?php foreach($frecuenciaTransporte as $reservas)
                    {echo '"'.$reservas->nombre.'",';} ?>],
            datasets: [
            {
                label:"Cantidad",
                backgroundColor: ["#68da3e","#00c6ab","#6aa3b4","#416864","#223026","#ebb7ce","#b38471","#5c5e36","#1d3d33","#fc8526"],
                data: [<?php foreach($frecuenciaTransporte as $reservas)
                    {echo '"'.$reservas->total.'",';} ?>]
            }]
		},
		options: {
			maintainAspectRatio: false,
			responsive: true,
			legend: {
				display: false,
				labels: {
					display: false
				}
			},
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true,
						fontSize: 10,
						fontColor: "rgba(171, 167, 167,0.9)",
					},
					gridLines: {
						display: true,
						color: 'rgba(171, 167, 167,0.2)',
						drawBorder: false
					},
				}],
				xAxes: [{
					barPercentage: 0.6,
					ticks: {
						beginAtZero: true,
						fontSize: 11,
						fontColor: "rgba(171, 167, 167,0.9)",
					},
					gridLines: {
						display: true,
						color: 'rgba(171, 167, 167,0.2)',
						drawBorder: false
					},
				}]
			}
		}
	});

	var ctx8 = document.getElementById('frecuenciaAgencias').getContext('2d');
	new Chart(ctx8, {
		type: 'bar',
		data: {
            labels: [<?php foreach($frecuenciaAgencias as $reservas)
                    {echo '"'.$reservas->nombre.'",';} ?>],
            datasets: [
            {
                label:"Cantidad",
                backgroundColor: ["#68da3e","#00c6ab","#6aa3b4","#416864","#223026","#ebb7ce","#b38471","#5c5e36","#1d3d33","#fc8526"],
                data: [<?php foreach($frecuenciaAgencias as $reservas)
                    {echo '"'.$reservas->total.'",';} ?>]
            }]
		},
		options: {
			maintainAspectRatio: false,
			responsive: true,
			legend: {
				display: false,
				labels: {
					display: false
				}
			},
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true,
						fontSize: 10,
						fontColor: "rgba(171, 167, 167,0.9)",
					},
					gridLines: {
						display: true,
						color: 'rgba(171, 167, 167,0.2)',
						drawBorder: false
					},
				}],
				xAxes: [{
					barPercentage: 0.6,
					ticks: {
						beginAtZero: true,
						fontSize: 11,
						fontColor: "rgba(171, 167, 167,0.9)",
					},
					gridLines: {
						display: true,
						color: 'rgba(171, 167, 167,0.2)',
						drawBorder: false
					},
				}]
			}
		}
	});

	var ctx9 = document.getElementById('frecuenciaHoteles').getContext('2d');
	new Chart(ctx9, {
		type: 'bar',
		data: {
            labels: [<?php foreach($frecuenciaHoteles as $reservas)
                    {echo '"'.$reservas->nombre.'",';} ?>],
            datasets: [
            {
                label:"Cantidad",
                backgroundColor: ["#68da3e","#00c6ab","#6aa3b4","#416864","#223026","#ebb7ce","#b38471","#5c5e36","#1d3d33","#fc8526"],
                data: [<?php foreach($frecuenciaHoteles as $reservas)
                    {echo '"'.$reservas->total.'",';} ?>]
            }]
		},
		options: {
			maintainAspectRatio: false,
			responsive: true,
			legend: {
				display: false,
				labels: {
					display: false
				}
			},
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true,
						fontSize: 10,
						fontColor: "rgba(171, 167, 167,0.9)",
					},
					gridLines: {
						display: true,
						color: 'rgba(171, 167, 167,0.2)',
						drawBorder: false
					},
				}],
				xAxes: [{
					barPercentage: 0.6,
					ticks: {
						beginAtZero: true,
						fontSize: 11,
						fontColor: "rgba(171, 167, 167,0.9)",
					},
					gridLines: {
						display: true,
						color: 'rgba(171, 167, 167,0.2)',
						drawBorder: false
					},
				}]
			}
		}
	});

	var ctx10 = document.getElementById('incidencias');
	var myPieChart7 = new Chart(ctx10, {
		type: 'pie',
		data: {
			labels: [<?php foreach($incidencias as $reservas)
                    {echo '"'.$reservas->descripcion.'",';} ?>],
			datasets: [{
			data: [<?php foreach($incidencias as $reservas)
                    {echo '"'.$reservas->total.'",';} ?>],
			backgroundColor: ["#68da3e","#00c6ab","#6aa3b4","#416864","#223026","#ebb7ce","#b38471","#5c5e36","#1d3d33","#fc8526"],
			}],
		},
		options:{
			maintainAspectRatio: false,
			responsive: true,
			legend: {
				display: false,
			},
			animation: {
				animateScale: true,
				animateRotate: true
			}
		}
	});

	var ctx11 = document.getElementById('activoFijo');
	var myPieChart6 = new Chart(ctx11, {
		type: 'doughnut',
		data: {
			labels: ['Ingresos','Gastos'],
			datasets: [{
			data: [{{$pagos}},{{$cobros}}],
			backgroundColor: ["#68da3e","#b38471","#5c5e36","#1d3d33","#fc8526"],
			}],
		},
		options:{
			maintainAspectRatio: false,
			responsive: true,
			legend: {
				display: false,
			},
			animation: {
				animateScale: true,
				animateRotate: true
			}
		}
	});

});

$(function () {
	'use strict';
	var ctx2 = document.getElementById('ChartPaquetesTotal').getContext('2d');
	new Chart(ctx2, {
		type: 'bar',
		data: {
            labels: [<?php foreach($cantidadDinero as $reservas)
                    {echo '"'.$reservas->usuario.'",';} ?>],
            datasets: [
            {
                label:"Soles",
                backgroundColor: ["#68da3e","#00c6ab","#6aa3b4","#416864","#223026","#ebb7ce","#b38471","#5c5e36","#1d3d33","#fc8526"],
                data: [<?php foreach($cantidadDinero as $reservas)
                    {echo $reservas->total_soles.',';} ?>]
            },
            {
                label:"Dolares",
                backgroundColor: ["#00c6ab","#6aa3b4","#416864","#223026","#ebb7ce","#b38471","#5c5e36","#1d3d33","#fc8526"],
                data: [<?php foreach($cantidadDinero as $reservas)
                    {echo $reservas->total_dolares.',';} ?>]
            }]
		},
		options: {
			maintainAspectRatio: false,
			responsive: true,
			legend: {
				display: false,
				labels: {
					display: false
				}
			},
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true,
						fontSize: 10,
						fontColor: "rgba(171, 167, 167,0.9)",
					},
					gridLines: {
						display: true,
						color: 'rgba(171, 167, 167,0.2)',
						drawBorder: false
					},
				}],
				xAxes: [{
					barPercentage: 0.6,
					ticks: {
						beginAtZero: true,
						fontSize: 11,
						fontColor: "rgba(171, 167, 167,0.9)",
					},
					gridLines: {
						display: true,
						color: 'rgba(171, 167, 167,0.2)',
						drawBorder: false
					},
				}]
			}
		}
	});
});
</script>

@endpush
