<?php

session_start();

if (isset($_POST['selectperiodo'])) {

	include ('../../Modulo_Periodo_Solicitud/modelo/Periodo_Solicitud.php');
			
		$re4sul      = periodo_solicitud::periodosSelectparaTemporadasegunEncargado($_POST['selectperiodo']);
		
		$data        = array();
		
		while ($fila = pg_fetch_assoc($re4sul)) : $data[] = $fila; endwhile;
				
	echo json_encode($data);

} else if (isset($_POST['selecttipoSolicitud'])) {
	
	include ('../../Modulo_Tipo_Solicitud/modelo/Tipo_Solicitud.php');
				
		$result      = Tipo_Solicitud::tiposSolicitudparaTemporada($_SESSION['codigo_encargado']);
		
		$data        = array();
		
		while ($fila = pg_fetch_assoc($result)) : $data[] = $fila; endwhile;		
		
	echo json_encode($data);

} else if (isset($_POST['BuscardescripciontipoSolicitud'])) {
	
	include ('../../Modulo_Tipo_Solicitud/modelo/Tipo_Solicitud.php');

		$result = Tipo_Solicitud::DescripciontipoSolicitud($_POST['tipo_solicitud'], $_SESSION['codigo_encargado']);

	echo json_encode($result);

} else if (isset($_POST['lapsoacademico'])) {
	
	include ('../../Modulo_Nuevo_Lapso/modelo/Lapso_Academico.php');
				
		$result = lapso_academico::buscarlapsodeperiodo($_POST['id_periodo']);

	echo json_encode($result);

} else if (isset($_POST['registrartemporada'])) {
	
	include ("../modelo/Temporada.php");

		$result = Temporada::RegistrarTemporada($_POST);
	
	echo json_encode($result);

} else if (isset($_POST['tablaGeneral'])) {
	
	include ("../modelo/Temporada.php");
			
		$resultado   = Temporada::TemporadasSegunEncargado($_POST['codigo_encargao']);
		
		$data        = array();
		
		while ($fila = pg_fetch_assoc($resultado)) : $data[] = $fila; endwhile;
				
	echo json_encode($data);

} else if (isset($_POST['estudiantesSegunEspecialidad'])) {
	
	include ("../modelo/Temporada.php");
	
		$clase       = new Temporada();
		
		$resultado   = $clase->estudiantesparaAsignacion($_POST['estudiantesSegunEspecialidad'], $_POST['codigo_temporada']);
		
		$data        = array();
		
		while ($fila = pg_fetch_assoc($resultado)) {
		
			$data[]  = $fila;
		
		}
	echo json_encode($data);

} else if (isset($_POST['estudiantesAsignadosEspecialidad'])) {
	
	include ("../modelo/Temporada.php");
		
		$clase       = new Temporada();
		
		$resultado   = $clase->estudianteAsignados($_POST['estudiantesAsignadosEspecialidad'], $_POST['codigo_temporada']);
		
		$data        = array();
		
		while ($fila = pg_fetch_assoc($resultado)) {
		
			$data[]  = $fila;
		
		}
	echo json_encode($data);
} else if (isset($_POST['estaTemporada'])) {
	
	include ("../modelo/Temporada.php");
	
		$clase     = new Temporada();
		
		$resultado = $clase->TemporadaIndividual($_POST['estaTemporada']);
		
		$varcolums = pg_fetch_array($resultado);

	echo json_encode($varcolums);

} else if (isset($_POST['asignarestudiantes'])) {
	
	include ("../modelo/Temporada.php");
	
		$return = Temporada::AsignaraTemporada($_POST['id_especialidad'], $_POST['codigo_temporada'], $_POST['codigo_estudiante']);
	
	echo json_encode($return);

} else if (isset($_POST['tablamistemporadasparaespecialidades'])) {
	
	include ("../modelo/Temporada.php");
	
		$clase       = new Temporada();
	
		$value       = $clase->tablaMistemporadas($_POST['tablamistemporadasparaespecialidades']);
	
		$data        = array();
	
		while ($fila = pg_fetch_assoc($value) ) :

			$total_tipo_especialidades = $clase->CalcularTotalDeTiposEspecialidades( $fila['codigo_temporada'] );

			$total_tipo_especialidades = ( $total_tipo_especialidades === null  ) ? 0 : $total_tipo_especialidades ;

			$fila['detalles'] = $clase->ProcesarIconosConTipoEspecialidad( $total_tipo_especialidades , $fila['especialidades'] );
	
			$data[]  = $fila;
	
		endwhile ;
	echo json_encode($data);

} else if (isset($_POST['buscarEspecialidadesNoasignadasthisTemporada'])) {
	
	include ("../modelo/Temporada.php");
				
		$value       = Temporada::temporadasNoEspecialidades($_POST['buscarEspecialidadesNoasignadasthisTemporada']);
		
		$data        = array();
		
		while ($fila = pg_fetch_assoc($value)) : $data[]  = $fila; endwhile ;

	echo json_encode($data);

} else if (isset($_POST['tablamistemporadasconespecialidadesAsignadas'])) {
	
	include ("../modelo/Temporada.php");
			
		$value       = Temporada::temporadasConEspecialidades($_POST['tablamistemporadasconespecialidadesAsignadas']);
		
		$data        = array();
		
		while ($fila = pg_fetch_assoc($value)) : $data[]  = $fila; endwhile;
		
	echo json_encode($data);

} else if (isset($_POST['asignarEspecialidads'])) {
	
	include ("../modelo/Temporada.php");
	
		$clase = new Temporada();
	
		$value = $clase->AsignarEspecialidadesTemporadas($_POST);
	
	echo json_encode($value);

} else if (isset($_POST['MisTemporadasPreparadas'])) {
	
	include ("../modelo/Temporada.php");
	
		$clase       = new Temporada();
		
		$value       = $clase->TemporadasPreparadas($_POST['MisTemporadasPreparadas']);
		
		$data        = array();

		$preparada = "  <span class='fa fa-folder'></span> <span class='fa fa-angle-double-right'></span> ";

		$curso = "  <span class='fa fa-folder-open'></span> <span class='fa fa-angle-double-right'></span> ";
		
		while ($fila = pg_fetch_assoc($value) ) :

				 $estudiantes          = $fila['contstudents'];
				
				 $especialidades       = $fila['contscarrer'];
				
				$fila['detalles']     = 

				$clase->ProcesarIconosDetallesASignarEstudiantes( $clase->CalcularTotalDeTiposEspecialidades( $fila['codigo_temporada'] ), $estudiantes , $especialidades);

			$fila['estatus'] = ( $fila['estatus']=='PREPARADA' ) ?  $preparada.$fila['estatus'] : $curso.$fila['estatus'] ;

			$data[]  = $fila;
		
		endwhile;
	echo json_encode($data);

} else if (isset($_POST['especialidadesTemporadas'])) {
	
	include ("../modelo/Temporada.php");
	
	$value       = Temporada::EspecialidadesdeTemporadas($_POST['especialidadesTemporadas']);
	
	$data        = array();

	while ($fila = pg_fetch_assoc($value)) : $data[]  = $fila; endwhile;

	echo json_encode($data);

} else if (isset($_POST['TemporadasCurso'])) {
	
	include ("../modelo/Temporada.php");
	
		$value       = Temporada::BuscarTemporadasEnCurso($_POST['TemporadasCurso']);
		
		$data        = array();
		
		while ($fila = pg_fetch_assoc($value)) : $data[]  = $fila; endwhile ;
			
	echo json_encode($data);

} else if (isset($_POST['EspecialidadesdeTemporadasCurso'])) {
	
	include ("../modelo/Temporada.php");
			
		$value       = Temporada::BuscarEspecialidadesTemporadasEnCurso($_POST['EspecialidadesdeTemporadasCurso']);
		
		$data        = array();
		
		while ($fila = pg_fetch_assoc($value)) : $data[]  = $fila; endwhile ;
			
	echo json_encode($data);

} else if (isset($_POST['VerEstudiantesdeEstaTemporadaCurso'])) {
	
	include ("../modelo/Temporada.php");
			
		$value = Temporada::BuscarEstudiantesEspecialidadTemporadaEnCurso($_POST['VerEstudiantesdeEstaTemporadaCurso']);

	echo json_encode($value);

} else if (isset($_POST['BuscarEstudiantesNoPostulados'])) {
	
	include ("../modelo/Temporada.php");
			
		$value       = Temporada::BuscarEstudiantesNoPostulados($_POST['BuscarEstudiantesNoPostulados']);
		
		$data        = array();
		
		while ($fila = pg_fetch_assoc($value)) :  $data[] = $fila; endwhile;
	
	echo json_encode($data);

} else if (isset($_POST['BuscarEstudiantesPostulados'])) {
	
	include ("../modelo/Temporada.php");
				
		$value       = Temporada::BuscarEstudiantesPostulados($_POST['BuscarEstudiantesPostulados']);
		
		$data        = array();
		
		while ($fila = pg_fetch_assoc($value)) : $data[] = $fila; endwhile;		 
		
	echo json_encode($data);

} else if (isset($_POST['BuscarEstudiantesAprobadosOrganizacion'])) {

	include ("../modelo/Temporada.php");

		$value       = Temporada::BuscarEstudiantesAprobadosOrganzizacion($_POST['BuscarEstudiantesAprobadosOrganizacion']);

		$data        = array();

		while ($fila = pg_fetch_assoc($value)) : $data[] = $fila; endwhile ;

	echo json_encode($data);

} else if (isset($_POST['BuscarEstudiantesSinTutores'])) {
	
	include ("../modelo/Temporada.php");
				
		$value       = Temporada::BuscarEstudiantesSinTutores($_POST['BuscarEstudiantesSinTutores']);
		
		$data        = array();
		
		while ($fila = pg_fetch_assoc($value)) :  $data[] = $fila; endwhile ;
		
	echo json_encode($data);

} else if (isset($_POST['BuscarEstudiantesConTutores'])) {
	
	include ("../modelo/Temporada.php");
			
		$value       = Temporada::BuscarEstudiantesConTutores($_POST['BuscarEstudiantesConTutores']);
		
		$data        = array();
		
		while ($fila = pg_fetch_assoc($value)) : $data[] = $fila; endwhile ;

	echo json_encode($data);

} else if (isset($_POST['BuscarEstudiantesNoSolventes'])) {
	
	include ("../modelo/Temporada.php");
		
		$value       = Temporada::BuscarEstudiantesNoSolventes($_POST['BuscarEstudiantesNoSolventes']);
		
		$data        = array();
		
		while ($fila = pg_fetch_assoc($value)) : $data[] = $fila; endwhile ;
	
	echo json_encode($data);

} else if (isset($_POST['BuscarEstudiantesSolventes'])) {

	include ("../modelo/Temporada.php");

		$value       = Temporada::BuscarEstudiantesSolventes($_POST['BuscarEstudiantesSolventes']);
		
		$data        = array();
		
		while ($fila = pg_fetch_assoc($value)) : $data[] = $fila; endwhile ;

	echo json_encode($data);

} else if (isset($_POST['InformacionTutoresEspecifico'])) {
	
	include ("../modelo/Temporada.php");
	
		$value = Temporada::mensajeopiniouser($_POST['InformacionTutoresEspecifico']);

	echo json_encode($value);

} else if (isset($_POST['buscarDatosSucursal'])) {

	include ("../../Modulo_Organizacion/modelo/organizacion.php");
			
		$value  = organizacion::buscarDatosSucursal($_POST['buscarDatosSucursal']);
			
	echo json_encode( pg_fetch_array($value) );

} else if (isset($_POST['aprobarsolicitudEncargado'])) {

	include ("../modelo/Temporada.php");
		
		$value = Temporada::EncargadoApruebaSolicitudAprobadaOrganizacion($_POST);

	echo json_encode($value);

} else if (isset($_POST['buscarTutoresParaEsteEstudiante'])) {
	
	include ("../modelo/Temporada.php");
				
		$value       = Temporada::BuscarTutoresParaELEstudianteTheSolicitud($_POST['buscarTutoresParaEsteEstudiante']);
		
		$data        = array();
		
		while ($fila = pg_fetch_assoc($value)) : $data[]  = $fila; endwhile ;

	echo json_encode($data);

} else if (isset($_POST['Asignartutor'])) {

	include ("../modelo/Temporada.php");
				
		$value = Temporada::AsignarTutorAcademico($_POST);

	echo json_encode($value);

} else if (isset($_POST['BuscarPreparadasListas'])) {

	include ("../modelo/Temporada.php");

		$clase       = new Temporada();
		
		$value       = $clase->CargarTemporadasParaHabilitarEnCurso($_POST["codigoEncargadoForCursar"]);
		
		$data        = array();
		
		$preparada = " <span class='fa fa-folder'></span> <span class='fa fa-angle-double-right'></span> ";

		$curso = " <span class='fa fa-folder-open'></span> <span class='fa fa-angle-double-right'></span> ";

		while ($fila = pg_fetch_assoc($value) ) :

			$tipo_especialidad = $clase->CalcularTotalDeTiposEspecialidades( $fila['codigo_temporada'] );

			$fila['detalles'] = $clase->ProcesarIconosDetallesAsignarEntregables( $tipo_especialidad, $fila['total_estudiantes'] , $fila['totalespecialidades'] , $fila['todal_entregables']);

			$fila['estatus'] = ( $fila['estatus']=='PREPARADA' ) ?  $preparada.$fila['estatus'] : $curso.$fila['estatus'] ;
	 		
			$data[]      = $fila;
		
		endwhile;

	echo json_encode($data);

} else if (isset($_POST['abrirTemporada'])) {
	
	include ("../modelo/Temporada.php");
				
		$value = Temporada::AbrirTemporada($_POST["abrirTemporada"], $_POST['codigo_encargado']);

	echo json_encode($value);

} else if (isset($_POST['EspecialidadesAsignadasFroCurso'])) {
	
	include ("../modelo/Temporada.php");
				
		$value = Temporada::ExtraerEspecialidadesAsignadassegunTemporada($_POST['codigo_temporada']);
	
	echo json_encode($value);

} else if (isset($_POST['RegistrarAsignarEntregableTemporada'])) {
	
	include ("../modelo/Temporada.php");
	
		$value = Temporada::ProcesarEntregable($_POST['Nombre_Entregable'], $_POST['temporada_solicitud']);
	
	echo json_encode($value);

} else if (isset($_POST['EntregablesAsignados'])) {

	include ("../modelo/Temporada.php");

			$value                      = Temporada::BuscarEntregablesAsignados($_POST['codigo_temporada']);
			
			$data                       = array();
			
			while ($fila                = pg_fetch_assoc($value)) :
			
				$fila['cuantosEntregables'] = pg_num_rows($value);
			
				$data[]                     = $fila;
			
			endwhile;
	echo json_encode($data);

} else if (isset($_POST['EntregablesNoAsignados'])) {

	include ("../modelo/Temporada.php");
		
		$value                      = Temporada::BuscarEntregablesNoAsignados($_POST['codigo_temporada']);
		
		$data                       = array();
		
		while ($fila                = pg_fetch_assoc($value)) :
		
			$fila['cuantosEntregables'] = pg_num_rows($value);
		
			$data[]                     = $fila;
		
		endwhile;
	echo json_encode($data);

} else if (isset($_POST['BuscarParaAutoComplete'])) {
	
	include ("../modelo/Temporada.php");
		
		$value       = Temporada::BuscarParaAutoComplete($_POST['temporada_solicitud']);
		
		$data        = array();
		
		while ($fila = pg_fetch_assoc($value)) : $data[]  = $fila; endwhile;		

	echo json_encode($data);

} else if (isset($_POST['ActualizarEntregable'])) {

	include ("../modelo/Temporada.php");
				
		$value = Temporada::ProcesarActualizacionEntregable($_POST['entregable_N'], $_POST['entregable_O'], $_POST['codigo_temporada'], $_POST['id_entregableviejo']);
	
	echo json_encode($value);

} else if (isset($_POST['QuitarTHisAsignacion'])) {

	include ("../modelo/Temporada.php");

		$value = Temporada::QuitarEntregable($_POST['entregable'], $_POST['id_entregableviejo'], $_POST['codigo_temporada']);
	
	echo json_encode($value);

} else if (isset($_POST['AsignarLoteEntregables'])) {

	include ("../modelo/Temporada.php");

		$value = Temporada::asignarLoteEntregables($_POST['ids'], $_POST['codigo_temporada']);

	echo json_encode($value);
	
} else if (isset($_POST['hacerResumenTemporada'])) {
	
	include ("../modelo/Temporada.php");
					
		$value          = Temporada::ResumenTemporada($_POST['hacerResumenTemporada']);
		
		$dataes         = array();
		
		$dataen         = array();
		
		while ($valuess = pg_fetch_assoc($value['entregable'])) : $dataen[] = $valuess; endwhile;

		while ($valuess = pg_fetch_assoc($value['especialidad'])) :
		
			$valuess['cantidad_especialidades_d'] = 

			Temporada::calcularCuantosespecialidadestotal($_POST['hacerResumenTemporada'], $valuess['id_tipo_especialidad']);
		
			$dataes[] 		= $valuess;
		
		endwhile;

	echo json_encode(array($dataes, $dataen));

} else if (isset($_POST['buscarTutoresResumen'])) {
	
	include ("../modelo/Temporada.php");
			
		$value       = Temporada::buscarTutoresResumen($_POST['buscarTutoresResumen']);
		
		$data        = array();
	
		while ($fila = pg_fetch_assoc($value)) :
		
			$fila['observacion'] = '('.
		
			Temporada::CantidadEstudiantesAsignadosTemporada(

				$fila['codigo_tutor_academico'], $_POST['buscarTutoresResumen']).') Estudiantes';
		
			$data[] = $fila;

		endwhile ;

	echo json_encode($data);

} else if (isset($_POST['verificaCodigoTutor'])) {
	
	include ("../modelo/Temporada.php");
	
		$value = Temporada::buscaEstetutor($_POST['verificaCodigoTutor']);
	
	echo json_encode($value);

} else if (isset($_POST['Cerrar_temporada'])) {
	
	include ("../modelo/Temporada.php");
		
		$value = Temporada::Cerrar_temporada_solicitud($_POST['Cerrar_temporada'], $_POST['El_que_quiere_cerrar_la_temporada']);
	
	echo json_encode($value);

} else if (isset($_POST['buscar_entregables_estudiante_this'])) {
	
	include ("../modelo/Temporada.php");
	
	$value = Temporada::Buscar_entregables_segun_estudiante(
			 $_POST['buscar_entregables_estudiante_this'], 
			 $_POST['temporade_full_boleta']);
	
	$dataA = array();
	
	$dataN = array();
	
	$dataE = array();

	$dataP = array();

	if ($value['V'] == "s"):

		$dataE       = pg_fetch_assoc($value['sqlE']);

		while ($fila = pg_fetch_assoc($value['sqlP'])): $dataP[] = $fila; endwhile;
		
		while ($fila = pg_fetch_assoc($value['sqlN'])): $dataN[] = $fila; endwhile; 
		
		while ($fila = pg_fetch_assoc($value['sqlA'])): $dataA[] = $fila; endwhile; 

	endif;

	echo json_encode(array(  'estudiantes_a' => $dataA , 
                             'estudiantes_n' => $dataN , 
                             'estudiantes_d' => $dataE ,
                             'estudiantes_p' => $dataP ));

} else if (isset($_POST['Asignar_entregables_estudiante']) && isset($_POST['tregables']) && isset($_POST['estudiante_c']) && isset($_POST['estudiante_t']) && isset($_POST['estudiante_t'])) {

	include ("../modelo/Temporada.php");

	$value = Temporada::Asignar_entregables_a_estudiante($_POST['tregables'], $_POST['estudiante_c'], $_POST['estudiante_t']);

	echo json_encode($value);
}

?>