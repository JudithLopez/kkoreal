<?php
require_once("../model/crearHorarioPersonalExp.php");
$crearHP = new CrearHorarioPersonal();
if($_POST['horarioPersonal']==0){
	$resultado = $crearHP->insertarHorarioPersonal($_POST);
}else{
	$resultado = $crearHP->modificarHorarioPersonal($_POST);
}
if (!empty($resultado)){
	echo $resultado;
}?>