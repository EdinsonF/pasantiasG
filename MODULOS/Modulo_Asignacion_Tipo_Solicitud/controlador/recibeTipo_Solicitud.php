<?php
	include('../controlador/Tipo_Solicitud_Controller.php');
 
			
		if(isset($_POST['Registrar']))
		{
			$modeloThis = new Tipo_Solicitud_Controller();
			$return = $modeloThis->Registro($_POST);

			echo json_encode($return);

		}else	if(isset($_POST['Modificar']))
		{

			$modeloThis = new Tipo_Solicitud_Controller();
						
			$result = $modeloThis->Modificar($_POST);

			echo json_encode($result);

		}else	if(isset($_POST['consulta']))
		{
		
			$modeloThis = new Tipo_Solicitud_Controller();

			$result= $modeloThis->ConsultaTiempoReal($_POST);
			echo json_encode($result);

		}
