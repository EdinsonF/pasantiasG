<?php

include('../controlador/Periodo_Solicitud_Controller.php');

		
		if(isset($_POST['consulta']))		// BUsQUEDA TIME  REAL 
		{
		$modeloThis = new Periodo_Solicitud_Controller();
		$result = $modeloThis->buscar_periodo($_POST);
		
		if($result['num'] ==1)
		{
						echo json_encode($result);
						//echo json_encode("encontrado");
		}else{ 
						//echo json_encode(null);
		}


		}else
		if(isset($_POST['actualiza']))   // ACTUALIZAR
		{

			$modeloThis = new Periodo_Solicitud_Controller();

			$num = $modeloThis->actualiza($_POST);
			
				echo json_encode($num);

		}else// REGISTRAR

		if(isset($_POST['registra']))
		{
			$modeloThis = new Periodo_Solicitud_Controller();
			$num = $modeloThis->Registro($_POST);
				echo json_encode($num);

		}else if(isset($_POST['select']))
		{
			$modeloThis = new Periodo_Solicitud_Controller();
			$results = $modeloThis->fechas_del_select($_POST);
			echo json_encode($results);		
		
		}else if(isset($_POST['TablaGeneral']))
		{
			$modeloThis = new Periodo_Solicitud_Controller();
			$results = $modeloThis->cargarTabla();
			echo json_encode($results);		
		}
		else if(isset($_POST['Tablafield']))
		{
			$modeloThis = new Periodo_Solicitud_Controller();
			$results = $modeloThis->cargarTablaFil($_POST);
			echo json_encode($results);

		}else if(isset($_POST['validarlapsoyperiodo']))
		{
			$modeloThis = new Periodo_Solicitud_Controller();
			$results = $modeloThis->verificarfechas_adentre_Range($_POST);
			echo json_encode($results);
		}
		else if (isset($_POST['BuscarLapsoAcademico']))
		{

			$modeloThis = new Periodo_Solicitud_Controller();

			$results = $modeloThis->selectLapso();

			echo json_encode($results);

		}