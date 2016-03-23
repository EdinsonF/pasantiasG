<?php

	include('empresaController.php');

		if (isset( $_POST['actualiza'])) 
		{	

			
				$modelO = new empresaController();
				 $var = $modelO->aprobarUsuarios($_POST);
			echo json_encode($var);

		}else if (isset($_POST['Observacion']))
		{
				$modelO = new empresaController();
				$var = $modelO->realizar_observacion($_POST);

								//$return= $var[1];
								$reslt= pg_fetch_array($var);
								echo json_encode($reslt);


		}else
		if (isset($_POST['botRegistrar']))
		{
			$_POST["rif"] = $_POST["letra"]."-".$_POST["rif"];
			
			$modeloThis = new empresaController();

			$modeloThis->Registro( $_POST);
			

		}else if (isset($_POST['registraPersonaEmpresa']))
		{
			$modeloThis = new empresaController();

			$resultado=	$modeloThis->RegistroPersonaEmpresa( $_POST);
			echo  json_encode($resultado);

		}else if (isset($_POST['validarDatos']))
		{
			$modeloThis = new empresaController();

			$resultado=	$modeloThis->VerificarExistenciaPersonaContacto( $_POST);
			echo  json_encode($resultado);

		}
