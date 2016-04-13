<?php
include('tipoOrganizacionController.php');


		if(isset($_POST['Registrar']))
		{
			$modeloThis = new tipoOrganizacionController();
			
			

			$variable = $modeloThis->Registro($_POST);

			echo json_encode($variable);
		}
		else		if(isset($_POST['Modificar']))
		{
			$modeloThis = new tipoOrganizacionController();
			
			

			$variable = $modeloThis->Modificar($_POST);

			echo json_encode($variable);
		}else if(isset($_POST['filDiferncial']))
		{
				$modeloThis = new tipoOrganizacionController();
				$return= $modeloThis->tablaFiltro($_POST);
			echo json_encode($return);


		}else if(isset($_POST['VerificarExistencia']))
		{
				$modeloThis = new tipoOrganizacionController();
				$return= $modeloThis->BusquedaTipo($_POST);
				echo json_encode($return);
		}
		