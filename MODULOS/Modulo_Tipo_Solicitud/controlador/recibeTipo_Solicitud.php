<?php
session_start();

	include('../controlador/Tipo_Solicitud_Controller.php');
 
			
		if(isset($_POST['Registrar']))
		{
			$modeloThis = new Tipo_Solicitud_Controller();
			
			$return = $modeloThis->Registro($_POST , $_SESSION['codigo_encargado']);

			echo json_encode($return);

		}else	if(isset($_POST['Modificar']))
		{
			$modeloThis = new Tipo_Solicitud_Controller();
						
			$result = $modeloThis->Modificar($_POST , $_SESSION['codigo_encargado']);

			echo json_encode($result);

		}else	if(isset($_POST['consulta']))
		{
			$modeloThis = new Tipo_Solicitud_Controller();

			$result= $modeloThis->ConsultaTiempoReal($_POST , $_SESSION['codigo_encargado']);

			echo json_encode($result);

		}else
		 if(isset($_POST['registrostabla']))
		{
			$modeloThis = new Tipo_Solicitud_Controller();

			$result= $modeloThis->cargarCatal( $_SESSION['codigo_encargado'] );

			echo json_encode($result);

		}else if(isset($_POST['tablafiltro']))
		{
			$modeloThis     = new Tipo_Solicitud_Controller();

			$result         = $modeloThis->catalFiltro( $_POST , $_SESSION['codigo_encargado']);

			echo json_encode($result);
		}
			else if(isset($_POST['verificarexistencia']))
		{
				$modeloThis = new Tipo_Solicitud_Controller();

				$resul      = $modeloThis->VarificarTipoSolicitud($_POST  , $_SESSION['codigo_encargado'] );

				 echo json_encode($resul);

		}else if (isset($_POST['BuscarParaAutoComplete']))
		{	
				$modeloThis = new Tipo_Solicitud_Controller();

				$resul      = $modeloThis->buscarAutocompletado( $_SESSION['codigo_encargado'] );

			echo json_encode($resul);
		}
?>