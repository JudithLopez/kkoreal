<?php
class SincronizarDepartamentos
{
 	var $consulta;

 	function __construct()
 	{
 		require_once("../db/conexiones.php");
 		$consulta = new Conexion();
	}
 	
 	function sincronizarDepartamentos()
 	{
 		$datosDepartamentos = $consulta->Conectar("access","SELECT * FROM Dept");
		$update = 0;
		if (!$datosDepartamentos) 
		{
			exit("Error en la actualizacion de los Dept.");
	    }
		else{
            foreach($datosDepartamentos as $departamento)
            {
				$nombre_dept = $departamento['DeptName'];
				$deptid = $departamento['Deptid'];
				$sqlUpdate = $consulta->Conectar("postgres","UPDATE \"Dept\" SET \"DeptName\"='".utf8_encode($nombre_dept)."' WHERE \"Deptid\"=".$deptid."");
			}
			$update = 1;
		}
		return $update;
	}
}
?>
