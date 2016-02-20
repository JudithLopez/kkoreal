<script>
$('#divSincronizar').show();
</script>
<?php
require_once("../db/conexiones.php");
$consulta = new Conexion();
$datosDepartamentos = $consulta->Conectar("access","SELECT * FROM Dept ORDER BY Deptid ASC");
$datosDepartamentosPostgres = $consulta->Conectar("postgres","SELECT deptid FROM dept ORDER BY deptid ASC");
$update = 0;
if (!$datosDepartamentos) 
{
	exit("Error en la actualizacion de los Dept.");
}else{
	foreach($datosDepartamentos as $key => $departamento)
	{
		$nombre_dept = $departamento['DeptName'];
		$deptid = $departamento['Deptid'];
		$supDeptid = $departamento['SupDeptid'];
		if(!array_key_exists($key, $datosDepartamentosPostgres)){
			$sqlInsert = $consulta->Conectar("postgres","INSERT INTO dept VALUES (".$deptid.", '".utf8_encode($nombre_dept)."', ".$supDeptid.")");
		}else{
			$sqlUpdate = $consulta->Conectar("postgres","UPDATE dept SET deptname='".utf8_encode($nombre_dept)."', supdeptid=".$supDeptid." WHERE deptid=".$deptid."");
		}
	}
	$time = time();
	$fecha = date("Y-m-d H:i:s", $time);
	$tabla = "dept";
	$sqlInsertRefresh = $consulta->Conectar("postgres","INSERT INTO refrescamiento (fecha, tabla) VALUES ('".$fecha."','".$tabla."')");
	$update = 1;
}
?>
<script>
$('#divSincronizar').hide();
$('.well').show();
</script>
<?php
require_once("administrarDepartamentos.php");
?>