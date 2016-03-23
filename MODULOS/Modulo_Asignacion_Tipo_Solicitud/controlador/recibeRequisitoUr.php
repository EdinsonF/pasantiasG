<?php

include('../controlador/requisitoController.php');

	if($_GET['clase'] == "requisito" ) 
	{
		$modeloThis = new requisitoController();
		$modeloThis->cargarTablaFil($_GET);
	}else if($_GET['clase'] == "todo"){
		$modeloThis = new requisitoController();
		$modeloThis->cargarTabla();
	}
