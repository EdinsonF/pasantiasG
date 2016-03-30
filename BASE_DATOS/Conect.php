<?php
class Conexion
{


function Conectar(){

$servidor	="localhost";
$usuario	="postgres";
$clave		="psql";
$bd			="pasantias";
$port 		="5432";

    $cadenaConexion="host=$servidor port=$port dbname=$bd user=$usuario password=$clave";

    $conn = pg_connect($cadenaConexion) or die("Error en la Conexión: PORQUERIA".pg_last_error());

		if($conn==0){

		    }
		else{


			}
	}//fin de Conectar()
}
?>
