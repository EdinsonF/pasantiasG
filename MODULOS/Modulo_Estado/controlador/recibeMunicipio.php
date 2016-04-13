<?php

include('../controlador/municipioController.php');

		
		if(isset($_POST['consulta']))		// BUsQUEDA TIME  REAL 
		{
		$modeloThis = new municipioController();
		$result = $modeloThis->buscarNombre($_POST);
		
		if($result['num'] ==1)
		{
						echo json_encode($result);
						//echo json_encode("encontrado");
		}else{ 
						//echo json_encode(null);
		}


		}else
		if(isset($_POST['actualiza']))   // ACTUALIZAR EDITAR COMO sEa
		{

			$modeloThis = new municipioController();

			$num = $modeloThis->actualiza($_POST);
			if( $num ==1)
			{
				echo json_encode($num);
			}else
			{

			}



		}else// REGISTRAR

		if(isset($_POST['registra']))
		{

			$modeloThis = new municipioController();
		

			$num = $modeloThis->Registro($_POST);

			if( $num == 1 )
			{
					echo json_encode($num);
			}else
			{

			}

		}else if (isset($_POST['filDiferncial']))
		{	
			$modeloThis = new municipioController();
			$result= $modeloThis->cargarTablaFil($_POST);
			echo json_encode($result);

		}	

