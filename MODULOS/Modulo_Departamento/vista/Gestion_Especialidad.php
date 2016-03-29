<?php
session_start();

$id_perfil=$_SESSION['id_perfil'];
$nombre_perfil=$_SESSION['nombre_perfil'];
$ID_INSTITUCION=$_SESSION['ID_INSTITUCION'];
$nombre_persona = $_SESSION['persona'];
$nombre_organizacion =  $_SESSION['nombre_instituto'];

?>


<!DOCTYPE html>
<!-- saved from url=(0066)http://vadikom.github.io/smartmenus/src/demo/bootstrap-navbar.html -->
<html lang="en" ><head ><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Especialidad</title>

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
     <link rel="stylesheet" href="../../../Menus/bootstrap/css/typeahead.css">

  <!-- Bootstrap JS -->
<script src="../../../Menus/bootstrap/js/jquery-1.11.3.min.js" ></script>
 
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/bootstrap.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/highlight.min.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/bootstrap-submenu.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/docs.js" defer=""></script>

   <script src="../../../Menus/bootstrap/js/typeahead.js" ></script>


  <!-- MESNAJES CALIDA OPERACIONES -->
    <link rel="stylesheet" href="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.css">
    <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.js"></script>
    <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.min.js"></script>
   <!-- MESNAJES CALIDA OPERACIONES-->

<style>
        /* Extra styles to adjust Typeahead */
        .typeahead-container {
            max-width: 415px;

        }
        .typeahead-container22 {
            max-width: 220px;
            
        }
        .typeahead-container3 {
            max-width: 220px;
            
        }
        .typeahead-container4 {
            max-width: 220px;
            
        }
        .typeahead-container5 {
            max-width: 220px;
            
        }
        .typeahead-container6 {
            max-width: 220px;
            
        }
    </style>

  </head>
  
  <body style="padding-top: 20px;" id="page"  >

 
