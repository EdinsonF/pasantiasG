<?php
session_start();


$id_perfil=$_SESSION['id_perfil'];
$nombre_perfil=$_SESSION['nombre_perfil'];
$ID_ORGANIZACION=$_SESSION['codigo_sucursal'];
$nombre_persona = $_SESSION['persona'];
$nombre_organizacion =  $_SESSION['nombre_organizacion'];

?>
<!DOCTYPE html>
<!-- saved from url=(0066)http://vadikom.github.io/smartmenus/src/demo/bootstrap-navbar.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pasantias</title>


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



   <link rel="stylesheet" href="../../../Menus/bootstrap/css/typeahead.css">
	<script src="../../../Menus/bootstrap/js/typeahead.js" ></script>

	<style>
        /* Extra styles to adjust Typeahead */
        .typeahead-container {
            max-width: 400px;

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


      $persona->menu($id_perfil , $nombre_perfil , $nombre_organizacion ,$nombre_persona );

   
?>
<!-- Fin De MENU-->



<div align="center" >
    
    <div style="width:60%">

            <table class="table table-bordered">
            <tr class="well">
            <td><h4 align="center">Gestión Departamentos</h4></td>
            </tr>
            </table>



            <!-- DIV GENERAL GENERAL -->
             <div class="tabbable" style="margin-bottom: 18px;">
                  

                  <ul class="nav nav-tabs">
            <!-- PESTAÑA 1 -->
            <li class="active"><a href="#tab1" data-toggle="tab"><strong>Asignar Departamento</strong></a>
            </li>
            <!-- PESTAÑA 2 -->
            <li class=""><a href="#tab2" data-toggle="tab"><strong>Asignar Personas</strong></a>
            </li>
            <!-- PESTAÑA 3 -->
            <li class=""><a href="#tab3" data-toggle="tab"><strong>Personas Asignadas</strong></a>
            </li>
            <!-- PESTAÑA 4 -->
            <li class=""><a href="#tab4" data-toggle="tab"><strong>Reportes</strong></a>
            </li>
          
            
                  </ul>

                  <!-- DIV GENERAL DE LOS PANELES -->
                  <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
                  

                       <!-- PANEL 1 Gestionar Especialidad-->
                       <div class="tab-pane active " id="tab1" >
                          
                              <table class="table table-bordered">
                                <tr class="well"><td ><strong><center>Asignar Departamento</center></strong></td></tr>
                                  <tr>
                                    <td>
                                      <center>
                                                    
                                      <div class="row-fluid">
                                      <div class="span4">
                                      <strong>Asignar Oficina:</strong>
                                                        
                                      <a href="#tabla" role="button" class="btn btn-primary" data-toggle="modal"><strong>+</strong></a><br><br>
                                      
                                      </div>
                                      <div class="span12">

                                      <input type="hidden"  id="id_organizacion" name="ID_ORGANIZACION" value="<?php echo $ID_ORGANIZACION ?>">
                                      <input type="hidden" id="id_oficina" name="id_oficina" value="" >
                                      
                                      <strong>Nombre Oficina:</strong><br>
                                      <input type="text" id="nombre"  value="" placeholder="NOMBRE" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()">

                                      <br>
                                      <strong>Estatus:</strong><br>
                                          <select id="estado" name="estado" required>
                                            <option value="">SELECCIONE...</option>
                                            <option value="ACTIVO">ACTIVO</option>
                                            <option value="INACTIVO">INACTIVO</option>

                                          </select>

                                           <br>
                                          <strong>Descripción Oficina:</strong><br>
                                          <textarea id="descripcion" name="descripcion" value="" placeholder="DESCRIPCIÓN" autocomplete="off" required></textarea><br>  
                                          <br><br>           
                                          <input type="button" id="Modificar" value="Modificar"  class="btn btn-primary btn-large" disabled="true" > 
                                          <input type="button" id="Cancelar" class="btn btn-primary btn-large" name="Cancelar" value="Cancelar" disabled="true"/>         
                                          
                                        </div>
                                      </center>
                                    </td>
                                  </tr>
                              </table>
                                  
                             
                                     
                              

                                            <!-- DEPARTAMENTOS ASIGNADOS------CATALAGOOO -->
                                              <div align="center">
                                              <table width="100%">
                                                <tr>
                                                <td>
                                                  
                                              <table class="table table-bordered"  >
                                                  <tr class="well">
                                                  <td>
                                                              <center><strong> Departamentos Asignados a:</strong></center>
                                                  </td>
                                                  </tr>
                                              </table>
                                                    
                                                  <!--TABLA DE LOS REGISTROS ASIGNADOS-->
                                                  <table class="display dataTable" id="myTable" width="100%" >
                                           
                                                  <thead>
                                                      <tr class="well">
                                                        <td hidden><strong ><center>ID</center></strong></td>
                                                        <td><strong><center>Nombre Oficina</center></strong></td>
                                                        
                                                        <td><strong><center>Descripci&oacute;n</center></strong></td>
                                                        <td><strong><center>Estado</center></strong></td>
                                                        <td><strong><center>Opción</center></strong></td>                                     
                                                      </tr>
                                                  </thead>
                                                </table>
                                                </td>
                                                </tr>
                                              </table>
                                              </div>
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
                              <table class="display dataTable" id="myTable3"  width="100%">
                                
                                <thead>
                                  <tr class="well">
                                    <td hidden><strong ><center>ID</center></strong></td>
                                    <td><strong><center>Nombre Oficina</center></strong></td>
                                    
                                    <td><strong><center>Descripci&oacute;n</center></strong></td>
                                    <td><strong><center>Estado</center></strong></td>
                                    <td><strong><center>Opción</center></strong></td>                                     
                                  </tr>
                                </thead>
                              </table>

                      </td>
                      </tr>
                      </table>
  
                    <!-- FIN DEL PANEL 2 -->
                    </div>







                       <!-- //////////////////////////////////////////////////////////// -->

                       <!-- PANEL 3 ASIGNAR PERSONAS-->
                      <div class="tab-pane " id="tab3">
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
                              <table class="display dataTable" id="myTable4"  width="100%">
                                <thead>
                                    <tr class="well" >
                                    <td colspan="4"><strong ><center>Oficina</center></strong></td>
                                    <td colspan="5"><strong ><center>Personas</center></strong></td>
                                    </tr>
                                    <tr>
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
                            <tbody >
                              </table>

                      </td>
                      </tr>
                      </table>
  
                        
                        
                        
                    <!-- FIN DEL PANEL 3 -->
                    </div>




                    <!-- PANEL 4 ASIGNAR PERSONAS-->
                      <div class="tab-pane " id="tab4">
                         
                          <table class="table table-bordered"  >
                                <tr class="well">
                                <td>
                                            <center><strong>Gestionar Reportes</strong></center>
                                </td>
                                </tr>
                          </table>


                          <table rules="rows" frame="vsides"  border="2"  width="70%" cellpadding="10" >

                                <tr><form action="../controlador/ActionPerformed.php" target="_Black" method="post"><td >&nbsp; &nbsp;<strong>Mis Oficinas:</strong></td><td><center><button name="Reporte_Mis" type="submit" class="btn btn-primary btn-large" ><img src="icon/pdf2.png" width="20"> </button></center></td></form></tr>
                                <tr><form action="../controlador/ActionPerformed.php" target="_Black" method="post"><td >&nbsp; &nbsp;<strong>Personas Asignadas A Mis Oficinas:</strong></td><td><center><button name="Reporte_PersonasAsignadas" type="submit" class="btn btn-primary btn-large" ><img src="icon/pdf2.png" width="20"> </button></center></td></form></tr>
        
                            </table>
                        

                   
  
                        
                        
                        
                    <!-- FIN DEL PANEL 4 -->
                    </div>


                <!-- FIN DEL DIV DE LAS PANELES GENERALES -->
                </div>
            <!-- FIN DEL DIV GENERAL GENERAL -->
            </div>


            </div>
            </div>







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

                                          

                                          <strong>Cédula:</strong> &nbsp;<br>
                                          
            							  <div class="typeahead-container22">
		                                  <div class="typeahead-container">
        								  <span class="typeahead-query"> 
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
                                          <strong>Fecha de Asignación:</strong> &nbsp;<br>
                                          <input type="Date" id="fecha" name="fecha"  value="<?php echo date("Y-m-d");?>" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()">
                                          <font color="red" size="4">*</font>
                                <br> 

                                          <strong>Observación:</strong> &nbsp;<br>
                                          <textarea id="observacion_p" name="observacion" placeholder="ESCRIBA UNA BREVE OBSERVACIÓN..." value="" autocomplete="off" required onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                          <font color="red" size="4">*</font>
                                <br> 

                                <strong>Rerfil:</strong><br>
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
          <button  id="cerrar" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong>
          </button>
        
          </div>
          </div>
       </div>
     </div>     
    <!-- FIN DEL MODAL DE PERSONAS------ --> 










              

<!-- ----------------------------------- TABLA MODAL DEPARTAMENTOS-->

    <div id="tabla" class="modal fade" > 
      <div class="modal-dialog">
        <div class="modal-content">  
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3  align="center">Elije un Departamento<br></h3>

          </div>
          <div class="modal-body" align="center">
          <table width="100%">
          <tr>
          	<td>
            	<br>
                  <!--TABLA DE LOS REGISTROS A ASIGNAR-->
                  <table class="display dataTable" id="myTable2" width="100%">
                    
                      <thead>
                          <tr class="well">
                            <td hidden><strong ><center>ID</center></strong></td>
                            <td><strong><center>Nómbre</center></strong></td>
                            <td><strong><center>Descripci&oacute;n</center></strong></td>
                            <td><strong><center>Opción</center></strong></td>   
                          </tr>
                      </thead>
                  </table>
          	</td>
          </tr>
          </table>

          </div>  
          <div class="modal-footer">
          <a href="#tabla2"  data-toggle="modal"  class="btn" data-dismiss="modal" aria-hidden="true"><input type="button" class="btn btn-primary btn-large" name="Registrar" value="Registrar Nuevo" ></a>
          <button  id="cerrar" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong>
          </button>
        
          </div>
          </div>
       </div>
    </div>









<!--   ------------------------------------ MODAL DE REGISTRAR NUEVO DEPARTAMENTO -->
    <div id="tabla2" class="modal fade" >
      <div class="modal-dialog">
        <div class="modal-content">   
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3  align="center">Registrar Nuevo Departamento<br></h3>

          </div>
          <div class="modal-body" align="center">
          <table width="100%">
          		<tr>
          				<td>

                            <center>
                                                          
                            <div class="row-fluid">
                            <div class="span12">
                                       
                                 <strong>Nombre oficina:</strong><br>
                                 <div class="typeahead-container">
            					<span class="typeahead-query"> 
                                 <input type="text" id="nombre_o" class="input-large2" name="nombre_o" placeholder="NOMBRE"  value="" autocomplete="off" required  onkeyup="this.value=this.value.toUpperCase();" ><br>  
                                 </span>
                                 </div>

	                                 <strong>Estatus:</strong><br>
	                                 <select id="estatus_o" name="estatus" required>
	                                      
	                                     <option value="" >SELECCIONE...</option>
	                                      <option value="ACTIVO" selected="selected">ACTIVO</option>
	                                  </select><br>   
	                                           
	   
	                                  <strong>Descripción Oficina:</strong><br>
	                                  <textarea id="descripcion_o" name="descripcion" class="large" placeholder="BREVE DESCRIPCIÓN DE LA OFICINA..." value="" autocomplete="off" onkeyup="this.value=this.value.toUpperCase()" required></textarea><br>  
	                                          
                             </div>

                             </div>

                 
          			</td>
          		</tr>
          </table>

          </div>  
          <div class="modal-footer">
          <input type="button" id="Registrar" class="btn btn-primary btn-large" name="Registrar" value="Registrar" >
          <button  id="cerrar" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong>
          </button>
        
          </div>
          </div>
       </div>
      </div>



  


 <!--   Mensajes-->
 <script src="../js/dist/js/jquery.amaran.min.js"></script>
 <script src="../js/dist/js/jquery.amaran.js"></script>
   <!--  FIN  Mensajes-->

<script src="../../Modulo_tipoOrganizacion/js/letrasNunmers.js"></script>
<script type="text/javascript" src="../js/oficina.js"></script>



 <!--PAGINADOR - T A B L A S-->
    
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.js"></script>
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.min.js"></script>

    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables_themeroller.css" rel="stylesheet">

 <!--PAGINADOR - T A B L A S-->
    

    <script>
    $(document).ready(function(){
      $('#myTable').dataTable();
            $('#myTable2').dataTable();
            $('#myTable3').dataTable();
             $('#myTable4').dataTable();
    });
  </script>
  
  



</body></html>
