var ruta 	= 'http://localhost/ElMilagro/index.php/';
var baseUrl = 'http://localhost/ElMilagro/';
function em_notify(titulo,mensaje,tipo){
	var icon;
	if(tipo=='success'){
		icon='fa fa-check';  
	}else if(tipo=='danger'){
		icon='fa fa-remove';
	}else if(tipo=='warning'){
		icon='fa fa-warning';
	}else if(tipo=='info'){
		icon='fa fa-info-circle';
	}
	$.notify(
		{ icon:icon,
			title: "<strong>"+titulo+"</strong> <br/>",
			message: mensaje
		},{
			type: tipo,
			showProgressbar: false,
			placement: {
				from: "bottom",
				align: "right"
			},
			delay: 4000,
			timer: 2000,
			z_index:9999,
			animate: {
				enter: 'animated fadeInDown',
				exit: 'animated fadeOutUp'
			}
		}); 
}

function ingresar(){
	var rut = $("#rut").val();
	var pass = $("#pass").val();
	if(rut==""||pass==""){
		em_notify('Error','Ingrese datos','danger');
	}else{
		$.ajax({
			url: ruta+'login',
			type: 'POST',
			dataType: 'JSON',
			data: {	rut: rut,
				pass : pass},
			}).done(function(data) {
				if(data.status){
					window.location.replace(ruta+"dashboard");
				}else{
					em_notify('Error',data.error,'danger');
				}
			});
		}
	}

