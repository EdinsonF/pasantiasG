<<<<<<< HEAD
<?php
  session_start();
    if(isset($_SESSION['id_perfil'])){
      $id_perfil=$_SESSION['id_perfil'];
      $nombre_perfil=$_SESSION['nombre_perfil'];

      $nombre_persona = $_SESSION['persona'];

    }else{
      $id_perfil=1;
      $nombre_perfil="Menú Principal";
    }

 ?>
<!DOCTYPE html>
<!-- saved from url=(0066)http://vadikom.github.io/smartmenus/src/demo/bootstrap-navbar.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pasantias</title>


  <!--    MENU CUERPO -->

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
$organizacion = $persona-> consultar_id_Empresa($_SESSION['codigo_sucursal']);

 $_SESSION['id_organizacion']=$organizacion[0];
 $_SESSION['nombre_organizacion']=$organizacion[1];
 $nombre_organizacion =  $_SESSION['nombre_organizacion'] ;


    if($id_perfil== 1){
      $persona->menu($id_perfil , $nombre_perfil , '','' );
    }
    else
    {
      $persona->menu($id_perfil , $nombre_perfil , $nombre_organizacion ,$nombre_persona );
    }
?>

<!-- Fin De MENU-->

  

  
</body></html>
=======
<?php
  session_start();
    if(isset($_SESSION['id_perfil'])){
      $id_perfil=$_SESSION['id_perfil'];
      $nombre_perfil=$_SESSION['nombre_perfil'];

      $nombre_persona = $_SESSION['persona'];

    }else{
      $id_perfil=1;
      $nombre_perfil="Menú Principal";
    }

 ?>
<!DOCTYPE html>
<!-- saved from url=(0066)http://vadikom.github.io/smartmenus/src/demo/bootstrap-navbar.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pasantias</title>


  <!--    MENU CUERPO -->

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
$organizacion = $persona-> consultar_id_Empresa($_SESSION['codigo_sucursal']);

 $_SESSION['id_organizacion']=$organizacion[0];
 $_SESSION['nombre_organizacion']=$organizacion[1];
 $nombre_organizacion =  $_SESSION['nombre_organizacion'] ;


    if($id_perfil== 1){
      $persona->menu($id_perfil , $nombre_perfil , '','' );
    }
    else
    {
      $persona->menu($id_perfil , $nombre_perfil , $nombre_organizacion ,$nombre_persona );
    }
?>

<!-- Fin De MENU-->

  

  
</body></html>
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
