<<<<<<< HEAD
<?php

  include("../../../BASE_DATOS/Conect.php");
  include('../modelo/mod_usuario.php');
   $ConexionBD =new Conexion();
   $ConexionBD->Conectar();
  
	
	if(isset($_POST['ingresar']))
	{
		 $usuarios=new usuarios(); 

	$usuarios->usuario=$_POST['usuario'];
	$usuarios->contrasena=$_POST['contrasena'];


	//Hacemos la conexion y buscamos en base de datos al usuario

	#Conexion a la base de datos
	$result=$usuarios->consultar_iniciar_sesion();
	$num = pg_num_rows($result);

	if($num == 0 ){
	echo json_encode(array( 'num'=>$num ) );
	}else 
	{

	$user = array();
	while ($autenticado = pg_fetch_array($result)) {
		$user['id_usuario']=$autenticado['id_usuario'];	 // PARA LA  BITACORA POR  AHORA
    	$user['id_persona']=$autenticado['id_persona'];	
    	$user['id_perfil']=$autenticado['id_perfil'];	
    	$user['nombre_perfil']=$autenticado[2];	
    	
	}


	$cuantos = $usuarios->cuantos_perfiles_persona( $user['id_persona'] );
	$total= $cuantos['numeroO'] + $cuantos['numeroE'] ;
	
	if( $num==1 )
	{
			$id_organizacion= $usuarios->consultar_id_organizacion( $user['id_persona'] ,$user['id_perfil'] );
			$codigo_sucursal= $usuarios->codigo_sucursal($user['id_persona']);
	}else	

	if( $total > 1  ) 
	{
	//	echo pg_num_rows($cuantos);
		
		$num  = $total;

		$id_organizacion = '';

	}


	$personadatos = $usuarios->nombrePersona($user['id_persona']);
	echo json_encode( array( 'num'=> $num  ,
		'id_perfil'=>$user['id_perfil'] ,
		'id_usuario'=>$user['id_usuario'] ,
		'persona' => $user['id_persona'] , 
		'personadatos' => $personadatos ,
		'perfil'  => $user['nombre_perfil'] , 
		'codigo_sucursal'=> $codigo_sucursal ,
		'organizacion'=>$id_organizacion));

		
	}

	}

	 else if(isset($_POST['tabla_modals']))
	{
			$usuarios  = New usuarios();
			$Data =array();
			$result = $usuarios->Los_perfiles_de_Persona($_POST['id_persona'] );
			
			while( $datosBD = pg_fetch_array($result['sql0']))
			{
					 	 	$var = $usuarios->SeleccionarOrganizacionUsuario(
					   		$datosBD['nombre_perfil'] ,$_POST['id_persona'] );

				 while ($filas=pg_fetch_assoc($var))  
				 { 		$filas['nombre_perfil'] = $datosBD['nombre_perfil'] ;
						$filas['id_perfil'] = $datosBD['id_perfil'] ;
				        $Data[]= $filas; 
				 } 
			}

			while( $datosBD = pg_fetch_array($result['sql1'])){

					$var = $usuarios->SeleccionarOrganizacionUsuario(
					$datosBD['nombre_perfil'] ,$_POST['id_persona'] );

				 while ($filas=pg_fetch_assoc($var))  
				 { 		$filas['nombre_perfil'] = $datosBD['nombre_perfil'] ;
						$filas['id_perfil'] = $datosBD['id_perfil'] ;
				        $Data[]= $filas; 
				 } 
			}	 

		echo json_encode($Data);
	}else if(isset($_POST['Datossession']))
	{	
			 $usuarios=new usuarios(); 
			 $datos= $usuarios->Datos_usuario($_POST['id_persona']);

			 echo json_encode($datos);
	}
	else if(isset($_POST['ModificarDatos']))
	{
		$usuarios=new usuarios(); 
		 $result =$usuarios->modificarDatos($_POST);
		echo json_encode($result);
	}
	
