<?php 



class persona
{
	private $nombre;
	private $cedula;
	private $apellido;
	
	private $telefono;
	private $correo;
	private $usuario;
	private $contrasena;
	private $descripcion;
	private $pregunta;
	private $respuesta;

	public function SetPersonaEncargada( $formulario = array() )
	{
		
		$this->cedula	 	=$formulario['cedula'];
		$this->nombre 		=$formulario['nombre'];
		$this->apellido		 =$formulario['apellido'];
		$this->telefono		 =$formulario['telefono'];

		$this->correo			=$formulario['correo'];
		$this->usuario			=$formulario['usuario'];
		$this->contrasena		=$formulario['contrasena'];
		$this->descripcion		=$formulario['descripcion'];
		if(isset($formulario['pregunta']))
		{
		 $this->pregunta		=$formulario['pregunta'];
		 $this->respuesta		=$formulario['respuesta'];
		}
	}



	public function verificarPersona_OficinaOrganizacion( $p , $o , $d )
	{
	 $num=	pg_num_rows(pg_query(" SELECT  * FROM pasantias.persona_organizacion_oficina WHERE id_persona = $p AND id_organizacion =$o AND id_oficina = $d  "));
	 return $num;
	}

	function id_usuario_persona( $id_persona  )
	{
		 $exe  =pg_query(" SELECT id_usuario FROM pasantias.usuario JOIN  pasantias.persona ON usuario.id_persona = persona.id_persona AND persona.id_persona =$id_persona ; ");
		 $id = pg_fetch_array($exe)	;
		 return $id[0];
	}


