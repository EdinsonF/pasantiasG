<?php
session_start();
include('reportesController.php');


if( isset($_SESSION['TipoReporte']))
{
	$clase = new Reportes ();

	$clase->$_SESSION['TipoReporte']();

	unset($_SESSION['TipoReporte']); 
			
}else if(isset($_POST['TipoReporte']))
{
	if(isset($_SESSION['TipoReporte'])) unset($_SESSION['TipoReporte']);

	$_SESSION['TipoReporte']=$_POST['TipoReporte'];

	echo json_encode($_SESSION['TipoReporte']);
}
