﻿<?php
//require_once("../../../../BASE_DATOS/Conect.php");

$obj=new Conexion();
$obj->Conectar();

class reportes{



/////////////////////////////////////---------- O F I C I N A--------------------------->>>>>>>>>>>>>>>>> 		



		function GenerarReporte_Postulados($id_sucursal){	//consultar estudiantes registrados por municipio	

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