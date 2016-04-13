<?php
     session_start();
include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$conexion->Conectar();

 
  include('../modelo/mod_tutor_empresarial.php');
  include('../../Modulo_Usuario/modelo/mod_usuario.php');
 $tutor_empresarial=new tutor_empresarial();  
 $usuarios=new usuarios();  
 
 
$id_persona=$_POST['id_persona'];
$id_usuario=$_POST['id_usuario'];

$id_empresa=$_POST['id_empresa'];
$id_instituto=$_POST['id_instituto'];

$id_organizacion=$_POST['id_organizacion'];


$cedula=$_POST['cedula'];
$codigo=$_POST['codigo'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];
$usuario=$_POST['usuario'];
$contrasena=$_POST['contrasena_b'];
$tipo_usuario=ESTUDIANTE;
$estatus=INACTIVO;
$id_perfil=4;

 $tutor_empresarial->id_persona=$id_persona;
 $tutor_empresarial->id_usuario=$id_usuario;
 $tutor_empresarial->id_empresa=$id_empresa;
 $tutor_empresarial->id_instituto=$id_instituto;
 $tutor_empresarial->cedula=$cedula;
 $tutor_empresarial->codigo=$codigo;
 $tutor_empresarial->telefono=$telefono;
 $tutor_empresarial->correo=$correo;

 $usuarios->id_persona=$id_persona;
 $usuarios->id_usuario=$id_usuario;
 $usuarios->id_perfil=$id_perfil;
 $usuarios->usuario=$usuario;
 $usuarios->contrasena=$contrasena;
 $usuarios->tipo_usuario=$tipo_usuario;
 $usuarios->estatus=$estatus;
  

