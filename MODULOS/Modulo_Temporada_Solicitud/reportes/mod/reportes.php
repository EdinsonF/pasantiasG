<?php
include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$co = $conexion->Conectar();
class reportes{




		function GenerarReporte_EspecificoTemporada($codigo_temporada_especialidad){	//consultar estudiantes registrados por municipio	

			
 			$fecha = date("l, d-m-Y");

			$html="";
	$strsql="SELECT especialidad.nombre_especialidad || ' - ' ||nombre_tipo_especialidad as especialidad, nombre_tipo_solicitud , 
		to_char(periodo_solicitud.fecha_inicio, 'DD, TMMonth YYYY')|| ' al ' ||to_char(periodo_solicitud.fecha_fin, 'DD, TMMonth YYYY') as periodo_solicitud ,
		lapso_academico.numero_lapso ||' :: '||
				to_char(lapso_academico.ano_i, 'DD, TMMonth YYYY')|| ' al ' ||to_char(lapso_academico.ano_f, 'DD, TMMonth YYYY') as lapsoacademico ,
		persona.nombre ||' ' || persona.apellido as estudiante , estudiante.expediente , persona.cedula ,to_char(current_date, 'DD, TMMonth YYYY') as hoy
		FROM pasantias.temporadas_solicitud INNER JOIN pasantias.temporadas_especialidad 
			ON  temporadas_solicitud.codigo_temporada = temporadas_especialidad .codigo_temporada
		INNER JOIN pasantias.temporadas_estudiantes 
			ON temporadas_estudiantes.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
			AND temporadas_especialidad.codigo_temporada_especialidad= '$codigo_temporada_especialidad'
		INNER JOIN pasantias.especialidad 
			ON especialidad . id_especialidad = temporadas_especialidad.id_especialidad 
		INNER JOIN pasantias.estudiante 
			ON estudiante .codigo_estudiante = temporadas_estudiantes.codigo_estudiante
		INNER JOIN pasantias.tipo_solicitud
			ON tipo_solicitud.id_tipo_solicitud = temporadas_solicitud.id_tipo_solicitud
		INNER JOIN pasantias.periodo_solicitud 
			ON periodo_solicitud.id_periodo = temporadas_solicitud.id_periodo
		INNER JOIN pasantias.persona_instituto_especialidad
			ON estudiante  . id_persona = persona_instituto_especialidad.id_persona 
			AND estudiante . id_perfil = persona_instituto_especialidad.id_perfil 
			AND estudiante . id_especialidad = persona_instituto_especialidad.id_especialidad 
			AND estudiante . id_ip = persona_instituto_especialidad.id_ip
			AND persona_instituto_especialidad.id_especialidad  = especialidad . id_especialidad
			INNER JOIN pasantias.instituto_principal 
			ON persona_instituto_especialidad.id_ip = instituto_principal.id_ip
		INNER JOIN pasantias.persona
			ON persona.id_persona = persona_instituto_especialidad.id_persona 
		INNER JOIN pasantias.tipo_especialidad
			ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad
		INNER JOIN pasantias.lapso_academico
			ON lapso_academico.id_lapso=periodo_solicitud.id_lapso
			ORDER BY estudiante;		";	 
			$result=pg_query($strsql);
			
			 $Result=$this->EncabezadoReporteEspecifico($codigo_temporada_especialidad);
			 $html=$html.$Result['Encabezado'];


				$html=$html.'<div align="center">			
			<table border="" cellpadding="10" cellspacing="2"  >';	
			$html=$html.'<tr bgcolor="#0B3861">
			<td colspan="4"><font color="#FFFFFF" size="12"><b>Especialidad: '. $Result['especialidad'].' </b></font></td>
			</tr><tr bgcolor="#0B3861">
			<td width="50"><font color="#FFFFFF" size="12"><b> # </b></font></td>
			<td width="300"><font color="#FFFFFF" size="12"><b> Estudiante </b></font></td>
			<td width="150"><font color="#FFFFFF" size="12"><b> Expediente </b></font></td>
			<td width="200"><font color="#FFFFFF" size="12"><b> Cédula </b></font></td>
			
			</tr>';

				$i=1;
				
				while ($row = pg_fetch_array($result)){

				$i=$i-1;
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$i=$i+1;
				$html = $html.'<td>';
				$html = $html. $i;
				$html = $html.'</td><td>';
				$html = $html. $row["estudiante"];
				$html = $html.'</td><td>';
				$html = $html. $row["expediente"];
				$html = $html.'</td><td>';
				$html = $html. $row["cedula"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}



		
		function GenerarReporte_GeneralTemporada($codigo_temporada){	//consultar estudiantes registrados por municipio	



			$sql=pg_query("SELECT persona.nombre || '  ' || persona.apellido as estudiante ,
					estudiante.expediente , persona.cedula ,
					 especialidad.nombre_especialidad || ' - '|| tipo_especialidad.nombre_tipo_especialidad as especialidad ,
					 especialidad.id_especialidad,
					 to_char(periodo_solicitud.fecha_inicio, 'DD, TMMonth YYYY')|| ' al ' ||to_char(periodo_solicitud.fecha_fin, 'DD, TMMonth YYYY') as periodo_solicitud,
					 lapso_academico.numero_lapso ||' :: '||
					 to_char(lapso_academico.ano_i, 'DD, TMMonth YYYY')|| ' al ' ||to_char(lapso_academico.ano_f, 'DD, TMMonth YYYY')
					 as lapsoacademico ,
					 tipo_solicitud.nombre_tipo_solicitud,
					 temporadas_solicitud.estatus
					
				FROM pasantias.temporadas_solicitud INNER JOIN pasantias.temporadas_especialidad
					ON temporadas_solicitud.codigo_temporada= temporadas_especialidad.codigo_temporada
				INNER JOIN pasantias.temporadas_estudiantes 
					ON temporadas_estudiantes.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
				INNER JOIN pasantias.estudiante 
					ON estudiante.codigo_estudiante=temporadas_estudiantes.codigo_estudiante
				INNER JOIN pasantias.especialidad
					ON  especialidad.id_especialidad= temporadas_especialidad.id_especialidad
				INNER JOIN pasantias.tipo_especialidad
					ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad
				INNER JOIN pasantias.persona_instituto_especialidad 
					ON persona_instituto_especialidad.id_persona = estudiante.id_persona
					AND persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
					AND persona_instituto_especialidad.id_ip = estudiante.id_ip
					AND persona_instituto_especialidad.id_perfil = estudiante.id_perfil
				INNER JOIN pasantias.persona
					ON persona.id_persona = persona_instituto_especialidad.id_persona
				INNER JOIN pasantias.especialidad_instituto_principal 
					ON especialidad_instituto_principal.id_especialidad = persona_instituto_especialidad.id_especialidad
					AND especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip
				INNER JOIN pasantias.perfil
					ON perfil.id_perfil= persona_instituto_especialidad.id_perfil
				INNER JOIN pasantias.instituto_principal 
					ON instituto_principal.id_ip = especialidad_instituto_principal.id_ip
					AND especialidad.id_especialidad = especialidad_instituto_principal.id_especialidad
				AND temporadas_solicitud.codigo_temporada='$codigo_temporada'
				INNER JOIN pasantias.tipo_solicitud
					ON tipo_solicitud .id_tipo_solicitud =temporadas_solicitud.id_tipo_solicitud
				INNER JOIN pasantias.periodo_solicitud 
					ON periodo_solicitud.id_periodo= temporadas_solicitud.id_periodo
				INNER JOIN pasantias.lapso_academico 
					ON lapso_academico.id_lapso = periodo_solicitud.id_lapso 
				ORDER BY tipo_especialidad.nombre_tipo_especialidad ,  especialidad.nombre_especialidad;");
			$html= $this->tablaReporteGeneral($sql,$codigo_temporada);
 	
     		 return ($html);
		}

		function tablaReporteGeneral( $sql,$codigo_temporada )
		{
			
			$html="";

				$i=1;
				$especialidad ;
				$especialidadAnterior = null;
				if(isset($codigo_temporada)) $html=$html.$this->EncabezadoReporte($codigo_temporada );
				$html=$html.'<div align="center">';
				while ($row = pg_fetch_array($sql)){
				
					
			 	$especialidad = $row['id_especialidad'];

				if($especialidad!=$especialidadAnterior){
					if($i>1)
					{
						$html=$html.'</table>';		
					}
				$html=$html.'<font color="#0B3861" align="center"><h2>Estudiantes : '.$row['especialidad'].'</h2></font>

				<table  cellpadding="10"><tr bgcolor="#0B3861" >

				<td width="50"><font color="#FFFFFF" size="12"><b> # </b></font></td>

				<td width="308"><font color="#FFFFFF" size="12"><b> Estudiante </b></font></td>

				<td width="150"><font color="#FFFFFF" size="12"><b> Expediente </b></font></td>
				
				<td width="200"><font color="#FFFFFF" size="12"><b> Cédula </b></font></td>
				
				</tr>';
				$especialidadAnterior =$especialidad;
				}

				$i=$i-1;
				if($i%2==0) $html=  $html.'<tr bgcolor="#E1F0FF">'; else $html=$html.'<tr>'; 
				
				$i=$i+1;
				$html = $html.'<td>';
				$html = $html. $i;
				$html = $html.'</td><td>';
				$html = $html. $row["estudiante"];
				$html = $html.'</td><td>';
				$html = $html. $row["expediente"];
				$html = $html.'</td><td>';
				$html = $html. $row["cedula"];
				$html = $html.'</td></tr>';		

				$i++;

			}			
				$html=$html.'</table></div>';		
			return $html;
		}

		function urls_amigables($url) {

		// Tranformamos todo a minusculas

		$url = strtolower($url);

		//Rememplazamos caracteres especiales latinos

		$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');

		$repl = array('a', 'e', 'i', 'o', 'u', 'n');

		$url = str_replace ($find, $repl, $url);

		// Añaadimos los guiones

		$find = array(' ', '&', '\r\n', '\n', '+'); 
		$url = str_replace ($find, '-', $url);

		// Eliminamos y Reemplazamos demás caracteres especiales

		$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');

		$repl = array('', '-', '');

		$url = preg_replace ($find, $repl, $url);

		return $url;

		}
		function EncabezadoReporte( $codigo_temporada  )
		{

			$sql=pg_query("SELECT persona.nombre ||' '|| persona.apellido as encargado, tipo_solicitud.nombre_tipo_solicitud ,
				to_char(periodo_solicitud.fecha_inicio, 'DD, TMMonth YYYY')|| ' al ' ||to_char(periodo_solicitud.fecha_fin, 'DD, TMMonth YYYY') as periodo_solicitud,
				lapso_academico.numero_lapso ||' :: '||
				to_char(lapso_academico.ano_i, 'DD, TMMonth YYYY')|| ' al ' ||to_char(lapso_academico.ano_f, 'DD, TMMonth YYYY')
				as lapsoacademico , temporadas_solicitud.estatus , to_char(now(), 'TMDay, DD TMMonth YYYY') || ' a las ' ||  EXTRACT(hour from now() ) ||':'||EXTRACT(minute from now()) as hoy
			 FROM pasantias.temporadas_solicitud JOIN pasantias.encargado 
		  ON  temporadas_solicitud.codigo_encargado = encargado.codigo_encargado JOIN pasantias.persona_organizacion_oficina
		  ON  persona_organizacion_oficina.id_persona = encargado.id_persona  AND  persona_organizacion_oficina.id_oficina = encargado.id_oficina
		  AND persona_organizacion_oficina.id_perfil = encargado.id_perfil  
		  AND  persona_organizacion_oficina.codigo_sucursal = encargado.codigo_sucursal
		  
		  JOIN pasantias.persona ON persona.id_persona = persona_organizacion_oficina.id_persona JOIN pasantias.tipo_solicitud 
		  ON temporadas_solicitud.id_tipo_solicitud = tipo_solicitud.id_tipo_solicitud JOIN pasantias.periodo_solicitud 
		  ON periodo_solicitud.id_periodo = temporadas_solicitud.id_periodo JOIN pasantias.lapso_academico 
		  ON lapso_academico.id_lapso = periodo_solicitud.id_lapso WHERE temporadas_solicitud.codigo_temporada='$codigo_temporada' ;");
			$fila = pg_fetch_assoc($sql);
			$Title='<h3>&nbsp; &nbsp; Reporte Emitido: &nbsp; <i>'.$fila['hoy'].'</i></h3>
			<font color="#0B3861" align="center"><h2>Temporada</h2></font>';
			$Temporada='<pre  style="	display: block; padding: 9.5px;margin: 0 0 10px;line-height: 1.42857143;color: #333;font-size: 35px;word-break: break-all;word-wrap: break-word;background-color: #f5f5f5;border: 1px solid #ccc;border-radius: 4px; overflow-x: auto; overflow-y: auto;">
				
			<strong>Persona Encargada :</strong> '.$fila['encargado'].'

			<strong>Tipo de Solicitud :</strong> '.$fila['nombre_tipo_solicitud'].'
			
			<strong>Estatus			  						:</strong> '.$fila['estatus'].'
			
			<strong>Periodo 		  						:</strong> '.$fila['periodo_solicitud'].'
			
			<strong>Lapso Académico	  :</strong> '.$fila['lapsoacademico'].'</pre>
			';
			return $Title.$Temporada;
		}

		function EncabezadoReporteEspecifico( $codigo_temporada_especialidad  )
		{

			$sql=pg_query("SELECT persona.nombre ||' '|| persona.apellido as encargado, tipo_solicitud.nombre_tipo_solicitud ,
				to_char(periodo_solicitud.fecha_inicio, 'DD, TMMonth YYYY')|| ' al ' ||to_char(periodo_solicitud.fecha_fin, 'DD, TMMonth YYYY') as periodo_solicitud,
				lapso_academico.numero_lapso ||' :: '||
				to_char(lapso_academico.ano_i, 'DD, TMMonth YYYY')|| ' al ' ||to_char(lapso_academico.ano_f, 'DD, TMMonth YYYY')
				as lapsoacademico , temporadas_solicitud.estatus , to_char(now(), 'TMDay, DD TMMonth YYYY') || ' a las ' ||  EXTRACT(hour from now() ) ||':'||EXTRACT(minute from now()) as hoy
				,especialidad.nombre_especialidad ||' - ' ||  tipo_especialidad.nombre_tipo_especialidad as especialidad
			 FROM pasantias.temporadas_solicitud 
			 JOIN pasantias.encargado 
		  ON  temporadas_solicitud.codigo_encargado = encargado.codigo_encargado 
		  INNER JOIN pasantias.persona_organizacion_oficina
		  ON  persona_organizacion_oficina.id_persona = encargado.id_persona  
		  AND  persona_organizacion_oficina.id_oficina = encargado.id_oficina
		  AND persona_organizacion_oficina.id_perfil = encargado.id_perfil  
		  AND  persona_organizacion_oficina.codigo_sucursal = encargado.codigo_sucursal
		  INNER JOIN pasantias.temporadas_especialidad
		  	ON temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada
		  INNER JOIN pasantias.especialidad 
		  	ON especialidad.id_especialidad = temporadas_especialidad.id_especialidad
		  INNER JOIN pasantias.tipo_especialidad
		  	ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad
		  INNER JOIN pasantias.persona ON persona.id_persona = persona_organizacion_oficina.id_persona JOIN pasantias.tipo_solicitud 
		  	ON temporadas_solicitud.id_tipo_solicitud = tipo_solicitud.id_tipo_solicitud 
		  INNER JOIN pasantias.periodo_solicitud 
		  	ON periodo_solicitud.id_periodo = temporadas_solicitud.id_periodo 
		  INNER JOIN pasantias.lapso_academico 
		  	ON lapso_academico.id_lapso = periodo_solicitud.id_lapso 
		  WHERE temporadas_especialidad.codigo_temporada_especialidad='$codigo_temporada_especialidad' ;");

			$fila = pg_fetch_assoc($sql);

			$Title='<h3>&nbsp; &nbsp; Reporte Emitido: &nbsp; <i>'.$fila['hoy'].'</i></h3>
			<font color="#0B3861" align="center"><h2>Temporada</h2></font>';
			$Temporada='<pre  style="	display: block; padding: 9.5px;margin: 0 0 10px;line-height: 1.42857143;color: #333;font-size: 35px;word-break: break-all;word-wrap: break-word;background-color: #f5f5f5;border: 1px solid #ccc;border-radius: 4px; overflow-x: auto; overflow-y: auto;">
				
			<strong>Persona Encargada :</strong> '.$fila['encargado'].'

			<strong>Tipo de Solicitud :</strong> '.$fila['nombre_tipo_solicitud'].'
			
			<strong>Estatus			  						:</strong> '.$fila['estatus'].'
			
			<strong>Periodo 		  						:</strong> '.$fila['periodo_solicitud'].'
			
			<strong>Lapso Académico	  :</strong> '.$fila['lapsoacademico'].'</pre>
			';
			return array('Encabezado'=>$Title.$Temporada , 'especialidad'=>$fila['especialidad']);
		}

		function EncabezadoReporteNombreDinamic( $codigo_temporada_especialidad , $nombre_title )
		{

			$sql=pg_query("SELECT persona.nombre ||' '|| persona.apellido as encargado, tipo_solicitud.nombre_tipo_solicitud ,
				to_char(periodo_solicitud.fecha_inicio, 'DD, TMMonth YYYY')|| ' al ' ||to_char(periodo_solicitud.fecha_fin, 'DD, TMMonth YYYY') as periodo_solicitud,
				lapso_academico.numero_lapso ||' :: '||
				to_char(lapso_academico.ano_i, 'DD, TMMonth YYYY')|| ' al ' ||to_char(lapso_academico.ano_f, 'DD, TMMonth YYYY')
				as lapsoacademico , temporadas_solicitud.estatus , to_char(now(), 'TMDay, DD TMMonth YYYY') || ' a las ' ||  EXTRACT(hour from now() ) ||':'||EXTRACT(minute from now()) as hoy
				,especialidad.nombre_especialidad ||' - ' ||  tipo_especialidad.nombre_tipo_especialidad as especialidad
			 FROM pasantias.temporadas_solicitud 
			 JOIN pasantias.encargado 
		  ON  temporadas_solicitud.codigo_encargado = encargado.codigo_encargado 
		  INNER JOIN pasantias.persona_organizacion_oficina
		  ON  persona_organizacion_oficina.id_persona = encargado.id_persona  
		  AND  persona_organizacion_oficina.id_oficina = encargado.id_oficina
		  AND persona_organizacion_oficina.id_perfil = encargado.id_perfil  
		  AND  persona_organizacion_oficina.codigo_sucursal = encargado.codigo_sucursal
		  INNER JOIN pasantias.temporadas_especialidad
		  	ON temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada
		  INNER JOIN pasantias.especialidad 
		  	ON especialidad.id_especialidad = temporadas_especialidad.id_especialidad
		  INNER JOIN pasantias.tipo_especialidad
		  	ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad
		  INNER JOIN pasantias.persona ON persona.id_persona = persona_organizacion_oficina.id_persona JOIN pasantias.tipo_solicitud 
		  	ON temporadas_solicitud.id_tipo_solicitud = tipo_solicitud.id_tipo_solicitud 
		  INNER JOIN pasantias.periodo_solicitud 
		  	ON periodo_solicitud.id_periodo = temporadas_solicitud.id_periodo 
		  INNER JOIN pasantias.lapso_academico 
		  	ON lapso_academico.id_lapso = periodo_solicitud.id_lapso 
		  WHERE temporadas_especialidad.codigo_temporada_especialidad='$codigo_temporada_especialidad' ;");

			$fila = pg_fetch_assoc($sql);

			$Title='<h3>&nbsp; &nbsp; Reporte Emitido: &nbsp; <i>'.$fila['hoy'].'</i></h3>
			<font color="#0B3861" align="center"><h2>'.$nombre_title.'</h2></font>';
			$Temporada='<pre  style="	display: block; padding: 9.5px;margin: 0 0 10px;line-height: 1.42857143;color: #333;font-size: 35px;word-break: break-all;word-wrap: break-word;background-color: #f5f5f5;border: 1px solid #ccc;border-radius: 4px; overflow-x: auto; overflow-y: auto;">
				
			<strong>Persona Encargada :</strong> '.$fila['encargado'].'

			<strong>Tipo de Solicitud :</strong> '.$fila['nombre_tipo_solicitud'].'
			
			<strong>Estatus			  						:</strong> '.$fila['estatus'].'
			
			<strong>Periodo 		  						:</strong> '.$fila['periodo_solicitud'].'
			
			<strong>Lapso Académico	  :</strong> '.$fila['lapsoacademico'].'</pre>
			';
			return array('Encabezado'=>$Title.$Temporada , 'especialidad'=>$fila['especialidad']);
		}
		function sqlparaEspecialidades($codigo_temporada)
		{


			$sql=pg_query("SELECT persona.nombre || '  ' || persona.apellido as estudiante ,
					estudiante.expediente , persona.cedula ,
					 especialidad.nombre_especialidad || ' - '|| tipo_especialidad.nombre_tipo_especialidad as especialidad ,
					 especialidad.id_especialidad,
					 to_char(periodo_solicitud.fecha_inicio, 'DD, TMMonth YYYY')|| ' al ' ||to_char(periodo_solicitud.fecha_fin, 'DD, TMMonth YYYY') as periodo_solicitud,
					 lapso_academico.numero_lapso ||' :: '||
					 to_char(lapso_academico.ano_i, 'DD, TMMonth YYYY')|| ' al ' ||to_char(lapso_academico.ano_f, 'DD, TMMonth YYYY')
					 as lapsoacademico ,
					 tipo_solicitud.nombre_tipo_solicitud,
					 temporadas_solicitud.estatus
					
				FROM pasantias.temporadas_solicitud INNER JOIN pasantias.temporadas_especialidad
					ON temporadas_solicitud.codigo_temporada= temporadas_especialidad.codigo_temporada
				INNER JOIN pasantias.temporadas_estudiantes 
					ON temporadas_estudiantes.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
				INNER JOIN pasantias.estudiante 
					ON estudiante.codigo_estudiante=temporadas_estudiantes.codigo_estudiante
				INNER JOIN pasantias.especialidad
					ON  especialidad.id_especialidad= temporadas_especialidad.id_especialidad
				INNER JOIN pasantias.tipo_especialidad
					ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad
				INNER JOIN pasantias.persona_instituto_especialidad 
					ON persona_instituto_especialidad.id_persona = estudiante.id_persona
					AND persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
					AND persona_instituto_especialidad.id_ip = estudiante.id_ip
					AND persona_instituto_especialidad.id_perfil = estudiante.id_perfil
				INNER JOIN pasantias.persona
					ON persona.id_persona = persona_instituto_especialidad.id_persona
				INNER JOIN pasantias.especialidad_instituto_principal 
					ON especialidad_instituto_principal.id_especialidad = persona_instituto_especialidad.id_especialidad
					AND especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip
				INNER JOIN pasantias.perfil
					ON perfil.id_perfil= persona_instituto_especialidad.id_perfil
				INNER JOIN pasantias.instituto_principal 
					ON instituto_principal.id_ip = especialidad_instituto_principal.id_ip
					AND especialidad.id_especialidad = especialidad_instituto_principal.id_especialidad
				AND temporadas_solicitud.codigo_temporada='$codigo_temporada'
				INNER JOIN pasantias.tipo_solicitud
					ON tipo_solicitud .id_tipo_solicitud =temporadas_solicitud.id_tipo_solicitud
				INNER JOIN pasantias.periodo_solicitud 
					ON periodo_solicitud.id_periodo= temporadas_solicitud.id_periodo
				INNER JOIN pasantias.lapso_academico 
					ON lapso_academico.id_lapso = periodo_solicitud.id_lapso 
				ORDER BY tipo_especialidad.nombre_tipo_especialidad ,  especialidad.nombre_especialidad;");
			return $sql;
		}

		function GenerarReportedeEncargadodeInstituto($codigo_temporada)
		{	
			$html='';
			$sql = pg_query("SELECT nombre_entregable

				FROM pasantias.temporadas_solicitud 

				INNER JOIN pasantias.entregable_temporada 

					ON entregable_temporada.codigo_temporada = temporadas_solicitud.codigo_temporada

				INNER JOIN pasantias.entregable 

					ON entregable .id_entregable = entregable_temporada . id_entregable 

				WHERE temporadas_solicitud.codigo_temporada ='$codigo_temporada';");


			$html=$html.$this->EncabezadoReporte( $codigo_temporada  );
			$html=$html.$this->EntregablesTemporada($sql);
			$html=$html.$this->tablaReporteGeneral( $this->sqlparaEspecialidades($codigo_temporada),null );

			return ($html);
		}


		function EntregablesTemporada($sql)
		{	
			$html='';

				$html=$html.'<font color="#0B3861" align="center"><h2>Entregables</h2></font>

				<table border="" cellpadding="10" cellspacing=""  ><tr bgcolor="#0B3861">

				<td width="50"><font color="#FFFFFF" size="12"><b><center> # </center></b></font></td>

				<td width="660"><font color="#FFFFFF" size="12"><center><b> Nombre </b></center></font></td>

				</tr>';

			$i=0;
			while ($row = pg_fetch_array($sql)){
				
				if($i%2==0) $html=  $html.'<tr bgcolor="#E1F0FF">'; else $html=$html.'<tr>'; 
				
				$i++;
				$html = $html.'<td>';
				$html = $html. ' '.$i;
				$html = $html.'</td><td>';
				$html = $html. ' '.$row["nombre_entregable"];
				$html = $html.'</td></tr>';		

			}			
			 	$html=$html.'</table><h2></h2>';	

			return $html;
		}


		function Reporte_estudiantes_no_postuladosSQL($codigo_temporada_especialidad)
		{
			$sql = pg_query(" SELECT recibidas.*
						FROM (
			SELECT estudiante.expediente , persona.nombre ||'  '|| persona.apellido as estudiante,
					persona.cedula , estudiante.codigo_estudiante
			FROM pasantias.estudiante INNER JOIN pasantias.temporadas_estudiantes
				ON temporadas_estudiantes.codigo_estudiante = estudiante .codigo_estudiante
			INNER JOIN pasantias.temporadas_especialidad 
				ON temporadas_especialidad .codigo_temporada_especialidad = temporadas_estudiantes.codigo_temporada_especialidad
				AND temporadas_especialidad.codigo_temporada_especialidad='$codigo_temporada_especialidad'	
			INNER JOIN pasantias.persona_instituto_especialidad
				ON persona_instituto_especialidad.id_persona = estudiante.id_persona
				AND  persona_instituto_especialidad.id_ip = estudiante.id_ip
				AND  persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
				AND  persona_instituto_especialidad.id_perfil = estudiante.id_perfil
			INNER JOIN pasantias.especialidad_instituto_principal
				ON especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip
				AND especialidad_instituto_principal.id_especialidad = persona_instituto_especialidad.id_especialidad
			INNER JOIN pasantias.especialidad
				ON especialidad.id_especialidad = especialidad_instituto_principal.id_especialidad
				AND especialidad.id_especialidad = temporadas_especialidad.id_especialidad
			INNER JOIN pasantias.persona 
				ON persona.id_persona = persona_instituto_especialidad.id_persona	
			LEFT JOIN pasantias.solicitudes_enviadas
				ON solicitudes_enviadas .valor = estudiante.codigo_estudiante
				WHERE  solicitudes_enviadas .valor IS NULL ) as recibidas 

				LEFT JOIN pasantias.solicitudes_recibidas ON recibidas.codigo_estudiante = solicitudes_recibidas.valor
				WHERE solicitudes_recibidas.valor is null;");

				return $sql ;
		}

		function Reporte_estudiantes_postuladosSQL($codigo_temporada_especialidad)
		{
		$sql = pg_query("SELECT SucursalEnviada.* , organizacion.nombre_organizacion ,
			persona.nombre||' '|| persona.apellido as solicitant FROM  

		(SELECT estudianteSolicitud.*  ,solicitudes_enviadas.valor as sucursal FROM  

				( SELECT persona.nombre ||'  '|| persona.apellido as estudiante , persona.telefono
				,persona.correo , solicitud.codigo_solicitud ,estudiante.expediente ,persona.cedula 
				,   to_char(solicitud.fecha_solicitud, 'DD, TMMonth YYYY') as  fecha_solicitud
		FROM pasantias.encargado INNER JOIN pasantias.temporadas_solicitud 
			ON encargado.codigo_encargado =  temporadas_solicitud.codigo_encargado		
		INNER JOIN pasantias.temporadas_especialidad 
			ON temporadas_solicitud.codigo_temporada =temporadas_especialidad.codigo_temporada 
		INNER JOIN pasantias.solicitud 
			ON solicitud.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
		AND temporadas_especialidad.codigo_temporada_especialidad='$codigo_temporada_especialidad'
		INNER JOIN pasantias.solicitudes_recibidas 
			ON solicitudes_recibidas.codigo_solicitud = solicitud.codigo_solicitud 
		AND solicitudes_recibidas.estatus='EN ESPERA'
		INNER JOIN pasantias.estudiante 
			ON solicitudes_recibidas.valor = estudiante.codigo_estudiante 
		INNER JOIN pasantias.temporadas_estudiantes 
			ON temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante 
		AND temporadas_estudiantes.codigo_temporada_especialidad=temporadas_especialidad.codigo_temporada_especialidad
		INNER JOIN pasantias.persona_instituto_especialidad 
			ON persona_instituto_especialidad.id_persona = estudiante.id_persona
		AND persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
		AND persona_instituto_especialidad.id_ip = estudiante.id_ip
		AND persona_instituto_especialidad.id_perfil = estudiante.id_perfil
		INNER JOIN pasantias.persona ON persona.id_persona =persona_instituto_especialidad.id_persona ) as estudianteSolicitud
		INNER JOIN pasantias.solicitudes_enviadas 
			ON estudianteSolicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud
		AND solicitudes_enviadas.table_column='organizacionmunicipio.codigo_sucursal') as SucursalEnviada
		INNER JOIN pasantias.solicitudes_enviadas 
			ON SucursalEnviada.codigo_solicitud =solicitudes_enviadas.codigo_solicitud
		AND solicitudes_enviadas.table_column='persona.id_persona'
		INNER JOIN pasantias.organizacionmunicipio 
		ON organizacionmunicipio.codigo_sucursal = SucursalEnviada.sucursal
		INNER JOIN pasantias.organizacion 
		ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
		INNER JOIN pasantias.persona_organizacion_oficina 
		ON persona_organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
		INNER JOIN pasantias.persona 
		ON persona.id_persona = persona_organizacion_oficina.id_persona 
		AND persona.id_persona = CAST (solicitudes_enviadas.valor as BIGINT)

		UNION
		
				SELECT estudianteSolicitant.* ,organizacionmunicipio.codigo_sucursal as sucursal,
		organizacion.nombre_organizacion , 'ESTUDIANTE' as solicitant

		FROM ( SELECT persona.nombre ||'  '|| persona.apellido as estudiante , persona.telefono
				,persona.correo , solicitud.codigo_solicitud ,estudiante.expediente ,persona.cedula ,
				to_char(solicitud.fecha_solicitud, 'DD, TMMonth YYYY') as  fecha_solicitud 
		FROM pasantias.encargado INNER JOIN pasantias.temporadas_solicitud 
			ON encargado.codigo_encargado =  temporadas_solicitud.codigo_encargado		
		INNER JOIN pasantias.temporadas_especialidad 
			ON temporadas_solicitud.codigo_temporada =temporadas_especialidad.codigo_temporada 
		INNER JOIN pasantias.solicitud 
			ON solicitud.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
		AND temporadas_especialidad.codigo_temporada_especialidad='$codigo_temporada_especialidad'
		INNER JOIN pasantias.solicitudes_enviadas 
			ON solicitudes_enviadas.codigo_solicitud = solicitud.codigo_solicitud 
		AND solicitudes_enviadas.estatus='MOSTRAR'
		INNER JOIN pasantias.estudiante 
			ON solicitudes_enviadas.valor = estudiante.codigo_estudiante 
		INNER JOIN pasantias.temporadas_estudiantes 
			ON temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante 
		AND temporadas_estudiantes.codigo_temporada_especialidad=temporadas_especialidad.codigo_temporada_especialidad
		INNER JOIN pasantias.persona_instituto_especialidad 
			ON persona_instituto_especialidad.id_persona = estudiante.id_persona
		AND persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
		AND persona_instituto_especialidad.id_ip = estudiante.id_ip
		AND persona_instituto_especialidad.id_perfil = estudiante.id_perfil
		INNER JOIN pasantias.persona ON persona.id_persona =persona_instituto_especialidad.id_persona ) as estudianteSolicitant

		INNER JOIN pasantias.solicitudes_recibidas 
			ON estudianteSolicitant.codigo_solicitud =solicitudes_recibidas.codigo_solicitud
			AND solicitudes_recibidas.table_column='organizacionmunicipio.codigo_sucursal'
			AND solicitudes_recibidas.estatus='EN ESPERA'
		INNER JOIN pasantias.organizacionmunicipio 
		ON organizacionmunicipio.codigo_sucursal = solicitudes_recibidas.valor
		INNER JOIN pasantias.organizacion 
		ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion;");
		return $sql ;
		}
		function Reporte_estudiantes_AprobadosSQL($codigo_temporada_especialidad)
		{

		$sql = pg_query("SELECT SucursalEnviada.* , organizacion.nombre_organizacion ,
		   estado.nombre_estado , municipio.nombre_municipio , organizacionmunicipio.domicilio , 0 as cero 
			, persona.nombre||' '|| persona.apellido as solicitant

		 FROM  (SELECT estudianteSolicitud.*  ,solicitudes_enviadas.valor as sucursal FROM  

		( SELECT persona.nombre ||'  '|| persona.apellido as estudiante , persona.telefono
				,persona.correo , solicitud.codigo_solicitud , estudiante.expediente , persona.cedula,
				estudiante.codigo_estudiante ,
				to_char( solicitud.fecha_solicitud, 'TMDay DD, TMMonth YYYY') as f_solicitud ,to_char(solicitudes_recibidas.fecha_postulacion, 'TMDay DD, TMMonth YYYY') as f_postulacion

		FROM pasantias.encargado INNER JOIN pasantias.temporadas_solicitud 
		ON encargado.codigo_encargado = temporadas_solicitud.codigo_encargado		
		INNER JOIN pasantias.temporadas_especialidad 
		ON temporadas_solicitud.codigo_temporada =temporadas_especialidad.codigo_temporada 
		INNER JOIN pasantias.solicitud 
		ON solicitud.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
		AND temporadas_especialidad.codigo_temporada_especialidad='$codigo_temporada_especialidad'
		INNER JOIN pasantias.solicitudes_recibidas 
		ON solicitudes_recibidas.codigo_solicitud = solicitud.codigo_solicitud 
		AND solicitudes_recibidas.estatus='APROBADO ORGANIZACION'
		INNER JOIN pasantias.estudiante 
		ON solicitudes_recibidas.valor = estudiante.codigo_estudiante 
		INNER JOIN pasantias.temporadas_estudiantes 
		ON temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante 
		AND temporadas_estudiantes.codigo_temporada_especialidad=temporadas_especialidad.codigo_temporada_especialidad
		INNER JOIN pasantias.persona_instituto_especialidad 
		ON persona_instituto_especialidad.id_persona = estudiante.id_persona
		AND persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
		AND persona_instituto_especialidad.id_ip = estudiante.id_ip
		AND persona_instituto_especialidad.id_perfil = estudiante.id_perfil
		INNER JOIN pasantias.persona ON persona.id_persona =persona_instituto_especialidad.id_persona ) as estudianteSolicitud
		INNER JOIN pasantias.solicitudes_enviadas 
		ON estudianteSolicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud
		AND solicitudes_enviadas.table_column='organizacionmunicipio.codigo_sucursal') as SucursalEnviada
		INNER JOIN pasantias.solicitudes_enviadas 
		ON SucursalEnviada.codigo_solicitud =solicitudes_enviadas.codigo_solicitud
		AND solicitudes_enviadas.table_column='persona.id_persona'
		INNER JOIN pasantias.organizacionmunicipio 
		ON organizacionmunicipio.codigo_sucursal = SucursalEnviada.sucursal
		INNER JOIN pasantias.organizacion 
		ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion	
		INNER JOIN pasantias.persona_organizacion_oficina 
		ON persona_organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
		INNER JOIN pasantias.municipio 
		ON municipio.id_municipio = organizacionmunicipio.id_municipio
		INNER JOIN pasantias.estado
		ON estado.id_estado = municipio.id_estado
		INNER JOIN pasantias.persona 
		ON persona.id_persona = persona_organizacion_oficina.id_persona 
		AND persona.id_persona = CAST (solicitudes_enviadas.valor as BIGINT)

		UNION 
		SELECT  postulacionDirecta.estudiante , postulacionDirecta.telefono ,
       			postulacionDirecta.correo , postulacionDirecta.codigo_solicitud,
       			postulacionDirecta.expediente , postulacionDirecta.cedula ,
        postulacionDirecta.codigo_estudiante, postulacionDirecta.f_solicitud , to_char(  solicitudes_recibidas.fecha_postulacion, 'TMDay DD, TMMonth YYYY') as f_postulacion , organizacionmunicipio.codigo_sucursal as sucursal ,
        organizacion.nombre_organizacion , estado.nombre_estado , municipio.nombre_municipio , organizacionmunicipio.domicilio ,
         12 as cero , 'ESTUDIANTE' as solicitant
         FROM   

		( SELECT persona.nombre ||'  '|| persona.apellido as estudiante , persona.telefono
				,persona.correo , solicitud.codigo_solicitud , persona.cedula ,  estudiante.expediente,
				estudiante.codigo_estudiante , to_char( solicitud.fecha_solicitud, 'TMDay DD, TMMonth YYYY') as f_solicitud 
		FROM pasantias.encargado INNER JOIN pasantias.temporadas_solicitud 
			ON encargado.codigo_encargado =  temporadas_solicitud.codigo_encargado		
		INNER JOIN pasantias.temporadas_especialidad 
			ON temporadas_solicitud.codigo_temporada =temporadas_especialidad.codigo_temporada 
		INNER JOIN pasantias.solicitud 
			ON solicitud.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
			AND temporadas_especialidad.codigo_temporada_especialidad='$codigo_temporada_especialidad'
		INNER JOIN pasantias.solicitudes_enviadas 
			ON solicitudes_enviadas.codigo_solicitud = solicitud.codigo_solicitud 
		INNER JOIN pasantias.estudiante 
			ON solicitudes_enviadas.valor = estudiante.codigo_estudiante 
		INNER JOIN pasantias.temporadas_estudiantes 
			ON temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante 
			AND temporadas_estudiantes.codigo_temporada_especialidad=temporadas_especialidad.codigo_temporada_especialidad
		INNER JOIN pasantias.persona_instituto_especialidad 
			ON persona_instituto_especialidad.id_persona = estudiante.id_persona
			AND persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
			AND persona_instituto_especialidad.id_ip = estudiante.id_ip
			AND persona_instituto_especialidad.id_perfil = estudiante.id_perfil
		INNER JOIN pasantias.persona 
			ON persona.id_persona =persona_instituto_especialidad.id_persona 
			AND solicitudes_enviadas.table_column='estudiante.codigo_estudiante'
		INNER JOIN pasantias.instituto_principal
			ON instituto_principal .id_ip = persona_instituto_especialidad.id_ip 
		INNER JOIN pasantias.organizacion 
			ON organizacion.id_organizacion = instituto_principal.id_organizacion
		INNER JOIN pasantias.convenio_organizacion 
			ON convenio_organizacion.id_ip = instituto_principal.id_ip
		INNER JOIN pasantias.organizacionmunicipio
			ON organizacionmunicipio.id_organizacion=organizacion.id_organizacion
		INNER JOIN pasantias.persona_organizacion_oficina 
			ON persona_organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
			AND encargado .id_persona = persona_organizacion_oficina.id_persona
			AND encargado .codigo_sucursal = persona_organizacion_oficina.codigo_sucursal
			AND encargado .id_perfil = persona_organizacion_oficina.id_perfil
			AND encargado .id_oficina = persona_organizacion_oficina.id_oficina
		) as postulacionDirecta
		INNER JOIN pasantias.solicitudes_recibidas 
			ON postulacionDirecta.codigo_solicitud =solicitudes_recibidas.codigo_solicitud
			AND solicitudes_recibidas.table_column='organizacionmunicipio.codigo_sucursal'
			AND solicitudes_recibidas.estatus='APROBADO ORGANIZACION'
		INNER JOIN pasantias.persona_organizacion_oficina
			ON persona_organizacion_oficina.codigo_sucursal = solicitudes_recibidas.valor
		INNER JOIN pasantias.organizacionmunicipio
			ON organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal
		INNER JOIN pasantias.organizacion 
			ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
		INNER JOIN pasantias.municipio 
			ON municipio.id_municipio = organizacionmunicipio.id_municipio
		INNER JOIN pasantias.estado
			ON estado.id_estado = municipio.id_estado
		INNER JOIN pasantias.convenio_organizacion
			ON convenio_organizacion.id_organizacion=organizacion.id_organizacion

		GROUP BY postulacionDirecta.estudiante , postulacionDirecta.telefono ,
		postulacionDirecta.cedula ,postulacionDirecta.expediente , postulacionDirecta.codigo_solicitud,
		postulacionDirecta.correo , sucursal ,postulacionDirecta.codigo_estudiante, organizacion.nombre_organizacion,
		estado.nombre_estado , municipio.nombre_municipio , organizacionmunicipio.domicilio , f_solicitud , f_postulacion");
		return  $sql ;


		}

		function Reporte_estudiantes_sin_tutoresSQL($codigo_temporada_especialidad)
		{
$sql =pg_query("SELECT sqlsucursal.* , persona.nombre||' '|| persona.apellido as solicitant
		
	FROM ( 	SELECT solicitudes_aprobadas.codigo_solicitud , persona.nombre ||' '|| persona.apellido as estudiante ,
	
	persona.correo , persona.telefono , estudiante.expediente ,cedula ,organizacion.nombre_organizacion, 
	
	organizacionmunicipio.codigo_sucursal as sucursal , estado.nombre_estado , municipio.nombre_municipio , organizacionmunicipio.domicilio,
	
	to_char( solicitud.fecha_solicitud, 'TMDay DD, TMMonth YYYY') as fecha_solicitud ,
	
	to_char( solicitudes_aprobadas.fecha_aprobacion, 'TMDay DD, TMMonth YYYY') as fecha_aprobacion ,
	
	to_char( solicitudes_recibidas.fecha_postulacion, 'TMDay DD, TMMonth YYYY')  as fecha_postulacion 

			FROM pasantias.solicitudes_aprobadas 
			INNER JOIN pasantias.solicitud 
				ON solicitudes_aprobadas.codigo_solicitud = solicitud.codigo_solicitud 
			INNER JOIN pasantias.temporadas_especialidad
				ON solicitud .codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
				AND solicitud.codigo_temporada_especialidad = '$codigo_temporada_especialidad' 
			INNER JOIN pasantias.estudiante
				ON estudiante.codigo_estudiante = solicitudes_aprobadas.valor 
			INNER JOIN pasantias.persona_instituto_especialidad
				ON persona_instituto_especialidad.id_persona = estudiante.id_persona
				AND persona_instituto_especialidad.id_ip = estudiante.id_ip
				AND persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
				ANd persona_instituto_especialidad.id_perfil = estudiante.id_perfil
			INNER JOIN pasantias.especialidad 
				ON especialidad.id_especialidad = persona_instituto_especialidad.id_especialidad
			INNER JOIN pasantias.instituto_principal
				ON instituto_principal.id_ip = persona_instituto_especialidad.id_ip
			INNER JOIN pasantias.especialidad_instituto_principal
				On instituto_principal.id_ip = especialidad_instituto_principal.id_ip
			INNER JOIN pasantias.persona
				ON persona.id_persona = persona_instituto_especialidad.id_persona
			INNER JOIN pasantias.solicitudes_recibidas 
				ON solicitudes_recibidas.codigo_solicitud = solicitud.codigo_solicitud
				AND solicitudes_recibidas.table_column='estudiante.codigo_estudiante'
			INNER JOIN pasantias.solicitudes_enviadas
				ON solicitudes_enviadas.codigo_solicitud = solicitud.codigo_solicitud
				AND solicitudes_enviadas.table_column = 'organizacionmunicipio.codigo_sucursal'
			INNER JOIN pasantias.organizacionmunicipio
				ON organizacionmunicipio.codigo_sucursal = solicitudes_enviadas.valor
			INNER JOIN pasantias.organizacion 
				ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
			INNER JOIN pasantias.municipio
				ON municipio.id_municipio = organizacionmunicipio.id_municipio
			INNER JOIN pasantias.estado
				ON estado.id_estado = municipio.id_estado
			LEFT JOIN pasantias.responsables
				ON responsables.codigo_solicitud = solicitud.codigo_solicitud
				AND responsables.table_column = 'tutor_academico.codigo_tutor_academico'
			WHERE responsables.codigo_solicitud IS NULL 
			GROUP BY solicitudes_aprobadas.codigo_solicitud ,estudiante ,persona.correo , 
			persona.telefono ,estudiante.expediente,persona.cedula ,organizacion.nombre_organizacion
			,sucursal, estado.nombre_estado , municipio.nombre_municipio , organizacionmunicipio.domicilio,
			solicitud.fecha_solicitud , solicitudes_aprobadas.fecha_aprobacion , solicitudes_recibidas.fecha_postulacion  ) as sqlsucursal
			
			INNER JOIN pasantias.solicitudes_enviadas 
				ON sqlsucursal.codigo_solicitud =solicitudes_enviadas.codigo_solicitud
			AND solicitudes_enviadas.table_column='persona.id_persona'
			INNER JOIN pasantias.organizacionmunicipio 
			ON organizacionmunicipio.codigo_sucursal = sqlsucursal.sucursal
			INNER JOIN pasantias.organizacion 
			ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
			INNER JOIN pasantias.persona_organizacion_oficina 
			ON persona_organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
			INNER JOIN pasantias.persona 
			ON persona.id_persona = persona_organizacion_oficina.id_persona 
			AND persona.id_persona = CAST (solicitudes_enviadas.valor as BIGINT)

			UNION 
			SELECT solicitudes_aprobadas.codigo_solicitud , persona.nombre ||' '|| persona.apellido as estudiante ,
			
			persona.correo , persona.telefono , estudiante.expediente ,cedula ,organizacion.nombre_organizacion,
			
			organizacionmunicipio.codigo_sucursal as sucursal , estado.nombre_estado , municipio.nombre_municipio , organizacionmunicipio.domicilio,
			
			to_char( solicitud.fecha_solicitud, 'TMDay DD, TMMonth YYYY') as fecha_solicitud ,
			
			to_char( solicitudes_aprobadas.fecha_aprobacion, 'TMDay DD, TMMonth YYYY') as fecha_aprobacion ,
			
			to_char( solicitudes_recibidas.fecha_postulacion, 'TMDay DD, TMMonth YYYY')  as fecha_postulacion ,
			
			'ESTUDIANTE' as solicitant
			
			FROM pasantias.solicitudes_aprobadas 
			INNER JOIN pasantias.solicitud 
				ON solicitudes_aprobadas.codigo_solicitud = solicitud.codigo_solicitud 
			INNER JOIN pasantias.temporadas_especialidad
				ON solicitud .codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
				AND solicitud.codigo_temporada_especialidad = '$codigo_temporada_especialidad' 
			INNER JOIN pasantias.estudiante
				ON estudiante.codigo_estudiante = solicitudes_aprobadas.valor 
			INNER JOIN pasantias.persona_instituto_especialidad
				ON persona_instituto_especialidad.id_persona = estudiante.id_persona
				AND persona_instituto_especialidad.id_ip = estudiante.id_ip
				AND persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
				ANd persona_instituto_especialidad.id_perfil = estudiante.id_perfil
			INNER JOIN pasantias.especialidad 
				ON especialidad.id_especialidad = persona_instituto_especialidad.id_especialidad
			INNER JOIN pasantias.instituto_principal
				ON instituto_principal.id_ip = persona_instituto_especialidad.id_ip
			INNER JOIN pasantias.especialidad_instituto_principal
				On instituto_principal.id_ip = especialidad_instituto_principal.id_ip
			INNER JOIN pasantias.persona
				ON persona.id_persona = persona_instituto_especialidad.id_persona
			INNER JOIN pasantias.solicitudes_enviadas 
				ON solicitudes_enviadas.codigo_solicitud = solicitud.codigo_solicitud
				AND solicitudes_enviadas.table_column='estudiante.codigo_estudiante'
			INNER JOIN pasantias.solicitudes_recibidas
				ON solicitudes_recibidas.codigo_solicitud = solicitud.codigo_solicitud
				AND solicitudes_recibidas.table_column = 'organizacionmunicipio.codigo_sucursal'
			INNER JOIN pasantias.organizacionmunicipio
				ON organizacionmunicipio.codigo_sucursal = solicitudes_recibidas.valor
			INNER JOIN pasantias.organizacion 
				ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
			INNER JOIN pasantias.municipio
				ON municipio.id_municipio = organizacionmunicipio.id_municipio
			INNER JOIN pasantias.estado
				ON estado.id_estado = municipio.id_estado
			LEFT JOIN pasantias.responsables
				ON responsables.codigo_solicitud = solicitud.codigo_solicitud
				AND responsables.table_column = 'tutor_academico.codigo_tutor_academico'
			WHERE responsables.codigo_solicitud IS NULL 
			GROUP BY solicitudes_aprobadas.codigo_solicitud ,estudiante ,persona.correo , 
			persona.telefono ,estudiante.expediente,persona.cedula ,organizacion.nombre_organizacion,
			sucursal , estado.nombre_estado , municipio.nombre_municipio , organizacionmunicipio.domicilio,
			solicitud.fecha_solicitud , solicitudes_aprobadas.fecha_aprobacion , solicitudes_recibidas.fecha_postulacion, solicitant;");

		return $sql;
		}
		function Reporte_estudiantes_con_tutoresSQL($codigo_temporada_especialidad)
		{
			$sql =pg_query(" SELECT Estudiantes.* ,persona .nombre || '  -  ' || persona. apellido as tutor_academico  

		 FROM ( SELECT solicitudes_aprobadas.codigo_solicitud , persona.nombre ||' '|| persona.apellido as estudiante ,
	estudiante.expediente ,cedula ,organizacion.nombre_organizacion, 
	 organizacionmunicipio.codigo_sucursal as sucursal  , responsables.valor
			FROM pasantias.solicitudes_aprobadas 
			INNER JOIN pasantias.solicitud 
				ON solicitudes_aprobadas.codigo_solicitud = solicitud.codigo_solicitud 
			INNER JOIN pasantias.temporadas_especialidad
				ON solicitud .codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
				AND solicitud.codigo_temporada_especialidad = '$codigo_temporada_especialidad' 
			INNER JOIN pasantias.estudiante
				ON estudiante.codigo_estudiante = solicitudes_aprobadas.valor 
			INNER JOIN pasantias.persona_instituto_especialidad
				ON persona_instituto_especialidad.id_persona = estudiante.id_persona
				AND persona_instituto_especialidad.id_ip = estudiante.id_ip
				AND persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
				ANd persona_instituto_especialidad.id_perfil = estudiante.id_perfil
			INNER JOIN pasantias.especialidad 
				ON especialidad.id_especialidad = persona_instituto_especialidad.id_especialidad
			INNER JOIN pasantias.instituto_principal
				ON instituto_principal.id_ip = persona_instituto_especialidad.id_ip
			INNER JOIN pasantias.especialidad_instituto_principal
				On instituto_principal.id_ip = especialidad_instituto_principal.id_ip
			INNER JOIN pasantias.persona
				ON persona.id_persona = persona_instituto_especialidad.id_persona
			INNER JOIN pasantias.solicitudes_recibidas 
				ON solicitudes_recibidas.codigo_solicitud = solicitud.codigo_solicitud
				AND solicitudes_recibidas.table_column='estudiante.codigo_estudiante'
			INNER JOIN pasantias.solicitudes_enviadas
				ON solicitudes_enviadas.codigo_solicitud = solicitud.codigo_solicitud
				AND solicitudes_enviadas.table_column = 'organizacionmunicipio.codigo_sucursal'
			INNER JOIN pasantias.organizacionmunicipio
				ON organizacionmunicipio.codigo_sucursal = solicitudes_enviadas.valor
			INNER JOIN pasantias.organizacion 
				ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
			LEFT JOIN pasantias.responsables
				ON responsables.codigo_solicitud = solicitud.codigo_solicitud
				AND responsables.table_column = 'tutor_academico.codigo_tutor_academico'
			WHERE responsables.codigo_solicitud IS NOT NULL 
			GROUP BY solicitudes_aprobadas.codigo_solicitud ,estudiante ,estudiante.expediente,persona.cedula ,organizacion.nombre_organizacion
		 	,sucursal , responsables.valor) as Estudiantes --,
	  	 INNER JOIN pasantias.tutor_academico 
	  	 ON Estudiantes.valor  = tutor_academico.codigo_tutor_academico

 		INNER JOIN pasantias.persona_instituto_especialidad
			ON persona_instituto_especialidad.id_persona = tutor_academico.id_persona
			AND persona_instituto_especialidad.id_ip = tutor_academico.id_ip
			AND persona_instituto_especialidad.id_especialidad = tutor_academico.id_especialidad
			AND persona_instituto_especialidad.id_perfil = tutor_academico.id_perfil
		INNER JOIN pasantias.especialidad_instituto_principal 
			On especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip
			AND especialidad_instituto_principal.id_especialidad= persona_instituto_especialidad.id_especialidad
		INNER JOIN pasantias.especialidad
			ON especialidad.id_especialidad = especialidad_instituto_principal.id_especialidad	
			AND especialidad.id_especialidad = persona_instituto_especialidad.id_especialidad
		INNER JOIN pasantias.instituto_principal 
			
			ON instituto_principal.id_ip = especialidad_instituto_principal.id_ip
			AND instituto_principal.id_ip = persona_instituto_especialidad.id_ip
		INNER JOIN pasantias.persona
			ON persona . id_persona =  persona_instituto_especialidad . id_persona 	

			UNION 
			SELECT Estudiantes .*   ,persona .nombre || '  -  ' || persona. apellido as tutor_academico 
			from (
			SELECT solicitudes_aprobadas.codigo_solicitud , persona.nombre ||' '|| persona.apellido as estudiante ,
			estudiante.expediente ,cedula ,organizacion.nombre_organizacion,
			organizacionmunicipio.codigo_sucursal as sucursal , responsables.valor 
			FROM pasantias.solicitudes_aprobadas 
			INNER JOIN pasantias.solicitud 
				ON solicitudes_aprobadas.codigo_solicitud = solicitud.codigo_solicitud 
			INNER JOIN pasantias.temporadas_especialidad
				ON solicitud .codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
				AND solicitud.codigo_temporada_especialidad = '$codigo_temporada_especialidad' 
			INNER JOIN pasantias.estudiante
				ON estudiante.codigo_estudiante = solicitudes_aprobadas.valor 
			INNER JOIN pasantias.persona_instituto_especialidad
				ON persona_instituto_especialidad.id_persona = estudiante.id_persona
				AND persona_instituto_especialidad.id_ip = estudiante.id_ip
				AND persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
				ANd persona_instituto_especialidad.id_perfil = estudiante.id_perfil
			INNER JOIN pasantias.especialidad 
				ON especialidad.id_especialidad = persona_instituto_especialidad.id_especialidad
			INNER JOIN pasantias.instituto_principal
				ON instituto_principal.id_ip = persona_instituto_especialidad.id_ip
			INNER JOIN pasantias.especialidad_instituto_principal
				On instituto_principal.id_ip = especialidad_instituto_principal.id_ip
			INNER JOIN pasantias.persona
				ON persona.id_persona = persona_instituto_especialidad.id_persona
			INNER JOIN pasantias.solicitudes_enviadas 
				ON solicitudes_enviadas.codigo_solicitud = solicitud.codigo_solicitud
				AND solicitudes_enviadas.table_column='estudiante.codigo_estudiante'
			INNER JOIN pasantias.solicitudes_recibidas
				ON solicitudes_recibidas.codigo_solicitud = solicitud.codigo_solicitud
				AND solicitudes_recibidas.table_column = 'organizacionmunicipio.codigo_sucursal'
			INNER JOIN pasantias.organizacionmunicipio
				ON organizacionmunicipio.codigo_sucursal = solicitudes_recibidas.valor
			INNER JOIN pasantias.organizacion 
				ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
			LEFT JOIN pasantias.responsables
				ON responsables.codigo_solicitud = solicitud.codigo_solicitud
				AND responsables.table_column = 'tutor_academico.codigo_tutor_academico'
			WHERE responsables.codigo_solicitud IS NOT NULL 
			GROUP BY solicitudes_aprobadas.codigo_solicitud ,estudiante ,estudiante.expediente,persona.cedula ,organizacion.nombre_organizacion
			,sucursal , responsables.valor ) as Estudiantes 
	  	 INNER JOIN pasantias.tutor_academico 
	  	 ON Estudiantes.valor  = tutor_academico.codigo_tutor_academico

 		INNER JOIN pasantias.persona_instituto_especialidad
			ON persona_instituto_especialidad.id_persona = tutor_academico.id_persona
			AND persona_instituto_especialidad.id_ip = tutor_academico.id_ip
			AND persona_instituto_especialidad.id_especialidad = tutor_academico.id_especialidad
			AND persona_instituto_especialidad.id_perfil = tutor_academico.id_perfil
		INNER JOIN pasantias.especialidad_instituto_principal 
			On especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip
			AND especialidad_instituto_principal.id_especialidad= persona_instituto_especialidad.id_especialidad
		INNER JOIN pasantias.especialidad
			ON especialidad.id_especialidad = especialidad_instituto_principal.id_especialidad	
			AND especialidad.id_especialidad = persona_instituto_especialidad.id_especialidad
		INNER JOIN pasantias.instituto_principal 
			
			ON instituto_principal.id_ip = especialidad_instituto_principal.id_ip
			AND instituto_principal.id_ip = persona_instituto_especialidad.id_ip
		INNER JOIN pasantias.persona
			ON persona . id_persona =  persona_instituto_especialidad . id_persona 
			;");

		return $sql;
		}

		function GenerarReportedeEstudiantes_noPostulados($codigo_temporada_especialidad)
		{
			$html='';

			$Result=$this->EncabezadoReporteNombreDinamic( $codigo_temporada_especialidad , 'Estudiantes No Postulados' );
			$html=$html.$Result['Encabezado'];
			$i=0;

			  $sql =$this-> Reporte_estudiantes_no_postuladosSQL($codigo_temporada_especialidad);
			  $html=$html.'<font color="#0B3861" align="center"><h2>Estudiantes : '. $Result['especialidad'].'</h2></font>';
			$html=$html.'<div align="center">			
				<table cellpadding="10"><tr bgcolor="#0B3861" >

				<td width="50"><font color="#FFFFFF" size="12"><b> # </b></font></td>

				<td width="308"><font color="#FFFFFF" size="12"><b> Estudiante </b></font></td>

				<td width="150"><font color="#FFFFFF" size="12"><b> Expediente </b></font></td>
				
				<td width="200"><font color="#FFFFFF" size="12"><b> Cédula </b></font></td>
				
				</tr>';

				$i=1;
				
				while ($row = pg_fetch_array($sql)){

				$i=$i-1;
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$i=$i+1;
				$html = $html.'<td>';
				$html = $html. $i;
				$html = $html.'</td><td>';
				$html = $html. $row["estudiante"];
				$html = $html.'</td><td>';
				$html = $html. $row["expediente"];
				$html = $html.'</td><td>';
				$html = $html. $row["cedula"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}

		function GenerarReportedeEstudiantes_Con_tutores($codigo_temporada_especialidad)
		{
			$html='';

			$Result=$this->EncabezadoReporteNombreDinamic( $codigo_temporada_especialidad , 'Estudiantes Con Tutores' );
			$html=$html.$Result['Encabezado'];
			$i=0;

			  $sql =$this-> Reporte_estudiantes_con_tutoresSQL($codigo_temporada_especialidad);
			  $html=$html.'<font color="#0B3861" align="center"><h2>Estudiantes : '. $Result['especialidad'].'</h2></font>';
			$html=$html.'<div align="center">			
				<table cellpadding="10"><tr bgcolor="#0B3861" >

				<td width="50"><font color="#FFFFFF" size="12"><b> # </b></font></td>

				<td width="200"><font color="#FFFFFF" size="12"><b> Estudiante </b></font></td>

				<td width="150"><font color="#FFFFFF" size="12"><b> Expediente </b></font></td>
				
				<td width="200"><font color="#FFFFFF" size="12"><b> Cédula </b></font></td>

				<td width="200"><font color="#FFFFFF" size="12"><b> Tutor Académico </b></font></td>

				<td width="210"><font color="#FFFFFF" size="12"><b> Organización </b></font></td>
				
				</tr>';

				$i=1;
				
				while ($row = pg_fetch_array($sql)){

				$i=$i-1;
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$i=$i+1;
				$html = $html.'<td>';
				$html = $html. $i;
				$html = $html.'</td><td>';
				$html = $html. $row["estudiante"];
				$html = $html.'</td><td>';
				$html = $html. $row["expediente"];
				$html = $html.'</td><td>';
				$html = $html. $row["cedula"];
				$html = $html.'</td><td>';
				$html = $html. $row["tutor_academico"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_organizacion"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}

		function GenerarReportedeEstudiantes_Postulados($codigo_temporada_especialidad)
		{


			$html='';

			$Result=$this->EncabezadoReporteNombreDinamic( $codigo_temporada_especialidad , 'Estudiantes Postulados' );
			$html=$html.$Result['Encabezado'];
			$i=0;

			  $sql =$this->Reporte_estudiantes_postuladosSQL($codigo_temporada_especialidad);
			  $html=$html.'<font color="#0B3861" align="center"><h2>Estudiantes : '. $Result['especialidad'].'</h2></font>';
			$html=$html.'<div align="center">			
				<table cellpadding="10"><tr bgcolor="#0B3861" >

				<td width="50"><font color="#FFFFFF" size="12"><b> # </b></font></td>

				<td width="200"><font color="#FFFFFF" size="12"><b> Estudiante </b></font></td>

				<td width="150"><font color="#FFFFFF" size="12"><b> Expediente </b></font></td>
				
				<td width="200"><font color="#FFFFFF" size="12"><b> Cédula </b></font></td>

				<td width="210"><font color="#FFFFFF" size="12"><b> Organización </b></font></td>

				<td width="210"><font color="#FFFFFF" size="12"><b> Fecha P. </b></font></td>
				
				</tr>';

				$i=1;
				
				while ($row = pg_fetch_array($sql)){

				$i=$i-1;
				if($i%2==0){
					$html=  $html.'<tr bgcolor="#E1F0FF">';
				}else{
					$html=$html.'<tr>';
				}
				$i=$i+1;
				$html = $html.'<td>';
				$html = $html. $i;
				$html = $html.'</td><td>';
				$html = $html. $row["estudiante"];
				$html = $html.'</td><td>';
				$html = $html. $row["expediente"];
				$html = $html.'</td><td>';
				$html = $html. $row["cedula"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_organizacion"];
				$html = $html.'</td><td>';
				$html = $html. $row["fecha_solicitud"];
				$html = $html.'</td></tr>';		
				$i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}


		function GenerarReportedeEstudiantes_Aprobados( $codigo_temporada_especialidad )
		{

			$html='';


			$i=0;

			  $sql =$this->Reporte_estudiantes_AprobadosSQL($codigo_temporada_especialidad);
			  
				$estudiante='<div align="center">	

				<table cellpadding="5" ><tr  bgcolor="#0B3861" >

				<td width="48"><font color="#FFFFFF" size="12"><b>#</b></font></td>
				<td width="200"><font color="#FFFFFF" size="12"><b> Estudiante </b></font></td>

				<td width="120"><font color="#FFFFFF" size="12"><b> Expediente </b></font></td>
				
				<td width="180"><font color="#FFFFFF" size="12"><b> Cédula </b></font></td>

				<td width="150"><font color="#FFFFFF" size="12"><b> Teléfono </b></font></td>

				</tr>';

				$organizacion = '<tr bgcolor="#0B3861" >

				<td width="200"><font color="#FFFFFF" size="12"><b> Organización </b></font></td>

				<td width="110"><font color="#FFFFFF" size="12"><b> Estado </b></font></td>
				
				<td width="170"><font color="#FFFFFF" size="12"><b> Municipio </b></font></td>

				<td width="170"><font color="#FFFFFF" size="12"><b> Dirección </b></font></td>

				</tr>';

 				$solicitud = '<tr bgcolor="#0B3861" >

				<td width="200"><font color="#FFFFFF" size="12"><b>Fecha Solicitud</b></font></td>

				<td width="200"><font color="#FFFFFF" size="12"><b>Fecha Postulación</b></font></td>
				
				<td width="250"><font color="#FFFFFF" size="12"><b>Realizada por</b></font></td>

				</tr>';				

				$i=1;
				
				$tr=  '<tr bgcolor="#E1F0FF">';
				
				
				while ($row = pg_fetch_array($sql)){
				$html = $html. $estudiante;	
				

				//--- DATOS Estudiante
				$html = $html.$tr.'<td rowspan="5">';
				$html = $html. $i;
				$html = $html.'</td><td>';
				$html = $html. $row["estudiante"];
				$html = $html.'</td><td>';
				$html = $html. $row["expediente"];
				$html = $html.'</td><td>';
				$html = $html. $row["cedula"];
				$html = $html.'</td><td>';
				$html = $html. $row["telefono"];
				$html = $html.'</td></tr>';	
				
				//--- DATOS ORGANIZACION
				$html = $html.$organizacion;

						
				$html = $html.$tr.'<td>';
				$html = $html. $row["nombre_organizacion"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_estado"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_municipio"];
				$html = $html.'</td><td>';
				$html = $html. $row["domicilio"];
				$html = $html.'</td></tr>';	
				// --- DATOS SOLICITUD
				$html = $html.$solicitud;

				$html = $html.$tr.'<td>';
				$html = $html. $row["f_solicitud"];
				$html = $html.'</td><td>';
				$html = $html. $row["f_postulacion"];
				$html = $html.'</td><td>';
				$html = $html. $row["solicitant"];
				$html = $html.'</td></tr>';					
				$html=$html.'</table></div>';	
				$i++;


			}		
			$i=$i-1; $title = '';
			if ($i==1) $title= 'Estudiante Aprobado Por Organización ('.$i.')';
			else $title= 'Estudiantes Aprobados Por Organización ('.$i.')';

			$Result=$this->EncabezadoReporteNombreDinamic( $codigo_temporada_especialidad , $title );

				$especialidad='<font color="#0B3861" align="center"><h2>Estudiantes : '. $Result['especialidad'].'</h2></font>';

				

     		 return ($Result['Encabezado'].$especialidad.$html);			
		}


		function GenerarReportedeEstudiantes_Aprobados_Sin_Tutor($codigo_temporada_especialidad)
		{
			

			$html='';


			$i=0;

			  $sql =$this->Reporte_estudiantes_sin_tutoresSQL($codigo_temporada_especialidad);
			  
				$estudiante='<div align="center">	

				<table cellpadding="5" ><tr  bgcolor="#0B3861" >

				<td width="48"><font color="#FFFFFF" size="12"><b>#</b></font></td>
				<td width="200"><font color="#FFFFFF" size="12"><b> Estudiante </b></font></td>

				<td width="120"><font color="#FFFFFF" size="12"><b> Expediente </b></font></td>
				
				<td width="180"><font color="#FFFFFF" size="12"><b> Cédula </b></font></td>

				<td width="150"><font color="#FFFFFF" size="12"><b> Teléfono </b></font></td>

				</tr>';

				$organizacion = '<tr bgcolor="#0B3861" >

				<td width="200"><font color="#FFFFFF" size="12"><b> Organización </b></font></td>

				<td width="110"><font color="#FFFFFF" size="12"><b> Estado </b></font></td>
				
				<td width="170"><font color="#FFFFFF" size="12"><b> Municipio </b></font></td>

				<td width="170"><font color="#FFFFFF" size="12"><b> Dirección </b></font></td>

				</tr>';

 				$solicitud = '<tr bgcolor="#0B3861" >

				<td width="150"><font color="#FFFFFF" size="12"><b>Fecha Solicitud</b></font></td>

				<td width="150"><font color="#FFFFFF" size="12"><b>Fecha Postulación</b></font></td>

				<td width="150"><font color="#FFFFFF" size="12"><b>Fecha Aprobacion</b></font></td>
				
				<td width="200"><font color="#FFFFFF" size="12"><b>Realizada por</b></font></td>

				</tr>';				

				$i=1;
				
				$tr=  '<tr bgcolor="#E1F0FF">';
				
				while ($row = pg_fetch_array($sql)){
				$html = $html. $estudiante;	
				
				//--- DATOS Estudiante
				$html = $html.$tr.'<td rowspan="5">';
				$html = $html. $i;
				$html = $html.'</td><td>';
				$html = $html. $row["estudiante"];
				$html = $html.'</td><td>';
				$html = $html. $row["expediente"];
				$html = $html.'</td><td>';
				$html = $html. $row["cedula"];
				$html = $html.'</td><td>';
				$html = $html. $row["telefono"];
				$html = $html.'</td></tr>';	
				
				//--- DATOS ORGANIZACION
				$html = $html.$organizacion;

						
				$html = $html.$tr.'<td>';
				$html = $html. $row["nombre_organizacion"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_estado"];
				$html = $html.'</td><td>';
				$html = $html. $row["nombre_municipio"];
				$html = $html.'</td><td>';
				$html = $html. $row["domicilio"];
				$html = $html.'</td></tr>';	
				// --- DATOS SOLICITUD
				$html = $html.$solicitud;

				$html = $html.$tr.'<td>';
				$html = $html. $row["fecha_solicitud"];
				$html = $html.'</td><td>';
				$html = $html. $row["fecha_postulacion"];
				$html = $html.'</td><td>';
				$html = $html. $row["fecha_aprobacion"];
				$html = $html.'</td><td>';
				$html = $html. $row["solicitant"];
				$html = $html.'</td></tr>';					
				$html=$html.'</table></div>';	
				$i++;
			}		
			$i=$i-1; $title = '';
			if ($i==1) $title= 'Estudiante Aprobado Sin Tutor Académico ('.$i.')';
			else $title= 'Estudiantes Aprobados Sin Tutor Académico ('.$i.')';

			$Result=$this->EncabezadoReporteNombreDinamic( $codigo_temporada_especialidad , $title );

				$especialidad='<font color="#0B3861" align="center"><h2>Estudiantes : '. $Result['especialidad'].'</h2></font>';

     		 return ($Result['Encabezado'].$especialidad.$html);
		}

}
?>