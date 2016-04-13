<<<<<<< HEAD
<?php
session_start();

if(isset($_SESSION['id_perfil'])){
$id_perfil=$_SESSION['id_perfil'];
$nombre_perfil=$_SESSION['nombre_perfil'];
$nombre_organizacion =$_SESSION['nombre_instituto'];
$nombre_persona = $_SESSION['persona'];
$ID_ORGANIZACION_PRINCIPAL=$_SESSION['ID_ORGANIZACION_P'];
$id_sucursal  =$_SESSION['codigo_sucursal'];

}
  
?>


<!DOCTYPE html>
<!-- saved from url=(0066)http://vadikom.github.io/smartmenus/src/demo/bootstrap-navbar.html -->
<html lang="en" ><head ><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Oficina</title>

    <!--   Mensajes-->

    <link rel="stylesheet" href="../js/dist/css/amaran.min.css">
    <link rel="stylesheet" href="../js/dist/css/animate.min.css">
   
   <!--  FIN  Mensajes-->

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

     <!-- LIBRERIAS DE AUTOCOMPLETADO -->
<link rel="stylesheet" href="../../../Menus/bootstrap/css/typeahead.css">
<script src="../../../Menus/bootstrap/js/typeahead.js" ></script> 

	 <!-- FIN LIBRERIAS DE AUTOCOMPLETADO -->

<style>
        /* Extra styles to adjust Typeahead */
        .typeahead-container {
            max-width: 415px;

        }
        .typeahead-container22 {
            max-width: 220px;
            
       }
    </style>

  </head>
  
  <body style="padding-top: 20px;" >

 
<!-- MENU -->

<?php

include("../../../BASE_DATOS/Conect.php");
$conexionBD = new Conexion();
$conexionBD->Conectar();
include("../../Modulo_Usuario/modelo/mod_usuario.php");
$persona= new usuarios();
		 $ID_ORGANIZACION = 0;
      $persona->menu($id_perfil , $nombre_perfil , $nombre_organizacion ,$nombre_persona );
   
      if(isset($_SESSION['ID_ORGANIZACION']))
      {
      	    $ID_ORGANIZACION=$_SESSION['ID_ORGANIZACION'];
    		$NOMBRE_EMPRESA=$_SESSION['NOMBRE_EMPRESA'];
      }
 

    if($ID_ORGANIZACION==0){
    	$ACTIVAR="active";
    	

    }else{
    	$ACTIVAR4="active";
    }

    ?> 
 
     


