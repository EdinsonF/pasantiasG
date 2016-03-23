<?php
     session_start();

     

include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$conexion->Conectar();

 
  include('../modelo/mod_estudiante.php');
  include('../../Modulo_Usuario/modelo/mod_usuario.php');
 $estudiante=new estudiante();  
 $usuarios=new usuarios();  
 
 

  

if(isset($_POST['botConsultar'])){


$id_instituto=$_POST['id_instituto'];
$_SESSION['ID_INSTITUCION']=$id_instituto;
echo $_SESSION['ID_INSTITUCION'];
$cedula=$_POST['cedula'];
$expediente=$_POST['expediente'];

$estudiante->cedula=$cedula;
 $estudiante->expediente=$expediente;

    $result=$estudiante->consultar_estudiante($id_instituto, $cedula, $expediente);
   $num= pg_num_rows($result);
	if($num==null){
	   echo "<script> alert('estudiante no registrado')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_usuario_estudiante.phtml'>";	//Envio hacia Incluir  
       
	 }
	 else{	
	 
	 echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/registrar_usuario_estudiante.phtml'>"; //Envio hacia Modificar	 
	 limpiar();
	 while($registro=pg_fetch_array($result)){

	     $_SESSION['id_persona']= $registro['id_persona'];
	     $_SESSION['cedula_persona']= $registro['cedula'];		
	     $_SESSION['nombre_persona']= $registro['nombre'];
		 $_SESSION['apellido_persona']= $registro['apellido'];
		 $_SESSION['telefono']= $registro['telefono'];
		 $_SESSION['correo']= $registro['correo'];
		 $_SESSION['expediente']= $registro['expediente'];
		 $_SESSION['especialidad']= $registro['nombre_especialidad'];

		 }//fin del while  
   			
    $result2=$usuarios->consultar_usuario($_SESSION['id_persona'] , 3);

    $numm = pg_num_rows($result2);

	if($numm==0){
	    echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/registrar_usuario_estudiante.phtml'>";	//Envio hacia Incluir  
        $_SESSION['ocultar_m']="display: none;";
        $_SESSION['ocultar_r']="display: true;";
        	 }
	 else{
	 	echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/registrar_usuario_estudiante.phtml'>";	//Envio hacia Incluir  
        while($registroo=pg_fetch_array($result2)){
         $_SESSION['id_usuario']= $registroo['id_usuario'];	
	 	 $_SESSION['usuario']= $registroo['usuario'];		
	     $_SESSION['contrasena']= $registroo['contrasena'];
	  	
	     	
	     	if($registroo['fecha_solicitud']==""){
	     		$_SESSION['fecha_solicitud']= "";
	     	}else{
	     		$_SESSION['fecha_solicitud']= $registroo['fecha_solicitud'];
	     	}

	     if($registroo['estado']=='APROBADO' && $registroo['id_perfil']==3){
	     echo "<script> alert('ya se encuentra registrado y aprobado')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_usuario_estudiante.phtml'>";	//Envio hacia Incluir  
       
	     }

	        }//fin del while 

	        $_SESSION['ocultar_r']="display: none;";
	         $_SESSION['ocultar_m']="display: true;";
	 	} 
      }//fin del else
	 	 
  }else 


  if(isset($_POST['botRegistrar'])){ 


$id_persona=$_POST['id_persona'];
//$id_personam=$_POST['id_personam'];
$id_usuario=$_POST['id_usuario'];
//$observacion=$_POST['observacion'];
$fecha=$_POST['fecha'];
$id_instituto=$_POST['id_instituto'];
//$cedula=$_POST['cedula'];
//$expediente=$_POST['expediente'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];
$usuario=$_POST['usuario'];
$contrasena=$_POST['contrasena_b'];
$tipo_usuario='ESTUDIANTE';
$estatus='PENDIENTE';
$id_perfil='3';

 $estudiante->id_persona=$id_persona;
 $estudiante->id_usuario=$id_usuario;

 $estudiante->telefono=$telefono;
 $estudiante->correo=$correo;

 $usuarios->id_persona=$id_persona;
 $usuarios->id_usuario=$id_usuario;
 $usuarios->id_perfil=$id_perfil;
 $usuarios->usuario=$usuario;
 $usuarios->contrasena=$contrasena;
 $usuarios->tipo_usuario=$tipo_usuario;
 $usuarios->estatus=$estatus;





  if($correo==null && $telefono==null)
  {

      $num=0;   
 	  $num= $usuarios->verificar_registro_usuario($id_persona, $usuario, $contrasena, $fecha, $id_instituto, $id_perfil);
      if($num==0 ) {
      	limpiar();
	   echo "<script> alert('Estudiante no Registrado')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_usuario_estudiante.phtml'>";	//Envio hacia Incluir  

	  }else {
	  	limpiar();
		echo "<script> alert('Estudiante  Registrado')</script>";
        echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_usuario_estudiante.phtml'>";	//Envio hacia Incluir  
	   
	  }

  }else{

  	  $num=0;
  	  $numm=0;   
 	  $num= $usuarios->verificar_registro_usuario($id_persona, $usuario, $contrasena, $fecha, $id_instituto, $id_perfil);
 	  $numm=$estudiante->actualizar_datos_basicos();
      if($num==0 && $numm==0) {
      	limpiar();
	   echo "<script> alert('Estudiante no Registrado')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_usuario_estudiante.phtml'>";	//Envio hacia Incluir  

	  }else {
	  	limpiar();
		echo "<script> alert('Estudiante  Registrado')</script>";
        echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_usuario_estudiante.phtml'>";	//Envio hacia Incluir  
	   
	  }
  }

  }else 

  if(isset($_POST['botModificar']))
  { 

$id_persona=$_POST['id_persona'];
//$id_personam=$_POST['id_personam'];
$id_usuario=$_POST['id_usuario'];
//$observacion=$_POST['observacion'];
$fecha=$_POST['fecha'];
$id_instituto=$_POST['id_instituto'];
//$cedula=$_POST['cedula'];
//$expediente=$_POST['expediente'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];
$usuario=$_POST['usuario'];
$contrasena=$_POST['contrasena_b'];
$tipo_usuario='ESTUDIANTE';
$estatus='PENDIENTE';
$id_perfil='3';

 $estudiante->id_persona=$id_persona;
 $estudiante->id_usuario=$id_usuario;

 $estudiante->telefono=$telefono;
 $estudiante->correo=$correo;

 $usuarios->id_persona=$id_persona;
 $usuarios->id_usuario=$id_usuario;
 $usuarios->id_perfil=$id_perfil;
 $usuarios->usuario=$usuario;
 $usuarios->contrasena=$contrasena;
 $usuarios->tipo_usuario=$tipo_usuario;
 $usuarios->estatus=$estatus;


   if($correo==null && $telefono==null)
  {

      $num=0;   
 	  $num= $usuarios->actualizar_usuario($id_persona, $usuario, $contrasena, $id_usuario, $fecha, $id_instituto, $id_perfil);
      if($num==0 ) {
      	limpiar();
	   echo "<script> alert('Estudiante no Modificado')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_usuario_estudiante.phtml'>";	//Envio hacia Incluir  

	  }else {
	  	limpiar();
		echo "<script> alert('Estudiante  Modificado')</script>";
        echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_usuario_estudiante.phtml'>";	//Envio hacia Incluir  
	   
	  }

  }else{

  	  $num=0;
  	  $numm=0;   
 	  $num= $usuarios->actualizar_usuario($id_persona, $usuario, $contrasena, $id_usuario, $fecha, $id_instituto, $id_perfil);
 	  $numm=$estudiante->actualizar_datos_basicos();
      if($num==0 && $numm==0) {
      	limpiar();
	   echo "<script> alert('Estudiante no Modificado')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_usuario_estudiante.phtml'>";	//Envio hacia Incluir  

	  }else {
	  	limpiar();
		echo "<script> alert('Estudiante  Modificado')</script>";
        echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/consultar_usuario_estudiante.phtml'>";	//Envio hacia Incluir  
	   
	  }
  }

  }else if(isset($_POST['btnAprobar']))
  { 	
  	$id_persona=$_POST['id_persona'];
  	$id_persona_encargada= $_SESSION['id_persona_encargada'];
  	
  	echo $id_persona;
  	echo $id_persona_encargada;
      $num=0;   
 	  $num= $estudiante->actulizar_estatus_aprobado($id_persona, $id_persona_encargada);
      if($num==0 ) {
      //	limpiar();
	   echo "<script> alert('Operaci\u00f3n no Realizada')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/aprobarUsuarioEstudiante.php'>";	//Envio hacia Incluir  

	  }else {
	  //	limpiar();
		echo "<script> alert('Operaci\u00f3n Realizada')</script>";
        echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/aprobarUsuarioEstudiante.php'>";	//Envio hacia Incluir  
	  }	
  }else if(isset($_POST['btnRechazarr']))
  { 
$id_personam=$_POST['id_personam'];
$observacion=$_POST['observacion'];
$id_persona_encargada= $_SESSION['id_persona_encargada'];
echo $id_persona_encargada;
  	 $num=0;   
 	 $num= $estudiante->actulizar_estatus_rechazado($id_personam, $observacion, $id_persona_encargada);

 	 if($num==0) {
      //	limpiar();
	   echo "<script> alert('Operaci\u00f3n no Realizada')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/aprobarUsuarioEstudiante.php'>";	//Envio hacia Incluir  

	  }else {

	  	//limpiar();
		echo "<script> alert('Operaci\u00f3n Realizada')</script>";
        echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/aprobarUsuarioEstudiante.php'>";	//Envio hacia Incluir  
	  
}

  }else if(isset($_POST['btnCancelar']))
  { 
  	$id_persona=$_POST['id_persona'];
  	$id_persona_encargada= $_SESSION['id_persona_encargada'];
  	echo $id_persona_encargada;
  	 $num=0;   
 	  $num= $estudiante->actulizar_estatus_cancelar($id_persona, $id_persona_encargada);
      if($num==0 ) {
      //	limpiar();
	   echo "<script> alert('Operaci\u00f3n no Realizada')</script>";
	   echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/vista/aprobarUsuarioEstudiante.php'>";	//Envio hacia Incluir  

	  }else {
	  //	limpiar();
		echo "<script> alert('Operaci\u00f3n Realizada')</script>";
        echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/aprobarUsuarioEstudiante.php'>";	//Envio hacia Incluir  
	  }
  }



  function limpiar(){
	
         
         $_SESSION['id_usuario']="";
	     $_SESSION['cedula_persona']="";		
	     $_SESSION['nombre_persona']="";
		 $_SESSION['apellido_persona']="";
		 $_SESSION['telefono']= "";
		 $_SESSION['correo']="";
		 $_SESSION['expediente']="";
		 $_SESSION['especialidad']="";
		 $_SESSION['usuario']="";
		 $_SESSION['contrasena']="";
		 $_SESSION['fecha_solicitud']= "";
										
								}



?>
