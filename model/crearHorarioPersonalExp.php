<?php
class CrearHorarioPersonal
{
 	var $invoco;

 	function __construct()
 	{
 		require_once("../db/conexiones.php");
 		$this->invoco = new Conexion();
	}
 	
 	function insertarHorarioPersonal($array)
 	{
 		$iduser = $array['userid'];
		$banda= $array['bandaHorario'];
		$sqlInsert = $this->invoco->Conectar("postgres","INSERT INTO horario_personal (user_id, banda_id) VALUES (".$iduser.",".$banda.")");
		return 'Se Insertaron los datos Exitosamente!';
	}

	function modificarHorarioPersonal($array)
 	{
 		$iduser = $array['userid'];
		$banda= $array['bandaHorario'];
		$sqlUpdate = $this->invoco->Conectar("postgres","UPDATE horario_personal SET banda_id=".$banda." WHERE user_id=".$iduser);
		return 'Se Modificaron los datos Exitosamente!';
	}
}?>