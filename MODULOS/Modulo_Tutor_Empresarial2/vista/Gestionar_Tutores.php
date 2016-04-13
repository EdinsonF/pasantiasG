<?php
session_start();


$id_perfil=$_SESSION['id_perfil'];
$nombre_perfil=$_SESSION['nombre_perfil'];
$ID_ORGANIZACION=$_SESSION['codigo_sucursal'];
$nombre_persona = $_SESSION['persona'];
$nombre_organizacion =  $_SESSION['nombre_organizacion'];

?>
<!DOCTYPE html>
<!-- saved from url=(0066)http://vadikom.github.io/smartmenus/src/demo/bootstrap-navbar.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pasantias</title>


     <!--   Mensajes validaciones-->

    <link rel="stylesheet" href="../js/dist/css/amaran.min.css">
    <link rel="stylesheet" href="../js/dist/css/animate.min.css">
   
   <!--  FIN  Mensajes validaciones-->

      <!--    MENU CUERPO-->
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



  <body style="padding-top: 20px;" >
    
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



<div align="center" >
    
    <div style="width:60%">

             <table class="table table-bordered">
                <tr class="well">
                  <td><h4 align="center">Gesti&oacute;n Tutor Empresarial</h4></td>
                 
                </tr>
                <tr>          
                  <td>
                    <div class="row-fluid" align="center">
                          <div class="span6">
                              
                              <input type="hidden" id="id_organizacion" placeholder="id organiza" name="id_organizacion" value="<?php echo $ID_ORGANIZACION; ?>">
                              <input type="hidden" id="id_oficina" placeholder="id oficina" name="id_organizacion" value=""><br>

                              <strong>Cedula:</strong> &nbsp;<br>
                              <input type="text" id="cedula" name="cedula" data-suggest="true" placeholder="CÉDULA" value="" autocomplete="off" required onkeyup="Autocomplete();">
                              <font color="red" size="4">*</font>
                            <br> 

                              <strong>Nombre:</strong> &nbsp;<br>
                              <input type="text" id="nombre" name="nombre"  placeholder="NOMBRE" value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()" >
                              <font color="red" size="4">*</font>
                            <br> 

                              <strong>Apellido:</strong> &nbsp;<br>
                              <input type="text" id="apellido" name="apellido" placeholder="APELLIDO" value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()">
                              <font color="red" size="4">*</font>
                            <br>

                          </div>
                          <div class="span6">
                            <br>

                              <strong>Fecha de Asignación:</strong> &nbsp;<br>
                              <input type="Date" id="fecha" name="fecha"  value="<?php echo date("Y-m-d");?>" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()">
                              <font color="red" size="4">*</font>
                            <br> 

                              <strong>Observación:</strong> &nbsp;<br>
                              <textarea id="observacion" name="observacion" placeholder="ESCRIBA UNA BREVE OBSERVACIÓN..." value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()"></textarea>
                              <font color="red" size="4">*</font>
                            <br> 


                              <strong>Oficina:</strong><br>
                                  <select id="oficina" name="perfil" required>
                                    <option value="">SELECCIONE...</option>
                                    <?php
                                    	require_once('../controlador/TutorEmpresarial.php');
                                    	$ctr= new Tutor_Controller();
                                    	$ctr->CargarSelect_Oficinas($ID_ORGANIZACION);

                                    ?>  
                                  </select> <br>
                          </div>
                          </div>
                          <br>
                              <center> 
                               <input   type="button" id="RegistrarPersona" name="botRegistrar" value="Registrar" class="btn btn-primary btn-large">
                               <input   type="button" id="ModificarPersona" name="botRegistrar" value="Modificar" class="btn btn-primary btn-large" disabled="disabled">
                               <input   type="button" id="Cancelar" name="botRegistrar" value="Cancelar" class="btn btn-primary btn-large">
                               <input   type="button" id="Reporte" name="botRegistrar" value="Reporte" class="btn btn-primary btn-large">  
                              </center>
                                              
                          
                        <font color="red" size="2">(*) </font><font color="red" size="1">Campos Obligatorios... </font> 
            
                  </td>
                </tr>
            </table>

          


                          <table width="100%">
                          <tr>
                          <td>

                            <table class="table table-bordered"  >
                                  <tr class="well">
                                  <td>
                                      <center><strong>Tutores Asignados</strong></center>
                                  </td>
                                  </tr>
                            </table>

                            <div class="table-responsive">
                           <!--TABLA CATALAGO-->
                              <table class="table table-striped table-hover dt-responsive nowrap compact" id="myTable"  cellspacing="0" style="cursor:pointer; width:100%">
                                <thead>
                                   
                                    <tr>
                                        <td hidden><strong ><center>ID</center></strong></td>
                                        <td><strong><center>Nombre Oficina</center></strong></td>
                                        <td><strong><center>Cédula</center></strong></td>
                                        <td><strong><center>Nombre</center></strong></td>
                                        <td><strong><center>Apellido</center></strong></td>
                                        <td><strong><center>Fecha Aceptación</center></strong></td>
                                        <td><strong><center>Observación</center></strong></td>
                                        <td><strong><center>Opción</center></strong></td>  
                                    </tr>
                                </thead>
                              </table>
                            </div>

                      </td>
                      </tr>
                      </table>
  


</div>
</div>


 <!-- LIBRERIAS DE AUTOCOMPLETADO -->
<link  href="../js/completer.css" rel="stylesheet">
<script type="text/javascript" src="../js/completer.js"></script>  

   <!-- FIN LIBRERIAS DE AUTOCOMPLETADO -->



 <!--   Mensajes-->
 <script src="../js/dist/js/jquery.amaran.min.js"></script>
 <script src="../js/dist/js/jquery.amaran.js"></script>
   <!--  FIN  Mensajes-->

<script src="../../Modulo_tipoOrganizacion/js/letrasNunmers.js"></script>


<script type="text/javascript" src="../js/tutores.js"></script>



   <!--PAGINADOR - T A B L A S-->
    
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.min.js"></script>
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/dataTables.bootstrap.min.js"></script> 
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/dataTables.responsive.min.js"></script> 
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/responsive.bootstrap.min.js"></script> 

    <link rel="stylesheet" href="../../../Menus/bootstrap/css/selectBien.css">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables_themeroller.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/responsive.bootstrap.min.css" rel="stylesheet"> 

 <!--PAGINADOR - T A B L A S-->

  <script>
    $(document).ready(function(){
      $('#myTable').dataTable();
    });
  </script>


</body></html>
