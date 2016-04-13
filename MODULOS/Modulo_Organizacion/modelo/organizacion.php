<?php 

include('../../Modulo_Estado/modelo/estadoMunicipio.php');


class organizacion
{
	private $nombre_organizacion;
	private $RIF_Oraganizacion;
	private $tipoEmpresa;
	private $descripcion;
	private $telefono;
	private $correo;
	private $codigo;
	private $id_municipio;
	private $direccion;
	private $siglas;
	private $id_organizacionPrincipal;



	public function getformularioInstitutoPrincipal( $formulario = array()  )
	{

		
		$this->nombre_organizacion =$formulario['nombre'];
		$this->RIF_Oraganizacion	 =$formulario['rif'];
		$this->tipoEmpresa		 =$formulario['tipo'];
		$this->descripcion		 =$formulario['descripcion'];
		$this->telefono		=$formulario['telefono'];
		$this->correo			=$formulario['correo'];
		
		$this->id_municipio	=$formulario['municipio'];
		$this->direccion		=$formulario['direccion'];
		
		$this->siglas		=$formulario['siglas'];
		
	}
		public function getformularioEmpresa( $formulario = array()  )
	{

		
		$this->nombre_organizacion =$formulario['nombre'];
		$this->RIF_Oraganizacion	 =$formulario['rif'];
		$this->tipoEmpresa		 =$formulario['tipo'];
		$this->descripcion		 =$formulario['descripcion'];
		$this->telefono		=$formulario['telefono'];
		$this->correo			=$formulario['correo'];
		
		$this->id_municipio	=$formulario['municipio'];
		$this->direccion		=$formulario['direccion'];
		$this->id_organizacionPrincipal  =$formulario['organizacion'];
		
	}


    public function getformularioInstitutoConvenio(  $formulario = array() )
    {

    	$this->nombre_organizacion =$formulario['nombre'];
		$this->RIF_Oraganizacion	 =$formulario['rif'];
		$this->tipoEmpresa		 =$formulario['tipo'];
		$this->descripcion		 =$formulario['descripcion'];
		$this->telefono		=$formulario['telefono'];
		$this->correo			=$formulario['correo'];
		
		$this->id_municipio	=$formulario['municipio'];
		$this->direccion		=$formulario['direccion'];
		
		$this->siglas		=$formulario['siglas'];
		$this->id_organizacionPrincipal  =$formulario['id_ip'];
    }


    // AQUI EN ESTE  MODELO SE  REALIZAN  · TIPOS DE REGISTROS DIFERENTES LA  BUAL  HAY  UNA
    // QUE TIENE DE LOS  2 PORQUE SI PS !  ES INTERESANTE ME GUSTO TRABAJAR  CON ESTE MODULO

