<?php
session_start();

$id_perfil=$_SESSION['id_perfil'];
$nombre_perfil=$_SESSION['nombre_perfil'];

$nombre_persona = $_SESSION['persona'];


if(isset($_SESSION['id_perfil'])){
  $id_perfil=$_SESSION['id_perfil'];
$nombre_perfil=$_SESSION['nombre_perfil'];

$nombre_persona = $_SESSION['persona'];

}else
{
  $id_perfil=1;
$nombre_perfil="Menú Principal";
echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php'>";
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
  $organizacion = $persona-> consultar_id_Institucion($_SESSION['id_organizacion']);
 $_SESSION['ID_ORGANIZACION_P'] = $_SESSION['id_organizacion'];
 $_SESSION['ID_INSTITUCION']=$organizacion[0];
 $nombre_organizacion=$_SESSION['nombre_instituto']=$organizacion[1];

 $arreglo= $persona->codigo_estudiante($_SESSION['id_persona'] , $_SESSION['codigo_sucursal']);
  $codigo_estudiante= $arreglo[1];
  $id_especialidad =$arreglo[0];
 $_SESSION['nombre_especialidad'] =$arreglo[2];
  $_SESSION['id_especialidad'] = $id_especialidad;
  $_SESSION['codigo_estudiante']=$codigo_estudiante;
 
$persona->menu($id_perfil , $nombre_perfil , $nombre_organizacion ,$nombre_persona );


?>

<!-- Fin De MENU-->

<div align="center">
        <div style="width:60%">
        <table class="table table-bordered">
          <tr class="well">
              <td><h4 align="center"></h4></td>
            </tr>
          <tr>
            <td>
                  <br><br><br><br><br><br><br>
                  <br><br><br><br><br><br><br>
                  <br><br><br><br><br><br><br>
                        </form>
                    </center>
                </td>
          </tr>
        </table>
    </div></div>
      

  

  
</body></html>
