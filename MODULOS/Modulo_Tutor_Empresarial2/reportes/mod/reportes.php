<?php
include_once("../../../../BASE_DATOS/Conect.php");

$obj=new Conexion();
$obj->Conectar();

class reportes{



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
				<table border="0" cellpadding="0" cellspacing="2"  >';	
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



		

}
?>