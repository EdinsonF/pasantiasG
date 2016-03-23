<?php
session_start();

if(isset($_SESSION['id_perfil'])){
$id_perfil=$_SESSION['id_perfil'];
$nombre_perfil=$_SESSION['nombre_perfil'];
$nombre_organizacion =  $_SESSION['nombre_instituto'];
$nombre_persona = $_SESSION['persona'];
$ID_INSTITUCION=$_SESSION['ID_INSTITUCION'];
$_SESSION['id_persona_encargada']=$_SESSION['id_persona'];

}
?>
 <!DOCTYPE html>
<!-- saved from url=(0066)http://vadikom.github.io/smartmenus/src/demo/bootstrap-navbar.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pasantias</title>
<script language='javascript' src="js/validar.js"></script> 

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
$persona= new usuarios();    if($id_perfil== 1){
      $persona->menu($id_perfil , $nombre_perfil , '','' );
    }
    else
    {
      $persona->menu($id_perfil , $nombre_perfil , $nombre_organizacion ,$nombre_persona );
    }
?>

<!-- Fin De MENU-->
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
            
            $act_usu1='active';$act_usu2='';$act_usu3='';

			?>
            <div class="tabbable" style="margin-bottom: 18px;">
	            <ul class="nav nav-tabs">
    		        <li class="<?php echo $act_usu1; ?>"><a href="#tab1" data-toggle="tab"><strong>Solicitudes Pendientes</strong></a></li>
            		<li class="<?php echo $act_usu2; ?>"><a href="#tab2" data-toggle="tab"><strong>Solicitudes Aprobadas</strong></a></li>
                    <li class="<?php echo $act_usu3; ?>"><a href="#tab3" data-toggle="tab"><strong>Solicitudes Rechazadas</strong></a></li>

        	    </ul>

            	<div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
            		<div class="tab-pane <?php echo $act_usu1; ?>" id="tab1">
                    	   <div class="row-fluid">
                               
                               <br> <!--TABLA CATALAGO-->
                        <table class="display dataTable" id="myTable" whidth="100%">
                          
                        <?php 
                ;
                  include('../modelo/mod_estudiante.php');

                  $classe= new estudiante();

                  $classe->CargarCatalogoAprobarEstudiante($ID_INSTITUCION);
                ?>
                        </table>

                            </div>
			            
            		</div>
		            <div class="tab-pane <?php echo $act_usu2; ?>" id="tab2">
        				
							<br>
                        <table class="display dataTable" id="myTable2" whidth="100%">
                        <?php
                        $classe->CargarCatalogoEstudianteAprobados($ID_INSTITUCION);
                        ?>  
                        </table>
                       
		            </div>



                <div class="tab-pane <?php echo $act_usu3; ?>" id="tab3">
            <br>

                        <table class="display dataTable" id="myTable3" whidth="100%">
                          <?php 
                          $classe->CargarCatalogoEstudianteReprobados($ID_INSTITUCION);
                          ?>
                        </table>

                    </div>


        	    </div>
            </div>


                          
</div >



<!-- - TABLA MODAL Reprobar  -->

    <div id="tabla_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
    <h3  align="center">Observación De Rechazo<br></h3>

    </div>
    <div class="modal-body" align="center">
  
     
            <!--TABLA DE LOS REGISTROS A ASIGNAR-->

             <?php 
            $act_usu1='active';
             ?>
            <div class="tabbable" style="margin-bottom: 18px;">
              <ul class="nav nav-tabs">
               <li class="<?php echo $act_usu1; ?>"><a href="#tab1" data-toggle="tab"><strong>Observación</strong></a></li>
                  
              </ul>
              <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
              
                <div class="tab-pane <?php echo $act_usu1; ?>" id="tab1">
                <form name='' action='../controlador/ctr_estudiante.php' method='post' >
                        <br>
                        <input type='hidden' name='id_personam' id='id_personam' autocomplete='off'>
                                
                      <textarea type="text" name="observacion" id="observacion" value="" rows="10" autocomplete="off"></textarea>
                        <br>   
                        
                        
                               
                </div>

</div>
</div>




    </div>  
    <div class="modal-footer">
    <input type='submit' class='btn btn-primary btn-large' name='btnRechazarr' value='Rechazar'>
    <button  class="btn" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong></button>
  </form>
    </div>
    </div>      
</div>
</div>
<!-- fin del modal -->


<!--PAGINADOR-->
       <script>
    $(document).ready(function(){
      $('#myTable').dataTable();
      $('#myTable2').dataTable();
      $('#myTable3').dataTable();

    });
  </script>
     <!--PAGINADOR - T A B L A S-->
    
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.js"></script>
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.min.js"></script>

    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables_themeroller.css" rel="stylesheet">

 <!--PAGINADOR - T A B L A S-->
           
           <!--   Mensajes-->
 <script src="../js/dist/js/jquery.amaran.min.js"></script>
 <script src="../js/dist/js/jquery.amaran.js"></script>
   <!--  FIN  Mensajes-->
<script src='../js/estudiante.js'></script>

  </body>
</html>
