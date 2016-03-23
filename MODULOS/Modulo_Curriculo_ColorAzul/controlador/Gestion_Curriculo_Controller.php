<?php
session_start();
require_once("../modelo/Mod_Curriculo.php");


if(isset($_POST['Registrar_Curriculo'])){
	$control=new Gestion_Curriculo_Controller();
	$control->Registrar_Curriculo($_POST);


}else if(isset($_POST['MostrarCurriculo'])){
	$control=new Gestion_Curriculo_Controller();
	// 
	$control->ConsutarDatosCurriculo($_POST);

	
}else if(isset($_POST['EliminarSeccion'])){
	$modelo=new Curriculo();
	// 
	$result=$modelo->EliminarSeccionBD_Estudios($_POST);
	echo json_encode($result);

	
}else if(isset($_POST['EliminarSeccion2'])){
	$modelo=new Curriculo();
	// 
	$result=$modelo->EliminarSeccionBD_Trabajo($_POST);
	echo json_encode($result);

}else if(isset($_POST['Actualizar'])){
	$modelo=new Curriculo();
	// 
	$result=$modelo->Actualizar_CurriculoBD($_POST);
	echo json_encode($result);

	
}else if(isset($_POST['Vista_Previa'])){
	
	$_SESSION['Vista_Previa']=$_POST['Vista_Previa'];
	
	$DatosPersonales=array();
	$FormacionAcademica=array();
	$ExperienciaLaboral=array();

	$contFormacion=count($_POST['nombre_instituto']);
	$contExperiencia=count($_POST['nombre_empresa']);

	//FORES----->>>
	$DatosPersonales['fotografia']=$_POST['fotografia']; 
	$DatosPersonales['profesion']=$_POST['profesion']; 
	$DatosPersonales['descripcion_profesion']=$_POST['descripcion_profesion'];

	for($i=0;$i<$contFormacion;$i++){
		
		$nombre_instituto		=$_POST['nombre_instituto'];
		$inicio_curso			=$_POST['inicio_curso'];
		$fin_curso				=$_POST['fin_curso'];
		$descripcion_obtencion	=$_POST['descripcion_obtencion'];

		$fecha1=$inicio_curso[$i]; 
		$var = explode('-',$fecha1); 
		$fecha_i="$var[2]-$var[1]-$var[0]";

		$fecha2=$fin_curso[$i]; 
		$var2 = explode('-',$fecha2); 
		$fecha_f="$var2[2]-$var2[1]-$var2[0]";

		$FormacionAcademica[$i]=array('nombre_instituto'=>$nombre_instituto[$i],'inicio_curso'=>$fecha_i,'fin_curso'=>$fecha_f,'descripcion_obtencion'=>$descripcion_obtencion[$i]);
	}
	for($j=0;$j<$contExperiencia;$j++){

		$nombre_empresa		=$_POST['nombre_empresa'];
		$inicio_empleo 		=$_POST['inicio_empleo'];
		$fin_empleo 		=$_POST['fin_empleo'];
		$cargo_en_empresa 	=$_POST['cargo_en_empresa'];
		$funcion_en_empresa =$_POST['funcion_en_empresa'];

		$fecha1=$inicio_empleo[$j]; 
		$var = explode('-',$fecha1); 
		$fecha_i="$var[2]-$var[1]-$var[0]";

		$fecha2=$fin_empleo[$j]; 
		$var2 = explode('-',$fecha2); 
		$fecha_f="$var2[2]-$var2[1]-$var2[0]";

		$ExperienciaLaboral[$j]=array('nombre_empresa'=>$nombre_empresa[$j],'inicio_empleo'=>$fecha_i,'fin_empleo'=>$fecha_f,'cargo_en_empresa'=>$cargo_en_empresa[$j],'funcion_en_empresa'=>$funcion_en_empresa[$j]);

	}
	$_SESSION['PERSONAL']=$DatosPersonales;
	$_SESSION['ACADEMICA']=$FormacionAcademica;
	$_SESSION['LABORAL']=$ExperienciaLaboral;

	echo json_encode($_SESSION['Vista_Previa']);

	
}else if(isset($_POST['hacervistaP']) ){
		
	echo json_encode(array('PERSONAL'=>$_SESSION['PERSONAL'], 'ACADEMICA'=>$_SESSION['ACADEMICA'], 'LABORAL'=>$_SESSION['LABORAL']));
	
}




class Gestion_Curriculo_Controller{

	function Registrar_Curriculo($Vista= array()){
		
		$modelo=new Curriculo();
		$result=$modelo->RegistraCurriculo_BD($Vista);

		echo json_encode($result);

	}




	function ConsutarDatosCurriculo($Vista= array()){
		
		$modelo=new Curriculo();
		$arreglos= $modelo->CosutarDatosCurrriculoBD($Vista);
		echo json_encode($arreglos);

	}




}




?>