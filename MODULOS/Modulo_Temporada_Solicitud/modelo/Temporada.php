<?php

include_once ("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$co       = $conexion->Conectar();

class Temporada {

	function RegistrarTemporada($array = array()) {
		$encargado         = $array['encargado'];
		$id_periodo        = $array['id_periodo'];
		$id_tipo_solicitud = $array['id_tipo_solicitud'];
		$estatus           = $array['estatus'];

		$sql = pg_query("INSERT INTO pasantias.temporadas_solicitud (id_tipo_solicitud ,id_periodo ,codigo_encargado ,estatus)
		 VALUES ($id_tipo_solicitud ,$id_periodo ,'$encargado','$estatus') ;");

		$num = pg_affected_rows($sql);
		pg_free_result($sql);

		return $num;
	}

	function TemporadasSegunEncargado($codigo_sucursal) {
		$sql = pg_query("SELECT persona.nombre||'  '||persona.apellido as encargado ,persona_organizacion_oficina.id_oficina , temporadas_solicitud.estatus

			, to_char(periodo_solicitud.fecha_inicio, 'DD, TMMonth YYYY')|| ' al ' ||to_char(periodo_solicitud.fecha_fin, 'DD, TMMonth YYYY') as periodo_solicitud
			, nombre_tipo_solicitud ,codigo_temporada
			FROM pasantias.temporadas_solicitud JOIN pasantias.tipo_solicitud ON temporadas_solicitud.id_tipo_solicitud = tipo_solicitud.id_tipo_solicitud
			JOIN pasantias.periodo_solicitud ON periodo_solicitud.id_periodo=temporadas_solicitud.id_periodo
			JOIN pasantias.encargado ON encargado.codigo_encargado=temporadas_solicitud.codigo_encargado
			JOIN pasantias.persona_organizacion_oficina ON persona_organizacion_oficina.id_persona = encargado.id_persona
 			AND persona_organizacion_oficina.id_oficina =encargado.id_oficina
  			AND persona_organizacion_oficina.id_perfil= encargado.id_perfil
   			AND persona_organizacion_oficina.codigo_sucursal=encargado.codigo_sucursal
			JOIN pasantias.persona On persona.id_persona=persona_organizacion_oficina.id_persona
			AND persona_organizacion_oficina.codigo_sucursal='$codigo_sucursal' ;");
		return $sql;
	}

	function TemporadasPreparadas($codigo_encargado) {

		$sql = pg_query(" SELECT sqlCarreras.* , Count(temporadas_estudiantes.codigo_estudiante) as contstudents

			FROM ( SELECT  tipo_solicitud.nombre_tipo_solicitud , temporadas_solicitud.estatus ,
				
				to_char(periodo_solicitud.fecha_inicio, 'DD, TMMonth YYYY')|| ' al ' ||to_char(periodo_solicitud.fecha_fin, 'DD, TMMonth YYYY') as periodo_solicitud,
				
				temporadas_solicitud.codigo_temporada , Count(temporadas_especialidad.codigo_temporada) as contscarrer

			 FROM pasantias.temporadas_solicitud 

  JOIN pasantias.encargado

  		ON  temporadas_solicitud.codigo_encargado = encargado.codigo_encargado 

  JOIN pasantias.persona_organizacion_oficina

	  	ON  persona_organizacion_oficina.id_persona = encargado.id_persona  

	  	AND  persona_organizacion_oficina.id_oficina = encargado.id_oficina

	  	AND persona_organizacion_oficina.id_perfil = encargado.id_perfil

	  	AND  persona_organizacion_oficina.codigo_sucursal = encargado.codigo_sucursal

	  	JOIN pasantias.temporadas_especialidad 

	  		ON temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada

  JOIN pasantias.persona 

  	  	ON persona.id_persona = persona_organizacion_oficina.id_persona 

  	  	JOIN pasantias.tipo_solicitud

  ON temporadas_solicitud.id_tipo_solicitud = tipo_solicitud.id_tipo_solicitud
   
   JOIN pasantias.periodo_solicitud
  
  		ON periodo_solicitud.id_periodo = temporadas_solicitud.id_periodo 

  JOIN pasantias.lapso_academico

	  	ON lapso_academico.id_lapso = periodo_solicitud.id_lapso

	  	AND temporadas_solicitud.codigo_encargado='$codigo_encargado'

	  	--AND temporadas_solicitud.estatus='PREPARADA'

	GROUP BY nombre_tipo_solicitud , temporadas_solicitud.estatus , periodo_solicitud ,
	
	temporadas_solicitud.codigo_temporada ) as sqlCarreras

	INNER JOIN pasantias.temporadas_especialidad

			ON temporadas_especialidad.codigo_temporada = sqlCarreras.codigo_temporada

	LEFT JOIN pasantias.temporadas_estudiantes

			ON temporadas_estudiantes.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad

	LEFT JOIN pasantias.estudiante

			ON estudiante.codigo_estudiante = temporadas_estudiantes.codigo_estudiante

	GROUP BY sqlCarreras.nombre_tipo_solicitud , sqlCarreras.estatus , sqlCarreras.periodo_solicitud ,
	
	sqlCarreras.codigo_temporada ,sqlCarreras.contscarrer;");
		return $sql;
	}

	function estudiantesparaAsignacion($id_especialidad, $codigo_temporada) {
		$sal =
		pg_query("SELECT codigo_temporada_especialidad FROM pasantias.temporadas_especialidad WHERE codigo_temporada ='$codigo_temporada' AND id_especialidad = $id_especialidad;");

		$var                           = pg_fetch_array($sal);
		$codigo_temporada_especialidad = $var[0];

		$sql = pg_query(" SELECT  estudiante.codigo_estudiante , estudiante.expediente ,persona.cedula , persona .nombre ||'  '||persona.apellido as estudiante

			FROM  pasantias.temporadas_especialidad INNER JOIN pasantias.temporadas_solicitud
		ON  temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada
		AND temporadas_especialidad.codigo_temporada_especialidad ='$codigo_temporada_especialidad'
		INNER JOIN pasantias.encargado
		ON encargado.codigo_encargado = temporadas_solicitud.codigo_encargado INNER JOIN pasantias.persona_organizacion_oficina
		ON  encargado.id_persona =persona_organizacion_oficina.id_persona
		AND encargado.codigo_sucursal =persona_organizacion_oficina.codigo_sucursal
		AND encargado.id_perfil =persona_organizacion_oficina.id_perfil
		AND encargado.id_oficina =persona_organizacion_oficina.id_oficina INNER JOIN pasantias.organizacionmunicipio
		ON organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal INNER JOIN pasantias.organizacion
		ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion INNER JOIN pasantias.instituto_principal
		ON instituto_principal.id_organizacion = organizacion.id_organizacion INNER JOIN pasantias.especialidad_instituto_principal
		ON especialidad_instituto_principal.id_ip = instituto_principal.id_ip INNER JOIN pasantias.especialidad
		ON especialidad.id_especialidad = especialidad_instituto_principal.id_especialidad INNER JOIN pasantias.persona_instituto_especialidad
		ON persona_instituto_especialidad.id_ip = instituto_principal.id_ip
		AND persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad INNER JOIN pasantias.estudiante
		ON estudiante.id_persona = persona_instituto_especialidad.id_persona
		AND estudiante.id_perfil = persona_instituto_especialidad.id_perfil
		AND estudiante.id_especialidad = persona_instituto_especialidad.id_especialidad
		AND estudiante.id_ip = persona_instituto_especialidad.id_ip INNER JOIN pasantias.persona
		ON persona.id_persona = persona_instituto_especialidad.id_persona
		AND temporadas_especialidad.id_especialidad = especialidad.id_especialidad
		AND  estudiante.id_especialidad = temporadas_especialidad.id_especialidad
		LEFT JOIN pasantias.temporadas_estudiantes
		ON   temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante
		AND temporadas_estudiantes.codigo_temporada_especialidad ='$codigo_temporada_especialidad'
		WHERE  temporadas_estudiantes.codigo_estudiante IS NULL ;");

		return $sql;
	}

	function estudianteAsignados($id_especialidad, $codigo_temporada) {
		$sal =
		pg_query("SELECT codigo_temporada_especialidad FROM pasantias.temporadas_especialidad WHERE codigo_temporada ='$codigo_temporada' AND id_especialidad = $id_especialidad;");

		$var                           = pg_fetch_array($sal);
		$codigo_temporada_especialidad = $var[0];

		$sql = pg_query(" SELECT  estudiante.expediente ,persona.cedula , persona .nombre ||'  '||persona.apellido as estudiante

			FROM  pasantias.temporadas_especialidad

		INNER JOIN pasantias.temporadas_solicitud

			ON  temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada

			AND temporadas_especialidad.codigo_temporada_especialidad ='$codigo_temporada_especialidad'

		INNER JOIN pasantias.encargado

			ON encargado.codigo_encargado = temporadas_solicitud.codigo_encargado

		INNER JOIN pasantias.persona_organizacion_oficina

			ON  encargado.id_persona =persona_organizacion_oficina.id_persona

			AND encargado.codigo_sucursal =persona_organizacion_oficina.codigo_sucursal

			AND encargado.id_perfil =persona_organizacion_oficina.id_perfil

			AND encargado.id_oficina =persona_organizacion_oficina.id_oficina

		INNER JOIN pasantias.organizacionmunicipio

			ON organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal

		INNER JOIN pasantias.organizacion

			ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion

		INNER JOIN pasantias.instituto_principal

			ON instituto_principal.id_organizacion = organizacion.id_organizacion

		INNER JOIN pasantias.especialidad_instituto_principal

			ON especialidad_instituto_principal.id_ip = instituto_principal.id_ip

		INNER JOIN pasantias.especialidad

			ON especialidad.id_especialidad = especialidad_instituto_principal.id_especialidad

		INNER JOIN pasantias.persona_instituto_especialidad

			ON persona_instituto_especialidad.id_ip = instituto_principal.id_ip

			AND persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad

		INNER JOIN pasantias.estudiante

			ON estudiante.id_persona = persona_instituto_especialidad.id_persona

			AND estudiante.id_perfil = persona_instituto_especialidad.id_perfil

			AND estudiante.id_especialidad = persona_instituto_especialidad.id_especialidad

			AND estudiante.id_ip = persona_instituto_especialidad.id_ip

		INNER JOIN pasantias.persona

			ON persona.id_persona = persona_instituto_especialidad.id_persona

			AND temporadas_especialidad.id_especialidad = especialidad.id_especialidad

			AND  estudiante.id_especialidad = temporadas_especialidad.id_especialidad

		LEFT JOIN pasantias.temporadas_estudiantes

			ON   temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante

			AND temporadas_estudiantes.codigo_temporada_especialidad ='$codigo_temporada_especialidad'

		WHERE  temporadas_estudiantes.codigo_estudiante IS NOT NULL ;");

		return $sql;
	}

	function TemporadaIndividual($codigo_temporada) {
		//esta consulta es para seleccionar las temporadas a las que el estudiante se postula
		$sql = pg_query("SELECT persona.nombre ||' '|| persona.apellido as encargado, tipo_solicitud.nombre_tipo_solicitud ,

		to_char(periodo_solicitud.fecha_inicio, 'DD, TMMonth YYYY')|| ' al ' ||to_char(periodo_solicitud.fecha_fin, 'DD, TMMonth YYYY') as periodo,

		lapso_academico.numero_lapso ||' :: '||

		to_char(lapso_academico.ano_i, 'DD, TMMonth YYYY')|| ' al ' ||to_char(lapso_academico.ano_f, 'DD, TMMonth YYYY')


		as lapsoacademico , temporadas_solicitud.estatus , encargado_tipo_solicitud.descripcion ,

				case WHEN (current_date > periodo_solicitud.fecha_fin) OR (current_date < periodo_solicitud.fecha_inicio) then 'warning'

					 WHEN (current_date BETWEEN periodo_solicitud.fecha_inicio AND periodo_solicitud.fecha_fin) then 'success' END as colore ,

				CASE WHEN (current_date > periodo_solicitud.fecha_fin)    THEN
REPLACE(
  REPLACE(
    REPLACE(
      REPLACE(
        REPLACE(
          REPLACE(
            age(current_date , periodo_solicitud.fecha_fin) ::TEXT,
          'years','AÑOS'),
        'year','AÑO'),
      'mons','MESES'),
    'mon','MES'),
   'days','DIAS'),
'day','DIA') || '<strong> ¡ Posterior al PERIODO !</strong>'

					 WHEN (current_date < periodo_solicitud.fecha_inicio) THEN
REPLACE(
  REPLACE(
    REPLACE(
      REPLACE(
        REPLACE(
          REPLACE(
            age(periodo_solicitud.fecha_inicio , current_date) ::TEXT,
          'years','AÑOS'),
        'year','AÑO'),
      'mons','MESES'),
    'mon','MES'),
   'days','DIAS'),
'day','DIA') || '<strong> ¡ Anterior al PERIODO !</strong>'

					WHEN (current_date BETWEEN  periodo_solicitud.fecha_inicio AND periodo_solicitud.fecha_fin) THEN
REPLACE(
  REPLACE(
    REPLACE(
      REPLACE(
        REPLACE(
          REPLACE(

            age( current_date , periodo_solicitud.fecha_inicio) ::TEXT,

          'years','AÑOS'),
        'year','AÑO'),
      'mons','MESES'),
    'mon','MES'),
   'days','DIAS'),
'day','DIA') 			|| '<strong> ¡ De haber Iniciado La Temporada !</strong> Y ' ||

REPLACE(
  REPLACE(
    REPLACE(
      REPLACE(
        REPLACE(
          REPLACE(

            age( periodo_solicitud.fecha_fin , current_date) ::TEXT ,

          'years','AÑOS'),
        'year','AÑO'),
      'mons','MESES'),
    'mon','MES'),
   'days','DIAS'),
'day','DIA') 			|| '<strong> ¡ Para Finalizar La Temporada !</strong>'

END as calculo_tiempo ,

					 to_char(current_date, 'DD, TMMonth YYYY') as very_now ,

	'<label class=text-success>' ||

		REPLACE(
		  REPLACE(
		    REPLACE(
		      REPLACE(
		        REPLACE(
		          REPLACE(
		            age(periodo_solicitud.fecha_fin , periodo_solicitud.fecha_inicio) ::TEXT,
		          'years','Años'),
		        'year','Año'),
		      'mons','Meses'),
		    'mon','Mes'),
		   'days','Dias'),
		'day','Dia')	|| '</label>' as CalculodePeriodo

  FROM pasantias.temporadas_solicitud JOIN pasantias.encargado

  		ON  temporadas_solicitud.codigo_encargado         = encargado.codigo_encargado

  JOIN pasantias.persona_organizacion_oficina

  		ON  persona_organizacion_oficina.id_persona       = encargado.id_persona

  		AND  persona_organizacion_oficina.id_oficina      = encargado.id_oficina

  		AND persona_organizacion_oficina.id_perfil        = encargado.id_perfil

  		AND  persona_organizacion_oficina.codigo_sucursal = encargado.codigo_sucursal

  JOIN pasantias.persona

		ON persona.id_persona                     = persona_organizacion_oficina.id_persona

  JOIN pasantias.tipo_solicitud

  		ON temporadas_solicitud.id_tipo_solicitud = tipo_solicitud.id_tipo_solicitud

  JOIN pasantias.periodo_solicitud

  		ON periodo_solicitud.id_periodo = temporadas_solicitud.id_periodo

  JOIN pasantias.lapso_academico

  		ON lapso_academico.id_lapso     = periodo_solicitud.id_lapso

  JOIN pasantias.encargado_tipo_solicitud

  		On encargado_tipo_solicitud.id_tipo_solicitud = tipo_solicitud.id_tipo_solicitud

  WHERE temporadas_solicitud.codigo_temporada='$codigo_temporada' ;") or die('ERROR AL INSERTAR DATOS: '.pg_last_error());

		return $sql;
	}

	function EspecialidadesdeTemporadas($codigo_temporada) {

		$sql = pg_query(" SELECT temporadas_especialidad.id_especialidad , nombre_especialidad , nombre_tipo_especialidad

			FROM pasantias.temporadas_especialidad INNER JOIN pasantias.temporadas_solicitud

  	 ON  temporadas_solicitud.codigo_temporada = temporadas_especialidad.codigo_temporada

  INNER JOIN pasantias.encargado

  	 ON encargado.codigo_encargado             = temporadas_solicitud.codigo_encargado

  INNER JOIN pasantias.persona_organizacion_oficina

  	 ON persona_organizacion_oficina.id_persona = encargado.id_persona

  	 AND persona_organizacion_oficina.id_perfil = encargado.id_perfil

  	 AND persona_organizacion_oficina.codigo_sucursal = encargado.codigo_sucursal

  	 AND persona_organizacion_oficina.id_oficina = encargado.id_oficina

  INNER JOIN pasantias.organizacionmunicipio

  	 ON organizacionmunicipio.codigo_sucursal  = persona_organizacion_oficina.codigo_sucursal

  INNER JOIN pasantias.organizacion

  	 ON organizacion.id_organizacion           = organizacionmunicipio.id_organizacion

  INNER JOIN pasantias.instituto_principal

  	 ON instituto_principal.id_organizacion    = organizacion.id_organizacion

  INNER JOIN pasantias.especialidad_instituto_principal

  	 ON especialidad_instituto_principal.id_ip = instituto_principal.id_ip

  INNER JOIN pasantias.especialidad

  	 ON especialidad.id_especialidad           = especialidad_instituto_principal.id_especialidad

  INNER JOIN pasantias.tipo_especialidad

  	 ON tipo_especialidad.id_tipo_especialidad   = especialidad.id_tipo_especialidad

  	 AND temporadas_especialidad.id_especialidad = especialidad.id_especialidad

  	 AND temporadas_especialidad.codigo_temporada='$codigo_temporada' 

  	 Order by  nombre_tipo_especialidad , nombre_especialidad ;");

		return $sql;
	}

	function AsignaraTemporada($id_especialidad, $temporada, $estudiantes) {//reg est a temp con su esp
		$num                           = 0;
		
		$codigo_temporada_especialidad = $this->buscarcodigotemporadaespecialidad($id_especialidad, $temporada);
		
		foreach($estudiantes as $codigo):
			
			$veri = $this->codigoestudiante($codigo);
			
			if ($veri == 1) {
				$sql = pg_query(" INSERT INTO pasantias.temporadas_estudiantes (codigo_temporada_especialidad , codigo_estudiante ,estatus)
					 VALUES ('$codigo_temporada_especialidad' ,'$codigo' ,'PREPARADO') ;");

				$num = pg_affected_rows($sql)+$num;
				
				pg_free_result($sql);
			}

		endforeach;

		return $num;
	}

	function codigoestudiante($codigo) {
		$sql = pg_query("SELECT codigo_estudiante FROM pasantias.estudiante WHERE codigo_estudiante ='$codigo';");

		return pg_num_rows($sql);
	}

	function buscarcodigotemporadaespecialidad($id_especialidad, $codigo_temporada) {
		$sql = pg_query("SELECT codigo_temporada_especialidad FROM pasantias.temporadas_especialidad
				WHERE  id_especialidad=$id_especialidad AND codigo_temporada='$codigo_temporada' ;");
		$var = pg_fetch_array($sql);

		return $var[0];
	}

	function tablaMistemporadas($codigo_encargado) {
		
		$sql = pg_query("SELECT  

	tipo_solicitud.nombre_tipo_solicitud , 

	temporadas_solicitud.codigo_temporada ,
			
	to_char(periodo_solicitud.fecha_inicio, 'DD, TMMonth YYYY')

	|| ' al ' ||

	to_char(periodo_solicitud.fecha_fin, 'DD, TMMonth YYYY') as periodo,
			
	temporadas_solicitud.estatus, 

	count(temporadas_especialidad.codigo_temporada) as especialidades

  FROM pasantias.temporadas_solicitud 

  JOIN pasantias.encargado
  	
  	ON  temporadas_solicitud.codigo_encargado = encargado.codigo_encargado 

  JOIN pasantias.persona_organizacion_oficina
  	
  	ON  persona_organizacion_oficina.id_persona = encargado.id_persona  

	AND  persona_organizacion_oficina.id_oficina = encargado.id_oficina
	
	AND persona_organizacion_oficina.id_perfil = encargado.id_perfil
	
	AND  persona_organizacion_oficina.codigo_sucursal = encargado.codigo_sucursal

  JOIN pasantias.persona 

  	ON persona.id_persona = persona_organizacion_oficina.id_persona 

  JOIN pasantias.tipo_solicitud
  	
  	ON temporadas_solicitud.id_tipo_solicitud = tipo_solicitud.id_tipo_solicitud 

  JOIN pasantias.periodo_solicitud
  	
  	ON periodo_solicitud.id_periodo = temporadas_solicitud.id_periodo 

  JOIN pasantias.lapso_academico
  	
  	ON lapso_academico.id_lapso = periodo_solicitud.id_lapso 
  
  LEFT JOIN pasantias.temporadas_especialidad
  	
  	ON  temporadas_solicitud.codigo_temporada = temporadas_especialidad.codigo_temporada

  WHERE temporadas_solicitud.codigo_encargado ='$codigo_encargado'

  GROUP BY  tipo_solicitud.nombre_tipo_solicitud , 

  			temporadas_solicitud.codigo_temporada ,
			
			periodo,

			temporadas_solicitud.estatus 

 ;");

		return $sql;

	}

	function temporadasNoEspecialidades($codigo_temporada) {

		$sql = pg_query("SELECT 

			especialidad.id_especialidad , 
			
			especialidad.nombre_especialidad ,
			
			tipo_especialidad.nombre_tipo_especialidad

	FROM pasantias.encargado JOIN pasantias.temporadas_solicitud
		
		ON temporadas_solicitud.codigo_encargado= encargado.codigo_encargado
		
		AND temporadas_solicitud.codigo_temporada='$codigo_temporada' 
	
	JOIN pasantias.persona_organizacion_oficina
		
		ON persona_organizacion_oficina.id_persona = encargado.id_persona
		
		AND persona_organizacion_oficina.codigo_sucursal = encargado.codigo_sucursal
		
		AND persona_organizacion_oficina.id_oficina = encargado.id_oficina
		
		AND persona_organizacion_oficina.id_perfil = encargado.id_perfil 
	
	JOIN pasantias.organizacionmunicipio
	
		ON organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal 
	
	JOIN pasantias.organizacion
	
		ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion 
	
	JOIN pasantias.instituto_principal
	
		ON instituto_principal.id_organizacion = organizacion.id_organizacion  
	
	JOIN pasantias.especialidad_instituto_principal
	
		ON  instituto_principal.id_ip = especialidad_instituto_principal.id_ip
	
		AND especialidad_instituto_principal.estatus = 'ACTIVO' 
	
	JOIN pasantias.especialidad

		ON especialidad.id_especialidad  = especialidad_instituto_principal.id_especialidad 
	
	JOIN pasantias.tipo_especialidad
	
		ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad
	
	LEFT JOIN pasantias.temporadas_especialidad
	
		ON temporadas_especialidad.id_especialidad = especialidad_instituto_principal.id_especialidad
	
		AND temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada
	
	WHERE temporadas_especialidad.id_especialidad is null  ;");
	return $sql;
	}

	function temporadasConEspecialidades($codigo_temporada) {

		$sql = pg_query("SELECT 	

			especialidad.id_especialidad , 
			
			especialidad.nombre_especialidad ,
			
			tipo_especialidad.nombre_tipo_especialidad

		FROM pasantias.encargado 
		
		JOIN pasantias.temporadas_solicitud
		
				ON temporadas_solicitud.codigo_encargado= encargado.codigo_encargado
		
				AND temporadas_solicitud.codigo_temporada='$codigo_temporada' 
		
		JOIN pasantias.persona_organizacion_oficina
		
				ON persona_organizacion_oficina.id_persona = encargado.id_persona
		
				AND persona_organizacion_oficina.codigo_sucursal = encargado.codigo_sucursal
		
				AND persona_organizacion_oficina.id_oficina = encargado.id_oficina
		
				AND persona_organizacion_oficina.id_perfil = encargado.id_perfil 
		
		JOIN pasantias.organizacionmunicipio
		
				ON organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal 
		
		JOIN pasantias.organizacion
		
				ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion 
		
		JOIN pasantias.instituto_principal
		
				ON instituto_principal.id_organizacion = organizacion.id_organizacion  
		
		JOIN pasantias.especialidad_instituto_principal
		
				ON  instituto_principal.id_ip = especialidad_instituto_principal.id_ip
		
				AND especialidad_instituto_principal.estatus = 'ACTIVO' 
		
		JOIN pasantias.especialidad

				ON especialidad.id_especialidad  = especialidad_instituto_principal.id_especialidad 
		
		JOIN pasantias.tipo_especialidad
		
				ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad 
		
		LEFT JOIN pasantias.temporadas_especialidad
		
				ON temporadas_especialidad.id_especialidad = especialidad_instituto_principal.id_especialidad
		
				AND temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada
		
		WHERE temporadas_especialidad.id_especialidad is not null  ;");
		return $sql;
	}

	function AsignarEspecialidadesTemporadas($array = array()) {
		$num              = 0;
		$codigo_temporada = $array['temporadacode'];
		$especialidad     = $array['asignarEspecialidads'];
		foreach ($especialidad as $key => $value) {

			$sql = pg_query(" INSERT INTO pasantias.temporadas_especialidad (codigo_temporada ,id_especialidad ,estatus)
			 VALUES ('$codigo_temporada',$value,'EN ESPERA') ;");

			$num = pg_affected_rows($sql)+$num;
			pg_free_result($sql);
		}
		return $num;
	}
	function BuscarTemporadasEnCurso($codigo_encargado) {
		$sql = pg_query("SELECT 

			temporadas_solicitud.codigo_temporada ,

			to_char(periodo_solicitud.fecha_inicio, 'TMDay, DD TMMonth YYYY') 

			||' al '||

			to_char(periodo_solicitud.fecha_fin, 'TMDay, DD TMMonth YYYY') as periodo ,

			tipo_solicitud.nombre_tipo_solicitud

			FROM pasantias.encargado
		
		INNER JOIN pasantias.temporadas_solicitud
		
			ON encargado.codigo_encargado = temporadas_solicitud.codigo_encargado
		
			AND encargado.codigo_encargado = '$codigo_encargado'
		
			AND temporadas_solicitud.estatus='EN CURSO'
		
		INNER JOIN pasantias.persona_organizacion_oficina
		
			ON persona_organizacion_oficina.id_persona = encargado.id_persona
		
			AND persona_organizacion_oficina.id_perfil = encargado.id_perfil
		
			AND persona_organizacion_oficina.id_oficina = encargado.id_oficina
		
			AND persona_organizacion_oficina.codigo_sucursal = encargado.codigo_sucursal
		
		INNER JOIN pasantias.organizacionmunicipio
		
			ON organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal
		
		INNER JOIN pasantias.organizacion
		
			ON organizacionmunicipio.id_organizacion = organizacion.id_organizacion
		
		INNER JOIN pasantias.instituto_principal
		
			ON instituto_principal.id_organizacion = organizacion.id_organizacion
		
		INNER JOIN pasantias.tipo_solicitud
		
			On tipo_solicitud.id_tipo_solicitud = temporadas_solicitud.id_tipo_solicitud
		
		INNER JOIN pasantias.periodo_solicitud
		
			ON periodo_solicitud.id_periodo = temporadas_solicitud.id_periodo
		 ;");
		return $sql;
	}
	// ORDENAR PESTAÑAS POR  ESPECIALIDADES QUE  TENGAN ESTUDIANTES ASIGNADOS
	// ORDENAR PESTAÑAS POR  ESPECIALIDADES QUE  TENGAN ESTUDIANTES ASIGNADOS
	// ORDENAR PESTAÑAS POR  ESPECIALIDADES QUE  TENGAN ESTUDIANTES ASIGNADOS
	function BuscarEspecialidadesTemporadasEnCurso($codigo_temporada) {

		$sql = pg_query("SELECT 

			COUNT(temporadas_estudiantes.codigo_estudiante) as cantidadestudiantes,

			 Master.especialidad , 

			 Master.codigo_temporada_especialidad  

			 FROM (
				SELECT 
				especialidad.nombre_especialidad 
				||' - '||
				nombre_tipo_especialidad as especialidad,
			
			temporadas_especialidad.codigo_temporada_especialidad
			
			FROM pasantias.temporadas_solicitud
			
			INNER JOIN pasantias.temporadas_especialidad
			
				ON temporadas_solicitud.codigo_temporada = temporadas_especialidad.codigo_temporada
			
				AND temporadas_solicitud.codigo_temporada ='$codigo_temporada'

			INNER JOIN pasantias.especialidad
			
				ON especialidad.id_especialidad = temporadas_especialidad.id_especialidad
			
			INNER JOIN pasantias.tipo_especialidad
			
				ON especialidad.id_tipo_especialidad = tipo_especialidad.id_tipo_especialidad
			
			INNER JOIN pasantias.encargado
			
				ON encargado.codigo_encargado = temporadas_solicitud.codigo_encargado
			
			INNER JOIN pasantias.persona_organizacion_oficina
			
				ON persona_organizacion_oficina.id_persona = encargado.id_persona
			
				AND persona_organizacion_oficina.id_perfil = encargado.id_perfil
			
				AND persona_organizacion_oficina.id_oficina = encargado.id_oficina
			
				AND persona_organizacion_oficina.codigo_sucursal = encargado.codigo_sucursal
			
			INNER JOIN pasantias.organizacionmunicipio
			
				ON organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal
			
			INNER JOIN pasantias.organizacion
			
				ON organizacionmunicipio.id_organizacion = organizacion.id_organizacion
			
			INNER JOIN pasantias.instituto_principal
			
				ON instituto_principal.id_organizacion = organizacion.id_organizacion
			
			INNER JOIN pasantias.especialidad_instituto_principal
			
				ON especialidad_instituto_principal.id_ip = instituto_principal.id_ip
			
				AND especialidad_instituto_principal.id_especialidad = especialidad.id_especialidad
			
				)as Master
			
			LEFT JOIN pasantias.temporadas_estudiantes
			
				ON temporadas_estudiantes.codigo_temporada_especialidad = Master.codigo_temporada_especialidad
			
			WHERE temporadas_estudiantes.codigo_temporada_especialidad IS NOT NULL

		GROUP BY especialidad , 

		Master.codigo_temporada_especialidad 

		ORDER BY especialidad ;");

		return $sql;
	}

	function BuscarEstudiantesEspecialidadTemporadaEnCurso($codigo) {
		
		$vert = self::VerificarRequiereTutores       ($codigo);

		// Intentando hacer codigo Sofisticado..($codigo ==== Codigo_temporada_especialidad)

		return 
		($vert['descripcion']=='true') ? self::with_RT($codigo) : self::without_RT($codigo);
	}

	function with_RT($codigo_temporada_especialidad){ 

	return 		

		array(
			'Aprobados'    => 
			array( self::VerificarAprobadosOrganizacion ($codigo_temporada_especialidad),BuscarEstudiantesAprobados)
			,
			
			'Postulados'   => 
			array( self::VerificarPostulados($codigo_temporada_especialidad),             BuscarEstudiantesPostulados )
			,

			'NoPostulados' => 
			array( self::VerificarNoPostulados($codigo_temporada_especialidad),           BuscarEstudiantesNoPostulados )
			,

			'ConTutores'   => 
			array(self::VerificarEstudiantesConTutores ($codigo_temporada_especialidad),  BuscarEstudiantesConTutores  )
			,

			'SinTutores'   => 
			array(self::VerificarEstudiantesSinTutores ($codigo_temporada_especialidad),  BuscarEstudiantesSinTutores  )
			,
			
			'NoSolventes'  => 
			array( self::VerificarEstudiantesNoSolventes($codigo_temporada_especialidad), BuscarEstudiantesNoSolventes )
			,

			'Solventes'    => 
			array( self::VerificarEstudiantesSolventes($codigo_temporada_especialidad),   BuscarEstudiantesSolventes )
			,

			'Ejecutar'	   => 
			array( $codigo_temporada_especialidad )
			);		
	}

	function without_RT($codigo_temporada_especialidad){ 
	return 
		array(
			'Aprobados'    => 
			array( self::VerificarAprobadosOrganizacion ($codigo_temporada_especialidad) , BuscarEstudiantesAprobados)
			,
			
			'Postulados'   => 
			array( self::VerificarPostulados($codigo_temporada_especialidad) ,BuscarEstudiantesPostulados)
			,

			'NoPostulados' => 
			array( self::VerificarNoPostulados($codigo_temporada_especialidad) ,BuscarEstudiantesNoPostulados)
			,
			
			'NoSolventes'  => 
			array( self::VerificarEstudiantesNoSolventes($codigo_temporada_especialidad) ,BuscarEstudiantesNoSolventes) 
			,

			'Solventes'    => 
			array( self::VerificarEstudiantesSolventes($codigo_temporada_especialidad) ,BuscarEstudiantesSolventes)  
			,

			'Ejecutar'	   => 
			array( $codigo_temporada_especialidad )
			);
	}

	function VerificarNoPostulados($codigo_temporada_especialidad) {
		$sql = pg_query("SELECT solicitudes_recibidas.valor
			FROM (
	SELECT estudiante.codigo_estudiante

		FROM pasantias.estudiante

	INNER JOIN pasantias.temporadas_estudiantes

		ON temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante

	INNER JOIN pasantias.temporadas_especialidad

		ON temporadas_especialidad.codigo_temporada_especialidad = temporadas_estudiantes.codigo_temporada_especialidad

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

	LEFT JOIN pasantias.solicitudes_enviadas

		ON solicitudes_enviadas.valor = estudiante.codigo_estudiante

	WHERE solicitudes_enviadas.valor IS NULL

	) as recibidas

	LEFT JOIN pasantias.solicitudes_recibidas 

		ON recibidas.codigo_estudiante = solicitudes_recibidas.valor

	WHERE solicitudes_recibidas.valor is null;");

	return pg_num_rows($sql);

	}

	function VerificarPostulados($codigo_temporada_especialidad) {
		$sql = pg_query(" SELECT solicitudes_enviadas.valor as persona FROM  (SELECT estudianteSolicitud.*  ,solicitudes_enviadas.valor as sucursal FROM

				( SELECT persona.nombre ||'  '|| persona.apellido as estudiante , persona.telefono
				,persona.correo , solicitud.codigo_solicitud
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

		UNION

				SELECT solicitudes_recibidas.valor

		FROM ( SELECT persona.nombre ||'  '|| persona.apellido as estudiante , persona.telefono
				,persona.correo , solicitud.codigo_solicitud ,estudiante.expediente ,persona.cedula
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
		INNER JOIN pasantias.persona ON persona.id_persona =persona_instituto_especialidad.id_persona )
		 as estudianteSolicitud

		INNER JOIN pasantias.solicitudes_recibidas
			ON estudianteSolicitud.codigo_solicitud =solicitudes_recibidas.codigo_solicitud
			AND solicitudes_recibidas.table_column='organizacionmunicipio.codigo_sucursal'
			AND solicitudes_recibidas.estatus='EN ESPERA'
		INNER JOIN pasantias.organizacionmunicipio
			ON organizacionmunicipio.codigo_sucursal = solicitudes_recibidas.valor
		INNER JOIN pasantias.organizacion
			ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion;");

		return pg_num_rows($sql);

	}

	function VerificarAprobadosOrganizacion($codigo_temporada_especialidad) {
		$sql = pg_query("SELECT solicitudes_enviadas.valor as persona FROM  (SELECT estudianteSolicitud.*  ,solicitudes_enviadas.valor as sucursal FROM

				( SELECT persona.nombre ||'  '|| persona.apellido as estudiante , persona.telefono
				,persona.correo , solicitud.codigo_solicitud
		FROM pasantias.encargado INNER JOIN pasantias.temporadas_solicitud
		ON encargado.codigo_encargado =  temporadas_solicitud.codigo_encargado
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
		AND solicitudes_enviadas.table_column='persona.id_persona' UNION
		SELECT solicitudes_recibidas.valor as persona FROM  (SELECT estudianteSolicitud.*  ,solicitudes_enviadas.valor as sucursal FROM

		( SELECT persona.nombre ||'  '|| persona.apellido as estudiante , persona.telefono
				,persona.correo , solicitud.codigo_solicitud
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
		INNER JOIN pasantias.persona ON persona.id_persona =persona_instituto_especialidad.id_persona ) as estudianteSolicitud
		INNER JOIN pasantias.solicitudes_enviadas
		ON estudianteSolicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud
		AND solicitudes_enviadas.table_column='estudiante.codigo_estudiante') as SucursalEnviada
		INNER JOIN pasantias.solicitudes_recibidas
		ON SucursalEnviada.codigo_solicitud =solicitudes_recibidas.codigo_solicitud
		AND solicitudes_recibidas.table_column='organizacionmunicipio.codigo_sucursal'
		AND solicitudes_recibidas.estatus='APROBADO ORGANIZACION';");

		return pg_num_rows($sql);
	}

	function VerificarEstudiantesSinTutores($codigo_temporada_especialidad) {
		$sql = pg_query("SELECT 

			solicitudes_aprobadas.valor  

			FROM pasantias.solicitudes_aprobadas
			
			INNER JOIN pasantias.solicitud
			
				ON solicitudes_aprobadas.codigo_solicitud = solicitud.codigo_solicitud
			
			INNER JOIN pasantias.temporadas_especialidad
			
				ON solicitud.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
			
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
			
			LEFT JOIN pasantias.responsables
				
				ON responsables.codigo_solicitud = solicitud.codigo_solicitud
			
				AND responsables.table_column = 'tutor_academico.codigo_tutor_academico'
			
			WHERE responsables.codigo_solicitud IS NULL 

			GROUP BY solicitudes_aprobadas.valor;");

		return pg_num_rows($sql);

	}

	function VerificarEstudiantesConTutores($codigo_temporada_especialidad) {
		$sql = pg_query("SELECT 

			solicitudes_aprobadas.valor

			FROM pasantias.solicitudes_aprobadas
			
			INNER JOIN pasantias.solicitud
			
				ON   solicitudes_aprobadas.codigo_solicitud = solicitud.codigo_solicitud
			
			INNER JOIN pasantias.temporadas_especialidad
			
				ON  solicitud.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
			
				AND solicitud.codigo_temporada_especialidad = '$codigo_temporada_especialidad'
			
			INNER JOIN pasantias.estudiante
			
				ON estudiante.codigo_estudiante = solicitudes_aprobadas.valor
			
			INNER JOIN pasantias.persona_instituto_especialidad
			
				ON persona_instituto_especialidad.id_persona       = estudiante.id_persona
			
				AND persona_instituto_especialidad.id_ip           = estudiante.id_ip
			
				AND persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad
			
				ANd persona_instituto_especialidad.id_perfil       = estudiante.id_perfil
			
			INNER JOIN pasantias.especialidad
			
				ON especialidad.id_especialidad = persona_instituto_especialidad.id_especialidad
			
			INNER JOIN pasantias.instituto_principal
			
				ON instituto_principal.id_ip    = persona_instituto_especialidad.id_ip
			
			INNER JOIN pasantias.especialidad_instituto_principal
			
				On instituto_principal.id_ip    = especialidad_instituto_principal.id_ip
			
			LEFT JOIN pasantias.responsables
			
				ON responsables.codigo_solicitud = solicitud.codigo_solicitud
			
				AND responsables.table_column    = 'tutor_academico.codigo_tutor_academico'
			
			WHERE responsables.codigo_solicitud IS NOT NULL 

			GROUP BY solicitudes_aprobadas.valor;");

		return pg_num_rows($sql);

	}

	function VerificarEstudiantesNoSolventes($codigo) {
		$sql = pg_query("SELECT true 

		FROM pasantias.temporadas_solicitud

		INNER JOIN pasantias.temporadas_especialidad

			ON temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada

			AND temporadas_especialidad.codigo_temporada_especialidad ='$codigo'

		INNER JOIN pasantias.temporadas_estudiantes

			ON temporadas_estudiantes.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad

		INNER JOIN pasantias.estudiante

			On estudiante.codigo_estudiante = temporadas_estudiantes.codigo_estudiante

		INNER JOIN pasantias.entregable_temporada

			ON temporadas_solicitud.codigo_temporada = entregable_temporada.codigo_temporada

		INNER JOIN pasantias.entregable

			ON entregable.id_entregable = entregable_temporada.id_entregable

		LEFT JOIN pasantias.estudiantes_entregables

			ON estudiantes_entregables.id_entregable = entregable.id_entregable

			AND estudiantes_entregables.codigo_temporada_especialidad = temporadas_estudiantes.codigo_temporada_especialidad

			AND estudiantes_entregables.codigo_estudiante = temporadas_estudiantes.codigo_estudiante

		WHERE 	estudiantes_entregables.id_entregable IS NULL

			AND estudiantes_entregables.codigo_temporada_especialidad IS NULL

			AND estudiantes_entregables.codigo_estudiante IS NULL ;");

		return pg_num_rows($sql);
	}

	function VerificarEstudiantesSolventes($codigo) {
		$sql = 

		pg_query("SELECT true 

			FROM pasantias.temporadas_solicitud temp_s

			INNER JOIN pasantias.temporadas_especialidad temp_es

				ON temp_es.codigo_temporada =  temp_s.codigo_temporada

				AND temp_es.codigo_temporada_especialidad ='$codigo'

			INNER JOIN pasantias.entregable_temporada e_temp 

				ON  temp_s.codigo_temporada = e_temp.codigo_temporada

			INNER JOIN pasantias.entregable

				ON entregable.id_entregable = e_temp.id_entregable

			LEFT JOIN pasantias.estudiantes_entregables

				ON estudiantes_entregables.id_entregable = entregable.id_entregable

			WHERE estudiantes_entregables.id_entregable IS NOT NULL ;");

		return pg_num_rows($sql);
	}

	function VerificarRequiereTutores($codigo){

		return pg_fetch_assoc( 

		pg_query(" SELECT 

			ets.descripcion 

			FROM pasantias.temporadas_solicitud tem_s 

			Inner Join pasantias.temporadas_especialidad tem_e

				On tem_e.codigo_temporada = tem_s.codigo_temporada

				And tem_e.codigo_temporada_especialidad ='$codigo'

			Inner Join pasantias.encargado boss 

				On boss.codigo_encargado = tem_s.codigo_encargado

			Inner Join pasantias.encargado_tipo_solicitud ets 

				On ets.codigo_encargado  = boss.codigo_encargado

			Inner Join pasantias.tipo_solicitud tip_s

				On tip_s.id_tipo_solicitud = ets.id_tipo_solicitud

				And  tem_s.id_tipo_solicitud = tip_s.id_tipo_solicitud

				;") );
	}

	// ARMAR TABLAS POR CADA PESTAÑA ES DECIR SI SE  ENCUENTRA ESTUDIANTES QUE CLASIFIQUEN PARAAAAAA

	// ARMAR TABLAS POR CADA PESTAÑA ES DECIR SI SE  ENCUENTRA ESTUDIANTES QUE CLASIFIQUEN PARAAAAAA

	// ARMAR TABLAS POR CADA PESTAÑA ES DECIR SI SE  ENCUENTRA ESTUDIANTES QUE CLASIFIQUEN PARAAAAAA

	// ARMAR TABLAS POR CADA PESTAÑA ES DECIR SI SE  ENCUENTRA ESTUDIANTES QUE CLASIFIQUEN PARAAAAAA

	// 	 -------------- DATOS DATOS DATOS DATOS DATOS
	function BuscarEstudiantesNoPostulados($codigo_temporada_especialidad) {

	return pg_query("SELECT recibidas.*

	FROM (SELECT	 

	estudiante.expediente , 

	persona.nombre ||'  '|| persona.apellido as estudiante,

	persona.cedula , 
	
	persona.correo ,  
	
	persona.telefono ,
	
	estudiante.codigo_estudiante

	FROM pasantias.estudiante 

	INNER JOIN pasantias.temporadas_estudiantes

		ON temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante

	INNER JOIN pasantias.temporadas_especialidad

		ON temporadas_especialidad.codigo_temporada_especialidad = temporadas_estudiantes.codigo_temporada_especialidad

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

		ON solicitudes_enviadas.valor = estudiante.codigo_estudiante

		WHERE  solicitudes_enviadas.valor IS NULL ) as recibidas

	LEFT JOIN pasantias.solicitudes_recibidas 

	ON recibidas.codigo_estudiante = solicitudes_recibidas.valor

	WHERE solicitudes_recibidas.valor is null;");

	}
	function BuscarEstudiantesPostulados($codigo_temporada_especialidad) {

		$sql = pg_query("SELECT SucursalEnviada.* , organizacion.nombre_organizacion ,
			persona.nombre||' '|| persona.apellido as solicitant FROM

		(SELECT estudianteSolicitud.*  ,solicitudes_enviadas.valor as sucursal FROM

				( SELECT persona.nombre ||'  '|| persona.apellido as estudiante , persona.telefono
				,persona.correo , solicitud.codigo_solicitud ,estudiante.expediente ,persona.cedula
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
				,persona.correo , solicitud.codigo_solicitud ,estudiante.expediente ,persona.cedula
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
		return $sql;
	}

	function BuscarEstudiantesAprobadosOrganzizacion($codigo_temporada_especialidad) {

		$sql = pg_query("SELECT SucursalEnviada.* , organizacion.nombre_organizacion , 0 as cero
			, persona.nombre||' '|| persona.apellido as solicitant

		 FROM  (SELECT estudianteSolicitud.*  ,solicitudes_enviadas.valor as sucursal FROM

		( SELECT persona.nombre ||'  '|| persona.apellido as estudiante , persona.telefono
				,persona.correo , solicitud.codigo_solicitud , estudiante.expediente , persona.cedula,
				estudiante.codigo_estudiante

		FROM pasantias.encargado INNER JOIN pasantias.temporadas_solicitud

			ON encargado.codigo_encargado =  temporadas_solicitud.codigo_encargado

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

		INNER JOIN pasantias.persona

			ON persona.id_persona = persona_organizacion_oficina.id_persona


			AND persona.id_persona = CAST (solicitudes_enviadas.valor as BIGINT)


		UNION
		SELECT  postulacionDirecta.estudiante , postulacionDirecta.telefono ,
       			postulacionDirecta.correo , postulacionDirecta.codigo_solicitud,
       			postulacionDirecta.expediente , postulacionDirecta.cedula ,
        postulacionDirecta.codigo_estudiante, organizacionmunicipio.codigo_sucursal as sucursal ,
        organizacion.nombre_organizacion , 12 as cero , 'ESTUDIANTE' as solicitant
         FROM

		( SELECT persona.nombre ||'  '|| persona.apellido as estudiante , persona.telefono
				,persona.correo , solicitud.codigo_solicitud , persona.cedula ,  estudiante.expediente,
				estudiante.codigo_estudiante
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
		INNER JOIN pasantias.convenio_organizacion
			ON convenio_organizacion.id_organizacion=organizacion.id_organizacion

		GROUP BY postulacionDirecta.estudiante , postulacionDirecta.telefono ,
		postulacionDirecta.cedula ,postulacionDirecta.expediente , postulacionDirecta.codigo_solicitud,
		postulacionDirecta.correo , sucursal ,postulacionDirecta.codigo_estudiante, organizacion.nombre_organizacion");
		return $sql;

	}

	function BuscarEstudiantesSinTutores($codigo_temporada_especialidad) {
		$sql = pg_query("SELECT solicitudes_aprobadas.codigo_solicitud , persona.nombre ||' '|| persona.apellido as estudiante ,
	persona.correo , persona.telefono , estudiante.expediente ,cedula ,organizacion.nombre_organizacion,
	organizacionmunicipio.codigo_sucursal as sucursal
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
			WHERE responsables.codigo_solicitud IS NULL
			GROUP BY solicitudes_aprobadas.codigo_solicitud ,estudiante ,persona.correo ,
			persona.telefono ,estudiante.expediente,persona.cedula ,organizacion.nombre_organizacion
			,sucursal
			UNION
			SELECT solicitudes_aprobadas.codigo_solicitud , persona.nombre ||' '|| persona.apellido as estudiante ,
			persona.correo , persona.telefono , estudiante.expediente ,cedula ,organizacion.nombre_organizacion,
			organizacionmunicipio.codigo_sucursal as sucursal
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
			WHERE responsables.codigo_solicitud IS NULL
			GROUP BY solicitudes_aprobadas.codigo_solicitud ,estudiante ,persona.correo ,
			persona.telefono ,estudiante.expediente,persona.cedula ,organizacion.nombre_organizacion
			,sucursal;");

		return $sql;
	}
	function BuscarEstudiantesConTutores($codigo_temporada_especialidad) {
		$sql = pg_query(" SELECT Estudiantes.* ,persona .nombre || '  -  ' || persona. apellido as tutor_academico

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

	function BuscarEstudiantesNoSolventes($codigo_temporada_especialidad) {
	$sql = pg_query("SELECT  

		conteo_general - COUNT (entregable.id_entregable)  as entregable_asignado , 

		sql_conteo_total_entregables.*

		from ( Select 
		 	count(entregable.id_entregable) as conteo_general , sql_estudiantes.*
		from (

		Select 
		persona.cedula , 
		persona.nombre , 
		persona.apellido , 
		estudiante.expediente , 
		temporadas_solicitud.codigo_temporada,
		temporadas_estudiantes.codigo_estudiante , 
		temporadas_estudiantes.codigo_temporada_especialidad

		from pasantias.temporadas_solicitud
		
		Inner Join pasantias.temporadas_especialidad
		
			ON  temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada
		
			AND temporadas_solicitud.estatus='EN CURSO'
		
		Inner Join pasantias.temporadas_estudiantes
		
			ON temporadas_estudiantes.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
		
			AND temporadas_especialidad.codigo_temporada_especialidad = '$codigo_temporada_especialidad'
		
		Inner Join pasantias.estudiante
		
			ON estudiante.codigo_estudiante = temporadas_estudiantes.codigo_estudiante
		
		Inner Join  pasantias.persona_instituto_especialidad
		
			ON persona_instituto_especialidad.id_persona  	= 	estudiante.id_persona
		
			AND persona_instituto_especialidad.id_ip  			= 	estudiante.id_ip
		
			AND persona_instituto_especialidad.id_especialidad = 	estudiante.id_especialidad
		
			AND persona_instituto_especialidad.id_perfil   	= 	estudiante.id_perfil
		
		Inner Join pasantias.persona
		
			ON persona.id_persona = persona_instituto_especialidad.id_persona
		
		Inner Join pasantias.especialidad
		
			ON especialidad.id_especialidad = persona_instituto_especialidad.id_especialidad
		
		Inner Join pasantias.instituto_principal
		
			ON instituto_principal.id_ip = persona_instituto_especialidad.id_ip
		
		Inner Join pasantias.especialidad_instituto_principal
		
			ON  especialidad_instituto_principal.id_ip = instituto_principal.id_ip
		
			AND especialidad_instituto_principal.id_especialidad = especialidad.id_especialidad
		
			AND especialidad_instituto_principal.id_especialidad = persona_instituto_especialidad.id_especialidad
		
		Inner Join pasantias.perfil
		
			ON perfil.id_perfil = persona_instituto_especialidad.id_perfil
		)as sql_estudiantes

			Inner Join pasantias.entregable_temporada

				ON entregable_temporada.codigo_temporada = sql_estudiantes.codigo_temporada

			Inner Join pasantias.entregable

				ON entregable.id_entregable = entregable_temporada.id_entregable

			GROUP BY 

				sql_estudiantes.cedula , 
				sql_estudiantes.nombre , 
				sql_estudiantes.apellido ,
				sql_estudiantes.expediente , 
				sql_estudiantes.codigo_temporada,
				sql_estudiantes.codigo_estudiante , 
				sql_estudiantes.codigo_temporada_especialidad

			)as sql_conteo_total_entregables

		Inner Join pasantias.entregable_temporada

			ON  entregable_temporada.codigo_temporada = sql_conteo_total_entregables.codigo_temporada

		Inner Join pasantias.entregable

			ON entregable.id_entregable = entregable_temporada.id_entregable

		left Join  pasantias.estudiantes_entregables

			ON estudiantes_entregables.codigo_estudiante = sql_conteo_total_entregables.codigo_estudiante

			AND estudiantes_entregables.id_entregable    = entregable.id_entregable

			AND estudiantes_entregables.codigo_temporada_especialidad = sql_conteo_total_entregables.codigo_temporada_especialidad

		where  estudiantes_entregables.codigo_estudiante IS NULL

			AND estudiantes_entregables.id_entregable IS NULL

			AND estudiantes_entregables.codigo_temporada_especialidad IS NULL

		group by

			sql_conteo_total_entregables.cedula , 
			sql_conteo_total_entregables.nombre ,
			sql_conteo_total_entregables.apellido , 
			sql_conteo_total_entregables.expediente ,
			sql_conteo_total_entregables.codigo_temporada,
			sql_conteo_total_entregables.codigo_estudiante ,
			sql_conteo_total_entregables.conteo_general ,
			sql_conteo_total_entregables.codigo_temporada_especialidad  ;");

		return $sql;
	}

	function BuscarEstudiantesSolventes($codigo_temporada_especialidad) {
		$sql = pg_query("SELECT FROM pasantias. ;");
		return $sql;
	}

	function mensajeopiniouser($codigo_temporada_especialidad) {
		$sql = pg_query("SELECT true 

		FROM pasantias.tutor_academico 

		INNER JOIN pasantias.persona_instituto_especialidad p_i_e
		
			ON 	p_i_e.id_persona 	= tutor_academico.id_persona
		
			AND p_i_e.id_perfil 	= tutor_academico.id_perfil
		
			AND p_i_e.id_ip 		= tutor_academico.id_ip
		
			AND p_i_e.id_especialidad = tutor_academico.id_especialidad
		
		INNER JOIN pasantias.especialidad_instituto_principal
		
			ON  especialidad_instituto_principal.id_especialidad = p_i_e.id_especialidad
		
			AND especialidad_instituto_principal.id_ip 			 = p_i_e.id_ip
		
		INNER JOIN pasantias.instituto_principal
		
			ON instituto_principal.id_ip = especialidad_instituto_principal.id_ip
		
		INNER JOIN pasantias.persona
		
			ON persona.id_persona = p_i_e.id_persona
		
		INNER JOIN pasantias.organizacion
		
			ON organizacion.id_organizacion = instituto_principal.id_organizacion
		
		INNER JOIN pasantias.especialidad
		
			ON especialidad.id_especialidad = especialidad_instituto_principal.id_especialidad
		
		INNER JOIN pasantias.temporadas_especialidad
		
			ON temporadas_especialidad.id_especialidad = especialidad.id_especialidad
		
			AND temporadas_especialidad.codigo_temporada_especialidad = '$codigo_temporada_especialidad';");
		
		return pg_num_rows($sql);
	}
	function buscarTutoresResumen($codigo_temporada_especialidad) {
		$sql = pg_query("SELECT 

			persona.cedula , 
			
			persona.nombre , 
			
			persona.apellido , 
			
			tutor_academico.codigo_tutor_academico ,
			
			especialidad.nombre_especialidad 
			
			|| ' - ' || 
			
			tipo_especialidad.nombre_tipo_especialidad as especialidad

		FROM pasantias.tutor_academico

		INNER JOIN pasantias.persona_instituto_especialidad

			ON 	persona_instituto_especialidad.id_persona 	= tutor_academico.id_persona

			AND persona_instituto_especialidad.id_perfil 	= tutor_academico.id_perfil

			AND persona_instituto_especialidad.id_ip 		= tutor_academico.id_ip

			AND persona_instituto_especialidad.id_especialidad = tutor_academico.id_especialidad

		INNER JOIN pasantias.especialidad_instituto_principal

			ON  especialidad_instituto_principal.id_especialidad = persona_instituto_especialidad.id_especialidad

			AND especialidad_instituto_principal.id_ip 			 = persona_instituto_especialidad.id_ip

		INNER JOIN pasantias.instituto_principal

			ON instituto_principal.id_ip = especialidad_instituto_principal.id_ip

		INNER JOIN pasantias.persona

			ON persona.id_persona = persona_instituto_especialidad.id_persona

		INNER JOIN pasantias.organizacion

			ON organizacion.id_organizacion = instituto_principal.id_organizacion

		INNER JOIN pasantias.especialidad

			ON especialidad.id_especialidad = especialidad_instituto_principal.id_especialidad

		INNER JOIN pasantias.temporadas_especialidad

			ON temporadas_especialidad.id_especialidad = especialidad.id_especialidad

			AND temporadas_especialidad.codigo_temporada_especialidad = '$codigo_temporada_especialidad'

		INNER JOIN pasantias.tipo_especialidad

			ON tipo_especialidad.id_tipo_especialidad  = especialidad.id_tipo_especialidad;");

		return $sql;
	}

	function CantidadEstudiantesAsignadosTemporada($codigo_tutor_academico, $codigo_temporada_especialidad) {
		$sql = pg_query("SELECT true 

		FROM pasantias.responsables 
		
		INNER JOIN pasantias.solicitud
		
			ON solicitud.codigo_solicitud = responsables.codigo_solicitud
		
			AND responsables.table_column = 'tutor_academico.codigo_tutor_academico'
		
		INNER JOIN pasantias.temporadas_estudiantes
		
			ON temporadas_estudiantes.codigo_temporada_especialidad = solicitud.codigo_temporada_especialidad
		
			AND temporadas_estudiantes.codigo_estudiante = solicitud.codigo_estudiante
		
		INNER JOIN pasantias.temporadas_especialidad
		
			ON temporadas_especialidad.codigo_temporada_especialidad = temporadas_estudiantes.codigo_temporada_especialidad
		
			AND temporadas_especialidad.codigo_temporada_especialidad = '$codigo_temporada_especialidad'
		
		INNER JOIN pasantias.tutor_academico
		
			On tutor_academico.codigo_tutor_academico = responsables.valor
		
			AND tutor_academico.codigo_tutor_academico = '$codigo_tutor_academico'
		
			AND responsables.valor = '$codigo_tutor_academico' ;");

		return pg_num_rows($sql);
	}

	function EncargadoApruebaSolicitudAprobadaOrganizacion( $formun = array() ) {

		$codigo_estudiante = $formun['estudiantecaleta'];
		$codigo_solicitud  = $formun['aprobarsolicitudEncargado'];
		$encargado         = $formun['supervisor'];
		$sucursal          = $formun['codigo_sucursal'];

		$spera;

		$return = $this->VerifiacarOrigenSolicitud($codigo_estudiante, $codigo_solicitud, $encargado);
		
		if ($return['estudiante']['bool'] == 't') {
		
			$spera             = $this->ApruebaSolicitudDeEstudiante($codigo_solicitud, $sucursal);
		
			$return['factura'] = 'de Estudiante'.$spera;
		
		} else if ($return['empresa']['bool'] == 't') {
		
			$spera             = $this->ApruebaSolicitudDeEMpresa($codigo_solicitud, $codigo_estudiante);
		
			$return['factura'] = 'de Empresa'.$spera;
		
		}

		return $spera;
	}
	function VerifiacarOrigenSolicitud($codigo_estudiante, $codigo_solicitud, $encargado) {
		$sql_estudiantes_Postulado = 

		pg_query("SELECT true 

		FROM pasantias.temporadas_solicitud
		
		INNER JOIN pasantias.temporadas_especialidad
		
			ON temporadas_solicitud.codigo_temporada =temporadas_especialidad.codigo_temporada
		
		INNER JOIN pasantias.temporadas_estudiantes
		
			ON temporadas_estudiantes.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
		
		INNER JOIN pasantias.solicitud
		
			ON  solicitud.codigo_temporada_especialidad = temporadas_estudiantes.codigo_temporada_especialidad
		
			AND solicitud.codigo_estudiante = temporadas_estudiantes.codigo_estudiante
		
		INNER JOIN pasantias.solicitudes_enviadas
		
			ON  solicitudes_enviadas.codigo_solicitud = solicitud.codigo_solicitud
		
			AND solicitudes_enviadas.table_column = 'estudiante.codigo_estudiante'
		
			AND solicitudes_enviadas.codigo_solicitud = '$codigo_solicitud'
		
			AND solicitudes_enviadas.valor ='$codigo_estudiante'
		
		WHERE temporadas_solicitud.codigo_encargado = '$encargado'
		
			AND temporadas_estudiantes.codigo_estudiante='$codigo_estudiante';");
		
		$sql_Empresa_Solicitud = 

		pg_query("SELECT true 

		FROM pasantias.temporadas_solicitud
		
		INNER JOIN pasantias.temporadas_especialidad
		
			ON temporadas_solicitud.codigo_temporada =temporadas_especialidad.codigo_temporada
		
		INNER JOIN pasantias.temporadas_estudiantes
		
			ON temporadas_estudiantes.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
		
		INNER JOIN pasantias.solicitud
		
			ON  solicitud.codigo_temporada_especialidad = temporadas_estudiantes.codigo_temporada_especialidad
		
			AND solicitud.codigo_estudiante = temporadas_estudiantes.codigo_estudiante
		
		INNER JOIN pasantias.solicitudes_recibidas
		
			ON  solicitudes_recibidas.codigo_solicitud = solicitud.codigo_solicitud
		
			AND solicitudes_recibidas.table_column = 'estudiante.codigo_estudiante'
		
			AND solicitudes_recibidas.codigo_solicitud = '$codigo_solicitud'
		
			AND solicitudes_recibidas.valor ='$codigo_estudiante'
		
		WHERE temporadas_solicitud.codigo_encargado = '$encargado'
		
			AND temporadas_estudiantes.codigo_estudiante='$codigo_estudiante';");

		return array('estudiante' => pg_fetch_assoc($sql_estudiantes_Postulado), 'empresa' => pg_fetch_assoc($sql_Empresa_Solicitud));
	}

	function ApruebaSolicitudDeEMpresa($codigo_solicitud, $codigo_estudiante) {
		
		$sql      = pg_query("UPDATE pasantias.solicitudes_recibidas SET estatus='Listo' WHERE codigo_solicitud ='$codigo_solicitud' AND valor='$codigo_estudiante' AND table_column='estudiante.codigo_estudiante';") or die('ERROR AL ACTUALIZAR DATOS: '.pg_last_error());
		$registro = pg_affected_rows($sql);

		pg_free_result($sql);
		return $registro;
	}

	function ApruebaSolicitudDeEstudiante($codigo_solicitud, $codigo_sucursal) {
		
		$sql      = pg_query("UPDATE pasantias.solicitudes_recibidas SET estatus='Listo' WHERE codigo_solicitud ='$codigo_solicitud' AND valor='$codigo_sucursal' AND table_column='organizacionmunicipio.codigo_sucursal';") or die('ERROR AL ACTUALIZAR DATOS: '.pg_last_error());
		$registro = pg_affected_rows($sql);

		pg_free_result($sql);
		return $registro;
	}

	function BuscarTutoresParaELEstudianteTheSolicitud($codigo_solicitud) {
		$sql = pg_query("SELECT distinct tutor_academico.codigo_tutor_academico , persona.cedula , persona.nombre, persona.apellido
	FROM pasantias.solicitudes_aprobadas
	INNER JOIN pasantias.solicitud
		ON solicitud.codigo_solicitud = solicitudes_aprobadas.codigo_solicitud
		AND solicitud.codigo_solicitud='$codigo_solicitud'
	INNER JOIN pasantias.temporadas_especialidad
		ON temporadas_especialidad.codigo_temporada_especialidad = solicitud.codigo_temporada_especialidad
	INNER JOIN pasantias.especialidad
		ON especialidad.id_especialidad = temporadas_especialidad.id_especialidad
	INNER JOIN pasantias.tutor_academico
		ON tutor_academico.id_especialidad = especialidad.id_especialidad
	INNER JOIN pasantias.persona_instituto_especialidad
		ON persona_instituto_especialidad.id_especialidad = tutor_academico.id_especialidad
		AND persona_instituto_especialidad.id_persona = tutor_academico.id_persona
		AND persona_instituto_especialidad.id_ip = tutor_academico.id_ip
		AND persona_instituto_especialidad.id_perfil = tutor_academico.id_perfil
	INNER JOIN pasantias.persona
		ON persona.id_persona = persona_instituto_especialidad.id_persona
	INNER JOIN pasantias.instituto_principal
		ON instituto_principal.id_ip = persona_instituto_especialidad.id_ip
	INNER JOIN pasantias.organizacion
		ON organizacion.id_organizacion= instituto_principal.id_organizacion
	INNER JOIN pasantias.organizacionmunicipio
		ON organizacionmunicipio.id_organizacion = organizacion.id_organizacion;");
		return $sql;
	}

	function AsignarTutorAcademico($arreglo = array()) {

		$codigo_solicitud       = $arreglo['codigo_solicitud_caleta'];
		$codigo_tutor_academico = $arreglo['codigo_tutor_caleta'];
		$sql                    = 
		pg_query("INSERT INTO pasantias.responsables (codigo_solicitud , table_column ,valor , estatus , fecha_asignacion)
			VALUES ('$codigo_solicitud','tutor_academico.codigo_tutor_academico' ,'$codigo_tutor_academico','ASIGNADO',now() );");
		
		$registro = pg_affected_rows($sql);

		pg_free_result($sql);

		return $registro;
	}

	function CargarTemporadasParaHabilitarEnCurso($codigo_encargado) {

		return pg_query("SELECT 
			
		sqlvirtualtabla.* , 

		Count (temporadas_estudiantes.codigo_temporada_especialidad) as total_estudiantes ,

		CASE WHEN sqlvirtualtabla.codigo_temporada is not null THEN

			(SELECT COUNT(entregable_temporada.codigo_temporada) as total_entregables 

			FROM pasantias.entregable_temporada 

			LEFT JOIN pasantias.temporadas_solicitud

				ON temporadas_solicitud.codigo_temporada = entregable_temporada.codigo_temporada

			WHERE temporadas_solicitud.codigo_temporada = sqlvirtualtabla.codigo_temporada )

		END AS todal_entregables

		FROM ( SELECT 

			tipo_solicitud.nombre_tipo_solicitud ,

			Count(temporadas_especialidad.codigo_temporada) as totalespecialidades ,

		 	to_char(periodo_solicitud.fecha_inicio, 'DD, TMMonth YYYY')

		 	|| ' al ' ||

		 	to_char(periodo_solicitud.fecha_fin, 'DD, TMMonth YYYY') as periodo,

			temporadas_solicitud.estatus ,

			temporadas_solicitud.codigo_temporada

		 FROM pasantias.temporadas_solicitud 

		 INNER JOIN pasantias.temporadas_especialidad
		 
		 		ON temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada  
		 
		 INNER JOIN pasantias.especialidad
		 		
		 		ON especialidad.id_especialidad = temporadas_especialidad.id_especialidad 
		 
		 INNER JOIN pasantias.tipo_solicitud
		 		
		 		ON tipo_solicitud.id_tipo_solicitud = temporadas_solicitud.id_tipo_solicitud  
		 
		 INNER JOIN pasantias.periodo_solicitud
		 		
		 		ON periodo_solicitud.id_periodo = temporadas_solicitud.id_periodo 
		 		
		 		AND temporadas_solicitud.codigo_encargado='$codigo_encargado'

		 GROUP BY 
		 tipo_solicitud.nombre_tipo_solicitud , 

		 periodo ,

		 temporadas_solicitud.estatus,

		 temporadas_solicitud.codigo_temporada) as sqlvirtualtabla 

		 INNER JOIN pasantias.temporadas_especialidad

		 	ON temporadas_especialidad.codigo_temporada = sqlvirtualtabla.codigo_temporada

		 INNER JOIN pasantias.temporadas_estudiantes

		 	ON temporadas_estudiantes.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad

		 INNER JOIN pasantias.estudiante

		 	ON estudiante.codigo_estudiante = temporadas_estudiantes.codigo_estudiante

		 GROUP BY 

		 sqlvirtualtabla.nombre_tipo_solicitud , 
		 
		 sqlvirtualtabla.periodo ,
		 
		 sqlvirtualtabla.estatus,

		 sqlvirtualtabla.codigo_temporada , 
		 
		 sqlvirtualtabla.totalespecialidades

		 ;");
		 
	}

	function ExtraerEspecialidadesAsignadassegunTemporada($codigo_temporada) {
		$value = pg_query(" SELECT 

			nombre_especialidad ,
			
			tipo_especialidad.nombre_tipo_especialidad, 
			
			tipo_especialidad.id_tipo_especialidad ,
	 		
	 		temporadas_solicitud.estatus , 
	 		
	 		temporadas_especialidad.codigo_temporada_especialidad, 
	 		
	 		palabraMasLarga.maxlength  FROM

		( SELECT cast ( length( nombre_especialidad ) as int)+1  as maxlength
		
		FROM pasantias.temporadas_solicitud 

		INNER JOIN pasantias.temporadas_especialidad
		
			ON temporadas_solicitud.codigo_temporada =  temporadas_especialidad.codigo_temporada
		
		INNER JOIN pasantias.especialidad
		
			ON especialidad.id_especialidad = temporadas_especialidad.id_especialidad
		
			AND temporadas_solicitud.codigo_temporada = '$codigo_temporada'
		
		WHERE cast ( length( nombre_especialidad ) as int) =
		
		(SELECT  MAX(cast ( length( nombre_especialidad ) as int))
			
		FROM pasantias.especialidad 

		INNER JOIN pasantias.temporadas_especialidad

			ON temporadas_especialidad.id_especialidad = especialidad.id_especialidad
			
			ANd temporadas_especialidad.codigo_temporada = '$codigo_temporada' ) ) as palabraMasLarga,
		
		pasantias.temporadas_solicitud
		 
		INNER JOIN pasantias.temporadas_especialidad
		
			On temporadas_especialidad.codigo_temporada = temporadas_solicitud .codigo_temporada
		
			AND temporadas_especialidad.codigo_temporada='$codigo_temporada'
		
		INNER JOIN pasantias.especialidad
		
			on especialidad.id_especialidad = temporadas_especialidad.id_especialidad
		
		INNER JOIN pasantias.tipo_especialidad
		
			on tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad
	
	GROUP BY  

	nombre_especialidad , 
	
	tipo_especialidad.nombre_tipo_especialidad ,  
	
	tipo_especialidad.id_tipo_especialidad ,
	
	temporadas_solicitud.estatus,temporadas_especialidad.codigo_temporada_especialidad,
	
	palabraMasLarga.maxlength 

	ORDER BY 

	nombre_tipo_especialidad, nombre_especialidad ;");
	
		$data = array();

		while ($fila = pg_fetch_assoc($value)) {
			$fila['numeroEstudiantes'] =
			
			$this->cotarCuantosEstudiantesSegunEspecialidadTemporada($fila['codigo_temporada_especialidad']);
			
			$fila['numespecialidadestipo'] = $this->calcularCuantosespecialidadestotal($codigo_temporada, $fila['id_tipo_especialidad']);
			
			$data[]                        = $fila;
		}
		return $data;

	}

	function agregarPuntitosDerechos($palabra, $maxima_palabra) {
		
		$numeroPalabras           = strlen($palabra);
		
		$TotaldeEspaciosAgregados = $maxima_palabra-$numeroPalabras;
		
		for ($i = 0; $i < $TotaldeEspaciosAgregados; $i++) {
		
			$palabra = $palabra.'&nbsp;';
		
		}
		
		return $palabra;
	}

	function AbrirTemporada($codigo_temporada, $codigo_encargado) {
		
		$sql = pg_query("UPDATE pasantias.temporadas_solicitud SET estatus='EN CURSO' WHERE codigo_temporada='$codigo_temporada' AND codigo_encargado='$codigo_encargado' ;");
		
		$num = pg_affected_rows($sql);
		
		pg_free_result($sql);
		
		return $num;
	}

	function cotarCuantosEstudiantesSegunEspecialidadTemporada($codigo_temporada_especialidad) {

	$psql = pg_query("SELECT 
		
		count(tem_e.codigo_temporada_especialidad) as estudiantesAsignadosSegunEspecialidad
		
	FROM pasantias.temporadas_especialidad temp_esp
	
	INNER JOIN pasantias.temporadas_estudiantes tem_e
	
		ON temp_esp.codigo_temporada_especialidad =tem_e.codigo_temporada_especialidad
	
		AND tem_e.codigo_temporada_especialidad = '$codigo_temporada_especialidad' ;");
	
	$row = pg_fetch_array($psql);
	
	return $row[0];
	}
	// -------------------------------------------- E N T R E G A B L E S ---------- E N T R E G A B L E S
	// -------------------------------------------- E N T R E G A B L E S ---------- E N T R E G A B L E S

	function VerificarExistenciaEntregable($nombre_entregable) {
		$sql = pg_query("SELECT id_entregable FROM pasantias.entregable  WHERE nombre_entregable =upper('$nombre_entregable');");

		return pg_num_rows($sql);
	}
	function id_entregable_existente($nombre_entregable) {
		$sql = pg_query("SELECT id_entregable FROM pasantias.entregable WHERE nombre_entregable =upper('$nombre_entregable') ;");
		$row = pg_fetch_array($sql);
		return $row[0];
	}

	function RegistrarEntregable($nombre_entregable) {
		$sql = pg_query("INSERT INTO pasantias.entregable VALUES ( upper('$nombre_entregable'),now() ) ;");
		$num = pg_affected_rows($sql);
		pg_free_result($sql);
		return $num;
	}
	function asignarEntregable($id_entregable, $codigo_temporada) {
		$sql = pg_query("INSERT INTO pasantias.entregable_temporada
			( id_entregable, codigo_temporada , descripcion_entregable , fecha_asignacion , estatus_entregable)
			 VALUES ( $id_entregable, '$codigo_temporada','NO DESCRIPCION' ,now() ,'ACTIVO' ) ;");
		$num = pg_affected_rows($sql);
		pg_free_result($sql);
		return $num;
	}

	function BuscarEstaAsignacion($id_entregable, $codigo_temporada) {
		$sql = pg_query("SELECT

		 entregable_temporada.codigo_temporada
				
		FROM pasantias.entregable_temporada 

		INNER JOIN pasantias.entregable
				
			ON  entregable.id_entregable = entregable_temporada.id_entregable
				
		INNER JOIN pasantias.temporadas_solicitud
				
			ON temporadas_solicitud.codigo_temporada = entregable_temporada.codigo_temporada
				
		WHERE entregable_temporada.id_entregable = $id_entregable
					
			AND entregable_temporada.codigo_temporada ='$codigo_temporada';");

		return pg_num_rows($sql);
	}
	function ProcesarEntregable($nombre_entregable, $codigo_temporada) {
		$registro;
		$asignacion;
		$veriM                                        = $this->VerificarExistenciaEntregable($nombre_entregable);
		if ($veriM == 1) {$id_entregable              = $this->id_entregable_existente($nombre_entregable);
			$existenciaAsignacion                        = $this->BuscarEstaAsignacion($id_entregable, $codigo_temporada);
			if ($existenciaAsignacion == 1) {$asignacion = 'Ya Existe Asignado';} else
			if ($existenciaAsignacion == 0) {$asignacion = $this->asignarEntregable($id_entregable, $codigo_temporada);}
			$registro                                    = 'Ya Existe';
		}
		if ($veriM == 0) {$registro          = $this->RegistrarEntregable($nombre_entregable);
			if ($registro == 1) {$id_entregable = $this->id_entregable_existente($nombre_entregable);
				$asignacion                        = $this->asignarEntregable($id_entregable, $codigo_temporada);} else
			if ($registro == 0) {$registro      = 'No Se Pudo Registrar';}
		}
		return array('Registro' => $registro, 'asignacion' => $asignacion);
	}

	function BuscarParaAutoComplete($codigo_temporada) {
		
		return pg_query("SELECT nombre_entregable FROM  pasantias.entregable ORDER BY nombre_entregable ;");
		 
	}

	function BuscarEntregablesAsignados($codigo_temporada) {
		$sql = pg_query("SELECT 

			entregable.nombre_entregable ,

			entregable.id_entregable

			FROM pasantias.entregable
			
			INNER JOIN pasantias.entregable_temporada
			
				ON entregable.id_entregable =entregable_temporada.id_entregable
			
			INNER JOIN pasantias.temporadas_solicitud
			
				ON temporadas_solicitud.codigo_temporada = entregable_temporada.codigo_temporada
			
			AND temporadas_solicitud.codigo_temporada  ='$codigo_temporada'
			
			ORDER BY entregable.nombre_entregable ;");
		return $sql;
	}
	function BuscarEntregablesNoAsignados($codigo_temporada) {
		return pg_query("SELECT 
		
		entregable.nombre_entregable ,
			
		entregable.id_entregable
		
		FROM pasantias.entregable
		
		LEFT JOIN pasantias.entregable_temporada
		
			ON entregable.id_entregable =entregable_temporada.id_entregable
		
			AND entregable_temporada.codigo_temporada  ='$codigo_temporada'

		WHERE entregable_temporada.codigo_temporada is null
			
		ORDER BY entregable.nombre_entregable ;");
		 
	}

	// UPDATE ENTREGABLE DESDE MODAL
	function ProcesarActualizacionEntregable($nombre_entregable, $nombre_entregableViejo, $codigo_temporada, $id_entregableViejo) {
		$variableMensage = array();
		$evaluarDatos    = $this->VerificarDatosViejosUpdate($nombre_entregableViejo, $id_entregableViejo, $codigo_temporada);
		if ($evaluarDatos == 'YES') {
			if ($this->VerificarExistenciaEntregable($nombre_entregable) == 1) {
				$id_entregablenuevo = $this->id_entregable_existente($nombre_entregable);
				if ($this->BuscarEstaAsignacion($id_entregablenuevo, $codigo_temporada) == 0) {
					$ActualizacionAsignacion                                      = $this->ActualizarasignacionEntregable($id_entregablenuevo, $codigo_temporada, $id_entregableViejo);
					if ($ActualizacionAsignacion == 1) {$variableMensage['title'] = 'Bien';
						$variableMensage['messge']                                   = 'El Entregable Fué Asignado';
						$variableMensage['alert']                                    = 'success';
					} else {
						$variableMensage['title']  = 'Ups ....';
						$variableMensage['messge'] = 'Ocurrió  un error en Asignación';
						$variableMensage['alert']  = 'error';
					}
				} else {
					$variableMensage['title']  = 'Atención ....';
					$variableMensage['messge'] = '"'.$nombre_entregable.'" ya existe';
					$variableMensage['alert']  = 'warning';
				}

			} else {
				if ($this->RegistrarEntregable($nombre_entregable) == 1) {
					$id_entregablenuevo = $this->id_entregable_existente($nombre_entregable);
					$this->QuitarAsignacionEntregable($id_entregableViejo, $codigo_temporada);

					if ($this->asignarEntregable($id_entregablenuevo, $codigo_temporada) == 1) {$variableMensage['title'] = 'Bien';
						$variableMensage['messge']                                                                           = 'El Entregable Fué Asignado';
						$variableMensage['alert']                                                                            = 'success';
					} else {
						$variableMensage['title']  = 'Ups ....';
						$variableMensage['messge'] = 'Ocurrió  un error en Asignación';
						$variableMensage['alert']  = 'error';
					}

				} else {
					$variableMensage['title']  = 'Ups ....';
					$variableMensage['messge'] = 'El Entregable no se pudo Registrar';
					$variableMensage['alert']  = 'error';

				}
			}
		} else { $variableMensage['title'] = 'Atención';
			$variableMensage['messge']        = $evaluarDatos;
			$variableMensage['alert']         = 'warning';
		}
		return $variableMensage;
	}

	// FUNTION VErificar Datos Anteriores

	function VerificarDatosViejosUpdate($Entregable, $id_entregable, $codigo_temporada) {
		$desition;
		$informacion_Asignacion_validada =
		$this->VerificoTreParametrosExistentes($Entregable, $id_entregable, $codigo_temporada);
		if ($informacion_Asignacion_validada == 1) {
			$returnN                                                            = $this->VerificoNombreEntregable($Entregable);
			$returnI                                                            = $this->VerificoIdEntregable($id_entregable);
			$returnA                                                            = $this->VerificoAsignacionEntregable($id_entregable, $codigo_temporada);
			if ($returnN == 1 && $returnI == 1 && $returnA == 1) {$desition     = 'YES';
			} else if ($returnN != 1 || $returnI != 1|$returnA != 1) {$desition = 'Los Datos Enviados No Corresponden';
			}
		} else if ($informacion_Asignacion_validada < 1) {$desition = 'Los Datos Enviados No Corresponden';}
		return $desition;
	}


	// FUNTION VErificar Existencia

	function VerificoTreParametrosExistentes($Entregable, $id_entregableViejo, $codigo_temporada) {
		$sql = pg_query("SELECT true FROM pasantias.entregable INNER JOIN pasantias.entregable_temporada

 			ON entregable.id_entregable = entregable_temporada.id_entregable

 		INNER JOIN pasantias.temporadas_solicitud

 			ON temporadas_solicitud.codigo_temporada = entregable_temporada.codigo_temporada

 		WHERE  	entregable.nombre_entregable=upper('$Entregable')
 			AND entregable.id_entregable=$id_entregableViejo
 			AND entregable_temporada.id_entregable=$id_entregableViejo
 			AND entregable_temporada.codigo_temporada='$codigo_temporada'
 			AND temporadas_solicitud.codigo_temporada='$codigo_temporada';");
		return pg_num_rows($sql);
	}

	 // Verificar Existencia

	function VerificoNombreEntregable($Entregable) {
		$sql = pg_query("SELECT true FROM pasantias.entregable WHERE entregable.nombre_entregable=upper('$Entregable') ;");
		return pg_num_rows($sql);
	}

	// Verificar ID ENtregable

	function VerificoIdEntregable($Id_Entregable) {
		$sql = pg_query("SELECT true FROM pasantias.entregable WHERE entregable.id_entregable=$Id_Entregable ;");
		return pg_num_rows($sql);
	}

	// Verificar Asignacion 

	function VerificoAsignacionEntregable($Id_Entregable, $codigo_temporada) {
		$sql = pg_query("SELECT true FROM pasantias.entregable_temporada INNER JOIN pasantias.entregable
 			ON entregable_temporada.id_entregable = entregable.id_entregable
 		INNER JOIN pasantias.temporadas_solicitud
 			ON temporadas_solicitud.codigo_temporada = entregable_temporada.codigo_temporada
 			AND entregable_temporada.codigo_temporada='$codigo_temporada'
 			AND entregable_temporada.id_entregable=$Id_Entregable;");
		return pg_num_rows($sql);
	}

	// Operaciones de BD No REcuperacion de la Data
	// Operaciones de BD No REcuperacion de la Data

	function ActualizarasignacionEntregable($id_entregablenuevo, $codigo_temporada, $id_entregableViejo) {
		$sql = pg_query("UPDATE pasantias.entregable_temporada SET id_entregable=$id_entregablenuevo
 			WHERE  codigo_temporada='$codigo_temporada' AND id_entregable=$id_entregableViejo;");
		$num = pg_affected_rows($sql);
		pg_free_result($sql);
		return $num;
	}

	function QuitarAsignacionEntregable($id_entregable, $codigo_temporada) {

		$sql = pg_query("DELETE FROM pasantias.entregable_temporada
 			WHERE entregable_temporada.id_entregable=$id_entregable AND entregable_temporada.codigo_temporada='$codigo_temporada' ;");
		$num = pg_affected_rows($sql);
		pg_free_result($sql);
		return $num;
	}
	// FIN DE UPDATE ACTIALIZAR CAMPO ENTREGABLE
	// INICIO FUNCION DE  QUITAR ASICNACION ENTREGABLE
	function QuitarEntregable($entregable, $id_entregableviejo, $codigo_temporada) {
		$message = array();
		$sql     = pg_query("DELETE FROM pasantias.entregable_temporada WHERE id_entregable=$id_entregableviejo
 		AND codigo_temporada='$codigo_temporada' ;");
		$num = pg_affected_rows($sql);
		pg_free_result($sql);
		if ($num == 1) {
			$message['titled']      = 'Bien';
			$message['textmesagge'] = 'El Entregable Se Eliminó Correctamente';
			$message['alert']       = 'success';
		} else if ($num < 1) {
			$message['titled']      = 'Ups ..';
			$message['textmesagge'] = ' Ocurrion un Error ';
			$message['alert']       = 'error';
		}
		return $message;
	}
	// FIN FUNCION DE  QUITAR ASICNACION ENTREGABLE
	// INICIO ASIGNACION LOTE DE ENTREGABLES
	function asignarLoteEntregables($ids, $codigo_temporada) {
		$num = 0;
		foreach ($ids as $key => $value) {
			$existenciaAsignacion = $this->BuscarEstaAsignacion($value, $codigo_temporada);
			if ($existenciaAsignacion == 0) {
				$num = $num+$this->asignarEntregable($value, $codigo_temporada);
			}

		}

		return $num;
	}
	// FIN ASIGNACION LOTE DE ENTREGABLES

	// INICIO HACER RESUME DE UNA TEMPORADA DE SOLICITUD

	function ResumenTemporada($codigo_temporada) {
		$sqlEspecialidad = pg_query(" SELECT

		 	COUNT(especialidades.codigo_estudiante) as cantidad_estudiantes,

 			especialidades.nombre_especialidad , 

 			especialidades.nombre_tipo_especialidad , 

 			especialidades.id_tipo_especialidad 

 			FROM

 			(SELECT  
 			especialidad.nombre_especialidad , 

 			temporadas_estudiantes.codigo_estudiante , 

 			tipo_especialidad.nombre_tipo_especialidad,

 			tipo_especialidad.id_tipo_especialidad

 			FROM pasantias.temporadas_solicitud

 			INNER JOIN pasantias.temporadas_especialidad
 			
 				ON temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada
 			
 				AND temporadas_solicitud.codigo_temporada = '$codigo_temporada'
 			
 			INNER JOIN pasantias.especialidad
 			
 				ON especialidad.id_especialidad = temporadas_especialidad.id_especialidad
 			
 			INNER JOIN pasantias.tipo_especialidad
 			
 				ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad
 			
 			INNER JOIN pasantias.temporadas_estudiantes
 			
 				ON temporadas_estudiantes.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad )
 		as especialidades

 		GROUP BY 

 		especialidades.nombre_especialidad , 
 		
	 	especialidades.nombre_tipo_especialidad , 
	 		
	 	especialidades.id_tipo_especialidad

 		ORDER BY 
 		
	 	especialidades.nombre_tipo_especialidad ,
	 		
	 	especialidades.nombre_especialidad ;");

		$sqlEntregable = pg_query(" SELECT  

			entregable.nombre_entregable

 			FROM pasantias.temporadas_solicitud 

 			INNER JOIN pasantias.entregable_temporada

 				ON temporadas_solicitud.codigo_temporada = entregable_temporada.codigo_temporada

 				AND temporadas_solicitud.codigo_temporada = '$codigo_temporada'

 			INNER JOIN pasantias.entregable

 				On entregable.id_entregable = entregable_temporada.id_entregable ;");

		return array('especialidad' => $sqlEspecialidad, 'entregable' => $sqlEntregable);
	}

	function calcularCuantosespecialidadestotal($codigo_temporada, $id_tipo_especialidad) {

		$sql = pg_query("SELECT 

		count(especialidades.nombre_especialidad) as cantidad , 

		especialidades.nombre_tipo_especialidad 

		FROM

		 (SELECT  

		 especialidad.nombre_especialidad , 

		 tipo_especialidad.nombre_tipo_especialidad

		FROM pasantias.temporadas_solicitud

		INNER JOIN pasantias.temporadas_especialidad

			ON temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada

			AND temporadas_solicitud.codigo_temporada = '$codigo_temporada'

		INNER JOIN pasantias.especialidad

			 ON especialidad.id_especialidad = temporadas_especialidad.id_especialidad

		INNER JOIN pasantias.tipo_especialidad

		 	ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad

		 	AND tipo_especialidad.id_tipo_especialidad = $id_tipo_especialidad)

		 as especialidades

		GROUP BY especialidades.nombre_tipo_especialidad;");

		$fila = pg_fetch_row($sql);

		return $fila[0];
	}

	function buscaEstetutor($codigo_tutor) {
		$sql = pg_query("SELECT true 

		FROM pasantias.tutor_academico

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

			ON persona.id_persona =  persona_instituto_especialidad.id_persona

		WHERE tutor_academico.codigo_tutor_academico = '$codigo_tutor';");

		return pg_num_rows($sql);
	}

	// FIN HACER RESUME DE UNA TEMPORADA DE SOLICITUD

	// INICIO PROGRAMANDO EN ENERO DE UN DIA  PARA  OTRO COMO SIEMPRE NO MUY CONTENTO CON ESTA GENTE ...

	function Cerrar_temporada_solicitud($codigo_temporada, $El_que_quiere_cerrar_la_temporada) {
		if ($this->Verificar_existencia_encargado($El_que_quiere_cerrar_la_temporada) != 1) {
			$valor = $this->Verificar_existencia_codigo_temporada($codigo_temporada, $El_que_quiere_cerrar_la_temporada);
			if ($valor == 1) {
				$sql   = pg_query("UPDATE pasantias.temporadas_solicitud set estatus ='CERRADO' WHERE codigo_temporada ='$codigo_temporada';");
				$valor = pg_affected_rows($sql);

			} else {
				$valor = 'Problemas Con el Codigo';
			}
		} else {
			$valor = 'La persona Que Quiere Cerrar la Temporada no existe';
		}

		return $valor;
	}

	function Verificar_existencia_codigo_temporada($codigo_temporada, $codigo_encargado) {
		$sql = pg_query("SELECT true FROM  pasantias.temporadas_solicitud
 			WHERE codigo_temporada ='$codigo_temporada' AND estatus='EN CURSO' AND codigo_encargado ='$codigo_encargado' ;");
		return pg_num_rows($sql);
	}

	function Verificar_existencia_codigo_temporada_especialidad($codigo_temporada_especialidad) {
	
	$sql = pg_query("SELECT true 

		FROM  pasantias.temporadas_especialidad
  			
  		INNER JOIN pasantias.temporadas_solicitud
  			
  			ON temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada
 			
 		WHERE temporadas_especialidad.codigo_temporada_especialidad ='$codigo_temporada_especialidad'
 			
 		AND temporadas_solicitud.estatus='EN CURSO' ;");

		return pg_num_rows($sql);
	}

	function Verificar_existencia_encargado($codigo_encargado) {
		return pg_num_rows(pg_query("SELECT true 

	FROM pasantias.encargado

 	 INNER JOIN pasantias.persona_organizacion_oficina

		ON encargado.id_persona = persona_organizacion_oficina.id_persona
	
		AND encargado.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal
	
		AND encargado.id_perfil = persona_organizacion_oficina.id_perfil
	
		AND encargado.id_oficina = persona_organizacion_oficina.id_oficina
	
	INNER JOIN pasantias.organizacionmunicipio
	
		ON organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal
	
	INNER JOIN pasantias.persona
	
		ON persona_organizacion_oficina.id_persona = persona.id_persona
	
	INNER JOIN pasantias.temporadas_solicitud
	
		ON temporadas_solicitud.codigo_encargado= encargado.codigo_encargado
	
	 	WHERE encargado.codigo_encargado = '$codigo_encargado';"));

	}

	function verificar_existencia_estudiante($codigo_estudiante, $codigo_temporada_especialida) {

		$sql = pg_query("SELECT true 

		FROM pasantias.estudiante

		INNER JOIN pasantias.persona_instituto_especialidad

			ON  persona_instituto_especialidad.id_persona = estudiante.id_persona

			AND persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad

			AND persona_instituto_especialidad.id_ip = estudiante.id_ip

			AND persona_instituto_especialidad.id_perfil = estudiante.id_perfil

			AND estudiante.codigo_estudiante = '$codigo_estudiante'

		INNER JOIN pasantias.persona

			ON persona.id_persona =  persona_instituto_especialidad.id_persona

		INNER JOIN pasantias.especialidad

			ON especialidad.id_especialidad = persona_instituto_especialidad.id_especialidad

		INNER JOIN pasantias.especialidad_instituto_principal

			ON  especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip

		INNER JOIN pasantias.instituto_principal

			ON instituto_principal.id_ip = especialidad_instituto_principal.id_ip

		INNER JOIN pasantias.temporadas_especialidad

			ON temporadas_especialidad.id_especialidad = especialidad.id_especialidad

		INNER JOIN pasantias.temporadas_solicitud

			ON temporadas_solicitud.codigo_temporada = temporadas_especialidad.codigo_temporada

		INNER JOIN pasantias.temporadas_estudiantes

			ON temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante

			AND temporadas_especialidad.codigo_temporada_especialidad = temporadas_estudiantes.codigo_temporada_especialidad

		WHERE temporadas_especialidad.codigo_temporada_especialidad  = '$codigo_temporada_especialida' ;");

		return pg_num_rows($sql);
	}

	function Buscar_entregables_segun_estudiante($codigo_estudiante, $codigo_temporada_especialidad)
	{
		$verifica_cion = "s"; $sqlNo = ""; $sqlSi = ""; $sqlDatosEstudiante = ""; $sqlProceso ="";

		if ($this->Verificar_existencia_codigo_temporada_especialidad($codigo_temporada_especialidad) == 1) {

			if ($this->verificar_existencia_estudiante($codigo_estudiante, $codigo_temporada_especialidad) > 0) {

				$sqlNo = $this->sql_buscar_cada_entregable_faltante_estudiante($codigo_estudiante, $codigo_temporada_especialidad);

				$sqlSi = $this->sql_buscar_cada_entregable_asignado_estudiante($codigo_estudiante, $codigo_temporada_especialidad);

				$sqlDatosEstudiante = $this->sql_buscar_Datos_Estudiante($codigo_estudiante, $codigo_temporada_especialidad);

				$sqlProceso = $this->CalcularProgresoEstudiante($codigo_estudiante, $codigo_temporada_especialidad);

			} else { $verifica_cion = 0;}

		} else { $verifica_cion = 0;}

		return array('V'   => $verifica_cion,

					'sqlN' => $sqlNo,

					'sqlA' => $sqlSi,

					'sqlE' => $sqlDatosEstudiante,

					'sqlP' => $sqlProceso);
	}

	function sql_buscar_cada_entregable_faltante_estudiante($codigo_estudiante, $codigo_temporada_especialida) {

		return pg_query("SELECT 

			entregable.nombre_entregable , 

			entregable.id_entregable 

		FROM pasantias.entregable

		INNER JOIN pasantias.entregable_temporada

			ON entregable_temporada.id_entregable =  entregable.id_entregable

		INNER JOIN pasantias.temporadas_solicitud

			ON temporadas_solicitud.codigo_temporada = entregable_temporada.codigo_temporada

		INNER JOIN pasantias.temporadas_especialidad

			ON temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada

		INNER JOIN pasantias.temporadas_estudiantes

			ON temporadas_estudiantes.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad

		INNER JOIN pasantias.estudiante

			On estudiante.codigo_estudiante = temporadas_estudiantes.codigo_estudiante

		LEFT JOIN pasantias.estudiantes_entregables

			ON estudiantes_entregables.id_entregable  = entregable.id_entregable

			AND estudiantes_entregables.codigo_estudiante  =  temporadas_estudiantes.codigo_estudiante

			AND estudiantes_entregables.codigo_temporada_especialidad = temporadas_estudiantes.codigo_temporada_especialidad

		WHERE estudiantes_entregables.id_entregable  IS NULL

			AND estudiantes_entregables.codigo_estudiante  IS NULL

			AND estudiantes_entregables.codigo_temporada_especialidad IS NULL

			AND   estudiante.codigo_estudiante = '$codigo_estudiante'

			AND temporadas_especialidad.codigo_temporada_especialidad = '$codigo_temporada_especialida' ;");
	}

	function sql_buscar_cada_entregable_asignado_estudiante($codigo_estudiante, $codigo_temporada_especialida) {

		return pg_query("SELECT
	CASE

	WHEN (estudiantes_entregables_valor.id_estudiantes_entregables is null) THEN false

	WHEN (estudiantes_entregables_valor.id_estudiantes_entregables is not null) THEN true END as descripcion,

sqlINterna.* FROM pasantias.estudiantes_entregables_valor RIGHT JOIN  (

SELECT nombre_entregable , entregable .id_entregable ,

			to_char(fecha_entrega, 'DD, TMMonth YYYY') as fecha_entrega ,

			id_estudiantes_entregables

			FROM pasantias.entregable

 					INNER JOIN pasantias.entregable_temporada

 						ON entregable_temporada.id_entregable = entregable.id_entregable

 					INNER JOIN pasantias.temporadas_solicitud

 						ON temporadas_solicitud.codigo_temporada = entregable_temporada.codigo_temporada

 					INNER JOIN pasantias.temporadas_especialidad

 						ON temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada

 					INNER JOIN pasantias.temporadas_estudiantes

 						ON temporadas_estudiantes.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad

 					INNER JOIN pasantias.estudiante

 						On estudiante.codigo_estudiante = temporadas_estudiantes.codigo_estudiante

 					LEFT JOIN pasantias.estudiantes_entregables

 						ON estudiantes_entregables.id_entregable = entregable.id_entregable

 						AND estudiantes_entregables.codigo_estudiante = temporadas_estudiantes.codigo_estudiante

 						AND estudiantes_entregables.codigo_temporada_especialidad = temporadas_estudiantes.codigo_temporada_especialidad

 					WHERE estudiantes_entregables.id_entregable                  IS NOT NULL

 					 	AND estudiantes_entregables.codigo_estudiante             IS NOT NULL

 					 	AND estudiantes_entregables.codigo_temporada_especialidad IS NOT NULL

 					 	AND estudiante.codigo_estudiante = '$codigo_estudiante'

 						AND temporadas_especialidad.codigo_temporada_especialidad = '$codigo_temporada_especialida'

 					GROUP BY nombre_entregable , entregable.id_entregable , fecha_entrega ,id_estudiantes_entregables

) as sqlINterna

	ON  sqlINterna.id_estudiantes_entregables =estudiantes_entregables_valor.id_estudiantes_entregables ;");

	}

	function sql_buscar_Datos_Estudiante($codigo_estudiante, $codigo_temporada_especialidad) {

		$sql = pg_query("SELECT 

			persona.nombre || ' ' || persona.apellido as estudiante ,

			especialidad.nombre_especialidad 

			|| ' - ' || 

			tipo_especialidad.nombre_tipo_especialidad as nombre_especialidad ,

			persona.cedula , estudiante.expediente , 

			'En Espera' as progres

	 	FROM pasantias.temporadas_solicitud

	 		INNER JOIN pasantias.temporadas_especialidad

	 			ON (temporadas_solicitud.codigo_temporada  = temporadas_especialidad.codigo_temporada)

	 		INNER JOIN pasantias.temporadas_estudiantes

	 			ON (temporadas_estudiantes.codigo_temporada_especialidad = temporadas_estudiantes.codigo_temporada_especialidad)

	 		INNER JOIN pasantias.estudiante

			ON (estudiante.codigo_estudiante = temporadas_estudiantes.codigo_estudiante)

		INNER JOIN pasantias.persona_instituto_especialidad

			ON  (persona_instituto_especialidad.id_persona      = estudiante.id_persona )

			AND (persona_instituto_especialidad.id_perfil       = estudiante.id_perfil )

			AND (persona_instituto_especialidad.id_ip           = estudiante.id_ip)

			AND (persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad)

		INNER JOIN pasantias.especialidad

			ON ( especialidad.id_especialidad = temporadas_especialidad.id_especialidad)

		INNER JOIN pasantias.instituto_principal

			ON ( instituto_principal.id_ip = persona_instituto_especialidad.id_ip )

		INNER JOIN pasantias.especialidad_instituto_principal

			ON (especialidad_instituto_principal.id_ip = instituto_principal.id_ip)

			AND ( especialidad_instituto_principal.id_especialidad = especialidad.id_especialidad)

			AND ( especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip)

		INNER JOIN pasantias.persona

			ON (persona.id_persona = persona_instituto_especialidad.id_persona)

		INNER JOIN pasantias.tipo_especialidad

			ON ( especialidad.id_tipo_especialidad = tipo_especialidad.id_tipo_especialidad )

		WHERE temporadas_especialidad.codigo_temporada_especialidad    = '$codigo_temporada_especialidad'

			AND estudiante.codigo_estudiante                           = '$codigo_estudiante' ;");

		return $sql;
	}

	function Asignar_entregables_a_estudiante($entregables, $estudiante, $codigo_temporada_especialidad) {
		$num = 0;

		foreach ($entregables as $key => $value) {

			$id_entregable     = $value['id_entregable']; $varificarValoradd = $value['Verificar_asignacion'];

			 $sql =
			 	pg_query("INSERT INTO pasantias.estudiantes_entregables ( id_entregable , codigo_estudiante , codigo_temporada_especialidad , fecha_entrega)
 		 			VALUES ($id_entregable,'$estudiante', '$codigo_temporada_especialidad' , now() ) ;");
			 $num = $num+pg_affected_rows($sql);

			 if( ( $varificarValoradd == "true" ) && ( pg_affected_rows($sql)==1 ) ){

			 	$valorEntregable = $value['ValorEntregable'];

			 	$this->AgregarValuesEntregableEstudiante( $valorEntregable , $id_entregable , $estudiante ,$codigo_temporada_especialidad);
			}
		}

		return $num;
	}


	function AgregarValuesEntregableEstudiante( $valorEntregable , $id_entregable , $estudiante ,$codigo_temporada_especialidad)
	{
	$fech=

	pg_fetch_assoc(

	pg_query("SELECT id_estudiantes_entregables 

		FROM pasantias.estudiantes_entregables WHERE
		
			id_entregable                     = $id_entregable
		
		AND codigo_estudiante             = '$estudiante'
		
		AND codigo_temporada_especialidad = '$codigo_temporada_especialidad' ;") );

	$id_estudiantes_entregables= $fech['id_estudiantes_entregables'];

	return pg_affected_rows(

	pg_query("INSERT INTO pasantias.estudiantes_entregables_valor ( id_estudiantes_entregables, fecha_actualizacion , valor_asignado)

		VALUES ($id_estudiantes_entregables, now() , upper('$valorEntregable') ) ;") );


	}


	function CalcularProgresoEstudiante($codigo_estudiante, $codigo_temporada_especialidad)
	{	return
		pg_query("SELECT 'No Postulado' as proceso

				FROM( SELECT estudiante.codigo_estudiante 

				FROM pasantias.estudiante

				INNER JOIN pasantias.temporadas_estudiantes

					ON temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante

					AND estudiante.codigo_estudiante = '$codigo_estudiante'

				INNER JOIN pasantias.temporadas_especialidad

					ON temporadas_especialidad.codigo_temporada_especialidad = temporadas_estudiantes.codigo_temporada_especialidad

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

				LEFT JOIN pasantias.solicitudes_enviadas

					ON solicitudes_enviadas.valor = estudiante.codigo_estudiante

					WHERE solicitudes_enviadas.valor IS NULL

					) as recibidas

				LEFT JOIN pasantias.solicitudes_recibidas ON recibidas.codigo_estudiante = solicitudes_recibidas.valor

				WHERE solicitudes_recibidas.valor IS NULL

	UNION

			SELECT 'Postulado' as proceso FROM

			(SELECT estudianteSolicitud.*  ,solicitudes_enviadas.valor as sucursal FROM

				( SELECT  solicitud.codigo_solicitud

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

					AND estudiante.codigo_estudiante = '$codigo_estudiante'

				INNER JOIN pasantias.temporadas_estudiantes

					ON temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante

					AND temporadas_estudiantes.codigo_temporada_especialidad=temporadas_especialidad.codigo_temporada_especialidad

				INNER JOIN pasantias.persona_instituto_especialidad

					ON persona_instituto_especialidad.id_persona = estudiante.id_persona

					AND persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad

					AND persona_instituto_especialidad.id_ip = estudiante.id_ip

					AND persona_instituto_especialidad.id_perfil = estudiante.id_perfil

				INNER JOIN pasantias.persona

					ON persona.id_persona =persona_instituto_especialidad.id_persona ) as estudianteSolicitud

				INNER JOIN pasantias.solicitudes_enviadas

					ON estudianteSolicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud

					AND solicitudes_enviadas.table_column='organizacionmunicipio.codigo_sucursal') as SucursalEnviada

				INNER JOIN pasantias.solicitudes_enviadas

					ON SucursalEnviada.codigo_solicitud =solicitudes_enviadas.codigo_solicitud

					AND solicitudes_enviadas.table_column='persona.id_persona'

			UNION

				SELECT 'Postulado' as proceso

				FROM ( SELECT  solicitud.codigo_solicitud

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

					AND estudiante.codigo_estudiante = '$codigo_estudiante'

				INNER JOIN pasantias.temporadas_estudiantes

					ON temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante

					AND temporadas_estudiantes.codigo_temporada_especialidad=temporadas_especialidad.codigo_temporada_especialidad

				INNER JOIN pasantias.persona_instituto_especialidad

					ON persona_instituto_especialidad.id_persona       = estudiante.id_persona

					AND persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad

					AND persona_instituto_especialidad.id_ip           = estudiante.id_ip

					AND persona_instituto_especialidad.id_perfil       = estudiante.id_perfil

				INNER JOIN pasantias.persona

					ON persona.id_persona = persona_instituto_especialidad.id_persona

				)as estudianteSolicitud

				INNER JOIN pasantias.solicitudes_recibidas

					ON estudianteSolicitud.codigo_solicitud =solicitudes_recibidas.codigo_solicitud

					AND solicitudes_recibidas.table_column  ='organizacionmunicipio.codigo_sucursal'

					AND solicitudes_recibidas.estatus       ='EN ESPERA'

				INNER JOIN pasantias.organizacionmunicipio

					ON organizacionmunicipio.codigo_sucursal = solicitudes_recibidas.valor

				INNER JOIN pasantias.organizacion

					ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion

	UNION

				SELECT 'Aprobado Por Organizacion' as proceso FROM

						(SELECT estudianteSolicitud.codigo_solicitud , solicitudes_enviadas.valor as sucursal FROM

							( SELECT  solicitud.codigo_solicitud

					FROM pasantias.encargado INNER JOIN pasantias.temporadas_solicitud

						ON encargado.codigo_encargado =  temporadas_solicitud.codigo_encargado

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

						AND estudiante.codigo_estudiante = '$codigo_estudiante'

					INNER JOIN pasantias.temporadas_estudiantes

						ON temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante

						AND temporadas_estudiantes.codigo_temporada_especialidad=temporadas_especialidad.codigo_temporada_especialidad

					INNER JOIN pasantias.persona_instituto_especialidad

						ON persona_instituto_especialidad.id_persona = estudiante.id_persona

						AND persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad

						AND persona_instituto_especialidad.id_ip = estudiante.id_ip

						AND persona_instituto_especialidad.id_perfil = estudiante.id_perfil

					INNER JOIN pasantias.persona

						ON persona.id_persona =persona_instituto_especialidad.id_persona ) as estudianteSolicitud

					INNER JOIN pasantias.solicitudes_enviadas

						ON estudianteSolicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud

						AND solicitudes_enviadas.table_column='organizacionmunicipio.codigo_sucursal') as SucursalEnviada

					INNER JOIN pasantias.solicitudes_enviadas

						ON SucursalEnviada.codigo_solicitud =solicitudes_enviadas.codigo_solicitud

						AND solicitudes_enviadas.table_column='persona.id_persona'

			UNION

				SELECT 'Aprobado Por Organizacion' as proceso FROM

						(SELECT estudianteSolicitud.codigo_solicitud , solicitudes_enviadas.valor as sucursal FROM

						( SELECT  solicitud.codigo_solicitud FROM pasantias.encargado

						INNER JOIN pasantias.temporadas_solicitud

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

							AND estudiante.codigo_estudiante = '$codigo_estudiante'

						INNER JOIN pasantias.temporadas_estudiantes

							ON temporadas_estudiantes.codigo_estudiante = estudiante.codigo_estudiante

							AND temporadas_estudiantes.codigo_temporada_especialidad=temporadas_especialidad.codigo_temporada_especialidad

						INNER JOIN pasantias.persona_instituto_especialidad

							ON persona_instituto_especialidad.id_persona = estudiante.id_persona

							AND persona_instituto_especialidad.id_especialidad = estudiante.id_especialidad

							AND persona_instituto_especialidad.id_ip = estudiante.id_ip

							AND persona_instituto_especialidad.id_perfil = estudiante.id_perfil

						INNER JOIN pasantias.persona

							ON persona.id_persona =persona_instituto_especialidad.id_persona ) as estudianteSolicitud

						INNER JOIN pasantias.solicitudes_enviadas

							ON estudianteSolicitud.codigo_solicitud = solicitudes_enviadas.codigo_solicitud

							AND solicitudes_enviadas.table_column='estudiante.codigo_estudiante') as SucursalEnviada

						INNER JOIN pasantias.solicitudes_recibidas

							ON SucursalEnviada.codigo_solicitud =solicitudes_recibidas.codigo_solicitud

							AND solicitudes_recibidas.table_column='organizacionmunicipio.codigo_sucursal'

							AND solicitudes_recibidas.estatus='APROBADO ORGANIZACION' ;");

	}


	function ProcesarIconosDetallesAsignarEntregables($tipo_especialidad , $estudiantes , $especialidades , $entregables)
	{
		$contenidoTipo__alidad  = " <i class='fa fa-flag' ></i> <i class='fa fa-angle-double-right'></i> ".$tipo_especialidad;
		
			$contenidoTipo__alidad  = "<span class='text-default' data-toggle='tooltip' data-placement='top' title='Tipo de especialidad (".$tipo_especialidad.")'>".$contenidoTipo__alidad."</span>";

		$contenidoEntregables  = " <i class='fa fa fa-list-alt' ></i> <i class='fa fa-angle-double-right'></i> ".$entregables;
		
			$contenidoEntregables  = "<span class='text-default' data-toggle='tooltip' data-placement='top' title='Entregables (".$entregables.")'>".$contenidoEntregables."</span>";
		
		$contenidoEspecialidad  = " <i class='fa fa-graduation-cap' ></i> <i class='fa fa-angle-double-right'></i> ".$especialidades;
		
			$contenidoEspecialidad  = "<span class='text-default' data-toggle='tooltip' data-placement='top' title='Especialidades (".$especialidades.")'>".$contenidoEspecialidad."</span>";
		
		$contenidoEstudiantes = " <i class='fa fa-users' ></i> <i class='fa fa-angle-double-right'></i> ".$estudiantes;
		
			$contenidoEstudiantes = "<span class='text-default' data-toggle='tooltip' data-placement='top' title='Estudiantes (".$estudiantes.")'>".$contenidoEstudiantes."</span>";
		
		$conectivo = "<i class='fa fa-plus-square' data-toggle='tooltip' data-placement='top' title='Además'></i>";

		return $contenidoTipo__alidad ." ".$conectivo." ".$contenidoEspecialidad." ".$conectivo." ". $contenidoEstudiantes." ".$conectivo." ".$contenidoEntregables ;

	}

	function ProcesarIconosDetallesASignarEstudiantes($tipo_especialidad, $estudiantes , $especialidades)
	{
		$contenidoTipo__alidad  = " <i class='fa fa-flag' ></i> <i class='fa fa-angle-double-right'></i> ".$tipo_especialidad;
		
		$contenidoTipo__alidad  = "<span class='text-default' data-toggle='tooltip' data-placement='top' title='Tipo de especialidad (".$tipo_especialidad.")'>".$contenidoTipo__alidad."</span>";
		
		$contenidoEspecialidad  = " <i class='fa fa-graduation-cap' ></i> <i class='fa fa-angle-double-right'></i> ".$especialidades;
		
		$contenidoEspecialidad  = "<span class='text-default' data-toggle='tooltip' data-placement='top' title='Especialidades (".$especialidades.")'>".$contenidoEspecialidad."</span>";
		
		$contenidoEstudiantes = " <i class='fa fa-users' ></i> <i class='fa fa-angle-double-right'></i> ".$estudiantes;
		
		$contenidoEstudiantes = "<span class='text-default' data-toggle='tooltip' data-placement='top' title='Estudiantes (".$estudiantes.")'>".$contenidoEstudiantes."</span>";
		
		$conectivo = "<i class='fa fa-plus-square' data-toggle='tooltip' data-placement='top' title='Además'></i>";

		return  $contenidoTipo__alidad." ".$conectivo." ". $contenidoEspecialidad." ".$conectivo." ". $contenidoEstudiantes ;

	}


	function ProcesarIconosConTipoEspecialidad( $tipo_especialidad , $especialidad )
	{
		$contenidoEspecialidad  = "<i class='fa fa-graduation-cap' ></i> <i class='fa fa-angle-double-right'></i> ".$especialidad;
		
		$contenidoEspecialidad  = "<span class='text-default' data-toggle='tooltip' data-placement='top' title='Especialidad (".$especialidad.")'>".$contenidoEspecialidad."</span>";

		$contenidoTipo__alidad  = " <i class='fa fa-flag' ></i> <i class='fa fa-angle-double-right'></i> ".$tipo_especialidad;
		
		$contenidoTipo__alidad  = "<span class='text-default' data-toggle='tooltip' data-placement='top' title='Tipo de especialidad (".$tipo_especialidad.")'>".$contenidoTipo__alidad."</span>";

		$conectivo = "<i class='fa fa-plus-square' data-toggle='tooltip' data-placement='top' title='Además'></i>";

		return $contenidoTipo__alidad." ".$conectivo." ". $contenidoEspecialidad ;
	}

	function CalcularTotalDeTiposEspecialidades( $codigo_temporada )
	{	
		$array=
		pg_fetch_assoc(
		pg_query("SELECT 

			COUNT(sql_BRONNER.nombre_tipo_especialidad) as total

			FROM  ( SELECT			  

			tipo_especialidad.nombre_tipo_especialidad ,  

			count (tipo_especialidad.id_tipo_especialidad) as total_tipo_especialidad

		 FROM pasantias.temporadas_especialidad

			INNER JOIN pasantias.especialidad

				ON especialidad.id_especialidad = temporadas_especialidad.id_especialidad

			INNER JOIN pasantias.tipo_especialidad

				ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad

			WHERE temporadas_especialidad.codigo_temporada = '$codigo_temporada'

			GROUP BY tipo_especialidad.nombre_tipo_especialidad ) sql_BRONNER
		;") 
		);

		return $array['total'];

	}


}// clasee

?>
