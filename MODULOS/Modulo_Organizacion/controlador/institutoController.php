<?php

	include('../modelo/organizacion.php');
	include('../modelo/persona.php');
	include('../modelo/Departamento(Especialidad-Oficina).php');
	


class institutoController
{

			public function RegistroInstitutoP( $instituto = array())
			{
			$Organizacion = new organizacion();

			$returnRegistro=array();

			$Organizacion->getformularioInstitutoPrincipal($instituto);

			$returnRegistro =$Organizacion->RegistroInstituto();

					return  $returnRegistro;
			}	 // FUNCTION REGISTRAR INSTITUTO DATOS BASICOS
			

			public function RegistrarInstitutoConvenio( $instituto = array())
			{
			$Organizacion = new organizacion();

			$returnRegistro=array();

			$Organizacion->getformularioInstitutoConvenio($instituto);

			$returnRegistro =$Organizacion->RegistroInstitutoConvenio();

					return  $returnRegistro;
			}	 // FUNCTION REGISTRAR INSTITUTO DATOS BASICOS

			public function RegistroPersonaEncargada( $array = array() ){

				$Sucursal =$array['Instituto'];
				$organizacion = new organizacion();
	
				// $id_organizacion=
				// $organizacion->buscarid_OrganizacionInstituto($organizacionIP);
				$persona = new persona();
				$persona->SetPersonaEncargada($array);
			 	$registro= $persona->RegistroPersonaEncargadaInstituto($array['Instituto']);
			 	$oficina = new Especialidad();
			 	
				$id_oficina =	
				$oficina->oficinaEncargado("PASANTIAS" , "Persona encargada de Pasantias");
				
				$organizacion->Incluir_organizacionOficina( $id_oficina, $Sucursal );

			 	$per  =
			 	$persona->personaOrganizacion($registro['id_persona'],
			 		$id_oficina,
			 		$Sucursal,6 );
			 	return array( 'registro'  =>$registro ,'PERSONA' => $per) ;

			}
			public function RegistrarPersonaInstitutoConvenio( $array = array() ){

				$organizacion = new organizacion();
			 	$oficina = new Especialidad();
				$persona = new persona();


				$sucursalSeleccionada= $array['idOrganizacionConvenio'] ;
				//$organizacion->buscarsucursalConvenioSeleccionada($array['Instituto']);
				$persona->SetPersonaEncargada($array);
			 	$registro= $persona->RegistroPersonaEmpresa();

			 	
				$id_oficina =	
				$oficina->oficinaEncargado("CONTACTO" , "Persona contacto de Organización");

				$oficinaPersona = $organizacion->Incluir_organizacionOficina( $id_oficina,$sucursalSeleccionada );
				$per  = null;
					if($oficinaPersona ==1)
					{
						$per  =	$persona->personaOrganizacion($registro['id_persona'],$id_oficina,$sucursalSeleccionada,2);
					}
				
			 	
			 	return array( 'registro'  =>$registro ,'PERSONA' => $per) ;

			}			

			public function Usuario($user)
			{	
				$persona = new persona();
				$result= $persona->UsuarioVerificar($user);
				return $result;
			}
			public function Correo ($Correo)
			{
				$persona = new persona();
				$result= $persona->correoVerificar($Correo);
				return $result;
			}
			public function cedula( $cedula )
			{
				$persona = new persona();
				$result= $persona->cedulaVerificar($cedula);
				return $result;
			}


	function infromacionSelects()
	{	

		return array( 'TipoOrganizacion' => $this->llenarSelectT() , 'Estado' =>  $this->llenarSelectEstado() ) ;

	}	
	public function llenarSelectT()
	{

		$clase  = new organizacion();
		$return =  $clase->registrosTipoOrganizacionSelectInstituto();
		$datos  = array();
			while( $fila = pg_fetch_array($return) ) :
			
			//echo "<option value='".$fila['id_tipo_organizacion']."'>".$fila['nombre_tipo_organizacion']."</option>";
				$datos[]=$fila;
			
			endwhile;
		return $datos;

	}
	public function llenarSelectEstado()
	{
		$clase  = new organizacion();
		
		$return = $clase->selectEstado();

		$datos  =  array();

			while( $fila = pg_fetch_array($return) ) :
		
			//echo "<option value='".$fila['id_estado']."'>".$fila['nombre_estado']."</option>";
			$datos[]=$fila;

			endwhile;

		return $datos;		
			
	}
			public function llenartablaPersonas()
			{
				 $clase = new persona();


				 $return = $clase->personasRegistradas();

					$Data =array();
					 while ($filas=pg_fetch_assoc($return))  
				    { 
				       $Data[]= $filas; 
				    } 
					return $Data;
			}