<div align="center">
    <div style="width:60%">


        <table class="table table-bordered">
          <tr class="well">
             <td><h4 align="center">Gesti&oacute;n Departamento</h4></td>
             
            </tr>
          </table>


		         <!-- DIV GENERAL GENERAL -->
		         <div class="tabbable" style="margin-bottom: 18px;">
		              

		              <ul class="nav nav-tabs">
		        <!-- PESTAÑA 1 -->
		        <li class="<?php echo $ACTIVAR ?>"><a href="#tab1" data-toggle="tab"><strong>Gestionar Departamento</strong></a>
		        </li>
		        <!-- PESTAÑA 2 -->
		        <li class="<?php echo $ACTIVAR2 ?>"><a href="#tab2" data-toggle="tab"><strong>Asignar Personas</strong></a>
		        </li>
		        <!-- PESTAÑA 3 -->
		        <li class="<?php echo $ACTIVAR3 ?>"><a href="#tab3" data-toggle="tab"><strong>Personas Asignadas</strong></a>
		        </li>
		        <!-- PESTAÑA 4 -->
		        <!--<li class="<?php echo $ACTIVAR4 ?>"><a href="#tab4" data-toggle="tab"><strong>Asignar Departamento</strong></a>
		        </li>-->
		        <!-- PESTAÑA 5 -->
		        <li class="<?php echo $ACTIVAR5 ?>"><a href="#tab5" data-toggle="tab"><strong>Reportes</strong></a>
		        </li>
		        
		              </ul>

		              <!-- DIV GENERAL DE LOS PANELES -->
		              <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
		              

					             <!-- PANEL 1 Gestionar Especialidad-->
					             <div class="tab-pane <?php echo $ACTIVAR; ?> " id="tab1" >
					              	
					              	<table class="table table-bordered">
							          <tr class="well">
							              <td><center><strong> Gestionar Departamentos</strong></center></td>
							          </tr>
							          <tr>
							            <td>
						                 <center>
						                      <form name="form" action="../controlador/Gestion_Oficina_Controller.php" method="POST">
							                          
						                            <div class="row-fluid">
						                              <div class="span15">
					                                  <input type="hidden" id="id_oficina" name="id" value=""/>
					                                  <input type="hidden" id="id_organizacion_p" name="id_organizacion" value="<?php echo $id_sucursal ?>"/>
					                                  
					                                  <br>
					                                   <strong>Departamento:</strong> &nbsp;<br>
					                                   <div class="typeahead-container">
            										   <span class="typeahead-query"> 
					                                   <input type="text" id="nombre"  name="nombre" class="input-large2" value="" autocomplete="off" placeholder="DEPARTAMENTO" required  onkeyup="this.value=this.value.toUpperCase();" >
					                                   <font color="red" size="4">*</font> 
					                                   </span>
					                                   </div>
					                                   
	
					                                    <strong>Estatus:</strong> &nbsp;<br>
					                                        <select id="estatus" name="estatus" class="form-control" required>
					                                        
					                                            <option value="" >SELECCIONE...</option>
					                                            <option value="ACTIVO">ACTIVO</option>
					                                            <option value="INACTIVO">INACTIVO</option>';

					                                    	</select>
					                                    	<font color="red" size="4">*</font>
					                                    	<br>   

														<br>						                               
						                                <strong>Descripción:</strong> <br>
						                                <textarea id="descripcion" class="large" placeholder="BREVE DESCRIPCÓN DEL DEPARTAMENTO..." name="descripcion" value=""  autocomplete="off" required rows="3" onkeyup="this.value=this.value.toUpperCase()"></textarea>

						                                <br>  

						                                    
						                                </div>


						                                </div>
						                            <br>
						                            <center>
						                            
						                            <center><input type="button" id="Registrar" class="btn btn-primary btn-large" name="Registrar" value="Registrar" >
						                            <input type="button" id="Modificar" class="btn btn-primary btn-large" name="Modificar" value="Modificar" disabled="disabled"/>
						                            <input type="button" id="Cancelar" class="btn btn-primary btn-large" name="Cancelar" value="Cancelar" />
						                            </center>
						                            
						                            </center>

						                        </form>
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
					                    <center><strong> Departamentos Por Oficinas Registrados</strong></center>
					                </td>
					                </tr>
					            </table>
                   
					            <!--TABLA DE LOS REGISTROS-->
					            <div class="table-responsive">
					            <table class="table table-striped table-hover dt-responsive nowrap compact" id="mYTable" width="100%">
					              <?php 
					              /*require_once("../controlador/Gestion_Oficina_Controller.php");
					              $Control=new Gestion_Oficina_Controller();
					              $Control->CargarCatalago_Oficina($id_sucursal);*/
					              ?>
					              <thead>
	                                <tr >
	                                    <td hidden><strong ><center>ID</center></strong></td>
	                                    <td><strong><center>Nombre</center></strong></td>
	                                    
	                                    <td><strong><center>Descripci&oacute;n</center></strong></td>
	                                    <td><strong><center>Estado</center></strong></td>
	                                    <td><strong><center>Opción</center></strong></td>
	                         
	                                 </tr>
	                       		  </thead>
					            </table>
					            </div>
					    </td>
					    </tr>
					  </table>


					             <!-- FIN DEL PANEL 1 -->
					             </div>

					             <!-- //////////////////////////////////////////////////////////// -->


					             <!-- PANEL 2 Asignacion de Especialidad-->
					            <div class="tab-pane " id="tab2">

				            		<table width="100%">

							            <tr>
							            <td>

							            <table class="table table-bordered"  >
					                      <tr class="well">
					                      <td>
					                                  <center><strong> Asignar Personas</strong></center>
					                      </td>
					                      </tr>
							            </table>


					                 <!--TABLA CATALAGO-->
					                 <div class="table-responsive">
					                    <table class="table table-striped table-hover dt-responsive nowrap compact" id="myTable3"  width="100%">
					                      <?php
					                     //$Control->CargarCatalago_Oficina_AsignarPersonas($id_sucursal);
					                      ?>
					                      <thead>
			                                <tr >
			                                    <td hidden><strong ><center>ID</center></strong></td>
			                                    <td><strong><center>Nombre</center></strong></td>
			                                    <td><strong><center>Descripci&oacute;n</center></strong></td>
			                                    <td><strong><center>Estado</center></strong></td>
			                                    <td><strong><center>Opción</center></strong></td>
			                         
			                                 </tr>
			                        	  </thead>
					                    </table>
					                    </div>

									    </td>
									    </tr>
									    </table>
	
						        <!-- FIN DEL PANEL 2 -->
						        </div>







					             <!-- //////////////////////////////////////////////////////////// -->

					             <!-- PANEL 3 ASIGNAR PERSONAS-->
					            <div class="tab-pane <?php echo $ACTIVAR3; ?>" id="tab3">
					            		<table width="100%">

							            <tr>
							            <td>

							            <table class="table table-bordered"  >
					                      <tr class="well">
					                      <td>
					                                  <center><strong>Personas Asignadas</strong></center>
					                      </td>
					                      </tr>
							            </table>


					                 <!--TABLA CATALAGO-->
					                 <div class="table-responsive">
					                    <table class="table table-striped table-hover dt-responsive nowrap compact" id="myTable2"  width="100%">
					                      <?php
					                      //$Control->CargarCatalogo_Personas_OficinasOrganizacion($id_sucursal);
					                      ?>
					                      <thead>
		                                    <tr class="well" >
		                                    <td colspan="4"><strong ><center>Oficina</center></strong></td>
		                                    <td colspan="5"><strong ><center>Personas</center></strong></td>
		                                    </tr>
		                                    <tr >
		                                        <td hidden><strong ><center>ID</center></strong></td>
		                                        <td><strong><center>Nombre Oficina</center></strong></td>
		                                        <td><strong><center>Descripci&oacute;n</center></strong></td>
		                                        <td><strong><center>Estado</center></strong></td>
		                                        <td><strong><center>Cédula</center></strong></td>
		                                        <td><strong><center>Nombre</center></strong></td>
		                                        <td><strong><center>Apellido</center></strong></td>
		                                        <td><strong><center>Perfil</center></strong></td>
		                                        <td><strong><center>Opción</center></strong></td>  
		                                    </tr>
		                            	  </thead>
					                    </table>
					                    </div>

									    </td>
									    </tr>
									    </table>
	
					            	
				            		
						          	
						        <!-- FIN DEL PANEL 3 -->
						        </div>


						         <!-- //////////////////////////////////////////////////////////// -->

					            
				            

						        <!-- //////////////////////////////////////////////////////////// -->

					             <!-- PANEL 5 Reportes-->
					            <div class="tab-pane " id="tab5">

				            		<table class="table table-bordered"  >
				                      <tr class="well">
				                      <td>
				                       <center><strong> Gestionar Reportes</strong></center>
				                      </td>
				                      </tr>
						            </table>

				                    <table rules="rows" frame="vsides"  border="2"  width="70%" cellpadding="10" >

						                    <tr><form action="../controlador/Gestion_Oficina_Controller.php" target="_Black" method="post"><td><br><center><button name="Reporte" type="submit" class="btn btn-primary btn-sm" ><img src="icon/pdf2.png" width="20"> Todas Las Oficinas </button></center><br></td></form></tr>
						                    <tr><form action="../controlador/Gestion_Oficina_Controller.php" target="_Black" method="post"><td><br><center><button name="Reporte_HistorialOficinas" type="submit" class="btn btn-primary btn-sm" ><img src="icon/pdf2.png" width="20">Historial De Oficinas</button></center><br></td></form></tr>
						                    <tr><form action="../controlador/Gestion_Oficina_Controller.php" target="_Black" method="post"><td><br><center><button name="Reporte_PersonasAsignadas" type="submit" class="btn btn-primary btn-sm" ><img src="icon/pdf2.png" width="20">Personas Asignadas A Mis Oficinas </button></center><br></td></form></tr>
						                    <tr><td><br><center><strong>Personas Asignadas Por Fecha</strong><br><br><input type="date" name="fecha_i" id="fecha_i" required> - <input type="date" name="fecha_f" id="fecha_f" required><br><button name="Reporte_PersonasFecha" type="submit" class="btn btn-primary btn-sm" id="Reporte_PersonasOficina_Fecha" ><img src="icon/pdf2.png" width="20">Generar Reporte</button><br></center></td></tr>
		    
				                    </table>
						          	
						        <!-- FIN DEL PANEL 5 -->
						        </div>

				        <!-- FIN DEL DIV DE LAS PANELES GENERALES -->
				        </div>
		        <!-- FIN DEL DIV GENERAL GENERAL -->
		        </div>

    		

    	</div></div>
      





