<<<<<<< HEAD
<?php
session_start();


if(isset($_SESSION['id_perfil'])){
$id_perfil=$_SESSION['id_perfil'];
$nombre_perfil=$_SESSION['nombre_perfil'];

$id_persona=$_SESSION['id_persona'];
$nombre_persona = $_SESSION['persona'];
$ID_INSTITUCION=$_SESSION['id_organizacion'];
$codigo_sucursal=$_SESSION['codigo_sucursal'];
}else{ 
$id_perfil=1;
$nombre_perfil="Menu Principal";
}

 ?>
<!DOCTYPE html>
<!-- saved from url=(0066)http://vadikom.github.io/smartmenus/src/demo/bootstrap-navbar.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pasantias</title>

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
  <script src="../../../Menus/bootstrap/js/jquery-1.10.2.min.js"></script>
  
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/bootstrap.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/highlight.min.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/bootstrap-submenu.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/docs.js" defer=""></script>
  </head>
  
  <body style="padding-top: 20px;" id="page"  >

 
<!-- MENU -->

<?php

include("../../../BASE_DATOS/Conect.php");
$conexionBD = new Conexion();
$conexionBD->Conectar();
include("../../Modulo_Usuario/modelo/mod_usuario.php");
$persona= new usuarios();

 
     if($id_perfil==6){echo '<input type="hidden" id=id_ip value='.$_SESSION['ID_INSTITUCION'].' >';
                       echo '<label hidden id=codigo_encargado>'.$_SESSION['codigo_encargado'].'</label >';
                     $nombre_organizacion =  $_SESSION['nombre_instituto'];  
       }else{$nombre_organizacion =  $_SESSION['nombre_organizacion'];}
      $persona->menu($id_perfil , $nombre_perfil , $nombre_organizacion ,$nombre_persona );

   
?>

<!-- Fin De MENU-->

   
    
 
     


