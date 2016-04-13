 <?php 
 include("../../../BASE_DATOS/Conect.php");
 $conexionBD = new Conexion();
 $conexionBD->Conectar();


class periodo_solicitud 
{ 
	
	private $fecha_inicio;
	private $fecha_fin;
	private $id_lapso;
	private $estatus;

	public function setFormulario( $formulario =array() )
	{
		
		
		$this->fecha_inicio= $formulario['fecha_inicio'];
		$this->fecha_fin= $formulario['fecha_fin'];
		$this->id_lapso= $formulario['numero_lapso'];
		$this->estatus= $formulario['estatus'];


	}

	public function Incluir_periodo()
	{
		$dividao = split('[/]',$this->fecha_inicio);
		$this->fecha_inicio = str_replace(' ','',$dividao[2]).'-'.$dividao[1].'-'.$dividao[0];
		$dividao = split('[/]',$this->fecha_fin);
		$this->fecha_fin = str_replace(' ','',$dividao[2]).'-'.$dividao[1].'-'.$dividao[0];
		$execute =pg_query("INSERT INTO pasantias.periodo_solicitud (id_lapso,fecha_inicio ,fecha_fin ,estatus)

		VALUES ( $this->id_lapso ,'$this->fecha_inicio', '$this->fecha_fin', '$this->estatus' )")  or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		return pg_affected_rows($execute);
		
	}


	public function registrosLapsoSelect(  )
	{

		$sqlite ="SELECT * FROM pasantias.lapso_academico ORDER BY numero_lapso;"; 

		$execute =pg_query( $sqlite);

		return $execute;
		

	}
	
	// public function registrosLapsoSelect(  )
	// {

		

	// 	$sqlite ="SELECT * FROM pasantias.lapso_academico ORDER BY numero_lapso;"; 

	// 	$execute =pg_query( $sqlite);



	// 	return $execute;
		

	// }

	 function datosPeriodo($numero)
	 {
	 
	  	 $parametro = $numero;
	  	 $sql = pg_query("SELECT ano_i ,ano_f FROM pasantias.lapso_academico WHERE id_lapso ='$parametro' ;");

	  	 return $sql; 
	  }

	

		public function Actualizar_Periodo($arreglo =array()  )
	{

		$id_lapso  = $arreglo['numero_lapso'];
		$id_periodo 	= $arreglo['id_periodo'];
		$fecha_inicio 	= $arreglo['fecha_inicio'];
		$fecha_fin 	= $arreglo['fecha_fin'];
		$estatus = $arreglo['estatus'];
		

		$insert ="UPDATE pasantias.periodo_solicitud  SET fecha_inicio ='$fecha_inicio', id_lapso='$id_lapso', fecha_fin='$fecha_fin', estatus='$estatus' WHERE id_periodo=$id_periodo; ";

		$execute =pg_query( $insert)  or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		return pg_affected_rows($execute);
		}
	
		public function registros_periodo($id_est=array())
	{
		$id = $id_est['periodo_solicitud']; 

		$sqlite ="SELECT periodo_solicitud.*, lapso_academico.numero_lapso ,lapso_academico.id_lapso FROM pasantias.periodo_solicitud INNER JOIN pasantias.lapso_academico ON
		 periodo_solicitud.id_lapso = lapso_academico.id_lapso where id_periodo=$id ORDER BY id_periodo desc;"; 

		$execute =pg_query( $sqlite);

		return $execute;

	}
	
	/*function consulta_lapso($lapso_academico  = array())
	{
		$lapso_academico =$lapso_academico['lapso'];
		$estatus   = $lapso_academico['estatus'];

		if($estatus==null){
		$resul= pg_query(" SELECT lapso , descripcion, estatus FROM pasantias.lapso_academico WHERE lapso=upper('$lapso_academico') ");
		}else{ 
		$resul= pg_query("SELECT lapso, descripcion, estatus FROM pasantias.lapso_academico WHERE lapso=upper('$lapso_academico') AND estatus=$estatus");
		}

		$descripcion=null;

		while($fila = pg_fetch_array($resul))
		{
			$descripcion=$fila['descripcion'];
		}
		
		return array('num'=>pg_num_rows($resul), 'descripcion'=>$descripcion);
	}
*/
	public function registros_lapso_academico( $array = array() )
	{
		// aQUI  APLICARE  LA  LOGICA DE LAS  CONSULTAS de  el  modelo 
		$periodo_solicitud = $array['periodo_solicitud']; 
		$estatus = $array['estatus']; 

		$sqlite ="SELECT * FROM pasantias.periodo_solicitud WHERE fecha_inicio like '$periodo_solicitud' ORDER BY fecha_inicio;"; 

		$sqliteestatus ="SELECT * FROM pasantias.periodo_solicitud WHERE estatus = '$estatus' ORDER BY fecha_inicio;"; 
		$execute="";
		if($periodo_solicitud == null)
		{
			$execute =pg_query( $sqliteestatus);
		}else 
		{
			$execute =pg_query( $sqlite);
		}		

		return $execute;
		
		
	}

	public function tabla_periodo(  )
	{

		$insert ="SELECT periodo_solicitud.* , lapso_academico.numero_lapso FROM pasantias.periodo_solicitud
		INNER JOIN pasantias.lapso_academico ON lapso_academico.id_lapso = periodo_solicitud.id_lapso  ORDER BY fecha_inicio;"; 

		$execute =pg_query( $insert);


		return $execute;

		
	}

	public function registrosPeriodoSelect(  )
	{

		$sqlite ="SELECT id_periodo , fecha_inicio , fecha_fin FROM pasantias.periodo_solicitud WHERE estatus='ACTIVO' ORDER BY fecha_inicio;"; 

		$execute =pg_query( $sqlite);

		return $execute;		

	}
	
	public function registrosTipoSolicitudSelect(  )
	{

//include('../.../Modulo_Nuevo_Lapso/modelo/Lapso_Academico.php');
		

		$sqlite ="SELECT * FROM pasantias.tipo_solicitud ORDER BY nombre_tipo_solicitud;"; 

		$execute =pg_query( $sqlite);

		return $execute;
		

	}

	public function periodosSelectparaTemporadasegunEncargado($codigo_encargado)
	{
		 $sql =pg_query(" SELECT periodo_solicitud.id_periodo , fecha_inicio , fecha_fin 
		 			FROM  pasantias.periodo_solicitud--//temporadas_solicitud 

  					--RIGHT JOIN pasantias.periodo_solicitud 

  						--ON ( temporadas_solicitud.id_periodo = periodo_solicitud.id_periodo )

  					--Left join pasantias.encargado 

  						--on ( encargado.codigo_encargado = temporadas_solicitud.codigo_encargado )  					
  						
  						--and( encargado.codigo_encargado='$codigo_encargado' )

					--WHERE temporadas_solicitud.id_periodo IS NULL 

					WHERE  periodo_solicitud.estatus='ACTIVO' ORDER BY fecha_inicio;");
		return $sql ;
	}

	public function verificarfechas_adentre_Range( $fechas = array() )
	{	
		$lapso =  $fechas['id_lapso'];
		$fecha_i =  $fechas['fecha_inicio'];
		$fecha_f =  $fechas['fecha_fin'];

		$sql = pg_query("SELECT lapso_academico.ano_i , lapso_academico.ano_f
		 FROM pasantias.lapso_academico WHERE id_lapso = $lapso
		 AND '$fecha_i' BETWEEN ano_i AND ano_f;");
	     	
	      $values_procces=$this->procesar_periodo( $sql ,$fecha_i , $fecha_f );

		return $values_procces;
	}

	function procesar_periodo( $sql , $fecha_i , $fecha_f )
	{
		 $valor = pg_num_rows($sql);
		 if($valor== 0)
		 {	
					$sqlSg = $this->BuscarSugerencia_segunFechas_puestas_para_lapso_correspondiente( $fecha_i , $fecha_f  );
			  if(pg_num_rows($sqlSg)!=1)
			  {
			  		$valor = 2;
			  }else
			  {
			  	$array = array();
			  	while($fila = pg_fetch_assoc($sqlSg))
			  	{	
			  		$array[]=$fila;
			  	}
			  	
			  	$valor = $array ;
			  } 
		 }

		return $valor;
	}

	function BuscarSugerencia_segunFechas_puestas_para_lapso_correspondiente( $fecha_i , $fecha_f )
	{	
		$sql = pg_query("SELECT id_lapso ,
				lapso_academico.numero_lapso ||' :: '||
				to_char(lapso_academico.ano_i, 'DD, TMMonth YYYY')|| ' al ' ||to_char(lapso_academico.ano_f, 'DD, TMMonth YYYY')
				as lapsoacademico
		 FROM pasantias.lapso_academico WHERE '$fecha_i' BETWEEN ano_i AND ano_f ;");

		return $sql;
	}
}
