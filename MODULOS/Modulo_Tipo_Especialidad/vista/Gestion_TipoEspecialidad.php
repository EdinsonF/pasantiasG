<<<<<<< HEAD
<?php
session_start();

$id_perfil=$_SESSION['id_perfil'];
$nombre_perfil=$_SESSION['nombre_perfil'];
$nombre_persona = $_SESSION['persona'];
$nombre_organizacion =  $_SESSION['nombre_instituto'];
?>
<!DOCTYPE html>
<!-- saved from url=(0066)http://vadikom.github.io/smartmenus/src/demo/bootstrap-navbar.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tipo Especialidad</title>

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
  
  
       
  </head>

  <body style="padding-top: 20px;">

    
  

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
        <div style="width:60%">
        <table class="table table-bordered">
          <tr class="well">
              <td><h4 align="center">Gesti&oacute;n De  Tipo Especialidad</h4></td>
            </tr>
          <tr>
            <td>
                  <center>
                            <div class="row-fluid">
                              <div class="span6">
                                <strong>Tipo Especialidad:</strong><br>
                                
                                <input hidden id="id_tipo_especialidad" name="id_especialidad"  value=""/>
                                                             
                                <input type="text" id="nombre_tipo_especialidad"  value="" autocomplete="off" required id="search"  onkeyup="this.value=this.value.toUpperCase()"><br>                         
                              

                                 <strong>Descripción:</strong><br> 
                                 <textarea id="descripcion"  value="" requited onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                 
                                
                                
                                
                              </div>


                              <div class="span6" id="texto">      
                               <strong>Estatus:</strong><br>
                                    <select id="estatus"  required>
                                      <option value="ACTIVO">ACTIVO</option>
                                      <option value="INACTIVO">INACTIVO</option>
                                           
                                    </select><br>     
                                </div>


                            </div><br>
                            <form action="../controlador/TipoEspecialidad_Controller.php" target="_Black" method="post">
                            <center>
                            <input type="button" id="registrar" class="btn btn-primary btn-large" name="Registrar" value="Registrar" >
                            <input type="button" id="modificar" class="btn btn-primary btn-large" name="Modificar" value="Modificar" disabled="disabled" />
                            <input type="button" id="cancelar" class="btn btn-primary btn-large" name="Cancelar" value="Cancelar"/>
                            <button name="Reporte" type="submit" class="btn btn-primary btn-large" ><img src="icon/pdf2.png" width="20"> </button>
                            </center> </form>                                                    
              


                                   
                                </center>
                            </td>
                      </tr>
                    </table>



                     <!--TABLA CATALAGO-->
                        <table class="display dataTable" id="Table">
                          <thead>
                                <tr >
                                    <td hidden><strong ><center>ID</center></strong></td>
                                    <td><strong><center>Nombre</center></strong></td>
                                    <td><strong><center>Estado</center></strong></td>
                                    <td><strong><center>Descripción</center></strong></td>
                                    <td width="13"><strong><center>Opción</center></strong></td>
                                  
                                </tr>
                            </thead>
                            <tbody>

                              
                            </tbody>
                        </table>

 
                 
    </div></div>
      
      <!-- MESNAJES CALIDA OPERACIONES -->
    <link rel="stylesheet" href="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.css">
    <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.js"></script>
    <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.min.js"></script>
   <!-- MESNAJES CALIDA OPERACIONES-->

       <!--   Mensajes-->
 <script src="../js/dist/js/jquery.amaran.min.js"></script>
 <script src="../js/dist/js/jquery.amaran.js"></script>
   <!--  FIN  Mensajes-->

      <script src="../js/letrasNunmers.js"></script>
    


<!--PAGINADOR - T A B L A S-->
    
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.js"></script>
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.min.js"></script>

    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables_themeroller.css" rel="stylesheet">

 <!--PAGINADOR - T A B L A S-->

    <script>
    $(document).ready(function(){
      $('#Table').dataTable();
    });
  </script>    
  <script type="text/javascript" src="../js/especialidadsombra.js"></script>
  
