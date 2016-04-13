<?php
//require_once("../../../../BASE_DATOS/Conect.php");

include("../css_table.css");

$obj=new Conexion();
$obj->Conectar();

class reportes{

/////////////////////////////////////---------- E S P E C I L I D A D-------->>>>>>>> 
		function GenerarReporte_TipoEspecialidad(){	//consultar estudiantes registrados por municipio	

			
 			$fecha = date("l, d-m-Y");

			$html="";
			$strsql="SELECT * FROM pasantias.tipo_especialidad ";	 
				    
			$rs=pg_query($strsql);
			$num=0;
			$num=pg_num_rows($rs);
		

			$html=$html.'
			<font color="#0B3861" align="center"><h2>Reporte De Tipo Especialidad</h2></font>
			<font color="#0B3861" align="left"><h3>&nbsp; &nbsp; Total de registros: &nbsp; <i>'.$num.'</i></h3> 
											  
											   <h3>&nbsp; &nbsp; Fecha: &nbsp; <i>'.$fecha.'</i></h3></font>  
			
			
			';
			

				$html=$html.'<div align="center">			
			<table border="0" cellpadding="11" cellspacing="0"  >';	
			$html=$html.'<tr bgcolor="#0B3861">
			<td><font color="#FFFFFF" size="10"><b> Tipo Especialidad </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Estatus </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Descripción </b></font></td>
			</tr>';

				$i=0;
				
				while ($row = pg_fetch_array($rs)){

				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["nombre_tipo_especialidad"];
				$html = $html.'</td><td>';
				$html = $html. $row["estado"];
				$html = $html.'</td><td>';
				$html = $html. $row["descripcion"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}


}
?>