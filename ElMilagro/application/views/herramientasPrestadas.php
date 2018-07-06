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
				<h3 class="box-title"><i class="fa fa-user"></i> Herramientas prestadas</h3>
				<div class="box-tools pull-right">
					<a href="javascript:history.back()" class="btn btn-box-tool pull-right"><i class="fa fa-reply pull-left"></i>Volver Atrás</a>
				</div>
			</div>
			
			<div class="box-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
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
										<table class="display table table-bordered table-hover" id="tablaHerramientasPrestadas" style="width: 100%;">
											<thead>
												<tr class="btn-primary">
													<td>Código</td>
													<td>Jefe de obra</td>
													<td>Herramienta</td>
													<td>Cantidad</td>
													<td>Fecha</td>
													<td>Estado</td>
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

		<div id="modalEntregar" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header bg-primary">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Entregar herramienta</h4>
					</div>
					<div class="modal-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="jefeObra">Jefe de obra</label>
										<input type="input" class="form-control"  maxlength="20" id="jefeObra" readonly="true">
									</div>
								</div>
								<div class="col-md-12 hide">
									<input type="input" class="form-control"  maxlength="20" id="codigoHU" readonly="true">
								</div>
								<div class="col-md-12 hide">
									<input type="input" class="form-control"  maxlength="20" id="codigoH" readonly="true">
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="nombreH">Herramienta</label>
										<input type="input" class="form-control" id="nombreH" readonly="true">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="estadoH">Estado</label>
										<input type="input" class="form-control" id="estadoH" readonly="true">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="cantidadHP">Cantidad prestada</label>
										<input type="number" class="form-control" id="cantidadHP" readonly="true">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="cantidadHD">Cantidad a devolver</label>
										<input type="number" class="form-control" id="cantidadHD" min="1">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="pull-left">
							<button type="button" id="btEntregar" class="btn btn-primary">Entregar</button>	
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
	cargarlistaHerramientaPrestadas();

	$("#btEntregar").on('click',function(){
		entregarHerramienta();
		cargarlistaHerramientaPrestadas();
	});
	$(function(){
		var t = $('#tablaHerramientasPrestadas').DataTable({
			"paging" : true,
			"ordering" : true,
			"info" : true,
			"autoWidth" : false,
			"iDisplayLength": 10,
			"columnDefs": [
			{ targets: 'no-sort', orderable: false },
			{ className: "text-center", "targets": [6]}
			],"createdRow": function ( row, data, index ) {
				if ( data[5] == 'ENTREGADO' ) {
					$('td',row).eq(5).empty();
					$('td',row).eq(5).append("<span class='label label-success center-block lead'>"+data[5]+"</span>");
				}else if ( data[5] == 'PENDIENTE' ) {
					$('td',row).eq(5).empty();
					$('td',row).eq(5).append("<span class='label label-warning center-block lead'>"+data[5]+"</span>");
				}
			},
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
			jQuery("#tablaHerramientasPrestadas_length").addClass('hidden');
			jQuery("#tablaHerramientasPrestadas_filter").addClass('hidden');
		});

		$('#tablaHerramientasPrestadas tbody').on( 'click', 'button', function () {
			var jefeObra = $(this).parents("tr").find("td").eq(1).text();
			var nombreH = $(this).parents("tr").find("td").eq(2).text();
			var cantidadHP = $(this).parents("tr").find("td").eq(3).text();
			var estadoH = $(this).parents("tr").find("td").eq(5).text();
			var codigoHU = $(this).parents("tr").find("td").eq(0).text();
			$("#codigoHU").val(codigoHU);
			$("#codigoH").val(this.value);
			$("#cantidadHD").val(1);
			$("#jefeObra").val(jefeObra);
			$("#estadoH").val(estadoH);
			$("#nombreH").val(nombreH);
			$("#cantidadHP").val(cantidadHP);
			$("#cantidadHD").attr('max',cantidadHP);
			$('#modalEntregar').modal('show');
		});

		$('#buscar').keyup(function(){
			t.search($(this).val()).draw() ;
		});
		$('#show_record').click(function() {
			t.page.len($('#show_record').val()).draw();
			jQuery("#footer-left").text(jQuery("#tablaHerramientasPrestadas_info").text());
		});
	})
</script>