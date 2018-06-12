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
									<a class="btn btn-app" id='btModalIn'>
										<i class="glyphicon glyphicon-plus"></i>Entrada
									</a>
								</div>
								<div class="col-md-1 col-xs-4">
									<a class="btn btn-app" href="<?php print site_url()?>/salidaMaterial" >
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
										<a class="btn btn-app" href="<?php print site_url()?>/ingresoPersonal" >
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
										<input type="number" class="form-control"  maxlength="20" id="entradaCodigo" placeholder="Escanear con pistola">
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
										<select class="select form-control" id='tipoStockEntrada'>
											<option value="0" selected="true" disabled="true">Seleccionar</option>
											<option value="1">Unidad</option>
											<option value="2">Caja</option>
											<option value="3">Kilo</option>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="stockEntrada">Cantidad</label>
										<input type="number" class="form-control" min="1" value="1" id="stockEntrada">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="stockEntrada">Más</label>
										<button class="btn btn-primary btn-block" id='masCantidad' type="button"><i class="fa fa-plus"></i></button>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="stockEntrada">Menos</label>
										<button class="btn btn-danger btn-block" id='menosCantidad' type="button" ><i class="fa fa-minus"></i></button>
									</div>
								</div>
								<div class="col-md-6 stockDiv hidden">
									<div class="form-group">
										<label for="stockEntrada">Stock en bodega</label>
										<input type="number" class="form-control" id="stockBodega">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="pull-left">
							<button type="button" id="btAgregar" class="btn btn-primary" >Aceptar</button>	
						</div>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</div>
				</div>

			</div>
		</div>


		


		<!--script para ingreso de materiales-->
		<script type="text/javascript">
			$(function(){

				$('body').on('click','#btModalIn',function(e){
					$('#entradaCodigo').val('').attr('autofocus',true);
					$('.stockDiv').removeClass('show').addClass('hidden');
					$('#nombreEntrada').val('').attr('readonly', false);
					$('#stockBodega').val('').attr('readonly', false);
					$('#tipoStockEntrada').attr('disabled',false);
					$('#modalAgregar').modal('show');
				})

				$('body').on('change','#entradaCodigo',function (e){
					buscarMaterial(this.value);
				});

				$('body').on('click','#btAgregar',function(e){
					e.preventDefault();
					ingresarMaterial();
				});

				$('body').on('click','#masCantidad',function (e){
					var cantidad = $('#stockEntrada').val();
					$('#stockEntrada').val(parseInt(cantidad)+1);
				});

				$('body').on('click','#menosCantidad',function (e){
					var cantidad = $('#stockEntrada').val();
					var num = parseInt(cantidad)-1;
					if(num >= 1){
						$('#stockEntrada').val(num);
					}
					
				});

			});
		</script>
		