<!-- - TABLA  MODAL PERSONAS -.-  -->

    <div id="tablaPersonas" class="modal fade" >
     <div class="modal-dialog">
        <div class="modal-content"> 

		    <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
		    <h3  align="center">Asignar Persona<br></h3>

		    </div>
		    <div class="modal-body" >
		  
		             
		            <div class="tabbable" style="margin-bottom: 18px;">

		              <ul class="nav nav-tabs">
		                <li class="active"><a href="#tabMod_T_Empresarial active" data-toggle="tab"><strong>Registrar Tutor Empresarial</strong></a></li>
		                
		                    
		              </ul>
			              <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">

			                <!-- PERSONAS------ -->
			                <div class="tab-pane active" id="tabMod_T_Empresarial" align="center">
			                
			         
			              			<form name="form" action="" method="post" onsubmit="return validar_registro_estudiante()" >
		                          
		                            <div class="row-fluid">
		                              <div class="span6">
		                                    <input type="hidden" id="id_oficina_asignarP" name="id_oficina" value="">
		                                    <input type="hidden" id="id_organizacion_asignarP" name="id_organizacion" value=""><br>

		                                    
		                                    <div class="typeahead-container22">
		                                    <div class="typeahead-container">
            							    <span class="typeahead-query"> 
		                                    <strong>Cédula:</strong> &nbsp;<br>
		                                    <input type="text" id="cedula" name="cedula"  placeholder="CÉDULA" value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()">
		                                    <font color="red" size="4">*</font>
							                </span>
							                </div>
							                </div>

		                                    <strong>Nombre:</strong> &nbsp;<br>
		                                    <input type="text" id="nombre_p" name="nombre"  placeholder="NOMBRE" value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()" >
		                                    <font color="red" size="4">*</font>
							                <br> 

		                                    <strong>Apellido:</strong> &nbsp;<br>
		                                    <input type="text" id="apellido_p" name="apellido" placeholder="APELLIDO" value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()">
		                                    <font color="red" size="4">*</font>
							                <br>

		                      				</div>
		                      				<div class="span6">
		                      				<br>

		                                    <strong>Observación:</strong> &nbsp;<br>
		                                    <textarea id="observacion_p" name="observacion" placeholder="ESCRIBA UNA BREVE OBSERVACIÓN..." value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()"></textarea>
		                                    <font color="red" size="4">*</font>
							                <br> 

							                <strong>Perfil:</strong><br>
		                                    <select id="perfil" name="perfil" required>
		                                    <option value="">SELECCIONE...</option>
		                                    <option value="EMPRESARIAL">TUTOR EMPRESARIAL</option>
		                                    <option value="CONTACTO">CONTACTO</option>	
		                                    </select> <br>

		                                    <strong>Oficina:</strong><br>
		                                    <input type="text" id="nombre_oficina_asignarP" name="oficina_p" value="" autocomplete="off" disabled="" > <br>
		                                </div>
			                            </div>
			                            <center> 
			                              
			                            </center>
		                        </form>                          
			                </div>
			                <font color="red" size="2">(*) </font><font color="red" size="1">Campos Obligatorios... </font>	
		              </div>
		            </div>
		    </div>  
		    <div class="modal-footer">
		    <input   type="button" id="Asignar_Personas" name="botRegistrar" value="Asignar" class="btn btn-primary btn-large"> 
		    <button   data-dismiss="modal" id="cerrar" class="btn btn-default" aria-hidden="true"><strong>Cerrar</strong>
		    </button>
		  
		  	</div>
		  	</div>

		    </div>
		    </div>
    <!-- FIN DEL MODAL DE PERSONAS------ --> 








    <!-- ----------------------------------- TABLA2 MODAL DEPARTAMENTOS PARA ASIGNAR-->

    
    <!-- ----------------------------------- FIN TABLA2 MODAL DEPARTAMENTOS-->


