<?php

/* Conexion a POSGRESQL */
try{
	$db  = new  PDO ("pgsql: dbname = anviz; host = localhost",  "postgres",   "1234"); 
    echo  "PDO objeto de conexión creado";
    $db  = null;
} 

/* Conexion a MYSQL*/
$hostname  =  'localhost'; 
$usuario  =  'nombre de usuario'; 
$password  =  'password';

try{
	$dap  = new  PDO ("mysql: host = $ nombre de host; dbname = mysql",  $usuario,  $password);
    echo  "Conectado a la base de datos";
    $dap = null;
}

/* Conexion a ODBC */
try{
    $dap = new PDO("odbc:anviz");
    echo  "PDO objeto ACCESS de conexión creado";
    $dap = null;
}

catch (PDOException $e) 
    { 
    echo  $e -> getMessage();
}

?>