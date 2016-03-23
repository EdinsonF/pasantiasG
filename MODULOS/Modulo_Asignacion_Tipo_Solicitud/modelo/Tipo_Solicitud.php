<?php 

include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$co = $conexion->Conectar();

class Tipo_Solicitud
{

	private $id_tipo_solicitud;
	
	private $nombre_tipo_solicitud;

	private $estatus;
	
	
	public function setFormulario( $formulario =array() )
	{

		$this->nombre_tipo_solicitud= $formulario['nombre_tipo_solicitud'];
		
		$this->estatus= $formulario['estatus'];

	}

	public function setTipo_Solicitud($formulario =array() )
	{
		$this->nombre_tipo_solicitud= $formulario['nombre'];
		
		$this->estatus= $formulario['estatus'];

	}


	public function IncluirTipo_Solicitud()
	{

		$insert ="INSERT INTO pasantias.tipo_solicitud (nombre_tipo_solicitud, estatus)

		VALUES (upper('$this->nombre_tipo_solicitud') , '$this->estatus' )"; 

		$execute =pg_query( $insert)  or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		return pg_affected_rows($execute);
		

	}

		public function tablaTipo_SolicitudFiltro(  $arreglo = array() )
	{

		$nombre_tipo_solicitud = $arreglo['nombre'];

		$estatus = $arreglo['estatus'];

		$sqlNombre ="SELECT * FROM pasantias.tipo_solicitud WHERE nombre_tipo_solicitud LIKE  '$nombre_tipo_solicitud%' ORDER BY nombre_tipo_solicitud;"; 

		$sqlEstatus ="SELECT * FROM pasantias.tipo_solicitud WHERE estatus LIKE  upper('$estatus%') ORDER BY nombre_tipo_solicitud;"; 

		$Ambas ="SELECT * FROM pasantias.tipo_solicitud WHERE nombre_tipo_solicitud LIKE  '$nombre_tipo_solicitud%'

		AND estatus LIKE  upper('$estatus%') ORDER BY nombre_tipo_solicitud;"; 


		if($nombre_tipo_solicitud == null)
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

			public function consultTipo_Solicitud( )
	{

		

		$insert ="SELECT * FROM pasantias.tipo_solicitud  ORDER BY nombre_tipo_solicitud;"; 

		$execute =pg_query( $insert);


		return $execute;

		

	}
			public function consultNombreTipo_Solicitud($arre= array())
	{
		$resul=null;

		$nombre_tipo_solicitud=$arre['nombre_tipo_solicitud'];
		$estatus   = $arre['estatus'];

		if($estatus==null){
		$resul= pg_query(" SELECT nombre_tipo_solicitud, estatus FROM pasantias.tipo_solicitud WHERE nombre_tipo_solicitud=upper('$tipo_solicitud') ");
		}else{ 
		$resul= pg_query("SELECT nombre_tipo_solicitud, estatus FROM pasantias.tipo_solicitud WHERE nombre_tipo_solicitud=upper('$tipo_solicitud') AND estatus=$estatus");
		}

		return $resul;
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

	public function ActualizaTipo_Solicitud($arreglo =array()  )
	{

		$id_tipo_solicitud = $arreglo['id_tipo_solicitud'];
		$nombre_tipo_solicitud 	= $arreglo['nombre'];
		$estatus 	= $arreglo['estatus'];
		
		//$confirmar= pg_query("SELECT estatus FROM pasantias.tipo_solicitud  WHERE estatus ='$estatus' ;");

	    //$num= pg_num_rows($confirmar); 
		//$insert1 ="UPDATE pasantias.tipo_solicitud  SET  nombre_tipo_solicitud =('$nombre_tipo_solicitud') 
		//WHERE id_tipo_solicitud=$id_tipo_solicitud; ";
		
		 $insert2 ="UPDATE pasantias.tipo_solicitud SET nombre_tipo_solicitud =('$nombre_tipo_solicitud'), estatus='$estatus' WHERE id_tipo_solicitud=$id_tipo_solicitud; ";

		// if($num==1)
		// {
			
		// 	$exe =$insert1;

		// }else {

		// 	$exe =$insert2;
		// }
		 		$execute =pg_query( $insert2)  or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
				//pg_free_result($execute);
		return pg_affected_rows($execute);
	}


	public function tablaTipo_Solicitud(  )
	{

		$insert ="SELECT  * FROM pasantias.tipo_Solicitud ORDER BY nombre_tipo_solicitud;"; 

		$execute =pg_query( $insert);

		return $execute;
	}
}