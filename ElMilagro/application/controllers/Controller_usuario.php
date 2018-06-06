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

	public function dashboard(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			$this->load->view('index');
			$this->load->view('template/footer');
		}else{
			$this->load->view('template/login');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		$this->load->view('template/login');
	}


}
