<?php
   if(isset($_POST['OrganizacionesDelEncargado']))
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
	}else if(isset($_POST['EstaOrganizacion']))
		{
				$modeloThis = new institutoController();				
				
				$varialbe = $modeloThis->DetallesSucursalAsociadaplease( $_POST['id_ip'], $_POST['codigo_sucursal'] , $_POST['codigo_encargado'] );

			echo json_encode($varialbe);
		}else if(isset($_POST['DepartamentosdeSucursal'])){
				$modeloThis = new institutoController();				
				
				$varialbe = $modeloThis->buscarDepartamentosRegistradosOrganizacionAsociada( $_POST['codigo_sucursal']  );

			echo json_encode($varialbe);
		} 



?>