if($_POST['botConsultar']){

    $result=$tutor_empresarial->consultar_tutor_empresarial();
      
	if($result==null){
	   echo "<script> alert('tutor academico no registrado')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/registrar_tutor_empresarial.phtml'>";	//Envio hacia Incluir  
       
	 }
	 else{	
	 
	 echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/registrar_tutor_empresarial.phtml'>"; //Envio hacia Modificar	 
	 limpiar();
	 while($registro=pg_fetch_array($result)){
	     $_SESSION['id_persona']= $registro['id_persona'];
	     $_SESSION['cedula_persona']= $registro['cedula'];		
	     $_SESSION['nombre_persona']= $registro['nombre'];
		 $_SESSION['apellido_persona']= $registro['apellido'];
		 $_SESSION['telefono']= $registro['telefono'];
		 $_SESSION['correo']= $registro['correo'];
		 $_SESSION['codigo']= $registro['codigo'];
		// $_SESSION['especialidad']= $registro['especialidad'];
		 }//fin del while  
   
    $result2=$usuarios->consultar_usuario($_SESSION['id_persona']);
	$numm=0;	 
	$numm=$usuarios->contar_usuario($_SESSION['id_persona']);
   
	if($numm==0){
	    echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/registrar_tutor_empresarial.phtml'>";	//Envio hacia Incluir  
        $_SESSION['ocultar_m']="display: none;";
        $_SESSION['ocultar_r']="display: true;";
        	 }
	 else{
	 	echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/registrar_tutor_empresarial.phtml'>";	//Envio hacia Incluir  
        while($registroo=pg_fetch_array($result2)){
         $_SESSION['id_usuario']= $registroo['id_usuario'];	
	 	 $_SESSION['usuario']= $registroo['usuario'];		
	     $_SESSION['contrasena']= $registroo['contrasena'];
	     
	      }//fin del while 
	      $_SESSION['id_organizacion']=$id_organizacion;
	      $_SESSION['ocultar_r']="display: none;";
	      $_SESSION['ocultar_m']="display: true;";
	 	} 
      }//fin del else
	 	 
  }else 


  if($_POST['botRegistrar']){ 

  if($correo==null && $telefono==null)
  {

      $num=0;   
 	  $num= $usuarios->registrar_usuario();
      if($num==0 ) {
      	limpiar();
	   echo "<script> alert('tutor academico no registrado')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_tutor_academico.phtml'>";	//Envio hacia Incluir  

	  }else {
	  	limpiar();
		echo "<script> alert('tutor academico  registrado')</script>";
        echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_tutor_academico.phtml'>";	//Envio hacia Incluir  
	   
	  }

  }else{

  	  $num=0;
  	  $numm=0;   
 	  $num= $usuarios->registrar_usuario();
 	  $numm=$tutor_academico->actualizar_datos_basicos();
      if($num==0 && $numm==0) {
      	limpiar();
	   echo "<script> alert('tutor academico no registrado')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_tutor_academico.phtml'>";	//Envio hacia Incluir  

	  }else {
	  	limpiar();
		echo "<script> alert('tutor academico registrado')</script>";
        echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_tutor_academico.phtml'>";	//Envio hacia Incluir  
	   
	  }
  }

  }else 

  if($_POST['botModificar'])
  { 
   if($correo==null && $telefono==null)
  {

      $num=0;   
 	  $num= $usuarios->actualizar_usuario();
      if($num==0 ) {
      	limpiar();
	   echo "<script> alert('tutor academicoe no modificado')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_tutor_academico.phtml'>";	//Envio hacia Incluir  

	  }else {
	  	limpiar();
		echo "<script> alert('tutor academico modificado')</script>";
        echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_tutor_academico.phtml'>";	//Envio hacia Incluir  
	   
	  }

  }else{

  	  $num=0;
  	  $numm=0;   
 	  $num= $usuarios->actualizar_usuario();
 	  $numm=$tutor_academico->actualizar_datos_basicos();
      if($num==0 && $numm==0) {
      	limpiar();
	   echo "<script> alert('tutor academico no modificado')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_tutor_academico.phtml'>";	//Envio hacia Incluir  

	  }else {
	  	limpiar();
		echo "<script> alert('tutor academico modificado')</script>";
        echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_tutor_academico.phtml'>";	//Envio hacia Incluir  
	   
	  }
  }

  }else if($_POST['btnSeleccionarEmpresa'])
  { 	

	$result=$tutor_empresarial->consultar_seleccionar_empresa($id_empresa);
	
	if($result==null){
			
	    echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_tutor_empresarial.phtml'>";	//Envio hacia Incluir  
         }else{
         	
	 	echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_tutor_empresarial.phtml'>";	//Envio hacia Incluir  
      limpiar();
        while($registroo=pg_fetch_array($result)){
         $_SESSION['id_organizacion']= $registroo['id_organizacion'];	
	 	 $_SESSION['id_empresa']= $registroo['id_empresa'];		
	     $_SESSION['nombre_o']= $registroo['nombre_empresa'];
    }//fin del while 
}
	    
  }else if($_POST['btnSeleccionarInstitucion'])
  { 	
	 
	$result=$tutor_empresarial->consultar_seleccionar_instituto($id_instituto);
   
	if($result==null){
	echo "pasooo";
	    echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_tutor_empresarial.phtml'>";	//Envio hacia Incluir  
         }else{
	 	echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_tutor_empresarial.phtml'>";	//Envio hacia Incluir  
        limpiar();
        while($registroo=pg_fetch_array($result)){
         $_SESSION['id_organizacion']= $registroo['id_organizacion'];	
	 	 $_SESSION['id_instituto']= $registroo['id_instituto'];		
	     $_SESSION['nombre_a']= $registroo['nombre_instituto'];
    }//fin del while 
}

  }else if($_POST['btnAprobar'])
  { 	
      $num=0;   
 	  $num= $tutor_academico->actulizar_estatus_aprobado();
      if($num==0 ) {
      	limpiar();
	   echo "<script> alert('Operaci\u00f3n no Realizada')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/aprobarUsuarioTutor_academico.php'>";	//Envio hacia Incluir  

	  }else {
	  	limpiar();
		echo "<script> alert('Operaci\u00f3n Realizada')</script>";
        echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/aprobarUsuarioTutor_academico.php'>";	//Envio hacia Incluir  
	  }	
  }else if($_POST['btnRechazar'])
  { 

  	 $num=0;   
 	  $num= $tutor_academico->actulizar_estatus_rechazado();
      if($num==0 ) {
      	limpiar();
	   echo "<script> alert('Operaci\u00f3n no Realizada')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/aprobarUsuarioTutor_academico.php'>";	//Envio hacia Incluir  

	  }else {
	  	limpiar();
		echo "<script> alert('Operaci\u00f3n Realizada')</script>";
        echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/aprobarUsuarioTutor_academico.php'>";	//Envio hacia Incluir  
	  }
  }else if($_POST['btnCancelar'])
  { 
  	 $num=0;   
 	  $num= $tutor_academico->actulizar_estatus_cancelar();
      if($num==0 ) {
      	limpiar();
	   echo "<script> alert('Operaci\u00f3n no Realizada')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/vista/aprobarUsuarioTutor_academico.php'>";	//Envio hacia Incluir  

	  }else {
	  	limpiar();
		echo "<script> alert('Operaci\u00f3n Realizada')</script>";
        echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/aprobarUsuarioTutor_academico.php'>";	//Envio hacia Incluir  
	  }
  }



  function limpiar(){
	
         $_SESSION['id_persona']="";
         $_SESSION['id_usuario']="";
	     $_SESSION['cedula_persona']="";		
	     $_SESSION['nombre_persona']="";
		 $_SESSION['apellido_persona']="";
		 $_SESSION['telefono']= "";
		 $_SESSION['correo']="";
		 $_SESSION['codigo']="";
		// $_SESSION['especialidad']="";
		 $_SESSION['usuario']="";
		 $_SESSION['contrasena']="";
		 
			   // $_SESSION['id_empresa']="";
      //    $_SESSION['id_organizacion']="";
      //       $_SESSION['id_instituto']="";
      //    $_SESSION['nombre_o']="";
      //      $_SESSION['nombre_a']="";	
							}



?>
