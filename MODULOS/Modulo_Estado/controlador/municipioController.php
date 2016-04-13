<?php

include('../modelo/estadoMunicipio.php');


class municipioController{


	public function Registro($formulario = array())
	{

		$class = new estadoMunicipio();

	$class->setFormulario($formulario);


	
	
	return   $class->IncluirMunicipio();
	
	}

	public function actualiza( $formulario = array() )
	{
		$class = new estadoMunicipio();

		return $class->ActualizaMunicipio($formulario);
	}


	public function selectEstado()
	{
		$class      = new estadoMunicipio();
		
		$execute    = $class->registrosEstadosSelect(  );
					
		while($fila = pg_fetch_array($execute)){
	
		echo "<option value='".$fila['id_estado']."'>".$fila['nombre_estado']."</option>";
		
		}

	}

	public function buscarNombre( $consulta =array()  )
	{

		$class = new estadoMunicipio();

		$result= $class->consultaNombreMunicipio($consulta);

		return $result ;

	}

	public function cargarTablaFil( $arreglo = array() )
	{
		
		$class      = new estadoMunicipio();
				
		$result     = $class->registrosMunicipio($arreglo);

		$DATA       = array();

		while($fila = pg_fetch_array($result))
		{
			$DATA[] = $fila;
		}
		return $DATA;

	}



}



?>