<div align="center">
    <div style="width:70%">


        <table class="table table-bordered">
          <tr class="well">
             <td><h4 align="center">Gesti&oacute;n Solicitud</h4></td>
             
            </tr>
          </table>


		         <!-- DIV GENERAL GENERAL -->
		         <div class="tabbable" style="margin-bottom: 18px;">
	         
					             <div >
					              	
					              	<table class="table table-bordered">
						              
						             
						              <tr>
						              <td>
				                     <form name="form" action="" method="post" >
				                          
				                        <div class="row-fluid" align="center">
				                            <div class="span6">

	                                    <?php if($id_perfil==6){echo'<label>Mis Organizaciones Asociadas</label>&nbsp;&nbsp;&nbsp;<input type="button" id="mostar_modal" class="btn btn-primary btn-large" name="mostar_modal" value="+">';
	                                          echo' <input type="hidden" id="id_instituto" name="id_instituto" value=""/>';
				                              echo'  <input type="hidden" id="id_persona" name="id_persona" value=""> ';
				                              echo'  <input type="hidden" id="codigo_sucursal" name="codigo_sucursal" value=""> ';

	                                    }else{  
				                              echo' <!-- CAMPO INVISIBLE PARA LLEVARME EL ID  -->  ';
				                             echo' <input type="hidden" id="id_instituto" name="id_instituto" value="'.$ID_INSTITUCION.'"/>';
				                             echo'  <input type="hidden" id="id_persona" name="id_persona" value="'.$id_persona.'" >';
				                             echo'   <input type="hidden" id="codigo_sucursal" name="codigo_sucursal" value="'.$codigo_sucursal.'" >';   
				                             echo'   <input type="hidden" id="id_solicitud" name="id_solicitud" value=""/> ';                         
				                                   }?>  
				                                   <br>   <br>                  
				                        <label>Seleccionar El Tipo De Solicitud</label>&nbsp;&nbsp;<input type="button" class="btn btn-primary" id="modal_ts" name="modal_ts" value="+">
				                            	
				                                 <br>
				                                <strong>Tipo Solicitud:</strong> &nbsp;<br>
				                                <input type="hidden" id="tipo_solicitud" name="tipo_solicitud" value="">   
				                                 <input type="text" id="nombre_solicitud" name="nombre_solicitud" value="" disabled="">                              
				                                <font color="red" size="4">*</font>  
					                            <br>

												
				                                <strong>Especialidad:</strong> &nbsp;<br>
				                                <input  type="hidden" id="especialidad" name="especialidad" value=""  disabled="">
				                                <input type="text" id="nombre_especialidad" name="nombre_especialidad" value="" disabled="">                               
				                                <font color="red" size="4">*</font>
					                            
				                               
				                                </div>


				                                <div class="span6">
				                            	<br>
				                            	 <strong>Cantidad:</strong> &nbsp;<br>
				                                <input  type="text" id="cantidad" name="cantidad" placeholder="CANTIDAD" value="" autocomplete="off" required  onkeyup="this.value=this.value.toUpperCase()">
				                                <font color="red" size="4">*</font> 
				                                	<br>
				                                	    <strong>Estatus:</strong> &nbsp;<br>
				                                <select id="estatus_s" name="estatus" required>
				                                <option value="">SELECCIONE...</option>
				                                <option value="ACTIVO">ACTIVO</option>
				                                <option value="INACTIVO">INACTIVO</option>
												</select>
				                                    <font color="red" size="4">*</font>
					                                <br>

				       
				                                </div>

				                            	</div>
				                            	<div class="row-fluid" align="center">
				                            	<br>
				                            	<strong>Requisitos:</strong>
				                            	 <a href="#tabla_modal" id="modala" role="button" class="btn btn-primary" data-toggle="modal">+</a>	

				                            	<br><br>
				                                
				                                 <?php
				                                 require_once('../controlador/Gestion_Solicitud_Controller.php');
				                               	 $Control=new Gestion_Solicitud_Controller();
												 $Control->CargarRequisitos();
						                         ?>
						                         </div>
				                            	    
				                                          
				                            	 <strong>Quienes Podran Ver La Solicitud?</strong> &nbsp;<br>
				                            	 <label>Todos</label>&nbsp;&nbsp;&nbsp;<input type="radio" id="todo" name="todo" value="GENERAL"><br>
				                            	 <label>Alguien En Especifico</label>&nbsp;&nbsp;&nbsp;<input type="radio" id="uno" name="uno" value="ESPECIFICO">
				                            	
				                            
					                           	<center><input type="button" id="Registrar_s" class="btn btn-primary btn-large" name="Registrar" value="Registrar" >
					                            <input type="button"  id="Modificar_s" class="btn btn-primary btn-large" name="Modificar" value="Modificar" disabled="disabled"/>
					                            <input type="button" id="Cancelar_s" class="btn btn-primary btn-large" name="Cancelar" value="Cancelar" />
					                            </center>
					                       	</form>
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
					                                  <center><strong> Lista De Solicitudes</strong></center>
					                      </td>
					                      </tr>
							            </table>


					                 <!--TABLA CATALAGO-->
					                    <table class="table table-bordered" id="Table"  width="100%">
					                      <?php
					                     // $Control->CargarCatalago_Solicitudes($ID_INSTITUCION);
					                      ?>
					                    </table>

									    </td>
									    </tr>
									    </table>


					             <!-- FIN DEL PANEL 1 -->
					             </div>

					             <!-- //////////////////////////////////////////////////////////// -->


					             

    		

    	</div>
    	</div></div>
      



<!--Modal Requisitos------ -->

<div align="center" id="tabla_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  
  <div class="modal-dialog">
    <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
    <h3  align="center">Gestionar Requisito<br></h3>

  </div>

    <div class="modal-body" align="center">
   

  <center>
                       
                            <div class="row-fluid" align="center">
				            <div class="span6">
                                <strong>Nombre Requisito:</strong><br>
                                <input type="hidden" id="id_requisito" nombre="id_requisito">
                                <input type="text" id="nombre" name="nombre"  value="" autocomplete="off" required ><br>  
                              </div>
                              <div class="span6">
                                 <strong>Estatus:</strong><br>
                                    <select id="estatus" name="estatus" required ><br><br>
                                    <option value="ACTIVO" >ACTIVO</option>
                                    <option value="INACTIVO" >INACTIVO</option>
                                    </select><br>
                           
                            </div><br>
                    </div>
                     <center>
                            <br>
                            <input type="submit" id="Registrar" value="Registrar"  class="btn btn-primary btn-large" name="Registrar">
                           
                            <input type="button" id="Modificar" value="Modificar"  class="btn btn-primary btn-large" disabled="true" >
                            
                            <input type="button" id="Cancelar" class="btn btn-primary btn-large" name="Cancelar" value="Cancelar" disabled="true"/>

                          
                            </center><br>
                    </center>
   
	</div>



	<div align="center">
  <table width="70%">
    <tr>
    <td>
          
      <table class="table table-bordered">
          <tr class="well">
          <td>
                      <center><strong>Requisitos Registrados</strong></center>
          </td>
          </tr>
      </table>
            
           
          
            
            <!--TABLA DE LOS REGISTROS-->
            <table class="display dataTable" id="tabla_r" width="100%" >

                <?php 
               $Control->cargarTabla();
                ?>
                
            </table>
    </td>
    </tr>
  </table>
