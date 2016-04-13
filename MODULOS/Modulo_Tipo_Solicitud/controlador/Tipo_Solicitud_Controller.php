<?php

include('../modelo/Tipo_Solicitud.php');

	

class Tipo_Solicitud_Controller{


	public function Registro($formulario = array() , $codigo_encargado)
	{

		$class = new Tipo_Solicitud();

		$class->setTipo_Solicitud($formulario);

		$num=  $class->IncluirTipo_Solicitud( $codigo_encargado);

		return $num;

	}

	public function ConsultaTiempoReal($formulario = array() , $codigo_encargado)
	{

		$class = new Tipo_Solicitud();

		$consulta = $class->consultNombreTipo_Solicitud($formulario , $codigo_encargado);

		return $consulta;

	}
	public function Modificar ($formulario = array(), $codigo_encargado)
	{
		$class = new Tipo_Solicitud();

		$update = $class->ActualizaTipo_Solicitud($formulario, $codigo_encargado);

		return $update;
	}

	public function cargarCatal( $codigo_encargado)
	{

		$class = new Tipo_Solicitud();
		$result = $class->consultTipo_Solicitud( $codigo_encargado );
			$data = array();
	             while($fila=pg_fetch_array($result))
                {	
								$data[] =$fila;
				} 
			
				return $data;
	}

	public function catalFiltro( $arreglo = array() , $codigo_encargado)
	{

	$class = new Tipo_Solicitud();

	$result= $class->tablaTipo_SolicitudFiltro($arreglo , $codigo_encargado);

				$data = array();
                while($fila=pg_fetch_assoc($result))
                {	

					$data[] =$fila;
				}
				return $data ;


	}

	public function selectTipo_Solicitud()
	{

			$class = new Tipo_Solicitud();
			$execute = $class->registrosTipo_SolicitudSelect(  );


		while($fila = pg_fetch_array($execute)){
	
		echo "<option value='".$fila['id_tipo_solicitud']."'>".$fila['nombre_tipo_solicitud']."</option>";

		
			}

	}

	 function VarificarTipoSolicitud($arreglo = array() , $codigo_encargado )
	 {
		$nombre      = $arreglo['tipoSolicitud'];
		
		$estatus     = $arreglo['estatus'];
		
		$descripcion = $arreglo['descripcion'];
		
		$class       = new Tipo_Solicitud();
		
		$result      = $class->buscarTipoSolicitud($nombre , $estatus ,$descripcion, $codigo_encargado);
	 	
	 	return $result;
	 }

	 function buscarAutocompletado($codigo_encargado)
	 {
	 	$class       = new Tipo_Solicitud();
		
		$result      = $class->buscarTipoSolicitudAutoComplete($codigo_encargado);
	 		
		$data 		 = array();

		while ( $fila= pg_fetch_assoc($result)) {
				
			$data[]  = $fila;
		}

	 	return $data;
	 }
}

?>