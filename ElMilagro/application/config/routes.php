<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//usuarios, control, login, roles
$route['login'] 			= 'Controller_usuario/login';
$route['dashboard']			= 'Controller_usuario/dashboard';
$route['logout']			= 'Controller_usuario/logout';
//Ingreso de materiales
$route['selectJefes'] 		= 'Controller_materiales/getJefesDeObra';
$route['buscarMaterial']	= 'Controller_materiales/buscarProducto';
$route['ingresarMaterial']	= 'Controller_materiales/ingresarMaterial';
//salida de materiales
$route['salidaMaterial']	= 'Controller_materiales/salidaMaterial';
$route['getProyectos']		= 'Controller_materiales/getProyectos';
$route['getBeneficiarios']	= 'Controller_materiales/getBeneficiarios';
$route['insertarPedido']	= 'Controller_materiales/insertarPedido';
$route['stockMaterial']		= 'Controller_materiales/stockMaterial';
//Editar material
$route['editarMaterial']	= 'Controller_materiales/editarMaterial';

//Modulo usuarios
$route['ingresoPersonal']	= 'Controller_usuario/modulo_usuario';
$route['addUsuario']		= 'Controller_usuario/addUsuario';
$route['getListadoUsuarios']= 'Controller_usuario/getListadoUsuarios';
$route['editarUsuario']		= 'Controller_usuario/editarUsuario';
//reportes
$route['charts']			= 'Controller_reportes/trazaMateriales';
$route['getDataChart']		= 'Controller_reportes/getTrazaMateriales';
$route['reporteMateriales'] = 'Controller_reportes/reporteMateriales';
$route['getReporteMaterial']= 'Controller_reportes/getReporteMaterial';
//Proyectos
$route['ingresoProyecto']	= 'Controller_proyecto/viewProyecto';
$route['addProyecto']		= 'Controller_proyecto/addProyecto';
$route['getProyectosTabla']	= 'Controller_proyecto/getListaProyecto';
$route['editarProyecto']	= 'Controller_proyecto/editarProyecto';

//beneficiario
$route['ingresoBeneficiario']= 'Controller_beneficiario/moduloBeneficiario';
$route['addBeneficiario']    = 'Controller_beneficiario/addBeneficiario';
$route['listBeneficiarios']  = 'Controller_beneficiario/getBeneficiariosTabla';
$route['editarBeneficiario'] = 'Controller_beneficiario/editarBeneficiario';


//Ingreso de herramientas
$route['ingresoHerramienta'] = 'Controller_herramienta/ingresoHerramienta';
$route['SalidaHerramienta']	 = 'Controller_herramienta/SalidaHerramienta';
$route['addHerramienta']	 = 'Controller_herramienta/addHerramienta';
$route['getListadoHerramienta']	= 'Controller_herramienta/getListadoHerramienta';
$route['modificarHerramienta']	= 'Controller_herramienta/modificarHerramienta';
$route['buscarHerramienta']		= 'Controller_herramienta/buscarHerramienta';
$route['insertarPedidoH']		= 'Controller_herramienta/insertarPedidoH';
$route['herramientasPrestadas']	= 'Controller_herramienta/herramientasPrestadas';
$route['getListadoHerramientaPrestadas']= 'Controller_herramienta/getListadoHerramientaPrestadas';
$route['entregarHerramienta']			= 'Controller_herramienta/entregarHerramienta';