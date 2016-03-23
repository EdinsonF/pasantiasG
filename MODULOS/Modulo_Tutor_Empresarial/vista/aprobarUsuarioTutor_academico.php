<?php 
	session_start();
    if(isset($_SESSION['id_perfil'])){
        $id_perfil=$_SESSION['id_perfil'];
        $nombre_perfil=$_SESSION['nombre_perfil'];
        $nombre_organizacion =  $_SESSION['nombre_instituto'];
        $nombre_persona = $_SESSION['persona'];
        $ID_ORGANIZACION_PRINCIPAL=$_SESSION['ID_ORGANIZACION'];
    }else { 
                $id_perfil=1;
                $nombre_perfil="Menu Principal";
        }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title> Pasantias </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <script language='javascript' src="js/validar.js"></script> 

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
  
  <body>

<?php

include("../../../BASE_DATOS/Conect.php");
$conexionBD = new Conexion();
$conexionBD->Conectar();
include("../../Modulo_Usuario/modelo/mod_usuario.php");
$persona= new usuarios();
    if($id_perfil== 1){
      $persona->menu($id_perfil , $nombre_perfil , '','' );
    }
    else
    {
      $persona->menu($id_perfil , $nombre_perfil , $nombre_organizacion ,$nombre_persona );
    }
?>

<div align="center">
	<table width="90%">
	  <tr>
		<td>
        	
			<table class="table table-bordered">
			  	<tr class="well">
					<td>
                    	<center><strong>Aprobación de Usuario Estudiante</strong></center>
					</td>
			  	</tr>
			</table>
         
            <?php 
            $act_usu1='active';$act_usu2='';
			       ?>
            <div class="tabbable" style="margin-bottom: 18px;">
	            <ul class="nav nav-tabs">
    		        <li class="<?php echo $act_usu1; ?>"><a href="#tab1" data-toggle="tab"><strong>Empresas</strong></a></li>
            		<li class="<?php echo $act_usu2; ?>"><a href="#tab2" data-toggle="tab"><strong>Instituciones</strong></a></li>
                    
        	    </ul>
            	<div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
            		<div class="tab-pane <?php echo $act_usu1; ?>" id="tab1">
                    	   <div class="row-fluid">
                               
                               <br> <!--TABLA CATALAGO-->
                        <table class="table table-bordered" id="myTable" whidth="100%">
                          
                        <?php 
                  include("../../../BASE_DATOS/Conect.php");
                  $conexionBD = new Conexion();
                  $conexionBD->Conectar();
                  include('../modelo/mod_tutor_academico.php');

                  $classe= new tutor_academico();

                  $classe->CargarCatalogoAprobarEstudiante();
                ?>
                        </table>

                            </div>
			            
            		</div>
		            <div class="tab-pane <?php echo $act_usu2; ?>" id="tab2">
        				
							<br>
                        <table class="table table-bordered" id="myTable2" whidth="100%">
                        <?php
                        $classe->CargarCatalogoEstudianteAprobados();
                        ?>  
                        </table>
                       
		            </div>



             


        	    </div>
            </div>


                          
</div >
    <!-- Le javascript ../../js/jquery.js
    
    onchange="pais(this.value);"
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../js/jquery.js"></script>
    <script src="../../js/bootstrap-transition.js"></script>
    <script src="../../js/bootstrap-alert.js"></script>
    <script src="../../js/bootstrap-modal.js"></script>
    <script src="../../js/bootstrap-dropdown.js"></script>
    <script src="../../js/bootstrap-scrollspy.js"></script>
    <script src="../../js/bootstrap-tab.js"></script>
    <script src="../../js/bootstrap-tooltip.js"></script>
    <script src="../../js/bootstrap-popover.js"></script>
    <script src="../../js/bootstrap-button.js"></script>
    <script src="../../js/bootstrap-collapse.js"></script>
    <script src="../../js/bootstrap-carousel.js"></script>
    <script src="../../js/bootstrap-typeahead.js"></script>
	
    
<!--    <script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/prototype.js"></script>
    <script type="text/javascript" src="js/eventos.js"></script>-->
    
     <!--PAGINADOR-->
<script src="../js/js_tabla/jquery.dataTables.js"></script>
<link href="../js/js_tabla/jquery.dataTables.css" rel="stylesheet">
    <script>
		$(document).ready(function(){
			$('#myTable').dataTable();
            $('#myTable2').dataTable();
            $('#myTable3').dataTable();
		});
	</script>
  <script src='../js/js_tabla/tablesort.min.js'></script>

	<script>
      new Tablesort(document.getElementById('table-id'));
    </script>
  </body>
</html>
