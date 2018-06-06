<?php $usuario = $this->session->userdata('usuario')?>
<!-- Content Wrapper. Contains page content -->

<style type="text/css" media="screen">
.imgslide{width: 500px;height: 1200px;}
</style>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		
	</section>
	
	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-list"></i> Ménu de actvidades</h3>
				<div class="box-tools pull-right">
					
				</div>
				<div class="box-body"><br/>
					
					<!--AGREGAR HERRAMIENTAS, SALIDA, AGREGAR USUARIOS, VER DISPONIBILIDAD-->
					<?php if($usuario[0]->ID_ROL == 1 || $usuario[0]->ID_ROL == 2){?>
					<div class="row">
						<h4 class='col-md-12'><i class="fa fa-cube"></i> Materiales</h3>
							<div class=''>
								<div class="col-md-1 col-xs-4">
									<a class="btn btn-app" data-toggle="modal" data-target="#modalAgregar">
										<i class="glyphicon glyphicon-plus"></i>Entrada
									</a>
								</div>
								<div class="col-md-1 col-xs-4">
									<a class="btn btn-app" id='btIngresarMaterial'>
										<i class="fa fa-truck"></i> Salida
									</a>
								</div>
							</div>
							<div class="col-md-1 col-xs-4">
								<a class="btn btn-app">
									<i class="fa fa-list-ol"></i> Stock
								</a>
							</div>
						</div>
						<div class="row">
							<h4 class='col-md-12'><i class="fa fa-wrench"></i> Herramientas</h3>
								<div class="col-md-1 col-xs-4">
									<a class="btn btn-app">
										<i class="fa fa-plus"></i> Entrada
									</a>
								</div>

								<div class="col-md-1 col-xs-4">
									<a class="btn btn-app">
										<i class="fa fa-truck"></i> Salida
									</a>
								</div>
							</div>
							<?php } ?><!--VALIDACION DE PERMISOS-->
							<?php if($usuario[0]->ID_ROL == 1 ){?>
							<div class="row">
								<h4 class='col-md-12'><i class="fa fa-user"></i> Usuarios</h3>
									<div class="col-md-1 col-xs-4">
										<a class="btn btn-app">
											<i class="fa fa-user-plus"></i> Usuarios
										</a>
									</div>
								</div>
								<?php }?>


							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<!--Footer-->
							</div>
							<!-- /.box-footer-->
						</div>
						<!-- /.box -->

					</section>
					<!-- /.content -->
				</div>


			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->


		<!-- Modal -->
		<div id="modalAgregar" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header bg-primary">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Ingreso de material</h4>
					</div>
					<div class="modal-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="entradaCodigo">Código</label>
										<input type="input" class="form-control" readonly="true" id="entradaCodigo" placeholder="Escanear con pistola">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="Nombre">Nombre</label>
										<input type="input" class="form-control" id="nombreEntrada" placeholder="Panel, pintura">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="tipo">Tipo stock </label>
										<select class="select form-control" id='tipoStock'>
											<option selected="true" disabled="true">Seleccionar</option>
											<option>Unidad</option>
											<option>Caja</option>
											<option>Kilo</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="stockEntrada">Cantidad Ingresada</label>
										<input type="number" class="form-control" id="stockEntrada">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="pull-left">
							<button type="button" id="aceptar" class="btn btn-primary" >Aceptar</button>	
						</div>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</div>
				</div>

			</div>
		</div>


<!-- Modal -->
		<div id="modalSalida" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header bg-red">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Salida de material</h4>
					</div>
					<div class="modal-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="entradaCodigo">Código</label>
										<input type="input" class="form-control" readonly="true" id="entradaCodigo" placeholder="Escanear con pistola">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="Nombre">Nombre</label>
										<input type="input" class="form-control" id="nombreEntrada" placeholder="Panel, pintura">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="tipo">Tipo stock </label>
										<select class="select form-control" id='tipoStock'>
											<option selected="true" disabled="true">Seleccionar</option>
											<option>Unidad</option>
											<option>Caja</option>
											<option>Kilo</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Stock disponible</label>
										<input type="number" class="form-control" readonly="true
										">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="stockEntrada">Cantidad solicitada</label>
										<input type="number" class="form-control" id="stockEntrada">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="stockEntrada">Jefe de obra</label>
										<br/>
										<select id='jefeDeObra' class="select2 form-control" style="width: 100%;">
											
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="stockEntrada">Proyecto</label>
										<select id='proyecto' class="form-control">
											
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="stockEntrada">Beneficiarío</label>
										<select id='Beneficiario' class="form-control">
											
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="pull-left">
							<button type="button" id="aceptar" class="btn btn-primary" >Aceptar</button>	
						</div>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</div>
				</div>

			</div>
		</div>



<script type="text/javascript">
	$(function(){
		
		$('body').on('click','#btIngresarMaterial',function(e){
			$('#modalSalida').modal('show');
			$('#jefeDeObra').select2();
			cargarSelectJefes('jefeDeObra');
		});
		

	});

</script>