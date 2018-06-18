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
				<h3 class="box-title"><i class="fa fa-bar-chart-o"></i> Visualizar stock</h3>
				<div class="box-tools pull-right">
					<a href="javascript:history.back()" class="btn btn-box-tool pull-right"><i class="fa fa-reply pull-left"></i>Volver Atrás</a>
				</div>
			</div>
			
			<div class="box-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-2">
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
						<div class="col-sm-3">
							<div class="form-group">
								<label>Buscar</label>
								<div class="input-group">
									<input id='buscar' type="text" class="form-control" placeholder="Ej: Panel 2 x 2">
									<span class="input-group-addon"><i class="fa fa-search"></i></span>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<label>Filtro por fecha:</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right" id="datepicker">
								</div>
								<!-- /.input group -->
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<label>Filtro por estado</label>
								<select id="selectEstado" class="form-control select">	
									<option value="" selected>Ver todo</option>
									<option value="Crítico">Crítico</option>
									<option value="Bajo">Bajo</option>
									<option value="Alto">Alto</option>
								</select>
							</div>
						</div>
						

					</div>

					<div class="row table-responsive no-left-right-margin">
						<div class="col-xs-12">
							<table class="display table table-bordered table-hover" id="tablaStock" style="width: 100%;">
								<thead>
									<tr class="btn-primary">
										<td>Código</td>
										<td>Nombre</td>
										<td>stock</td>
										<td>Ingresado por</td>
										<td>Nivel Stock</td>
										<td>primer ingreso</td>
										<td>Ultimo ingreso</td>
										<td>Acción</td>
									</tr>
								</thead>
								<tbody id="tbodyPedido">
									<?php foreach ($materiales as $key): ?>
										<tr>
											<td><?php print $key->ID_RECURSO ?></td>
											<td><?php print $key->NOMBRE ?></td>
											<td><?php print $key->STOCK.' '.$key->TIPO_STOCK ?></td>
											<td><?php print $key->USUARIO ?></td>
											<td><?php print $key->ESTADO ?></td>
											<td><?php print $key->CREACION ?></td>
											<td><?php print $key->MODIFICACION ?></td>
											<td><button class="btn btn-sm"></button></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
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

<script type="text/javascript">
	$(function(){
		$('.date').datepicker({
			autoclose: true,
			format: "yyyy-mm-dd",
			language: "es",
			todayHighlight: true
		});

		var t = $('#tablaStock').DataTable({
			"paging"     : true,
			"ordering"   : true,
			"order": [[ 4, "desc" ]],
			"order": [[ 2, "asc" ]],
			"info"       : true,
			"autoWidth"  : true,
			"iDisplayLength": 20, 
			dom: 'Bfrtip',
			buttons: [
			'excel', 'print'
			],
			"columnDefs" : [
			{ targets    : 'no-sort'     , orderable: false        },
			{ className  : "dt-nowrap"   , "targets": [0,1]        },
			{className   : "text-center"  , "targets": [6]},
//			{className   : "text-right"  , "targets": [2]},
			{ targets: 'no-sort', orderable: false }
			], 
			"createdRow": function ( row, data, index ) {
				if ( data[4] == 'Crítico' ) {
					$('td',row).eq(4).empty();
					$('td',row).eq(4).append("<span class='label label-danger center-block lead'>"+data[4]+"</span>");
				}else if ( data[4] == 'Alto' ) {
					$('td',row).eq(4).empty();
					$('td',row).eq(4).append("<span class='label label-success center-block lead'>"+data[4]+"</span>");
				}else if ( data[4] == 'Bajo' ) {
					$('td',row).eq(4).empty();
					$('td',row).eq(4).append("<span class='label label-warning center-block lead'>"+data[4]+"</span>");
				}
			},  
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por página",
				"zeroRecords": "Busqueda no encontrada",
				"info": "Página _PAGE_ de _PAGES_",
				"infoEmpty": "Busqueda",
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
			jQuery("#tablaStock_length").addClass('hidden');
			jQuery("#tablaStock_filter").addClass('hidden');
			jQuery("#tablaStock_info").addClass('hidden');
			jQuery("#footer-left").text(jQuery("#tablaStock_info").text());
			jQuery("#tablaStock_paginate").appendTo(jQuery("#footer-right"));
		});

		$('#buscar').keyup(function(){
			t.search($(this).val()+' '+$('#selectEstado').val()+' '+$('#datepicker').val()).draw() ;
		});
		$('#show_record').change(function() {
			t.page.len($('#show_record').val()).draw();
			jQuery("#footer-left").text(jQuery("#tablaStock_info").text());
		});

		$('#selectEstado').change(function(){
			t.search($(this).val()+' '+$('#buscar').val()+' '+$('#datepicker').val()).draw() ;
		});

		$('#datepicker').change(function(){
			t.search($(this).val()+' '+$('#buscar').val()+' '+$('#selectEstado').val()).draw() ;
		});




	})
</script>