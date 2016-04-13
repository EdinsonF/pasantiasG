<?php
include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$co = $conexion->Conectar();
include("../modelo/PostulacionDirecta.php");
	


	class postulacionController
	{
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

			function DetallesSucursalAsociadaplease( $id_organizacionPrincipal , $codigo_sucursal , $codigo_encargado)
			{
				$clase = new Postulacion();
				$result = $clase->colsultarestosparametros($id_organizacionPrincipal , $codigo_sucursal , $codigo_encargado);				
					
					$row = pg_fetch_assoc($result);

				return $row;
			}
			
			function buscarDepartamentosRegistradosOrganizacionAsociada ($codigo_sucursal)
			{
				$clase = new Postulacion();
				$result = $clase->DepartamentosRegistrados( $codigo_sucursal );				
					$data = array() ;
					while ( $row = pg_fetch_assoc($result)) 
					{
						$row['nombre_oficina'] = 
						$this->Procesar_Palabras_EspaciosPre( $row['nombre_oficina'] ,$row['maxlength'] );
						$row['personas'] = $clase->ContarPersonalPoroficina( $codigo_sucursal , $row['id_oficina']);	
						$data[] = $row ;
					}

				return $data;
			}
		
		

	}
?>