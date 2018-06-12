var ruta = 'http://localhost/ElMilagro/index.php/';
function ingresarMaterial(){
	var codigo 		= $('#entradaCodigo').val();
	var nombre 		= $('#nombreEntrada').val();
	var cantidad 	= $('#stockEntrada').val();
	var tipoStock	= $('#tipoStockEntrada').val();
	$.ajax({
		url: ruta+'ingresarMaterial',
		type: 'POST',
		dataType: 'JSON',
		data: {	codigo   : codigo,
			nombre   : nombre,
			cantidad : cantidad,
			tipoStock: tipoStock},
		}).done(function(data) {
			if(data.status){
				var newStock= parseInt($('#stockBodega').val()) + parseInt($('#stockEntrada').val());
				$('#stockBodega').val(newStock);
				em_notify('Agregado','Agregado con exito','success');
				$('#entradaCodigo').val('');
				document.getElementById("entradaCodigo").focus();
			}else{
				em_notify('Error',data.error,'danger');
			}
		});
	}

	function cargarProyectosJefeobra(){
		var rut_jefe = $('#jefeDeObra').val();
		$.ajax({
			url: ruta+'getProyectos',
			type: 'POST',
			dataType: 'json',
			data: {rut_jefe: rut_jefe},
		})
		.done(function(data) {
			$('#proyectos').empty();
			var fila = '<option selected disabled="true">Seleccionar proyecto</option>';
			$.each(data , function(i, obj) {
				fila+='<option value="'+obj.ID_PROYECTO+'">'+obj.NOMBRE+'</option>';
			});
			$('#proyectos').append(fila);
		});
	}

	function cargarBeneficiarios(){
		var id_proyecto = $('#proyectos').val();
		$.ajax({
			url: ruta+'getBeneficiarios',
			type: 'POST',
			dataType: 'json',
			data: {id_proyecto: id_proyecto},
		})
		.done(function(data) {
			$('#beneficiario').empty();
			var fila = '<option selected disabled="true">Seleccionar beneficiario</option>';
			$.each(data , function(i, obj) {
				fila+='<option value="'+obj.ID_BENEFICIARIO+','+obj.RUT+'">'+obj.NOMBRE+' | '+obj.RUT+'</option>';
			});
			$('#beneficiario').append(fila);
		});
	}

	//se agrega a la tabla el material
	function agregarAlPedido(){
		var codigo 		= $('#codigoSalida').val();
		var nombre 		= $('#nombreEntrada').val();
		var cantidad 	= parseInt($('#stockEntrada').val());
		var stock       = parseInt($('#stockBodega').val());
		var tipoStock   = $('#tipoStockEntrada option:selected').text();
		var t = $('#tablaPedido').DataTable();
		if(codigo != '' && nombre != ''){
			if(cantidad >= 0){
				if(cantidad <= stock){
					var rowCount = $('#tbodyPedido tr').length;
					t.row.add( [
						codigo,
						nombre,
						cantidad,
						tipoStock,
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
	}

	//datos para insertar en base de datos
	function insertarPedido(){
		var jefeDeObra 	= $('#jefeDeObra').val();
		var proyecto 	= $('#proyectos').val();
		var beneficiario= $('#beneficiario').val();
		var table 		= $('#tablaPedido').DataTable();
		var rows 		= table.rows().data();
		var lista 		= new Array();
		$.each(rows, function (i, obj) {
			var objeto = {	'codigo' 	: obj[0] , 'cantidad' 	: obj[2]};
			lista.push(objeto);
		});
		$.ajax({
			url: ruta+'insertarPedido',
			type: 'POST',
			dataType: 'json',
			data: {	jefeDeObra 	: jefeDeObra,
					proyecto   	: proyecto,
					beneficiario: beneficiario,
					pedido    	: lista},
		}).done(function(data) {
			if(data.status){
				var t = $('#tablaPedido').DataTable();
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

