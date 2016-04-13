<?php
session_start();

if(isset($_SESSION['id_perfil'])){
$id_perfil=$_SESSION['id_perfil'];
$nombre_perfil=$_SESSION['nombre_perfil'];
$id_persona = $_SESSION['id_persona'];


$nombre_organizacion =  $_SESSION['nombre_instituto'];
$nombre_persona = $_SESSION['persona'];
$id_instituto = $_SESSION['ID_INSTITUCION'];
}else { 
$id_perfil=1;

$nombre_perfil="Menu Principal";
}
?>
<!DOCTYPE html>
<!-- saved from url=(0066)http://vadikom.github.io/smartmenus/src/demo/bootstrap-navbar.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pasantias</title>

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

  <link rel="stylesheet" href="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.css">
  <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.js"></script>
  <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.min.js"></script>


  </head>

  <body style="padding-top: 20px;">

<!--inicio del menu -->
<input type="hidden" id="id_persona" value="<?php echo $id_persona ?>" >
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
            <td><h4 align="center">Datos Personales</h4></td>
            </tr>
          <tr>
            <td>
                  <center>
                        
                          
              <div class="row-fluid">
              <div class="span6">

                    
                    <strong>C&eacute;dula:</strong><br>
                    <input type="text" id="cedulaPE" name="cedula" value="" autocomplete="off" required maxlength="9" disabled="" > 
                    <br>
                    <strong>Nombre:</strong><br>
                    <input type="text" id="nombrePE" name="nombre" value="" autocomplete="off" required  disabled="">
                    <br>
                   
                    <strong>Apellido:</strong><br>
                    <input type="text" id="apellidoPE" name="apellido" value="" autocomplete="off" required disabled="">
                    <br>

                </div>
                <div class="span6">
                      <strong>Nro. Tel&eacute;fono:</strong><br> <span="telf">
                      <input type="text" id="telefonoPE"  name="telefono" maxlength="14"  autocomplete="off" required >
                      <br>
                   </span>
                      <strong>Correo:</strong><br>  <span="email">
                      <input type="email" id="correoPE" name="correoPE"  maxlength="30" value="" autocomplete="off" required >
                      <br>
                   </span>
                      <strong>Usuario:</strong><br>
                     <input type="text" id="usuarioP" name="usuarioP" value="" autocomplete="off" maxlength="10" required >
                     <br>
                      <div id="usuario"></div>  

                  
                      <strong>Contraseña:</strong><br>  <span="clave">
                      <input type="password" id="contrasena_a" name="contrasena_a"  maxlength="15" value="" maxlength="8"  autocomplete="off" required>
                     
                    </span>

                      
                </div  >
                            </div  > <br>
                            <center> 
                            <input id="Modificar" type="submit" value="Modificar" class="btn btn-primary btn-large">
                            </center>

                            
                             </center>  
     
                </td>
          </tr>
        </table>

        </div>
        </div>

    </div>
</div>
  <script type="text/javascript"  src="../js/modificarDatos.js" ></script>


</body></html>