</div>
 
    <div class="modal-footer">
    <button  class="btn" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong>
    </button>

    </div>
    </div>
    </div>
    </div>

    <!-- FIN DEL MODAL DE REQUISITOS------ --> 

<!--PERSONAS------ -->

<div align="center" id="tabla_modal_estudiantes" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  
 <div class="modal-dialog"> /*modal-lg*/
    <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
    <h3  align="center">Gestionar Requisito<br></h3>

  </div>

    <div class="modal-body" align="center">
  	
  	
  	</form>
    
  
	</div>



	<div align="center">
  <table width="70%">
    <tr>
    <td>
          
      <table class="table table-bordered">
          <tr class="well">
          <td>
                      <center><strong>Estudiantes Registrados</strong></center>
          </td>
          </tr>
      </table>
            
           
          
            
            <!--TABLA DE LOS REGISTROS-->
          <table class="display dataTable"  id="tablaEstudiante" style="cursor:pointer">
            <thead> <tr> 
            <td>  <center><strong> Estudiante </strong></center> </td>
            <td>  <center><strong> Expediente </strong></center> </td>
            <td>  <center><strong> Especialidad </strong></center> </td>
            <td width="10">  <center><strong> Asignar </strong></center></td>
            <td style="display:none">  <center><strong> CodigoEstudiante </strong></center></td>
            </tr> </thead>
          </table>

          </center>
          <input type="hidden" id="temporada">
    </td>
    </tr>
    </table>
    </td>
    </tr>
  </table>
    </div>
     <br>
    <div class="modal-footer">
    <input type="button" id="Registrar_Especificos" value="Registrar"  class="btn btn-primary btn-large" name="Registrar">
                           
    <button  class="btn" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong>
    </button>

    </div>
    </div>
    </div>
    </div>

    <!-- FIN DEL MODAL DE PERSONAS------ --> 





<!--Modal tipo solicitudes------ -->

<div align="center" id="tabla_modal_tipo_solicitud" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  
 <div class="modal-dialog">
    <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
    <h3  align="center">Seleccionar un Tipo De Solicitud<br></h3>

  </div>

    <div class="modal-body" align="center">
  	
  	
  	</form>
    
  
	</div>



	<div align="center">
 <table width="70%">
    <tr>
    <td>
          
      <table class="table table-bordered">
          <tr class="well">
          <td>
                      <center><strong>Tipos De Solicitudes Registradas</strong></center>
          </td>
          </tr>
      </table>
            
           
          
            
            <!--TABLA DE LOS REGISTROS-->
          <table class="display dataTable"  id="tablaTipoSolicitudes" style="cursor:pointer" width="70%">
            <thead> <tr> 
            <td>  <center><strong> Tipo Solicitud </strong></center> </td>
            <td>  <center><strong> Periodo </strong></center> </td>
            <td>  <center><strong> Especialidad </strong></center> </td>
             <td>  <center><strong> Fecha Incio  </strong></center> </td>
            <td>  <center><strong> Fecha Fin </strong></center> </td>
            <td style=display:none>  <center><strong> Codigo Temporada </strong></center></td>
            <td style=display:none>  <center><strong> id especialidad </strong></center></td>
            </tr> </thead>
          </table>

          </center>
          
    </td>
    </tr>
    </table>
     </td>
    </tr>
  </table>
    </div>
     <br>
    <div class="modal-footer">
                     
    <button  class="btn" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong>
    </button>

    </div>
    </div>
    </div>
    </div>

    <!-- FIN DEL Modal tipo solicitudes------ --> 





    <!-- MODAL ORGANIZACIONES-->
