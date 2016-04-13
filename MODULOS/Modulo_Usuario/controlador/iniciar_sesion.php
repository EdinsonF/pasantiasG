<?php
session_start();
//Obtenemos los datos deL URL  METETELE SIN NINGUN  METODO  INDICADO POR  CIERTO

	$perfil = $_GET['nombre_perfil'];
	$id_perfil = $_GET['id_perfil'];
	$id_organizacion = $_GET['id_organizacion'];
	$_SESSION['codigo_sucursal'] = $_GET['codigo_sucursal'];
	$persona = $_GET['persona'];
	
	// ---------------------------------------------------------------------------------------	

	$_SESSION['nombre_perfil'] = $perfil;
	$_SESSION['id_perfil'] = $id_perfil ;
	$_SESSION['id_organizacion'] = $id_organizacion;
	$_SESSION['id_persona'] = $_GET['id_persona'];
	$_SESSION['persona'] = $persona;

		//$usuarios->usuariobitacorasesion($user['id_usuario']); 
		//$_SESSION['autenticado'] = $user;
		//Aca es la logica para redireccionar segun el tipo de usuario
		/// LO DE LA  BITACORA  ESTA  EN CONSTRUCCION POR  AHORA ! RAMON LO  HARA  MEJOR 
		// YA  VERAN ...
		$perfil = str_replace("Menú ", "", $perfil);

		if($perfil == "Administrador"){

			//$_SESSION['ID_INSTITUCION']=$usuarios->consultar_id_Institucion($perfilANIZACION']);

			
		echo "<script> alert('Bienvenido Administrador  ')</script>";
	    echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../../Index/vista/index_administrador.php'>";
		}else

		 if($perfil == "Empresa"){
		 	
		echo "<script> alert('Bienvenida Empresa  ')</script>";
	    echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../../Index/vista/index_empresa.php'>";
		}else

		 if($perfil == "Estudiante"){
		
		echo "<script> alert('Bienvenido Estudiante')</script>";
	    echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../../Index/vista/index_estudiante.php'>";
	    
		}else

		 if($perfil == "Tutor Academico"){
			echo "<script> alert('Bienvenido Tutor Academico  ')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../../Index/vista/index_tutor_academico.php'>";
		}else 

		if($perfil == "Super Usuario"){
			echo "<script> alert('Bienvenido Super Usuario  ')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../../Index/vista/index_tutor_academico.php'>";
		}else

		{
		echo "<script> alert('Perfil Desconocido')</script>";
	  	echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../../Index/vista/index_principal.php'>";
		}
	
?>



