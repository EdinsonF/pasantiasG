<<<<<<< HEAD
﻿<?php
include("../../../BASE_DATOS/Conect.php");
 
$obj=new Conexion();
$obj->Conectar();

class reportes{



function GenerarReporte_Tipo_Solicitud($id_institutoP,$nombre_i,$tipo_solicitud){	//consultar estudiantes registrados por municipio	

			
 			$fecha = date("l, d-m-Y");

			$html="";
			$strsql="SELECT persona.cedula, persona.nombre, persona.id_persona, usuario.id_usuario, usuario.usuario, usuario.contrasena, persona.apellido, estudiante.expediente, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
 especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
 especialidad_instituto_principal.observacion , persona_instituto_especialidad.estado FROM pasantias.persona 
 JOIN pasantias.estudiante ON estudiante.id_persona=persona.id_persona 
 JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona = persona.id_persona and
  persona_instituto_especialidad.estado='$tipo_solicitud' and persona_instituto_especialidad.id_perfil='3' 
 JOIN pasantias.especialidad ON persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad
 JOIN pasantias.instituto_principal ON instituto_principal.id_ip= persona_instituto_especialidad.id_ip
 JOIN pasantias.tipo_especialidad ON especialidad.id_tipo_especialidad = tipo_especialidad.id_tipo_especialidad
 JOIN pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_ip = instituto_principal.id_ip and instituto_principal.id_ip='$id_institutoP'
AND especialidad_instituto_principal.id_especialidad = persona_instituto_especialidad.id_especialidad AND  especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip   
JOIN pasantias.usuario ON persona.id_persona=usuario.id_persona";	 
				    
			$rs=pg_query($strsql);
			$rss=pg_query($strsql);
			$num=0;
			$num=pg_num_rows($rs);
		
			$ss=pg_fetch_array($rss);
			$estado=$ss['estado'];
			$html=$html.'
			<font color="#0B3861" align="center"><h2>Reporte De Solicitudes de Estudiantes: &nbsp; <i>'.$estado.'</i></h2></font>
			<font color="#0B3861" align="left"><h3>&nbsp; &nbsp; Total de registros: &nbsp; <i>'.$num.'</i></h3> 
											   <h3>&nbsp; &nbsp; Institución: &nbsp; <i>'.$nombre_i.'</i></h3>
											   <h3>&nbsp; &nbsp; Fecha: &nbsp; <i>'.$fecha.'</i></h3></font>  
			
			
			';
			

				$html=$html.'<div align="center">			
			<table border="0" cellpadding="10" cellspacing="0"  >';	
			$html=$html.'<tr bgcolor="#0B3861">
			<td><font color="#FFFFFF" size="10"><b> Cédula </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Nombre y Apellido </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Tipo Especialidad </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Nombre Especialidad </b></font></td>
			</tr>';

				$i=0;
				
				while ($row = pg_fetch_array($rs)){

				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["cedula"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre"];
				$html = $html. ' ';
				$html = $html. $row["apellido"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_tipo_especialidad"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_especialidad"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}




function GenerarReporte_Tipo_Empresa($id_institutoP,$nombre_i,$tipo_empresa){	//consultar estudiantes registrados por municipio	

			
 			$fecha = date("l, d-m-Y");

			$html="";
			$strsql="SELECT solicitudes_enviadas.codigo_solicitud, solicitudes_aprobadas.valor, estudiante.id_persona, estudiante.id_especialidad, 
 persona.cedula, persona.nombre, persona.apellido, tipo_especialidad.nombre_tipo_especialidad, especialidad.nombre_especialidad, organizacion.siglas, nombre_tipo_organizacion
 FROM pasantias.solicitudes_enviadas
 INNER JOIN pasantias.solicitudes_aprobadas ON solicitudes_aprobadas.codigo_solicitud=solicitudes_enviadas.codigo_solicitud and solicitudes_aprobadas.table_column='estudiante.codigo_estudiante'
 INNER JOIN pasantias.organizacionmunicipio ON organizacionmunicipio.codigo_sucursal=solicitudes_enviadas.valor and solicitudes_enviadas.table_column='organizacionmunicipio.codigo_sucursal'
 INNER JOIN pasantias.organizacion ON organizacion.id_organizacion=organizacionmunicipio.id_organizacion 
 INNER JOIN pasantias.tipo_organizacion ON tipo_organizacion.id_tipo_organizacion=organizacion.id_tipo_organizacion and tipo_organizacion.id_tipo_organizacion='$tipo_empresa'
 INNER JOIN pasantias.estudiante ON estudiante.codigo_estudiante=solicitudes_aprobadas.valor
 INNER JOIN pasantias.persona ON persona.id_persona=estudiante.id_persona
 INNER JOIN pasantias.especialidad ON especialidad.id_especialidad=estudiante.id_especialidad
 INNER JOIN pasantias.tipo_especialidad ON tipo_especialidad.id_tipo_especialidad=especialidad.id_tipo_especialidad";	 
				    
			$rs=pg_query($strsql);
			$rss=pg_query($strsql);
			$num=0;
			$num=pg_num_rows($rs);
		
			$ss=pg_fetch_array($rss);
			$nombre_tipo_organizacion=$ss['nombre_tipo_organizacion'];
			$html=$html.'
			<font color="#0B3861" align="center"><h2>Reporte de Estudiantes Por Organizaciones: &nbsp; <i>'.$nombre_tipo_organizacion.'</i></h2></font>
			<font color="#0B3861" align="left"><h3>&nbsp; &nbsp; Total de registros: &nbsp; <i>'.$num.'</i></h3> 
											   <h3>&nbsp; &nbsp; Institución: &nbsp; <i>'.$nombre_i.'</i></h3>
											   <h3>&nbsp; &nbsp; Fecha: &nbsp; <i>'.$fecha.'</i></h3></font>  
			
			
			';
			

				$html=$html.'<div align="center">			
			<table border="0" cellpadding="10" cellspacing="0"  >';	
			$html=$html.'<tr bgcolor="#0B3861">
			<td><font color="#FFFFFF" size="10"><b> Cédula </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Nombre y Apellido </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Tipo Especialidad </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Nombre Especialidad </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Organización </b></font></td>
			</tr>';

				$i=0;
				
				while ($row = pg_fetch_array($rs)){

				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["cedula"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre"];
				$html = $html. ' ';
				$html = $html. $row["apellido"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_tipo_especialidad"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_especialidad"];
				$html = $html.'</td><td>';
				$html = $html. $row["siglas"];
				$html = $html.'</td></tr>';	
				$i++;
			}	

			$html=$html.'</table></div>';			
     		 return ($html);
		}

}
=======
﻿<?php
include("../../../BASE_DATOS/Conect.php");
 
$obj=new Conexion();
$obj->Conectar();

class reportes{



function GenerarReporte_Tipo_Solicitud($id_institutoP,$nombre_i,$tipo_solicitud){	//consultar estudiantes registrados por municipio	

			
 			$fecha = date("l, d-m-Y");

			$html="";
			$strsql="SELECT persona.cedula, persona.nombre, persona.id_persona, usuario.id_usuario, usuario.usuario, usuario.contrasena, persona.apellido, estudiante.expediente, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
 especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
 especialidad_instituto_principal.observacion , persona_instituto_especialidad.estado FROM pasantias.persona 
 JOIN pasantias.estudiante ON estudiante.id_persona=persona.id_persona 
 JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona = persona.id_persona and
  persona_instituto_especialidad.estado='$tipo_solicitud' and persona_instituto_especialidad.id_perfil='3' 
 JOIN pasantias.especialidad ON persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad
 JOIN pasantias.instituto_principal ON instituto_principal.id_ip= persona_instituto_especialidad.id_ip
 JOIN pasantias.tipo_especialidad ON especialidad.id_tipo_especialidad = tipo_especialidad.id_tipo_especialidad
 JOIN pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_ip = instituto_principal.id_ip and instituto_principal.id_ip='$id_institutoP'
AND especialidad_instituto_principal.id_especialidad = persona_instituto_especialidad.id_especialidad AND  especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip   
JOIN pasantias.usuario ON persona.id_persona=usuario.id_persona";	 
				    
			$rs=pg_query($strsql);
			$rss=pg_query($strsql);
			$num=0;
			$num=pg_num_rows($rs);
		
			$ss=pg_fetch_array($rss);
			$estado=$ss['estado'];
			$html=$html.'
			<font color="#0B3861" align="center"><h2>Reporte De Solicitudes de Estudiantes: &nbsp; <i>'.$estado.'</i></h2></font>
			<font color="#0B3861" align="left"><h3>&nbsp; &nbsp; Total de registros: &nbsp; <i>'.$num.'</i></h3> 
											   <h3>&nbsp; &nbsp; Institución: &nbsp; <i>'.$nombre_i.'</i></h3>
											   <h3>&nbsp; &nbsp; Fecha: &nbsp; <i>'.$fecha.'</i></h3></font>  
			
			
			';
			

				$html=$html.'<div align="center">			
			<table border="0" cellpadding="10" cellspacing="0"  >';	
			$html=$html.'<tr bgcolor="#0B3861">
			<td><font color="#FFFFFF" size="10"><b> Cédula </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Nombre y Apellido </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Tipo Especialidad </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Nombre Especialidad </b></font></td>
			</tr>';

				$i=0;
				
				while ($row = pg_fetch_array($rs)){

				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["cedula"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre"];
				$html = $html. ' ';
				$html = $html. $row["apellido"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_tipo_especialidad"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_especialidad"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}




function GenerarReporte_Tipo_Empresa($id_institutoP,$nombre_i,$tipo_empresa){	//consultar estudiantes registrados por municipio	

			
 			$fecha = date("l, d-m-Y");

			$html="";
			$strsql="SELECT solicitudes_enviadas.codigo_solicitud, solicitudes_aprobadas.valor, estudiante.id_persona, estudiante.id_especialidad, 
 persona.cedula, persona.nombre, persona.apellido, tipo_especialidad.nombre_tipo_especialidad, especialidad.nombre_especialidad, organizacion.siglas, nombre_tipo_organizacion
 FROM pasantias.solicitudes_enviadas
 INNER JOIN pasantias.solicitudes_aprobadas ON solicitudes_aprobadas.codigo_solicitud=solicitudes_enviadas.codigo_solicitud and solicitudes_aprobadas.table_column='estudiante.codigo_estudiante'
 INNER JOIN pasantias.organizacionmunicipio ON organizacionmunicipio.codigo_sucursal=solicitudes_enviadas.valor and solicitudes_enviadas.table_column='organizacionmunicipio.codigo_sucursal'
 INNER JOIN pasantias.organizacion ON organizacion.id_organizacion=organizacionmunicipio.id_organizacion 
 INNER JOIN pasantias.tipo_organizacion ON tipo_organizacion.id_tipo_organizacion=organizacion.id_tipo_organizacion and tipo_organizacion.id_tipo_organizacion='$tipo_empresa'
 INNER JOIN pasantias.estudiante ON estudiante.codigo_estudiante=solicitudes_aprobadas.valor
 INNER JOIN pasantias.persona ON persona.id_persona=estudiante.id_persona
 INNER JOIN pasantias.especialidad ON especialidad.id_especialidad=estudiante.id_especialidad
 INNER JOIN pasantias.tipo_especialidad ON tipo_especialidad.id_tipo_especialidad=especialidad.id_tipo_especialidad";	 
				    
			$rs=pg_query($strsql);
			$rss=pg_query($strsql);
			$num=0;
			$num=pg_num_rows($rs);
		
			$ss=pg_fetch_array($rss);
			$nombre_tipo_organizacion=$ss['nombre_tipo_organizacion'];
			$html=$html.'
			<font color="#0B3861" align="center"><h2>Reporte de Estudiantes Por Organizaciones: &nbsp; <i>'.$nombre_tipo_organizacion.'</i></h2></font>
			<font color="#0B3861" align="left"><h3>&nbsp; &nbsp; Total de registros: &nbsp; <i>'.$num.'</i></h3> 
											   <h3>&nbsp; &nbsp; Institución: &nbsp; <i>'.$nombre_i.'</i></h3>
											   <h3>&nbsp; &nbsp; Fecha: &nbsp; <i>'.$fecha.'</i></h3></font>  
			
			
			';
			

				$html=$html.'<div align="center">			
			<table border="0" cellpadding="10" cellspacing="0"  >';	
			$html=$html.'<tr bgcolor="#0B3861">
			<td><font color="#FFFFFF" size="10"><b> Cédula </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Nombre y Apellido </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Tipo Especialidad </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Nombre Especialidad </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Organización </b></font></td>
			</tr>';

				$i=0;
				
				while ($row = pg_fetch_array($rs)){

				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["cedula"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre"];
				$html = $html. ' ';
				$html = $html. $row["apellido"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_tipo_especialidad"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_especialidad"];
				$html = $html.'</td><td>';
				$html = $html. $row["siglas"];
				$html = $html.'</td></tr>';	
				$i++;
			}	

			$html=$html.'</table></div>';			
     		 return ($html);
		}

}
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
?>