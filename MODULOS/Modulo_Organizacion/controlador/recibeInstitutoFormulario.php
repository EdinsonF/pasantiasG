<?php 

include('institutoController.php');

  		if(isset($_POST['RegistrarInstituto'])) 
		{

			$modeloThis = new institutoController();
			$result=  $modeloThis->RegistroInstitutoP( $_POST );
			echo json_encode($result);
		} 
		else if(isset($_POST['registraPersonaEncargada']) )
		{
			$modeloThis = new institutoController(); 
			$data= $modeloThis->RegistroPersonaEncargada( $_POST );

						 
			echo json_encode($data);

		}else if (isset( $_POST['actualiza'])) 
		{				
			$modelO = new institutoController();
			$var = $modelO->aprobarUsuarios($_POST);
			echo json_encode($var);

		}else if(isset($_POST['Observacion']))
		{
			$modeloThis = new institutoController(); 

			$data= $modeloThis->observacion_solicitud( $_POST );

			$result = pg_fetch_array($data);

			echo json_encode($result);
		}

		 else if(isset($_POST['Busquedausuario'])) 
		{
			$modeloThis = new institutoController();

			$num= $modeloThis->Usuario( $_POST['usuario'] );
			
			echo json_encode( array('result' =>$num ));
			
		} else  if(isset($_POST['tabla'])) 
		{

			$modeloThis = new institutoController();
			$result =	$modeloThis->tablaSeleccionarInstituto(  );

			echo json_encode($result);
		} 
		else  if(isset($_POST['buscarmunicipios'])) 
		{

			$modeloThis = new institutoController();
			
			$result =	$modeloThis->llenarSelectMunicipio( $_POST );

			echo json_encode($result);
		} 
		else  if(isset($_POST['Busquedacorreo'])) 
		{

			$modeloThis = new institutoController();

			$result =	$modeloThis->Correo( $_POST['correo'] );

			echo json_encode( array('result' =>$result ));

		} else  if(isset($_POST['Busquedacedula'])) 
		{

			$modeloThis = new institutoController();
			
			$result =	$modeloThis->cedula( $_POST['cedula'] );
		 
			echo json_encode( array('result' =>$result ));

		}else if(isset($_POST['tablaPersonas']))
		{
			$modeloThis = new institutoController();
			
			$result =	$modeloThis->llenartablaPersonas(  );
			
			echo json_encode($result);

		}else if(isset($_POST['tablainstitutoConvenio']))
		{
			$modeloThis = new institutoController();
			$value = $modeloThis->tablainstitutoConvenio();
			echo json_encode($value);

		}
		else if(isset($_POST['InstitutoConvenio']))
		{
				$modeloThis = new institutoController();
				$result =	$modeloThis->RegistrarInstitutoConvenio($_POST );
				echo json_encode($result);	

		}
 		else if(isset($_POST['numerosPrincipales']))
		{
				$modeloThis = new institutoController();
				$result =	$modeloThis->ver_cuantos_Principales_hay( );
				echo json_encode($result);		
		}
		else if(isset($_POST['numeros']))
		{
				$modeloThis = new institutoController();
				$result =	$modeloThis->ver_cuantos_convenios_hay( );
				echo json_encode($result);		
		}
		else if(isset($_POST['registraPersonaContacto']))
		{
				$modeloThis = new institutoController();
				$result =	$modeloThis->RegistrarPersonaInstitutoConvenio($_POST );
				echo json_encode($result);			
		}
		else if(isset($_POST['ContarInstitucionesPrincipales']))
		{
				$modeloThis = new institutoController();
				$result =	$modeloThis->InstitutoPrincipalCuantos();
				echo json_encode($result);	

		}else if (isset($_POST['BuscarPendientes']))
		{
			$modeloThis = new institutoController();
			$result = $modeloThis->MostrarOrganizacionConvenioPendientesNuenamente($_POST['id_ip']);
			echo json_encode($result);

		}else if (isset($_POST['BuscarAprobados']))
		{
			$modeloThis = new institutoController();
			$result = $modeloThis->MostrarOrganizacionConvenioAprobadosNuenamente($_POST['id_ip']);
			echo json_encode($result);

		}else if (isset($_POST['BuscarRechazados']))
		{
			$modeloThis = new institutoController();
			$result = $modeloThis->MostrarOrganizacionConvenioRechazadasNuenamente($_POST['id_ip']);
			echo json_encode($result);
		}

		else if ( isset($_POST['datosfromcentral']))  
		{
				$modeloThis = new institutoController();
				$result = $modeloThis->datosCentral($_POST['datosfromcentral']);
				echo json_encode($result);
		}
		else if (isset($_POST['Sucursal']))
		{
				$modeloThis = new institutoController();
				$result = $modeloThis->RegistraSucursal($_POST);
				echo json_encode($result);
		}
		else if(isset($_POST['BuscarSucursales']))
		{		
				$modeloThis = new institutoController();
				$variableReturn = $modeloThis->BuscarSucursales($_POST['BuscarSucursales']);
				echo json_encode($variableReturn);
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

		else if(isset($_POST['BuscarPersonasRegistradas']))
		{
			$modeloThis = new institutoController();				
			
			$varialbe = $modeloThis->buscarPersonasRegistradas(  );

			echo json_encode($varialbe);

		}else if(isset($_POST['BuscarDatospersona']))
		{
			$modeloThis = new institutoController();				
			
			$varialbe = $modeloThis->buscarDatosCedula( $_POST['BuscarDatospersona'] );

			echo json_encode($varialbe);
		}

		else if(isset($_POST['BuscarTodosDatosCedulaSeleccionada']))
		{
			$modeloThis = new institutoController();				
			
			$varialbe = $modeloThis->buscarDatosCompletosPersona( $_POST['BuscarTodosDatosCedulaSeleccionada'] );

			echo json_encode($varialbe);
		}
		else if (isset($_POST['BuscarInformacionDeTodosLosSelectsDelConvenio']))
		{
			$modeloThis = new institutoController();				
			
			$varialbe = $modeloThis->infromacionSelects();

			echo json_encode($varialbe);
		}


