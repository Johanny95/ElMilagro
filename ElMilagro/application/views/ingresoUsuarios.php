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
						<div class="col-sm-12">
							<div class="form-group">
								<label>Rut usuario</label>
								<input id='rut' name="rut" readonly type="text" class="form-control" >
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
								<label>Apellido</label>
								<input id='apellido' name="apellido" type="text" class="form-control" >
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Rol usuario</label>
								<select class="form-control" name="rol" id="rol">
									<option disabled selected>Seleccionar rol</option>
									<?php foreach ($roles as $key): ?>
										<option value="<?php echo $key->ID_ROL?>"><?php echo $key->NOMBRE_ROL?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label>Teléfono</label>
								<input id='telefono' name="telefono" type="text" class="form-control" >
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label>Correo</label>
								<input id='correo' name="correo" type="text" class="form-control" >
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label>Dirección</label>
								<input id='direccion' name="direccion" type="text" class="form-control" >
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
		
		$('.date').datepicker({
			autoclose: true,
			format: "dd-mm-yyyy",
			language: "es",
			todayHighlight: true
		});
		$('body').on('focusout','#rutUsuario',function(e){
			this.value = $.rut.formatear(this.value);
		});

		$('#tablaUsuarios tbody').on( 'click', '.edit', function () {
			var datos = this.value.split(',');
			$('#rut').val(datos[0]);
			$('#nombre').val(datos[1]);
			$('#apellido').val(datos[2]);
			$('#rol').append('<option selected value="'+datos[4]+'">'+datos[3]+'</option>');
			$('#telefono').val(datos[5]);
			$('#correo').val(datos[6]);
			$('#direccion').val(datos[7]);
			$('#modalEdit').modal('show');
		} );

		$('body').on('click','#btEditar',function(){
			var rut 		= $('#rut').val();
			var nombre 		= $('#nombre').val();
			var apellido 	= $('#apellido').val();
			var rol 		= $('#rol').val();
			var telefono 	= $('#telefono').val();
			var correo 	 	= $('#correo').val();
			var direccion 	= $('#direccion').val();
			editarUsuario(rut,nombre,apellido,rol,telefono,correo,direccion);
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
					obj.NOMBRE+' '+obj.APELLIDO,
					obj.NOMBRE_ROL,
					obj.TELEFONO,
					obj.CORREO,
					'<button class="btn btn-sm edit" value="'+obj.RUT_USUARIO+','+obj.NOMBRE+','+obj.APELLIDO+','+obj.NOMBRE_ROL+','+obj.ID_ROL+','+obj.TELEFONO+','+obj.CORREO+','+obj.DIRECCION+'" data-toggle="tooltip" data-placement="top" title="Modificar"><i class="fa fa-edit"></i></button>'
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
			"iDisplayLength": 5,
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