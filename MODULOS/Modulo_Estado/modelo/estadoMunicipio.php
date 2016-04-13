<?php 

include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$co = $conexion->Conectar();

class estadoMunicipio
{

	private $id_estado;

	private $id_municipio;
	
	private $nombre;
	
	private $codigo;



	public function setFormulario( $formulario =array() )
	{


		$this->id_estado = $formulario['id_estado'];

		$this->nombre= $formulario['nombre'];
		
		$this->codigo= $formulario['codigo'];



	}
	public function setEstado($formulario =array() )
	{
		$this->nombre= $formulario['nombre'];
		
		$this->codigo= $formulario['codigo'];


	}

	


	
	public function IncluirEstado()
	{

		$exe = pg_query("SELECT MAX(id_estado)+1 as id , 1 AS id_xiliar_id FROM pasantias.estado ");
		
		$id = pg_fetch_array($exe);

		$id_estado = $id[0];

		if($id_estado == 0) 
		{
				$id_estado = $id[1];
		}
		$insert ="INSERT INTO pasantias.estado ( id_estado,  nombre_estado, codigo)

		VALUES ( $id_estado,upper('$this->nombre') , '$this->codigo' )"; 

		$execute =pg_query( $insert)  or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		return pg_affected_rows($execute);
		

	}

	public function tablaEstadosFiltro( $nomber , $codigo )
	{

	$sqlNombre ="SELECT estado.id_estado,  estado.nombre_estado, estado.codigo , 

		Count(municipio.id_estado) as conterMunicipios

		FROM pasantias.estado INNER JOIN pasantias.municipio 

			ON municipio.id_estado = estado.id_estado

		WHERE nombre_estado LIKE  upper('$nomber%') 

		GROUP BY estado.id_estado,  estado.nombre_estado, estado.codigo ORDER BY nombre_estado;"; 

	$sqlCodigo ="SELECT estado.id_estado,  estado.nombre_estado, estado.codigo , 

		Count(municipio.id_estado) as conterMunicipios

		FROM pasantias.estado INNER JOIN pasantias.municipio 

			ON municipio.id_estado = estado.id_estado

		WHERE estado.codigo LIKE '$codigo%'

		GROUP BY estado.id_estado,  estado.nombre_estado, estado.codigo ORDER BY nombre_estado;"; 

	$Ambas ="SELECT estado.id_estado,  estado.nombre_estado, estado.codigo , 

		Count(municipio.id_estado) as conterMunicipios

		FROM pasantias.estado INNER JOIN pasantias.municipio 

			ON municipio.id_estado = estado.id_estado 

		WHERE nombre_estado LIKE  upper('$nomber%')

			AND estado.codigo LIKE  '$codigo%' 

		GROUP BY estado.id_estado,  estado.nombre_estado, estado.codigo ORDER BY nombre_estado;"; 


		if($nomber == null)
		{
				$insert = $sqlCodigo;

		}else if($codigo == null)
		{

				$insert = $sqlNombre;

		}else{ 

				$insert = $Ambas;
		}


		$execute =pg_query( $insert);


		return $execute;

		

	}

	public function consultEstado( )
	{
		$sql ="SELECT estado.* , COUNT(municipio.id_estado) as contmunicipio 

		FROM pasantias.estado INNER JOIN pasantias.municipio 

			ON estado.id_estado = municipio.id_estado 

		GROUP BY estado.id_estado , estado.nombre_estado , estado.codigo 

		ORDER BY nombre_estado;"; 

		$execute =pg_query( $sql);


		return $execute;

	}
	
	public function consultNombreEstado($arre= array())
	{		
		$nombre=$arre['nombre'];

		$insert ="SELECT codigo FROM pasantias.estado  where estado.nombre_estado = upper('$nombre');"; 

		$execute =pg_query( $insert);

		$fila = pg_fetch_array($execute);
		
			$codigo=$fila[0];
		
		
		return array('num'=>pg_num_rows($execute), 'codigo'=>$codigo);

		return $execute;

		

	}


		public function registrosEstadosSelect(  )
	{

		

		$sqlite ="SELECT * FROM pasantias.estado ORDER BY nombre_estado;"; 

		$execute =pg_query( $sqlite);



		return $execute;
		

	}

	public function IncluirMunicipio()
	{


		$id= pg_query("SELECT MAX(id_municipio)+1 as id , 1 as id_auxiliar FROM pasantias.municipio ");
		$arre= pg_fetch_array($id);

		$id_municipio = $arre[0];
		if($id_municipio == null){
		$id_municipio = $arre[1];
		}
		$insert ="INSERT INTO pasantias.municipio (id_municipio, id_estado, nombre_municipio, codigo)

		VALUES ($id_municipio , '$this->id_estado' , upper('$this->nombre') , '$this->codigo' )"; 

		$execute =pg_query( $insert)  or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		return pg_affected_rows($execute);
		

	}

		public function ActualizaMunicipio($arreglo =array()  )
	{

		$id_estado  = $arreglo['id_estado'];
		$nombre 	= $arreglo['nombre'];
		$codigo 	= $arreglo['codigo'];
		$id_municipio = $arreglo['id_municipio'];
		
		$insert ="UPDATE pasantias.municipio  SET  id_estado=$id_estado,

		nombre_municipio =upper('$nombre'), codigo='$codigo' WHERE id_municipio=$id_municipio; ";

		$execute =pg_query( $insert)  or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
		pg_free_result($insert);
		return pg_affected_rows($execute);
		}

		function consultarcodigoEstado($codigo)
		{	
			$result =pg_query("SELECT id_estado FROM pasantias.estado WHERE codigo ='$codigo' ;");
			return pg_num_rows($result);
		}


