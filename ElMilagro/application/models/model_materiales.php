<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_materiales extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function buscarMaterial($codigo){
		$str_sql="	SELECT 	M.ID_RECURSO,
		M.NOMBRE,
		M.STOCK,
		T.NOMBRE_STOCK,
		T.ID_TIPO_STOCK
		FROM	MATERIAL M,
		TIPO_STOCK T
		WHERE 	M.TIPO_STOCK = T.ID_TIPO_STOCK
		AND   	M.ID_RECURSO   = '$codigo'";
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}

	function getMateriales(){
		$str_sql="SELECT 	M.ID_RECURSO,
							M.NOMBRE,
							M.STOCK,
							TP.NOMBRE_STOCK TIPO_STOCK,
							CONCAT(U.NOMBRE_USUARIO,CONCAT(' ',U.APELLIDO_USUARIO)) USUARIO,
							M.CREATE_DATE CREACION,
							M.LAST_UPDATE_BY MODIFICACION,
							CASE
								WHEN m.STOCK < 15 THEN 'Crítico'
								WHEN m.STOCK <= 30 THEN 'Bajo'
								ELSE 'Alto'
							END AS ESTADO
		FROM 	MATERIAL M, USUARIO U , TIPO_STOCK TP
		WHERE 	M.CREATE_BY 		= U.RUT_USUARIO
		AND		TP.ID_TIPO_STOCK	= M.TIPO_STOCK
		AND 	M.DELETE_DATE IS NULL";
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}

	function insertMaterial($codigo,$nombre,$cantidad,$tipo_stock,$usuario){
		if(empty($this->buscarMaterial($codigo))){
			$this->db->trans_start();
			$material = array(
				'ID_RECURSO' 	=> $codigo,
				'NOMBRE' 		=> $nombre,
				'STOCK' 		=> $cantidad,
				'TIPO_STOCK' 	=> $tipo_stock,
				'CREATE_BY' 	=> $usuario,
				'CREATE_DATE' 	=> date('Y-m-d H:i:s'),
				'UPDATE_BY' 	=> null,
				'LAST_UPDATE_BY'=> null,
				'DELETE_BY' 	=> null,
				'DELETE_DATE' 	=> null
			);
			$this->db->set($material);
			$this->db->insert('MATERIAL');
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return FALSE;
			}else{
				$this->db->trans_commit();
				return TRUE;
			}
		}else{
			$this->db->trans_start();
			$this->db->set('stock'       	 	 , 'stock+'.$cantidad ,false);
			$this->db->set('LAST_UPDATE_BY'   	 , date('Y-m-d H:i:s'));
			$this->db->set('UPDATE_BY' 	    	 , $usuario);
			$this->db->where('ID_RECURSO'   	 , $codigo);
			$this->db->update('MATERIAL');
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return FALSE;
			}else{
				$this->db->trans_commit();
				return TRUE;
			}
		}
	}

	function getProyectos($rut_jefe){
		$str_sql="	SELECT 	ID_PROYECTO,
		NOMBRE
		FROM 	PROYECTO
		WHERE   RUT_JEFE_OBRA = '$rut_jefe'";
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}

	function getBeneficiarios($id_proyecto){
		$str_sql="	SELECT 	ID_BENEFICIARIO,
		NOMBRE_BENEFICIARIO AS NOMBRE,
		RUT_BENEFICIARIO    AS RUT
		FROM 	BENEFICIARIO
		WHERE   ID_PROYECTO = '$id_proyecto'";
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}

	function insertarPedido($jefeDeObra,$proyecto,$benefId,$benefRut,$pedido,$usuario){
		$this->db->trans_start();
		foreach ($pedido as $key => $obj) {
			$objeto = array(
				'RUT_USUARIO' 		=> $jefeDeObra,
				'ID_BENEFICIARIO'	=> $benefId,
				'PROYECTO_ID'		=> $proyecto,
				'RUT_BENEFICIARIO' 	=> $benefRut,
				'CANTIDAD'	 		=> $obj['cantidad'],
				'ID_MATERIAL' 		=> $obj['codigo'],
				'CREATE_BY' 		=> $usuario,
				'CREATE_DATE' 		=> date('Y-m-d H:i:s'),
				'UPDATE_BY' 		=> null,
				'LAST_UPDATE_BY'	=> null,
				'DELETE_BY' 		=> null,
				'DELETE_DATE' 		=> null
			);
			$this->db->set($objeto);
			$this->db->insert('SALIDA_MATERIAL');
		}
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}else{
			//update stock en base de datos
			$this->db->trans_commit();
			$this->db->trans_start();
			foreach ($pedido as $key => $val) {
				$this->db->set('STOCK'       	 	 , 'STOCK-'.$val['cantidad'] ,false);
				$this->db->set('LAST_UPDATE_BY'   	 , date('Y-m-d H:i:s'));
				$this->db->set('UPDATE_BY' 	    	 , $usuario);
				$this->db->where('ID_RECURSO'   	 , $val['codigo']);
				$this->db->update('MATERIAL');
			}
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return FALSE;
			}else{
				$this->db->trans_commit();
				return TRUE;
			}
		}
	}



}