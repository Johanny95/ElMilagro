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
						<div class="col-md-5">
							<div class="col-md-12">
								<h4><b>Datos usuario</b></h4>
								<div class="form-group">
									<label>Rut Usuario</label>
									<input type="input" class="form-control" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Nombres</label>
									<input type="input" class="form-control" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Apellidos</label>
									<input type="input" class="form-control" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Fecha de nacimiento:</label>
									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="text" readonly="true" class="form-control pull-right" id="datepicker">
									</div>
									<!-- /.input group -->
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Rol usuario</label>
									<select class="form-control">
										
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Dirección</label>
									<input type="input" class="form-control" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Teléfono</label>
									<input type="number" class="form-control" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Correo Electrónico</label>
									<input type="mail" class="form-control" >
								</div>
							</div>
						</div>
						<div class="col-md-7">
							
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
			format: "dd/mm/yyyy",
			language: "es",
			todayHighlight: true
		});

	})
</script>