<div align="center" id="tabla_modal_organizaciones" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
    <h3  align="center">Organizaciones Asociadas<br></h3>

  </div>

    <div class="modal-body" align="center">
  	<table width="95%">
	  <tr>
		<td>
        	
	            <div class="row">
                  <div class="col-xs-3" >
                  <ul class="nav nav-pills tabs-left" id="pestana"></ul>
                  </div>
                  <div class="col-xs-8" >
                  <div class="tab-content"  style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
                  </div>
                  </div>
                </div>
  	
     </td>
    </tr>
  </table>
    </div>
     <br>
    <div class="modal-footer">
                     
    <button  class="btn" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong>
    </button>

    </div>
    </div>
    </div>
    </div>

    <?php include('modalOrganizacionesAsociadas.phtml') ?>
   
    
    <!-- FIN MODAL ORGANIZACIONES-->


       <!--   Mensajes-->
 <script src="../js/dist/js/jquery.amaran.min.js"></script>
 <script src="../js/dist/js/jquery.amaran.js"></script>
   <!--  FIN  Mensajes-->
  
  <script src="../../Modulo_tipoOrganizacion/js/letrasNunmers.js"></script>
  <!-- AUTOCOMPLETADO-->
<link  href="../js/completer.css" rel="stylesheet">
<script type="text/javascript" src="../js/completer.js"></script>

	<!--  FIN  AUTOCOMPLETE-->
   
  

    <script>
    $(document).ready(function(){
      $('#tablaTipoSolicitudes').dataTable();
      $('#tabla_r').dataTable();
      $('#tablaEstudiante').dataTable();
    });
  </script>


 <!--PAGINADOR - T A B L A S-->
    
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.js"></script>
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.min.js"></script>

    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables_themeroller.css" rel="stylesheet">

 <!--PAGINADOR - T A B L A S-->
    
  

   <script src="../js/dist/js/jquery.amaran.min.js"></script>
   <script src="../js/dist/js/jquery.amaran.js"></script>


<script type="text/javascript" src="../js/solicitud.js"></script>
<script type="text/javascript" src="../js/requisito.js"></script>
<script type="text/javascript" src="../js/MisOrganizaciones.js" ></script>

<!--
<footer class="web-footer clearfix">
  <div class="web-footer-inner">
<p><a href="#">H</a>ome|<a href="#">Acerca de</a>|<a href="#">Contact</a>o</p>
  </div>
</footer>  -->

</body>
</html>
=======
<?php
session_start();


if(isset($_SESSION['id_perfil'])){
$id_perfil=$_SESSION['id_perfil'];
$nombre_perfil=$_SESSION['nombre_perfil'];

$id_persona=$_SESSION['id_persona'];
$nombre_persona = $_SESSION['persona'];
$ID_INSTITUCION=$_SESSION['id_organizacion'];
$codigo_sucursal=$_SESSION['codigo_sucursal'];
}else{ 
$id_perfil=1;
$nombre_perfil="Menu Principal";
}

 ?>
<!DOCTYPE html>
<!-- saved from url=(0066)http://vadikom.github.io/smartmenus/src/demo/bootstrap-navbar.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pasantias</title>

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
  <script src="../../../Menus/bootstrap/js/jquery-1.10.2.min.js"></script>
  
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/bootstrap.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/highlight.min.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/bootstrap-submenu.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/docs.js" defer=""></script>
  </head>
  
  <body style="padding-top: 20px;" id="page"  >

 
<!-- MENU -->

<?php

include("../../../BASE_DATOS/Conect.php");
$conexionBD = new Conexion();
$conexionBD->Conectar();
include("../../Modulo_Usuario/modelo/mod_usuario.php");
$persona= new usuarios();

 
     if($id_perfil==6){echo '<input type="hidden" id=id_ip value='.$_SESSION['ID_INSTITUCION'].' >';
                       echo '<label hidden id=codigo_encargado>'.$_SESSION['codigo_encargado'].'</label >';
                     $nombre_organizacion =  $_SESSION['nombre_instituto'];  
       }else{$nombre_organizacion =  $_SESSION['nombre_organizacion'];}
      $persona->menu($id_perfil , $nombre_perfil , $nombre_organizacion ,$nombre_persona );

   
?>

<!-- Fin De MENU-->

   
    
 
     


