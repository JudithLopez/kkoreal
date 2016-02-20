<?php
class CrearRangoBandaHorario
{
 	var $invoco;

 	function __construct()
 	{
 		require_once("../db/conexiones.php");
 		$this->invoco = new Conexion();
	}
 	
 	function insertarRangoBandaHorario($array)
 	{
		$horaDesde = $array['horaDesde'];
		$horaHasta = $array['horaHasta'];
		$tipoHora = $array['tipoHora'];
		$idbanda= $array['id'];
		$sqlInsert = $this->invoco->Conectar("postgres","INSERT INTO rango_banda (banda_id, hora_desde, hora_hasta, tipo_hora_id) VALUES (".$idbanda.",'".$horaDesde."','".$horaHasta."',".$tipoHora.")");
		return 'Se Insertaron los datos Exitosamente!'.$idbanda;
	}

	function modificarRangoBandaHorario($array)
 	{
 		$idRango = $array['idRango'];
		$horaDesde = $array['horaDesde'];
		$horaHasta = $array['horaHasta'];
		$tipoHora = $array['tipoHora'];
		$idbanda= $array['id'];
		$sqlUpdate = $this->invoco->Conectar("postgres","UPDATE rango_banda SET hora_desde='".$horaDesde."', hora_hasta='".$horaHasta."', tipo_hora_id=".$tipoHora." WHERE id=".$idRango);
		return 'Se Modificaron los datos Exitosamente!'.$idbanda;
	}
}?>