			public function llenarSelectMunicipio( $a = array() )
			{
				 $clase = new organizacion();


				 $return = $clase->selectmunicipio($a);

					$Data =array();
					 while ($filas=pg_fetch_assoc($return))  
				    { 
				       $Data[]= $filas; 
				    } 
					return $Data;
								
					
			}


			public function tablaSeleccionarInstituto()
			{
				 $clase = new organizacion();

				 $return = $clase->institucionesPrincipales();
				 $Data =array();
				 while ($filas=pg_fetch_assoc($return['tira']))  
				 { 
				       $Data[]= $filas; 
				 } 
				 return $Data;
 			
					
			}

			public function InstitutoPrincipalCuantos()
			{
				 $clase = new organizacion();

				 $return = $clase->institucionesPrincipales();

				 return $return['results'];				
			}

			public function tablainstitutoConvenio()
			{
				 $clase = new organizacion();
				 $return = $clase->institucionesConvenio();
				 $Data =array();
				 while ($filas=pg_fetch_assoc($return))  
				 { 	   $filas['institutoPrincipal'] =$clase->nombreinstitutoP($filas['id_ip']);
							if($filas['siglas']=='')
							{ 
						 	$filas['siglas'] =$filas['nombre_organizacion'];
						  	}
				       $Data[]= $filas; 

				 } 
				return $Data ;
			}


			public function ver_cuantos_Principales_hay()
			{
				 $clase = new organizacion();
				 $return = $clase->institucionesPrincipales();

				 return $return['results'];
				
			}
			public function ver_cuantos_convenios_hay()
			{
				 $clase = new organizacion();
				 $return = $clase->institucionesConvenio();

				 return pg_num_rows($return);
				
			}
			public function aprobarUsuarios( $form = array() )
			{

				$clase = new persona();

				$num =$clase->Actualizar_Solicitud( $form);

				return $num;
					
			}	
			public function observacion_solicitud( $formularrio = array() )
			{
				$class = new persona();
				$result= $class->buscar_datos_de_esta_persona_y_solicitud_instituto($formularrio);

				return $result;
			}

			public function MostrarOrganizacionConvenioPendientesNuenamente( $id_instituto )
			{
				$clase = new organizacion();
				$result = $clase->cargaUsuariosPendientes_InstitutoConvenio($id_instituto);
				
				$data = array();
				while( $fila =  pg_fetch_array($result) )
				{ //<input type=button class='.'"btn btn-primary btn-large"'.' id='.$fila[9].'-'.$fila[10].'-'.$fila[11].' name=Rechazar value=RECHAZAR>
						$data[] = $fila;
				}
				return $data;
			}

			public function datosCentral ($id_organizacion)
			{		
			    $clase = new organizacion();
				$result = $clase->consulta_estaCentral($id_organizacion);
				return $result;
			}

			public function BuscarSucursales($id_organizacion )
			{
				$clase = new organizacion();

					$resultado =$clase->buscarSucursales($id_organizacion);
					$datos = array();
					while($fila=  pg_fetch_assoc( $resultado) )
					{				$fila['numero'] = pg_num_rows($resultado);
							$datos[] = $fila;							
					}	
							

				return $datos;
			}

			function RegistraSucursal( $form = array() )
			{
			    $clase = new organizacion();
				$result = $clase->RegistraSucursal( $form );
				return $result;
			}

			public function MostrarOrganizacionConvenioAprobadosNuenamente( $id_instituto )
			{
				$clase = new organizacion();
				$result = $clase->cargaUsuariosAprobados_InstitutoConvenio($id_instituto);
				
				$data = array();
				while( $fila =  pg_fetch_array($result) )
				{ //<input type=button class='.'"btn btn-primary btn-large"'.' id='.$fila[9].'-'.$fila[10].'-'.$fila[11].' name=Rechazar value=RECHAZAR>
						$data[] = $fila;
				}
				return $data;
			} 
			