</body></html>
=======
<?php
session_start();

$id_perfil=$_SESSION['id_perfil'];
$nombre_perfil=$_SESSION['nombre_perfil'];
$nombre_persona = $_SESSION['persona'];
$nombre_organizacion =  $_SESSION['nombre_instituto'];
?>
<!DOCTYPE html>
<!-- saved from url=(0066)http://vadikom.github.io/smartmenus/src/demo/bootstrap-navbar.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tipo Especialidad</title>

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
  
  
       
  </head>

  <body style="padding-top: 20px;">

    
  

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
        <div style="width:60%">
        <table class="table table-bordered">
          <tr class="well">
              <td><h4 align="center">Gesti&oacute;n De  Tipo Especialidad</h4></td>
            </tr>
          <tr>
            <td>
                  <center>
                            <div class="row-fluid">
                              <div class="span6">
                                <strong>Tipo Especialidad:</strong><br>
                                
                                <input hidden id="id_tipo_especialidad" name="id_especialidad"  value=""/>
                                                             
                                <input type="text" id="nombre_tipo_especialidad"  value="" autocomplete="off" required id="search"  onkeyup="this.value=this.value.toUpperCase()"><br>                         
                              

                                 <strong>Descripción:</strong><br> 
                                 <textarea id="descripcion"  value="" requited onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                 
                                
                                
                                
                              </div>


                              <div class="span6" id="texto">      
                               <strong>Estatus:</strong><br>
                                    <select id="estatus"  required>
                                      <option value="ACTIVO">ACTIVO</option>
                                      <option value="INACTIVO">INACTIVO</option>
                                           
                                    </select><br>     
                                </div>


                            </div><br>
                            <form action="../controlador/TipoEspecialidad_Controller.php" target="_Black" method="post">
                            <center>
                            <input type="button" id="registrar" class="btn btn-primary btn-large" name="Registrar" value="Registrar" >
                            <input type="button" id="modificar" class="btn btn-primary btn-large" name="Modificar" value="Modificar" disabled="disabled" />
                            <input type="button" id="cancelar" class="btn btn-primary btn-large" name="Cancelar" value="Cancelar"/>
                            <button name="Reporte" type="submit" class="btn btn-primary btn-large" ><img src="icon/pdf2.png" width="20"> </button>
                            </center> </form>                                                    
              


                                   
                                </center>
                            </td>
                      </tr>
                    </table>



                     <!--TABLA CATALAGO-->
                        <table class="display dataTable" id="Table">
                          <thead>
                                <tr >
                                    <td hidden><strong ><center>ID</center></strong></td>
                                    <td><strong><center>Nombre</center></strong></td>
                                    <td><strong><center>Estado</center></strong></td>
                                    <td><strong><center>Descripción</center></strong></td>
                                    <td width="13"><strong><center>Opción</center></strong></td>
                                  
                                </tr>
                            </thead>
                            <tbody>

                              
                            </tbody>
                        </table>

 
                 
    </div></div>
      
      <!-- MESNAJES CALIDA OPERACIONES -->
    <link rel="stylesheet" href="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.css">
    <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.js"></script>
    <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.min.js"></script>
   <!-- MESNAJES CALIDA OPERACIONES-->

       <!--   Mensajes-->
 <script src="../js/dist/js/jquery.amaran.min.js"></script>
 <script src="../js/dist/js/jquery.amaran.js"></script>
   <!--  FIN  Mensajes-->

      <script src="../js/letrasNunmers.js"></script>
    


<!--PAGINADOR - T A B L A S-->
    
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.js"></script>
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.min.js"></script>

    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables_themeroller.css" rel="stylesheet">

 <!--PAGINADOR - T A B L A S-->

    <script>
    $(document).ready(function(){
      $('#Table').dataTable();
    });
  </script>    
  <script type="text/javascript" src="../js/especialidadsombra.js"></script>
  
</body></html>
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
