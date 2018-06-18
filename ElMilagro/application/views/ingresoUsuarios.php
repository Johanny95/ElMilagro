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
				<h3 class="box-title"><i class="fa fa-user"></i> Mantenedor usuarios</h3>
				<div class="box-tools pull-right">
					<a href="javascript:history.back()" class="btn btn-box-tool pull-right"><i class="fa fa-reply pull-left"></i>Volver Atrás</a>
				</div>
			</div>
			
			<div class="box-body">
				<div class="container-fluid">
					<div class="row">
						<form method='POST' enctype="multipart/form-data" action="<?php echo site_url();?>/addUsuario" id="formUsuario">
							<div class="col-md-4 well well-sm">
								<div class="col-md-12">
									<h4><b>Datos usuario</b></h4>
									<div class="form-group">
										<label>Rut Usuario</label>
										<input type="input" class="form-control" id="rutUsuario" name="rutUsuario" maxlength="9">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Nombres</label>
										<input type="input" name="nombre" class="form-control" >
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Apellidos</label>
										<input type="input" name='apellido' class="form-control" >
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Fecha de nacimiento:</label>
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" readonly="true" name="fechaNacimiento" class="form-control pull-right" id="datepicker">
										</div>
										<!-- /.input group -->
									</div>
								</div><!--2416-->
								<div class="col-md-6">
									<div class="form-group">
										<label>Rol usuario</label>
										<select class="form-control" name="rolUsuario">
											<option disabled selected>Seleccionar rol</option>
											<?php foreach ($roles as $key): ?>
												<option value="<?php echo $key->ID_ROL?>"><?php echo $key->NOMBRE_ROL?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Dirección</label>
										<input type="input" class="form-control" name="direccion">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Teléfono</label>
										<input type="number" class="form-control" name="telefono">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Correo Electrónico</label>
										<input type="mail" class="form-control" name="correo">
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
								<h4><b>Lista de usuarios</b></h4>
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
												<input id='buscar' type="text" class="form-control" placeholder="Ej: panel 2x2">
												<span class="input-group-addon"><i class="fa fa-search"></i></span>
											</div>
										</div>
									</div>
								</div>
								<div class="row table-responsive no-left-right-margin">
									<div class="col-xs-12">
										<table class="display table table-bordered table-hover" id="tablaUsuarios" style="width: 100%;">
											<thead>
												<tr class="btn-primary">
													<td>Rut</td>
													<td>Nombre</td>
													<td>Rol</td>
													<td>Telefono</td>
													<td>Correo</td>
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


	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
	$(function(){
		
		$('.date').datepicker({
			autoclose: true,
			format: "dd-mm-yyyy",
			language: "es",
			todayHighlight: true
		});
		$('body').on('focusout','#rutUsuario',function(e){
			this.value = $.rut.formatear(this.value);
		});

	})
</script>

<script type="text/javascript">
	$(function(){
		$('body').on('click','#btAceptar',function(e){
			var rut = $.rut.formatear($('#rutUsuario').val());
			$('#rutUsuario').val(rut);
			if($.rut.validar(rut)){
				var url            = $('#formUsuario').attr('action');
				var formulario     = new FormData(document.getElementById("formUsuario"));				
					$.ajax({
						url: url,
						type: 'POST',
						dataType: 'json',
						data: formulario,
						processData: false,
						contentType: false,
						cache: false,
						async: false
					}).done(function(data){
						if(data.status){
							em_notify('Registrado','El usuario ha sido registrado con exito','success');
							 $('#formUsuario')[0].reset();
							 cargarlistaUsuarios();
						}else{
							em_notify('Error',data.error,'danger');
						}
					});
			}else{
				em_notify('Error','Rut no valido','danger');
			}
		})

		cargarlistaUsuarios();


	})

	function cargarlistaUsuarios(){
		$.post(ruta+'getListadoUsuarios', function(data) {
			var t = $('#tablaUsuarios').DataTable();
			t.clear();
			$.each(data, function (i, obj) {
				t.row.add( [
					obj.RUT_USUARIO,
					obj.NOMBRE,
					obj.NOMBRE_ROL,
					obj.TELEFONO,
					obj.CORREO,
					'<button class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Modificar"><i class="fa fa-edit"></i></button>'
					] ).draw( true );
			});
		},'json');
	}
</script>


<script type="text/javascript">
	$(function(){
		var t = $('#tablaUsuarios').DataTable({
			"paging" : true,
			"ordering" : true,
			"info" : true,
			"autoWidth" : false,
			"iDisplayLength": -1,
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
			jQuery("#tablaUsuarios_length").addClass('hidden');
			jQuery("#tablaUsuarios_filter").addClass('hidden');
		});

		$('#buscar').keyup(function(){
			t.search($(this).val()).draw() ;
		});
		$('#show_record').click(function() {
			t.page.len($('#show_record').val()).draw();
			jQuery("#footer-left").text(jQuery("#tablaUsuarios_info").text());
		});
		
		
	})
</script>