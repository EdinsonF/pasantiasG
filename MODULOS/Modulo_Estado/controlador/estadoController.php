<?php

include('../modelo/estadoMunicipio.php');

	

class estadoController{


	public function Registro($formulario = array())
	{

		$class = new estadoMunicipio();

		$class->setEstado($formulario);

		$num=0;
		$num=  $class->IncluirEstado();

		return $num;

	}

	public function ConsultaTiempoReal($formulario = array())
	{

		$class = new estadoMunicipio();

		$consulta = $class->consultNombreEstado($formulario);

		return $consulta;

	}
	public function Modificar ($formulario = array())
	{
		$class = new estadoMunicipio();

		$update = $class->ActualizaEstado($formulario);

		return $update;
	}

	public function catalFiltro( $arreglo = array() )
	{

	$class = new estadoMunicipio();

	$campo= $arreglo['nombre'];$codigo = $arreglo['codigo'];	

	$result= $class->tablaEstadosFiltro($campo , $codigo);

		$DATA = array();
		while($fila = pg_fetch_array($result))
		{
			$DATA[] = $fila;
		}

			return $DATA;


	}

	public function Datosparamodificar($variable = array() )
	{
			$class = new estadoMunicipio();
			$valuecodigo=$class->consultarcodigoEstado($variable['codigo']);
			$valueestado=$class->consultarnombreEstado($variable['nombre']);
		return array( 'nombre'=>$valueestado,'codigo'=> $valuecodigo);
	}

	public function selectEstado()
	{

			$class = new estadoMunicipio();
			$execute = $class->registrosEstadosSelect(  );


		while($fila = pg_fetch_array($execute)){
	
		echo "<option value='".$fila['id_estado']."'>".$fila['nombre_estado']."</option>";

		
			}

	}

}

?>