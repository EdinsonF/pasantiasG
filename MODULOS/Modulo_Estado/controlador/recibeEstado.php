<?php
	include('estadoController.php');
 
			
		if(isset($_POST['Registrar']))
		{
			$modeloThis = new estadoController();

			$return = $modeloThis->Registro($_POST);

			echo json_encode($return);

		}else	if(isset($_POST['Modificar']))
		{
			$modeloThis = new estadoController();
						
			$result = $modeloThis->Modificar($_POST);

			echo json_encode($result);

		}else	if(isset($_POST['consulta']))
		{
			$modeloThis = new estadoController();

			$result= $modeloThis->ConsultaTiempoReal($_POST);

			echo json_encode($result);

		}else if (isset($_POST['filDiferncial']))
		{
			$modeloThis = new estadoController();

			$result= $modeloThis->catalFiltro($_POST);
			echo json_encode($result);
		}else if (isset($_POST['VerificarDatos']))
		{
			$modeloThis = new estadoController();

			$result= $modeloThis->Datosparamodificar($_POST);
			echo json_encode($result);

			
		}
