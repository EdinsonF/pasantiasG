<?php 

include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$conexion->Conectar();

class SqlReportesLocalidad
{	



	function municipiosGeneralTabla()
	{

		$html="";   $TITLE = "";

		$html=$html.'<div align="center"><font color="#0B3861" size="10"><h2>Municipios</h2></div>';

			$sqlMunicipio="SELECT nombre_municipio , municipio.codigo ,  nombre_estado , estado.codigo as codigo_e , 
			to_char(now(), 'TMDay, DD TMMonth YYYY') || ' a las ' ||  EXTRACT(hour from now() ) ||':'||EXTRACT(minute from now()) as hoy 
			FROM pasantias.municipio LEFT OUTER JOIN pasantias.estado 
			ON estado.id_estado = municipio.id_estado ORDER BY nombre_estado, nombre_municipio;";

			$result=pg_query($sqlMunicipio);

			$num=0;

			$num=pg_num_rows($result);

			if($num>0){
				$estado='';

				$i=0;
			while ($row = pg_fetch_array($result)){
					if($estado==''){
							$html=  $html.$this->EncabezadoTable($row['nombre_estado'] , $row['codigo_e']);
							$estado = $row['nombre_estado'];
					}else if($estado != $row['nombre_estado']){
						$html=	$html.'</table></div>';
						$html=  $html.$this->EncabezadoTable($row['nombre_estado'] , $row['codigo_e']);
						$estado = $row['nombre_estado'];
					}
				if($i==0)$TITLE='<h3>&nbsp; &nbsp; Reporte Emitido: &nbsp; <i>'.$row['hoy'].'</i></h3>';
				if($i%2==0)	$html=  $html.'<tr bgcolor="#E1F0FF">'; else $html=$html.'<tr>';
				$i++;
				$html = $html.'<td>';
				$html = $html. $i;
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_municipio"];
				$html = $html.'</td><td>';
				$html = $html.' # '. $row["codigo"];
				$html = $html.'</td></tr>';	
				
			}			
				$html=	$html.'</table></div>';
			}
     		 return ($TITLE.$html);
	}



	function estadoGeneralsql()
	{

		$sql = pg_query(" SELECT nombre_estado , codigo , 
			to_char(now(), 'TMDay, DD TMMonth YYYY') || ' a las ' ||  EXTRACT(hour from now() ) ||':'||EXTRACT(minute from now()) as hoy 
		  FROM pasantias.estado Order By estado.id_estado ;");

		return $sql;
	}


	function estadoGeneralTabla()
	{
			$html=""; $Title="";

			$rs= $this->estadoGeneralsql();

			$num=0;
			$num=pg_num_rows($rs);

			$html=$html.'<div align="center"><font color="#0B3861" size="10"><h2> Estados</h2></font></div>';
			

			$html=$html.'<div align="center">	

			<table border="0" cellpadding="10" cellspacing="2" >';		

			$html=$html.'<tr bgcolor="#0B3861">

			<td width="50"><font color="#FFFFFF" size="11"><b> # </b></font></td>

			<td width="500"><font color="#FFFFFF" size="11"><b> Nombre Estado </b></font></td>

			<td width="150"><font color="#FFFFFF" size="11"><b> C&oacute;digo </b></font></td>
			
			</tr>';

			
				$i=0;
				while ($row = pg_fetch_array($rs)){
					if($i==0) $Title='<h3>&nbsp; &nbsp; Reporte Emitido: &nbsp; <i>'.$row['hoy'].'</i></h3>';
					
					if($i%2==0) $html=  $html.'<tr bgcolor="#E1F0FF">'; else $html=$html.'<tr>';
				$i++;

				$html = $html.'<td>';
				$html = $html. $i;
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_estado"];
				$html = $html.'</td><td>';
				$html = $html.' # '. $row["codigo"];
				$html = $html.'</td></tr>';	
				
				}			
			$html=$html.'</table></div>';			
     		 return ($Title.$html);
	}


	function EncabezadoTable($nombre_estado , $codigo)
	{
			$html='' ;

			$html=$html.'<div align="center">	

			<table border="0" cellpadding="10" cellspacing="2"  >';		

			$html=$html.'<tr bgcolor="#0B3861">

			<td ><font color="#FFFFFF" size="14"><b> ESTADO: '.$nombre_estado.'  #  '.$codigo.'</b></font></td>

			</tr><tr bgcolor="#0B3861">

			<td width="50"><font color="#FFFFFF" size="11"><b> # </b></font></td>

			<td width="500"><font color="#FFFFFF" size="11"><b> Nombre Municipio </b></font></td>

			<td width="150"><font color="#FFFFFF" size="11"><b> C&oacute;digo </b></font></td>

			</tr>';
			return $html;
	}

}
