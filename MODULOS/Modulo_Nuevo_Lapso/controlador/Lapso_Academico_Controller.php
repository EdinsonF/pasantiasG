<?php

include('../modelo/Lapso_Academico.php');


class Lapso_Academico_Controller{


	public function Registro($formulario = array())
	{
		

		$class = new lapso_academico();

	$class->setFormulario($formulario);
	
	return   $class->Incluir_lapso();
	
	}

	public function actualiza( $formulario = array() )
	{

		$class = new lapso_academico();

		return $class->Actualizar_lapso($formulario);

	}

	public function cargarTabla()
	{
		$class = new lapso_academico();
		$resultado = $class->tabla_lapso_academico();
			$data= array();

		        while($fila=pg_fetch_array($resultado))
                {	
					$data[] = $fila;							
				}
				return $data;
	}

	public function buscar_lapso( $consulta =array()  )
	{
		$class = new lapso_academico();

		$result= $class->consulta_lapso($consulta);

		return $result ;

	}

	public function cargarTablaFil( $arreglo = array() )
	{
		$class = new lapso_academico();
		$result= $class->registros_lapso_academico($arreglo); 	$data=array();
                while($Column=pg_fetch_array($result))
                {	
                		$data[]=$Column;
										
				}
		return $data;			
	}



}



?>