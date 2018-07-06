<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_herramienta extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	function buscarHerramienta($codigo){
		$str_sql="	SELECT 	ID_HERRAMIENTA,
		NOMBRE_HERRAMIENTA,
		DESCRIPCION,
		CANTIDAD,
		ESTADO
		FROM	HERRAMIENTA H
		WHERE 	ID_HERRAMIENTA = '$codigo'";
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}

	function modificarHerramienta($codigo,$nombre,$descripcion,$usuario){
		if($this->buscarHerramienta($codigo)){
			$this->db->trans_start();
			$this->db->set('NOMBRE_HERRAMIENTA' 	    	 , $nombre);
			$this->db->set('DESCRIPCION' 	    	 , $descripcion);
			$this->db->set('LAST_UPDATE_BY'   	 , date('Y-m-d H:i:s'));
			$this->db->set('UPDATE_BY' 	    	 , $usuario);
			$this->db->where('ID_HERRAMIENTA'   	 , $codigo);
			$this->db->update('HERRAMIENTA');
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return FALSE;
			}else{
				$this->db->trans_commit();
				return TRUE;
			}
		}else{
			return FALSE;
		}
	}

	function addHerramienta($codigo,$nombre,$descripcion,$cantidad,$usuario){
		if(empty($this->buscarHerramienta($codigo))){
			$this->db->trans_start();
			$herramienta = array(
				'ID_HERRAMIENTA' 	=> $codigo,
				'NOMBRE_HERRAMIENTA' 		=> $nombre,
				'DESCRIPCION' 		=> $descripcion,
				'CANTIDAD' 	=> $cantidad,
				'ESTADO'	=> 'Disponible',
				'CREATE_BY' 	=> $usuario,
				'CREATE_DATE' 	=> date('Y-m-d H:i:s'),
				'UPDATE_BY' 	=> null,
				'LAST_UPDATE_BY'=> null,
				'DELETE_BY' 	=> null,
				'DELETE_DATE' 	=> null
			);
			$this->db->set($herramienta);
			$this->db->insert('HERRAMIENTA');
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
			$this->db->set('cantidad'       	 	 , 'cantidad+'.$cantidad ,false);
			$this->db->set('LAST_UPDATE_BY'   	 , date('Y-m-d H:i:s'));
			$this->db->set('UPDATE_BY' 	    	 , $usuario);
			$this->db->where('ID_HERRAMIENTA'   	 , $codigo);
			$this->db->update('HERRAMIENTA');
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

	function getListadoHerramienta(){
		$str_sql="	SELECT ID_HERRAMIENTA AS CODIGO,
		NOMBRE_HERRAMIENTA AS NOMBRE,
		DESCRIPCION,
		CANTIDAD AS STOCK,
		ESTADO
		FROM HERRAMIENTA";
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}

	function entregarHerramientaActualizar($cantidadHD,$usuario,$codigoH){
		$this->db->trans_commit();
		$this->db->trans_start();
		$this->db->set('CANTIDAD'       	 , 'CANTIDAD+'.$cantidadHD ,false);
		$this->db->set('LAST_UPDATE_BY'   	 , date('Y-m-d H:i:s'));
		$this->db->set('UPDATE_BY' 	    	 , $usuario);
		$this->db->where('ID_HERRAMIENTA'    , $codigoH);
		$this->db->update('HERRAMIENTA');
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			return TRUE;
		}
	}

	function entregarHerramienta($cantidadHP,$cantidadHD,$estadoH,$codigoHU,$usuario,$codigoH){
		$cant = $cantidadHP-$cantidadHD;
		if($cant==0){
			$estadoH = 'ENTREGADO';
		}
		$this->db->trans_commit();
		$this->db->trans_start();
		$this->db->set('CANTIDAD'       	 	 , 'CANTIDAD-'.$cantidadHD ,false);
		$this->db->set('LAST_UPDATE_BY'   	 , date('Y-m-d H:i:s'));
		$this->db->set('UPDATE_BY' 	    	 , $usuario);
		$this->db->set('ESTADO_ENTREGA' 	    	 , $estadoH);
		$this->db->where('ID_HERRAMIENTA_USUARIO'   	 , $codigoHU);
		$this->db->update('HERRAMIENTA_USUARIO');
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			$this->db->trans_start();
			$this->db->set('CANTIDAD'       	 , 'CANTIDAD+'.$cantidadHD ,false);
			$this->db->set('LAST_UPDATE_BY'   	 , date('Y-m-d H:i:s'));
			$this->db->set('UPDATE_BY' 	    	 , $usuario);
			$this->db->where('ID_HERRAMIENTA'    , $codigoH);
			$this->db->update('HERRAMIENTA');
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


	function insertarPedidoH($jefeDeObra,$pedido,$usuario){
		$this->db->trans_start();
		foreach ($pedido as $key => $obj) {
			$objeto = array(
				'ID_HERRAMIENTA_USUARIO' 		=> null,
				'ID_HERRAMIENTA'	=> $obj['codigo'],
				'RUT_JEFE_OBRA'		=> $jefeDeObra,
				'CANTIDAD'	 		=> $obj['cantidad'],
				'ESTADO_ENTREGA'	=> 'PENDIENTE',
				'CREATE_BY' 		=> $usuario,
				'CREATE_DATE' 		=> date('Y-m-d H:i:s'),
				'UPDATE_BY' 		=> null,
				'LAST_UPDATE_BY'	=> null,
				'DELETE_BY' 		=> null,
				'DELETE_DATE' 		=> null
			);
			$this->db->set($objeto);
			$this->db->insert('HERRAMIENTA_USUARIO');
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
				$this->db->set('CANTIDAD'       	 	 , 'CANTIDAD-'.$val['cantidad'] ,false);
				$this->db->set('LAST_UPDATE_BY'   	 , date('Y-m-d H:i:s'));
				$this->db->set('UPDATE_BY' 	    	 , $usuario);
				$this->db->where('ID_HERRAMIENTA'   	 , $val['codigo']);
				$this->db->update('HERRAMIENTA');
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


	function getListadoHerramientaPrestadas(){
		$str_sql="	SELECT CONCAT(U.NOMBRE_USUARIO,CONCAT(' ',U.APELLIDO_USUARIO)) AS NOMBRE,H.NOMBRE_HERRAMIENTA AS HERRAMIENTA, HS.CANTIDAD, HS.CREATE_DATE AS FECHA, HS.ESTADO_ENTREGA AS ESTADO, HS.ID_HERRAMIENTA_USUARIO AS CODIGO, H.ID_HERRAMIENTA AS CODIGO_HERRAMIENTA
		FROM HERRAMIENTA H, USUARIO U, HERRAMIENTA_USUARIO HS 
		WHERE HS.ID_HERRAMIENTA = H.ID_HERRAMIENTA
		AND HS.RUT_JEFE_OBRA = U.RUT_USUARIO";
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}
}