<!-- Estilo De Selects Very Good -->

<link rel="stylesheet" href="../../../Menus/bootstrap/bootstrap-select/css/jquery.selectBoxIt.css">
<script src="../../../Menus/bootstrap/bootstrap-select/js/jquery-ui-1.8.23.custom.min.js" defer=""></script> 
<script src="../../../Menus/bootstrap/bootstrap-select/js/jquery.selectBoxIt.min.js" defer=""></script>

  <!-- Estilo De Selects Very Good -->


    <!--   Mensajes-->
 <script src="../js/dist/js/jquery.amaran.min.js"></script>
 <script src="../js/dist/js/jquery.amaran.js"></script>
   <!--  FIN  Mensajes-->




<script src="../js/letrasNunmers.js"></script>
<script type="text/javascript" src="../js/oficina.js"></script>
  

  




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
      $('#mYTable').dataTable();
            $('#myTable2').dataTable();
            $('#myTable3').dataTable();
    });
  </script>

  
</body></html>
=======
<?php
session_start();

if(isset($_SESSION['id_perfil'])){
$id_perfil=$_SESSION['id_perfil'];
$nombre_perfil=$_SESSION['nombre_perfil'];
$nombre_organizacion =$_SESSION['nombre_instituto'];
$nombre_persona = $_SESSION['persona'];
$ID_ORGANIZACION_PRINCIPAL=$_SESSION['ID_ORGANIZACION_P'];
$id_sucursal  =$_SESSION['codigo_sucursal'];

}
  
