<?php
//require_once("../../../../BASE_DATOS/Conect.php");

$obj=new Conexion();
$obj->Conectar();

class reportes{



/////////////////////////////////////---------- O F I C I N A--------------------------->>>>>>>>>>>>>>>>> 		



		function GenerarReporte_Postulados($codigo_sucursal){	//consultar estudiantes registrados por municipio	

			$fecha = date("d-m-Y");
			
			$html="";
			$html=$html.'<font color="#0B3861" align="center"><h1>Estudiantes Postulados</h1></font>';
			$html=$html.'<h3>&nbsp; &nbsp; Fecha: &nbsp; <i>'.$fecha.'</i></h3></font>';
			
			$consulta1=pg_query("SELECT estudiante.codigo_estudiante,persona.cedula, persona.nombre ||' '|| persona.apellido as estudiante, 
							 	especialidad.nombre_especialidad ||' - '|| tipo_especialidad.nombre_tipo_especialidad AS especialidad,solicitudes_recibidas.fecha_postulacion ,organizacion.siglas as nombre_organizacion,solicitudes_recibidas.codigo_solicitud
							 FROM pasantias.estudiante 
							 INNER JOIN pasantias.persona_instituto_especialidad 
							 ON persona_instituto_especialidad.id_persona = estudiante.id_persona
							 AND  persona_instituto_especialidad.id_ip = estudiante.id_ip AND  persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
							 AND  persona_instituto_especialidad.id_perfil = estudiante.id_perfil 
							 INNER JOIN pasantias.persona 
							 ON   persona.id_persona = persona_instituto_especialidad.id_persona 
							 INNER JOIN pasantias.especialidad
							 ON   persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad
							 INNER JOIN pasantias.tipo_especialidad
							 ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad 
							 INNER JOIN pasantias.instituto_principal
							 ON   instituto_principal.id_ip = persona_instituto_especialidad.id_ip 
							 INNER JOIN pasantias.organizacion 
							 ON   organizacion.id_organizacion = instituto_principal.id_organizacion 
							 INNER JOIN pasantias.solicitudes_enviadas
							 ON   solicitudes_enviadas.valor = estudiante.codigo_estudiante 
							 JOIN pasantias.solicitud 
							 ON   solicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud 
							 INNER JOIN pasantias.solicitudes_recibidas
							 ON   solicitudes_recibidas.codigo_solicitud = solicitud.codigo_solicitud		  
							  WHERE solicitudes_recibidas.valor ='$codigo_sucursal' AND solicitudes_recibidas.estatus='EN ESPERA'");
			
			$num=pg_num_rows($consulta1);		

			if($num>0){

			
				$html=$html.'<div align="center">			
				<table border="0" cellpadding="10" cellspacing="2"  >';	
				$html=$html.'<tr bgcolor="#1F486E">
	                                <td><font color="#FFFFFF" size="11"><b>Nombre</b></font></td>
	                                <td><font color="#FFFFFF" size="11"><b>Cédula</b></font></td>
	                                <td><font color="#FFFFFF" size="11"><b>Especialidad</b></font></td>
	                                <td><font color="#FFFFFF" size="11"><b>Fecha Postulación</b></font></td> 
	                                <td><font color="#FFFFFF" size="11"><b>Organización</b></font></td>  
	                            </tr>';

				$i=0;
				
				while ($row = pg_fetch_array($consulta1)){

				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["estudiante"];
				$html = $html.'</td><td>';
				$html = $html. $row["cedula"];
				$html = $html.'</td><td>';
				$html = $html. $row["especialidad"];
				$html = $html.'</td><td>';
				$html = $html. $row["fecha_postulacion"];
			    $html = $html.'</td><td>';
				$html = $html. $row["nombre_organizacion"];
			    $html = $html.'</td></tr>';	

	
				$i++;
			}			
			$html=$html.'</table></div>';
		}else{
			$html=$html.'<font color="#000000" align="center"><br><br><br><h1>No Se Encontraron Registros...</h1></font>';
		}
			
				
     		 return ($html);
		
		}



		function Generar_PostuladosAceptados($codigo_sucursal){	//consultar estudiantes registrados por municipio	

			$fecha = date("d-m-Y");
			
			$html="";
			$html=$html.'<font color="#0B3861" align="center"><h1> Postualciones Aceptadas</h1></font>';
			$html=$html.'<h3>&nbsp; &nbsp; Fecha: &nbsp; <i>'.$fecha.'</i></h3></font>';
			
			$consulta1=pg_query("SELECT solicitud.codigo_solicitud, estudiante.codigo_estudiante , persona.nombre ||' '|| persona.apellido as estudiante, persona.cedula, 
							 	especialidad.nombre_especialidad ||' - '|| tipo_especialidad.nombre_tipo_especialidad AS especialidad ,solicitudes_recibidas.fecha_postulacion, organizacion.siglas as nombre_organizacion, 'ESTUDIANTE' AS solicitud_realizada
							 FROM pasantias.estudiante 
							 INNER JOIN pasantias.persona_instituto_especialidad 
							 ON persona_instituto_especialidad.id_persona = estudiante.id_persona
							 AND  persona_instituto_especialidad.id_ip = estudiante.id_ip AND  persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
							 AND  persona_instituto_especialidad.id_perfil = estudiante.id_perfil 
							 INNER JOIN pasantias.persona 
							 ON   persona.id_persona = persona_instituto_especialidad.id_persona 
							 INNER JOIN pasantias.especialidad
							 ON   persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad 
							 INNER JOIN pasantias.tipo_especialidad
							 ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad
							 INNER JOIN pasantias.instituto_principal
							 ON   instituto_principal.id_ip = persona_instituto_especialidad.id_ip 
							 INNER JOIN pasantias.organizacion 
							 ON   organizacion.id_organizacion = instituto_principal.id_organizacion 
							 INNER JOIN pasantias.solicitudes_enviadas
							 ON   solicitudes_enviadas.valor = estudiante.codigo_estudiante JOIN pasantias.solicitud 
							 ON   solicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud 
							 INNER JOIN pasantias.solicitudes_recibidas
							 ON   solicitudes_recibidas.codigo_solicitud = solicitud.codigo_solicitud		  
							  WHERE solicitudes_recibidas.valor ='$codigo_sucursal' AND solicitudes_recibidas.estatus='APROBADO ORGANIZACION'");
			
			$num=pg_num_rows($consulta1);


			$consulta2=pg_query("SELECT alla.* , persona.nombre ||' '|| persona.apellido ||' - (ENCARGADO)' AS solicitud_realizada FROM (

							SELECT pss.nombre_organizacion, solicitudes_recibidas.fecha_postulacion ,especialidad.nombre_especialidad ||' - '|| tipo_especialidad.nombre_tipo_especialidad AS especialidad,
							estudiante.codigo_estudiante ,persona.nombre ||' '|| persona.apellido  as estudiante, persona.cedula 
							,pss.codigo_solicitud , sucursal
							FROM (SELECT solicitud.cantidad_postulantes ,solicitud.fecha_solicitud ,temporadas_solicitud.codigo_temporada , 
							organizacion.siglas as nombre_organizacion ,solicitud.codigo_solicitud ,
							solicitudes_enviadas.valor as sucursal
							FROM pasantias.solicitud 
							INNER JOIN pasantias.solicitudes_enviadas 
							ON solicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud 
							INNER JOIN pasantias.temporadas_especialidad 
							ON temporadas_especialidad.codigo_temporada_especialidad = solicitud.codigo_temporada_especialidad
							INNER JOIN pasantias.temporadas_solicitud 
							ON temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada 
							INNER JOIN pasantias.encargado
							ON encargado.codigo_encargado= temporadas_solicitud.codigo_encargado 
							INNER JOIN pasantias.persona_organizacion_oficina
							ON persona_organizacion_oficina.id_persona = encargado.id_persona
							AND persona_organizacion_oficina.id_oficina = encargado.id_oficina
							AND persona_organizacion_oficina.codigo_sucursal = encargado.codigo_sucursal 
							INNER JOIN pasantias.organizacionmunicipio
							ON  organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal 
							INNER JOIN pasantias.organizacion
							ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion 
							INNER JOIN pasantias.instituto_principal
							ON instituto_principal.id_organizacion = organizacion.id_organizacion 
							AND solicitudes_enviadas.valor ='$codigo_sucursal'
							AND solicitudes_enviadas.table_column='organizacionmunicipio.codigo_sucursal'
							) as pss  INNER JOIN pasantias.solicitudes_recibidas
							ON pss.codigo_solicitud = solicitudes_recibidas.codigo_solicitud 
							INNER JOIN pasantias.estudiante 
							ON  estudiante.codigo_estudiante=solicitudes_recibidas.valor 
							INNER JOIN pasantias.persona_instituto_especialidad
							ON  estudiante.id_persona = persona_instituto_especialidad.id_persona
							AND estudiante.id_especialidad = persona_instituto_especialidad.id_especialidad
							AND estudiante.id_perfil = persona_instituto_especialidad.id_perfil 
							AND estudiante.id_ip = persona_instituto_especialidad.id_ip AND solicitudes_recibidas.estatus='APROBADO ORGANIZACION'
							INNER JOIN pasantias.persona 
							ON persona.id_persona = persona_instituto_especialidad.id_persona 
							INNER JOIN pasantias.temporadas_estudiantes
							ON temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante
							INNER JOIN pasantias.especialidad
							ON especialidad.id_especialidad = persona_instituto_especialidad.id_especialidad 
										INNER JOIN pasantias.tipo_especialidad
							ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad) as alla

							INNER JOIN pasantias.solicitudes_enviadas 
								ON alla.codigo_solicitud =solicitudes_enviadas.codigo_solicitud
								AND solicitudes_enviadas.table_column='persona.id_persona'
								INNER JOIN pasantias.organizacionmunicipio 
								ON organizacionmunicipio.codigo_sucursal = alla.sucursal
								INNER JOIN pasantias.organizacion 
								ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
								INNER JOIN pasantias.persona_organizacion_oficina 
								ON persona_organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
								INNER JOIN pasantias.persona 
								ON persona.id_persona = persona_organizacion_oficina.id_persona 
								AND persona.id_persona = CAST (solicitudes_enviadas.valor as BIGINT)");
			
			$num2=pg_num_rows($consulta2);
			$datos = array();
			while($reg=pg_fetch_assoc($consulta1)){

				$datos[]=$reg;
			}

			while($reg2=pg_fetch_assoc($consulta2)){

				$datos[]=$reg2;
			}		

			//var_dump($datos);
			

			
				$html=$html.'<div align="center">			
				<table border="0" cellpadding="10" cellspacing="2"  >';	
				$html=$html.'<tr bgcolor="#1F486E">
	                                <td><font color="#FFFFFF" size="11"><b>Nombre</b></font></td>
	                                <td><font color="#FFFFFF" size="11"><b>Cédula</b></font></td>
	                                <td><font color="#FFFFFF" size="11"><b>Especialidad</b></font></td>
	                                <td><font color="#FFFFFF" size="11"><b>Fecha Postulación</b></font></td> 
	                                <td><font color="#FFFFFF" size="11"><b>Solicitud Realida Por</b></font></td> 
	                                <td><font color="#FFFFFF" size="11"><b>Organización</b></font></td> 
	                            </tr>';

				$i=0;

				
				
				 for($h=0; $h<count($datos); $h++){

				 $estudiante 		 =$datos[$h]['estudiante'];
				 $cedula			 =$datos[$h]['cedula'];
				 $especialidad 		 =$datos[$h]['especialidad'];
				 $fecha_postulacion  =$datos[$h]['fecha_postulacion'];
				 $nombre_organizacion=$datos[$h]['nombre_organizacion'];
				 $solicitud_realizada=$datos[$h]['solicitud_realizada'];
				 	
				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $estudiante;
				$html = $html.'</td><td>';
				$html = $html. $cedula;
				$html = $html.'</td><td>';
				$html = $html. $especialidad;
				$html = $html.'</td><td>';
				$html = $html. $fecha_postulacion;
			    $html = $html.'</td><td>';
				$html = $html. $solicitud_realizada;
			    $html = $html.'</td><td>';
				$html = $html. $nombre_organizacion;
			    $html = $html.'</td></tr>';	

				
				$i++;
			}			
			$html=$html.'</table></div>';
		
			
				
     		 return ($html);
		
		}


}
?>