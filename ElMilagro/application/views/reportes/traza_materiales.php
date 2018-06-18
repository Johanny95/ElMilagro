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
				<h3 class="box-title"><i class="fa fa-user"></i> Grafico materiales</h3>
				<div class="box-tools pull-right">
					<a href="javascript:history.back()" class="btn btn-box-tool pull-right"><i class="fa fa-reply pull-left"></i>Volver Atrás</a>
				</div>
			</div>
			
			<div class="box-body">
				<div class="container-fluid">
					<div class="col-md-4">
						<div class="form-group">
							<label>Materialez a visualizar</label>
							<select class="js-example-basic-multiple select2"  id="materiales" name="materiales[]" multiple="multiple" style="width: 100%;">
								<?php foreach ($materiales as $key => $v): ?>
									<option value="<?php echo $v->ID_RECURSO?>"><?php echo $v->NOMBRE?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label>Filtrar</label>
							<button type="button" class="btn btn-primary btn-block" id="btbuscar">Buscar<i class="pull-left fa fa-search"></i></button>	
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="box-body chart-responsive">
								<div class="chart" id="revenue-chart" style="height: 300px;"></div>
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

		



		$('body').on('click','#btbuscar',function(){
			var keys = [], material = [], muestra = [];
			var seleccionadorMateriales = $('#materiales').val();
			$.ajax({
				url: '<?php echo site_url()?>/getDataChart',
				type: 'POST',
				dataType: 'json',
				data : {'selectMaterial' : seleccionadorMateriales}
			}).done(function(data) {
				var fecha ='';
				var array = {};
				$.each(data.datos, function (i, obj) {
					if($.inArray(obj.ID_MATERIAL, keys) < 0){
					material.push(obj.NOMBRE);//nombres para labeles
					keys.push(obj.ID_MATERIAL);//da los codigos para agruparlos
				}
				if(fecha == ''){
					fecha 					= obj.FECHA;
					array['y']   			= obj.FECHA;
					array[obj.ID_MATERIAL] 	= obj.SUMA;
				}else if (fecha == obj.FECHA){
					array[obj.ID_MATERIAL]= obj.SUMA;
				}else{
					muestra.push(array);
					fecha = obj.FECHA;
					array = {};
					array['y']   			= obj.FECHA;
					array[obj.ID_MATERIAL] 	= obj.SUMA;
				}
			});
				var color = ['#a0d0e0', '#3c8dbc','#000000','#aaaaaa'];
				cargarChart(muestra,keys,material,color);
			});
		})
	})

	function cargarChart(datos,keys,label,color){
		var area = new Morris.Area({
			element: 'revenue-chart',
			resize: true,
			data: datos,
			xkey: 'y',
			ykeys: keys,
			labels: label,
			lineColors: color,
			hideHover: 'auto'
		});
	}
</script>
<script type="text/javascript">
	$(function(){
		$(document).ready(function() {
			$('.js-example-basic-multiple').select2();
		});
	})
</script>