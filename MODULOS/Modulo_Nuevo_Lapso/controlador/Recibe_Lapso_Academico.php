<?php

include('../controlador/Lapso_Academico_Controller.php');

		
		if(isset($_POST['consulta']))		// BUsQUEDA TIME  REAL 
		{
			$modeloThis = new Lapso_Academico_Controller();
			$result = $modeloThis->buscar_lapso($_POST);
			echo json_encode($result);

		}else if(isset($_POST['actualiza']))   // ACTUALIZAR
		{
			$modeloThis = new Lapso_Academico_Controller();
			$num = $modeloThis->actualiza($_POST);
			echo json_encode($num);

		}else if(isset($_POST['registra']))
		{
			$modeloThis = new Lapso_Academico_Controller();
			$num = $modeloThis->Registro($_POST);
			echo json_encode($num);
		}else if(isset($_POST['tablaGeneral']))
		{
			$modeloThis = new Lapso_Academico_Controller();
			$num = $modeloThis->cargarTabla();
			echo json_encode($num);
		}else if($_POST['tablaFiltre'])
		{
			$modeloThis = new Lapso_Academico_Controller();
			$resultado = $modeloThis->cargarTablaFil($_POST);
			echo json_encode($resultado);
		}