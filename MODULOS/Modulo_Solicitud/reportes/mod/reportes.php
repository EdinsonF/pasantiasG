<?php
include_once("../../../../BASE_DATOS/Conect.php");

$obj=new Conexion();
$obj->Conectar();

class reportes{


		function GenerarReporteEspecialidad(){	//consultar estudiantes registrados por municipio	

			$html="";
			$strsql="SELECT pasantias.departamento.estado, pasantias.especialidad.nombre_especialidad, pasantias.departamento.descripcion, pasantias.tipo_especialidad.nombre_tipo_especialidad FROM pasantias.especialidad  , pasantias.departamento, pasantias.tipo_especialidad WHERE

 					especialidad.id_departamento  = departamento.id_departamento AND especialidad.id_tipo_especialidad=tipo_especialidad.id_tipo_especialidad ";	 
				    
			$rs=pg_query($strsql);
			$num=0;
			$num=pg_num_rows($rs);
		

			/*$html=$html.'<div align="center">

					/*<font size="12"><b>República Bolivariana de Venezuela<br>
			Ministerio del Poder Popular para la Educación Superior Universitaria<br>
			Sistema Informatico para el Control de Pasantes Practicas Profesionales y Egresados<br>
			SICPPRE</b></font></div> */


	


			$html=$html.'<div align="center">
			<font color="#0B3861" size="10"><h2>Reporte De Especialidades</h2>
			<h3>Total de registros: &nbsp; <i>'.$num.'</i></h3></font>
			
			';
			

				$html=$html.'<div align="center">			
			<table border="0" bordercolor="#0000CC" bordercolordark="#FF0000">';	
			$html=$html.'<tr bgcolor="#0B3861">
			<td><font color="#FFFFFF" size="10"><b> N&oacute;mbre Especialidad </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Tipo Especialidad </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Descripción </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Estado </b></font></td>
			</tr>';

			
				
				while ($row = pg_fetch_array($rs)){

				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#58ACFA">';
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
				$html = $html. $row["estado"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}




//////////////////////////////////////O F I C N A S ----------------------------------<>>>>>>>>>
		function GenerarReporteOficinas(){	//consultar estudiantes registrados por municipio	

			$html="";
			$strsql="SELECT pasantias.departamento.estado, pasantias.oficina.nombre_oficina, pasantias.departamento.descripcion FROM pasantias.oficina  , pasantias.departamento WHERE

 					oficina.id_departamento  = departamento.id_departamento";	 
				    
			$rs=pg_query($strsql);
			$num=0;
			$num=pg_num_rows($rs);
		


			$html=$html.'<div align="center">
			<h2>Reporte De Especialidades</h2>
			<h3>Total de registros: &nbsp; <i>'.$num.'</i></h3>
			
			<br><br>
			';
			/*$html=$html.'&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
			<table style="border-spacing: 2px;" align="center"  >
			<tr align="center" bgcolor="#011137"  border="1" style="color: #000000;">
				<td width="100"><font color="#FFFFFF">Id</font></td>
				<td width="100"><font color="#FFFFFF">Nombre</font></td>
				
				</tr>';*/


				$html=$html.'<div align="center">			
			<table border="0" bordercolor="#0000CC" bordercolordark="#FF0000">';	
			$html=$html.'<tr bgcolor="#0B3861">
			<td><font color="#FFFFFF" size="10"><b> N&oacute;mbre Oficina </b></font></td>
	
			<td><font color="#FFFFFF" size="10"><b> Descripción </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Estado </b></font></td>
			</tr>';

			
				
				while ($row = pg_fetch_array($rs)){

				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#58ACFA">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["nombre_oficina"];
				$html = $html.'</td><td>';
				$html = $html. $row["descripcion"];
				$html = $html.'</td><td>';
				$html = $html. $row["estado"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}



		

}
?>