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
				<h3 class="box-title"><i class="fa fa-wrench"></i> Mantenedor herramientas</h3>
				<div class="box-tools pull-right">
					<a href="javascript:history.back()" class="btn btn-box-tool pull-right"><i class="fa fa-reply pull-left"></i>Volver Atrás</a>
				</div>
			</div>
			
			<div class="box-body">
				<div class="container-fluid">
					<div class="row">
						<form method='POST' enctype="multipart/form-data" action="<?php echo site_url();?>/addUsuario" id="formHerramienta">
							<div class="col-md-4 well well-sm">
								<div class="col-md-12">
									<h4><b>Informacion de herramienta</b></h4>
									<div class="form-group">
										<label>Código</label>
										<input type="input" class="form-control" id="codigoHerramienta" placeholder="Escanear con pistola">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Nombre</label>
										<input type="input" class="form-control" id="nombreHerramienta" placeholder="Taladro, demoledor">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Descripción</label>
										<textarea id="descripcionHerramienta" class="form-control" placeholder="Taladro bauker"></textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Cantidad</label>
										<input type="number" id='cantidadHerramienta' class="form-control" min="1" placeholder="1234">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<button type="button" id='btAceptar' class="btn btn-primary btn-block">Ingresar</button>
									</div>
								</div>
							</div>
						</form>
						<div class="col-md-8">
							<div class="container-fluid">
								<h4><b>Lista de herramientas</b></h4>
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label>Mostrar</label>
											<select id="show_record" class="form-control">	
												<option value="10">10 registros</option>
												<option value="25">25 registros</option>
												<option value="50">50 registros</option>
												<option value="100">100 registros</option>
												<option value="-1">Todos los registros</option>
											</select>
										</div>
									</div>
									<div class="pull-right col-md-6">
										<div class="form-group">
											<label>Buscar</label>
											<div class="input-group">
												<input id='buscar' type="text" class="form-control" placeholder="Ej: Taladro">
												<span class="input-group-addon"><i class="fa fa-search"></i></span>
											</div>
										</div>
									</div>
								</div>
								<div class="row table-responsive no-left-right-margin">
									<div class="col-xs-12">
										<table class="display table table-bordered table-hover" id="tablaHerramienta" style="width: 100%;">
											<thead>
												<tr class="btn-primary">
													<td>Código</td>
													<td>Nombre</td>
													<td>Descrición</td>
													<td>Stock</td>
													<td>Estado</td>
													<td>Acción</td>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
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

		<div id="modalAgregar" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header bg-primary">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Modificar herramienta</h4>
					</div>
					<div class="modal-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="codigoH">Código</label>
										<input type="input" class="form-control"  maxlength="20" id="codigoH" readonly="true">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="nombreH">Nombre</label>
										<input type="input" class="form-control" id="nombreH">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Descripción</label>
										<textarea id="descripcionH" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="pull-left">
							<button type="button" id="btEditar" class="btn btn-primary">Modificar</button>	
						</div>
						<div class="pull-left">
							<button type="button" id="btEliminar" class="btn btn-danger">Eliminar</button>	
						</div>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</div>
				</div>
			</div>
		</div>

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
	$(function(){
		$('body').on('click','#btAceptar',function(e){
			addHerramienta();
			cargarlistaHerramienta();
		});
		cargarlistaHerramienta();
	});
	$("#btEditar").on('click',function(){
		modificarHerramienta();
		
	});
</script>


<script type="text/javascript">
	$(function(){
		var t = $('#tablaHerramienta').DataTable({
			"paging" : true,
			"ordering" : true,
			"info" : true,
			"autoWidth" : false,
			"iDisplayLength": 10,
			"columnDefs": [
			{ targets: 'no-sort', orderable: false },
			{ className: "text-center", "targets": [5]},
			
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
			jQuery("#tablaHerramienta_length").addClass('hidden');
			jQuery("#tablaHerramienta_filter").addClass('hidden');
		});

		$('#tablaHerramienta tbody').on( 'click', 'button', function () {
			var codigo = $(this).parents("tr").find("td").eq(0).text();
			var nombre = $(this).parents("tr").find("td").eq(1).text();
			var descripcion = $(this).parents("tr").find("td").eq(2).text();
			$("#codigoH").val(codigo);
			$("#nombreH").val(nombre);
			$("#descripcionH").val(descripcion);
			$('#modalAgregar').modal('show');
		});
		$('#show_record').click(function() {
			t.page.len($('#show_record').val()).draw();
			jQuery("#footer-left").text(jQuery("#tablaHerramienta_info").text());
		});
		$('#buscar').keyup(function(){
			t.search($(this).val()).draw() ;
		});
	});

	
	

</script>