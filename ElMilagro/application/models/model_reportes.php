<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_reportes extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function getMaterialesTraza($materiales){
		// $var = explode(',',$materiales)
		$lista='';
		foreach ($materiales as $key => $v) {
			$lista.='"'.$v.'",';
		}
		$str_sql='
		SELECT 	S.ID_MATERIAL,
		M.NOMBRE,
		SUM(S.CANTIDAD) SUMA,
		DATE_FORMAT(S.CREATE_DATE,"%Y-%m") FECHA
		FROM 		SALIDA_MATERIAL S, MATERIAL M
		WHERE 		S.ID_MATERIAL =  M.ID_RECURSO
		AND 		S.ID_MATERIAL IN ('.substr($lista, 0,-1).')
		AND 		DATE_FORMAT(S.CREATE_DATE,"%m %Y") IN (SELECT * FROM( 
			SELECT 	DISTINCT DATE_FORMAT(CREATE_DATE,"%m %Y") DATE_T
			FROM   	SALIDA_MATERIAL
			ORDER BY 	DATE(CREATE_DATE) DESC LIMIT 0,12)
			AS T)
			GROUP BY 	S.ID_MATERIAL, FECHA
			ORDER BY 	DATE(S.CREATE_DATE) DESC';
			$query = $this->db->query($str_sql);
			$result  = $query->result();
			return $result;
		}

		function getListMaterialesBeneficiario($id_proyecto,$id_benef,$rut_benef){
			$str_sql="SELECT 	SUM(S.CANTIDAD) TOTAL,
								S.ID_MATERIAL,
								M.NOMBRE,
								TS.NOMBRE_STOCK,
								CONCAT(U.NOMBRE_USUARIO,CONCAT(' ',U.APELLIDO_USUARIO)) JEFE,
								U.RUT_USUARIO
			FROM SALIDA_MATERIAL S, MATERIAL M, TIPO_STOCK TS, USUARIO U
			WHERE S.ID_MATERIAL     = M.ID_RECURSO
			AND   U.RUT_USUARIO		= S.RUT_USUARIO 
			AND   M.TIPO_STOCK      = TS.ID_TIPO_STOCK
			AND   S.RUT_BENEFICIARIO= '".$rut_benef."'
			AND   S.ID_BENEFICIARIO = '".$id_benef."'
			AND   S.PROYECTO_ID     = '".$id_proyecto."'
			GROUP BY ID_MATERIAL";
			$query = $this->db->query($str_sql);
			$result  = $query->result();
			return $result;
		}

	}