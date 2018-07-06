<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_beneficiario extends CI_Model { 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function addBeneficiario($rut,$nombre,$proyecto,$direccion,$telefono,$ruta,$fullruta,$usuario){
		$this->db->trans_start();
		$array = array(
			'RUT_BENEFICIARIO'	 	=> $rut,
			'NOMBRE_BENEFICIARIO' 	=> $nombre,
			'ID_PROYECTO' 			=> $proyecto,
			'DIRECCION' 			=> $direccion,
			'TELEFONO' 				=> $telefono,
			'CREATE_BY' 			=> $usuario,
			'CREATE_DATE' 			=> date('Y-m-d H:i:s'),
			'UPDATE_BY' 			=> null,
			'LAST_UPDATE_BY'		=> null,
			'DELETE_BY' 			=> null,
			'DELETE_DATE' 			=> null
		);
		$this->db->set($array);
		$this->db->insert('BENEFICIARIO');
		$id_beneficiario = $this->db->insert_id();
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			$this->db->trans_start();
			$doc = array(
				'RUTA'	 				=> $ruta,
				'FULL_RUTA' 			=> $fullruta,
				'ID_BENEFICIARIO' 		=> $id_beneficiario,
				'CREATE_BY' 			=> $usuario,
				'CREATE_DATE' 			=> date('Y-m-d H:i:s'),
				'UPDATE_BY' 			=> null,
				'LAST_UPDATE_BY'		=> null,
				'DELETE_BY' 			=> null,
				'DELETE_DATE' 			=> null
			);
			$this->db->set($doc);
			$this->db->insert('DOCUMENTO_BENEFICIARIO');
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return FALSE;
			}else{
				$this->db->trans_commit();
				return true;
			}
		}
	}

	function editarBeneficiario($codigo,$nombre,$direccion,$telefono,$usuario){
		$this->db->trans_start();
		$this->db->set('NOMBRE_BENEFICIARIO' , $nombre);
		$this->db->set('DIRECCION' 		   	 , $direccion);
		$this->db->set('TELEFONO' 		   	 , $telefono);
		$this->db->set('LAST_UPDATE_BY'   	 , date('Y-m-d H:i:s'));
		$this->db->set('UPDATE_BY' 	    	 , $usuario);
		$this->db->where('ID_BENEFICIARIO' 	 , $codigo);
		$this->db->update('BENEFICIARIO');
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return TRUE;
		}
	}

	function getBeneficiariosTabla(){
		$str_sql="	SELECT 	B.ID_BENEFICIARIO,
		B.NOMBRE_BENEFICIARIO NOMBRE,
		B.RUT_BENEFICIARIO,
		P.NOMBRE NOMBRE_PROYECTO,
		B.TELEFONO,
		B.DIRECCION,
		DB.RUTA
		FROM    BENEFICIARIO B JOIN PROYECTO P ON P.ID_PROYECTO     = B.ID_PROYECTO
		LEFT JOIN DOCUMENTO_BENEFICIARIO DB    ON B.ID_BENEFICIARIO = DB.ID_BENEFICIARIO";
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}




}