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
				<h3 class="box-title"><i class="fa fa-users"></i> Beneficiarios</h3>
				<div class="box-tools pull-right">
					<a href="javascript:history.back()" class="btn btn-box-tool pull-right"><i class="fa fa-reply pull-left"></i>Volver Atrás</a>
				</div>
			</div>
			<div class="box-body">
				<div class="col-md-4">
					<form id='formBeneficiario' Method='POST' enctype="multipart/form-data" action="<?php echo site_url();?>/addBeneficiario">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label>Rut beneficiario</label>
									<input type="text" class="form-control" id="rut" maxlength="9" name="rut">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label>Nombre beneficiario</label>
									<input type="text" class="form-control" name="nombre">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="stockEntrada">Proyecto</label>
									<select id='proyectos' name='proyecto' class="select2 form-control" style="width: 100%;">
									</select>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label>Dirección</label>
									<input type="text" class="form-control" name="direccion">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label>Teléfono</label>
									<input type="text" class="form-control" name="telefono">
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label for="documento">Adjuntar ficha</label>
									<input type="file" id="documento" name='documento'>
								</div>
							</div>
							<div class="col-sm-6">
								<button class="btn btn-primary" id="btAceptar" type="button"><i class="fa fa-send pull-left"></i>Agregar beneficiario</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-8">
					<div class="container-fluid">
						<h4><b>Lista de beneficiarios</b></h4>
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
									<label>Buscar beneficiario</label>
									<div class="input-group">
										<input id='buscar' type="text" class="form-control" placeholder="Ej: casa 2...">
										<span class="input-group-addon"><i class="fa fa-search"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="row table-responsive no-left-right-margin">
							<div class="col-xs-12">
								<table class="display table table-bordered table-hover" id="tablaBeneficiario" style="width: 100%;">
									<thead>
										<tr class="btn-primary">
											<td></td>
											<td>Código</td>
											<td>Nombre</td>
											<td>Rut</td>
											<td>Proyecto</td>
											<td>Contacto</td>
											<td>Acción</td>
										</tr>
									</thead>
									<tbody id="tbodyBeneficiario">

									</tbody>
								</table>
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
				<h4 class="modal-title" id="exampleModalLongTitle">Editar beneficiario</h4>
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
								<label>Código beneficiario</label>
								<input id='codigo' name="codigo" readonly type="text" class="form-control" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Rut beneficiario</label>
								<input id='rutEdit' readonly name="rutEdit" type="text" class="form-control" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Nombre</label>
								<input id='nombre' name="nombre" type="text" class="form-control" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Proyecto</label>
								<input id='proyecto' name="proyecto" readonly type="text" class="form-control" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Dirección</label>
								<input id='direccion' name="direccion" type="text" class="form-control" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Teléfono</label>
								<input id='telefono' name="telefono" type="text" class="form-control" >
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
		cargarProyectoSelect();
		cargarBeneficiariosTabla();
		$('#proyectos').select2();
		$('body').on('focusout','#rut',function(e){
			this.value = $.rut.formatear(this.value);
		});

		$('body').on('click','.edit',function(){
			var datos = this.value.split(',');
			$('#codigo').val(datos[0]);
			$('#rutEdit').val(datos[1]);
			$('#nombre').val(datos[2]);
			$('#proyecto').val(datos[5]);
			$('#direccion').val(datos[3]);
			$('#telefono').val(datos[4]);
			$('#modalEdit').modal('show');
		})

		$('body').on('click','#btEditar',function(){
			var codigo 		= $('#codigo').val();
			var nombre 		= $('#nombre').val();
			var direccion 	= $('#direccion').val();
			var telefono	= $('#telefono').val();
			editarBeneficiario(codigo,nombre,direccion,telefono);

		})
	})
</script>
<!--Ingreso de beneficiario-->
<script type="text/javascript">
	$(function(){
		$('body').on('click','#btAceptar',function(e){
			var rut = $.rut.formatear($('#rut').val());
			$('#rut').val(rut);
			if($.rut.validar(rut)){
				var url            = $('#formBeneficiario').attr('action');
				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'json',
					data: new FormData(document.getElementById("formBeneficiario")),
					processData: false,
					contentType: false,
					cache: false,
					async: false
				}).done(function(data){
					if(data.status){
						em_notify('Correctamente','Ingresado con exito','success');
						$('#formBeneficiario')[0].reset();
						cargarBeneficiariosTabla();
					}else{
						em_notify('Error',data.error,'danger');
					}
				}).fail(function(){
					alert('servidor');
				});
			}else{
				em_notify('Error','Rut no valido','danger');
			}
		})
	})

	
</script>

<script type="text/javascript">
	$(function(){
		var t = $('#tablaBeneficiario').DataTable({
			"paging" : true,
			"ordering" : true,
			"info" : true,
			"autoWidth" : false,
			"iDisplayLength": 5,
			"columnDefs": [
			{ targets: 'no-sort', orderable: false },
			{ className: "text-center", "targets": [0,6]}
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
			jQuery("#tablaBeneficiario_length").addClass('hidden');
			jQuery("#tablaBeneficiario_filter").addClass('hidden');
		});

		$('#buscar').keyup(function(){
			t.search($(this).val()).draw() ;
		});
		$('#show_record').click(function() {
			t.page.len($('#show_record').val()).draw();
			jQuery("#footer-left").text(jQuery("#tablaBeneficiario_info").text());
		});
		
		
	})
</script>