			public function MostrarOrganizacionConvenioRechazadasNuenamente( $id_instituto )
			{
				$clase = new organizacion();
				$result = $clase->cargaUsuariosRechazados_InstitutoConvenio($id_instituto);
				
				$data = array();
				while( $fila =  pg_fetch_array($result) )
				{ //<input type=button class='.'"btn btn-primary btn-large"'.' id='.$fila[9].'-'.$fila[10].'-'.$fila[11].' name=Rechazar value=RECHAZAR>
						$data[] = $fila;
				}
				return $data;
			} 


			function cargarPostulacion( $Codigo_sucursal)
			{	
				$clase = new organizacion();
				$result = $clase->cargarpostulacionEstudiantes($Codigo_sucursal);
				
				$data = array();
				while( $fila =  pg_fetch_array($result) )
				{ //<input type=button class='.'"btn btn-primary btn-large"'.' id='.$fila[9].'-'.$fila[10].'-'.$fila[11].' name=Rechazar value=RECHAZAR>
						$data[] = $fila;
				}
				return $data;

			}

			function cargarPostulacionAceptadas($Codigo_sucursal)
			{	
				$clase = new organizacion();
				$clase->cargarpostulacionEstudiantes_AprobadoXEmpresa($Codigo_sucursal);
				
				

			}


			function SolicitudesestaOrganizacion($codigo_sucursal)
			{
				$clase = new organizacion();
				$result = $clase->cargarSolicitudes($codigo_sucursal);
				$data = array();
				while($fila = pg_fetch_assoc($result))
				{
						$data[]=$fila;
				}	

				return $data;
			}
			function BuscarSolicitudesAprobadasOrganizacion( $codigo_encargado)
			{
				$clase = new organizacion();
				$result = $clase->cargarSolicitudesAprobadasOrganizacion($codigo_encargado);
				$data = array();
				while($fila = pg_fetch_assoc($result))
				{
						$data[]=$fila;
				}	
				return $data;
			}

			function buscarid_estudiante($codigo_estudiante)
			{		
				$clase = new organizacion();
				$result = $clase->buscarparacurriEstudiante($codigo_estudiante);				
				$var =	pg_fetch_array($result);
				$resultado=$var['id_persona'];
				return $resultado;
			}
			public function postuladosThisSolicitud($arra=array())
			{
				$clase = new organizacion();
				$return = $clase->postuladosSolicitud($arra);
				$data =array();
				while($fila =pg_fetch_assoc($return) )
				{
						$data[]= $fila;
				}
				return $data ;
			}

			function AprobaresteSer($CodigoSolicitud , $estudiante, $id_persona)
			{
				$clase = new organizacion();
				$return = $clase->Aprobarsolicitud($CodigoSolicitud , $estudiante, $id_persona);
				return $return ;
			}


			function AprobarSolicitudes_EstudiantesPostuladosAempresas($CodigoSolicitud , $codigo_sucursal, $id_persona)
			{
				$clase = new organizacion();
				$return = $clase->Aprobarsolicitud_EstudiantesPostuladosAempresas($CodigoSolicitud , $codigo_sucursal, $id_persona);
				return $return ;
			}



			public function MostrarOrganizacionConvenioPendientes( $id_instituto )
			{
				$clase = new organizacion();
				$result = $clase->cargaUsuariosPendientes_InstitutoConvenio($id_instituto);
				while( $fila =  pg_fetch_array($result))
				{
					 echo'				
	              <tr >
	                  <td ><center>  '.$fila[4].' </center></td>
	                  <td ><center>  '.$fila[5].' </center></td>
	                  <td ><center>  '.$fila[6].' </center></td>
	                  <td><center>   '.$fila[0].' '.'-'.' '.$fila[1].'</center></td>
	                  <td><center>   '.$fila[2].'</center></td>
					  <td><center>   '.$fila[3].'</center></td>
	                  <td><center>   '.$fila[8].'</center></td>
	                  <td ><center> 
	                       <button class='.'"btn btn-default  "'.' name=Aprobar value=APROBAR> 
	                      	<img   name=Aprobar src=../../../img/iconos/ok.png alt=Ginger class=top  width=20 ./> 

	                        </button>  
	                       <button type=button class='.'"btn btn-default "'.'  name=Rechazar value=RECHAZAR> 
	                      			<img  name=Rechazar src=../../../img/iconos/cancel.png alt=Ginger class=top width=20 ./> 
	                       </button> 
	                  </td>
	                  <td class=solicitud style=display:none >'.$fila['solicitud'].'</td>
	              </tr>';                         
                       
				}

			 
			}


