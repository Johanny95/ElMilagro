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
				  AND	 R.ID_ROL		 = RU.ID_ROL
				  AND    U.RUT_USUARIO = '$rut'
				  AND    U.CONTRASENA  = '$pass'";
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

}