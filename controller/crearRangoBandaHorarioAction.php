<?php
require_once("../model/crearRangoBandaHorarioExp.php");
$crearRBH = new CrearRangoBandaHorario();
if($_POST['idRango']==0){
	$resultado = $crearRBH->insertarRangoBandaHorario($_POST);
}else{
	$resultado = $crearRBH->modificarRangoBandaHorario($_POST);
}
if (!empty($resultado)){
	echo $resultado;
}?>