<!-- MENU -->

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
    <div style="width:70%">


        <table class="table table-bordered">
          <tr class="well">
             <td><h4 align="center">Gesti&oacute;n Especialidad</h4></td>
             
            </tr>
          </table>


		         <!-- DIV GENERAL GENERAL -->
		         <div class="tabbable" style="margin-bottom: 18px;">
		              

		              <ul class="nav nav-tabs">
		        <!-- PESTAÑA 1 -->
		        <li class="active"><a href="#tab1" data-toggle="tab"><strong>Gestionar Especialidad</strong></a>
		        </li>
		        <!-- PESTAÑA 2 -->
		        <li class=""><a href="#tab2" data-toggle="tab"><strong>Asignar Personas</strong></a>
		        </li>
		        <!-- PESTAÑA 3 -->
		        <li class=""><a href="#tab3" data-toggle="tab"><strong>Personas Asignadas</strong></a>
		        </li>
		        <!-- PESTAÑA 4 -->
		        <li class=">"><a href="#tab4" data-toggle="tab"><strong>Reportes</strong></a>
		        </li>
		        
		              </ul>

		              <!-- DIV GENERAL DE LOS PANELES -->
		              <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
		              
 
					             <!-- PANEL 1 Gestionar Especialidad-->
					             <div class="tab-pane active " id="tab1" >
					              	
					              	<table class="table table-bordered">
						              
						              <tr class="well">
						              <td>
						              	<center><strong> Gestionar Especialidades</strong></center>
						              </td>
						              </tr>
						              <tr>
						              <td>
				                     <form name="form" action="" method="post" >
				                          
				                        <div class="row-fluid" align="center">
				                            <div class="span15">

				                               <!-- CAMPO INVISIBLE PARA LLEVARME EL ID  --> 
				                                <input type="hidden" id="id_instituto" name="id_instituto" value="<?php echo $ID_INSTITUCION ?>"/>                               
				                                <input type="hidden" id="id_especialidad" name="id" value=""/>
				                                <br>  
				                                <strong>Nombre Especialidad:</strong> &nbsp;<br>
				                            <div class="typeahead-container">
            								<span class="typeahead-query"> 
				                                <div><input type="text" id="nombre"  class="input-large2" placeholder="ESPECIALIDAD"  value="" autocomplete="off" onkeyup="this.value=this.value.toUpperCase();" required> 
				                             <font color="red" size="4">*</font></div>
				                             </span>
				                             </div>
				                    
												
												<strong>Tipo Especialidad:</strong> &nbsp;<br>
				                                <select id="tipo_e" name="tipo_especialidad" class="form-control" required>
				                                <option value="">SELECCIONE...</option>

						                               <?php

						                               	 require_once('../controlador/Gestion_Especialidad_Controller.php');

						                               	 $Control=new Gestion_Especialidad_Controller();
						                               	 $Control->CargarSelect_TipoEspeciualidad();
						                               ?>
				     
				                                    </select>
				                                    <font color="red" size="4">*</font> 
				                                 
					                                <br>    
				                                <br> 
				                                <strong>Estatus:</strong> &nbsp;<br>
				                                    <select id="estatus" name="estatus" class="form-control" required>
				                                      
				                                      <option value="" >SELECCIONE...</option>
				                                      <option value="ACTIVO" >ACTIVO</option>
				                                      <option value="INACTIVO">INACTIVO</option>

				                                    </select>
				                                    <font color="red" size="4">*</font>     
				                                
					                                <br> 
				                                    
				                                    <br>
				                                <strong>Descripci&oacute;n :</strong><br>
				                                
				                                	<textarea id="descripcion" name="descripcion" class="large" placeholder="BREVE DESCRIPCIÓN DE LA ESPECIALIDAD..." value="" autocomplete="off" required id="search" rows="3" onkeyup="this.value=this.value.toUpperCase()"></textarea>
				                                	<font color="white" size="4">*</font></div>
				                                	<br>  
				                                   
				                                </div>

				                            	</div>
				                            	<br>
				                            
				                            
					                           	<center><input type="button" id="Registrar" class="btn btn-primary btn-large" name="Registrar" value="Registrar" >
					                            <input type="button"  id="Modificar" class="btn btn-primary btn-large" name="Modificar" value="Modificar" disabled="disabled"/>
					                            <input type="button" id="Cancelar" class="btn btn-primary btn-large" name="Cancelar" value="Cancelar" />
					                            </center>
					                       	</form>
					                       <font color="red" size="2">(*) </font><font color="red" size="1">Campos Obligatorios... </font>
					                      </td>
					                     </tr>
					                    </table>

					                       
                    				
			                    		<table  width="100%">

							            <tr>
							            <td>

							            <table class="table table-bordered"  >
					                      <tr class="well">
					                      <td>
					                                  <center><strong> Especialidades  Registradas</strong></center>
					                      </td>
					                      </tr>
							            </table>


					                 <!--TABLA CATALAGO-->
					                 <div class="table-responsive">
					                    <table class="table table-striped table-hover dt-responsive nowrap compact" id="Table"  >
					                      <?php
					                      //$Control->CargarCatalago_Especialidad($ID_INSTITUCION);
					                      ?>
					                      <thead>
			                                <tr>
			                                    <td hidden><strong ><center>ID</center></strong></td>
			                                    <td><strong><center>Nombre</center></strong></td>
			                                    <td><strong><center>Tipo</center></strong></td>
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
					                    <table class="table table-striped table-hover dt-responsive nowrap compact" id="myTable"  width="100%">
					                      <?php
					                      //$Control->CargarCatalago_Especialidad_AsignarPersonas($ID_INSTITUCION);
					                      ?>
					                      <thead>
			                                <tr >
			                                
			                                    <td hidden><strong ><center>ID</center></strong></td>
			                                    <td><strong><center>Nombre</center></strong></td>
			                                    <td><strong><center>Tipo</center></strong></td>
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



						        <!-- PANEL 3 Asignacion de Especialidad-->
					            <div class="tab-pane " id="tab3">

				            			

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
					                      //$Control->CargarCatalago_PersonasEspecialidad_Instituto();
					                      ?>

					                      <thead>
			                                <tr class="well" >
			                                <td colspan="5"><strong ><center>Especialidad</center></strong></td>
			                                <td colspan="6"><strong ><center>Personas</center></strong></td>
			                                </tr>
			                                <tr >
			                                    <td hidden><strong ><center>ID</center></strong></td>
			                                    <td><strong><center>Nombre Especialidad</center></strong></td>
			                                    <td><strong><center>Tipo</center></strong></td>
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

									 
	
						        <!-- FIN DEL PANEL 3 -->
						        </div>







					             <!-- //////////////////////////////////////////////////////////// -->

					             <!-- PANEL 4 Reportes-->
					            <div class="tab-pane " id="tab4">

				            		<table class="table table-bordered"  >
				                      <tr class="well">
				                      <td>
				                       <center><strong> Gestionar Reportes</strong></center>
				                      </td>
				                      </tr>
						            </table>


				                    <table rules="rows" frame="vsides"  border="2"  width="70%" cellpadding="10" >

						                    <tr><form action="../controlador/Gestion_Especialidad_Controller.php" target="_Black" method="post"><td><br><center><button name="Reporte" type="submit" class="btn btn-primary btn-sm" ><img src="icon/pdf2.png" width="20">Todas Las Especialidades</button></center><br></td></form></tr>
						                     
						                    <tr><form action="../controlador/Gestion_Especialidad_Controller.php" target="_Black" method="post"><td><br><center><strong>Tipo de Especialidad</strong></center><br> 
						                    			<center><select id="tipo_e" name="tipo_especialidad"  required>
						                                	<option value="">SELECCIONE...</option>
								                               <?php
								                               	 $Control->CargarSelect_TipoEspeciualidad();
								                               ?>
						                      			</select><br><br><button name="Reporte_Tipo" type="submit" class="btn btn-primary btn-sm" ><img src="icon/pdf2.png" width="20">Generar Reporte</button></center><br></td></form></tr>
						                     
						                    <tr><form action="../controlador/Gestion_Especialidad_Controller.php" target="_Black" method="post"><td><br><center><button name="Reporte_HistorialEspecialidad" type="submit" class="btn btn-primary btn-sm" ><img src="icon/pdf2.png" width="20">Historial De Especialidades</button></center><br></td></form></tr>
						                    <tr><form action="../controlador/Gestion_Especialidad_Controller.php" target="_Black" method="post"><td><br><center><button name="Reporte_PersonasAsignadas" type="submit" class="btn btn-primary btn-sm" ><img src="icon/pdf2.png" width="20">Personas Asignadas A Especialidades</button></center><br></td></form></tr>
						                    <tr><td><br><center><strong>Personas Asignadas Por Fecha</strong><br><br><input type="date" name="fecha_i" id="fecha_i" required> - <input type="date" name="fecha_f" id="fecha_f" required><br><button name="Reporte_PersonasFecha" type="submit" class="btn btn-primary btn-sm" id="Reporte_PersonasEspecialidad_Fecha" ><img src="icon/pdf2.png" width="20">Generar Reporte</button><br></center></td></tr>
						                      
				                    </table>
						          	
						        <!-- FIN DEL PANEL 4 -->
						        </div>

				        <!-- FIN DEL DIV DE LAS PANELES GENERALES -->
				        </div>
		        <!-- FIN DEL DIV GENERAL GENERAL -->
		        </div>

    		

    	</div></div>
      









