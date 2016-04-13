<<<<<<< HEAD
<?php
session_start();

if(isset($_SESSION['id_perfil'])){
  
  $id_perfil           =$_SESSION['id_perfil'];
  
  $nombre_perfil       =$_SESSION['nombre_perfil'];
  
  $nombre_organizacion =  $_SESSION['nombre_instituto'];
  
  $nombre_persona      = $_SESSION['persona'];

}else { 
  $id_perfil     =1;
  $nombre_perfil ="Menu Principal";
}
 ?>
<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
  <script src="../../../Menus/bootstrap/js/bootstrap.min.js" defer=""></script>
  <script src="../../../Menus/bootstrap/js/bootstrap.js" defer=""></script>
 
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/bootstrap.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/highlight.min.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/bootstrap-submenu.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/docs.js" defer=""></script>
  <script src="../../../Menus/bootstrap/js/tooltip.js" ></script>
 
  <link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css">
 
   <link rel="stylesheet" href="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.css">
   <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.js"></script>
   <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.min.js"></script>
  
  <link rel="stylesheet" href="../../../Menus/bootstrap/Awesome/css/font-awesome.min.css">

  </head>

  <body id="page" style="padding-top: 20px;">
<?php

include('../controlador/Periodo_Solicitud_Controller.php');
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
    
    <div style="width:60%">
            <table class="table table-bordered">
            <tr class="well">
              <td colspan="2"><h4 align="center">Gestionar Periodo de Solicitud</h4></td>
            </tr>
            <tr class="well">
              <td><center><strong>Lapso Acad&eacute;mico:</strong></center></td>
               <td><center><strong>Periodo de Solicitud:</strong></center></td>
            </tr>

          <tr>
            <td colspan="2">
                 <center>
                       
            <div class="row-fluid">
                      <div class="span6">                         

                          <strong>Lapso:</strong><br>
                          <select id="numero_lapso" name="numero_lapso" class="form-control"  required>   

                            <option value="" >Seleccione...</option>

                          </select>
                          <font color="red" size="3">*</font><br>

                          <strong>Fecha de Inicio:</strong><br>
                          <input type="date" id="inicio" name="inicio" value="" autocomplete="off" disabled="true" required>
                          <br>

                          <strong>Fecha de Culminaci&oacute;n:</strong><br>
                          <input type="date" id="fin" name="fin" value="" autocomplete="off" disabled="true" required>



                      </div>
								                <input type="text" id="periodo" value="" style="display :none">
								
                      <div class="span6"> 

                          <strong>Estatus:</strong><br>

                          <select id="estatus" name="estatus" class="form-control" required >
                          
                              <option value="" >Seleccione...</option>
                              
                              <option value="ACTIVO" >ACTIVO...</option>
                              
                              <option value="INACTIVO" >INACTIVO...</option>
                          
                          </select> <font color="red" size="3">*</font><br>

                          <strong>Fecha de Inicio:</strong><br>
                          
                          <input type="text" id="fecha_inicio" name="fecha_inicio" value="" autocomplete="off" required>
                          
                          <font color="red" size="3">*</font><br>

                          <strong>Fecha de Culminaci&oacute;n:</strong><br>
                          
                          <input type="text" id="fecha_fin" name="fecha_fin" value="" autocomplete="off" required>
                          
                          <font color="red" size="3">*</font><br>



                          <br> 
                      </div>  
              </div>
                            <input type="submit" id="Registrar" value="Registrar"  class="btn btn-primary btn-large" name="Registrar">
                           
                            <input type="button" value="Modificar" id="Modificar" class="btn btn-primary btn-large" disabled="true" >
                            
                            <input type="button" id="Cancelar" class="btn btn-primary btn-large" name="Cancelar" value="Cancelar" disabled="true"/>
							
<button  id="Reporte" class="btn btn-primary btn-large" name="Reporte" > <span class="glyphicon glyphicon-download-alt"></span> Reporte </button>
                            </center>                 
                    
                    </center>
					    <font color="red" size="3">(*) </font><font color="red" size="2">Campos Obligatorios... </font>
                </td>
          </tr>
        </table>
    </div>
    </div>


  
