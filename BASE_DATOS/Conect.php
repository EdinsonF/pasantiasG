<<<<<<< HEAD
<?php
class Conexion
{


function Conectar(){

$servidor	="localhost";
$usuario	="postgres";
$clave		="root";
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
=======
<?php
class Conexion
{


function Conectar(){

$servidor	="localhost";
$usuario	="postgres";
$clave		="root";
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
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
