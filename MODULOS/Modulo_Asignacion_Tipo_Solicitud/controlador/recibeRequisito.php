<?php

include('../controlador/requisitoController.php');

		
		if(isset($_POST['consulta']))		// BUsQUEDA TIME  REAL 
		{
		$modeloThis = new requisitoController();
		$result = $modeloThis->buscarNombre($_POST);
		
		if($result['num'] ==1)
		{
						echo json_encode($result);
						//echo json_encode("encontrado");
		}else{ 
						//echo json_encode(null);
		}


		}else if(isset($_POST['actualiza']))   // ACTUALIZAR
		{

			$modeloThis = new requisitoController();

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

			$modeloThis = new requisitoController();
		

			$num = $modeloThis->Registro($_POST);

			if( $num == 1 )
			{
					echo json_encode($num);
			}else
			{

			}

		}