<?php 

include('../../Modulo_Estado/modelo/estadoMunicipio.php');


class tipoOrganizacion
{

	private $id_tipoOrganizacion;
	
	private $nombre;
	
	private $clasificacion;

	private $descripcion;


	public function SetFormulario( $form =array() )
	{

		$this->nombre= $form['nombre'];
		
		$this->clasificacion=$form['clasif'];

		$this->descripcion= $form['descripcion'];
	    

	}

	public function Conectar()
	{

		$conexion = new Conexion();
	  	
	  	$conexion->Conectar();

	}


	public function Incluir()
	{

	  	$this->Conectar();

		$insert ="INSERT INTO pasantias.tipo_organizacion ( nombre_tipo_organizacion, descripcion, estatus)
		-- La Columna clasificacion Esta TRabajada Como Estatus Sorry 
		VALUES ( upper('$this->nombre') , upper('$this->descripcion') ,'$this->clasificacion' )"; 

		$execute =pg_query( $insert)  or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
		$num = pg_affected_rows($execute);

		pg_free_result($execute);

		return $num;



	}

		public function RegistrosT1( $todo = array() )
	{	
		$insert = null;
	  	$nombre=$todo['nombre'];

	  	$estatus=$todo['estatus'];
	  	$this->Conectar();

		$consultaCampo =" SELECT * FROM pasantias.tipo_organizacion WHERE nombre_tipo_organizacion LIKE upper('%$nombre%')

		Order By estatus   ;";

		$consultaestatus =" SELECT * FROM pasantias.tipo_organizacion WHERE estatus =  '$estatus'

		Order By estatus   ;"; 

		$consultaAmbas =" SELECT * FROM pasantias.tipo_organizacion WHERE nombre_tipo_organizacion LIKE  upper('%$nombre%') Order By estatus   ;"; 

			if($nombre=='' && $estatus==''){
					$execute =pg_query( " SELECT * FROM pasantias.tipo_organizacion  ORDER BY estatus  ;");
			}else
			if($nombre=='')
			{
				$execute =pg_query( $consultaestatus);
			}else if($estatus=='')
			{
				$execute =pg_query( $consultaCampo);
			}else 
			{
				$execute =pg_query( $consultaAmbas);
			}
		


		return $execute;

	}

		public function RegistrosT( )
	{	
		

		$insert =" SELECT * FROM pasantias.tipo_organizacion  ORDER BY estatus  ;"; 

		
	  	$this->Conectar();
	  	
		

		$execute =pg_query( $insert);


		return $execute;

	}

	function BuscandoEsteTipo($formun = array())
	{
		$parametro= $formun['nombre'];
		$sql = pg_query(" SELECT id_tipo_organizacion FROM pasantias.tipo_organizacion WHERE nombre_tipo_organizacion = upper('$parametro') ;");
		$ver = pg_fetch_array($sql);
		 $iqId = $ver[0];
		 	if(isset($iqId)){
		$sqlV = pg_query(" SELECT id_tipo_organizacion FROM pasantias.tipo_organizacion WHERE  id_tipo_organizacion = '$iqId' ;");
		    return pg_num_rows($sqlV);
			}else { return 0; } 
		
	}

	function ModificartipoOrganizacion( $form = array() )
	{	
		$id = $form['id'];
		$nombre = $form['nombre'];
		$clasificacion = $form['clasif'];
		$descripcion = $form['descripcion'];

		$result = pg_query(" UPDATE pasantias.tipo_organizacion SET nombre_tipo_organizacion=upper('$nombre'), estatus='$clasificacion' , descripcion='$descripcion' WHERE id_tipo_organizacion= $id ");
		$num = pg_affected_rows($result);
		pg_free_result($result);
		return $num;
	}


	public function registrosTipoOrganizacionSelect(  )
	{
	
	  	$this->Conectar();
		$sqlite ="SELECT * FROM pasantias.tipo_organizacion ORDER BY nombre_tipo_organizacion ;"; 
		$execute =pg_query( $sqlite);
		while($fila = pg_fetch_array($execute))
		{
		echo "<option value='".$fila['id_tipo_organizacion']."'>".$fila['nombre_tipo_organizacion']."</option>";
		}
		return $execute;
	}

	function imprimirtiposOrganizacion()
	{

   		$sql = pg_query(" SELECT nombre_tipo_organizacion FROM pasantias.tipo_organizacion;");

   		return $sql;
	}

}
