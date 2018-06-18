<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_usuario extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function getUsuario($rut,$pass){
		$str_sql="SELECT U.RUT_USUARIO,
		CONCAT(U.NOMBRE_USUARIO,CONCAT(' ',U.APELLIDO_USUARIO)) NOMBRE,
		U.CORREO,
		U.FECHA_NACIMIENTO,
		R.ID_ROL,
		R.NOMBRE_ROL
		FROM   USUARIO U,
		ROL R,
		ROL_USER RU
		WHERE  U.RUT_USUARIO = RU.RUT_USUARIO
		AND	   R.ID_ROL		 = RU.ID_ROL
		AND    U.RUT_USUARIO = '$rut'
		AND    UPPER(U.CONTRASENA)  = UPPER('$pass')
		AND    U.DELETE_DATE IS NULL";
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}

	function getRoles(){
		$str_sql="SELECT 	ID_ROL,
		NOMBRE_ROL
		FROM ROL";
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}

	function getListUsuario($tipo){
		$str_sql="	SELECT U.RUT_USUARIO,
		CONCAT(U.NOMBRE_USUARIO,CONCAT(' ',U.APELLIDO_USUARIO)) NOMBRE,
		U.CORREO,
		U.FECHA_NACIMIENTO,
		R.ID_ROL,
		R.NOMBRE_ROL
		FROM   	USUARIO U,
		ROL R,
		ROL_USER RU
		WHERE  U.RUT_USUARIO = RU.RUT_USUARIO
		AND	   R.ID_ROL		 = RU.ID_ROL
		AND    R.ID_ROL		 = $tipo";
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}

	function getListadoUsuarios(){
		$str_sql="SELECT 	U.RUT_USUARIO,
		CONCAT(U.NOMBRE_USUARIO,CONCAT(' ',U.APELLIDO_USUARIO)) NOMBRE,
		U.CORREO,
		DIRECCION,
		U.TELEFONO,
		R.NOMBRE_ROL
		FROM 
		USUARIO U, ROL_USER RU, ROL R 
		WHERE U.RUT_USUARIO = RU.RUT_USUARIO
		AND RU.ID_ROL = R.ID_ROL;
		";
		$query = $this->db->query($str_sql);
		$result  = $query->result();
		return $result;
	}

	function addUsuario($rut,$nombre,$apellido,$fechaNacimiento,$rol,$direccion,$telefono,$correo,$usuario){
		$this->db->trans_start();
		$array = array(
			'RUT_USUARIO' 			=> $rut,
			'NOMBRE_USUARIO' 		=> $nombre,
			'APELLIDO_USUARIO' 		=> $apellido,
			'TELEFONO' 				=> $telefono,
			'CORREO' 				=> $correo,
			'DIRECCION' 			=> $direccion,
			'CONTRASENA' 			=> $nombre.'elmilagro',
			'FECHA_NACIMIENTO' 		=> $fechaNacimiento,
			'CREATE_BY' 			=> $usuario,
			'CREATE_DATE' 			=> date('Y-m-d H:i:s'),
			'UPDATE_BY' 			=> null,
			'LAST_UPDATE_BY'		=> null,
			'DELETE_BY' 			=> null,
			'DELETE_DATE' 			=> null
		);
		$this->db->set($array);
		$this->db->insert('USUARIO');
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}else{
			$this->db->trans_commit();
			$this->db->trans_start();
			$rol = array(
				'RUT_USUARIO' 			=> $rut,
				'ID_ROL' 				=> $rol,
				'CREATE_BY' 			=> $usuario,
				'CREATE_DATE' 			=> date('Y-m-d H:i:s'),
				'UPDATE_BY' 			=> null,
				'LAST_UPDATE_BY'		=> null,
				'DELETE_BY' 			=> null,
				'DELETE_DATE' 			=> null
			);
			$this->db->set($rol);
			$this->db->insert('ROL_USER');
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