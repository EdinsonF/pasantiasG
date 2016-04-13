<?php
session_start();

if(isset($_SESSION['id_perfil'])){
$id_perfil=$_SESSION['id_perfil'];
$nombre_perfil=$_SESSION['nombre_perfil'];
$nombre_organizacion =  $_SESSION['nombre_instituto'];
$id_persona=$_SESSION['id_persona'];
$nombre_persona = $_SESSION['persona'];
$ID_INSTITUCION=$_SESSION['ID_INSTITUCION'];
$codigo_sucursal=$_SESSION['codigo_sucursal'];
$id_especialidad=$_SESSION['id_especialidad'];
$codigo_estudiante=$_SESSION['codigo_estudiante'];
}else { 
$id_perfil=1;
$nombre_perfil="Menu Principal";
}
 ?>
<!DOCTYPE html>
<!-- saved from url=(0066)http://vadikom.github.io/smartmenus/src/demo/bootstrap-navbar.html -->
<html lang="en" ><head ><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Solicitud</title>

    	 <!--   Mensajes validaciones-->

    <link rel="stylesheet" href="../js/dist/css/amaran.min.css">
    <link rel="stylesheet" href="../js/dist/css/animate.min.css">
   
   <!--  FIN  Mensajes validaciones-->

   <link rel="stylesheet" href="../../../Menus/bootstrap/css/style.css">
  <link rel="stylesheet" href="../../../Menus/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../../../Menus/bootstrap/css/bootstrap.min22.css">
  <link rel="stylesheet" href="../../../Menus/bootstrap/css/bootstrap-theme.css">
  <link rel="stylesheet" href="../../../Menus/bootstrap/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="../../../Menus/bootstrap/css/bootstrap-responsive.css">
  <link rel="stylesheet" href="../../../Menus/bootstrap/css/sticky-footer-navbar.css">
  <link rel="stylesheet" href="../../../Menus/bootstrap/bootstrap-menu/dist/css/bootstrap-submenu.min.css">
  <link rel="stylesheet" href="../../../Menus/bootstrap/bootstrap-menu/dist/css/docs.css">

  <!-- Bootstrap JS -->
<script src="../../../Menus/bootstrap/js/jquery-1.11.3.min.js" ></script>
 
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/bootstrap.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/highlight.min.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/bootstrap-submenu.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/docs.js" defer=""></script>
  
 	<!-- MESNAJES CALIDA OPERACIONES -->
    <link rel="stylesheet" href="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.css">
    <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.js"></script>
    <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.min.js"></script>
   <!-- MESNAJES CALIDA OPERACIONES-->



  </head>
  
  <body style="padding-top: 20px;" id="page"  >

 
<!-- MENU -->

<?php

include("../../../BASE_DATOS/Conect.php");
$conexionBD = new Conexion();
$conexionBD->Conectar();
include("../../Modulo_Usuario/modelo/mod_usuario.php");
$persona= new usuarios();


      $persona->menu($id_perfil , $nombre_perfil , $nombre_organizacion ,$nombre_persona );

   
?>

<!-- Fin De MENU-->

   
    
 
     


<div align="center">
    <div style="width:70%">




<div id="contenedornoti">

<center><h2 ><span style="font-weight: bold;  color: #000000;">Solicitududes Generales</span></h2></center>
<input type="hidden" id="codigo_estudiante" name="codigo_estudiante" value="<?php echo $codigo_estudiante ;?>">
</div>

					            
 <table class="table table-bordered" id="tabla_r" width="100%" >
<?php 
require_once('../controlador/Gestion_Solicitud_Controller.php');
 $Control=new Gestion_Solicitud_Controller();
 $Control->CargarSolicitudes($codigo_estudiante);
?>
</table>
</div>
    	</div>
    	
      








    <!-- ----------------------------------- TABLA2 MODAL DEPARTAMENTOS PARA ASIGNAR-->

    
    <!-- ----------------------------------- FIN TABLA2 MODAL DEPARTAMENTOS-->


       <!--   Mensajes-->
 <script src="../js/dist/js/jquery.amaran.min.js"></script>
 <script src="../js/dist/js/jquery.amaran.js"></script>
   <!--  FIN  Mensajes-->
  
  <script src="../../Modulo_tipoOrganizacion/js/letrasNunmers.js"></script>
  <!-- AUTOCOMPLETADO-->
<link  href="../js/completer.css" rel="stylesheet">
<script type="text/javascript" src="../js/completer.js"></script>

	<!--  FIN  AUTOCOMPLETE-->
   
  
<!--PAGINADOR-->
       
    <script src="../js/js_tabla/jquery.dataTables.js"></script>

    <script>
    $(document).ready(function(){
      $('#tabla_r').dataTable();

   

    });
  </script>
    <script src='../js/js_tabla/tablesort.min.js'></script>

  <script>
      new Tablesort(document.getElementById('table-id'));

    </script>
  

   <script src="../js/dist/js/jquery.amaran.min.js"></script>
   <script src="../js/dist/js/jquery.amaran.js"></script>


<script type="text/javascript" src="../../Modulo_Requisito/js/requisito.js"></script>

<script type="text/javascript" src="../js/solicitud.js"></script>

<!--
<footer class="web-footer clearfix">
  <div class="web-footer-inner">
<p><a href="#">H</a>ome|<a href="#">Acerca de</a>|<a href="#">Contact</a>o</p>
  </div>
</footer>  -->


</body>
</html>
