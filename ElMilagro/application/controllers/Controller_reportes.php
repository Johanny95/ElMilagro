<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_reportes extends CI_Controller {

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
		$this->load->model('model_reportes');
		$this->load->model('model_materiales');
	}

	public function trazaMateriales(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			$data['materiales'] = $this->model_materiales->getMateriales();
			$this->load->view('reportes/traza_materiales',$data);
			$this->load->view('template/footer');
		}
	}

	public function reporteMateriales(){
		if($this->session->userdata('usuario')>0){
			$this->load->view('template/header');
			$this->load->view('reportes/reporte_materiales');
			$this->load->view('template/footer');
		}	
	}

	public function getTrazaMateriales(){
		if($this->session->userdata('usuario')>0){
			$materiales 	= $this->input->post('selectMaterial');
			$data['datos'] 	= $this->model_reportes->getMaterialesTraza($materiales);
			echo json_encode($data);
		}	
	}

	public function getReporteMaterial(){
		$msg['status']		=true;
		$msg['error']	= '';
		if($this->session->userdata('usuario')>0){
				$this->form_validation->set_rules('proyecto', 'Proyecto', 'required|max_length[50]');
				$this->form_validation->set_rules('benef_id', 'Beneficiario', 'required|max_length[50]');
				$this->form_validation->set_rules('benef_rut','Beneficiario rut', 'required|max_length[50]');

				if($this->form_validation->run()==FALSE){
					$msg['status']	=	FALSE;
					$msg['error']	=	validation_errors();
				}else{
					$proyecto 		= $this->input->post('proyecto');
					$benef_id	= $this->input->post('benef_id');
					$benef_rut	= $this->input->post('benef_rut');
					$res 		= $this->model_reportes->getListMaterialesBeneficiario($proyecto,$benef_id,$benef_rut);
					if(empty($res)){
						$msg['status'] 	= false;
						$msg['error']	= 'No hay registros para lo seleccionado';
					}else{
						$msg['datos']	= $res;
					}
				}
		}else{
			$msg['status'] 		= false;
			$msg['error'] 		= 'Sesión caducada, recargar página';
		}
		echo json_encode($msg);
	}


}