<!-- - TABLA  MODAL PERSONAS -.-  -->

    <div id="tabla" class="modal fade" >  
    	<div class="modal-dialog">
        	<div class="modal-content">
			    <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
			    <h3  align="center">Elije una Persona<br></h3>

			    </div>
			    <div class="modal-body" >
			  
			             
			            <div class="tabbable" style="margin-bottom: 18px;">

			              <ul class="nav nav-tabs">
			                <li class="active" id="estudiantesss"><a href="#tabMod2" data-toggle="tab"><strong>Registrar Estudiante</strong></a></li>
			                    
			                <li class="" id="tutorrr"><a href="#tabMod3" data-toggle="tab"><strong>Registrar Tutor Académico</strong></a></li>
			                    
			              </ul>
				              <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">

				              
				                <!-- ESTUDINATES------ -->
				                <div class="tab-pane active" id="tabMod2" align="center">
				                
				              			

				              			<form id="form_asignarEstudiante" name="form"  action="" method="post" >
			                          
			                            <div class="row-fluid">
			                              <div class="span6">
			                                    <input type="hidden" id="id_especialidad_asignar" name="id_persona" value="">
			                                    <input type="hidden" id="id_instituto_asignar" name="id_usuario" value=""><br>

			                                    <div class="typeahead-container3">
			                                    <div class="typeahead-container">
            									<span class="typeahead-query">
								                <strong>Expediante:</strong> &nbsp;<br>
			                                    <input type="text" id="expediente" name="espediante" placeholder="EXPEDIENTE" value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()" >
			                                    <font color="red" size="4">*</font>
			                                    </span>
			                                    </div>
			                                    </div>  
								                

								                <strong>Cédula:</strong> &nbsp;<br>
			                                    <div class="typeahead-container22">
			                                    <div class="typeahead-container">
            									<span class="typeahead-query"> 
			                                    <input type="text" id="cedula" name="cedula" placeholder="CÉDULA" value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()" >
			                                    <font color="red" size="4">*</font>
			                                    </span>
			                                    </div>
			                                    </div> 
								              

			                                    <strong>Nombre:</strong> &nbsp;<br>
			                                    <input type="text" id="nombre_e" name="nombreE" placeholder="NOMBRE" value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()">
			                                    <font color="red" size="4">*</font> 
								                <br>

			                                    <strong>Apellido:</strong> &nbsp;<br>
			                                    <input type="text" id="apellido_e" name="apellidoE" placeholder="APELLIDO" value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()">
			                                    <font color="red" size="4">*</font> 
								                <br>
			                      				</div>
			                      				<div class="span6">
			                      				<br>

			                                    <strong>Observación:</strong> &nbsp;<br>
			                                    <textarea id="observacion" name="observacion" placeholder="ESCRIBA UNA BREVE DESCRIPCIÓN..." value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()"></textarea>
			                                    <font color="red" size="4">*</font> 
								                <br>

								                <strong>Fecha Registro</strong>
			                                   	<input type="date" name="fecha" id="fecha_r" value="<?php echo date("Y-m-d"); ?>" required>
			                                    <font color="red" size="4">*</font> 
								                <br> 

			                                    <strong>Especialidad:</strong><br>
			                                    <input type="text" id="nombre_especialidad" name="especialidad" value="" autocomplete="off" disabled="" > <br>
			                                </div>
			                              
			                                
			                            </div>
			                            <center> 
			                             
			                               
			                           </center>
			                        </form>
				                </div>
				                

				                <!--PERSONAS------ -->
				                <div class="tab-pane" id="tabMod3" align="center">
				                
				              			

				              			<form name="form" action="" method="post" >
			                          
			                            <div class="row-fluid">
			                              <div class="span6">
			                                    <input type="hidden" id="id_especialidad_asignar2" name="id_persona" value="">
			                                    <input type="hidden" id="id_instituto_asignar2" name="id_usuario" value=""><br>

			                                    <strong>Código:</strong> &nbsp;<br>
			                                     <div class="typeahead-container4">
			                                    <div class="typeahead-container">
            									<span class="typeahead-query">
			                                    <input type="text" id="codigo" name="espediante" placeholder="CÓDIGO" value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()" >
			                                    <font color="red" size="4">*</font> 
								                </span>
								                </div>
								                </div>

			                                    <strong>Cédula:</strong> &nbsp;<br>
			                                     <div class="typeahead-container5">
			                                    <div class="typeahead-container">
            									<span class="typeahead-query">
			                                    <input type="text" id="cedula_TA" name="cedulaE" placeholder="CÉDULA" value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()" >
			                                    <font color="red" size="4">*</font> 
								                </span>
								                </div>
								                </div>

			                                    <strong>Nombre:</strong> &nbsp;<br>
			                                    <input type="text" id="nombre_TA" name="nombreE" placeholder="NOMBRE" value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()">
			                                    <font color="red" size="4">*</font> 
								                <br>

			                                    <strong>Apellido:</strong> &nbsp;<br>
			                                    <input type="text" id="apellido_TA" name="apellidoE" placeholder="APELLIDO" value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()">
			                                    <font color="red" size="4">*</font> 
								                <br>
			                      				</div>
			                      				<div class="span6">
			                      				<br>

			                                    <strong>Observación:</strong> &nbsp;<br>
			                                    <textarea id="observacion_TA" name="observacion" placeholder="ESCRIBA UNA BREVE DESCRIPCIÓN..." value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()"></textarea>
			                                    <font color="red" size="4">*</font> 
								                <br>

								                <strong>Fecha Registro</strong>
			                                   	<input type="date" name="fecha_TA" id="fecha_TA" value="<?php echo date("Y-m-d"); ?>" required>
			                                    <font color="red" size="4">*</font> 
								                <br>

			                                    <strong>Especialidad:</strong><br>
			                                    <input type="text" id="nombre_especialidad2" name="especialidad" value="" autocomplete="off" disabled="" > <br>
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
			    <input   type="button" id="Asignar_Estudiante" name="botRegistrar" value="Asignar" class="btn btn-primary btn-large">
			    <input   type="button" id="Asignar_TutorAcademico" name="botRegistrar2 " value="Asignar"  class="btn btn-primary btn-large">
			    <button  data-dismiss="modal" id="cerrar" class="btn btn-default" aria-hidden="true"><strong>Cerrar</strong>
			    </button>
			  
			    </div>
			    </div>
			 </div>
		</div>
    <!-- FIN DEL MODAL DE PERSONAS------ --> 






