<?php

include('../modelo/Periodo_Solicitud.php');

class Periodo_Solicitud_Controller{


	public function Registro($formulario = array())
	{
		

		$class = new periodo_solicitud();

	$class->setFormulario($formulario);
	
	return   $class->Incluir_periodo();
	
	}
	
	public function selectLapso()
	{

		$class = new periodo_solicitud();
		
		$execute = $class->registrosLapsoSelect();

		$data = array();

			while($fila = pg_fetch_assoc($execute)):
		
			//echo "<option value='".$fila['id_lapso']."'>".$fila['numero_lapso']."</option>";
				$data[] =$fila;
			
			endwhile;

			return $data;
	}
	
	public function selectPeriodo()
	{

			$class = new periodo_solicitud();
			$execute = $class->registrosPeriodoSelect();

		while($fila = pg_fetch_array($execute)){
	
		echo "<option value='".$fila['id_periodo']."'>".$fila['fecha_inicio'].'  ||  '.$fila['fecha_fin']."</option>";

		
			}


	}
	public function selectTipoSolicitud()
	{

			$class = new periodo_solicitud();
			$execute = $class->registrosTipoSolicitudSelect();

		while($fila = pg_fetch_array($execute)){
	
		echo "<option value='".$fila['id_tipo_solicitud']."'>".$fila['nombre_tipo_solicitud']."</option>";

		
			}


	}
	
	

	public function actualiza( $formulario = array() )
	{

		$class = new periodo_solicitud ();

		return $class->Actualizar_Periodo($formulario);

	}

	public function cargarTabla()
	{
		$class = new periodo_solicitud ();

		$resultado = $class->tabla_periodo();
		$data = array();
		while($fila=pg_fetch_array($resultado))
        {	
        	$data[]=$fila;
		}
				
		return $data;

	}

	public function buscar_periodo( $consulta =array()  )
	{
		$class = new periodo_solicitud ();

		$result= $class->consulta_periodo($consulta);

		return $result ;

	}

	 function fechas_del_select($arreglo = array() ) 
	 {
  				$class = new periodo_solicitud ();

	 	$result= $class->datosPeriodo($arreglo['select']);
	 	return pg_fetch_array($result);
	 }

	public function cargarTablaFil( $arreglo = array() )
	{
	
		$class = new periodo_solicitud ();
		$result= $class->registros_periodo($arreglo);
		$data =array();

                while($Column=pg_fetch_array($result))
                {	
					$data[]=$Column;
				}
				return $data;
	}


	function verificarfechas_adentre_Range( $fechas = array() )
	{
		$class = new periodo_solicitud ();
		$result= $class->verificarfechas_adentre_Range($fechas);

		return $result;

	}

}



?>