?>


<!DOCTYPE html>
<!-- saved from url=(0066)http://vadikom.github.io/smartmenus/src/demo/bootstrap-navbar.html -->
<html lang="en" ><head ><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Oficina</title>

    <!--   Mensajes-->

    <link rel="stylesheet" href="../js/dist/css/amaran.min.css">
    <link rel="stylesheet" href="../js/dist/css/animate.min.css">
   
   <!--  FIN  Mensajes-->

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

     <!-- LIBRERIAS DE AUTOCOMPLETADO -->
<link rel="stylesheet" href="../../../Menus/bootstrap/css/typeahead.css">
<script src="../../../Menus/bootstrap/js/typeahead.js" ></script> 

	 <!-- FIN LIBRERIAS DE AUTOCOMPLETADO -->

<style>
        /* Extra styles to adjust Typeahead */
        .typeahead-container {
            max-width: 415px;

        }
        .typeahead-container22 {
            max-width: 220px;
            
       }
    </style>

  </head>
  
  <body style="padding-top: 20px;" >

 
<!-- MENU -->

<?php

include("../../../BASE_DATOS/Conect.php");
$conexionBD = new Conexion();
$conexionBD->Conectar();
include("../../Modulo_Usuario/modelo/mod_usuario.php");
$persona= new usuarios();
		 $ID_ORGANIZACION = 0;
      $persona->menu($id_perfil , $nombre_perfil , $nombre_organizacion ,$nombre_persona );
   
      if(isset($_SESSION['ID_ORGANIZACION']))
      {
      	    $ID_ORGANIZACION=$_SESSION['ID_ORGANIZACION'];
    		$NOMBRE_EMPRESA=$_SESSION['NOMBRE_EMPRESA'];
      }
 

    if($ID_ORGANIZACION==0){
    	$ACTIVAR="active";
    	

    }else{
    	$ACTIVAR4="active";
    }

    ?> 
 
     


