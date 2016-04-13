<?php 

include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$conexion->Conectar();


class SqlReportesTiposOrganizacion
{


	function tiposGeneralsql()
	{

		$sql = pg_query("SELECT nombre_tipo_organizacion, descripcion , estatus ,
			to_char(now(), 'TMDay, DD TMMonth YYYY') || ' a las ' ||  EXTRACT(hour from now() ) ||':'||EXTRACT(minute from now()) as hoy
			FROM pasantias.tipo_organizacion Order By nombre_tipo_organizacion  ;");

		return $sql;
	}


	function tiposGeneralTabla()
	{
			$html="";

			$rs= $this->tiposGeneralsql();
			//$rs=pg_query($sql);
			$num=0;
			$num=pg_num_rows($rs);
			$title='';
			$html=$html.'<div align="center">
			<font color="#0B3861" size="10"><h2> Tipos de organización</h2>
			<h3>Total de registros: &nbsp; <i>'.$num.'</i></h3></font>';
			

			$html=$html.'<div align="center">			
			<table border="0" cellpadding="11" cellspacing="0"  bordercolor="#0000CC" bordercolordark="#FF0000" >';	
			$html=$html.'<tr   bgcolor="#0B3861">

			<td width="50"><font color="#FFFFFF" size="11"><b>#</b></font></td>

			<td width="250"><font color="#FFFFFF" size="11"><b> Nombre  </b></font></td>

			<td width="300"><font color="#FFFFFF" size="11"><b> Descripción </b></font></td>

			<td width="100"><font color="#FFFFFF" size="11"><b> Estatus </b></font></td>		
			</tr>';

			
				$i=0;
				while ($row = pg_fetch_array($rs)){
					if($i==0)$title='<h3>&nbsp; &nbsp; Reporte Emitido: &nbsp; <i>'.$row['hoy'].'</i></h3>';
				
				if($i%2==0)	$html=  $html.'<tr bgcolor="#E1F0FF">';else	$html=$html.'<tr>';
				$i = $i+1;
				$html = $html.'<td>';
				$html = $html. $i;
				$html = $html.'</td><td>';
				$html = $html. $row[0];
				$html = $html.'</td><td>';
				$html = $html. $row[1];
				$html = $html.'</td><td>';
				$html = $html. $row[2];
				$html = $html.'</td></tr>';
				$i = $i-1;
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($title.$html);
	}




}
