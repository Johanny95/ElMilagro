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

}