<div align="center">
    <div style="width:70%">


        <table class="table table-bordered">
          <tr class="well">
             <td><h4 align="center">Gesti&oacute;n Solicitud</h4></td>
             
            </tr>
          </table>


		         <!-- DIV GENERAL GENERAL -->
		         <div class="tabbable" style="margin-bottom: 18px;">
	         
					             <div >
					              	
					              	<table class="table table-bordered">
						              
						             
						              <tr>
						              <td>
				                     <form name="form" action="" method="post" >
				                          
				                        <div class="row-fluid" align="center">
				                            <div class="span6">

	                                    <?php if($id_perfil==6){echo'<label>Mis Organizaciones Asociadas</label>&nbsp;&nbsp;&nbsp;<input type="button" id="mostar_modal" class="btn btn-primary btn-large" name="mostar_modal" value="+">';
	                                          echo' <input type="hidden" id="id_instituto" name="id_instituto" value=""/>';
				                              echo'  <input type="hidden" id="id_persona" name="id_persona" value=""> ';
				                              echo'  <input type="hidden" id="codigo_sucursal" name="codigo_sucursal" value=""> ';

	                                    }else{  
				                              echo' <!-- CAMPO INVISIBLE PARA LLEVARME EL ID  -->  ';
				                             echo' <input type="hidden" id="id_instituto" name="id_instituto" value="'.$ID_INSTITUCION.'"/>';
				                             echo'  <input type="hidden" id="id_persona" name="id_persona" value="'.$id_persona.'" >';
				                             echo'   <input type="hidden" id="codigo_sucursal" name="codigo_sucursal" value="'.$codigo_sucursal.'" >';   
				                             echo'   <input type="hidden" id="id_solicitud" name="id_solicitud" value=""/> ';                         
				                                   }?>  
				                                   <br>   <br>                  
				                        <label>Seleccionar El Tipo De Solicitud</label>&nbsp;&nbsp;<input type="button" class="btn btn-primary" id="modal_ts" name="modal_ts" value="+">
				                            	
				                                 <br>
				                                <strong>Tipo Solicitud:</strong> &nbsp;<br>
				                                <input type="hidden" id="tipo_solicitud" name="tipo_solicitud" value="">   
				                                 <input type="text" id="nombre_solicitud" name="nombre_solicitud" value="" disabled="">                              
				                                <font color="red" size="4">*</font>  
					                            <br>

												
				                                <strong>Especialidad:</strong> &nbsp;<br>
				                                <input  type="hidden" id="especialidad" name="especialidad" value=""  disabled="">
				                                <input type="text" id="nombre_especialidad" name="nombre_especialidad" value="" disabled="">                               
				                                <font color="red" size="4">*</font>
					                            
				                               
				                                </div>


				                                <div class="span6">
				                            	<br>
				                            	 <strong>Cantidad:</strong> &nbsp;<br>
				                                <input  type="text" id="cantidad" name="cantidad" placeholder="CANTIDAD" value="" autocomplete="off" required  onkeyup="this.value=this.value.toUpperCase()">
				                                <font color="red" size="4">*</font> 
				                                	<br>
				                                	    <strong>Estatus:</strong> &nbsp;<br>
				                                <select id="estatus_s" name="estatus" required>
				                                <option value="">SELECCIONE...</option>
				                                <option value="ACTIVO">ACTIVO</option>
				                                <option value="INACTIVO">INACTIVO</option>
												</select>
				                                    <font color="red" size="4">*</font>
					                                <br>

				       
				                                </div>

				                            	</div>
				                            	<div class="row-fluid" align="center">
				                            	<br>
				                            	<strong>Requisitos:</strong>
				                            	 <a href="#tabla_modal" id="modala" role="button" class="btn btn-primary" data-toggle="modal">+</a>	

				                            	<br><br>
				                                
				                                 <?php
				                                 require_once('../controlador/Gestion_Solicitud_Controller.php');
				                               	 $Control=new Gestion_Solicitud_Controller();
												 $Control->CargarRequisitos();
						                         ?>
						                         </div>
				                            	    
				                                          
				                            	 <strong>Quienes Podran Ver La Solicitud?</strong> &nbsp;<br>
				                            	 <label>Todos</label>&nbsp;&nbsp;&nbsp;<input type="radio" id="todo" name="todo" value="GENERAL"><br>
				                            	 <label>Alguien En Especifico</label>&nbsp;&nbsp;&nbsp;<input type="radio" id="uno" name="uno" value="ESPECIFICO">
				                            	
				                            
					                           	<center><input type="button" id="Registrar_s" class="btn btn-primary btn-large" name="Registrar" value="Registrar" >
					                            <input type="button"  id="Modificar_s" class="btn btn-primary btn-large" name="Modificar" value="Modificar" disabled="disabled"/>
					                            <input type="button" id="Cancelar_s" class="btn btn-primary btn-large" name="Cancelar" value="Cancelar" />
					                            </center>
					                       	</form>
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
					                                  <center><strong> Lista De Solicitudes</strong></center>
					                      </td>
					                      </tr>
							            </table>


					                 <!--TABLA CATALAGO-->
					                    <table class="table table-bordered" id="Table"  width="100%">
					                      <?php
					                     // $Control->CargarCatalago_Solicitudes($ID_INSTITUCION);
					                      ?>
					                    </table>

									    </td>
									    </tr>
									    </table>


					             <!-- FIN DEL PANEL 1 -->
					             </div>

					             <!-- //////////////////////////////////////////////////////////// -->


					             

    		

    	</div>
    	</div></div>
      



