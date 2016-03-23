<?php
session_start();
$id_perfil=1;
$nombre_perfil="Menú Principal";


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
<script src="../../../Menus/bootstrap/js/jquery-1.10.2.min.js"></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/jquery.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/bootstrap.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/highlight.min.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/bootstrap-submenu.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/docs.js" defer=""></script>

  </head>

  <body style="padding-top: 20px;">


<!--inicio del menu -->

<?php

include("../../../BASE_DATOS/Conect.php");
$conexionBD = new Conexion();
$conexionBD->Conectar();
include("../../Modulo_Usuario/modelo/mod_usuario.php");
$persona= new usuarios();


$persona->menu($id_perfil, $nombre_perfil ,'','');
?>

<!-- Fin De MENU-->

<?php 
// Archivo en donde se acumulará el numero de visitas 
$archivo = "contador.txt"; 

// Abrimos el archivo para solamente leerlo (r de read) 
$abre = fopen($archivo, "r"); 

// Leemos el contenido del archivo 
$total = fread($abre, filesize($archivo)); 

// Cerramos la conexión al archivo 
fclose($abre); 

// Abrimos nuevamente el archivo 
$abre = fopen($archivo, "w"); 

// Sumamos 1 nueva visita 
$total = $total + 1; 

// Y reemplazamos por la nueva cantidad de visitas  
$grabar = fwrite($abre, $total); 

// Cerramos la conexión al archivo 
fclose($abre); 

// Imprimimos el total de visitas dándole un formato 
echo "<font >Total de visitas:".$total."</font>"; 
?> 

<div align="center">
        <div style="width:90%">
        <table class="table table-bordered">
          <tr class="well">
              <td><h4 align="center"></h4></td>
            </tr>
          <tr>
            <td>
                  
<?php

$persona->llenar_principal($id_perfil);                                    
?>



                </td>
          </tr>
        </table>
    </div></div>
      

  

  
</body></html>
