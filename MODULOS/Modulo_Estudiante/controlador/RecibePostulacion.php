<?php

	

	if(isset($_POST['organizaciones']))
	{
		include("postulacionController.php");
			$clase= new postulacionController();
			$result = $clase->cargarorganizaciones($_POST);
			echo json_encode($result);
	
	}else if(isset($_POST['TemporadasAsignadaspupu']))
	{
			include("postulacionController.php");
			$clase= new postulacionController();
			$retur =$clase->BuscarMistemporadasEstudiante($_POST);

			echo json_encode($retur);
	}else if(isset($_POST['PostularEstudents']))
	{

			include("postulacionController.php");
			$clase= new postulacionController();
			$retur =$clase->PostularEstudiante($_POST);

			echo json_encode($retur);
	}


?>