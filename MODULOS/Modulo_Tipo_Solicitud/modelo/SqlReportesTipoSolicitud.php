<?php 

include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$co = $conexion->Conectar();

class SqlReportesTipoSolicitud
{	



	function Tipo_Solicitud_Generalsql()
	{

		$sql = pg_query(" SELECT nombre_tipo_solicitud , estatus,
			to_char(now(), 'TMDay, DD TMMonth YYYY') || ' a las ' ||  EXTRACT(hour from now() ) ||':'||EXTRACT(minute from now()) as hoy 
		 FROM pasantias.tipo_solicitud ORDER BY nombre_tipo_solicitud ;");

		return $sql;
	}


	function Tipo_Solicitud_GeneralTabla()
	{
			$html="";
			$Title="";
			$rs= $this->Tipo_Solicitud_Generalsql();
			//$rs=pg_query($sql);
			$num=0;
			$num=pg_num_rows($rs);

			$html=$html.'<font color="#0B3861" size="10"><h2> Tipo Solicitud</h2></font>';

			$html=$html.'<div align="center">				

			<table border="0" cellpadding="10" cellspacing="2"  >';	

			$html=$html.'<tr bgcolor="#0B3861">

			<td width="50"  ><font color="#FFFFFF" size="11"><b> # </b></font></td>

			<td width="500" ><font color="#FFFFFF" size="11"><b> Nombre Tipo Solicitud </b></font></td>
			
			<td width="150" ><font color="#FFFFFF" size="11"><b> Estatus </b></font></td>
			
			</tr>';

			
				$i=0;
			while ($row = pg_fetch_array($rs)){
				if($i==0) $Title='<h3>&nbsp; &nbsp; Reporte Emitido: &nbsp; <i>'.$row['hoy'].'</i></h3>';
				if($i%2==0)	$html=  $html.'<tr bgcolor="#E1F0FF">'; else $html=$html.'<tr>';

				$i++;
				$html = $html.'<td>';
				$html = $html. $i;
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_tipo_solicitud"];
				$html = $html.'</td><td>';
				$html = $html. $row["estatus"];
				$html = $html.'</td></tr>';	
			
				
			}			
			$html=$html.'</table></div>';			
     		 return ($Title.$html);
	}


}