			public function MostrarOrganizacionConvenioAprobadas($id_instituto)
			{
				$clase = new organizacion();
				$result = $clase->cargaUsuariosAprobados_InstitutoConvenio($id_instituto);

				$data = array();

				// while( $fila =  pg_fetch_array($result) )
				// {
				// 		$data[] = $fila;
				// }
				// return $data;

				while( $fila =  pg_fetch_array($result))
				{				
				 echo'        <tr >
	                              <td ><center>  '.$fila[4].' </center></td>
	                              <td ><center>  '.$fila[5].' </center></td>
	                              <td ><center>  '.$fila[6].' </center></td>
	                           
	                              <td><center>   '.$fila[0].' '.'-'.' '.$fila[1].'</center></td>

	                              <td><center>   '.$fila[2].'</center></td>
	                              <td><center>   '.$fila[3].'</center></td>
	                              <td><center>   '.$fila[8].'</center></td>
	                              <td><center> 
	                              </td>
                              </tr>';
                               //<input type=button class='.'"btn btn-primary btn-large"'.'   value=PENDIENTE>
                               //<input type=button class='.'"btn btn-primary btn-large"'.'    value=RECHAZAR>
			}
			}


			public function MostrarOrganizacionConvenioRechazadas($id_instituto)
			{
				$clase = new organizacion();
				$result = $clase->cargaUsuariosRechazados_InstitutoConvenio($id_instituto);

				$data = array();

				while( $fila =  pg_fetch_array($result))
				{
				 echo'        <tr >
	                              <td ><center>  '.$fila[4].' </center></td>
	                              <td ><center>  '.$fila[5].' </center></td>
	                              <td ><center>  '.$fila[6].' </center></td>                           
	                              <td><center>   '.$fila[0].' '.'-'.' '.$fila[1].'</center></td>
	                              <td><center>   '.$fila[2].'</center></td>
	                              <td><center>   '.$fila[3].'</center></td>
	                              <td><center>   '.$fila[8].'</center></td>                              
	                              <td ><center> 
	                              </center> </td>                             
                              </tr>';
                              	    //<input type=button class='.'"btn btn-primary btn-large"'.'   value=APROBAR>
                               		//<input type=button class='.'"btn btn-primary btn-large"'.'   value=PENDIENTE>
				}// WHILE
			}

			function DetallesSucursalAsociadaplease( $id_organizacionPrincipal , $codigo_sucursal , $codigo_encargado)
			{
				$clase = new organizacion();
				$result = $clase->colsultarestosparametros($id_organizacionPrincipal , $codigo_sucursal , $codigo_encargado);				
					
					$row = pg_fetch_assoc($result);

				return $row;
			}
			
			function buscarDepartamentosRegistradosOrganizacionAsociada ($codigo_sucursal)
			{
				$clase = new organizacion();
				$result = $clase->DepartamentosRegistrados( $codigo_sucursal );				
					$data = array() ;
					while ( $row = pg_fetch_assoc($result)) 
					{
						$row['nombre_oficina'] = 
						$this->Procesar_Palabras_EspaciosPre( $row['nombre_oficina'] ,$row['maxlength'] );
						$row['personas'] = $clase->ContarPersonalPoroficina( $codigo_sucursal , $row['id_oficina']);	
						$data[] = $row ;
					}

				return $data;
			}
			function Procesar_Palabras_EspaciosPre( $cadena_Procesar , $numeroMax )
			{
				$numpalabra =strlen($cadena_Procesar);
				$TotaldeEspaciosAgregados = $numeroMax -$numpalabra;
				for( $i = 0 ; $i < $TotaldeEspaciosAgregados ; $i ++){			 
					$cadena_Procesar=$cadena_Procesar.' ';
				}
				return  $cadena_Procesar;
			}

			function buscarPersonasRegistradas(){

				$clase = new persona();

				$datos = array();
				$values = $clase->cedulasRegistradasAutoComplete();
				while($value= pg_fetch_assoc($values))
				{
					$datos[]=$value;
				}
			return $datos;	
			}

			function buscarDatosCedula( $cedula )
			{
				$clase = new persona();
				$values= $clase->datosPersonalesCedula($cedula);
				return pg_fetch_assoc($values);
			}

			function buscarDatosCompletosPersona($cedula)
			{
				$clase = new persona();
				$values= $clase->CedulaSElleccionada($cedula);
						$Data1= pg_fetch_assoc($values);
						if ($Data1 == null) $Data1= pg_fetch_assoc($clase->datosPersona($cedula) );
				return $Data1;
			}

}


?>