<?php
//require_once("../../../../BASE_DATOS/Conect.php");



$obj=new Conexion();
$obj->Conectar();

class reportes{

/////////////////////////////////////---------- E S P E C I L I D A D-------->>>>>>>> 
		function GenerarReporteEspecialidad($id_institutoP,$nombre_i){	//consultar estudiantes registrados por municipio	

			
 			$fecha = date("l, d-m-Y");

			$html="";
			$strsql="SELECT especialidad.id_especialidad, especialidad.nombre_especialidad, especialidad.id_tipo_especialidad,nombre_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, especialidad_instituto_principal.observacion FROM pasantias.especialidad  
				       JOIN  pasantias.departamento ON  especialidad.id_departamento = departamento.id_departamento
		               JOIN  pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_especialidad = especialidad.id_especialidad
		               JOIN  pasantias.instituto_principal ON instituto_principal.id_ip =especialidad_instituto_principal.id_ip 
		               JOIN  pasantias.organizacion ON organizacion.id_organizacion = instituto_principal.id_organizacion
		               JOIN  pasantias.tipo_especialidad ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad
				              WHERE especialidad_instituto_principal.id_ip=$id_institutoP AND especialidad_instituto_principal.estatus!='MODIFICADO' ";	 
				    
			$rs=pg_query($strsql);
			$num=0;
			$num=pg_num_rows($rs);
		

			$html=$html.'
			<font color="#0B3861" align="center"><h2>Reporte De Especialidades</h2></font>
			<font color="#0B3861" align="left"><h3>&nbsp; &nbsp; Total de registros: &nbsp; <i>'.$num.'</i></h3> 
											   <h3>&nbsp; &nbsp; Institución: &nbsp; <i>'.$nombre_i.'</i></h3>
											   <h3>&nbsp; &nbsp; Fecha: &nbsp; <i>'.$fecha.'</i></h3></font>  
			
			
			';
			

				$html=$html.'<div align="center">			
			<table border="0" cellpadding="11" cellspacing="0"  >';	
			$html=$html.'<tr bgcolor="#0B3861">
			<td><font color="#FFFFFF" size="11"><b> Nombre Especialidad </b></font></td>
			<td><font color="#FFFFFF" size="11"><b> Tipo Especialidad </b></font></td>
			<td><font color="#FFFFFF" size="11"><b> Descripción </b></font></td>
			<td><font color="#FFFFFF" size="11"><b> Estado </b></font></td>
			</tr>';

				$i=0;
				
				while ($row = pg_fetch_array($rs)){

				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["nombre_especialidad"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_tipo_especialidad"];
				$html = $html.'</td><td>';
				$html = $html. $row["descripcion"];
				$html = $html.'</td><td>';
				$html = $html. $row["estatus"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}





function GenerarReporteEspecialidad_Tipo($id_institutoP,$nombre_i,$id_tipoE){	//consultar estudiantes registrados por municipio	

			
 			$fecha = date("l, d-m-Y");

			$html="";
			$strsql="SELECT especialidad.id_especialidad, especialidad.nombre_especialidad, especialidad.id_tipo_especialidad,nombre_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, especialidad_instituto_principal.observacion FROM pasantias.especialidad  
				       JOIN  pasantias.departamento ON  especialidad.id_departamento = departamento.id_departamento
		               JOIN  pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_especialidad = especialidad.id_especialidad
		               JOIN  pasantias.instituto_principal ON instituto_principal.id_ip =especialidad_instituto_principal.id_ip 
		               JOIN  pasantias.organizacion ON organizacion.id_organizacion = instituto_principal.id_organizacion
		               JOIN  pasantias.tipo_especialidad ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad 
				              WHERE especialidad_instituto_principal.id_ip=$id_institutoP AND especialidad_instituto_principal.estatus!='MODIFICADO' AND especialidad.id_tipo_especialidad=$id_tipoE  ";	 
				    
			$rs=pg_query($strsql);
			$rss=pg_query($strsql);
			$num=0;
			$num=pg_num_rows($rs);
		
			$ss=pg_fetch_array($rss);
			$clasificacion=$ss['nombre_tipo_especialidad'];
			$html=$html.'
			<font color="#0B3861" align="center"><h2>Reporte De Especialidades Por Tipo: &nbsp; <i>'.$clasificacion.'</i></h2></font>
			<font color="#0B3861" align="left"><h3>&nbsp; &nbsp; Total de registros: &nbsp; <i>'.$num.'</i></h3> 
											   <h3>&nbsp; &nbsp; Institución: &nbsp; <i>'.$nombre_i.'</i></h3>
											   <h3>&nbsp; &nbsp; Fecha: &nbsp; <i>'.$fecha.'</i></h3></font>  
			
			
			';
			

				$html=$html.'<div align="center">			
			<table border="0" cellpadding="10" cellspacing="0"  >';	
			$html=$html.'<tr bgcolor="#0B3861">
			<td><font color="#FFFFFF" size="10"><b> Nombre Especialidad </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Tipo Especialidad </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Descripción </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Estado </b></font></td>
			</tr>';

				$i=0;
				
				while ($row = pg_fetch_array($rs)){

				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["nombre_especialidad"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_tipo_especialidad"];
				$html = $html.'</td><td>';
				$html = $html. $row["descripcion"];
				$html = $html.'</td><td>';
				$html = $html. $row["estatus"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}





function GenerarReporte_HistorialEspecialidades($id_institutoP,$nombre_i){	//consultar estudiantes registrados por municipio	

			
 			$fecha = date("l, d-m-Y");

			$html="";
			$strsql="SELECT especialidad.id_especialidad, especialidad.nombre_especialidad, especialidad.id_tipo_especialidad,nombre_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, especialidad_instituto_principal.observacion FROM pasantias.especialidad  
				       JOIN  pasantias.departamento ON  especialidad.id_departamento = departamento.id_departamento
		               JOIN  pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_especialidad = especialidad.id_especialidad
		               JOIN  pasantias.instituto_principal ON instituto_principal.id_ip =especialidad_instituto_principal.id_ip 
		               JOIN  pasantias.organizacion ON organizacion.id_organizacion = instituto_principal.id_organizacion
		               JOIN  pasantias.tipo_especialidad ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad 
				              WHERE especialidad_instituto_principal.id_ip=$id_institutoP ";	 
				    
			$rs=pg_query($strsql);
			
			$num=0;
			$num=pg_num_rows($rs);
		
			$html=$html.'
			<font color="#0B3861" align="center"><h2>Historial de Especialidades Registradas y Modificadas</h2></font>
			<font color="#0B3861" align="left"><h3>&nbsp; &nbsp; Total de registros: &nbsp; <i>'.$num.'</i></h3> 
											   <h3>&nbsp; &nbsp; Institución: &nbsp; <i>'.$nombre_i.'</i></h3>
											   <h3>&nbsp; &nbsp; Fecha: &nbsp; <i>'.$fecha.'</i></h3></font>  
			
			
			';
			

				$html=$html.'<div align="center">			
			<table border="0" cellpadding="10" cellspacing="0"  >';	
			$html=$html.'<tr bgcolor="#0B3861">
			<td><font color="#FFFFFF" size="10"><b> Nombre Especialidad </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Tipo Especialidad </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Descripción </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Estado </b></font></td>
			</tr>';

				$i=0;
				
				while ($row = pg_fetch_array($rs)){

				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["nombre_especialidad"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_tipo_especialidad"];
				$html = $html.'</td><td>';
				$html = $html. $row["descripcion"];
				$html = $html.'</td><td>';
				$html = $html. $row["estatus"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}


		function GenerarReporte_PersonasAsignadas_MisEspecialidades($id_institutoP, $nombre_organizacion){	//consultar estudiantes registrados por municipio	

			$fecha = date("l, d-m-Y");

			
			$html="";
			$html=$html.'<font color="#0B3861" align="center"><h1>Personas Asignadas A Especialidades</h1></font>';
		    $html=$html.'<h3>&nbsp; &nbsp; Fecha: &nbsp; <i>'.$fecha.'</i></h3></font>';


			$consulta="SELECT especialidad.id_especialidad, especialidad.nombre_especialidad, especialidad.id_tipo_especialidad,nombre_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, especialidad_instituto_principal.observacion FROM pasantias.especialidad  
				JOIN  pasantias.departamento ON  especialidad.id_departamento = departamento.id_departamento
				JOIN  pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_especialidad = especialidad.id_especialidad
				JOIN  pasantias.instituto_principal ON instituto_principal.id_ip =especialidad_instituto_principal.id_ip 
				JOIN  pasantias.organizacion ON organizacion.id_organizacion = instituto_principal.id_organizacion
				JOIN  pasantias.tipo_especialidad ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad 
				WHERE especialidad_instituto_principal.id_ip=$id_institutoP ";

		   $resultado=pg_query($consulta);
		   $num=pg_num_rows($resultado);

		   

		   while($registro=pg_fetch_array($resultado)){

		   	$nombre_especialidad=$registro['nombre_especialidad'];
		   	$nombre_tipo_especialidad=$registro['nombre_tipo_especialidad'];
		   	$descripcion=$registro['descripcion'];
		   	$estado=$registro['estatus'];


			
			$strsql="SELECT cedula, persona.nombre , persona.apellido ,perfil.id_perfil, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
					 especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
					 especialidad_instituto_principal.observacion FROM pasantias.persona
					 
					 JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona = persona.id_persona
					 JOIN pasantias.especialidad ON persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad AND especialidad.nombre_especialidad='$nombre_especialidad'
					 JOIN pasantias.instituto_principal ON instituto_principal.id_ip= persona_instituto_especialidad.id_ip
					 JOIN pasantias.tipo_especialidad ON especialidad.id_tipo_especialidad = tipo_especialidad.id_tipo_especialidad AND tipo_especialidad.nombre_tipo_especialidad='$nombre_tipo_especialidad'
					 JOIN pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_ip = instituto_principal.id_ip
					  and instituto_principal.id_ip=$id_institutoP 
					AND especialidad_instituto_principal.id_especialidad = persona_instituto_especialidad.id_especialidad 
					AND  especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip 
					iNNER JOIN pasantias.perfil ON perfil.id_perfil = persona_instituto_especialidad.id_perfil";	 
							    
			$rs=pg_query($strsql);
			$num2=0;
			$num2=pg_num_rows($rs);
		

				if($num2>0){

					$html=$html.'<div align="center">			
								<table border="0" cellpadding="11" cellspacing="2"  >';	
					$html=$html.'<tr bgcolor="#0B3861">
									<td colspan="4"><font color="#FFFFFF" size="14"><b>Personas en: '.$nombre_tipo_especialidad.'-'.$nombre_especialidad.'</b></font></td></tr>
		                            <tr bgcolor="#1F486E">
		                                <td><font color="#FFFFFF" size="11"><b>Cédula</b></font></td>
		                                <td><font color="#FFFFFF" size="11"><b>Nombre</b></font></td>
		                                <td><font color="#FFFFFF" size="11"><b>Apellido</b></font></td>
		                                <td><font color="#FFFFFF" size="11"><b>Perfil</b></font></td>  
		                            </tr>';

				
				$i=0;
				
				while ($row = pg_fetch_array($rs)){

					if($row["id_perfil"]==3){
						$perfil="ESTUDIANTE";
					}else if($row["id_perfil"]==4){
						$perfil="TUTOR ACADÉMICO";
					}else{
						$perfil="INDEFINIDO";	
					}
				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}

				$html = $html.'<td >';
				$html = $html. $row["cedula"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre"];
				$html = $html.'</td><td>';
				$html = $html. $row["apellido"];
				$html = $html.'</td><td>';
				$html = $html. $perfil;
			    $html = $html.'</td></tr>';	
	
					
				$i++;
			}
			$html=$html.'</table></div>';
		}else{}
		}			
						
     		 return ($html);
		}




//-----TRABAJANDO------>>>

		function GenerarReporte_PersonasAsignadas_MisEspecialidades_PorFecha($id_institutoP, $fecha_ii, $fecha_ff){	//consultar estudiantes registrados por municipio	

			$fecha = date("d-m-Y");
			//EXPLODE
			$fecha1=$fecha_ii; 
			$var = explode('-',$fecha1); 
			$fecha_i="$var[2]-$var[1]-$var[0]";

			$fecha2=$fecha_ff; 
			$var2 = explode('-',$fecha2); 
			$fecha_f="$var2[2]-$var2[1]-$var2[0]"; 
			
			$html="";
			$html=$html.'<font color="#0B3861" align="center"><h1>Personas Asignadas A Especialidades</h1><br><h3>Desde // Hasta <br>'.$fecha_i.' // '.$fecha_f.'</h3></font>';
		    $html=$html.'<h3>&nbsp; &nbsp; Emitido: &nbsp; <i>'.$fecha.'</i></h3></font>';


			$consulta="SELECT especialidad.id_especialidad, especialidad.nombre_especialidad, especialidad.id_tipo_especialidad,nombre_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, especialidad_instituto_principal.observacion FROM pasantias.especialidad  
				JOIN  pasantias.departamento ON  especialidad.id_departamento = departamento.id_departamento
				JOIN  pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_especialidad = especialidad.id_especialidad
				JOIN  pasantias.instituto_principal ON instituto_principal.id_ip =especialidad_instituto_principal.id_ip 
				JOIN  pasantias.organizacion ON organizacion.id_organizacion = instituto_principal.id_organizacion
				JOIN  pasantias.tipo_especialidad ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad 
				WHERE especialidad_instituto_principal.id_ip=$id_institutoP ";

		   $resultado=pg_query($consulta);
		   $num=pg_num_rows($resultado);

		   while($registro=pg_fetch_array($resultado)){

		   	$nombre_especialidad=$registro['nombre_especialidad'];
		   	$nombre_tipo_especialidad=$registro['nombre_tipo_especialidad'];
		   	$descripcion=$registro['descripcion'];
		   	$estado=$registro['estatus'];


			
			$strsql="SELECT fecha_aceptacion, cedula, persona.nombre , persona.apellido ,perfil.id_perfil, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
					 especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
					 especialidad_instituto_principal.observacion FROM pasantias.persona
					 
					 JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona = persona.id_persona
					 JOIN pasantias.especialidad ON persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad AND especialidad.nombre_especialidad='$nombre_especialidad'
					 JOIN pasantias.instituto_principal ON instituto_principal.id_ip= persona_instituto_especialidad.id_ip
					 JOIN pasantias.tipo_especialidad ON especialidad.id_tipo_especialidad = tipo_especialidad.id_tipo_especialidad AND tipo_especialidad.nombre_tipo_especialidad='$nombre_tipo_especialidad'
					 JOIN pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_ip = instituto_principal.id_ip
					  and instituto_principal.id_ip=$id_institutoP 
					AND especialidad_instituto_principal.id_especialidad = persona_instituto_especialidad.id_especialidad 
					AND  especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip 
					iNNER JOIN pasantias.perfil ON perfil.id_perfil = persona_instituto_especialidad.id_perfil 
					WHERE persona_instituto_especialidad.fecha_aceptacion>='$fecha_ii' AND persona_instituto_especialidad.fecha_aceptacion<='$fecha_ff' ORDER BY fecha_aceptacion ASC ";	 
							    
			$rs=pg_query($strsql);
			$num2=0;
			$num2=pg_num_rows($rs);
		

				if($num2>0){

					$html=$html.'<div align="center">			
								<table border="0" cellpadding="11" cellspacing="2"  >';	
					$html=$html.'<tr bgcolor="#A1E5FF">
									<td colspan="5"><font color="#003A50" size="14"><b>Personas en: '.$nombre_tipo_especialidad.'-'.$nombre_especialidad.'</b></font></td></tr>
		                            <tr bgcolor="#A1E5FF">
		                                <td><font color="#003A50" size="11"><b>Cédula</b></font></td>
		                                <td><font color="#003A50" size="11"><b>Nombre</b></font></td>
		                                <td><font color="#003A50" size="11"><b>Apellido</b></font></td>
		                                <td><font color="#003A50" size="11"><b>Perfil</b></font></td>
		                                <td><font color="#003A50" size="11"><b>Fecha Registro</b></font></td>  
		                            </tr>';

				
				$i=0;
				
				while ($row = pg_fetch_array($rs)){

					if($row["id_perfil"]==3){
						$perfil="ESTUDIANTE";
					}else if($row["id_perfil"]==4){
						$perfil="TUTOR ACADÉMICO";
					}else{
						$perfil="INDEFINIDO";	
					}
				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#F1FBFF">';
				}else{
					$html=$html.'<tr>';
				}

				$fecha3=$row["fecha_aceptacion"]; 
				$var3 = explode('-',$fecha3); 
				$fecha_registro="$var3[2]-$var3[1]-$var3[0]";

				$html = $html.'<td >';
				$html = $html. $row["cedula"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre"];
				$html = $html.'</td><td>';
				$html = $html. $row["apellido"];
				$html = $html.'</td><td>';
				$html = $html. $perfil;
			    $html = $html.'</td><td>';
				$html = $html. $fecha_registro;
			    $html = $html.'</td></tr>';	
	
					
				$i++;
			}
			$html=$html.'</table></div>';
		}else{

		}
		}			
						
     		 return ($html);
		}











/////////////////////////////////////---------- O F I C I N A--------------------------->>>>>>>>>>>>>>>>> 		





		function GenerarReporteOficinas($id_sucursal,$nombre_i){	//consultar estudiantes registrados por municipio	

			
 			$fecha = date("l, d-m-Y");

			$html="";
			$strsql="SELECT oficina.id_oficina, oficina.nombre_oficina, organizacion_oficina.estado, organizacion_oficina.descripcion, organizacion_oficina.observacion FROM pasantias.oficina  
				       JOIN  pasantias.departamento ON  oficina.id_departamento = pasantias.departamento.id_departamento
				       JOIN  pasantias.organizacion_oficina ON organizacion_oficina.id_oficina = oficina.id_oficina  
				       JOIN  pasantias.organizacionmunicipio ON organizacionmunicipio.codigo_sucursal = organizacion_oficina.codigo_sucursal WHERE organizacionmunicipio.codigo_sucursal='$id_sucursal' AND organizacion_oficina.estado!='MODIFICADO' ";	 
								    
			$rs=pg_query($strsql);
			$num=0;
			$num=pg_num_rows($rs);
		

			$html=$html.'
			<font color="#0B3861" align="center"><h2>Reporte De Oficinas</h2></font>
			<font color="#0B3861" align="left"><h3>&nbsp; &nbsp; Total de registros: &nbsp; <i>'.$num.'</i></h3> 
											   <h3>&nbsp; &nbsp; Institución: &nbsp; <i>'.$nombre_i.'</i></h3>
											   <h3>&nbsp; &nbsp; Fecha: &nbsp; <i>'.$fecha.'</i></h3></font>  
			
			
			';
			

				$html=$html.'<div align="center">			
			<table border="0" cellpadding="10" cellspacing="0"  >';	
			$html=$html.'<tr bgcolor="#0B3861">
			<td><font color="#FFFFFF" size="10"><b> Nombre Oficina </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Descripción </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Estado </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Observación </b></font></td>
			</tr>';

				$i=0;
				
				while ($row = pg_fetch_array($rs)){

				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["nombre_oficina"];
				$html = $html.'</td><td>';
				$html = $html. $row["descripcion"];
				$html = $html.'</td><td>';
				$html = $html. $row["estado"];
				$html = $html.'</td><td>';
				$html = $html. $row["observacion"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}



		function GenerarReporte_HistorialOficinas($id_sucursal,$nombre_i){	//consultar estudiantes registrados por municipio	

			
 			$fecha = date("l, d-m-Y");

			$html="";
			$strsql="SELECT oficina.id_oficina, oficina.nombre_oficina, organizacion_oficina.estado, organizacion_oficina.descripcion, organizacion_oficina.observacion FROM pasantias.oficina  
				       JOIN  pasantias.departamento ON  oficina.id_departamento = pasantias.departamento.id_departamento
				       JOIN  pasantias.organizacion_oficina ON organizacion_oficina.id_oficina = oficina.id_oficina  
				       JOIN  pasantias.organizacionmunicipio ON organizacionmunicipio.codigo_sucursal = organizacion_oficina.codigo_sucursal WHERE organizacionmunicipio.codigo_sucursal='$id_sucursal' ";	 
								    
			$rs=pg_query($strsql);
			$num=0;
			$num=pg_num_rows($rs);
		

			$html=$html.'
			<font color="#0B3861" align="center"><h2>Historial De Oficinas Registradas y Modificadas</h2></font>
			<font color="#0B3861" align="left"><h3>&nbsp; &nbsp; Total de registros: &nbsp; <i>'.$num.'</i></h3> 
											   <h3>&nbsp; &nbsp; Institución: &nbsp; <i>'.$nombre_i.'</i></h3>
											   <h3>&nbsp; &nbsp; Fecha: &nbsp; <i>'.$fecha.'</i></h3></font>  
			
			
			';
			

				$html=$html.'<div align="center">			
			<table border="0" cellpadding="10" cellspacing="0"  >';	
			$html=$html.'<tr bgcolor="#0B3861">
			<td><font color="#FFFFFF" size="10"><b> Nombre Oficina </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Descripción </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Estado </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Observación </b></font></td>
			</tr>';

				$i=0;
				
				while ($row = pg_fetch_array($rs)){

				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["nombre_oficina"];
				$html = $html.'</td><td>';
				$html = $html. $row["descripcion"];
				$html = $html.'</td><td>';
				$html = $html. $row["estado"];
				$html = $html.'</td><td>';
				$html = $html. $row["observacion"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}




		function GenerarReporte_PersonasAsignadas_MisOficinas($id_sucursal, $nombre_organizacion){	//consultar estudiantes registrados por municipio	

			$fecha = date("l, d-m-Y");
			
			$html="";
			$html=$html.'<font color="#0B3861" align="center"><h1>Personas Asignadas A Mis Oficinas</h1></font>';
			$html=$html.'<h3>&nbsp; &nbsp; Fecha: &nbsp; <i>'.$fecha.'</i></h3></font>';
			$consultaOfic="SELECT oficina.id_oficina, oficina.nombre_oficina, organizacion_oficina.estado, organizacion_oficina.descripcion, organizacion_oficina.observacion FROM pasantias.oficina  
				       JOIN  pasantias.departamento ON  oficina.id_departamento = pasantias.departamento.id_departamento
				       JOIN  pasantias.organizacion_oficina ON organizacion_oficina.id_oficina = oficina.id_oficina  
				       JOIN  pasantias.organizacionmunicipio ON organizacionmunicipio.codigo_sucursal = organizacion_oficina.codigo_sucursal WHERE organizacionmunicipio.codigo_sucursal='$id_sucursal' ";
			$resultado=pg_query($consultaOfic);
			$num=pg_num_rows($resultado);

			while($registros=pg_fetch_array($resultado)){
				$nombre_oficina=$registros['nombre_oficina'];

			$strsql="SELECT organizacion.id_organizacion, persona_organizacion_oficina.id_perfil, persona.cedula, persona.nombre , persona.apellido , oficina.id_oficina, oficina.nombre_oficina,
                          organizacion_oficina.estado, organizacion_oficina.descripcion, organizacion_oficina.observacion FROM pasantias.persona 
                          INNER JOIN pasantias.persona_organizacion_oficina 
                            ON persona_organizacion_oficina.id_persona = persona.id_persona
                          INNER JOIN pasantias.organizacionmunicipio 
                            ON organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal
                          INNER JOIN pasantias.organizacion 
                            ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
                          INNER JOIN pasantias. organizacion_oficina
                            ON organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
                          INNER JOIN pasantias.oficina
                            ON oficina.id_oficina = organizacion_oficina.id_oficina
                            AND persona_organizacion_oficina.id_oficina = oficina.id_oficina AND
                            organizacionmunicipio.codigo_sucursal='$id_sucursal' AND oficina.nombre_oficina='$nombre_oficina'";	 
							    
			$rs=pg_query($strsql);
			$num2=0;
			$num2=pg_num_rows($rs);
		

			if($num2>0){

			

				$html=$html.'<div align="center">			
				<table border="0" cellpadding="10" cellspacing="2"  >';	
				$html=$html.'<tr bgcolor="#0B3861">
	                            <td colspan="4" ><font color="#FFFFFF" size="14"><b>Personas en : '.$nombre_oficina.'</b></font></td>  
	                            </tr>
	                            <tr bgcolor="#1F486E">
	                                <td><font color="#FFFFFF" size="11"><b>Cédula</b></font></td>
	                                <td><font color="#FFFFFF" size="11"><b>Nombre</b></font></td>
	                                <td><font color="#FFFFFF" size="11"><b>Apellido</b></font></td>
	                                <td><font color="#FFFFFF" size="11"><b>Perfil</b></font></td>  
	                            </tr>';

				$i=0;
				
				while ($row = pg_fetch_array($rs)){

					if($row["id_perfil"]==6){
						$perfil="ENCARGADO";
					}else if($row["id_perfil"]==2){
						$perfil="CONTACTO";
					}else if($row["id_perfil"]==5){
						$perfil="TUTOR EMPRESARIAL";	
					}else{
						$perfil="INDEFINIDO";	
					}
				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["cedula"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre"];
				$html = $html.'</td><td>';
				$html = $html. $row["apellido"];
				$html = $html.'</td><td>';
				$html = $html. $perfil;
			    $html = $html.'</td></tr>';	

				
					
				$i++;
			}			
			$html=$html.'</table></div>';
		}else{}
			
			}			
     		 return ($html);
		
		}




		function GenerarReporte_PersonasAsignadas_MisOficinasFecha($id_sucursal, $fecha_ii, $fecha_ff){	//consultar estudiantes registrados por municipio	

			$fecha = date("d-m-Y");
			
			//EXPLODE
			$fecha1=$fecha_ii; 
			$var = explode('-',$fecha1); 
			$fecha_i="$var[2]-$var[1]-$var[0]";

			$fecha2=$fecha_ff; 
			$var2 = explode('-',$fecha2); 
			$fecha_f="$var2[2]-$var2[1]-$var2[0]"; 
			
			$html="";
			$html=$html.'<font color="#0B3861" align="center"><h1>Personas Asignadas A Oficinas</h1><br><h3>Desde // Hasta <br>'.$fecha_i.' // '.$fecha_f.'</h3></font>';
			$html=$html.'<h3>&nbsp; &nbsp; Emitido: &nbsp; <i>'.$fecha.'</i></h3></font>';
			$consultaOfic="SELECT oficina.id_oficina, oficina.nombre_oficina, organizacion_oficina.estado, organizacion_oficina.descripcion, organizacion_oficina.observacion FROM pasantias.oficina  
				       JOIN  pasantias.departamento ON  oficina.id_departamento = pasantias.departamento.id_departamento
				       JOIN  pasantias.organizacion_oficina ON organizacion_oficina.id_oficina = oficina.id_oficina  
				       JOIN  pasantias.organizacionmunicipio ON organizacionmunicipio.codigo_sucursal = organizacion_oficina.codigo_sucursal WHERE organizacionmunicipio.codigo_sucursal='$id_sucursal' ";
			$resultado=pg_query($consultaOfic);
			$num=pg_num_rows($resultado);

			while($registros=pg_fetch_array($resultado)){
				$nombre_oficina=$registros['nombre_oficina'];

			$strsql="SELECT fecha_aceptacion, organizacion.id_organizacion, persona_organizacion_oficina.id_perfil, persona.cedula, persona.nombre , persona.apellido , oficina.id_oficina, oficina.nombre_oficina,
                          organizacion_oficina.estado, organizacion_oficina.descripcion, organizacion_oficina.observacion FROM pasantias.persona 
                          INNER JOIN pasantias.persona_organizacion_oficina 
                            ON persona_organizacion_oficina.id_persona = persona.id_persona
                          INNER JOIN pasantias.organizacionmunicipio 
                            ON organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal
                          INNER JOIN pasantias.organizacion 
                            ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
                          INNER JOIN pasantias. organizacion_oficina
                            ON organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
                          INNER JOIN pasantias.oficina
                            ON oficina.id_oficina = organizacion_oficina.id_oficina
                            AND persona_organizacion_oficina.id_oficina = oficina.id_oficina AND
                            organizacionmunicipio.codigo_sucursal='$id_sucursal' AND oficina.nombre_oficina='$nombre_oficina' 
                            WHERE persona_organizacion_oficina.fecha_aceptacion>='$fecha_ii' AND persona_organizacion_oficina.fecha_aceptacion<='$fecha_ff' ORDER BY fecha_aceptacion ASC ";	 
							    
			$rs=pg_query($strsql);
			$num2=0;
			$num2=pg_num_rows($rs);
		

			if($num2>0){

			

				$html=$html.'<div align="center">			
				<table border="0" cellpadding="10" cellspacing="2"  >';	
				$html=$html.'<tr bgcolor="#A1E5FF">
	                            <td colspan="5" ><font color="#003A50" size="14"><b>Personas en : '.$nombre_oficina.'</b></font></td>  
	                            </tr>
	                            <tr bgcolor="#A1E5FF">
	                                <td><font color="#003A50" size="11"><b>Cédula</b></font></td>
	                                <td><font color="#003A50" size="11"><b>Nombre</b></font></td>
	                                <td><font color="#003A50" size="11"><b>Apellido</b></font></td>
	                                <td><font color="#003A50" size="11"><b>Perfil</b></font></td>
	                                <td><font color="#003A50" size="11"><b>Fecha Registro</b></font></td>  
	                            </tr>';

				$i=0;
				
				while ($row = pg_fetch_array($rs)){

					if($row["id_perfil"]==6){
						$perfil="ENCARGADO";
					}else if($row["id_perfil"]==2){
						$perfil="CONTACTO";
					}else if($row["id_perfil"]==5){
						$perfil="TUTOR EMPRESARIAL";	
					}else{
						$perfil="INDEFINIDO";	
					}
				
				$fecha3=$row["fecha_aceptacion"]; 
				$var3 = explode('-',$fecha3); 
				$fecha_registro="$var3[2]-$var3[1]-$var3[0]";

				if($i%2==0){
					$html=  $html.'<tr bgcolor="#F1FBFF">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["cedula"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre"];
				$html = $html.'</td><td>';
				$html = $html. $row["apellido"];
				$html = $html.'</td><td>';
				$html = $html. $perfil;
			    $html = $html.'</td><td>';
				$html = $html. $fecha_registro;
			    $html = $html.'</td></tr>';	

				
					
				$i++;
			}			
			$html=$html.'</table></div>';
		}else{}
			
			}			
     		 return ($html);
		
		}


}
?>