<div align="center">
    <div style="width:60%">


        <table class="table table-bordered">
          <tr class="well">
             <td><h4 align="center">Gesti&oacute;n Departamento</h4></td>
             
            </tr>
          </table>


		         <!-- DIV GENERAL GENERAL -->
		         <div class="tabbable" style="margin-bottom: 18px;">
		              

		              <ul class="nav nav-tabs">
		        <!-- PESTAÑA 1 -->
		        <li class="<?php echo $ACTIVAR ?>"><a href="#tab1" data-toggle="tab"><strong>Gestionar Departamento</strong></a>
		        </li>
		        <!-- PESTAÑA 2 -->
		        <li class="<?php echo $ACTIVAR2 ?>"><a href="#tab2" data-toggle="tab"><strong>Asignar Personas</strong></a>
		        </li>
		        <!-- PESTAÑA 3 -->
		        <li class="<?php echo $ACTIVAR3 ?>"><a href="#tab3" data-toggle="tab"><strong>Personas Asignadas</strong></a>
		        </li>
		        <!-- PESTAÑA 4 -->
		        <!--<li class="<?php echo $ACTIVAR4 ?>"><a href="#tab4" data-toggle="tab"><strong>Asignar Departamento</strong></a>
		        </li>-->
		        <!-- PESTAÑA 5 -->
		        <li class="<?php echo $ACTIVAR5 ?>"><a href="#tab5" data-toggle="tab"><strong>Reportes</strong></a>
		        </li>
		        
		              </ul>

		              <!-- DIV GENERAL DE LOS PANELES -->
		              <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
		              

					             <!-- PANEL 1 Gestionar Especialidad-->
					             <div class="tab-pane <?php echo $ACTIVAR; ?> " id="tab1" >
					              	
					              	<table class="table table-bordered">
							          <tr class="well">
							              <td><center><strong> Gestionar Departamentos</strong></center></td>
							          </tr>
							          <tr>
							            <td>
						                 <center>
						                      <form name="form" action="../controlador/Gestion_Oficina_Controller.php" method="POST">
							                          
						                            <div class="row-fluid">
						                              <div class="span15">
					                                  <input type="hidden" id="id_oficina" name="id" value=""/>
					                                  <input type="hidden" id="id_organizacion_p" name="id_organizacion" value="<?php echo $id_sucursal ?>"/>
					                                  
					                                  <br>
					                                   <strong>Departamento:</strong> &nbsp;<br>
					                                   <div class="typeahead-container">
            										   <span class="typeahead-query"> 
					                                   <input type="text" id="nombre"  name="nombre" class="input-large2" value="" autocomplete="off" placeholder="DEPARTAMENTO" required  onkeyup="this.value=this.value.toUpperCase();" >
					                                   <font color="red" size="4">*</font> 
					                                   </span>
					                                   </div>
					                                   
	
					                                    <strong>Estatus:</strong> &nbsp;<br>
					                                        <select id="estatus" name="estatus" class="form-control" required>
					                                        
					                                            <option value="" >SELECCIONE...</option>
					                                            <option value="ACTIVO">ACTIVO</option>
					                                            <option value="INACTIVO">INACTIVO</option>';

					                                    	</select>
					                                    	<font color="red" size="4">*</font>
					                                    	<br>   

														<br>						                               
						                                <strong>Descripción:</strong> <br>
						                                <textarea id="descripcion" class="large" placeholder="BREVE DESCRIPCÓN DEL DEPARTAMENTO..." name="descripcion" value=""  autocomplete="off" required rows="3" onkeyup="this.value=this.value.toUpperCase()"></textarea>

						                                <br>  

						                                    
						                                </div>


						                                </div>
						                            <br>
						                            <center>
						                            
						                            <center><input type="button" id="Registrar" class="btn btn-primary btn-large" name="Registrar" value="Registrar" >
						                            <input type="button" id="Modificar" class="btn btn-primary btn-large" name="Modificar" value="Modificar" disabled="disabled"/>
						                            <input type="button" id="Cancelar" class="btn btn-primary btn-large" name="Cancelar" value="Cancelar" />
						                            </center>
						                            
						                            </center>

						                        </form>
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
					                    <center><strong> Departamentos Por Oficinas Registrados</strong></center>
					                </td>
					                </tr>
					            </table>
                   
					            <!--TABLA DE LOS REGISTROS-->
					            <div class="table-responsive">
					            <table class="table table-striped table-hover dt-responsive nowrap compact" id="mYTable" width="100%">
					              <?php 
					              /*require_once("../controlador/Gestion_Oficina_Controller.php");
					              $Control=new Gestion_Oficina_Controller();
					              $Control->CargarCatalago_Oficina($id_sucursal);*/
					              ?>
					              <thead>
	                                <tr >
	                                    <td hidden><strong ><center>ID</center></strong></td>
	                                    <td><strong><center>Nombre</center></strong></td>
	                                    
	                                    <td><strong><center>Descripci&oacute;n</center></strong></td>
	                                    <td><strong><center>Estado</center></strong></td>
	                                    <td><strong><center>Opción</center></strong></td>
	                         
	                                 </tr>
	                       		  </thead>
					            </table>
					            </div>
					    </td>
					    </tr>
					  </table>


					             <!-- FIN DEL PANEL 1 -->
					             </div>

					             <!-- //////////////////////////////////////////////////////////// -->


					             <!-- PANEL 2 Asignacion de Especialidad-->
					            <div class="tab-pane " id="tab2">

				            		<table width="100%">

							            <tr>
							            <td>

							            <table class="table table-bordered"  >
					                      <tr class="well">
					                      <td>
					                                  <center><strong> Asignar Personas</strong></center>
					                      </td>
					                      </tr>
							            </table>


					                 <!--TABLA CATALAGO-->
					                 <div class="table-responsive">
					                    <table class="table table-striped table-hover dt-responsive nowrap compact" id="myTable3"  width="100%">
					                      <?php
					                     //$Control->CargarCatalago_Oficina_AsignarPersonas($id_sucursal);
					                      ?>
					                      <thead>
			                                <tr >
			                                    <td hidden><strong ><center>ID</center></strong></td>
			                                    <td><strong><center>Nombre</center></strong></td>
			                                    <td><strong><center>Descripci&oacute;n</center></strong></td>
			                                    <td><strong><center>Estado</center></strong></td>
			                                    <td><strong><center>Opción</center></strong></td>
			                         
			                                 </tr>
			                        	  </thead>
					                    </table>
					                    </div>

									    </td>
									    </tr>
									    </table>
	
						        <!-- FIN DEL PANEL 2 -->
						        </div>







					             <!-- //////////////////////////////////////////////////////////// -->

					             <!-- PANEL 3 ASIGNAR PERSONAS-->
					            <div class="tab-pane <?php echo $ACTIVAR3; ?>" id="tab3">
					            		<table width="100%">

							            <tr>
							            <td>

							            <table class="table table-bordered"  >
					                      <tr class="well">
					                      <td>
					                                  <center><strong>Personas Asignadas</strong></center>
					                      </td>
					                      </tr>
							            </table>


					                 <!--TABLA CATALAGO-->
					                 <div class="table-responsive">
					                    <table class="table table-striped table-hover dt-responsive nowrap compact" id="myTable2"  width="100%">
					                      <?php
					                      //$Control->CargarCatalogo_Personas_OficinasOrganizacion($id_sucursal);
					                      ?>
					                      <thead>
		                                    <tr class="well" >
		                                    <td colspan="4"><strong ><center>Oficina</center></strong></td>
		                                    <td colspan="5"><strong ><center>Personas</center></strong></td>
		                                    </tr>
		                                    <tr >
		                                        <td hidden><strong ><center>ID</center></strong></td>
		                                        <td><strong><center>Nombre Oficina</center></strong></td>
		                                        <td><strong><center>Descripci&oacute;n</center></strong></td>
		                                        <td><strong><center>Estado</center></strong></td>
		                                        <td><strong><center>Cédula</center></strong></td>
		                                        <td><strong><center>Nombre</center></strong></td>
		                                        <td><strong><center>Apellido</center></strong></td>
		                                        <td><strong><center>Perfil</center></strong></td>
		                                        <td><strong><center>Opción</center></strong></td>  
		                                    </tr>
		                            	  </thead>
					                    </table>
					                    </div>

									    </td>
									    </tr>
									    </table>
	
					            	
				            		
						          	
						        <!-- FIN DEL PANEL 3 -->
						        </div>


						         <!-- //////////////////////////////////////////////////////////// -->

					            
				            

						        <!-- //////////////////////////////////////////////////////////// -->

					             <!-- PANEL 5 Reportes-->
					            <div class="tab-pane " id="tab5">

				            		<table class="table table-bordered"  >
				                      <tr class="well">
				                      <td>
				                       <center><strong> Gestionar Reportes</strong></center>
				                      </td>
				                      </tr>
						            </table>

				                    <table rules="rows" frame="vsides"  border="2"  width="70%" cellpadding="10" >

						                    <tr><form action="../controlador/Gestion_Oficina_Controller.php" target="_Black" method="post"><td><br><center><button name="Reporte" type="submit" class="btn btn-primary btn-sm" ><img src="icon/pdf2.png" width="20"> Todas Las Oficinas </button></center><br></td></form></tr>
						                    <tr><form action="../controlador/Gestion_Oficina_Controller.php" target="_Black" method="post"><td><br><center><button name="Reporte_HistorialOficinas" type="submit" class="btn btn-primary btn-sm" ><img src="icon/pdf2.png" width="20">Historial De Oficinas</button></center><br></td></form></tr>
						                    <tr><form action="../controlador/Gestion_Oficina_Controller.php" target="_Black" method="post"><td><br><center><button name="Reporte_PersonasAsignadas" type="submit" class="btn btn-primary btn-sm" ><img src="icon/pdf2.png" width="20">Personas Asignadas A Mis Oficinas </button></center><br></td></form></tr>
						                    <tr><td><br><center><strong>Personas Asignadas Por Fecha</strong><br><br><input type="date" name="fecha_i" id="fecha_i" required> - <input type="date" name="fecha_f" id="fecha_f" required><br><button name="Reporte_PersonasFecha" type="submit" class="btn btn-primary btn-sm" id="Reporte_PersonasOficina_Fecha" ><img src="icon/pdf2.png" width="20">Generar Reporte</button><br></center></td></tr>
		    
				                    </table>
						          	
						        <!-- FIN DEL PANEL 5 -->
						        </div>

				        <!-- FIN DEL DIV DE LAS PANELES GENERALES -->
				        </div>
		        <!-- FIN DEL DIV GENERAL GENERAL -->
		        </div>

    		

    	</div></div>
      





