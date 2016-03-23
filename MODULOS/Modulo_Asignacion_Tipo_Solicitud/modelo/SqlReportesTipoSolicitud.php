<?php 

include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$co = $conexion->Conectar();

class SqlReportesTipoSolicitud
{	



	function Tipo_Solicitud_Generalsql()
	{

		$sql = pg_query(" SELECT * FROM pasantias.tipo_solicitud ORDER BY id_tipo_solicitud;");

		return $sql;
	}


	function Tipo_Solicitud_GeneralTabla()
	{
			$html="";

			$rs= $this->Tipo_Solicitud_Generalsql();
			//$rs=pg_query($sql);
			$num=0;
			$num=pg_num_rows($rs);

			$html=$html.'<div align="center">
			<font color="#0B3861" size="10"><h2>Reporte De Tipo Solicitud</h2>
			<h3>Total de registros: &nbsp; <i>'.$num.'</i></h3></font>
			
			';
			

			$html=$html.'<div align="center">			
			<table border="0" bordercolor="#0000CC" bordercolordark="#FF0000">';	
			$html=$html.'<tr bgcolor="#0B3861">
			<td><font color="#FFFFFF" size="10"><b> Id </b></font></td>
			<td><font color="#FFFFFF" size="10"><b> Nombre Tipo Solicitud </b></font></td>
			
			
			</tr>';

			
				$i=0;
				while ($row = pg_fetch_array($rs)){

				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#58ACFA">';
				}else{
					$html=$html.'<tr>';
				}
				$html = $html.'<td>';
				$html = $html. $row["id_tipo_solicitud"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_tipo_solicitud"];
				$html = $html.'</td></tr>';	
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
	}


}