?>



=======
<?php

  include("../../../BASE_DATOS/Conect.php");
  include('../modelo/mod_usuario.php');
   $ConexionBD =new Conexion();
   $ConexionBD->Conectar();
  
	
	if(isset($_POST['ingresar']))
	{
		 $usuarios=new usuarios(); 

	$usuarios->usuario=$_POST['usuario'];
	$usuarios->contrasena=$_POST['contrasena'];


	//Hacemos la conexion y buscamos en base de datos al usuario

	#Conexion a la base de datos
	$result=$usuarios->consultar_iniciar_sesion();
	$num = pg_num_rows($result);

	if($num == 0 ){
	echo json_encode(array( 'num'=>$num ) );
	}else 
	{

	$user = array();
	while ($autenticado = pg_fetch_array($result)) {
		$user['id_usuario']=$autenticado['id_usuario'];	 // PARA LA  BITACORA POR  AHORA
    	$user['id_persona']=$autenticado['id_persona'];	
    	$user['id_perfil']=$autenticado['id_perfil'];	
    	$user['nombre_perfil']=$autenticado[2];	
    	
	}


	$cuantos = $usuarios->cuantos_perfiles_persona( $user['id_persona'] );
	$total= $cuantos['numeroO'] + $cuantos['numeroE'] ;
	
	if( $num==1 )
	{
			$id_organizacion= $usuarios->consultar_id_organizacion( $user['id_persona'] ,$user['id_perfil'] );
			$codigo_sucursal= $usuarios->codigo_sucursal($user['id_persona']);
	}else	

	if( $total > 1  ) 
	{
	//	echo pg_num_rows($cuantos);
		
		$num  = $total;

		$id_organizacion = '';

	}


	$personadatos = $usuarios->nombrePersona($user['id_persona']);
	echo json_encode( array( 'num'=> $num  ,
		'id_perfil'=>$user['id_perfil'] ,
		'id_usuario'=>$user['id_usuario'] ,
		'persona' => $user['id_persona'] , 
		'personadatos' => $personadatos ,
		'perfil'  => $user['nombre_perfil'] , 
		'codigo_sucursal'=> $codigo_sucursal ,
		'organizacion'=>$id_organizacion));

		
	}

	}

	 else if(isset($_POST['tabla_modals']))
	{
			$usuarios  = New usuarios();
			$Data =array();
			$result = $usuarios->Los_perfiles_de_Persona($_POST['id_persona'] );
			
			while( $datosBD = pg_fetch_array($result['sql0']))
			{
					 	 	$var = $usuarios->SeleccionarOrganizacionUsuario(
					   		$datosBD['nombre_perfil'] ,$_POST['id_persona'] );

				 while ($filas=pg_fetch_assoc($var))  
				 { 		$filas['nombre_perfil'] = $datosBD['nombre_perfil'] ;
						$filas['id_perfil'] = $datosBD['id_perfil'] ;
				        $Data[]= $filas; 
				 } 
			}

			while( $datosBD = pg_fetch_array($result['sql1'])){

					$var = $usuarios->SeleccionarOrganizacionUsuario(
					$datosBD['nombre_perfil'] ,$_POST['id_persona'] );

				 while ($filas=pg_fetch_assoc($var))  
				 { 		$filas['nombre_perfil'] = $datosBD['nombre_perfil'] ;
						$filas['id_perfil'] = $datosBD['id_perfil'] ;
				        $Data[]= $filas; 
				 } 
			}	 

		echo json_encode($Data);
	}else if(isset($_POST['Datossession']))
	{	
			 $usuarios=new usuarios(); 
			 $datos= $usuarios->Datos_usuario($_POST['id_persona']);

			 echo json_encode($datos);
	}
	else if(isset($_POST['ModificarDatos']))
	{
		$usuarios=new usuarios(); 
		 $result =$usuarios->modificarDatos($_POST);
		echo json_encode($result);
	}
	
?>



>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