		function consultarnombreEstado($nombre)
		{	
			$result =pg_query("SELECT id_estado FROM pasantias.estado WHERE nombre_estado =upper('$nombre') ;");
			return pg_num_rows($result);
		}

	public function ActualizaEstado($arreglo =array()  )
	{

		$nombre 	= $arreglo['nombre'];
		$codigo 	= $arreglo['codigo'];
		$id_estado = $arreglo['id_estado'];

	    $valorcodigo =$this->consultarcodigoEstado($codigo);
		$valornombre =$this->consultarnombreEstado($nombre);

		$insertnombre ="UPDATE pasantias.estado  SET  nombre_estado =upper('$nombre') WHERE id_estado=(SELECT id_estado FROM pasantias.estado WHERE codigo='$codigo') ; ";
		
		$insertLos2 ="UPDATE pasantias.estado  SET nombre_estado =upper('$nombre'), codigo='$codigo' WHERE id_estado=$id_estado ; ";

		$insertcodigo ="UPDATE pasantias.estado  SET codigo='$codigo' WHERE id_estado=(SELECT id_estado FROM pasantias.estado WHERE nombre_estado=upper('$nombre') ) ; ";

		 		  if($valornombre==1 && $valorcodigo==0)
		 	{
		 			$exe=$insertcodigo;

		 	}else if($valorcodigo==1 && $valornombre==0)
		 	{
		 			$exe=$insertnombre;

		 	}else if($valornombre==0 && $valorcodigo==0)
		 	{
		 			$exe=$insertLos2;

		 	}

				if(isset($exe))
				{

				$execute =pg_query( $exe)  or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
				$num = pg_affected_rows($execute);
				pg_free_result($execute);
				}

		return $num;
	}

		public function registrosMunicipioSelect($id_estado  )
	{
		$sqlite ="SELECT id_municipio , nombre_municipio,nombre_estado FROM pasantias.municipio JOIN pasantias.estado ON municipio.id_estado = estado.id_estado AND estado.id_estado=$id_estado ORDER BY nombre_municipio;"; 

		$execute =pg_query( $sqlite);

		return $execute;
	}
	
	function consultaNombreMunicipio($estadomunicipio  = array())
	{
		$municipio =$estadomunicipio['nombre'];
		$estado   = $estadomunicipio['select'];

		if($estado==null){
		$resul= pg_query(" SELECT nombre_municipio , codigo FROM pasantias.municipio WHERE nombre_municipio=upper('$municipio') ");
		}else{ 
		$resul= pg_query("SELECT nombre_municipio , codigo FROM pasantias.municipio WHERE nombre_municipio=upper('$municipio') AND id_estado=$estado");
		}

		$codigo=null;

		while($fila = pg_fetch_array($resul))
		{
			$codigo=$fila['codigo'];
		}
		
		return array('num'=>pg_num_rows($resul), 'codigo'=>$codigo);
	}

	public function registrosMunicipio( $array = array() )
	{

		$id_estado = $array['select'];
		$nombre_municipio= $array['nombre'];
		$codigo_municipio= $array['codigo'];


		$sqlselect ="SELECT municipio.* , estado.id_estado,estado.nombre_estado FROM pasantias.municipio INNER JOIN pasantias.estado

		ON municipio.id_estado =$id_estado AND municipio.id_estado = estado.id_estado  ORDER BY nombre_municipio;"; 

		$sqlNombre ="SELECT municipio.* , estado.id_estado, estado.nombre_estado FROM pasantias.municipio INNER JOIN pasantias.estado

		 ON nombre_municipio LIKE upper('$nombre_municipio%')  AND municipio.id_estado = estado.id_estado  ORDER BY nombre_municipio;"; 

		$sqlCodigo ="SELECT municipio.* , estado.id_estado, estado.nombre_estado FROM pasantias.municipio INNER JOIN pasantias.estado

		 ON municipio.codigo LIKE upper('$codigo_municipio%') AND municipio.id_estado = pasantias.estado.id_estado  ORDER BY nombre_municipio;"; 

		$sqlTodas ="SELECT municipio.* , estado.id_estado, estado.nombre_estado FROM pasantias.municipio INNER JOIN pasantias.estado

		 ON municipio.id_estado =$id_estado AND municipio.id_estado = estado.id_estado

		 AND nombre_municipio LIKE upper('$nombre_municipio%')  ORDER BY nombre_municipio;"; 

		 $insert = null;

		if( ($id_estado == null) && ($nombre_municipio == null) )
		{
				$insert = $sqlCodigo;

		}else if (($codigo_municipio == null) && ($id_estado == null))
		{

				$insert = $sqlNombre;

		}else if (($codigo_municipio == null) && ($nombre_municipio == null)){ 

		
				$insert = $sqlselect;

		}else if($id_estado == null){

			$insert= "SELECT municipio.* , estado.id_estado, estado.nombre_estado FROM pasantias.municipio INNER JOIN  pasantias.estado ON nombre_municipio LIKE upper('$nombre_municipio%') AND municipio.codigo LIKE upper('$codigo_municipio%') ORDER BY nombre_municipio;";
		}else 
		{
				$insert = $sqlTodas;

		}

		$execute =pg_query( $insert);


		return $execute;

		
	}

	public function tablaMunicipio(  )
	{

		$insert ="SELECT municipio.* , estado.id_estado , estado.nombre_estado FROM pasantias.municipio INNER JOIN 	pasantias.estado ON pasantias.municipio.id_estado = pasantias.estado.id_estado ORDER BY nombre_municipio;"; 

		$execute =pg_query( $insert);


		return $execute;

		
	}


}
