<?php

include('../modelo/Requisito.php');


class requisitoController{


	public function Registro($formulario = array())
	{

	$class = new requisito();

	$class->setFormulario($formulario);

	return   $class->IncluirRequisito();
	
	}

	public function actualiza( $formulario = array() )
	{

		$class = new requisito();

		
			
		return $class->ActualizarRequisito($formulario);

	}

	public function cargarTabla()
	{

		$class = new requisito();
		 $resultado = $class->tablaRequisito();
		 	$data =array();
		        while($fila=pg_fetch_array($resultado))
                {	

							
				$data[] =$fila;
							
				}
				return $data;			

	}

	public function buscarNombre( $consulta =array()  )
	{

		$class = new requisito();

		$result= $class->consultaNombreRequisito($consulta);

		return $result ;

	}

	public function cargarTablaFil( $arreglo = array() )
	{

		$class = new requisito(); 
    	$result= $class->registrosrequisito($arreglo);
				$data = array();

                while($Column=pg_fetch_array($result))
                {	
							$data[] =$Column;	
				}
				return $data;
	}

}

?>