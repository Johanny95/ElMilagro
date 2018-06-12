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
					<a href="javascript:history.back()" class="btn btn-box-tool pull-right"><i class="fa fa-reply pull-left"></i>Volver Atrás</a>
				</div>
			</div>
			
			<div class="box-body">

				<div class="row">
					<div class="col-md-4">
						<div class="col-md-12 ">
							<div class="form-group">
								<label for="entradaCodigo">Código material</label>
								<input type="input" class="form-control" id="codigoSalida" placeholder="Escanear con pistola">
							</div>
						</div>
						<div class="hidden" id='divDetalle'>
							<div class="col-md-12">
								<h4><b>Detalle material</b></h4>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="Nombre">Nombre material</label>
									<input type="input" class="form-control" id="nombreEntrada" placeholder="Panel, pintura">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="tipo">Tipo stock </label>
									<select class="select form-control" id='tipoStockEntrada' style="width: 100%">
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
									<input type="number" class="form-control" id='stockBodega' readonly="true
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
								<button type="button" class="btn btn-primary" id="btAgregarPedido">Agregar al pedido</button>
							</div>
						</div>
					</div>

					<div class="col-md-8 hidden" id='divPedido'>
						<div class="box box-default" >
							<div class="box-header with-border">
								<h3 class="box-title"><b>Resumen pedido</b></h3>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Ingresar pedido</label>
											<button type="button" id="btModalOut" class="btn btn-success form-control"><i class="fa fa-mail-forward pull-left"></i>Ingresar pedido</button>
										</div>
									</div>
									<div class="pull-right col-md-6">
										<div class="form-group">
											<label>Buscar</label>
											<div class="input-group">
												<input id='buscar' type="text" class="form-control" placeholder="Ej: panel 2x2">
												<span class="input-group-addon"><i class="fa fa-search"></i></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="container-fluid">
								<div class="row table-responsive no-left-right-margin">
									<div class="col-xs-12">
										<table class="display table table-bordered table-hover" id="tablaPedido" style="width: 100%;">
											<thead>
												<tr class="btn-primary">
													<td>Código</td>
													<td>Nombre</td>
													<td>Cantidad</td>
													<td>Medida</td>
													<td>Acción</td>
												</tr>
											</thead>
											<tbody id="tbodyPedido">
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer no-padding">

						</div>
						<!-- /.footer -->
					</div>


				</div>

			</div>

		</div>
		<!-- /.box-body -->
		<div class="box-footer">
			<!--Footer-->
		</div>
		<!-- /.box-footer-->
		<!-- /.content -->
	</div>


</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!-- Modal salida material -->
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
								<label for="stockEntrada">Jefe de obra</label>
								<br/>
								<select id='jefeDeObra' class="select2 form-control" style="width: 100%;">

								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="stockEntrada">Proyecto</label>
								<select id='proyectos' class="form-control select2" style="width: 100%;">
									<option>Seleccionar proyecto</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="stockEntrada">Beneficiario</label>
								<select id='beneficiario' class="form-control"  style="width: 100%;">
									<option>Seleccionar beneficiario</option>
								</select>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="pull-left">
					<button type="button" id="btAceptarPedido" class="btn btn-primary" >Aceptar</button>	
				</div>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
		</div>

	</div>
</div>



<script type="text/javascript">
	$(function(){
		document.getElementById("codigoSalida").focus();

		$('body').on('click','#btModalOut',function(e){
			$('#modalSalida').modal('show');
			$('#jefeDeObra').select2();
			$('#proyectos').select2();
			$('#beneficiario').select2();
			cargarSelectJefes('jefeDeObra');
		});

		$('body').on('change','#jefeDeObra',function(e){
			cargarProyectosJefeobra();
		});

		$('body').on('change','#proyectos',function(e){
			cargarBeneficiarios();
		});

		$('body').on('change','#codigoSalida',function(e){
			buscarMaterial($('#codigoSalida').val());
			$('#divDetalle').removeClass('hidden').addClass('show');
		});

		$('body').on('click','#btAceptarPedido',function(e){
			insertarPedido();
		});
	

		$('#tablaPedido tbody').on( 'click', 'button', function () {
			var table = $('#tablaPedido').DataTable();
			table
			.row( $(this).parents('tr') )
			.remove()
			.draw();
		} );


	})
</script>

<script type="text/javascript">
	$(function(){
		var t = $('#tablaPedido').DataTable({
			"paging" : true,
			"ordering" : true,
			"info" : true,
			"autoWidth" : false,
			"iDisplayLength": -1,
			"columnDefs": [
			{ targets: 'no-sort', orderable: false },
			{ className: "text-right", "targets": [2]},
			{ className: "text-center", "targets": [4]}
			//{ "width": "5%", "targets":  0 }
			],
			"paging": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": true,
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por página",
				"zeroRecords": "Busqueda no encontrada",
				"info": "Página _PAGE_ de _PAGES_",
				"infoEmpty": "",
				"infoFiltered": "(entre _MAX_ registro totales)",
				"sLoadingRecords": "Cargando...",        
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				}, 
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			}
		});
		jQuery("#footer").ready(function(){
			jQuery("#tablaPedido_length").addClass('hidden');
			jQuery("#tablaPedido_filter").addClass('hidden');
		});

		$('#buscar').keyup(function(){
			t.search($(this).val()).draw() ;
		});
		$('#show_record').click(function() {
			t.page.len($('#show_record').val()).draw();
			jQuery("#footer-left").text(jQuery("#tablaPedido_info").text());
		});

		$('body').on('click','#btAgregarPedido',function(e){
			agregarAlPedido();
		})
		
	})
</script>