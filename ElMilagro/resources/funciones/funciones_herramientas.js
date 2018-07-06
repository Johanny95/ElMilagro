var ruta = 'http://localhost/ElMilagro/index.php/';

function addHerramienta(){
	var codigo 		= $('#codigoHerramienta').val();
	var nombre 		= $('#nombreHerramienta').val();
	var cantidad 	= $('#cantidadHerramienta').val();
	var descripcion	= $('#descripcionHerramienta').val();
	$.ajax({
		url: ruta+'addHerramienta',
		type: 'POST',
		dataType: 'JSON',
		data: {	codigo : codigo, nombre: nombre, cantidad: cantidad,descripcion: descripcion},
	}).done(function(data) { 
		if(data.status){
			$('#formHerramienta')[0].reset();
			em_notify('Agregado','Agregado con exito','success');
		}else{
			em_notify('Error',data.error,'danger');
		}
	});
}

function modificarHerramienta(){
	var codigo 		= $('#codigoH').val();
	var nombre 		= $('#nombreH').val();
	var descripcion	= $('#descripcionH').val();
	$.ajax({
		url: ruta+'modificarHerramienta',
		type: 'POST',
		dataType: 'JSON',
		data: {	codigo : codigo, nombre: nombre,descripcion: descripcion},
	}).done(function(data) {
		if(data.status){
			em_notify('Modificada','Modificada con exito','success');
			$('#modalAgregar').modal('hide');
			cargarlistaHerramienta();
		}else{
			em_notify('Error',data.error,'danger');
		}
	});
}

function cargarlistaHerramienta(){
	$.post(ruta+'getListadoHerramienta', function(data) {
		var t = $('#tablaHerramienta').DataTable();
		t.clear();
		$.each(data, function (i, obj) {
			t.row.add( [
				obj.CODIGO,
				obj.NOMBRE,
				obj.DESCRIPCION,
				obj.STOCK,
				obj.ESTADO,
				'<button class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Modificar"><i class="fa fa-edit"></i></button>'
				] ).draw( true );
		});
	},'json');
}

function cargarlistaHerramientaPrestadas(){
	$.post(ruta+'getListadoHerramientaPrestadas', function(data) {
		var t = $('#tablaHerramientasPrestadas').DataTable();
		t.clear();
		$.each(data, function (i, obj) {
			t.row.add( [
				obj.CODIGO,
				obj.NOMBRE,
				obj.HERRAMIENTA,
				obj.CANTIDAD,
				obj.FECHA,
				obj.ESTADO,
				'<button class="btn btn-sm entregar" value="'+obj.CODIGO_HERRAMIENTA+'" data-toggle="tooltip" data-placement="top" title="Entregar"><i class="fa fa-edit"></i></button>',
				] ).draw( true );
		});
	},'json');
}

function buscarHerramienta(){
	var codigo = $('#codigoSalida').val();
	$.ajax({
		url: ruta+'buscarHerramienta',
		type: 'POST',
		dataType: 'JSON',
		data: {	codigo : codigo},
	}).done(function(data) {
		return data.herramienta[0];
	});
}

function buscarHerramientaSalida(codigo){
	$.ajax({
		url: ruta+'buscarHerramienta',
		type: 'POST',
		dataType: 'JSON',
		data: {	codigo: codigo },
	}).done(function(data) {
		if(data.status){
			$('#nombreEntrada').val(data.herramienta[0].NOMBRE_HERRAMIENTA).attr('readonly', true);
			$('#stockBodega').val(data.herramienta[0].CANTIDAD).attr('readonly', true);
			$('#stockEntrada').val(1);
			document.getElementById("stockEntrada").focus();
		}else{
			em_notify('Informativo',data.error,'info');
			$('#divDetalle').removeClass('show').addClass('hidden');
			document.getElementById("codigoSalida").focus();
		}
	});
}

function agregarAlPedidoH(){
	var codigo = $('#codigoSalida').val();
	$.ajax({
		url: ruta+'buscarHerramienta',
		type: 'POST',
		dataType: 'JSON',
		data: {	codigo : codigo},
	}).done(function(data) {
		var nombre 		= $('#nombreEntrada').val();
		var cantidad 	= parseInt($('#stockEntrada').val());
		var stock       = parseInt($('#stockBodega').val());
		var estado = data.herramienta[0].ESTADO;
		var t = $('#tablaPedidoH').DataTable();
		if(codigo != '' && nombre != ''){
			if(cantidad >= 0){
				if(cantidad <= stock){
					var rowCount = $('#tbodyPedidoH tr').length;
					t.row.add( [
						codigo,
						nombre,
						cantidad,
						estado,
						'<button class="btn btn-sm delete bg-red" data-toggle="tooltip" data-placement="top" title="Eliminar" id="btMaterial'+rowCount+'"><i class="fa fa-trash"></i></button>'
						] ).draw( true );
					$('#divPedido').removeClass('hidden').addClass('show');
					$('#divDetalle').removeClass('show').addClass('hidden');
					$('#codigoSalida').val('');
					document.getElementById("codigoSalida").focus();
					$('[data-toggle="tooltip"]').tooltip();
				}else{
					em_notify('Stock insuficiente','La cantidad no debe ser mayor al stock en bodega','danger');
				}
			}else{
				em_notify('Dato no valido','Digite una cantidad correcta','danger');	
			}
		}else{
			em_notify('Datos no validos','Ingrese datos porfavor...','danger');
		}
	});
}


function entregarHerramienta(){
	var jefeDeObra 	= $('#jefeObra').val();
	var nombreH 	= $('#nombreH').val();
	var cantidadHP 	= $('#cantidadHP').val();
	var cantidadHD 	= $('#cantidadHD').val();
	var estadoH 	= $('#estadoH').val();
	var codigoHU 	= $('#codigoHU').val();
	var codigoH 	= $('#codigoH').val();
	if(cantidadHP<cantidadHD || cantidadHD<=0){
		em_notify('Error','Debe verificar la cantidad de herramientas a devolver','danger');
	}else{
		$.ajax({
			url: ruta+'entregarHerramienta',
			type: 'POST',
			dataType: 'json',
			data: {	jefeDeObra : jefeDeObra, nombreH: nombreH,cantidadHP: cantidadHP, cantidadHD, cantidadHD, estadoH, codigoHU:codigoHU, codigoH:codigoH },
		}).done(function(data) {
			if(data.status){
				$('#modalEntregar').modal('hide');
				em_notify('Correcto','Herramienta ha sido devuelta','success');
				cargarlistaHerramientaPrestadas();
			}else{
				em_notify('Error',data.error,'danger');
			}
		});
	}
}

function insertarPedidoH(){
	var jefeDeObra 	= $('#jefeDeObra').val();
	var table 		= $('#tablaPedidoH').DataTable();
	var rows 		= table.rows().data();
	var lista 		= new Array();
	$.each(rows, function (i, obj) {
		var objeto = {	'codigo' 	: obj[0] , 'cantidad' 	: obj[2]};
		lista.push(objeto);
	});
	$.ajax({
		url: ruta+'insertarPedidoH',
		type: 'POST',
		dataType: 'json',
		data: {	jefeDeObra : jefeDeObra, pedido: lista},
	}).done(function(data) {
		if(data.status){
			var t = $('#tablaPedidoH').DataTable();
			$('#divPedido').removeClass('show').addClass('hidden');
			$('#modalSalida').modal('hide');
			t.clear();
			em_notify('Correcto','Pedido registrado','success');
			document.getElementById("codigoSalida").focus();
		}else{
			em_notify('Error',data.error,'danger');
		}
	});
}