<?php

include('../../Modulo_Estado/modelo/estadoMunicipio.php');


$conexionBD = new Conexion();
$conexionBD->Conectar();


$resultado=$_GET["V"];
$sql = "SELECT * FROM pasantias.usuario where usuario='".$resultado."'";
$result= pg_query($sql);

$num=pg_num_rows($result);



if ($resultado=="") {
	# code...
	echo '<div id="1"></div>';

}

else if(!$num){
	echo'<div id="1"</div><img src="../vista/icon/img/si.png" alt="Ginger" class="left" />Usuario disponible';

}else {

echo'<div id="1"</div> <img src="../vista/icon/img/no.png" alt="Ginger" class="left" />Usuario no disponible';


	# code...
}






?>