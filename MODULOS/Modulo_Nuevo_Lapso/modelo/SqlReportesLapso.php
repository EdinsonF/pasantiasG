<?php 

include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$co = $conexion->Conectar();

class SqlReportesLapsos
{	



	function SqlReportesLapsos()
	{

		$sql = pg_query ("SELECT numero_lapso ,
		 to_char(lapso_academico.ano_i, 'DD, TMMonth YYYY') as ano_i ,
		 to_char(lapso_academico.ano_f, 'DD, TMMonth YYYY') as ano_f , 
		 estatus ,
			to_char(now(), 'TMDay, DD TMMonth YYYY') || ' a las ' ||  EXTRACT(hour from now() ) ||':'||EXTRACT(minute from now()) as hoy

			FROM pasantias.lapso_academico ORDER BY numero_lapso;");
		

		return $sql;
	}


	function LapsosGeneralTabla()
	{
			$html="";

			$rs= $this->SqlReportesLapsos();
			//$rs=pg_query($sql);
			$num=0;
			$num=pg_num_rows($rs);
			$Title='';
			$html=$html.'<div align="center">
			<font color="#0B3861" size="10"><h2>Lapsos Acad&eacute;micos</h2>
			<h3>Total de registros: &nbsp; <i>'.$num.'</i></h3></font>
			
			';
			

			$html=$html.'<div align="center">			
			<table border="0" cellpadding="11" cellspacing="0"  bordercolor="#0000CC" bordercolordark="#FF0000">';	
			$html=$html.'<tr bgcolor="#0B3861">
			<td  width="100"><font color="#FFFFFF" size="12"><b> Lapso </b></font></td>
			<td  width="250"><font color="#FFFFFF" size="12"><b> Fecha de Inicio </b></font></td>
			<td  width="250"><font color="#FFFFFF" size="12"><b> Fecha de Culminaci&oacute;n </b></font></td>
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
				$html = $html.'<td>';
				$html = $html. $row["numero_lapso"];
				$html = $html.'</td><td>';
				$html = $html. $row["ano_i"];
				$html = $html.'</td><td>';
				$html = $html. $row["ano_f"];
				$html = $html.'</td><td>';
				$html = $html. $row["estatus"];
				$html = $html.'</td></tr>';	
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($Title.$html);
	}


}
