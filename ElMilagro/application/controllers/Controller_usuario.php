<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_usuario extends CI_Controller {

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
	}

	public function dashboard(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			$this->load->view('index');
			$this->load->view('template/footer');
		}else{
			$this->load->view('template/login');
		}
	}

	public function modulo_usuario(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			$data['roles'] = $this->model_usuario->getRoles();
			$this->load->view('ingresoUsuarios' ,$data);
			$this->load->view('template/footer');
		}else{
			$this->load->view('template/login');
		}	
	}

	public function logout(){
		$this->session->sess_destroy();
		$this->load->view('template/login');
	}

	public function getListadoUsuarios(){
			$data = $this->model_usuario->getListadoUsuarios();
			echo json_encode($data);
	}
	
	public function login()
	{
		$msg['status']=true;
		$msg['error'] ='';
		if($this->input->post()){
			$this->form_validation->set_rules('rut', 'Rut', 'trim|required|max_length[50]');
			$this->form_validation->set_rules('pass', 'Contraseña', 'required|trim|max_length[20]');
			if($this->form_validation->run()==FALSE){
				$msg['status']=FALSE;
				$msg['error']=validation_errors();
			}else{
				$rut     = $this->input->post('rut');
				$pass    = $this->input->post('pass');
				$usuario = $this->model_usuario->getUsuario($rut,$pass);
				if(empty($usuario)){
					$msg['status'] = false;
					$msg['error']  = 'Datos no registrados';
				}else{
					$this->session->set_userdata('usuario',$usuario);
				}
			}	
		}else{
			$msg['status']=false;
		}
		echo json_encode($msg);
	}

	public function addUsuario(){
		$msg['status']=true;
		$msg['error'] ='';
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$this->form_validation->set_rules('rutUsuario', 'Rut', 'trim|required|max_length[50]');
				$this->form_validation->set_rules('nombre', 'Contraseña', 'trim|required|max_length[100]');
				$this->form_validation->set_rules('apellido', 'Apellido', 'required|max_length[100]');
				$this->form_validation->set_rules('fechaNacimiento', 'Fecha nacimiento', 'trim|required|max_length[100]');
				$this->form_validation->set_rules('rolUsuario', 'Rol usuario', 'trim|required|max_length[10]');
				$this->form_validation->set_rules('direccion', 'Dirección', 'trim|required|max_length[100]');
				$this->form_validation->set_rules('telefono', 'Teléfono', 'trim|required|max_length[12]');
				$this->form_validation->set_rules('correo', 'Correo Electronico', 'trim|required|max_length[100]');
				if($this->form_validation->run()==FALSE){
					$msg['status']=FALSE;
					$msg['error']=validation_errors();
				}else{
					$rut     			= $this->input->post('rutUsuario');
					$nombre  			= $this->input->post('nombre');
					$apellido  			= $this->input->post('apellido');
					$fechaNacimiento  	= $this->input->post('fechaNacimiento');
					$rol  				= $this->input->post('rolUsuario');
					$direccion  		= $this->input->post('direccion');
					$telefono  			= $this->input->post('telefono');
					$correo  			= $this->input->post('correo');
					$usuario 			= $this->session->userdata('usuario');
					$res     			= $this->model_usuario->addUsuario( $rut,
						$nombre,
						$apellido,
						$fechaNacimiento,
						$rol,
						$direccion,
						$telefono,
						$correo,
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


}
