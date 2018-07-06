<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_beneficiario extends CI_Controller {

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
		$this->load->model('model_beneficiario');
	}

	public function moduloBeneficiario(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			$this->load->view('ingresoBeneficiario');
			$this->load->view('template/footer');
		}
	}

	public function addBeneficiario(){
		if($this->session->userdata('usuario')>0){
			$msg['error']='';
			$msg['status']=true;
			$this->form_validation->set_rules('rut', 'Rut beneficiario', 'trim|required');
			$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
			$this->form_validation->set_rules('proyecto', 'Proyecto', 'required');
			$this->form_validation->set_rules('direccion', 'Dirección', 'required');
			$this->form_validation->set_rules('telefono', 'Teléfono', 'required');
			if($this->form_validation->run()==false){
				$msg['error']=validation_errors();
				$msg['status']=false;
			}else{
				$rut    		= $this->input->post('rut');
				$nombre 		= $this->input->post('nombre');
				$proyecto		= $this->input->post('proyecto');
				$direccion		= $this->input->post('direccion');
				$telefono 		= $this->input->post('telefono');
				$usuario    	= $this->session->userdata('usuario');
				$pathname  		= 'docbeneficiario/'.$nombre;
				if (!is_dir($nombre)) {
					mkdir('docbeneficiario/'.$nombre);
				}
				$config['upload_path']   = $pathname;
				$config['allowed_types'] = '*';
				$config['max_size']      = 1024*1000;
				$config['file_name']     = 'ficha_'.date('Y-m-d_h_i_s');
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('documento')){
					$doc  = array('upload_data' => $this->upload->data());
					$ruta = $nombre.'/'.$doc['upload_data']['file_name'];
					$fullruta=$doc['upload_data']['full_path'];
					$res  = $this->model_beneficiario->addBeneficiario($rut,$nombre,$proyecto,$direccion,$telefono,$ruta,$fullruta,$usuario[0]->RUT_USUARIO);
					if($res==false){
						$msg['status']  =false;
					}
				}else{
					$msg['status']		= false;
					$msg['error'] 		= 'Ingrese documento para contiuar';
				}
			}
		}else{
			$msg['status']		= false;
			$msg['error'] 		= 'Sesión caducada';
		}
		echo json_encode($msg);
	}

	public function getBeneficiariosTabla(){
		if($this->session->userdata('usuario')>0){
			$msg['datos'] = $this->model_beneficiario->getBeneficiariosTabla();
			if(!empty($msg['datos'])){
				$msg['status'] = true;
			}else{
				$msg['status'] = false;
				$msg['error']  = 'No hay beneficiarios registrados';
			}
		}else{
			$msg['status'] = false;
			$msg['error']  = 'sesión caducada';
		}
		echo json_encode($msg);
	}

	public function editarBeneficiario(){
		$msg['status']		=true;
		$msg['error']	= '';
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){ 	
				$this->form_validation->set_rules('codigo', 'Código', 'trim|required|max_length[50]');
				$this->form_validation->set_rules('nombre', 'Nombre', 'required|max_length[100]');
				$this->form_validation->set_rules('direccion', 'Dirección', 'required|max_length[100]');
				$this->form_validation->set_rules('telefono', 'Teléfono', 'required|max_length[20]');
				if($this->form_validation->run()==FALSE){
					$msg['status']	=	FALSE;
					$msg['error']	=	validation_errors();
				}else{
					$codigo			= $this->input->post('codigo');
					$nombre 		= $this->input->post('nombre');
					$direccion		= $this->input->post('direccion');
					$telefono		= $this->input->post('telefono');
					$usuario 		= $this->session->userdata('usuario');
					$res 			= $this->model_beneficiario->editarBeneficiario($codigo,$nombre,$direccion,$telefono,$usuario[0]->RUT_USUARIO);
					if(!$res){
						$msg['status'] 	= false;
					}
				}
			}else{
				$msg['status'] 	= false;
				$msg['error'] 	= 'input';
			}
		}else{
			$msg['status'] 		= false;
			$msg['error'] 		= 'Sesión caducada, recargar página';
		}
		echo json_encode($msg);
	}
}