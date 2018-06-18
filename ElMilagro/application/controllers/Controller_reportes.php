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

	public function getTrazaMateriales(){
		if($this->session->userdata('usuario')>0){
			$materiales 	= $this->input->post('selectMaterial');
			$data['datos'] 	= $this->model_reportes->getMaterialesTraza($materiales);
			echo json_encode($data);
		}	
	}

	public function prueba(){
		echo json_encode($this->input->post('muestra'));
	}
}