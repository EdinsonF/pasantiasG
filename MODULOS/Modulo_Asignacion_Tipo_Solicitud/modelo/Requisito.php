<?php 

include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$co = $conexion->Conectar();

class Requisito
{

	private $id_requisito;
	private $nombre_requisito;
	private $descripcion;
	private $estatus;

	public function setFormulario( $formulario =array() )
	{

		$this->nombre_requisito= $formulario['nombre_requisito'];
	
		$this->estatus= $formulario['estatus'];

	}

	public function IncluirRequisito()
	{

		$insert ="INSERT INTO pasantias.requisito (nombre_requisito, estatus)

		VALUES ( upper('$this->nombre_requisito') , '$this->estatus' )"; 

		$execute =pg_query( $insert)  or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		return pg_affected_rows($execute);
		

	}

		public function ActualizarRequisito($arreglo =array()  )
	{

		$id_requisito  = $arreglo['id_requisito'];
		$nombre_requisito 	= $arreglo['nombre_requisito'];
		$estatus = $arreglo['estatus'];
		

		$insert ="UPDATE pasantias.requisito  SET nombre_requisito =upper('$nombre_requisito'), estatus='$estatus' WHERE id_requisito=$id_requisito; ";

		$execute =pg_query( $insert)  or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		return pg_affected_rows($execute);
		}
	
		public function registrosRequisitosSelect($id_est  )
	{
		$sqlite ="SELECT * FROM pasantias.requisito where id_requisito=$id_requisito ORDER BY nombre_requisito;"; 

		$execute =pg_query( $sqlite);

		return $execute;

	}
	
	function consultaNombreRequisito($requisito  = array())
	{
		$requisito =$requisito['nombre_requisito'];
		$estatus   = $requisito['estatus'];

		if($estatus==null){
		$resul= pg_query(" SELECT nombre_requisito, estatus FROM pasantias.requisito WHERE nombre_requisito=upper('$requisito') ");
		}else{ 
		$resul= pg_query("SELECT nombre_requisito, estatus FROM pasantias.requisito WHERE nombre_requisito=upper('$requisito') AND estatus=$estatus");
		}
	}

	public function registrosrequisito( $array = array() )
	{
		// aQUI  APLICARE  LA  LOGICA DE LAS  CONSULTAS de  el  modelo de  municipio
		$requisito = $array['requisito']; 
		$estatus = $array['estatus']; 

		$sqlite ="SELECT * FROM pasantias.requisito WHERE nombre_requisito LIKE upper('$requisito%') ORDER BY nombre_requisito;"; 

		$sqliteestatus ="SELECT * FROM pasantias.requisito WHERE estatus = '$estatus' ORDER BY nombre_requisito;"; 
		$execute="";
		if($requisito == null)
		{
			$execute =pg_query( $sqliteestatus);
		}else 
		{
			$execute =pg_query( $sqlite);
		}

		return $execute;		
		
	}

	public function tablaRequisito(  )
	{

		$insert ="SELECT  * FROM pasantias.requisito ORDER BY nombre_requisito;"; 

		$execute =pg_query( $insert);

		return $execute;

	}

}