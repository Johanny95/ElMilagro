<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_proyecto extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function addProyecto($nombre,$jefeDeOra,$descripcion,$ruta,$fullruta,$usuario){
		$this->db->trans_start();
		$array = array(
			'NOMBRE'	 			=> $nombre,
			'RUT_JEFE_OBRA' 		=> $jefeDeOra,
			'DESCRIPCION' 			=> $descripcion,
			'CREATE_BY' 			=> $usuario,
			'CREATE_DATE' 			=> date('Y-m-d H:i:s'),
			'UPDATE_BY' 			=> null,
			'LAST_UPDATE_BY'		=> null,
			'DELETE_BY' 			=> null,
			'DELETE_DATE' 			=> null
		);
		$this->db->set($array);
		$this->db->insert('PROYECTO');
		$id_proyecto = $this->db->insert_id();
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
				'ID_PROYECTO' 			=> $id_proyecto,
				'CREATE_BY' 			=> $usuario,
				'CREATE_DATE' 			=> date('Y-m-d H:i:s'),
				'UPDATE_BY' 			=> null,
				'LAST_UPDATE_BY'		=> null,
				'DELETE_BY' 			=> null,
				'DELETE_DATE' 			=> null
			);
			$this->db->set($doc);
			$this->db->insert('DOCUMENTO_PROYECTO');
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

	public function editarProyecto($codigo,$nombre,$descripcion,$usuario){
		$this->db->trans_start();
		$this->db->set('NOMBRE'      		 , $nombre);
		$this->db->set('DESCRIPCION'    	 , $descripcion);
		$this->db->set('LAST_UPDATE_BY'   	 , date('Y-m-d H:i:s'));
		$this->db->set('UPDATE_BY' 	    	 , $usuario);
		$this->db->where('ID_PROYECTO'   	 , $codigo);
		$this->db->update('PROYECTO');
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return TRUE;
		}
	}

	function getProyectos(){
		$str_sql="	SELECT 	P.ID_PROYECTO,
							P.NOMBRE,
							P.DESCRIPCION,
							P.CREATE_DATE,
							CONCAT(U.NOMBRE_USUARIO,CONCAT(' ',U.APELLIDO_USUARIO)) NOMBRE_JEFE_OBRA,
							P.RUT_JEFE_OBRA,
							DP.RUTA
					FROM PROYECTO P JOIN USUARIO U ON P.RUT_JEFE_OBRA = U.RUT_USUARIO
					LEFT JOIN DOCUMENTO_PROYECTO DP ON P.ID_PROYECTO   = DP.ID_PROYECTO";
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}

}