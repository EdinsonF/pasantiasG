<?php 
session_start();
include('reportesController.php');


if(isset($_POST['TipoReporte']))
{
	$_SESSION['TipoReporte']= $_POST['TipoReporte'];

	echo json_encode($_SESSION['TipoReporte']);

}else if(isset($_SESSION['TipoReporte'])){

	$instancia=  new reportesController();

	$instancia->$_SESSION['TipoReporte']();

	unset($_SESSION["TipoReporte"]);
}else {

	header('Location: ../../Index/vista/error404.phtml');

}