<!--Modal Requisitos------ -->

<div align="center" id="tabla_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  
  <div class="modal-dialog">
    <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
    <h3  align="center">Gestionar Requisito<br></h3>

  </div>

    <div class="modal-body" align="center">
   

  <center>
                       
                            <div class="row-fluid" align="center">
				            <div class="span6">
                                <strong>Nombre Requisito:</strong><br>
                                <input type="hidden" id="id_requisito" nombre="id_requisito">
                                <input type="text" id="nombre" name="nombre"  value="" autocomplete="off" required ><br>  
                              </div>
                              <div class="span6">
                                 <strong>Estatus:</strong><br>
                                    <select id="estatus" name="estatus" required ><br><br>
                                    <option value="ACTIVO" >ACTIVO</option>
                                    <option value="INACTIVO" >INACTIVO</option>
                                    </select><br>
                           
                            </div><br>
                    </div>
                     <center>
                            <br>
                            <input type="submit" id="Registrar" value="Registrar"  class="btn btn-primary btn-large" name="Registrar">
                           
                            <input type="button" id="Modificar" value="Modificar"  class="btn btn-primary btn-large" disabled="true" >
                            
                            <input type="button" id="Cancelar" class="btn btn-primary btn-large" name="Cancelar" value="Cancelar" disabled="true"/>

                          
                            </center><br>
                    </center>
   
	</div>



	<div align="center">
  <table width="70%">
    <tr>
    <td>
          
      <table class="table table-bordered">
          <tr class="well">
          <td>
                      <center><strong>Requisitos Registrados</strong></center>
          </td>
          </tr>
      </table>
            
           
          
            
            <!--TABLA DE LOS REGISTROS-->
            <table class="display dataTable" id="tabla_r" width="100%" >

                <?php 
               $Control->cargarTabla();
                ?>
                
            </table>
    </td>
    </tr>
  </table>
</div>
 
    <div class="modal-footer">
    <button  class="btn" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong>
    </button>

    </div>
    </div>
    </div>
    </div>

    <!-- FIN DEL MODAL DE REQUISITOS------ --> 

<!--PERSONAS------ -->

<div align="center" id="tabla_modal_estudiantes" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  
 <div class="modal-dialog"> /*modal-lg*/
    <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
    <h3  align="center">Gestionar Requisito<br></h3>

  </div>

    <div class="modal-body" align="center">
  	
  	
  	</form>
    
  
	</div>



	<div align="center">
  <table width="70%">
    <tr>
    <td>
          
      <table class="table table-bordered">
          <tr class="well">
          <td>
                      <center><strong>Estudiantes Registrados</strong></center>
          </td>
          </tr>
      </table>
            
           
          
            
            <!--TABLA DE LOS REGISTROS-->
          <table class="display dataTable"  id="tablaEstudiante" style="cursor:pointer">
            <thead> <tr> 
            <td>  <center><strong> Estudiante </strong></center> </td>
            <td>  <center><strong> Expediente </strong></center> </td>
            <td>  <center><strong> Especialidad </strong></center> </td>
            <td width="10">  <center><strong> Asignar </strong></center></td>
            <td style="display:none">  <center><strong> CodigoEstudiante </strong></center></td>
            </tr> </thead>
          </table>

          </center>
          <input type="hidden" id="temporada">
    </td>
    </tr>
    </table>
    </td>
    </tr>
  </table>
    </div>
     <br>
    <div class="modal-footer">
    <input type="button" id="Registrar_Especificos" value="Registrar"  class="btn btn-primary btn-large" name="Registrar">
                           
    <button  class="btn" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong>
    </button>

    </div>
    </div>
    </div>
    </div>

    <!-- FIN DEL MODAL DE PERSONAS------ --> 





