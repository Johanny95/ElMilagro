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
				<h3 class="box-title"><i class="fa fa-folder"></i> Proyectos</h3>
				<div class="box-tools pull-right">
					<a href="javascript:history.back()" class="btn btn-box-tool pull-right"><i class="fa fa-reply pull-left"></i>Volver Atrás</a>
				</div>
			</div>
			
			<div class="box-body">
				<div class="row">
					<div class="col-md-4">
						<form id='formProyecto' Method='POST' enctype="multipart/form-data">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Nombre proyecto</label>
										<input type="text" class="form-control" name="nombre">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="stockEntrada">Jefe de obra a cargo</label>
										<br/>
										<select id='jefeDeObra' name='jefeDeObra' class="select2 form-control" style="width: 100%;">
										</select>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<label>Descripción </label>
										<textarea class="form-control" rows="5" name="descripcion"></textarea>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group">
										<label for="documento">Adjuntar ficha</label>
										<input type="file" id="documento" name='documento'>
									</div>
								</div>
								<div class="col-sm-6">
									<button class="btn btn-primary" id="btAddProyecto" type="button"><i class="fa fa-send pull-left"></i>Agregar proyecto</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-8">
						<div class="container-fluid">
							<h4><b>Lista de proyectos</b></h4>
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
											<input id='buscar' type="text" class="form-control" placeholder="Ej: proyecto...">
											<span class="input-group-addon"><i class="fa fa-search"></i></span>
										</div>
									</div>
								</div>
							</div>
							<div class="row table-responsive no-left-right-margin">
								<div class="col-xs-12">
									<table class="display table table-bordered table-hover" id="tablaProyecto" style="width: 100%;">
										<thead>
											<tr class="btn-primary">
												<td></td>
												<td>Código</td>
												<td>Nombre</td>
												<td>Encargado</td>
												<td>Fecha Creación</td>
												<td>Acción</td>
											</tr>
										</thead>
										<tbody id="tbodyProyecto">

										</tbody>
									</table>
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


	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-blue">
				<h4 class="modal-title" id="exampleModalLongTitle">Editar usuario</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<!--Formulario modificar material-->
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Código</label>
								<input id='codigo' name="codigo" readonly type="text" class="form-control" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Nombre</label>
								<input id='nombre' name="nombre" type="text" class="form-control" >
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label>Descripción</label>
								<textarea class="form-control" rows="5" id='descripcion' name="descripcion"></textarea>
							</div>
						</div>
					</div>
					

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" id="btEditar" class="btn btn-primary">Guardar cambios</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$('#jefeDeObra').select2();
		cargarSelectJefes('jefeDeObra');

		$('body').on('click','.edit',function(){
			var datos = this.value.split(',');
			$('#codigo').val(datos[0]);
			$('#nombre').val(datos[1]);
			$('#descripcion').val(datos[2]);
			$('#modalEdit').modal('show');
		});

		$('body').on('click','#btEditar',function(){
			var codigo 		= $('#codigo').val();
			var nombre 		= $('#nombre').val();
			var descripcion = $('#descripcion').val();
			editarProyecto(codigo,nombre,descripcion);
		});

	})
</script>

<script type="text/javascript">
	$(function(){
		$('#btAddProyecto').click(function(){
			var url='<?php print site_url().'/addProyecto'?>';
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data: new FormData(document.getElementById("formProyecto")),
				processData: false,
				contentType: false,
				cache: false,
				async: false
			}).done(function(data){
				if(data.status){
					em_notify('Correctamente','Ingresado con exito','success');
					$('#formProyecto')[0].reset();
					cargarProyectosTabla();
				}else{
					em_notify('Error',data.error,'danger');
				}
			}).fail(function(){
				alert('servidor');
			});
		});
	})
</script>

<script type="text/javascript">
	$(function(){
		var t = $('#tablaProyecto').DataTable({
			"paging" : true,
			"ordering" : true,
			"info" : true,
			"autoWidth" : false,
			"iDisplayLength": 10,
			"columnDefs": [
			{ targets: 'no-sort', orderable: false },
			{ className: "text-center", "targets": [0,5]},
			
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
			jQuery("#tablaProyecto_length").addClass('hidden');
			jQuery("#tablaProyecto_filter").addClass('hidden');
		});

		$('#buscar').keyup(function(){
			t.search($(this).val()).draw() ;
		});
		$('#show_record').click(function() {
			t.page.len($('#show_record').val()).draw();
			jQuery("#footer-left").text(jQuery("#tablaProyecto_info").text());
		});
		
		
	})
</script>

<script type="text/javascript">
	$(function(){
		cargarProyectosTabla();
		$('#tablaProyecto tbody').on( 'click', 'button', function () {
			$('#modalDocumento').modal('show');
		} );

	})
</script>

