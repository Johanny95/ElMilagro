<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_materiales extends CI_Controller {

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
		$this->load->model('model_materiales');
	}

	public function salidaMaterial(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			$this->load->view('SalidaMateriales');
			$this->load->view('template/footer');
		}
	}
	public function stockMaterial(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			$data['materiales'] = $this->model_materiales->getMateriales();
			$this->load->view('stock_materiales',$data);
			$this->load->view('template/footer');
		}
	}

	public function getJefesDeObra(){
		if($this->session->userdata('usuario')>0){
			$jefeDeObra= 3;
			$msg = $this->model_usuario->getListUsuario($jefeDeObra);
			echo json_encode($msg);
		}
	}

	public function buscarProducto(){
		if( $this->session->userdata('usuario')>0 ){
			if($this->input->post()){
				$msg['status']=true;
				$msg['error'] ='';
				if($this->input->post()){
					$this->form_validation->set_rules('codigo', 'Codigo', 'trim|required|max_length[20]');
					if($this->form_validation->run()==FALSE){
						$msg['status']=FALSE;
						$msg['error']=validation_errors();
					}else{
						$codigo   = $this->input->post('codigo');
						$material = $this->model_materiales->buscarMaterial($codigo);
						if(empty($material)){
							$msg['status'] = false;
							$msg['error']  = 'Material no registrado, ingresar datos para registrar';
						}else{
							$msg['material'] = $material;
						}
					}	
				}else{
					$msg['status']=false;
				}
				echo json_encode($msg);
			}
		}
	}

	public function ingresarMaterial(){
		$msg['status']=true;
		$msg['error'] ='';
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$this->form_validation->set_rules('codigo', 'Codigo', 'trim|required|max_length[20]');
				$this->form_validation->set_rules('nombre', 'Nombre', 'required|max_length[20]');
				$this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|numeric|required|max_length[11]|is_natural_no_zero');
				$this->form_validation->set_rules('tipoStock', 'Tipo Stock', 'trim|required|max_length[11]');
				if($this->form_validation->run()==FALSE){
					$msg['status']=FALSE;
					$msg['error']=validation_errors();
				}else{
					$codigo   	= $this->input->post('codigo');
					$nombre   	= $this->input->post('nombre');
					$cantidad   = $this->input->post('cantidad');
					$tipoStock  = $this->input->post('tipoStock');
					$usuario    = $this->session->userdata('usuario');
					//datos por post
					$res 		= $this->model_materiales->insertMaterial($codigo,$nombre,$cantidad,$tipoStock,$usuario[0]->RUT_USUARIO);//envio a modelo para insert en base de datos
					if($res != true){
						$msg['status'] 	= false;
						$msg['error']  	= 'Error de base de datos, volver a intentar...';
					}
				}	
			}else{
				$msg['status']=false;
			}
		}else{
			$msg['status']= false;
			$msg['error'] = 'La sesión ha caducado, ingresar al sistema nuevamente';
		}
		echo json_encode($msg);
	}

	public function getProyectos(){
		if($this->session->userdata('usuario')>0){
			$rut_jefe 	= $this->input->post('rut_jefe');
			$msg   		= $this->model_materiales->getProyectos($rut_jefe);
			echo json_encode($msg);
		}
	}

	public function getBeneficiarios(){
		if($this->session->userdata('usuario')>0){
			$id_proyecto 	= $this->input->post('id_proyecto');
			$msg   			= $this->model_materiales->getBeneficiarios($id_proyecto);
			echo json_encode($msg);
		}	
	}

	public function insertarPedido(){
		$msg['status']=true;
		$msg['error'] ='';
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$this->form_validation->set_rules('jefeDeObra', 'Jefe de proyecto', 'required|max_length[20]');
				$this->form_validation->set_rules('proyecto', 'Proyecto', 'required|max_length[20]');
				$this->form_validation->set_rules('beneficiario', 'Beneficiario', 'trim|required|max_length[50]');
				if($this->form_validation->run()==FALSE){
					$msg['status']=FALSE;
					$msg['error']=validation_errors();
				}else{
					$jefeDeObra 	= $this->input->post('jefeDeObra');
					$proyecto   	= $this->input->post('proyecto');
					$beneficiario   = $this->input->post('beneficiario');
					$pedido 	  	= $this->input->post('pedido');
					if(!empty($pedido)){
						$benef 			= explode(',',$beneficiario);
						$usuario  		= $this->session->userdata('usuario');
						$res 			= $this->model_materiales->insertarPedido($jefeDeObra,$proyecto,$benef[0],$benef[1],$pedido,$usuario[0]->RUT_USUARIO);
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