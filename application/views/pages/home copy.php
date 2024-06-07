<div class="row">
	<div class="col-md-6 col-lg-3">
		<div class="card card-hover">
			<div class="card-body">
				<div class="media align-items-center">
					<div class="avatar avatar-icon avatar-lg avatar-orange">
						<i class="anticon anticon-tool"></i>
					</div>
					<div class="m-l-15">
						<h2 class="m-b-0"><?php echo $unfinished_projects; ?></h2>
						<p class="m-b-0 text-muted">Proyectos En Proceso</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-3">
		<div class="card card-hover">
			<div class="card-body">
				<div class="media align-items-center">
					<div class="avatar avatar-icon avatar-lg avatar-cyan">
						<i class="anticon anticon-check"></i>
					</div>
					<div class="m-l-15">
						<h2 class="m-b-0"><?php echo $finished_projects; ?></h2>
						<p class="m-b-0 text-muted">Proyectos Terminados</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-3">
		<div class="card card-hover">
			<div class="card-body">
				<div class="media align-items-center">
					<div class="avatar avatar-icon avatar-lg avatar-gold">
						<i class="anticon anticon anticon-solution"></i>
					</div>
					<div class="m-l-15">
						<h2 class="m-b-0"><?php echo $maintenance_projects ?></h2>
						<p class="m-b-0 text-muted">Mantenimiento</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-3">
		<div class="card card-hover">
			<div class="card-body">
				<div class="media align-items-center">
					<div class="avatar avatar-icon avatar-lg avatar-red">
						<i class="anticon anticon-setting"></i>
					</div>
					<div class="m-l-15">
						<h2 class="m-b-0"><?php echo $shop_projects ?></h2>
						<p class="m-b-0 text-muted">Taller</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-8 col-lg-8"><!--antes 8-->
		<div class="card sb-card-shadow">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-center mb-5">
					<h5 class="font-weight-bolder">Proyectos por mes.</h5>

					<div>
						<!--
						<div class="btn-group">
							<button class="btn btn-sm btn-dark">
								<span>Ver Reportes</span>
							</button>
						</div>
						-->
					</div>

				</div>

				<div class="chart-container" style="position: relative; width: 100%; height: auto">
					<canvas class="chart" id="andon-chart"></canvas>
				</div>
			</div>
		</div>
	</div>




	<div class="col-md-12 col-lg-4">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<h5 class="m-b-0">Proyectos mas recientes</h5>
					
				</div>
				<div class="m-t-30">
					<?php foreach ($recents as $recent): ?>
					<div class="m-b-25">
						<div class="d-flex align-items-center justify-content-between">
							<div class="media align-items-center">
								<div class="font-size-35">
									<i style="color:orange;" class="anticon anticon-tool"></i>
								</div>
								<div class="m-l-15">
									<h6 class="m-b-0">
										<a class="text-dark" href="javascript:void(0);"><?php echo $recent['project_name'] ?></a>
									</h6>
									<p class="text-muted m-b-0">Registrado: <?php echo date_format(date_create($recent['created_at']), "M-d-Y")  ?></p>
								</div>
							</div>
							<div class="dropdown dropdown-animated scale-left">
								<a class="text-gray font-size-18" href="javascript:void(0);" data-toggle="dropdown">
									<i class="anticon anticon-ellipsis"></i>
								</a>
								<div class="dropdown-menu">
									<a href="<?php echo base_url() ?>projects/show/<?php echo $recent['project_id'] ?>" class="dropdown-item" target="_blank">
										<i class="anticon anticon-eye"></i>
										<span class="m-l-10">Ver Proyecto</span>
									</a>
									<a href="<?php echo base_url() ?>workorders/update/<?php echo $recent['project_id'] ?>" class="dropdown-item" target="_blank">
										<i class="anticon anticon-file"></i>
										<span class="m-l-10">Orden De Trabajo</span>
									</a>
									<a href="<?php echo base_url() ?>workorders/print/<?php echo $recent['project_id'] ?>" class="dropdown-item" target="_blank">
										<i class="anticon anticon-printer"></i>
										<span class="m-l-10">Imprimir Orden De Trabajo</span>
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>

				</div>
			</div>
		</div>
</div>











	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


	<script>
		$(function(){
			//get the bar chart canvas
			var cData = JSON.parse(`<?php echo $chart_data; ?>`);
			var ctx = $("#andon-chart");


			//bar chart data
			/*
			var data = {
				labels: cData.label,
				datasets: [
					{
						label: "Proyectos.",
						data: cData.data,
						backgroundColor: [
							"rgba(0,210,146,0.5)",
							"rgba(0,210,146,0.5)",
							"rgba(0,210,146,0.5)",
							"rgba(0,210,146,0.5)",
							"rgba(0,210,146,0.5)",
							"rgba(0,210,146,0.5)",
							"rgba(0,210,146,0.5)",
							"rgba(0,210,146,0.5)",
							"rgba(0,210,146,0.5)",
							"rgba(0,210,146,0.5)",
							"rgba(0,210,146,0.5)",
						],
						borderColor: [
							"#00c085",
							"#00c085",
							"#00c085",
							"#00c085",
							"#00c085",
							"#00c085",
							"#00c085",
							"#00c085",
							"#00c085",
							"#00c085",
							"#00c085",
							"#00c085",
						],
						borderWidth: [1, 1, 1, 1, 1,1,1,1, 1, 1, 1,1,1]
					}
				]
			};
			*/

			var data = {
				labels: cData.label,
				datasets: [
					{
						label: "Mantenimiento",
						data: cData.data_m,
						backgroundColor: "rgba(0,210,146,0.5)",
						borderColor: "#00c085",
						borderWidth: 1
					},
					{
						label: "Taller",
						data: cData.data_t,
						backgroundColor: "rgba(210,0,0,0.5)",
						borderColor: "#c00000",
						borderWidth: 1
					}
				]
			};

			//options
			var options = {
				responsive: true,
				title: {
					display: false,
					position: "top",
					text: "Ideas por mes",
					fontSize: 18,
					fontColor: "#111"
				},
				legend: {
					display: false,
					position: "bottom",
					labels: {
						fontColor: "#333",
						fontSize: 12
					}
				},
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						},
						gridLines: {
							/*display: false ,*/
							drawBorder: false,
							offsetGridLines: false,
							drawTicks: false,
							borderDash: [3, 4],
							zeroLineWidth: 1,
							zeroLineBorderDash: [3, 4]
						},
					}],
					xAxes: [{
						gridLines: {
							display: false ,
							color: "#51ffcb"
						},
					}]
				},
			};

			//create bar Chart class object
			var chart1 = new Chart(ctx, {
				type: "bar",
				data: data,
				options: options
			});

		});


	</script>
