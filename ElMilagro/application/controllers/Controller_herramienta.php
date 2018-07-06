<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_herramienta extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_usuario');
		$this->load->model('model_herramienta');
	}

	public function ingresoHerramienta(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			$this->load->view('ingresoHerramienta');
			$this->load->view('template/footer');
		}else{
			$this->load->view('template/login');
		}
	}


	public function herramientasPrestadas(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			$this->load->view('herramientasPrestadas');
			$this->load->view('template/footer');
		}else{
			$this->load->view('template/login');
		}
	}

	public function SalidaHerramienta(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			$this->load->view('SalidaHerramienta');
			$this->load->view('template/footer');
		}else{
			$this->load->view('template/login');
		}
	}		

	public function getListadoHerramienta(){
		$data = $this->model_herramienta->getListadoHerramienta();
		echo json_encode($data);
	}

	public function getListadoHerramientaPrestadas(){
		$data = $this->model_herramienta->getListadoHerramientaPrestadas();
		echo json_encode($data);
	}

	public function modificarHerramienta(){
		$msg['status']=true;
		$msg['error'] ='';
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$this->form_validation->set_rules('codigo', 'Código', 'trim|required|max_length[50]');
				$this->form_validation->set_rules('nombre', 'Nombre', 'required|max_length[100]');
				$this->form_validation->set_rules('descripcion', 'Descripción', 'trim|required|max_length[255]');
				if($this->form_validation->run()==FALSE){
					$msg['status']=FALSE;
					$msg['error']=validation_errors();
				}else{
					$codigo     			= $this->input->post('codigo');
					$nombre  			= $this->input->post('nombre');
					$descripcion  	= $this->input->post('descripcion');
					$usuario 			= $this->session->userdata('usuario');
					$res     			= $this->model_herramienta->modificarHerramienta( $codigo,
						$nombre,
						$descripcion,
						$usuario[0]->RUT_USUARIO);
					if(!$res){
						$msg['status'] = false;
						$msg['error']  = 'Datos no registrados';
					}
				}	
			}else{
				$msg['status']= false;
			}
		}else{
			$msg['status']= false;
			$msg['error'] = 'La sesión ha caducado, ingrese nuevamente. Recarge la página.';
		}
		echo json_encode($msg);
	}

	public function entregarHerramienta(){
		$msg['status']=true;
		$msg['error'] ='';
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$this->form_validation->set_rules('cantidadHD', 'Cantidad', 'trim|required|max_length[255]');
				if($this->form_validation->run()==FALSE){
					$msg['status']=FALSE;
					$msg['error']=validation_errors();
				}else{
					$cantidadHP  	= $this->input->post('cantidadHP');
					$cantidadHD  	= $this->input->post('cantidadHD');
					$estadoH  	= $this->input->post('estadoH');
					$codigoHU  	= $this->input->post('codigoHU');
					$codigoH 	= $this->input->post('codigoH');
					$usuario 		= $this->session->userdata('usuario');
					$res     		= $this->model_herramienta->entregarHerramienta(
						$cantidadHP,
						$cantidadHD,
						$estadoH,
						$codigoHU,
						$usuario[0]->RUT_USUARIO,
						$codigoH);
					if(!$res){
						$msg['status'] = false;
						$msg['error']  = 'Datos no registrados';
					}
				}	
			}else{
				$msg['status']= false;
			}
		}else{
			$msg['status']= false;
			$msg['error'] = 'La sesión ha caducado, ingrese nuevamente. Recarge la página.';
		}
		echo json_encode($msg);
	}





	public function buscarHerramienta(){
		if( $this->session->userdata('usuario')>0 ){
			if($this->input->post()){
				$msg['status']=true;
				$msg['error'] ='';
				if($this->input->post()){
					$this->form_validation->set_rules('codigo', 'Código', 'trim|required|max_length[20]');
					if($this->form_validation->run()==FALSE){
						$msg['status']=FALSE;
						$msg['error']=validation_errors();
					}else{
						$codigo   = $this->input->post('codigo');
						$herramienta = $this->model_herramienta->buscarHerramienta($codigo);
						if(empty($herramienta)){
							$msg['status'] = false;
							$msg['error']  = 'Herramienta no registrada';
						}else{
							$msg['herramienta'] = $herramienta;
						}
					}	
				}else{
					$msg['status']=false;
				}
				echo json_encode($msg);
			}
		}
	}


	public function addHerramienta(){
		$msg['status']=true;
		$msg['error'] ='';
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$this->form_validation->set_rules('codigo', 'Código', 'trim|required|max_length[50]');
				$this->form_validation->set_rules('nombre', 'Nombre', 'required|max_length[100]');
				$this->form_validation->set_rules('cantidad', 'Cantidad', 'required|max_length[100]','min(1)');
				$this->form_validation->set_rules('descripcion', 'Descripción', 'trim|required|max_length[255]');
				if($this->form_validation->run()==FALSE){
					$msg['status']=FALSE;
					$msg['error']=validation_errors();
				}else{
					$codigo     			= $this->input->post('codigo');
					$nombre  			= $this->input->post('nombre');
					$cantidad  			= $this->input->post('cantidad');
					$descripcion  	= $this->input->post('descripcion');
					$usuario 			= $this->session->userdata('usuario');
					$res     			= $this->model_herramienta->addHerramienta( $codigo,
						$nombre,
						$descripcion,
						$cantidad,
						$usuario[0]->RUT_USUARIO);
					if(!$res){
						$msg['status'] = false;
						$msg['error']  = 'Datos no registrados';
					}
				}	
			}else{
				$msg['status']= false;
			}
		}else{
			$msg['status']= false;
			$msg['error'] = 'La sesión ha caducado, ingrese nuevamente. Recarge la página.';
		}
		echo json_encode($msg);
	}

	public function insertarPedidoH(){
		$msg['status']=true;
		$msg['error'] ='';
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$this->form_validation->set_rules('jefeDeObra', 'Jefe de proyecto', 'required|max_length[30]');
				if($this->form_validation->run()==FALSE){
					$msg['status']=FALSE;
					$msg['error']=validation_errors();
				}else{
					$jefeDeObra 	= $this->input->post('jefeDeObra');
					$pedido 	  	= $this->input->post('pedido');
					if(!empty($pedido)){
						$usuario  		= $this->session->userdata('usuario');
						$res 			= $this->model_herramienta->insertarPedidoH($jefeDeObra,$pedido,$usuario[0]->RUT_USUARIO);
						if($res==false){
							$msg['status'] = false;
							$msg['error']  = 'Error base de datos';
						}
					}else{
						$msg['status']=false;
						$msg['error']='Ingrese por lo menos un material';
					}
				}	
			}else{
				$msg['status']=false;
			}
		}else{
			$msg['status'] 	= false;
			$msg['error']  	= 'La session ha caducado, ingrese nuevamente';
		}
		echo json_encode($msg);
	}
}