	public function RegistroEmpresa(  )
	{
		 $id_organization= $this->id_Organizacion();
		 $id_empresa 	 = $this->id_Empresa();
		


 $result=pg_query(" INSERT INTO pasantias.organizacion ( id_organizacion, rif ,id_tipo_organizacion , descripcion 

			, telefono ,correo  ) 

			VALUES ( $id_organization, '$this->RIF_Oraganizacion' , $this->tipoEmpresa , 

			upper('$this->descripcion'), '$this->telefono' , '$this->correo'  ) ");//ejecuta la tira sql


		$insert = " INSERT INTO  pasantias.empresa  ( nombre_empresa , id_organizacion )

		VALUES ( upper('$this->nombre_organizacion') ,$id_organization ) ;";

		$execute =pg_query( $insert)  or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

			$this->Ubicacionorganizacion( $id_organization,$this->id_municipio );

		$asignacion= pg_query("INSERT INTO pasantias.convenio_organizacion


		VALUES ( $this->id_organizacionPrincipal, $id_organization , now() ) ");

		return pg_affected_rows($execute);


	}


		public function RegistroInstituto(   )
	{
		 $id_organization= $this->id_Organizacion();
		 
		 $id_Instituto_Principal =$this->id_Instituto_Principal();


		$execute1=pg_query("INSERT INTO pasantias.organizacion VALUES ( $id_organization,$this->tipoEmpresa 

			,'$this->RIF_Oraganizacion','$this->nombre_organizacion', '$this->correo' , '$this->telefono'
			, '$this->descripcion' ,'$this->siglas'  ) ");

		$execute3= pg_query("INSERT INTO pasantias.instituto_principal  VALUES
		($id_Instituto_Principal, $id_organization, 'ACTIVO',now()) ");

		$execute4 = $this->Ubicacionorganizacion( $id_organization , $this->id_municipio );

		return array( 'return1'		=>pg_affected_rows($execute1),
					  'return3'		=>pg_affected_rows($execute3),
					  'return4'		=>pg_affected_rows($execute4));

	}

		public function RegistroInstitutoConvenio(   )
	{
		 $id_organization= $this->id_Organizacion();
		 
		 $id_Instituto_Principal =$this->id_Instituto_Principal();


		$execute1=pg_query("INSERT INTO pasantias.organizacion VALUES ( $id_organization,$this->tipoEmpresa 

			,'$this->RIF_Oraganizacion', '$this->nombre_organizacion', '$this->correo' , '$this->telefono'
			, '$this->descripcion'  ,'$this->siglas' ) ");

		$execute3= pg_query("INSERT INTO pasantias.convenio_organizacion 

		VALUES ( $this->id_organizacionPrincipal, $id_organization , now() ) ");

		$execute4 = $this->Ubicacionorganizacion( $id_organization , $this->id_municipio );

		return array( 'return1'		=>pg_affected_rows($execute1),
					 
					  'return3'		=>pg_affected_rows($execute3),
					  'return4'		=>pg_affected_rows($execute4));

	}

	function Ubicacionorganizacion( $organizacion ,  $municipio )
	{	
		$var=  $this->Verificarids_Organizacion( $organizacion ,  $municipio );

		if(($var['organizacion']==1) && ( $var['municipio']==1))
		{
		$insert = pg_query("INSERT INTO pasantias.organizacionmunicipio ( id_municipio , id_organizacion , domicilio) 
		VALUES ($this->id_municipio ,$organizacion,'$this->direccion' ) ");

		return $insert;
		}
	}

	function Verificarids_Organizacion( $organizacion ,  $municipio ){

		$sqlorganizacion = pg_query( " SELECT true FROM pasantias.organizacion 
			WHERE id_organizacion = $organizacion ;" );
		$sqlmunicipio = pg_query( " SELECT true FROM pasantias.municipio 
			WHERE id_municipio = $municipio ;" );
		return array( 'organizacion' =>pg_num_rows($sqlorganizacion),
					  'municipio' => pg_num_rows($sqlmunicipio) );


	}

	public function id_Organizacion()
	{

		$busqueda = pg_query("SELECT  id,1 as id_axiliar FROM pasantias.proximoid_organizacion");

		$id_Organizacion ;

		while ($column =pg_fetch_array($busqueda)) {

			$id_Organizacion = $column[0];

			if(($column[0]==0)||($column[0]==null))
			{
				$id_Organizacion = $column[1];
			}
		}

		return $id_Organizacion;
	}


	public function id_Instituto_Principal()
	{

		$busqueda=	pg_query("SELECT id,1 as id_axiliar FROM pasantias.proximoid_institutoprincipal ");
		$id_instituto_P ;

		while($column = pg_fetch_array($busqueda))
		{
			$id_instituto_P =  $column[0];
			if(($column[0]==0)||($column[0]==null))
			{
					$id_instituto_P= $column[1];
			}

		}
			return $id_instituto_P;


	}
	public function buscarid_OrganizacionConvenio( $id_organizacionConvenio )
	{
		$empresa=pg_query("SELECT organizacion.id_organizacion FROM pasantias.organizacion
				
 		WHERE organizacion.id_organizacion=$id_organizacionConvenio");

 		$id = pg_fetch_array($empresa);
 		return $id[0];
	}

	

	public function buscarid_OrganizacionInstituto( $id_ip )
	{
		$instituto=pg_query("SELECT organizacion.id_organizacion FROM pasantias.organizacion
		
		join pasantias.instituto_principal on organizacion.id_organizacion=instituto_principal.id_organizacion
 		WHERE instituto_principal.id_ip=$id_ip");

 		$id = pg_fetch_array($instituto);
 		return $id[0];

	}

	public function id_Empresa()
	{

		$busqueda=	pg_query("SELECT id,1 as id_axiliar FROM pasantias.proximoid_empresa ");
		$id_Empresa ;

		while($column = pg_fetch_array($busqueda))
		{
			$id_Empresa =  $column[0];
			if(($column[0]==0)||($column[0]==null))
			{
					$id_Empresa= $column[1];
			}

		}
			return $id_Empresa;
	}

	public function institucionesPrincipales()
	{


	$sql = pg_query( "SELECT organizacionmunicipio.codigo_sucursal , siglas , nombre_estado , nombre_municipio , nombre_tipo_organizacion , id_ip FROM pasantias.organizacion INNER JOIN pasantias.instituto_principal 
	ON organizacion.id_organizacion = instituto_principal.id_organizacion INNER JOIN pasantias.organizacionmunicipio
	ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion  INNER JOIN pasantias.municipio
	ON organizacionmunicipio.id_municipio = municipio.id_municipio INNER JOIN pasantias.estado 
	ON estado.id_estado = municipio.id_estado INNER JOIN pasantias.tipo_organizacion
	ON organizacion.id_tipo_organizacion=tipo_organizacion.id_tipo_organizacion;" );
	
	return 	array( 'results'=>pg_num_rows($sql) , 'tira'=>$sql );	

	}

	public function nombreinstitutoP($id_ip)
	{	
		$sql = pg_query("SELECT siglas FROM pasantias.organizacion 
			INNER JOIN pasantias.instituto_principal ON instituto_principal.id_ip = $id_ip
			AND  instituto_principal.id_organizacion = organizacion.id_organizacion ;");

		$nombre =  pg_fetch_array($sql);
		return $nombre[0];
	}

	public function institucionesConvenio()
	{
		$sql =  pg_query("SELECT convenio_organizacion.id_ip,  siglas  , tipo_organizacion.nombre_tipo_organizacion ,
		 estado.nombre_estado , municipio.nombre_municipio ,organizacion.id_organizacion ,nombre_organizacion FROM  pasantias.organizacion
 INNER JOIN pasantias.convenio_organizacion ON convenio_organizacion.id_organizacion = organizacion.id_organizacion 
 INNER JOIN pasantias.tipo_organizacion ON tipo_organizacion .id_tipo_organizacion = organizacion .id_tipo_organizacion

 INNER JOIN pasantias.organizacionmunicipio ON organizacionmunicipio.id_organizacion = organizacion.id_organizacion AND organizacionmunicipio.observacion='CENTRAL'
 INNER JOIN pasantias.municipio ON municipio.id_municipio = organizacionmunicipio.id_municipio
 INNER JOIN pasantias.estado ON estado.id_estado = municipio.id_estado 
 INNER JOIN pasantias.instituto_principal ON instituto_principal.id_ip = convenio_organizacion.id_ip   ;");


		return $sql;
	}


	public function Empresas()
	{

		$sql= pg_query(" SELECT siglas  , id_ip ,id_empresa,nombre_empresa, nombre_tipo_organizacion ,nombre_estado ,nombre_municipio,domicilio FROM
							pasantias.Empresas_Registradas ");

		return array( 'results'=>pg_num_rows($sql) ,'tira'=>$sql );

	}



	public function registrosTipoOrganizacionSelectInstituto()
	{

		
		$sqlite ="SELECT tipo_organizacion.id_tipo_organizacion

		, tipo_organizacion.nombre_tipo_organizacion 

		 FROM pasantias.tipo_organizacion WHERE estatus = 'ACTIVO' ORDER BY nombre_tipo_organizacion;"; 

		$execute =pg_query( $sqlite);


		return $execute;

	}


	function  consulta_estaCentral($id_organizacion)
	{
		$sql = pg_query("SELECT  organizacion.nombre_organizacion, siglas , nombre_tipo_organizacion , nombre_estado , nombre_municipio , domicilio FROM pasantias.organizacion JOIN pasantias.organizacionmunicipio 
						ON organizacionmunicipio.id_organizacion = organizacion.id_organizacion AND organizacion.id_organizacion = $id_organizacion AND observacion = 'CENTRAL'
						JOIN pasantias.convenio_organizacion On convenio_organizacion.id_organizacion = organizacion.id_organizacion
						JOIN pasantias.tipo_organizacion On tipo_organizacion.id_tipo_organizacion = organizacion.id_tipo_organizacion
						JOIN pasantias.municipio ON municipio.id_municipio = organizacionmunicipio.id_municipio 
						JOIN pasantias.estado ON estado .id_estado = municipio.id_estado;");
		return pg_fetch_assoc($sql);
	}

				
	function RegistraSucursal( $form = array())
	{

		$id_organizacion=$form['id_organizacion']; $id_municipio=$form['id_municipio']; $domicilio=$form['direccion'];

		$sql = pg_query("INSERT INTO pasantias.organizacionmunicipio ( id_organizacion, id_municipio, domicilio, observacion)
		 VALUES ( $id_organizacion ,$id_municipio , '$domicilio', 'SUCURSAL') ;");
		$num = pg_affected_rows($sql);

		pg_free_result($sql);
		return $num;

	}

	function buscarSucursales($id_organizacion)
	{

		$sql = pg_query("SELECT organizacionmunicipio.codigo_sucursal, organizacion.nombre_organizacion , organizacion.siglas 
			, organizacionmunicipio.domicilio , municipio.nombre_municipio ,
			estado.nombre_estado ,organizacionmunicipio.observacion
			FROM  pasantias.organizacionmunicipio JOIN pasantias.organizacion 
			ON organizacionmunicipio.id_organizacion = organizacion.id_organizacion AND organizacion.id_organizacion=$id_organizacion 
			JOIN pasantias.municipio ON municipio.id_municipio= organizacionmunicipio.id_municipio 
			JOIN pasantias.estado ON estado.id_estado = municipio.id_estado; ");

		return $sql;
	}

	function Incluir_organizacionOficina( $idDepartamento , $codigoSucursal )
	{	

		$verificaids =" SELECT * FROM pasantias.organizacion_oficina WHERE id_oficina =$idDepartamento AND codigo_sucursal = '$codigoSucursal'  ;";

		$execute = pg_query($verificaids);

		$result = pg_num_rows($execute);

		if( pg_num_rows($execute)==0  ){

		$insert ="INSERT INTO pasantias.organizacion_oficina ( codigo_sucursal ,  id_oficina ,estado , observacion ) 

			VALUES ('$codigoSucursal', $idDepartamento , 'ACTIVO' , 'Registro Interno Del Sistema')";
		$execute = pg_query($insert);
		$result = pg_affected_rows($execute);
		}
			

		return $result ;
	}

	public function selectEstado()
	{
		$clase = new estadoMunicipio();

		$execute =$clase->consultEstado( );

		return $execute ;
	}

		public function selectmunicipio( $arreglo =array() )
	{
		$id_estado= $arreglo['select'];
		
		$clase = new estadoMunicipio();

		$execute =$clase->registrosMunicipioSelect( $id_estado );

		return $execute ;
	}


	public function cargaUsuariosPendientes_InstitutoConvenio($id_ip)
	{
	 $sql =	pg_query("SELECT persona.nombre,
    persona.apellido,
    persona.telefono AS telefono_p,
    persona.correo AS correo_p,
    organizacion.nombre_organizacion,
    organizacion.telefono AS telefono_e,
    organizacion.correo AS correo_e,
    oficina.nombre_oficina ,
    fecha_solicitud ,
    persona_organizacion_oficina.id_persona , persona_organizacion_oficina.codigo_sucursal , persona_organizacion_oficina.id_oficina ,
        cast (persona_organizacion_oficina.id_persona  ||'$'|| persona_organizacion_oficina.codigo_sucursal  || '$' || persona_organizacion_oficina.id_oficina AS varchar ) AS solicitud
    FROM pasantias.persona
    
     JOIN pasantias.persona_organizacion_oficina ON persona_organizacion_oficina.id_persona = persona.id_persona
     AND persona_organizacion_oficina.estado='PENDIENTE'
     JOIN pasantias.organizacionmunicipio ON persona_organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
     JOIN pasantias.organizacion ON organizacionmunicipio.id_organizacion= organizacion.id_organizacion
     JOIN pasantias.convenio_organizacion ON convenio_organizacion.id_organizacion = organizacion.id_organizacion

     JOIN pasantias.oficina ON persona_organizacion_oficina.id_oficina = oficina.id_oficina
     JOIN pasantias.instituto_principal ON instituto_principal.id_ip = convenio_organizacion.id_ip
      
     AND instituto_principal.id_ip=$id_ip ;");
		return $sql;
	}
	public function cargaUsuariosAprobados_InstitutoConvenio($id_ip)
	{
	 $sql =	pg_query("SELECT persona.nombre,
    persona.apellido,
    persona.telefono AS telefono_p,
    persona.correo AS correo_p,
    organizacion.nombre_organizacion,
    organizacion.telefono AS telefono_e,
    organizacion.correo AS correo_e,
    oficina.nombre_oficina ,
    fecha_solicitud ,
    persona_organizacion_oficina.id_persona , persona_organizacion_oficina.codigo_sucursal , persona_organizacion_oficina.id_oficina ,
        cast (persona_organizacion_oficina.id_persona  || '$' || persona_organizacion_oficina.codigo_sucursal  || '$' || persona_organizacion_oficina.id_oficina AS varchar ) AS solicitud
    FROM pasantias.persona
    
     JOIN pasantias.persona_organizacion_oficina ON persona_organizacion_oficina.id_persona = persona.id_persona
     AND persona_organizacion_oficina.estado='APROBADO'
     JOIN pasantias.organizacionmunicipio ON persona_organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
     JOIN pasantias.organizacion ON organizacionmunicipio.id_organizacion= organizacion.id_organizacion
     JOIN pasantias.convenio_organizacion ON convenio_organizacion.id_organizacion = organizacion.id_organizacion

     JOIN pasantias.oficina ON persona_organizacion_oficina.id_oficina = oficina.id_oficina
     JOIN pasantias.instituto_principal ON instituto_principal.id_ip = convenio_organizacion.id_ip
      
     AND instituto_principal.id_ip=$id_ip ;");
		return $sql;
	}
	public function cargaUsuariosRechazados_InstitutoConvenio($id_ip)
	{
 	$sql =	pg_query("SELECT persona.nombre,
    persona.apellido,
    persona.telefono AS telefono_p,
    persona.correo AS correo_p,
    organizacion.nombre_organizacion,
    organizacion.telefono AS telefono_e,
    organizacion.correo AS correo_e,
    oficina.nombre_oficina ,
    fecha_solicitud ,
    persona_organizacion_oficina.id_persona , persona_organizacion_oficina.codigo_sucursal , persona_organizacion_oficina.id_oficina ,
        cast (persona_organizacion_oficina.id_persona  || '$' || persona_organizacion_oficina.codigo_sucursal  || '$' || persona_organizacion_oficina.id_oficina AS varchar ) AS solicitud
    FROM pasantias.persona
    
     JOIN pasantias.persona_organizacion_oficina ON persona_organizacion_oficina.id_persona = persona.id_persona
     AND persona_organizacion_oficina.estado='RECHAZADO'
     JOIN pasantias.organizacionmunicipio ON persona_organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
     JOIN pasantias.organizacion ON organizacionmunicipio.id_organizacion= organizacion.id_organizacion
     JOIN pasantias.convenio_organizacion ON convenio_organizacion.id_organizacion = organizacion.id_organizacion

     JOIN pasantias.oficina ON persona_organizacion_oficina.id_oficina = oficina.id_oficina
     JOIN pasantias.instituto_principal ON instituto_principal.id_ip = convenio_organizacion.id_ip
      
     AND instituto_principal.id_ip=$id_ip ;");
		return $sql;
	}



	function empresasConvenio($id_ip)
	{
		$sql = pg_query("SELECT empresa.nombre_empresa , organizacion.rif , domicilio , nombre_municipio , nombre_estado
		    FROM pasantias.empresa INNER JOIN pasantias.organizacion ON organizacion.id_organizacion=empresa.id_organizacion
			INNER JOIN pasantias.convenio_organizacion ON convenio_organizacion.id_organizacion = organizacion.id_organizacion 
			INNER JOIN pasantias.organizacionmunicipio ON organizacionmunicipio .id_organizacion = organizacion.id_organizacion 
			INNER JOIN pasantias.municipio ON municipio.id_municipio = organizacionmunicipio.id_municipio 
			INNER JOIN pasantias.estado ON estado .id_estado = municipio.id_estado AND convenio_organizacion.id_ip = $id_ip;");

		return $sql;
	}

	function OrganizacionesConvenio($id_ip)
	{
		$sql = pg_query("SELECT organizacion.nombre_organizacion , siglas, domicilio , nombre_municipio , nombre_estado
						, organizacion.id_organizacion
		    FROM pasantias.organizacion 
			INNER JOIN pasantias.convenio_organizacion ON convenio_organizacion.id_organizacion = organizacion.id_organizacion 
			INNER JOIN pasantias.organizacionmunicipio ON organizacionmunicipio .id_organizacion = organizacion.id_organizacion 
			INNER JOIN pasantias.municipio ON municipio.id_municipio = organizacionmunicipio.id_municipio 
			INNER JOIN pasantias.estado ON estado .id_estado = municipio.id_estado AND convenio_organizacion.id_ip = $id_ip;");

		return $sql;
	}











/////////--------	CONSULTAS DFE POSTULACIONES - EDINOSN

	function CargarCatalago_Tutores($ID_ORGANIZACION_P){

            $sql=pg_query("SELECT codigo_tutor_empresarial, organizacion.id_organizacion, persona_organizacion_oficina.id_perfil, persona.cedula, persona.nombre , persona.apellido , oficina.id_oficina, oficina.nombre_oficina,
                          organizacion_oficina.estado, organizacion_oficina.descripcion FROM pasantias.persona 
                          INNER JOIN pasantias.persona_organizacion_oficina 
                            ON persona_organizacion_oficina.id_persona = persona.id_persona
                          INNER JOIN pasantias.tutor_empresarial  
                            ON tutor_empresarial.id_persona=persona.id_persona
                          INNER JOIN pasantias.organizacionmunicipio 
                            ON organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal
                          INNER JOIN pasantias.organizacion 
                            ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
                          INNER JOIN pasantias. organizacion_oficina
                            ON organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
                          INNER JOIN pasantias.oficina
                            ON oficina.id_oficina = organizacion_oficina.id_oficina
                            AND persona_organizacion_oficina.id_oficina = oficina.id_oficina AND
                            organizacionmunicipio.codigo_sucursal='$ID_ORGANIZACION_P' AND persona_organizacion_oficina.id_perfil=5");

            return $sql;

          }


	function cargarpostulacionEstudiantes($codigo_sucursal)
	{

		 //$sql = pg_query("SELECT solicitudes_enviadas.* FROM pasantias.solicitudes_enviadas JOIN  pasantias.solicitud 
 	 	//ON  solicitudes_enviadas.codigo_solicitud = solicitud .codigo_solicitud JOIN pasantias.solicitudes_recibidas
 	 	//ON  solicitud.codigo_solicitud = solicitudes_recibidas.codigo_solicitud 
 	 	 //WHERE solicitudes_recibidas.valor ='$codigo_sucursal';");
		  //$arreglo = pg_fetch_assoc($sql);
		  //$columna=$arreglo['table_column'];  /// PROBANDO APRENDI  ALGO MUY GRANDE GRANDE PRONTO SEGUIRE
		  //$valor =$arreglo['valor'];
		 $var = pg_query( " SELECT estudiante.codigo_estudiante , persona.nombre ||' '|| persona.apellido as estudiante, 
		 	especialidad.nombre_especialidad ,solicitudes_recibidas.fecha_postulacion ,organizacion.siglas as nombre_organizacion,solicitudes_recibidas.codigo_solicitud
		 FROM pasantias.estudiante 
		 INNER JOIN pasantias.persona_instituto_especialidad ON persona_instituto_especialidad.id_persona = estudiante.id_persona
		 AND  persona_instituto_especialidad.id_ip = estudiante.id_ip AND  persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
		 AND  persona_instituto_especialidad.id_perfil = estudiante.id_perfil INNER JOIN pasantias.persona 
		 ON   persona.id_persona = persona_instituto_especialidad.id_persona INNER JOIN pasantias.especialidad
		 ON   persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad INNER JOIN pasantias.instituto_principal
		 ON   instituto_principal.id_ip = persona_instituto_especialidad.id_ip inner join pasantias.organizacion 
		 ON   organizacion.id_organizacion = instituto_principal.id_organizacion INNER JOIN pasantias.solicitudes_enviadas
		 ON   solicitudes_enviadas.valor = estudiante.codigo_estudiante JOIN pasantias.solicitud 
		 ON   solicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud INNER JOIN pasantias.solicitudes_recibidas
		 ON   solicitudes_recibidas.codigo_solicitud = solicitud.codigo_solicitud		  
		  WHERE solicitudes_recibidas.valor ='$codigo_sucursal' AND solicitudes_recibidas.estatus='EN ESPERA' ;");
		  
		return $var;
	}

//---MOSTRAR SOLICITUDES APROBADAS.
	function cargarpostulacionEstudiantes_AprobadoXEmpresa($codigo_sucursal)
	{

		 $sql = pg_query( " SELECT solicitud.codigo_solicitud, estudiante.codigo_estudiante , persona.nombre ||' '|| persona.apellido as estudiante, 
		 	especialidad.nombre_especialidad ,solicitudes_recibidas.fecha_postulacion ,organizacion.siglas as nombre_organizacion, 'ESTUDIANTE' AS solicitud_realizada
		 FROM pasantias.estudiante 
		 INNER JOIN pasantias.persona_instituto_especialidad ON persona_instituto_especialidad.id_persona = estudiante.id_persona
		 AND  persona_instituto_especialidad.id_ip = estudiante.id_ip AND  persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
		 AND  persona_instituto_especialidad.id_perfil = estudiante.id_perfil INNER JOIN pasantias.persona 
		 ON   persona.id_persona = persona_instituto_especialidad.id_persona INNER JOIN pasantias.especialidad
		 ON   persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad INNER JOIN pasantias.instituto_principal
		 ON   instituto_principal.id_ip = persona_instituto_especialidad.id_ip inner join pasantias.organizacion 
		 ON   organizacion.id_organizacion = instituto_principal.id_organizacion INNER JOIN pasantias.solicitudes_enviadas
		 ON   solicitudes_enviadas.valor = estudiante.codigo_estudiante JOIN pasantias.solicitud 
		 ON   solicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud INNER JOIN pasantias.solicitudes_recibidas
		 ON   solicitudes_recibidas.codigo_solicitud = solicitud.codigo_solicitud		  
		  WHERE solicitudes_recibidas.valor ='$codigo_sucursal' AND solicitudes_recibidas.estatus='APROBADO ORGANIZACION' ;");
		  

		$data = array();
				while( $fila =  pg_fetch_array($sql) )
				{ 
						$data[] = $fila;
				}
				



		$sql2=pg_query("SELECT alla.* , persona.nombre ||' '|| persona.apellido ||' - (ENCARGADO)' AS solicitud_realizada FROM (

					SELECT pss.nombre_organizacion, solicitudes_recibidas.fecha_postulacion ,especialidad.nombre_especialidad ,
					estudiante.codigo_estudiante ,persona.nombre ||' '|| persona.apellido  as estudiante 
					,pss.codigo_solicitud , sucursal
					FROM (SELECT solicitud.cantidad_postulantes ,solicitud.fecha_solicitud ,temporadas_solicitud.codigo_temporada , 
					organizacion.siglas as nombre_organizacion ,solicitud.codigo_solicitud ,
					solicitudes_enviadas.valor as sucursal
					FROM pasantias.solicitud INNER JOIN pasantias.solicitudes_enviadas 
						ON solicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud 

					INNER JOIN pasantias.temporadas_especialidad 
						ON temporadas_especialidad.codigo_temporada_especialidad = solicitud.codigo_temporada_especialidad
					INNER JOIN pasantias.temporadas_solicitud 
						ON temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada 
					INNER JOIN pasantias.encargado
						ON encargado.codigo_encargado= temporadas_solicitud.codigo_encargado 
					INNER JOIN pasantias.persona_organizacion_oficina
						ON persona_organizacion_oficina.id_persona = encargado.id_persona
					AND persona_organizacion_oficina.id_oficina = encargado.id_oficina
					AND persona_organizacion_oficina.codigo_sucursal = encargado.codigo_sucursal 
					INNER JOIN pasantias.organizacionmunicipio
						ON  organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal 
					INNER JOIN pasantias.organizacion
						ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion 
					INNER JOIN pasantias.instituto_principal
					ON instituto_principal.id_organizacion = organizacion.id_organizacion 
					AND solicitudes_enviadas.valor ='$codigo_sucursal'
					AND solicitudes_enviadas.table_column='organizacionmunicipio.codigo_sucursal'
					) as pss  INNER JOIN pasantias.solicitudes_recibidas
					ON pss.codigo_solicitud = solicitudes_recibidas.codigo_solicitud INNER JOIN pasantias.estudiante 
					ON  estudiante.codigo_estudiante=solicitudes_recibidas.valor INNER JOIN pasantias.persona_instituto_especialidad
					ON  estudiante.id_persona = persona_instituto_especialidad.id_persona
					AND estudiante.id_especialidad = persona_instituto_especialidad.id_especialidad
					AND estudiante.id_perfil = persona_instituto_especialidad.id_perfil 
					AND estudiante.id_ip = persona_instituto_especialidad.id_ip AND solicitudes_recibidas.estatus='APROBADO ORGANIZACION'
					INNER JOIN pasantias.persona 
						ON persona.id_persona = persona_instituto_especialidad.id_persona 
					INNER JOIN pasantias.temporadas_estudiantes
						ON temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante
					INNER JOIN pasantias.especialidad
						ON especialidad.id_especialidad = persona_instituto_especialidad.id_especialidad ) as alla
					INNER JOIN pasantias.solicitudes_enviadas 
							ON alla.codigo_solicitud =solicitudes_enviadas.codigo_solicitud
						AND solicitudes_enviadas.table_column='persona.id_persona'
						INNER JOIN pasantias.organizacionmunicipio 
						ON organizacionmunicipio.codigo_sucursal = alla.sucursal
						INNER JOIN pasantias.organizacion 
						ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
						INNER JOIN pasantias.persona_organizacion_oficina 
						ON persona_organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
						INNER JOIN pasantias.persona 
						ON persona.id_persona = persona_organizacion_oficina.id_persona 
						AND persona.id_persona = CAST (solicitudes_enviadas.valor as BIGINT)");
	

			while( $fila =  pg_fetch_array($sql2) )
				{ 
						$data[] = $fila;
				}
				
				echo json_encode($data);





	}


	//---MOSTRAR SOLICITUDES APROBADAS POR AMBORS, PARA ASIGNAR TUTORES.
	function cargarpostulacionEstudiantes_AprobadoXEmpresa_Instituto($codigo_sucursal)
	{

		 $sql = pg_query( " SELECT solicitud.codigo_solicitud, estudiante.codigo_estudiante , persona.nombre ||' '|| persona.apellido as estudiante, 
		 	especialidad.nombre_especialidad ,solicitudes_recibidas.fecha_postulacion ,organizacion.siglas as nombre_organizacion, 'ESTUDIANTE' AS solicitud_realizada
			 FROM pasantias.estudiante 
			 INNER JOIN pasantias.persona_instituto_especialidad ON persona_instituto_especialidad.id_persona = estudiante.id_persona
			 AND  persona_instituto_especialidad.id_ip = estudiante.id_ip AND  persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
			 AND  persona_instituto_especialidad.id_perfil = estudiante.id_perfil INNER JOIN pasantias.persona 
			 ON   persona.id_persona = persona_instituto_especialidad.id_persona INNER JOIN pasantias.especialidad
			 ON   persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad INNER JOIN pasantias.instituto_principal
			 ON   instituto_principal.id_ip = persona_instituto_especialidad.id_ip INNER JOIN pasantias.organizacion 
			 ON   organizacion.id_organizacion = instituto_principal.id_organizacion INNER JOIN pasantias.solicitudes_enviadas
			 ON   solicitudes_enviadas.valor = estudiante.codigo_estudiante JOIN pasantias.solicitud 
			 ON   solicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud INNER JOIN pasantias.solicitudes_recibidas
			 ON   solicitudes_recibidas.codigo_solicitud = solicitud.codigo_solicitud
			 ANd solicitudes_recibidas.valor ='$codigo_sucursal'	
			  AND solicitudes_recibidas.estatus='LISTO'
			 LEFT JOIN pasantias.responsables
				ON responsables.codigo_solicitud = solicitud.codigo_solicitud
				AND responsables.table_column='tutor_empresarial.codigo_tutor_empresarial'
			 	  
			  WHERE responsables.codigo_solicitud IS NULL ;");
			  

		$data = array();
				while( $fila =  pg_fetch_array($sql) )
				{ 
						$data[] = $fila;
				}
				



		$sql2=pg_query(" SELECT alla.* , persona.nombre ||' '|| persona.apellido ||' - (ENCARGADO)' AS solicitud_realizada FROM (

					SELECT pss.nombre_organizacion, solicitudes_recibidas.fecha_postulacion ,especialidad.nombre_especialidad ,
					estudiante.codigo_estudiante ,persona.nombre ||' '|| persona.apellido  as estudiante 
					,pss.codigo_solicitud , sucursal
					FROM (SELECT solicitud.cantidad_postulantes ,solicitud.fecha_solicitud ,temporadas_solicitud.codigo_temporada , 
					organizacion.siglas as nombre_organizacion ,solicitud.codigo_solicitud ,
					solicitudes_enviadas.valor as sucursal
					FROM pasantias.solicitud INNER JOIN pasantias.solicitudes_enviadas 
						ON solicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud 

					INNER JOIN pasantias.temporadas_especialidad 
						ON temporadas_especialidad.codigo_temporada_especialidad = solicitud.codigo_temporada_especialidad
					INNER JOIN pasantias.temporadas_solicitud 
						ON temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada 
					INNER JOIN pasantias.encargado
						ON encargado.codigo_encargado= temporadas_solicitud.codigo_encargado 
					INNER JOIN pasantias.persona_organizacion_oficina
						ON persona_organizacion_oficina.id_persona = encargado.id_persona
					AND persona_organizacion_oficina.id_oficina = encargado.id_oficina
					AND persona_organizacion_oficina.codigo_sucursal = encargado.codigo_sucursal 
					INNER JOIN pasantias.organizacionmunicipio
						ON  organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal 
					INNER JOIN pasantias.organizacion
						ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion 
					INNER JOIN pasantias.instituto_principal
					ON instituto_principal.id_organizacion = organizacion.id_organizacion 
					AND solicitudes_enviadas.valor ='$codigo_sucursal'
					AND solicitudes_enviadas.table_column='organizacionmunicipio.codigo_sucursal'
					) as pss  INNER JOIN pasantias.solicitudes_recibidas
					ON pss.codigo_solicitud = solicitudes_recibidas.codigo_solicitud INNER JOIN pasantias.estudiante 
					ON  estudiante.codigo_estudiante=solicitudes_recibidas.valor INNER JOIN pasantias.persona_instituto_especialidad
					ON  estudiante.id_persona = persona_instituto_especialidad.id_persona
					AND estudiante.id_especialidad = persona_instituto_especialidad.id_especialidad
					AND estudiante.id_perfil = persona_instituto_especialidad.id_perfil 
					AND estudiante.id_ip = persona_instituto_especialidad.id_ip AND solicitudes_recibidas.estatus='LISTO'
					INNER JOIN pasantias.persona 
						ON persona.id_persona = persona_instituto_especialidad.id_persona 
					INNER JOIN pasantias.temporadas_estudiantes
						ON temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante
					INNER JOIN pasantias.especialidad
						ON especialidad.id_especialidad = persona_instituto_especialidad.id_especialidad ) as alla
					INNER JOIN pasantias.solicitudes_enviadas 
							ON alla.codigo_solicitud =solicitudes_enviadas.codigo_solicitud
						AND solicitudes_enviadas.table_column='persona.id_persona'
						INNER JOIN pasantias.organizacionmunicipio 
						ON organizacionmunicipio.codigo_sucursal = alla.sucursal
						INNER JOIN pasantias.organizacion 
						ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
						INNER JOIN pasantias.persona_organizacion_oficina 
						ON persona_organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
						INNER JOIN pasantias.persona 
						ON persona.id_persona = persona_organizacion_oficina.id_persona 
						AND persona.id_persona = CAST (solicitudes_enviadas.valor as BIGINT)
						 LEFT JOIN pasantias.responsables
						ON responsables.codigo_solicitud = alla.codigo_solicitud
						AND responsables.table_column='tutor_empresarial.codigo_tutor_empresarial'
						WHERE responsables.codigo_solicitud IS NULL;");
	

			while( $fila =  pg_fetch_array($sql2) )
				{ 
						$data[] = $fila;
				}
				
				echo json_encode($data);





	}







	//---MOSTRAR SOLICITUDES APROBADAS CONc TUTORES.
	function cargarpostulacionEstudiantes_ConTutorEmpresarial($codigo_sucursal)
	{

		 $sql = pg_query( "SELECT  solicitud_estudiante.codigo_solicitud, solicitud_estudiante.codigo_estudiante , solicitud_estudiante.estudiante, 
	solicitud_estudiante.nombre_especialidad ,solicitud_estudiante.fecha_postulacion ,solicitud_estudiante.nombre_organizacion,
	'ESTUDIANTE' AS solicitud_realizada , persona.nombre ||' '|| persona.apellido as tutor_empresarial,
	oficina.nombre_oficina
	FROM (
		SELECT solicitud.codigo_solicitud, estudiante.codigo_estudiante , 
		 persona.nombre ||' '|| persona.apellido as estudiante, 
		 especialidad.nombre_especialidad ,
		 solicitudes_recibidas.fecha_postulacion ,
		 organizacion.siglas as nombre_organizacion,
		 	'ESTUDIANTE' AS solicitud_realizada
		 	,responsables.valor
		 FROM pasantias.estudiante 
		 INNER JOIN pasantias.persona_instituto_especialidad ON persona_instituto_especialidad.id_persona = estudiante.id_persona
		 AND  persona_instituto_especialidad.id_ip = estudiante.id_ip AND  persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
		 AND  persona_instituto_especialidad.id_perfil = estudiante.id_perfil 
		 INNER JOIN pasantias.persona 
		 ON   persona.id_persona = persona_instituto_especialidad.id_persona 
		 INNER JOIN pasantias.especialidad
		 ON   persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad 
		 INNER JOIN pasantias.instituto_principal
		 ON   instituto_principal.id_ip = persona_instituto_especialidad.id_ip 
		 inner join pasantias.organizacion 
		 ON   organizacion.id_organizacion = instituto_principal.id_organizacion 
		 INNER JOIN pasantias.solicitudes_enviadas
		 ON   solicitudes_enviadas.valor = estudiante.codigo_estudiante JOIN pasantias.solicitud 
		 ON   solicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud 
		 INNER JOIN pasantias.solicitudes_recibidas
		 ON   solicitudes_recibidas.codigo_solicitud = solicitud.codigo_solicitud
		 AND solicitudes_recibidas.valor ='$codigo_sucursal' AND solicitudes_recibidas.estatus='LISTO'

		 INNER JOIN pasantias.responsables 
		 ON responsables.codigo_solicitud = solicitudes_recibidas.codigo_solicitud 
		 AND responsables.table_column='tutor_empresarial.codigo_tutor_empresarial'
		 ) as solicitud_estudiante
		 
		 INNER JOIN pasantias.tutor_empresarial
		 On tutor_empresarial.codigo_tutor_empresarial = solicitud_estudiante.valor
		 iNNER JOIN pasantias.persona_organizacion_oficina 
		 On persona_organizacion_oficina .id_persona= tutor_empresarial.id_persona
		 AND persona_organizacion_oficina .codigo_sucursal= tutor_empresarial.codigo_sucursal
		 AND persona_organizacion_oficina .id_oficina= tutor_empresarial.id_oficina
		 AND persona_organizacion_oficina .id_perfil= tutor_empresarial.id_perfil
		 INNER JOIN pasantias.persona
		 ON persona.id_persona = persona_organizacion_oficina.id_persona
		 INNER JOIN pasantias.organizacionmunicipio
		 On organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal
		 INNER JOIN pasantias.oficina
		 ON oficina.id_oficina = persona_organizacion_oficina.id_oficina
	
	UNION
	SELECT 
	solicitud_estudiante.codigo_solicitud ,solicitud_estudiante.codigo_estudiante ,solicitud_estudiante.estudiante,
	solicitud_estudiante.nombre_especialidad ,solicitud_estudiante.fecha_postulacion ,
	solicitud_estudiante.nombre_organizacion, 
	solicitud_estudiante.solicitud_realizada , persona.nombre ||' '|| persona.apellido as tutor_empresarial,
	oficina.nombre_oficina
	
	FROM (
	SELECT alla.codigo_solicitud ,alla.codigo_estudiante ,alla.estudiante,
	alla.nombre_especialidad ,alla.fecha_postulacion ,
	alla.nombre_organizacion, 
	persona.nombre ||' '|| persona.apellido ||' - (ENCARGADO)' AS solicitud_realizada,
	responsables.valor
	FROM (

	SELECT pss.nombre_organizacion, solicitudes_recibidas.fecha_postulacion ,especialidad.nombre_especialidad ,
	estudiante.codigo_estudiante ,persona.nombre ||' '|| persona.apellido  as estudiante 
	,pss.codigo_solicitud , sucursal
	FROM (SELECT solicitud.cantidad_postulantes ,solicitud.fecha_solicitud ,temporadas_solicitud.codigo_temporada , 
	organizacion.siglas as nombre_organizacion ,solicitud.codigo_solicitud ,
	solicitudes_enviadas.valor as sucursal
	FROM pasantias.solicitud INNER JOIN pasantias.solicitudes_enviadas 
		ON solicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud 

	INNER JOIN pasantias.temporadas_especialidad 
		ON temporadas_especialidad.codigo_temporada_especialidad = solicitud.codigo_temporada_especialidad
	INNER JOIN pasantias.temporadas_solicitud 
		ON temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada 
	INNER JOIN pasantias.encargado
		ON encargado.codigo_encargado= temporadas_solicitud.codigo_encargado 
	INNER JOIN pasantias.persona_organizacion_oficina
		ON persona_organizacion_oficina.id_persona = encargado.id_persona
	AND persona_organizacion_oficina.id_oficina = encargado.id_oficina
	AND persona_organizacion_oficina.codigo_sucursal = encargado.codigo_sucursal 
	INNER JOIN pasantias.organizacionmunicipio
		ON  organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal 
	INNER JOIN pasantias.organizacion
		ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion 
	INNER JOIN pasantias.instituto_principal
	ON instituto_principal.id_organizacion = organizacion.id_organizacion 
	AND solicitudes_enviadas.valor ='$codigo_sucursal'
	AND solicitudes_enviadas.table_column='organizacionmunicipio.codigo_sucursal'
	) as pss  INNER JOIN pasantias.solicitudes_recibidas
	ON pss.codigo_solicitud = solicitudes_recibidas.codigo_solicitud INNER JOIN pasantias.estudiante 
	ON  estudiante.codigo_estudiante=solicitudes_recibidas.valor INNER JOIN pasantias.persona_instituto_especialidad
	ON  estudiante.id_persona = persona_instituto_especialidad.id_persona
	AND estudiante.id_especialidad = persona_instituto_especialidad.id_especialidad
	AND estudiante.id_perfil = persona_instituto_especialidad.id_perfil 
	AND estudiante.id_ip = persona_instituto_especialidad.id_ip AND solicitudes_recibidas.estatus='LISTO'
	INNER JOIN pasantias.persona 
		ON persona.id_persona = persona_instituto_especialidad.id_persona 
	INNER JOIN pasantias.temporadas_estudiantes
		ON temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante
	INNER JOIN pasantias.especialidad
		ON especialidad.id_especialidad = persona_instituto_especialidad.id_especialidad ) as alla
	INNER JOIN pasantias.solicitudes_enviadas 
			ON alla.codigo_solicitud =solicitudes_enviadas.codigo_solicitud
		AND solicitudes_enviadas.table_column='persona.id_persona'
		INNER JOIN pasantias.organizacionmunicipio 
		ON organizacionmunicipio.codigo_sucursal = alla.sucursal
		INNER JOIN pasantias.organizacion 
		ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
		INNER JOIN pasantias.persona_organizacion_oficina 
		ON persona_organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
		INNER JOIN pasantias.persona 
		ON persona.id_persona = persona_organizacion_oficina.id_persona 
		INNER JOIN pasantias.responsables 
		 ON responsables.codigo_solicitud = solicitudes_enviadas.codigo_solicitud 
		 AND responsables.table_column='tutor_empresarial.codigo_tutor_empresarial'
		AND persona.id_persona = CAST (solicitudes_enviadas.valor as BIGINT)
	) AS solicitud_estudiante

	INNER JOIN pasantias.tutor_empresarial
	ON tutor_empresarial.codigo_tutor_empresarial = solicitud_estudiante.valor
	INNER JOIN pasantias.persona_organizacion_oficina
	On persona_organizacion_oficina .codigo_sucursal = tutor_empresarial.codigo_sucursal
	AND persona_organizacion_oficina .id_persona = tutor_empresarial.id_persona
	AND persona_organizacion_oficina .id_oficina = tutor_empresarial.id_oficina
	AND persona_organizacion_oficina .id_perfil = tutor_empresarial.id_perfil
	INNER JOIN pasantias.persona
	ON persona.id_persona=persona_organizacion_oficina.id_persona
	INNER JOIN pasantias.oficina
	ON oficina.id_oficina = persona_organizacion_oficina.id_oficina ;");
	

			while( $fila =  pg_fetch_array($sql) )
				{ 
						$data[] = $fila;
				}
				
				echo json_encode($data);

	}






	function buscarparacurriEstudiante( $codigo_estudiante)
	{	
		 $sql =pg_query("SELECT curriculum.id_persona FROM pasantias.estudiante JOIN pasantias.persona_instituto_especialidad 
		ON estudiante .id_persona = persona_instituto_especialidad .id_persona 
		AND  estudiante .id_especialidad = persona_instituto_especialidad .id_especialidad
		AND estudiante .id_perfil = persona_instituto_especialidad .id_perfil
		AND estudiante .id_ip = persona_instituto_especialidad .id_ip INNER JOIN pasantias.persona 
		ON persona.id_persona = persona_instituto_especialidad.id_persona
		 AND estudiante.codigo_estudiante='$codigo_estudiante'
		 INNER JOIN pasantias.curriculum ON curriculum.id_persona = persona.id_persona;");
		return $sql ;
	}


	function cargarSolicitudes($codigo_sucursal)
	{
		$sql= pg_query("SELECT pss.* , persona.nombre ||' ' || persona.apellido as responsable FROM 
		(SELECT solicitud.cantidad_postulantes ,solicitud.fecha_solicitud ,temporadas_solicitud.codigo_temporada ,
		organizacion.nombre_organizacion ,solicitud.codigo_solicitud  , especialidad.nombre_especialidad ||' - '|| nombre_tipo_especialidad as area
		FROM pasantias.solicitud INNER JOIN pasantias.solicitudes_enviadas 
		ON solicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud INNER JOIN pasantias.temporadas_especialidad
		ON solicitud.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad INNER JOIN pasantias.temporadas_solicitud
		ON temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada
		INNER JOIN pasantias.encargado
		ON encargado.codigo_encargado= temporadas_solicitud.codigo_encargado INNER JOIN pasantias.persona_organizacion_oficina
		ON persona_organizacion_oficina.id_persona = encargado.id_persona
		AND persona_organizacion_oficina.id_oficina = encargado.id_oficina
		AND persona_organizacion_oficina.codigo_sucursal = encargado.codigo_sucursal INNER JOIN pasantias.organizacionmunicipio
		ON  organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal INNER JOIN pasantias.organizacion
		ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion INNER JOIN pasantias.instituto_principal
		ON instituto_principal.id_organizacion = organizacion.id_organizacion INNER JOIN pasantias.especialidad 
		ON especialidad.id_especialidad = temporadas_especialidad.id_especialidad INNER JOIN pasantias.tipo_especialidad
		ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad
		WHERE solicitudes_enviadas.valor ='$codigo_sucursal' ) as pss
		INNER JOIN pasantias.solicitudes_enviadas ON pss.codigo_solicitud = solicitudes_enviadas.codigo_solicitud INNER JOIN pasantias.persona
		ON  CAST(persona.id_persona as  character varying )=solicitudes_enviadas.valor ;");

		return $sql;
	}


	function postuladosSolicitud($arre  = array())
	{	
		$Codifo_sucursa = $arre['codigo_sucursal'];
		$codigoSolicitud=$arre['BuscarPostuladosthisCode'];
		$sql = pg_query(" SELECT solicitudes_recibidas.fecha_postulacion ,especialidad.nombre_especialidad ,
			estudiante.codigo_estudiante ,persona.nombre ||' '|| persona.apellido  as estudiante
			FROM (SELECT solicitud.cantidad_postulantes ,solicitud.fecha_solicitud ,temporadas_solicitud.codigo_temporada , 
			organizacion.nombre_organizacion ,solicitud.codigo_solicitud 
			FROM pasantias.solicitud INNER JOIN pasantias.solicitudes_enviadas 
			ON solicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud 
			AND solicitud.codigo_solicitud ='$codigoSolicitud'
			INNER JOIN pasantias.temporadas_especialidad 
			ON temporadas_especialidad.codigo_temporada_especialidad = solicitud.codigo_temporada_especialidad
			INNER JOIN pasantias.temporadas_solicitud 
			ON temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada INNER JOIN pasantias.encargado
			ON encargado.codigo_encargado= temporadas_solicitud.codigo_encargado INNER JOIN pasantias.persona_organizacion_oficina
			ON persona_organizacion_oficina.id_persona = encargado.id_persona
			AND persona_organizacion_oficina.id_oficina = encargado.id_oficina
			AND persona_organizacion_oficina.codigo_sucursal = encargado.codigo_sucursal INNER JOIN pasantias.organizacionmunicipio
			ON  organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal INNER JOIN pasantias.organizacion
			ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion INNER JOIN pasantias.instituto_principal
			ON instituto_principal.id_organizacion = organizacion.id_organizacion 
			WHERE solicitudes_enviadas.valor ='$Codifo_sucursa' ) as pss  INNER JOIN pasantias.solicitudes_recibidas
			ON pss.codigo_solicitud = solicitudes_recibidas.codigo_solicitud INNER JOIN pasantias.estudiante 
			ON  estudiante.codigo_estudiante=solicitudes_recibidas.valor INNER JOIN pasantias.persona_instituto_especialidad
			ON  estudiante.id_persona = persona_instituto_especialidad.id_persona
			AND estudiante.id_especialidad = persona_instituto_especialidad.id_especialidad
			AND estudiante.id_perfil = persona_instituto_especialidad.id_perfil 
			AND estudiante.id_ip = persona_instituto_especialidad.id_ip INNER JOIN pasantias.persona 
			ON persona.id_persona = persona_instituto_especialidad.id_persona INNER JOIN pasantias.temporadas_estudiantes
			ON temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante
			INNER JOIN pasantias.especialidad
			ON especialidad.id_especialidad = persona_instituto_especialidad.id_especialidad AND solicitudes_recibidas.estatus='EN ESPERA' ;");
			return $sql;
	}

	//-------AQUIII POSTULACION EN RESPUESTA A UNA SOLICITUD DE LA EMPRESA--->>>>
	function Aprobarsolicitud($CodigoSolicitud , $estudiante, $id_persona)
	{
		 $sql =pg_query("UPDATE pasantias.solicitudes_recibidas SET estatus='APROBADO ORGANIZACION' 
		 	WHERE codigo_solicitud='$CodigoSolicitud' AND valor='$estudiante' ;");
		              

            //----INSERTOOOO---->>>>
            $insert=pg_query("INSERT INTO pasantias.responsables (codigo_solicitud, table_column, valor, estatus)VALUES('$CodigoSolicitud','persona.id_persona','$id_persona','REALIZADO' )"); 
            $registro = pg_affected_rows($insert);
		return $registro;
	}


<<<<<<< HEAD

	//-------AQUIII POSTULACION DIRECTA--->>>>
	//----LLEGO EDINSON--->>>
	function Aprobarsolicitud_EstudiantesPostuladosAempresas($CodigoSolicitud , $sucursal, $id_persona)
	{

		 $tutores=$this->Consulto_RequeriemientoTutores($CodigoSolicitud);
		 if($tutores=='true'){
		 		$sql =pg_query("UPDATE pasantias.solicitudes_recibidas SET estatus='APROBADO ORGANIZACION' 
		 		WHERE codigo_solicitud='$CodigoSolicitud' AND valor='$sucursal' ;");
				 $registro = pg_affected_rows($sql);
		                       

		            //----INSERTOOOO---->>>>
		         $insert=pg_query("INSERT INTO pasantias.responsables (codigo_solicitud, table_column, valor, estatus)VALUES('$CodigoSolicitud','persona.id_persona','$id_persona','REALIZADO' )"); 
		         $registro = pg_affected_rows($insert);
				 return $registro;

		 }else{

		 		 $sql =pg_query("UPDATE pasantias.solicitudes_recibidas SET estatus='APROBADO' 
		 		 WHERE codigo_solicitud='$CodigoSolicitud' AND valor='$sucursal' ;");
				 $registro = pg_affected_rows($sql);
		                       

		            //----INSERTOOOO---->>>>
		         $insert=pg_query("INSERT INTO pasantias.responsables (codigo_solicitud, table_column, valor, estatus)VALUES('$CodigoSolicitud','persona.id_persona','$id_persona','REALIZADO' )"); 
		         $registro = pg_affected_rows($insert);
				 return $registro;

		 }

		 


	}


	function Consulto_RequeriemientoTutores($CodigoSolicitud){

		$sql=pg_query("SELECT tipo_solicitud.nombre_tipo_solicitud, temporadas_especialidad.codigo_temporada_especialidad, encargado_tipo_solicitud.descripcion
           FROM pasantias.solicitud 
           INNER JOIN pasantias.temporadas_especialidad 
           		   ON temporadas_especialidad.codigo_temporada_especialidad = solicitud.codigo_temporada_especialidad
                  AND solicitud.codigo_solicitud='$CodigoSolicitud'   
           INNER JOIN pasantias.temporadas_solicitud
                   ON temporadas_solicitud.codigo_temporada=temporadas_especialidad.codigo_temporada
               INNER JOIN pasantias.tipo_solicitud 
                   ON tipo_solicitud.id_tipo_solicitud = temporadas_solicitud.id_tipo_solicitud
           INNER JOIN pasantias.encargado_tipo_solicitud
			       ON encargado_tipo_solicitud.id_tipo_solicitud=tipo_solicitud.id_tipo_solicitud 
			      AND encargado_tipo_solicitud.codigo_encargado=temporadas_solicitud.codigo_encargado");

		$reg=pg_fetch_array($sql);
		$tutores=$reg['descripcion'];

		return $tutores;
=======
	//-------AQUIII POSTULACION DIRECTA--->>>>
	function Aprobarsolicitud_EstudiantesPostuladosAempresas($CodigoSolicitud , $sucursal, $id_persona)
	{
		 $sql =pg_query("UPDATE pasantias.solicitudes_recibidas SET estatus='APROBADO ORGANIZACION' 
		 	WHERE codigo_solicitud='$CodigoSolicitud' AND valor='$sucursal' ;");
		              $registro = pg_affected_rows($sql);
                       

            //----INSERTOOOO---->>>>
            $insert=pg_query("INSERT INTO pasantias.responsables (codigo_solicitud, table_column, valor, estatus)VALUES('$CodigoSolicitud','persona.id_persona','$id_persona','REALIZADO' )"); 
            $registro = pg_affected_rows($insert);
		return $registro;


>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
	}

	function cargarSolicitudesAprobadasOrganizacion($codigo_encargado)
	{
			$sql =pg_query(" SELECT SucursalEnviada.* ,solicitudes_enviadas.valor as persona FROM  (SELECT estudianteSolicitud.*  ,solicitudes_enviadas.valor as sucursal FROM  

				( SELECT persona.nombre ||'  '|| persona.apellido as estudiante , persona.telefono
				,persona.correo , solicitud.codigo_solicitud 
				FROM pasantias.encargado INNER JOIN pasantias.temporadas_solicitud 
				ON encargado.codigo_encargado =  temporadas_solicitud.codigo_encargado
				AND encargado.codigo_encargado='$codigo_encargado'
				INNER JOIN pasantias.temporadas_especialidad 
				ON temporadas_solicitud.codigo_temporada =temporadas_especialidad.codigo_temporada 
				INNER JOIN pasantias.solicitud 
				ON solicitud.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
				INNER JOIN pasantias.solicitudes_recibidas 
				ON solicitudes_recibidas.codigo_solicitud = solicitud.codigo_solicitud 
				AND solicitudes_recibidas.estatus='APROBADO ORGANIZACION'
				INNER JOIN pasantias.estudiante 
				ON solicitudes_recibidas.valor = estudiante.codigo_estudiante 
				INNER JOIN pasantias.temporadas_estudiantes 
				ON temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante 
				AND temporadas_estudiantes.codigo_temporada_especialidad=temporadas_especialidad.codigo_temporada_especialidad
				INNER JOIN pasantias.persona_instituto_especialidad 
				ON persona_instituto_especialidad.id_persona = estudiante.id_persona
				AND persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
				AND persona_instituto_especialidad.id_ip = estudiante.id_ip
				AND persona_instituto_especialidad.id_perfil = estudiante.id_perfil
				INNER JOIN pasantias.persona ON persona.id_persona =persona_instituto_especialidad.id_persona ) as estudianteSolicitud
				INNER JOIN pasantias.solicitudes_enviadas 
				ON estudianteSolicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud
				AND solicitudes_enviadas.table_column='organizacionmunicipio.codigo_sucursal') as SucursalEnviada
				INNER JOIN pasantias.solicitudes_enviadas 
				ON SucursalEnviada.codigo_solicitud =solicitudes_enviadas.codigo_solicitud
				AND solicitudes_enviadas.table_column='persona.id_persona' ;");
				return $sql;
	}




	function buscarDatosSucursal($codigo_sucursal)
	{
		$sql =pg_query("SELECT  organizacion.nombre_organizacion , organizacion.rif ,
			organizacion.descripcion ,tipo_organizacion.nombre_tipo_organizacion,
			CASE WHEN organizacion.siglas ='' then 'SIN SIGLAS' ELSE organizacion.siglas END ,
			organizacionmunicipio.observacion,domicilio, municipio.nombre_municipio
			,estado.nombre_estado 
			
			FROM pasantias.organizacionmunicipio 
			INNER JOIN pasantias.organizacion 
				ON organizacionmunicipio.id_organizacion = organizacion.id_organizacion 
				AND organizacionmunicipio.codigo_sucursal= '$codigo_sucursal'
			INNER JOIN pasantias.tipo_organizacion 
				ON tipo_organizacion.id_tipo_organizacion = organizacion.id_tipo_organizacion
			INNER JOIN pasantias.convenio_organizacion 
				ON convenio_organizacion .id_organizacion = organizacion.id_organizacion
			INNER JOIN pasantias.persona_organizacion_oficina 
				ON persona_organizacion_oficina .codigo_sucursal = organizacionmunicipio.codigo_sucursal
			INNER JOIN pasantias.municipio 
				ON municipio.id_municipio = organizacionmunicipio.id_municipio 
			INNER JOIN pasantias.estado 
				ON estado.id_estado = municipio.id_estado;");

		return $sql ;
	}



	//ASIGNAR TUTORES EMPRESARIALES

		function AsignarTutoresEmpresarialBD($codigo_tutor, $codigo_solicitud){

			$str=pg_query("INSERT INTO pasantias.responsables (codigo_solicitud, table_column, valor, estatus) VALUES
										('$codigo_solicitud', 'tutor_empresarial.codigo_tutor_empresarial','$codigo_tutor', 'ASIGNADO' )");
			$registro=pg_affected_rows($str);

			return $registro;

		}


	function  colsultarestosparametros($id_organizacionPrincipal , $codigo_sucursal , $codigo_encargado)
	{
		$sql = pg_query("SELECT organizacion.nombre_organizacion , organizacion.rif ,organizacion.siglas , 
			tipo_organizacion.nombre_tipo_organizacion as tipo ,
			organizacionmunicipio.observacion as sede ,
			 'Estado'|| ': ' || estado.nombre_estado || ' - ' || 'Municipio'|| ': ' || municipio.nombre_municipio || ' - ' || 'Direccíon'|| ': ' || organizacionmunicipio.domicilio as ubicacion
			FROM pasantias.organizacion INNER JOIN pasantias.convenio_organizacion 
				ON convenio_organizacion.id_organizacion = organizacion.id_organizacion 
			INNER JOIN pasantias.instituto_principal 
				ON instituto_principal.id_ip = convenio_organizacion.id_ip 
				AND instituto_principal.id_ip = $id_organizacionPrincipal
			INNER join pasantias.organizacionmunicipio
				ON organizacionmunicipio.id_organizacion = organizacion.id_organizacion
				AND organizacionmunicipio.codigo_sucursal = '$codigo_sucursal' 
			INNER JOIN pasantias.tipo_organizacion 
				On tipo_organizacion.id_tipo_organizacion = organizacion.id_tipo_organizacion
			INNER JOIN pasantias.municipio 
				ON municipio.id_municipio = organizacionmunicipio.id_municipio
			INNER JOIN pasantias.estado 
				On estado.id_estado = municipio.id_estado ;");

		return $sql ;
	}

	function DepartamentosRegistrados(  $codigo_sucursal )
	{  
		$sql = pg_query("SELECT  departamentos.nombre_oficina ,departamentos.id_oficina ,palabraMasLarga.maxlength
			FROM ( SELECT cast ( length( nombre_oficina ) as int)  as maxlength
		FROM pasantias.oficina INNER JOIN pasantias.organizacion_oficina
			ON oficina.id_oficina =  organizacion_oficina.id_oficina
		INNER JOIN pasantias.organizacionmunicipio 
			ON organizacionmunicipio.codigo_sucursal = organizacion_oficina.codigo_sucursal 
			AND organizacionmunicipio.codigo_sucursal = '$codigo_sucursal' 

			AND organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
		WHERE cast ( length( nombre_oficina ) as int) = 
		(SELECT  MAX(cast ( length( nombre_oficina ) as int)) FROM pasantias.oficina) ) as palabraMasLarga
		,
			 ( SELECT nombre_oficina , organizacion_oficina.id_oficina
		FROM pasantias.oficina INNER JOIN pasantias.organizacion_oficina
			ON oficina.id_oficina = organizacion_oficina.id_oficina
		INNER JOIN pasantias.organizacionmunicipio 
			ON organizacionmunicipio.codigo_sucursal = organizacion_oficina.codigo_sucursal 
			AND organizacionmunicipio.codigo_sucursal = '$codigo_sucursal'

			AND organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal	) as departamentos 
			  
		 ORDER BY departamentos.nombre_oficina	;");
		return $sql ;
	}

	function ContarPersonalPoroficina( $codigo_sucursal ,$id_oficina )
	{
		$sql =pg_query(" SELECT COUNT(persona_organizacion_oficina.id_persona) 
		 FROM pasantias.persona_organizacion_oficina WHERE persona_organizacion_oficina.codigo_sucursal= '$codigo_sucursal'
		 AND persona_organizacion_oficina.id_oficina='$id_oficina' ;");
				$row = pg_fetch_array($sql);  if ($row[0]>1) { $row[0]= $row[0].' Personas';}else { $row[0]= $row[0].' Persona'; }
		return $row[0];
	}
}
