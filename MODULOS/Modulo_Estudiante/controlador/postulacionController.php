<?php
include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$co = $conexion->Conectar();
include("../modelo/mod_estudiante.php");
	


	class postulacionController
	{
		function cargarorganizaciones($arreglo)
		{
			$calss = new estudiante();

			$result = $calss->buscarOrganizaciones($arreglo['codigo_estudiante']);
			$data = array();
			while ($fila = pg_fetch_assoc($result))
			{
				$data[]=$fila;
			}

			return $data ; 

		}

		function PostularEstudiante($arreglo=array())
		{
			$calss = new estudiante();

			$resul =$calss->registrarPostulacion($arreglo);

			return $resul;
		}
		function BuscarMistemporadasEstudiante($arreglo=array())
		{
			$calss = new estudiante();
			$resul =$calss->BuscarTemporadaspara($arreglo['TemporadasAsignadaspupu']);
			$data = array();
			while ($fila = pg_fetch_assoc($resul) ) {
				$data[]= $fila;
			}
			return $data;
		}

		

	}
?>