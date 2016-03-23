<?php
include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$co = $conexion->Conectar();
include("../modelo/PostulacionDirecta.php");
	


	class postulacionController
	{
		function cargarorganizacionesParaELEstudiante($arreglo)
		{
			$calss = new Postulacion();

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
			$calss = new Postulacion();

			$resul =$calss->registrarPostulacion($arreglo);

			return $resul;
		}
		function BuscarMistemporadasEstudiante($arreglo=array())
		{
			$calss = new Postulacion();
			$resul =$calss->BuscarTemporadaspara($arreglo['TemporadasAsignadaspupu']);
			$data = array();
			while ($fila = pg_fetch_assoc($resul) ) {
				$data[]= $fila;
			}
			return $data;
		}

		function cargarorganizacionesParaELEncargado(  $var =array()  )
		{

			$class = new Postulacion();
			$values = $class->cargarorganizacinesEncargado($var);
			$data = array();
			while( $result = pg_fetch_assoc($values) )
			{
					$data[] = $result;
			}

			return $data;
		}
			function HacerResumenOrganizacionesAsociadasA( $id_ip)
			{
				$class = new Postulacion();
				$values = $class->ContarSegunTipoOrganizacion($id_ip);
				$data = array();
				while( $result = pg_fetch_assoc($values) )
				{	
					if($result['cantidad']==1){ 
						 
						 $row =$this->DetallesRersumenSucursal($result['nombre_tipo_organizacion'] , $id_ip); 
						 $result['answer'] = $row;
						 // $result['organizacion'] = $row[1]; 
						}
						$data[] = $result;
					
				}

				return $data;
			}
			function DetallesRersumenSucursal($nombre_tipo_organizacion , $id_ip)
			{
				$class = new Postulacion();
				$values = $class->DetallesResumidoOrganizacionAsociada($nombre_tipo_organizacion , $id_ip);

				 $valores = pg_fetch_row($values);
					
	
				return 	$valores[0];
			}
		

	}
?>