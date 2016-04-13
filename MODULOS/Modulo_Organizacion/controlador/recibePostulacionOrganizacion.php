<?php
include("institutoController.php");

	if(isset($_POST['BuscarPostulaciones']))
	{
			 $instituto= new institutoController();
			  $resul =$instituto->cargarPostulacion( $_POST['sucursal']);
			  echo json_encode($resul );
	}else if(isset($_POST['PostulacionesAprobadas']))
	{
			 $instituto= new institutoController();
			 $instituto->cargarPostulacionAceptadas( $_POST['sucursal']);
			  
	}else if(isset($_POST['buscar_curriculo']))
	{
			 $instituto= new institutoController();
			 $value =$instituto->buscarid_estudiante($_POST['buscar_curriculo']);		
				echo json_encode($value);
				
	}else if(isset($_POST['BuscarSolicitudesEthis']))
	{
			 $instituto= new institutoController();
			 $value =$instituto->SolicitudesestaOrganizacion( $_POST['BuscarSolicitudesEthis']);
		echo json_encode($value);
	}else if( isset($_POST['BuscarPostuladosthisCode']))
	{	
		 $instituto= new institutoController();
		 $result =$instituto->postuladosThisSolicitud($_POST);
		echo json_encode($result);
	}else if(isset($_POST['BuscarDetallesSolicitud']))
	{

		echo json_encode($_POST);
	}else if(isset($_POST['AprobarPostulacion_SolicitudesEmpresa']))
	{
		 $instituto= new institutoController();
		 $result =$instituto->AprobaresteSer($_POST['AprobarPostulacion_SolicitudesEmpresa']  , $_POST['estudiante'], $_POST['id_persona'] );
		 echo json_encode($result);
	}else if(isset($_POST['AprobarPostulacion_SolicitudesEstudiantes']))
	{
		 $instituto= new institutoController();
		 $result =$instituto->AprobarSolicitudes_EstudiantesPostuladosAempresas($_POST['AprobarPostulacion_SolicitudesEstudiantes']  , $_POST['codigo_sucursal'], $_POST['id_persona']);
		 echo json_encode($result);

	}else if(isset($_POST['BuscarSolicitudesAprobadasPorOrganizacion']))
	{
		 $instituto = new institutoController();
		 $result =$instituto->BuscarSolicitudesAprobadasOrganizacion($_POST['BuscarSolicitudesAprobadasPorOrganizacion']);
		 echo json_encode($result);
	}else if(isset($_POST['Tabla_Tutores']))
	{
		include_once("../modelo/organizacion.php");
		 $organizacion = new organizacion();
		 $result =$organizacion->CargarCatalago_Tutores($_POST['id_organizacion']);
		 $lista=array();
	        while($fila=pg_fetch_array($result))
	          {
	            $lista[] = $fila;
	          }
	          echo json_encode($lista);
	}else if(isset($_POST['AsignarTutoresEmpresarial']))
	{
		include_once("../modelo/organizacion.php");
		 $organizacion = new organizacion();
		 $result =$organizacion->AsignarTutoresEmpresarialBD($_POST['codigo_tutor'], $_POST['codigo_solicitud']);
		
	          echo json_encode($result);
	}else if(isset($_POST['ConTutores']))
	{
		include_once("../modelo/organizacion.php");
		 $organizacion = new organizacion();
		 $organizacion->cargarpostulacionEstudiantes_ConTutorEmpresarial($_POST['sucursal']);
		 
	}else if(isset($_POST['PostulacionesAprobadas_Ambas']))
	{
		include_once("../modelo/organizacion.php");
		 $organizacion = new organizacion();
		 $organizacion->cargarpostulacionEstudiantes_AprobadoXEmpresa_Instituto($_POST['sucursal']);
		 
	}

?>