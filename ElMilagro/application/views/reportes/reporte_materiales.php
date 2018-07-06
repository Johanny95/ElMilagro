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
				<h3 class="box-title"><i class="fa fa-users"></i> Reporte materiales por beneficiarios</h3>
				<div class="box-tools pull-right">
					<a href="javascript:history.back()" class="btn btn-box-tool pull-right"><i class="fa fa-reply pull-left"></i>Volver Atrás</a>
				</div>
			</div>			
			<div class="box-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="stockEntrada">Proyecto</label>
								<select id='proyectos' class="form-control select2" style="width: 100%;">
									<option>Seleccionar proyecto</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="stockEntrada">Beneficiario</label>
								<select id='beneficiario' class="form-control"  style="width: 100%;">
									<option>Seleccionar beneficiario</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label >Generar listado</label>
								<button type="button" id="btBuscar" class="btn btn-block btn-success">Aceptar</button>
							</div>
						</div>
					</div>
					<div class="row table-responsive no-left-right-margin hidden" id="divReporte">
						<div class="col-xs-12">
							<table class="display table table-bordered table-hover" id="tablaReporte" style="width: 100%;">
								<thead>
									<tr class="btn-primary">
										<td>Código</td>
										<td>Material</td>
										<td>Total</td>
										<td>Retirado por</td>
									</tr>
								</thead>
								<tbody id="tbodyBeneficiario">

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
		$('#proyectos').select2();
		$('#beneficiario').select2();
		cargarProyectoSelect();
		$('body').on('change','#proyectos',function(e){
			cargarBeneficiarios();
		});

		$('body').on('click','#btBuscar',function(e){
			var proyecto 	 = $('#proyectos').val();
			var beneficiario = $('#beneficiario').val()
			reporteMaterialesBeneficiario(proyecto,beneficiario);	
		});

		

		
	})

</script>

<script type="text/javascript">
	$(function(){
		var t = $('#tablaReporte').DataTable({
			"paging" : true,
			"ordering" : true,
			"info" : true,
			"autoWidth" : false,
			"iDisplayLength": 5,
			dom: 'Bfrtip',
			buttons: [
			'excel', 'print'
			],
			"columnDefs": [
			{ targets: 'no-sort', orderable: false }
			//{ className: "text-center", "targets": [5]},
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
			jQuery("#tablaReporte_length").addClass('hidden');
			jQuery("#tablaReporte_filter").addClass('hidden');
		});

		$('#buscar').keyup(function(){
			t.search($(this).val()).draw() ;
		});
		$('#show_record').click(function() {
			t.page.len($('#show_record').val()).draw();
			jQuery("#footer-left").text(jQuery("#tablaReporte_info").text());
		});
		
		
	})
</script>