<?php
class CrearBandaHorario
{
 	var $invoco;

 	function __construct()
 	{
 		require_once("../db/conexiones.php");
 		$this->invoco = new Conexion();
	}
 	
 	function insertarBandaHorario($array)
 	{
		$horaEntrada = $array['horaEntrada'];
		$horaSalida = $array['horaSalida'];
		$tipoHorario = $array['tipoHorario'];
		$sqlInsert = $this->invoco->Conectar("postgres","INSERT INTO banda (hora_entrada, hora_salida, tipo_horario_id) VALUES ('".$horaEntrada."','".$horaSalida."',".$tipoHorario.")");
		return 'Se Insertaron los datos Exitosamente!';
	}

	function modificarBandaHorario($array)
 	{
 		$id = $array['id'];
		$horaEntrada = $array['horaEntrada'];
		$horaSalida = $array['horaSalida'];
		$tipoHorario = $array['tipoHorario'];
		$sqlInsert = $this->invoco->Conectar("postgres","UPDATE banda SET hora_entrada='".$horaEntrada."', hora_salida='".$horaSalida."', tipo_horario_id=".$tipoHorario." WHERE id=".$id);
		return 'Se Modificaron los datos Exitosamente!';
	}
}?>