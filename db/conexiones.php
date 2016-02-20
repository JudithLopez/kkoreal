<?php
class Conexion
{
    var $link;
    
    function Conectar($conexion,$sql){
        $resultado = array();
        if($conexion == "postgres"){
            /* Conexion a POSGRESQL */
            try{
                $db  = new  PDO ("pgsql: dbname = anviz; host = localhost",  "postgres",   "1234"); 
                //echo  "PDO objeto POSTGRES de conexión creado";
                foreach ($db->query($sql) as $row)
                {
                    $resultado[]=$row;
                }
                return $resultado;
                $db = null;
            }
            catch(PDOException $e) 
            { 
                echo  $e -> getMessage();
            }
        }elseif($conexion == "access"){
            /* Conexion a ODBC */
            try{
                $db = new PDO("odbc:anviz");
                //echo  "PDO objeto ACCESS de conexión creado";
                foreach ($db->query($sql) as $row)
                {
                    $resultado[]=$row;
                }
                return $resultado;
                $db = null;
            }
            catch(PDOException $e) 
            { 
                echo  $e -> getMessage();
            }
        }
    }
}
?>