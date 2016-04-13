<?php
session_start();
require('Control_Reportes.php');

 if(isset($_POST['AprobarReporte']))
{		if(isset($_SESSION['TipoReporte']))  unset($_SESSION["codigo"]); unset($_SESSION["TipoReporte"]);
	
	$_SESSION['codigo'] = $_POST['codigo'];

	$_SESSION['TipoReporte'] = $_POST['TipoReporte'];

	echo json_encode($_SESSION['TipoReporte']);

}else if( isset($_SESSION['TipoReporte']))
{
	
	$codigo_temporada_especialidad = $_SESSION['codigo'];

	$clas= new Control_Reportes();

	$function =$_SESSION['TipoReporte'];

	$clas->$function($codigo_temporada_especialidad);

	unset($_SESSION["codigo"]); unset($_SESSION["TipoReporte"]);

}else {

	header('Location: ../../Index/vista/error404.phtml');

}

?>