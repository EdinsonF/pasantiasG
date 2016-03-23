<?php


include('../controlador/Tipo_Solicitud_Controller.php');

	$variableDireccionClass = $_GET['clase'];
	if( $variableDireccionClass == "Tipo_Solicitud" )
	{
		$clase1=new Tipo_Solicitud_Controller();
		$clase1->catalFiltro($_GET);
	}else {
		$clase1=new Tipo_Solicitud_Controller();
		$clase1->cargarCatal();
	}