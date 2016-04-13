<?php 
 include("../../../BASE_DATOS/Conect.php");
 $conexionBD = new Conexion();
 $conexionBD->Conectar();


class lapso_academico 
{ 
	private $id_lapso;
	private $lapso;
	private $fecha_inicio;
	private $fecha_fin;
	private $estatus;

	public function setFormulario( $formulario =array() )
	{
		
		$this->lapso= $formulario['lapso'];
		$this->fecha_inicio= $formulario['fecha_inicio'];
		$this->fecha_fin= $formulario['fecha_fin'];
		$this->estatus= $formulario['estatus'];


	}

	public function Incluir_lapso()
	{

		 

		$execute =pg_query("INSERT INTO pasantias.lapso_academico (numero_lapso,ano_i ,ano_f ,estatus)

		VALUES ( '$this->lapso' ,'$this->fecha_inicio', '$this->fecha_fin', '$this->estatus' )")  or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		return pg_affected_rows($execute);
		
	}

		public function Actualizar_lapso($arreglo =array()  )
	{

		$id_lapso  = $arreglo['id_lapso'];
		$lapso 	= $arreglo['lapso'];
		$fecha_inicio 	= $arreglo['fecha_inicio'];
		$fecha_fin 	= $arreglo['fecha_fin'];
		$estatus = $arreglo['estatus'];
		

		$insert ="UPDATE pasantias.lapso_academico  SET numero_lapso ='$lapso', ano_i='$fecha_inicio', ano_f='$fecha_fin', estatus='$estatus' WHERE id_lapso=$id_lapso; ";

		$execute =pg_query( $insert)  or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		return pg_affected_rows($execute);
		}
	
		public function registros_lapso($id_est  )
	{

		

		$sqlite ="SELECT * FROM pasantias.lapso_academico where id_lapso=$id_lapso ORDER BY lapso;"; 

		$execute =pg_query( $sqlite);

		return $execute;

	}
	

	public function registros_lapso_academico( $array = array() )
	{	$execute=null;

		$lapso =$array['lapso'];
		$estatus = $array['estatus'];
		$sql0 ="SELECT id_lapso , ano_i ,ano_f ,estatus ,numero_lapso FROM pasantias.lapso_academico WHERE numero_lapso like '$lapso%' ORDER BY numero_lapso;"; 
		$sql1 	="SELECT id_lapso , ano_i ,ano_f ,estatus ,numero_lapso FROM pasantias.lapso_academico WHERE estatus = upper('$estatus') ORDER BY numero_lapso;"; 
		$sql2 	="SELECT id_lapso , ano_i ,ano_f ,estatus ,numero_lapso FROM pasantias.lapso_academico WHERE estatus = upper('$estatus') AND numero_lapso like '$lapso%' ORDER BY numero_lapso;"; 
		if($lapso=='')
		{
				$execute =$sql1;
		}else if($estatus=='')
		{
			    $execute =$sql0;
		}else if( $lapso!='' && $estatus!='')
		{
				$execute =$sql2;
		}

		return  pg_query($execute) ;		
	}

	public function tabla_lapso_academico(  )
	{
		$insert ="SELECT id_lapso , ano_i ,ano_f ,estatus ,numero_lapso FROM pasantias.lapso_academico ORDER BY numero_lapso;"; 
		$execute =pg_query( $insert);
		return $execute;
	}

	function buscarlapsodeperiodo($id_periodo)
	{
		$sql = "SELECT numero_lapso FROM pasantias.lapso_academico JOIN pasantias.periodo_solicitud ON  lapso_academico.id_lapso =periodo_solicitud.id_lapso AND id_periodo=$id_periodo ;";
		 $valor=	pg_fetch_array( pg_query($sql) );
		return  $valor[0];
	}

}