<!-- - TABLA  MODAL PERSONAS -.-  -->

    <div id="tablaPersonas" class="modal fade" >
     <div class="modal-dialog">
        <div class="modal-content"> 

		    <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
		    <h3  align="center">Asignar Persona<br></h3>

		    </div>
		    <div class="modal-body" >
		  
		             
		            <div class="tabbable" style="margin-bottom: 18px;">

		              <ul class="nav nav-tabs">
		                <li class="active"><a href="#tabMod_T_Empresarial active" data-toggle="tab"><strong>Registrar Tutor Empresarial</strong></a></li>
		                
		                    
		              </ul>
			              <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">

			                <!-- PERSONAS------ -->
			                <div class="tab-pane active" id="tabMod_T_Empresarial" align="center">
			                
			         
			              			<form name="form" action="" method="post" onsubmit="return validar_registro_estudiante()" >
		                          
		                            <div class="row-fluid">
		                              <div class="span6">
		                                    <input type="hidden" id="id_oficina_asignarP" name="id_oficina" value="">
		                                    <input type="hidden" id="id_organizacion_asignarP" name="id_organizacion" value=""><br>

		                                    
		                                    <div class="typeahead-container22">
		                                    <div class="typeahead-container">
            							    <span class="typeahead-query"> 
		                                    <strong>Cédula:</strong> &nbsp;<br>
		                                    <input type="text" id="cedula" name="cedula"  placeholder="CÉDULA" value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()">
		                                    <font color="red" size="4">*</font>
							                </span>
							                </div>
							                </div>

		                                    <strong>Nombre:</strong> &nbsp;<br>
		                                    <input type="text" id="nombre_p" name="nombre"  placeholder="NOMBRE" value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()" >
		                                    <font color="red" size="4">*</font>
							                <br> 

		                                    <strong>Apellido:</strong> &nbsp;<br>
		                                    <input type="text" id="apellido_p" name="apellido" placeholder="APELLIDO" value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()">
		                                    <font color="red" size="4">*</font>
							                <br>

		                      				</div>
		                      				<div class="span6">
		                      				<br>

		                                    <strong>Observación:</strong> &nbsp;<br>
		                                    <textarea id="observacion_p" name="observacion" placeholder="ESCRIBA UNA BREVE OBSERVACIÓN..." value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()"></textarea>
		                                    <font color="red" size="4">*</font>
							                <br> 

							                <strong>Perfil:</strong><br>
		                                    <select id="perfil" name="perfil" required>
		                                    <option value="">SELECCIONE...</option>
		                                    <option value="EMPRESARIAL">TUTOR EMPRESARIAL</option>
		                                    <option value="CONTACTO">CONTACTO</option>	
		                                    </select> <br>

		                                    <strong>Oficina:</strong><br>
		                                    <input type="text" id="nombre_oficina_asignarP" name="oficina_p" value="" autocomplete="off" disabled="" > <br>
		                                </div>
			                            </div>
			                            <center> 
			                              
			                            </center>
		                        </form>                          
			                </div>
			                <font color="red" size="2">(*) </font><font color="red" size="1">Campos Obligatorios... </font>	
		              </div>
		            </div>
		    </div>  
		    <div class="modal-footer">
		    <input   type="button" id="Asignar_Personas" name="botRegistrar" value="Asignar" class="btn btn-primary btn-large"> 
		    <button   data-dismiss="modal" id="cerrar" class="btn btn-default" aria-hidden="true"><strong>Cerrar</strong>
		    </button>
		  
		  	</div>
		  	</div>

		    </div>
		    </div>
    <!-- FIN DEL MODAL DE PERSONAS------ --> 








    <!-- ----------------------------------- TABLA2 MODAL DEPARTAMENTOS PARA ASIGNAR-->

    
    <!-- ----------------------------------- FIN TABLA2 MODAL DEPARTAMENTOS-->


<!-- Estilo De Selects Very Good -->

<link rel="stylesheet" href="../../../Menus/bootstrap/bootstrap-select/css/jquery.selectBoxIt.css">
<script src="../../../Menus/bootstrap/bootstrap-select/js/jquery-ui-1.8.23.custom.min.js" defer=""></script> 
<script src="../../../Menus/bootstrap/bootstrap-select/js/jquery.selectBoxIt.min.js" defer=""></script>

  <!-- Estilo De Selects Very Good -->


    <!--   Mensajes-->
 <script src="../js/dist/js/jquery.amaran.min.js"></script>
 <script src="../js/dist/js/jquery.amaran.js"></script>
   <!--  FIN  Mensajes-->




<script src="../js/letrasNunmers.js"></script>
<script type="text/javascript" src="../js/oficina.js"></script>
  

  




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
      $('#mYTable').dataTable();
            $('#myTable2').dataTable();
            $('#myTable3').dataTable();
    });
  </script>

  
</body></html>
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
