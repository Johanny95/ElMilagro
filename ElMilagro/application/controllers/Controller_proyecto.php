<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_proyecto extends CI_Controller {

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
		$this->load->model('model_proyecto');	
	}

	public function viewProyecto(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			$this->load->view('ingresoProyecto');
			$this->load->view('template/footer');
		}
	}

	public function addProyecto(){
		if($this->session->userdata('usuario')>0){
			$msg['error']='';
			$msg['status']=true;
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('jefeDeObra', 'Jefe de obra', 'trim|required');
			$this->form_validation->set_rules('descripcion', 'Descripción', 'required');
			if($this->form_validation->run()==false){
				$msg['error']=validation_errors();
				$msg['status']=false;
			}else{
				$nombre    		= $this->input->post('nombre');
				$jefeDeOra 		= $this->input->post('jefeDeObra');
				$descripcion	= $this->input->post('descripcion');
				$usuario    	= $this->session->userdata('usuario');
				$pathname  		= 'doc/'.$nombre;
				if (!is_dir($pathname)) {
					mkdir('doc/'.$nombre);
				}
				$config['upload_path']   = $pathname;
				$config['allowed_types'] = '*';
				$config['max_size']      = 1024*1000;
				$config['file_name']     = $nombre.'_'.date('Y-m-d_h_i_s');
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('documento')){
					$doc  = array('upload_data' => $this->upload->data());
					$ruta = $nombre.'/'.$doc['upload_data']['file_name'];
					$fullruta=$doc['upload_data']['full_path'];
					$res  = $this->model_proyecto->addProyecto($nombre,$jefeDeOra,$descripcion,$ruta,$fullruta,$usuario[0]->RUT_USUARIO);
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

	public function getListaProyecto(){
		if($this->session->userdata('usuario')>0){
			$msg['datos']  = $this->model_proyecto->getProyectos();
			if(!empty($msg['datos'])){
				$msg['status'] = true;
			}else{
				$msg['status'] = false;
				$msg['error']  = 'No hay registros de proyectos';
			}
		}else{
			$msg['status']		= false;
			$msg['error'] 		= 'Sesión caducada';
		}
		echo json_encode($msg);
	}

	public function editarProyecto(){
		$msg['status']		=true;
		$msg['error']	= '';
		if($this->session->userdata('usuario')>0){
			if($this->input->post()){
				$this->form_validation->set_rules('codigo', 'Código', 'trim|required|max_length[50]');
				$this->form_validation->set_rules('nombre', 'Nombre', 'required|max_length[100]');
				$this->form_validation->set_rules('descripcion', 'Descripción', 'required|max_length[550]');
				if($this->form_validation->run()==FALSE){
					$msg['status']	=	FALSE;
					$msg['error']	=	validation_errors();
				}else{
					$rut 			= $this->input->post('codigo');
					$nombre 		= $this->input->post('nombre');
					$descripcion	= $this->input->post('descripcion');
					$usuario 		= $this->session->userdata('usuario');
					$res 			= $this->model_proyecto->editarProyecto($rut,$nombre,$descripcion,$usuario[0]->RUT_USUARIO);
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