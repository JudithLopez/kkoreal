<?php
require_once("../db/conexiones.php");
$consulta = new Conexion();
$update = 0;
$ultimoMarcaje = $consulta->Conectar("postgres","SELECT checktime FROM checkinout ORDER BY checktime DESC LIMIT 1");
$ultimaFechaMarcaje = strtotime("+1 second", strtotime($ultimoMarcaje[0]['checktime']));
$ultimaFechaMarcaje = date("Y-m-j H:i:s", $ultimaFechaMarcaje);

$fechaSig = strtotime("+4 day", strtotime($ultimoMarcaje[0]['checktime']));
$fechaSig = date("Y-m-j", $fechaSig);
//$fechaSig = date("Y-m-j");
//$fechaSig = "2014-12-16";
$datosMarcaje = $consulta->Conectar("access","SELECT Checkinout.Logid, Checkinout.Userid, Checkinout.CheckTime, Checkinout.CheckType FROM Checkinout WHERE Checkinout.CheckTime BETWEEN #".$ultimaFechaMarcaje."# AND #".$fechaSig." 23:59:59# ORDER BY Checkinout.CheckTime ASC");
$datosMarcajePostgres = $consulta->Conectar("postgres","SELECT logid FROM checkinout ORDER BY checktime ASC");

//print_r($datosMarcaje);die();
if (!$datosMarcaje) 
{
	exit("No existen marcajes para actualizar. Por favor Intente más tarde.");
}else{
	foreach($datosMarcaje as $key => $marcaje)
	{
		$logid = $marcaje['Logid'];
		$userid = $marcaje['Userid'];
		$checktime = $marcaje['CheckTime'];
		$checktype = $marcaje['CheckType'];
		if(!array_key_exists($logid, $datosMarcajePostgres))
		{
			$sqlInsert = $consulta->Conectar("postgres","INSERT INTO checkinout VALUES (".$logid.", ".$userid.", '".$checktime."', '".$checktype."')");
   			echo 'Se inserto el registro con Log: '.$logid.' y fecha: '.$checktime."<br>";
		}
	}
	$time = time();
	$fecha = date("Y-m-d H:i:s", $time);
	$tabla = "checkinout";
	$sqlInsertRefresh = $consulta->Conectar("postgres","INSERT INTO refrescamiento (fecha, tabla) VALUES ('".$fecha."','".$tabla."')");
	$update = 1;
}
?>
<script>
$('#divSincronizar').hide();
$('.well').show();
</script>
<?php
require_once("administrarMarcajes.php");
echo "<center>Se actualizaron ".count($datosMarcaje)." registros.</center>";
?>