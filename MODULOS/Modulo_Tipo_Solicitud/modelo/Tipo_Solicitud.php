<?php 

include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$co = $conexion->Conectar();

class Tipo_Solicitud
{

	private $id_tipo_solicitud;
	
	private $nombre_tipo_solicitud;

	private $estatus;

	private $descripcion;
	
	
	public function setFormulario( $formulario =array() )
	{

		$this->nombre_tipo_solicitud= $formulario['nombre_tipo_solicitud'];
		
		$this->estatus= $formulario['estatus'];

		if(isset($formulario['descripcion'])){
			$this->descripcion= $formulario['descripcion'];
		}

	}

	public function setTipo_Solicitud($formulario =array() )
	{
		$this->nombre_tipo_solicitud= $formulario['nombre'];
		
		$this->estatus= $formulario['estatus'];

		$this->descripcion= $formulario['descripcion'];

	}


	public function IncluirTipo_Solicitud( $codigo_encargado)
	{	
		if(
		pg_num_rows(	

		pg_query("SELECT true FROm pasantias.tipo_solicitud WHERE nombre_tipo_solicitud = upper('$this->nombre_tipo_solicitud')  ;")
		 ) > 0 ){

			$sql =
			pg_query("SELECT tipo_solicitud.id_tipo_solicitud FROM pasantias.tipo_solicitud

				INNER JOIN pasantias.encargado_tipo_solicitud 

					ON encargado_tipo_solicitud.id_tipo_solicitud = tipo_solicitud.id_tipo_solicitud
					AND encargado_tipo_solicitud.codigo_encargado = '$codigo_encargado'

			 WHERE nombre_tipo_solicitud=upper('$this->nombre_tipo_solicitud') ;");

			if( pg_num_rows($sql)==1)
			{
				return 0;
			}else 
			{

			$sql =
			pg_query("SELECT tipo_solicitud.id_tipo_solicitud FROM pasantias.tipo_solicitud

			 WHERE nombre_tipo_solicitud=upper('$this->nombre_tipo_solicitud') ;");

				$fech= pg_fetch_assoc($sql);
				$id_tipo_solicitud = $fech['id_tipo_solicitud'];
				$sql =
				pg_query("INSERT INTO pasantias.encargado_tipo_solicitud (id_tipo_solicitud,codigo_encargado,estatus,descripcion)

				 VALUES ($id_tipo_solicitud,'$codigo_encargado','$this->estatus','$this->descripcion') ;");

				return pg_affected_rows($sql);
			}

		} else {


		$insert ="INSERT INTO pasantias.tipo_solicitud (nombre_tipo_solicitud, estatus)

		VALUES (upper('$this->nombre_tipo_solicitud') , '$this->estatus' )"; 

		$execute =pg_query( $insert)  or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		$fech = pg_fetch_assoc( pg_query("SELECT MAX(id_tipo_solicitud) as id_recent , 1 as auxiliar FROM pasantias.tipo_solicitud ;")  );
		if($fech['id_recent']==0) $fech['id_recent']=$fech['auxiliar'];

		$id_tipo_solicitud = $fech['id_recent'];

		pg_query("INSERT INTO pasantias . encargado_tipo_solicitud (id_tipo_solicitud,codigo_encargado,estatus,descripcion) 
			
			VALUES ($id_tipo_solicitud,'$codigo_encargado','$this->estatus','$this->descripcion') ;");

		return pg_affected_rows($execute);				
			}

	}

		public function tablaTipo_SolicitudFiltro(  $arreglo = array() , $codigo_encargado)
	{

		$nombre_tipo_solicitud = $arreglo['tiposolicitud'];

		$estatus = $arreglo['estatus'];

		$sqlNombre ="SELECT tipo_solicitud.id_tipo_solicitud ,nombre_tipo_solicitud ,encargado_tipo_solicitud.estatus , encargado_tipo_solicitud.descripcion FROM pasantias.tipo_solicitud INNER JOIN pasantias.encargado_tipo_solicitud ON encargado_tipo_solicitud . id_tipo_solicitud = tipo_solicitud.id_tipo_solicitud AND encargado_tipo_solicitud.codigo_encargado = '$codigo_encargado' WHERE nombre_tipo_solicitud LIKE  upper('$nombre_tipo_solicitud%') ORDER BY nombre_tipo_solicitud;"; 

		$sqlEstatus ="SELECT tipo_solicitud.id_tipo_solicitud ,nombre_tipo_solicitud ,encargado_tipo_solicitud.estatus , encargado_tipo_solicitud.descripcion FROM pasantias.tipo_solicitud INNER JOIN pasantias.encargado_tipo_solicitud ON encargado_tipo_solicitud . id_tipo_solicitud = tipo_solicitud.id_tipo_solicitud AND encargado_tipo_solicitud.codigo_encargado = '$codigo_encargado' WHERE estatus LIKE  upper('$estatus%') ORDER BY nombre_tipo_solicitud;"; 

		$Ambas ="SELECT tipo_solicitud.id_tipo_solicitud ,nombre_tipo_solicitud ,encargado_tipo_solicitud.estatus , encargado_tipo_solicitud.descripcion FROM pasantias.tipo_solicitud INNER JOIN pasantias.encargado_tipo_solicitud ON encargado_tipo_solicitud . id_tipo_solicitud = tipo_solicitud.id_tipo_solicitud AND encargado_tipo_solicitud.codigo_encargado = '$codigo_encargado' WHERE nombre_tipo_solicitud LIKE  upper('$nombre_tipo_solicitud%')

		AND estatus LIKE  upper('$estatus%') ORDER BY nombre_tipo_solicitud;"; 

		if( $nombre_tipo_solicitud == null && $estatus == null){

				$inser = "SELECT tipo_solicitud.id_tipo_solicitud ,nombre_tipo_solicitud ,encargado_tipo_solicitud.estatus ,encargado_tipo_solicitud.descripcion

		FROM pasantias.tipo_solicitud 

				INNER JOIN pasantias.encargado_tipo_solicitud 

					ON encargado_tipo_solicitud.id_tipo_solicitud = tipo_solicitud.id_tipo_solicitud
					AND encargado_tipo_solicitud.codigo_encargado = '$codigo_encargado'

		 ORDER BY nombre_tipo_solicitud; ";
		}
		else if($nombre_tipo_solicitud == null)
		{
				$insert = $sqlEstatus;

		}else if($estatus == null)
		{

				$insert = $sqlNombre;

		}else{ 

				$insert = $Ambas;
		}


		$execute =pg_query( $insert);


		return $execute;

		

	}

	   public function consultTipo_Solicitud( $codigo_encargado )
	{

		$insert ="SELECT tipo_solicitud.id_tipo_solicitud ,nombre_tipo_solicitud ,encargado_tipo_solicitud.estatus ,

		CASE 	WHEN encargado_tipo_solicitud.descripcion = 'true'  THEN 'Si'
				WHEN encargado_tipo_solicitud.descripcion = 'false' THEN 'No'
		END as descripcion , 
		
		encargado_tipo_solicitud.descripcion as checked

		FROM pasantias.tipo_solicitud 

				INNER JOIN pasantias.encargado_tipo_solicitud 

					ON encargado_tipo_solicitud.id_tipo_solicitud = tipo_solicitud.id_tipo_solicitud
					AND encargado_tipo_solicitud.codigo_encargado = '$codigo_encargado'

		 ORDER BY nombre_tipo_solicitud;"; 

		$execute =pg_query( $insert);


		return $execute;

		

	}

	function tiposSolicitudparaTemporada( $codigo_encargao )
	{
		$sql = pg_query("SELECT encargado_tipo_solicitud. id_tipo_solicitud ,nombre_tipo_solicitud FROM pasantias.tipo_solicitud INNER JOIN pasantias.encargado_tipo_solicitud On encargado_tipo_solicitud.id_tipo_solicitud = tipo_solicitud.id_tipo_solicitud  WHERE encargado_tipo_solicitud.estatus='ACTIVO' AND encargado_tipo_solicitud.codigo_encargado='$codigo_encargao' ORDER BY nombre_tipo_solicitud ;");
		return $sql;
	}
	public function consultNombreTipo_Solicitud($arre= array() , $codigo_encargado)
	{
		$nombre_tipo_solicitud=$arre['nombre'];
		$resul= pg_query(" SELECT id_tipo_solicitud , estatus FROM pasantias.tipo_solicitud 

			INNER JOIN pasantias.encargado_tipo_solicitud

				ON encargado_tipo_solicitud .id_tipo_solicitud = tipo_solicitud.id_tipo_solicitud
				AND encargado_tipo_solicitud.codigo_encargado = '$codigo_encargado'

			WHERE nombre_tipo_solicitud=upper('$nombre_tipo_solicitud') ");

			$estatus = pg_fetch_assoc($resul);
		return array( 'estatus'=>$estatus['estatus'], 'num'=>pg_num_rows($resul));
	}

		public function registros_tipo_solicitud( $array = array() )
	{
		// aQUI  APLICARE  LA  LOGICA DE LAS  CONSULTAS de  el  modelo
		$tipo_solicitud = $array['tipo_solicitud']; 
		$estatus = $array['estatus']; 

		$sqlite ="SELECT * FROM pasantias.tipo_solicitud WHERE nombre_tipo_solicitud LIKE upper('$tipo_solicitud%') ORDER BY nombre_tipo_solicitud;"; 

		$sqliteestatus ="SELECT * FROM pasantias.tipo_solicitud WHERE estatus = '$estatus' ORDER BY nombre_tipo_solicitud;"; 
		$execute="";
		if($tipo_solicitud == null)
		{
			$execute =pg_query( $sqliteestatus);
		}else 
		{
			$execute =pg_query( $sqlite);
		}

		return $execute;		
		
	}


		public function registrosTipo_SolicitudSelect(  )
	{

		$sqlite ="SELECT * FROM pasantias.tipo_solicitud WHERE id_tipo_solicitud=$id_tipo_solicitud ORDER BY nombre_tipo_solicitud;"; 

		$execute =pg_query( $sqlite);

		return $execute;
		
	 }

	public function ActualizaTipo_Solicitud( $arreglo =array() , $codigo_encargado  )
	{
			$prototipe= null;
		$id = $arreglo['id_tipo_solicitud'];
		$tipoSolicitud = $arreglo['nombre'];
		$descripcion = $arreglo['descripcion'];
		$estatus = $arreglo['estatus'];
		$desicion= $arreglo['cual'];

					
		if($desicion=='soloEstatus')
		{
		$prototipe =pg_query("UPDATE pasantias.encargado_tipo_solicitud  SET  estatus=upper('$estatus') WHERE id_tipo_solicitud =$id 

		AND encargado_tipo_solicitud.codigo_encargado ='$codigo_encargado' ;");

		}else if($desicion=='ambos')
		{

			if(pg_num_rows(pg_query("SELECT true FROM pasantias.tipo_solicitud WHERE nombre_tipo_solicitud = upper('$tipoSolicitud');"))==0)
			{
				$prototipe =pg_query("UPDATE pasantias.tipo_Solicitud  SET nombre_tipo_solicitud = upper('$tipoSolicitud') WHERE id_tipo_solicitud =$id ;");
			
			}else 
			{	
				$sql =
				pg_query("SELECT tipo_solicitud.id_tipo_solicitud FROM pasantias.tipo_solicitud INNER JOIN pasantias.encargado_tipo_solicitud

					ON encargado_tipo_solicitud.id_tipo_solicitud = tipo_solicitud.id_tipo_solicitud
					AND encargado_tipo_solicitud.codigo_encargado = '$codigo_encargado'

					WHERE nombre_tipo_solicitud = upper('$tipoSolicitud') ;");

				if(pg_num_rows($sql)==1)
				{
					$prototipe =pg_query("UPDATE pasantias.encargado_tipo_solicitud  SET  estatus=upper('$estatus') , descripcion='$descripcion'

						WHERE id_tipo_solicitud =$id 

					AND encargado_tipo_solicitud.codigo_encargado ='$codigo_encargado' ;");
				}else
				{	

					$fech =
					pg_query("SELECT tipo_solicitud.id_tipo_solicitud FROM pasantias.tipo_solicitud WHERE nombre_tipo_solicitud = upper('$tipoSolicitud') ;");

					$fech = pg_fetch_assoc($fech);	$id_tipo_solicitud = $fech['id_tipo_solicitud'];
					
					$prototipe =
					pg_query("INSERT INTO  encargado_tipo_solicitud (id_tipo_solicitud,descripcion, estatus  ,codigo_encargado  )

					values ( $id_tipo_solicitud,'$descripcion' , upper('$estatus') ,'$codigo_encargado'  ) ;");
				}
			}
		


		}
	$num = pg_affected_rows($prototipe);

	pg_free_result($prototipe);
		return $num;
	}

	public function buscarTipoSolicitud($nombre , $estatus ,$descripcion, $codigo_encargado)
	{	
		return  pg_num_rows( pg_query("SELECT tipo_Solicitud.id_tipo_solicitud FROM pasantias.tipo_Solicitud 

			INNER JOIN pasantias.encargado_tipo_solicitud

				ON encargado_tipo_solicitud.id_tipo_solicitud = tipo_Solicitud.id_tipo_solicitud
				WHERE encargado_tipo_solicitud.codigo_encargado = '$codigo_encargado'
				AND encargado_tipo_solicitud.estatus  = '$estatus'

			AND nombre_tipo_solicitud=upper('$nombre') AND encargado_tipo_solicitud.descripcion = '$descripcion' ;") );
	}

	public function tablaTipo_Solicitud(  )
	{

		$insert ="SELECT  id_tipo_solicitud ,nombre_tipo_solicitud ,estatus FROM pasantias.tipo_Solicitud ORDER BY nombre_tipo_solicitud;"; 

		$execute =pg_query( $insert);

		return $execute;
	}


	function DescripciontipoSolicitud($id_tipo_solicitud , $codigo_encargado)
	{	
		$sql =
		pg_query("SELECT 
		CASE 	WHEN encargado_tipo_solicitud.descripcion = 'true'  THEN 'Si'
				WHEN encargado_tipo_solicitud.descripcion = 'false' THEN 'No'
		END as descripcion ,

		CASE 	WHEN encargado_tipo_solicitud.descripcion = 'true'  THEN 'primary'
				WHEN encargado_tipo_solicitud.descripcion = 'false' THEN 'warning'
		END as style 		
		
		 FROM pasantias.encargado_tipo_solicitud INNER JOIN pasantias.tipo_solicitud 

			ON tipo_solicitud .id_tipo_solicitud = encargado_tipo_solicitud .id_tipo_solicitud 

			WHERE tipo_solicitud.id_tipo_solicitud = $id_tipo_solicitud AND encargado_tipo_solicitud.codigo_encargado = '$codigo_encargado';");

		return pg_fetch_assoc($sql);
	}

	function buscarTipoSolicitudAutoComplete($codigo_encargado)
	{
		return pg_query("SELECT tipo_solicitud.nombre_tipo_solicitud FROM pasantias.tipo_solicitud INNER JOIN pasantias.encargado_tipo_solicitud

			ON encargado_tipo_solicitud.id_tipo_solicitud = tipo_Solicitud.id_tipo_solicitud

			INNER JOIN pasantias.encargado 

			ON encargado.codigo_encargado = encargado_tipo_solicitud.codigo_encargado

			WHERE encargado.codigo_encargado='$codigo_encargado' ;");

	}
}