<!--Modal tipo solicitudes------ -->

<div align="center" id="tabla_modal_tipo_solicitud" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  
 <div class="modal-dialog">
    <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
    <h3  align="center">Seleccionar un Tipo De Solicitud<br></h3>

  </div>

    <div class="modal-body" align="center">
  	
  	
  	</form>
    
  
	</div>



	<div align="center">
 <table width="70%">
    <tr>
    <td>
          
      <table class="table table-bordered">
          <tr class="well">
          <td>
                      <center><strong>Tipos De Solicitudes Registradas</strong></center>
          </td>
          </tr>
      </table>
            
           
          
            
            <!--TABLA DE LOS REGISTROS-->
          <table class="display dataTable"  id="tablaTipoSolicitudes" style="cursor:pointer" width="70%">
            <thead> <tr> 
            <td>  <center><strong> Tipo Solicitud </strong></center> </td>
            <td>  <center><strong> Periodo </strong></center> </td>
            <td>  <center><strong> Especialidad </strong></center> </td>
             <td>  <center><strong> Fecha Incio  </strong></center> </td>
            <td>  <center><strong> Fecha Fin </strong></center> </td>
            <td style=display:none>  <center><strong> Codigo Temporada </strong></center></td>
            <td style=display:none>  <center><strong> id especialidad </strong></center></td>
            </tr> </thead>
          </table>

          </center>
          
    </td>
    </tr>
    </table>
     </td>
    </tr>
  </table>
    </div>
     <br>
    <div class="modal-footer">
                     
    <button  class="btn" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong>
    </button>

    </div>
    </div>
    </div>
    </div>

    <!-- FIN DEL Modal tipo solicitudes------ --> 





    <!-- MODAL ORGANIZACIONES-->
<div align="center" id="tabla_modal_organizaciones" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button> 
    <h3  align="center">Organizaciones Asociadas<br></h3>

  </div>

    <div class="modal-body" align="center">
  	<table width="95%">
	  <tr>
		<td>
        	
	            <div class="row">
                  <div class="col-xs-3" >
                  <ul class="nav nav-pills tabs-left" id="pestana"></ul>
                  </div>
                  <div class="col-xs-8" >
                  <div class="tab-content"  style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
                  </div>
                  </div>
                </div>
  	
     </td>
    </tr>
  </table>
    </div>
     <br>
    <div class="modal-footer">
                     
    <button  class="btn" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong>
    </button>

    </div>
    </div>
    </div>
    </div>

    <?php include('modalOrganizacionesAsociadas.phtml') ?>
   
    
    <!-- FIN MODAL ORGANIZACIONES-->


       <!--   Mensajes-->
 <script src="../js/dist/js/jquery.amaran.min.js"></script>
 <script src="../js/dist/js/jquery.amaran.js"></script>
   <!--  FIN  Mensajes-->
  
  <script src="../../Modulo_tipoOrganizacion/js/letrasNunmers.js"></script>
  <!-- AUTOCOMPLETADO-->
<link  href="../js/completer.css" rel="stylesheet">
<script type="text/javascript" src="../js/completer.js"></script>

	<!--  FIN  AUTOCOMPLETE-->
   
  

    <script>
    $(document).ready(function(){
      $('#tablaTipoSolicitudes').dataTable();
      $('#tabla_r').dataTable();
      $('#tablaEstudiante').dataTable();
    });
  </script>


 <!--PAGINADOR - T A B L A S-->
    
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.js"></script>
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.min.js"></script>

    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables_themeroller.css" rel="stylesheet">

 <!--PAGINADOR - T A B L A S-->
    
  

   <script src="../js/dist/js/jquery.amaran.min.js"></script>
   <script src="../js/dist/js/jquery.amaran.js"></script>


<script type="text/javascript" src="../js/solicitud.js"></script>
<script type="text/javascript" src="../js/requisito.js"></script>
<script type="text/javascript" src="../js/MisOrganizaciones.js" ></script>

<!--
<footer class="web-footer clearfix">
  <div class="web-footer-inner">
<p><a href="#">H</a>ome|<a href="#">Acerca de</a>|<a href="#">Contact</a>o</p>
  </div>
</footer>  -->

</body>
</html>
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