<div align="center">
  <table width="70%">
    <tr>
    <td>
          
      <table class="table table-bordered">
          <tr class="well">
          <td>
                      <center><strong>Periodos de Solicitud Registrados:</strong></center>
          </td>
          </tr>
      </table>
            
           
          
            
            <!--TABLA DE LOS REGISTROS-->
            <div class="table-responsive">
            <table  class="table table-striped table-hover dt-responsive nowrap compact" cellspacing="0" id="myTable"  style="cursor :pointer; width:100% ">

                    <thead >
                    
                    <tr >
                      
                      <th hidden>ID</th>
                      
                      <th>Fecha Inicio</th>
                      
                      <th>Fecha Fin</th>
                      
                      <th>Lapso</th>
                      
                      <th>Estatus</th>
                      
                      <th></th>
                   
                    </tr>

                  </thead> 
                
            </table>
            </div>
    </td>
    </tr>
  </table>

 <div id="modal_lapsos_academicos_aplicables" class="modal fade" > 


      <div class="modal-dialog">
            <div class="modal-content">
               
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title"  align="center" id="titleTutor">Lapsos Académicos Sugeridos</h4>
      </div>
    
      <div class="modal-body" align="center">

              <center>
              <div id="mensajeExplicacion"></div>

                <div class="table-responsive">

                     <table class="table table-striped table-hover compact" cellspacing="0" id="lapsos_academicos_tabla"  style="cursor :pointer; width:99% ">
                      <thead >
                      <tr>
                          <td hidden>
                          </td>
                          <td><center><strong>Lapso</strong></center>
                          </td>
                          <td hidden>
                          </td>
                          <td>
                          </td>                  
                      </tr>
                      </thead >
                     </table>

                 </div>

              </center>

      </div>  
      <div class="modal-footer">
        <button  class="btn btn-default"  data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong></button>
        <button id="ass" class="btn btn-primary"  data-dismiss="modal" aria-hidden="true" ><strong>Aceptar</strong></button>
                
      </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
<!--PAGINADOR-->

  <!-- Estilo De Selects Very Good -->
  <!-- Estilo De Selects Very Good -->

<link rel="stylesheet" href="../../../Menus/bootstrap/bootstrap-select/css/jquery.selectBoxIt.css">
<script src="../../../Menus/bootstrap/bootstrap-select/js/jquery-ui-1.8.23.custom.min.js" defer=""></script> 
<script src="../../../Menus/bootstrap/bootstrap-select/js/jquery.selectBoxIt.min.js" defer=""></script>

  <!-- Estilo De Selects Very Good -->
    
       <!--PAGINADOR-->


    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.min.js"></script>
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/dataTables.bootstrap.min.js"></script> 
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/dataTables.responsive.min.js"></script> 
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/responsive.bootstrap.min.js"></script> 

    <link rel="stylesheet" href="../../../Menus/bootstrap/css/selectBien.css">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables_themeroller.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/responsive.bootstrap.min.css" rel="stylesheet"> 

    <script src="../js/dist/js/jquery.amaran.min.js"></script>
    <script src="../js/dist/js/jquery.amaran.js"></script>
    <script src="../js/date/jquery.datetimepicker.js"></script>
    
     <script type="text/javascript" src="../js/Periodo_Solicitud.js"></script>
  

</body></html>
=======
<?php
session_start();

if(isset($_SESSION['id_perfil'])){
  
  $id_perfil           =$_SESSION['id_perfil'];
  
  $nombre_perfil       =$_SESSION['nombre_perfil'];
  
  $nombre_organizacion =  $_SESSION['nombre_instituto'];
  
  $nombre_persona      = $_SESSION['persona'];

}else { 
  $id_perfil     =1;
  $nombre_perfil ="Menu Principal";
}
 ?>
<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
  <script src="../../../Menus/bootstrap/js/bootstrap.min.js" defer=""></script>
  <script src="../../../Menus/bootstrap/js/bootstrap.js" defer=""></script>
 
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/bootstrap.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/highlight.min.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/bootstrap-submenu.js" defer=""></script>
  <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/docs.js" defer=""></script>
  <script src="../../../Menus/bootstrap/js/tooltip.js" ></script>
 
  <link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css">
 
   <link rel="stylesheet" href="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.css">
   <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.js"></script>
   <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.min.js"></script>
  
  <link rel="stylesheet" href="../../../Menus/bootstrap/Awesome/css/font-awesome.min.css">

  </head>

  <body id="page" style="padding-top: 20px;">
<?php

include('../controlador/Periodo_Solicitud_Controller.php');
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
    
    <div style="width:60%">
            <table class="table table-bordered">
            <tr class="well">
              <td colspan="2"><h4 align="center">Gestionar Periodo de Solicitud</h4></td>
            </tr>
            <tr class="well">
              <td><center><strong>Lapso Acad&eacute;mico:</strong></center></td>
               <td><center><strong>Periodo de Solicitud:</strong></center></td>
            </tr>

          <tr>
            <td colspan="2">
                 <center>
                       
            <div class="row-fluid">
                      <div class="span6">                         

                          <strong>Lapso:</strong><br>
                          <select id="numero_lapso" name="numero_lapso" class="form-control"  required>   

                            <option value="" >Seleccione...</option>

                          </select>
                          <font color="red" size="3">*</font><br>

                          <strong>Fecha de Inicio:</strong><br>
                          <input type="date" id="inicio" name="inicio" value="" autocomplete="off" disabled="true" required>
                          <br>

                          <strong>Fecha de Culminaci&oacute;n:</strong><br>
                          <input type="date" id="fin" name="fin" value="" autocomplete="off" disabled="true" required>



                      </div>
								                <input type="text" id="periodo" value="" style="display :none">
								
                      <div class="span6"> 

                          <strong>Estatus:</strong><br>

                          <select id="estatus" name="estatus" class="form-control" required >
                          
                              <option value="" >Seleccione...</option>
                              
                              <option value="ACTIVO" >ACTIVO...</option>
                              
                              <option value="INACTIVO" >INACTIVO...</option>
                          
                          </select> <font color="red" size="3">*</font><br>

                          <strong>Fecha de Inicio:</strong><br>
                          
                          <input type="text" id="fecha_inicio" name="fecha_inicio" value="" autocomplete="off" required>
                          
                          <font color="red" size="3">*</font><br>

                          <strong>Fecha de Culminaci&oacute;n:</strong><br>
                          
                          <input type="text" id="fecha_fin" name="fecha_fin" value="" autocomplete="off" required>
                          
                          <font color="red" size="3">*</font><br>



                          <br> 
                      </div>  
              </div>
                            <input type="submit" id="Registrar" value="Registrar"  class="btn btn-primary btn-large" name="Registrar">
                           
                            <input type="button" value="Modificar" id="Modificar" class="btn btn-primary btn-large" disabled="true" >
                            
                            <input type="button" id="Cancelar" class="btn btn-primary btn-large" name="Cancelar" value="Cancelar" disabled="true"/>
							
