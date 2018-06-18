var ruta = 'http://localhost/ElMilagro/index.php/';
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

	