//SELECT JEFES
function cargarSelectJefes(id_select){
	$.post(ruta+'selectJefes', function(data) {
		$('#'+id_select).empty();
		var fila="<option selected disabled>Seleccionar Jefe de obra</option>";
		$.each(data, function (i, obj) {
			fila+='<option value="'+obj.RUT_USUARIO+'">'+obj.RUT_USUARIO+' | '+obj.NOMBRE+'</option>';
		});
		$('#'+id_select).append(fila);
	},'json');
}

	//BUSCAR MATERIAL POR CODIGO
	function buscarMaterial(codigo){
		$.ajax({
			url: ruta+'buscarMaterial',
			type: 'POST',
			dataType: 'JSON',
			data: {	codigo: codigo },
		}).done(function(data) {
			if(data.status){
				$('#nombreEntrada').val(data.material[0].NOMBRE).attr('readonly', true);
				$('#stockBodega').val(data.material[0].STOCK).attr('readonly', true);
				$('#tipoStockEntrada').append('<option selected value="'+data.material.ID_TIPO_STOCK+'">'+data.material[0].NOMBRE_STOCK+'</option>').attr('readonly', true);
				$('.stockDiv').removeClass('hidden').addClass('show');
				$('#stockEntrada').val(1);
				document.getElementById("stockEntrada").focus();
			}else{
				em_notify('Informativo',data.error,'info');
				$('.stockDiv').removeClass('show').addClass('hidden');
				$('#nombreEntrada').val('').attr('readonly', false);
				$('#stockBodega').val('').attr('readonly', false);
				$('#tipoStockEntrada').attr('readonly',false);
				$('#tipoStockEntrada').val('0');
				$('#stockEntrada').val(1);
				document.getElementById("stockEntrada").focus();
			}
		});
	}

	//BUSCAR MATERIAL POR CODIGO
	function buscarMaterialSalida(codigo){
		$.ajax({
			url: ruta+'buscarMaterial',
			type: 'POST',
			dataType: 'JSON',
			data: {	codigo: codigo },
		}).done(function(data) {
			if(data.status){
				$('#nombreEntrada').val(data.material[0].NOMBRE).attr('readonly', true);
				$('#stockBodega').val(data.material[0].STOCK).attr('readonly', true);
				$('#tipoStockEntrada').append('<option selected value="'+data.material.ID_TIPO_STOCK+'">'+data.material[0].NOMBRE_STOCK+'</option>').attr('readonly', true);
				$('.stockDiv').removeClass('hidden').addClass('show');
				$('#stockEntrada').val(1);
				document.getElementById("stockEntrada").focus();
			}else{
				em_notify('Informativo',data.error,'info');
				$('#divDetalle').removeClass('show').addClass('hidden');
				document.getElementById("codigoSalida").focus();
			}
		});
	}

	
	function cargarProyectosTabla(){
		$.ajax({
			url: ruta+'getProyectosTabla',
			type: 'POST',
			dataType: 'JSON'
		}).done(function(data) {
			if(data.status){
				var t = $('#tablaProyecto').DataTable();
				t.clear();
				$.each(data.datos, function (i, obj) {
					var documento = baseUrl+'doc/'+obj.RUTA;
					t.row.add( [
						'<a class="btn document btn-sm bg-navy" data-toggle="tooltip" data-placement="top" title="Ver ficha" target="_blank" href="'+documento+'" ><i class="fa fa-book"></i></a>',
						obj.ID_PROYECTO,
						obj.NOMBRE,
						obj.RUT_JEFE_OBRA+'<br/>'+obj.NOMBRE_JEFE_OBRA,
						obj.CREATE_DATE,
						'<button class="btn btn-sm edit btn-default" data-toggle="tooltip" value="'+obj.ID_PROYECTO+','+obj.NOMBRE+','+obj.DESCRIPCION+'" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button>'
						] ).draw( true );
				});
				$('[data-toggle="tooltip"]').tooltip();
			}else{
				em_notify('Notificación',data.error,'info');
			}
		});
	}

	function cargarBeneficiariosTabla(){
		$.ajax({
			url: ruta+'listBeneficiarios',
			type: 'POST',
			dataType: 'JSON'
		}).done(function(data) {
			if(data.status){
				var t = $('#tablaBeneficiario').DataTable();
				t.clear();
				$.each(data.datos, function (i, obj) {
					var documento = baseUrl+'docbeneficiario/'+obj.RUTA;
					t.row.add( [
						'<a class="btn document btn-sm bg-navy" data-toggle="tooltip" data-placement="top" title="Ver ficha" target="_blank" href="'+documento+'" ><i class="fa fa-book"></i></a>',
						obj.ID_BENEFICIARIO,
						obj.NOMBRE,
						obj.RUT_BENEFICIARIO,
						obj.NOMBRE_PROYECTO,
						obj.DIRECCION+'<br/>'+obj.TELEFONO,
						'<button class="btn btn-sm btn-default edit" value="'+obj.ID_BENEFICIARIO+','+obj.RUT_BENEFICIARIO+','+obj.NOMBRE+','+obj.DIRECCION+','+obj.TELEFONO+','+obj.NOMBRE_PROYECTO+'" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button>'
						] ).draw( true );
				});
				$('[data-toggle="tooltip"]').tooltip();
			}else{
				em_notify('Notificación',data.error,'info');
			}
		});
	}

	
	function editarMaterial(codigo,nombre,tipoStock){
		$.ajax({
			url: ruta+'editarMaterial',
			type: 'POST',
			dataType: 'JSON',
			data : {codigo 		: codigo,
				nombre 		: nombre,
				tipoStock 	: tipoStock}
			}).done(function(data) {
				if(data.status){
					$('#modalEdit').modal('hide');
					em_notify('Modificado correctamente','El material fue modificado con exito','success');
					location.reload();
				}else{
					em_notify('Notificación',data.error,'danger');
				}
			});
		}

		function editarUsuario(rut,nombre,apellido,rol,telefono,correo,direccion){
			$.ajax({
				url: ruta+'editarUsuario',
				type: 'POST',
				dataType: 'JSON',
				data : {rut 		: rut,
					nombre 		: nombre,
					apellido 	: apellido,
					rol 		: rol,
					telefono 	: telefono,
					correo 		: correo,
					direccion 	: direccion}
				}).done(function(data) {
					if(data.status){
						$('#modalEdit').modal('hide');
						em_notify('Modificado correctamente','El usuario fue modificado con exito','success');
						cargarlistaUsuarios();
					}else{
						em_notify('Notificación',data.error,'danger');
					}
				});
			}

			function editarProyecto(codigo,nombre,desccripcion){
				$.ajax({
					url: ruta+'editarProyecto',
					type: 'POST',
					dataType: 'JSON',
					data : {codigo 	: codigo,
						nombre 		: nombre,
						descripcion: desccripcion}
					}).done(function(data) {
						if(data.status){
							$('#modalEdit').modal('hide');
							em_notify('Modificado correctamente','El proyecto fue modificado con exito','success');
							cargarProyectosTabla();
						}else{
							em_notify('Notificación',data.error,'danger');
						}
					});
				}

			function editarBeneficiario(codigo,nombre,direccion,telefono){
				$.ajax({
					url: ruta+'editarBeneficiario',
					type: 'POST',
					dataType: 'JSON',
					data : {codigo 		: codigo,
							nombre 		: nombre,
							direccion 	: direccion,
							telefono 	: telefono}
					}).done(function(data) {
						if(data.status){
							$('#modalEdit').modal('hide');
							em_notify('Modificado correctamente','El beneficiario fue modificado con exito','success');
							cargarBeneficiariosTabla();
						}else{
							em_notify('Notificación',data.error,'danger');
						}
					});
					
				}