	public function RegistroPersonaEmpresa()
	{

		$id  =$this->Buscaridforcedula($this->cedula);

		if ($id['result'] == 1)
		{
			$id_persona =$id['id_persona'];
			$usuario=$this->RegistroUsuario($id_persona , 2);
		    //$usuario=$this->estePerfil_estaPersona($id['id_persona'] , 2 );

		return	array( 'id_persona'=>$id['id_persona'],
					   'persona-Registro'=>'CEDULA YA EXISTE');
		}else{

		$result=pg_query(" INSERT INTO pasantias.persona ( cedula, nombre, apellido ,telefono ,correo ) 

		VALUES (  '$this->cedula' , '$this->nombre' , '$this->apellido', '$this->telefono' , '$this->correo') ;") or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());//ejecuta la tira sql
		
	    $id_persona = $this->idPersona();

	    $usuario=$this->RegistroUsuario($id_persona , 2);
	   
	    $id = $this->Buscaridforcedula( $this->cedula );
	    return	array(   'usuario-Registro'=>pg_affected_rows($usuario)
	    				,'persona-Registro'=>pg_affected_rows($result)
	    				,'id_persona'=>$id['id_persona']
	    				);
		} // ELSE DE SI  LA  CEDULA  NO ESTA REGISTRADA...

	}

	public function Buscaridforcedula( $cedula )
	{
		$sql = pg_query("SELECT id_persona FROM pasantias.persona WHERE persona.cedula = '$cedula'");
		$id = pg_fetch_array($sql);
		return array( 'id_persona'=>$id[0] , 'result'=>pg_num_rows($sql));
	}

	public function RegistroPersonaEncargadaInstituto( $sucursal )
	{
		$veri= $this->Buscaridforcedula( $this->cedula );
		if($veri['result']==0){

		$result=pg_query(" INSERT INTO pasantias.persona ( cedula, nombre, apellido ,telefono ,correo ) 

		VALUES (  '$this->cedula' , '$this->nombre' , '$this->apellido', '$this->telefono' , '$this->correo') ;") or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());//ejecuta la tira sql
			
	    $id_persona = $this->idPersona();
	    $usuario=$this->RegistroUsuario($id_persona  , 6);
	    //$encargado=$this->RegistroEncargado($id_persona );
	    $id = $this->Buscaridforcedula( $this->cedula );
	    return	array(   'usuario'=>pg_affected_rows($usuario)
	    				,'persona'=>pg_affected_rows($result)
	    				//,'encargado'=>pg_affected_rows($encargado)
	    				,'id_persona'=>$id['id_persona']
	    				);
	}else 
	{
			$id_persona = $veri['id_persona'];
			$usuario=$this->RegistroUsuario($id_persona  , 6);
		
			    return	array( 'id_persona'=>$id_persona	);
	}
	    
	}
	

	public function idPersona()
	{

	$sql = " SELECT * FROM pasantias.ultimoid_persona ; ";

	$result=pg_query($sql);//ejecuta la tira sql

	$fila = pg_fetch_array($result);
	
	return  $fila[0];

	}

	public function verificarUsuariosRegistrados()
	{
		$sql  = pg_query("SELECT * FROM pasantias.usuario  ");
		$vard = pg_num_rows($sql);
		$estatus ="";
		if ($vard==0){$estatus="APROBADO";}else {$estatus="PENDIENTE";}

		return $estatus;
	}

	public function id_usuario()
	{
		$sql = pg_query("SELECT MAX(id_usuario) +1 AS id , 1 AS id_auxiliar FROM pasantias.usuario  ;");

		$id = pg_fetch_array( $sql);
		$id_usuario = $id[0];
		if ( $id[0] == 0 )
		{
			$id_usuario = $id[1];
		}
		return $id_usuario;
	}

	public function RegistroUsuario( $id_persona  , $id_perfil )
	{	
		$id_usuario = $this->id_usuario();
		$estatus= $this->verificarUsuariosRegistrados();
		$insert = " INSERT INTO  pasantias.usuario  ( id_usuario, id_persona, usuario , contrasena , estatus , pregunta , respuesta)

		VALUES ( $id_usuario,$id_persona,'$this->usuario' , '$this->contrasena' , '$estatus' , '$this->pregunta' , '$this->respuesta' ) ;";

		$execute =pg_query( $insert)  or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
		
		return $execute ;
	}

	public function RegistroEncargado($Sucursal ,$persona , $oficina , $perfil)
	{
		$execute =pg_query( " INSERT INTO  pasantias.encargado  ( codigo_sucursal , id_persona , id_oficina ,id_perfil )
		VALUES ('$Sucursal' ,$persona , $oficina , $perfil) ;")  or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		return $execute ;
	}

	public function UsuarioVerificar($user)
	{
		$result= pg_query("SELECT usuario FROM pasantias.usuario where usuario='".$user."' ");
		return   pg_num_rows($result);
	}

	public function correoVerificar($Correo)
	{
		$result= pg_query("SELECT correo FROM pasantias.persona where correo='".$Correo."' ");
		return   pg_num_rows($result);

	}

	public function cedulaVerificar($cedula){
		$result= pg_query("SELECT cedula FROM pasantias.persona where cedula='".$cedula."' ");
		return   pg_num_rows($result);
	}
	public function personaOrganizacion($persona , $oficina , $Sucursal , $perfil )
	{	
		$estatus= $this->verificarUsuariosRegistrados();
		if($perfil==6){$estatus='APROBADO';}
		$veri = $this->Pendiente( $persona , $oficina , $Sucursal);

		if($veri==0)
		{
			$insert = pg_query("INSERT INTO pasantias.persona_organizacion_oficina  
			( codigo_sucursal , id_persona , id_oficina , id_perfil ,descripcion, estado ,fecha_solicitud ) VALUES
			( '$Sucursal' ,$persona , $oficina , $perfil ,'$this->descripcion' ,'$estatus', now() )");
			if($perfil==6)
			{
				$this->RegistroEncargado($Sucursal ,$persona , $oficina , $perfil);
			}
		return array('result'=>pg_affected_rows($insert) ,'datos'=>$persona );
	}else if($veri==1){return array('result'=>'Ya  Existe' ,'datos'=>$persona );}
		

	}

	function Pendiente( $persona , $oficina , $sucurrsal)
	{
		$sql = pg_query("SELECT id_persona  FROM pasantias.persona_organizacion_oficina WHERE id_persona=$persona AND id_oficina=$oficina AND codigo_sucursal='$sucurrsal' ;");

		return pg_num_rows($sql);
	}

	public function personasRegistradas()
	{
		$sql =	pg_query("SELECT cedula, nombre , apellido FROM pasantias.persona join pasantias.usuario on usuario.id_persona = persona.id_persona");

		return $sql;
	}


		public function actualizarAprobacionUsuarios( $form  = array() )
		{
			$estatus  = $form['action'];
			$id_usuario  = $form['id_usuario'];
			
			$execu=pg_query("UPDATE pasantias.usuario SET estatus='$estatus' WHERE id_usuario=$id_usuario ;");

			return pg_affected_rows($execu);
		}

			function Actualizar_Solicitud( $formulario = array())
			{
			$id_persona =	$formulario['id_persona'];
			$sucursal =	$formulario['sucursal'];
			$id_oficina=	$formulario['id_oficina'];
			$estatus  =$formulario['action'];

			if(isset($formulario['aprobarUsuario'])){
		 $sql=  pg_query(" UPDATE pasantias.persona_organizacion_oficina SET estado='$estatus' , fecha_aceptacion=now() WHERE estado='PENDIENTE' AND id_persona =$id_persona AND codigo_sucursal ='$sucursal'  AND id_oficina = $id_oficina ;");
		 	}else
		 	if(isset($formulario['rechazarUsuario']))
		 	{
		 		$descripcion = $formulario['descripcion'];
		 		$fecha_r = $formulario['fecha_rechazo'];
		 $sql=  pg_query(" UPDATE pasantias.persona_organizacion_oficina SET estado='$estatus' , fecha_aceptacion='$fecha_r', observacion ='$descripcion'  WHERE estado='PENDIENTE' AND id_persona =$id_persona AND codigo_sucursal ='$sucursal'  AND id_oficina = $id_oficina ;");		
		 	}

		 $update = pg_affected_rows($sql);
			return $update;
			}

	function buscar_datos_de_esta_persona_y_solicitud($formulario = array())
	{

			$id_persona =	$formulario['id_persona'];
			$sucursal =	$formulario['sucursal'];
			$id_oficina=	$formulario['id_oficina'];
			$id_ip 	=		$formulario['id_ip'];

	$sql =pg_query("SELECT persona.nombre , persona.apellido,persona.cedula , oficina.nombre_oficina 
	, persona.telefono 
	, organizacion.nombre_organizacion
	, persona_organizacion_oficina.fecha_solicitud
FROM pasantias.persona 
INNER JOIN  pasantias.persona_organizacion_oficina on persona_organizacion_oficina.id_persona = persona .id_persona AND estado = 'PENDIENTE'

     JOIN pasantias.organizacionmunicipio ON persona_organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
     JOIN pasantias.organizacion ON organizacionmunicipio.id_organizacion = organizacion.id_organizacion
     JOIN pasantias.convenio_organizacion ON organizacion.id_organizacion = convenio_organizacion.id_organizacion 
     --AND persona_organizacion_oficina.id_organizacion = organizacion.id_organizacion 
     --AND convenio_organizacion.id_organizacion = organizacion.id_organizacion 
     JOIN pasantias.oficina ON persona_organizacion_oficina.id_oficina = oficina.id_oficina
     JOIN pasantias.instituto_principal ON instituto_principal.id_ip = convenio_organizacion.id_ip
     
     AND instituto_principal.id_ip= $id_ip AND persona.id_persona = $id_persona
     AND organizacionmunicipio.codigo_sucursal = '$sucursal' AND oficina.id_oficina= $id_oficina ;");
		$num= pg_num_rows( $sql);

		return $sql ;
	}

		function buscar_datos_de_esta_persona_y_solicitud_instituto($formulario = array())
	{

			$id_persona =	$formulario['id_persona'];
			$sucursal =	$formulario['sucursal'];
			$id_oficina=	$formulario['id_oficina'];
			$id_ip 	=		$formulario['id_ip'];

	$sql =pg_query("SELECT persona.nombre , persona.apellido,persona.cedula , oficina.nombre_oficina 
	, persona.telefono 
	, organizacion.nombre_organizacion 
	, organizacion.siglas
	, persona_organizacion_oficina.fecha_solicitud
	, persona_organizacion_oficina.descripcion , persona.correo , perfil.nombre_perfil
FROM pasantias.persona 
INNER JOIN  pasantias.persona_organizacion_oficina on persona_organizacion_oficina.id_persona = persona .id_persona
AND estado = 'PENDIENTE'

       JOIN pasantias.organizacionmunicipio ON persona_organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
     JOIN pasantias.organizacion ON organizacionmunicipio.id_organizacion = organizacion.id_organizacion
     JOIN pasantias.convenio_organizacion ON organizacion.id_organizacion = convenio_organizacion.id_organizacion 
     --AND persona_organizacion_oficina.id_organizacion = organizacion.id_organizacion 
     --AND convenio_organizacion.id_organizacion = organizacion.id_organizacion 
     JOIN pasantias.oficina ON persona_organizacion_oficina.id_oficina = oficina.id_oficina
     JOIN pasantias.instituto_principal ON instituto_principal.id_ip = convenio_organizacion.id_ip
     JOIN pasantias.perfil ON perfil.id_perfil= persona_organizacion_oficina.id_perfil
     
     AND instituto_principal.id_ip= $id_ip AND persona.id_persona = $id_persona
     AND organizacionmunicipio.codigo_sucursal = '$sucursal' AND oficina.id_oficina= $id_oficina ;");
		$num= pg_num_rows( $sql);

		return $sql ;
	}

	function cedulasRegistradasAutoComplete()
	{

		$sql =pg_query("SELECT cedula FROM pasantias.persona ;");

		return $sql;
	}

	function datosPersonalesCedula($cedula)
	{
		$sql =pg_query("SELECT nombre || ' - ' || apellido as datos FROM pasantias.persona WHERE cedula='$cedula' ;");
		return$sql;
	}

	function CedulaSElleccionada($cedula)
	{
		$sql =pg_query("SELECT 1 as caso, nombre ,apellido,correo ,telefono , contrasena , usuario , pregunta, respuesta

		 FROM pasantias.persona 
		 INNER JOIN pasantias.usuario 
		 	ON usuario .id_persona = persona.id_persona
		 WHERE cedula='$cedula' ;");


		return $sql;
	}

	function datosPersona($cedula)
	{

			$sql =pg_query("SELECT 2 as caso, nombre ,apellido,correo ,telefono 

			 FROM pasantias.persona 

			 WHERE cedula='$cedula' ;");

			return $sql;
	}

}