<button  id="Reporte" class="btn btn-primary btn-large" name="Reporte" > <span class="glyphicon glyphicon-download-alt"></span> Reporte </button>
                            </center>                 
                    
                    </center>
					    <font color="red" size="3">(*) </font><font color="red" size="2">Campos Obligatorios... </font>
                </td>
          </tr>
        </table>
    </div>
    </div>


  
<div align="center">
  <table width="70%">
    <tr>
    <td>
          
      <table class="table table-bordered">
          <tr class="well">
          <td>
                      <center><strong>Periodos de Solicitud Registrados:</strong></center>
          </td>
          </tr>
      </table>
            
           
          
            
            <!--TABLA DE LOS REGISTROS-->
            <div class="table-responsive">
            <table  class="table table-striped table-hover dt-responsive nowrap compact" cellspacing="0" id="myTable"  style="cursor :pointer; width:100% ">

                    <thead >
                    
                    <tr >
                      
                      <th hidden>ID</th>
                      
                      <th>Fecha Inicio</th>
                      
                      <th>Fecha Fin</th>
                      
                      <th>Lapso</th>
                      
                      <th>Estatus</th>
                      
                      <th></th>
                   
                    </tr>

                  </thead> 
                
            </table>
            </div>
    </td>
    </tr>
  </table>

 <div id="modal_lapsos_academicos_aplicables" class="modal fade" > 


      <div class="modal-dialog">
            <div class="modal-content">
               
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title"  align="center" id="titleTutor">Lapsos Académicos Sugeridos</h4>
      </div>
    
      <div class="modal-body" align="center">

              <center>
              <div id="mensajeExplicacion"></div>

                <div class="table-responsive">

                     <table class="table table-striped table-hover compact" cellspacing="0" id="lapsos_academicos_tabla"  style="cursor :pointer; width:99% ">
                      <thead >
                      <tr>
                          <td hidden>
                          </td>
                          <td><center><strong>Lapso</strong></center>
                          </td>
                          <td hidden>
                          </td>
                          <td>
                          </td>                  
                      </tr>
                      </thead >
                     </table>

                 </div>

              </center>

      </div>  
      <div class="modal-footer">
        <button  class="btn btn-default"  data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong></button>
        <button id="ass" class="btn btn-primary"  data-dismiss="modal" aria-hidden="true" ><strong>Aceptar</strong></button>
                
      </div>
                
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
<!--PAGINADOR-->

  <!-- Estilo De Selects Very Good -->
  <!-- Estilo De Selects Very Good -->

<link rel="stylesheet" href="../../../Menus/bootstrap/bootstrap-select/css/jquery.selectBoxIt.css">
<script src="../../../Menus/bootstrap/bootstrap-select/js/jquery-ui-1.8.23.custom.min.js" defer=""></script> 
<script src="../../../Menus/bootstrap/bootstrap-select/js/jquery.selectBoxIt.min.js" defer=""></script>

  <!-- Estilo De Selects Very Good -->
    
       <!--PAGINADOR-->


    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.min.js"></script>
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/dataTables.bootstrap.min.js"></script> 
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/dataTables.responsive.min.js"></script> 
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/responsive.bootstrap.min.js"></script> 

    <link rel="stylesheet" href="../../../Menus/bootstrap/css/selectBien.css">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables_themeroller.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/responsive.bootstrap.min.css" rel="stylesheet"> 

    <script src="../js/dist/js/jquery.amaran.min.js"></script>
    <script src="../js/dist/js/jquery.amaran.js"></script>
    <script src="../js/date/jquery.datetimepicker.js"></script>
    
     <script type="text/javascript" src="../js/Periodo_Solicitud.js"></script>
  

</body></html>
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
