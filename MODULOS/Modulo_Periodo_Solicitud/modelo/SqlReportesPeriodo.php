<?php 

include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$co = $conexion->Conectar();

class SqlReportesPeriodo
{	



	function PeriodoGeneralsql()
	{

		$sql = pg_query(" SELECT to_char(periodo_solicitud.fecha_inicio, 'DD, TMMonth YYYY')|| ' al ' ||to_char(periodo_solicitud.fecha_fin, 'DD, TMMonth YYYY') as periodo_solicitud,
			numero_lapso, lapso_academico.estatus ,
			to_char(now(), 'TMDay, DD TMMonth YYYY') || ' a las ' ||  EXTRACT(hour from now() ) ||':'||EXTRACT(minute from now()) as hoy 
		 FROM pasantias.periodo_solicitud INNER JOIN pasantias.lapso_academico 
		 ON lapso_academico.id_lapso = periodo_solicitud.id_lapso Order By periodo_solicitud.id_periodo ;");

		return $sql;
	}


	function PeriodoGeneralTabla()
	{
			$html="";

			$rs= $this->PeriodoGeneralsql();

			$num=0;
			$num=pg_num_rows($rs);
			$Title='';
			$html=$html.'<div align="center">
			<font color="#0B3861" size="10"><h2> Periodos de Solicitud</h2>
			<h3>Total de registros: &nbsp; <i>'.$num.'</i></h3></font>';
			

			$html=$html.'<div align="center">

			<table border="" cellpadding="10" cellspacing=""  >';	

			$html=$html.'<tr bgcolor="#0B3861">

			<td width="50"><font color="#FFFFFF" size="12"><b> # </b></font></td>

			<td width="350"><font color="#FFFFFF" size="12"><b> Periodo </b></font></td>
			
			<td ><font color="#FFFFFF" size="12"><b> Lapso Acad&eacute;mico </b></font></td>
			
			<td width="100"><font color="#FFFFFF" size="12"><b> Estatus</b></font></td>
			
			</tr>';

			
				$i=0;
				while ($row = pg_fetch_array($rs)){
					if($i==0)$Title='<h3>&nbsp; &nbsp; Reporte Emitido: &nbsp; <i>'.$row['hoy'].'</i></h3>';
				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$i++;
				$html = $html.'<td>';
				$html = $html. $i ;
				$html = $html.'</td><td>';
				$html = $html. $row["periodo_solicitud"];
				$html = $html.'</td><td>';
				$html = $html. $row["numero_lapso"];
				$html = $html.'</td><td>';
				$html = $html. $row["estatus"];
				$html = $html.'</td></tr>';	

				
			}			
			$html=$html.'</table></div>';			
     		 return ($Title.$html);
	}


}
