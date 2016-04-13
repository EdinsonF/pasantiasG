<?php
session_start();

if(isset($_SESSION['id_perfil'])){
$id_perfil=$_SESSION['id_perfil'];
$nombre_perfil=$_SESSION['nombre_perfil'];


$nombre_organizacion =  $_SESSION['codigo_sucursal'];
$nombre_persona = $_SESSION['persona'];

}else{ 
$id_perfil=1;
$nombre_perfil="Menu Principal";
}
$ID_PERSONA=$_SESSION['id_persona'];

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title> Pasantias </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <title>Pasantias</title>

 <!--   Mensajes-->

    <link rel="stylesheet" href="../js/dist/css/amaran.min.css">
    <link rel="stylesheet" href="../js/dist/css/animate.min.css">



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
  
  <body style="padding-top: 20px;" id="body">

<!--inicio del menu -->

<?php

include("../../../BASE_DATOS/Conect.php");
$conexionBD = new Conexion();
$conexionBD->Conectar();
include("../../Modulo_Usuario/modelo/mod_usuario.php");
$persona= new usuarios();

    $nombre_organizacion= $persona->buscar_nombre_organizacion($nombre_organizacion);

    if($id_perfil== 1){
      $persona->menu($id_perfil , $nombre_perfil , '','' );
    }
    else
    { 
      
      $persona->menu($id_perfil , $nombre_perfil , $_SESSION['nombre_organizacion'] ,$nombre_persona );
    }


?>



                                  
                                  <input type="" value="<?php  echo $_SESSION['codigo_sucursal']?>">
	                                <table class="table table-bordered"  align="center">
					                      <tr class="well">
					                      	<td>
					                       		<h4 align="center"> Gestionar Reportes</h4>
					                      	</td>
					                      </tr>
							          </table>


					                    <table rules="rows" frame="vsides"  border="2"  width="70%" cellpadding="10" align="center">

							                    <tr><td><br><center><button name="Reporte" type="submit" id="ReporteGeneralPostulaciones" class="btn btn-primary btn-sm" ><img src="../../Modulo_Departamento/vista/icon/pdf2.png" width="20">Postulaciones</button></center><br></td></tr>
							                    
							                    <tr><td><br><center><button name="Reporte2" type="submit" id="ResportePostuladosAceptados" class="btn btn-primary btn-sm" ><img src="../../Modulo_Departamento/vista/icon/pdf2.png" width="20">Postulaciones Aceptadas</button></center><br></td></tr>
							                    <!-- <tr><td><br><center><strong>Tipo de Especialidad</strong></center><br> 
							                    			<center><select id="tipo_e" name="tipo_especialidad"  required>
							                                	<option value="">SELECCIONE...</option>
									                               <?php
									                               	 //$Control->CargarSelect_TipoEspeciualidad();
									                               ?>
							                      			</select><br><br><button name="Reporte_Tipo" type="submit" class="btn btn-primary btn-sm" ><img src="icon/pdf2.png" width="20">Generar Reporte</button></center><br></td></tr>
							                     
							                    
							                    <tr><td><br><center><button name="Reporte_PersonasAsignadas" type="submit" class="btn btn-primary btn-sm" ><img src="icon/pdf2.png" width="20">Personas Asignadas A Especialidades</button></center><br></td></tr>
							                    <tr><td><br><center><strong>Personas Asignadas Por Fecha</strong><br><br><input type="date" name="fecha_i" id="fecha_i" required> - <input type="date" name="fecha_f" id="fecha_f" required><br><button name="Reporte_PersonasFecha" type="submit" class="btn btn-primary btn-sm" id="Reporte_PersonasEspecialidad_Fecha" ><img src="icon/pdf2.png" width="20">Generar Reporte</button><br></center></td></tr>
							                       -->
					                    </table>
         



	<script type="text/javascript" src="../js/Reportes.js" ></script>

   
  </body>
</html>
