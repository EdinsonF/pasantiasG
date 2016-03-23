<?php 

include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$co = $conexion->Conectar();

class SqlReportesRequisito
{	



	function Requisito_Generalsql()
	{

		$sql = pg_query(" SELECT nombre_requisito , estatus ,
		to_char(now(), 'TMDay, DD TMMonth YYYY') || ' a las ' ||  EXTRACT(hour from now() ) ||':'||EXTRACT(minutes from now())  as hoy 
		FROM pasantias.requisito ORDER BY id_requisito;");

		return $sql;
	}


	function Requisito_GeneralTabla()
	{
			$html="";
			$Title="";
			$rs= $this->Requisito_Generalsql();
			$num=0;
			$num=pg_num_rows($rs);

			$html=$html.'<div align="center"><font color="#0B3861" size="10"><h2> Requisitos</h2></font></div>';
			

			$html=$html.'<div align="center">			
			<table border="0" cellpadding="11" cellspacing="0"  bordercolor="#0000CC" bordercolordark="#FF0000">';	
			$html=$html.'<tr bgcolor="#0B3861">
			<td width="50"><font color="#FFFFFF" size="11"><b> # </b></font></td>

			<td width="415"><font color="#FFFFFF" size="11"><b> Nombre Requisito </b></font></td>
			
			<td><font color="#FFFFFF" size="11"><b> Estatus </b></font></td>
			</tr>';

			
				$i=0;
				while ($row = pg_fetch_array($rs)){
					if($i==0)$Title='<h3>&nbsp;  Reporte Emitido: &nbsp; <i>'.$row['hoy'].'</i></h3>';
				
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$i++;
				$html = $html.'<td>';
				$html = $html.$i;
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_requisito"];
				$html = $html.'</td><td>';
				$html = $html. $row["estatus"];
				$html = $html.'</td></tr>';	
				
			}			
			$html=$html.'</table></div>';			
     		 return ($Title.$html);
	}


}