<div id="ModalTemporadasCusro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

      <div class="modal-dialog">
        <div class="modal-content">

	    <div class="modal-header">
	   		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	    <h4 class="modal-title" align="center">Modificar Especialidades En Temporadas En Curso </h4>
	    </div>

	    	<div class="modal-body" >
			  
			                        
						            <div class="alert alert-info alert-dismissible" role="alert" id="alertdescente">
							              <a class="close" data-dismiss="alert">×</a>
							                               
							        </div>


		                 			<!--TABLA CATALAGO-->
		                 			<div class="table-responsive">
				                    <table class="table table-striped table-hover dt-responsive nowrap compact" id="Temporadas" style="width: 100%">
				                      
				                       <thead>
			                                <tr class="well" >
			                                
			                                    <td >  <center><strong> <input name="select_all" value="1" type="checkbox"> </strong></center> </td>
			                                    <td hidden><strong><center>id</center></strong></td>
			                                    <td><strong><center>Tipo Solicitud</center></strong></td>
			                                    <td><strong><center>Periodo</center></strong></td>
			                                     
			                                </tr>
		                        		</thead>
		                        
				                      
				                    </table>
				                    </div>

					    		
			                
				   </div>           

			    <div class="modal-footer">			    
			    <input   type="button" id="ModificarTemporada" name="botRegistrar2 " value="Modificar"  class="btn btn-primary btn-large" disabled="disabled">
			    <button  class="btn btn-default" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong>
			    </button>
			  	</div>  
			    </div>
			    </div>
			 </div>
	

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
   <script type="text/javascript" src="../js/especialidad.js"></script>




    <script>
    $(document).ready(function(){
      $('#Table').dataTable();
      $('#myTable').dataTable();
            $('#myTable2').dataTable();
            $('#Temporadas').dataTable();
            
    });
  </script>
   

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
    <!-- AUTOCOMPLETE-->

    <!-- FIN AUTOCOMPLETE-->
  
</body></html>
