<?php
require_once("../db/conexiones.php");
$consulta = new Conexion();
$datosEmpleados = $consulta->Conectar("access","SELECT * FROM Userinfo ORDER BY Userid ASC");
$datosEmpleadosPostgres = $consulta->Conectar("postgres","SELECT userid FROM userinfo ORDER BY userid ASC");
$update = 0;
if (!$datosEmpleados) 
{
	exit("Error en la actualizacion de los Empleados.");
}else{
	foreach($datosEmpleados as $key => $empleados)
	{
		$name = $empleados['Name'];
		$userid = $empleados['Userid'];
		$deptid = $empleados['Deptid'];
		$employdate = $empleados['EmployDate'];
		$duty = $empleados['Duty'];
		if(!array_key_exists($key, $datosEmpleadosPostgres)){
			$sqlInsert = $consulta->Conectar("postgres","INSERT INTO userinfo VALUES (".$userid.", '".utf8_encode($name)."', ".$deptid.", '".$employdate."', '".utf8_encode($duty)."')");
		}else{
			$sqlUpdate = $consulta->Conectar("postgres","UPDATE userinfo SET name='".utf8_encode($name)."', deptid=".$deptid.", employdate='".$employdate."', duty='".utf8_encode($duty)."' WHERE userid=".$userid."");
		}
	}
	$time = time();
	$fecha = date("Y-m-d H:i:s", $time);
	$tabla = "userinfo";
	$sqlInsertRefresh = $consulta->Conectar("postgres","INSERT INTO refrescamiento (fecha, tabla) VALUES ('".$fecha."','".$tabla."')");
	$update = 1;
}
?>
<script>
$('#divSincronizar').hide();
$('.well').show();
</script>
<?php
require_once("administrarEmpleados.php");
?>