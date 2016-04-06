<?php

	

	if(isset($_POST['organizaciones']))
	{
		include("postulacionController.php");
			$clase= new postulacionController();
			$result = $clase->cargarorganizacionesParaELEstudiante($_POST);
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
	}else if(isset($_POST['OrganizacionesDelEncargado']))
	{

			include("postulacionController.php");
			$clase= new postulacionController();
			$result = $clase->cargarorganizacionesParaELEncargado($_POST);
			echo json_encode($result);

	}else if(isset($_POST['ResumenMiInstitutoPrincipal'])){
			include("postulacionController.php");
			$modeloThis = new postulacionController();				
				
			$varialbe = $modeloThis->HacerResumenOrganizacionesAsociadasA( $_POST['id_ip']  );

			echo json_encode($varialbe);

	}else if(isset($_POST['MisPostulaciones']))
	{//----EDINSON--->>
			include("postulacionController.php");
			$clase= new postulacionController();
			$result = $clase->CargarMis_Postulaciones($_POST);
			echo json_encode($result);
	
	}


?>