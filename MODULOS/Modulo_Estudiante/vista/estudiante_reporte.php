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

  $_SESSION['codigo_encargado'] = $persona->codigoencargado(  $_SESSION['id_persona'] ,$_SESSION['codigo_sucursal']);

$persona->menu($id_perfil , $nombre_perfil , $nombre_organizacion ,$nombre_persona );
 
?>

<!-- Fin De MENU-->



<div align="center">
        <div style="width:60%">
<div class="tab-pane " id="tab4">

				            		<table class="table table-bordered"  >
				                      <tr class="well">
				                      <td>
				                       <center><strong> Gestionar Reportes</strong></center>
				                      </td>
				                      </tr>
						            </table>


				                    <table rules="rows" frame="vsides"  border="2"  width="100%" cellpadding="10" >

						                    <tr><td></td></tr>
						                     
						                    <tr><form action="../controlador/Reportes_Controlador.php" target="_Black" method="post"><td><br><center><strong>Solicitudes De Estudiantes</strong></center><br> 
						                    			<center><select id="tipo_e" name="tipo_solicitud"  required>
						                                	<option value="">SELECCIONE...</option>
						                                	<option value="PENDIENTE">PENDIENTES</option>
						                                	<option value="APROBADO">APROBADO</option>
						                                	<option value="REPROBADO">REPROBADOS</option>
								                               
						                      			</select>
						                      			<br><br><button name="Reporte_Tipo_Solicitud" type="submit" class="btn btn-primary btn-sm" ><img src="icon/pdf2.png" width="20">Generar Reporte</button></center><br></td></form></tr>
						                     

						                      				 <tr><form action="../controlador/Reportes_Controlador.php" target="_Black" method="post"><td><br><center><strong>Estudiantes Por Tipo de Empresa</strong></center><br> 
						                    			    <center><select id="tipo_empresa" name="tipo_empresa"  required>
													        <option value="">SELECCIONE...</option>
													  		<?php
													  		include("../modelo/mod_estudiante.php");
                                                            $estudiante= new estudiante();
  															$estudiante->llenarselecttipoorganizaciones();
													  		?>  
								                               
						                      			</select>
						                      			<br><br><button name="Reporte_Tipo_Empresa" type="submit" class="btn btn-primary btn-sm" ><img src="icon/pdf2.png" width="20">Generar Reporte</button></center><br></td></form></tr>
						                     

						                  <tr><td></td></tr>
				                    </table>
						          	
						        <!-- FIN DEL PANEL 4 -->
						        </div>
    </div></div>
      

  

  
</body></html>
