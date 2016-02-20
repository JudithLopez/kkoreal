<?php
require_once("../model/crearBandaHorarioExp.php");
$crearBH = new CrearBandaHorario();
if($_POST['id']==0){
	$resultado = $crearBH->insertarBandaHorario($_POST);
}else{
	$resultado = $crearBH->modificarBandaHorario($_POST);
}
if (!empty($resultado)){
	echo $resultado;
}?>