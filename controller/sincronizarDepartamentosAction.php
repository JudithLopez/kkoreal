<?php
require_once("../model/sincronizarDepartamentosExp.php");
$sincronizar = new SincronizarDepartamentos();
$resultado = $sincronizar->sincronizarDepartamentos();
if (!empty($resultado)){
	print_r($resultado);
}?>