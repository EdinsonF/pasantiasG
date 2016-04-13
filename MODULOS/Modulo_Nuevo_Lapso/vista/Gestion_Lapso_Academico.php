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

// if(($id_perfil==null)|| ($nombre_perfil==null)){

// echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php'>";
// }
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


      <link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css">

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
  <script src="../../../Menus/bootstrap/js/tooltip.js" ></script>


    <link rel="stylesheet" href="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.css">
   <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.js"></script>
   <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.min.js"></script>

 <link rel="stylesheet" href="../../../Menus/bootstrap/Awesome/css/font-awesome.min.css">

  </head>

  <body id="page" style="padding-top: 20px;">

<?php

include('../controlador/Lapso_Academico_Controller.php');
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
              <td><h4 align="center">Gestionar Lapso Acad&eacute;mico</h4></td>
            </tr>
      

          <tr>
            <td>
                  <center>
                       
                            <div class="row-fluid">
                              <div class="span6">                         

                                <strong>Lapso Acad&eacute;mico:</strong><br>
                <input type="text" id="lapso" name="lapso"  maxlength="7" value="" autocomplete="off" required >
								<font color="red" size="2">*</font><br>  

                                <strong>Fecha de Inicio:</strong><br>
                                <input type="text" id="fecha_inicio" name="fecha_inicio" value="" autocomplete="off" required>
								<font color="red" size="2">*</font><br><br>
								</div>
                                  <div class="span6">      
                                 <strong>Estatus:</strong><br>
                                

                                <select id="estatus" name="estatus" class="form-control" required ><br><br>
                                    <option value="" >Seleccione...</option>
                                    <option value="ACTIVO" >ACTIVO...</option>
                                    <option value="INACTIVO" >INACTIVO...</option>
                                </select><font color="red" size="2">*</font><br>
                          
                            <br>
							 <strong>Fecha de Culminaci&oacute;n:</strong><br>
                             <input type="text" id="fecha_fin" name="fecha_fin" value="" autocomplete="off" required>
							<font color="red" size="2">*</font><br> </div>  </div>
                            <input type="submit" id="Registrar" value="Registrar"  class="btn btn-primary btn-large" name="Registrar">
                           
                            <input type="button" value="Modificar" id="Modificar" class="btn btn-primary btn-large" disabled="true" >
                            
                            <input type="button" id="Cancelar" class="btn btn-primary btn-large" name="Cancelar" value="Cancelar" />
							
                            <button  id="Reporte" class="btn btn-primary btn-large" name="Reporte" > <span class="glyphicon glyphicon-download-alt"></span> Reporte </button>
                           <br>
                           <br>
                  
                    
                    </center>
					 <font color="red" size="2">(*) </font><font color="red" size="2">Campos Obligatorios... </font>
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
                      <center><strong>Lapsos Acad&eacute;micos Registrados:</strong></center>
          </td>
          </tr>
      </table>
            
           
          
            
            <!--TABLA DE LOS REGISTROS-->
            <div class="table-responsive">
            <table id="myTableLapso"  class="table table-striped table-hover dt-responsive nowrap compact"  style="cursor :pointer; width :99%"  >
                <thead >
                  <tr >
                    
                    <th ></th>
                    <th>Lapso</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estatus</th>
                    <th></th>
                   
                  </tr>
                </thead>
                
            </table>
            </div>
    </td>
    </tr>
  </table>
</div>
  
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


    <script>
    $(document).ready(function(){
      $('#myTableLapso').dataTable({
          "language"       : {
          "sProcessing"    : "Procesando...",
          "sLengthMenu"    : "Mostrar _MENU_ Registros",
          "sZeroRecords"   : "No se encontraron Resultados",
          "sEmptyTable"    : "Ningún dato disponible en esta tabla",
          "sInfo"          : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty"     : "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered"  : "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix"   : "",
          "sSearch"        : "Buscar:",
          "sUrl"           : "",
          "sInfoThousands" : ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate"      : {
          "sFirst"         : "Primero",
          "sLast"          : "Último",
          "sNext"          : "Siguiente",
          "sPrevious"      : "Anterior"
          },
          "oAria"          : {
          "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
          },'columnDefs'   : [{
          'targets'        : 5,
          'searchable'     :true,
          'orderable'      :false,
          'className'      : 'dt-body-center'
          
          }] ,
          "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
          "iDisplayLength" : 5
          });
      tablaDatosGeneral();

      $("#estatus").selectBoxIt({autoWidth:false , 
        // Uses the jQuery 'fadeIn' effect when opening the drop down
        showEffect: "fadeIn",

        // Sets the jQuery 'fadeIn' effect speed to 400 milleseconds
        showEffectSpeed: 400,

        // Uses the jQuery 'fadeOut' effect when closing the drop down
        hideEffect: "fadeOut",

        // Sets the jQuery 'fadeOut' effect speed to 400 milleseconds
        hideEffectSpeed: 400       });
      Renderidng_select();

    });

  </script>

  
   <script src="../js/dist/js/jquery.amaran.min.js"></script>
   <script src="../js/dist/js/jquery.amaran.js"></script>
  <script src="../js/date/jquery.datetimepicker.js"></script>
   <script type="text/javascript" src="../js/lapso_academico.js"></script>

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

// if(($id_perfil==null)|| ($nombre_perfil==null)){

// echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php'>";
// }
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


      <link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css">

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
  <script src="../../../Menus/bootstrap/js/tooltip.js" ></script>


    <link rel="stylesheet" href="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.css">
   <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.js"></script>
   <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.min.js"></script>

 <link rel="stylesheet" href="../../../Menus/bootstrap/Awesome/css/font-awesome.min.css">

  </head>

  <body id="page" style="padding-top: 20px;">

<?php

include('../controlador/Lapso_Academico_Controller.php');
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
              <td><h4 align="center">Gestionar Lapso Acad&eacute;mico</h4></td>
            </tr>
      

          <tr>
            <td>
                  <center>
                       
                            <div class="row-fluid">
                              <div class="span6">                         

                                <strong>Lapso Acad&eacute;mico:</strong><br>
                <input type="text" id="lapso" name="lapso"  maxlength="7" value="" autocomplete="off" required >
								<font color="red" size="2">*</font><br>  

                                <strong>Fecha de Inicio:</strong><br>
                                <input type="text" id="fecha_inicio" name="fecha_inicio" value="" autocomplete="off" required>
								<font color="red" size="2">*</font><br><br>
								</div>
                                  <div class="span6">      
                                 <strong>Estatus:</strong><br>
                                

                                <select id="estatus" name="estatus" class="form-control" required ><br><br>
                                    <option value="" >Seleccione...</option>
                                    <option value="ACTIVO" >ACTIVO...</option>
                                    <option value="INACTIVO" >INACTIVO...</option>
                                </select><font color="red" size="2">*</font><br>
                          
                            <br>
							 <strong>Fecha de Culminaci&oacute;n:</strong><br>
                             <input type="text" id="fecha_fin" name="fecha_fin" value="" autocomplete="off" required>
							<font color="red" size="2">*</font><br> </div>  </div>
                            <input type="submit" id="Registrar" value="Registrar"  class="btn btn-primary btn-large" name="Registrar">
                           
                            <input type="button" value="Modificar" id="Modificar" class="btn btn-primary btn-large" disabled="true" >
                            
                            <input type="button" id="Cancelar" class="btn btn-primary btn-large" name="Cancelar" value="Cancelar" />
							
                            <button  id="Reporte" class="btn btn-primary btn-large" name="Reporte" > <span class="glyphicon glyphicon-download-alt"></span> Reporte </button>
                           <br>
                           <br>
                  
                    
                    </center>
					 <font color="red" size="2">(*) </font><font color="red" size="2">Campos Obligatorios... </font>
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
                      <center><strong>Lapsos Acad&eacute;micos Registrados:</strong></center>
          </td>
          </tr>
      </table>
            
           
          
            
            <!--TABLA DE LOS REGISTROS-->
            <div class="table-responsive">
            <table id="myTableLapso"  class="table table-striped table-hover dt-responsive nowrap compact"  style="cursor :pointer; width :99%"  >
                <thead >
                  <tr >
                    
                    <th ></th>
                    <th>Lapso</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Estatus</th>
                    <th></th>
                   
                  </tr>
                </thead>
                
            </table>
            </div>
    </td>
    </tr>
  </table>
</div>
  
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


    <script>
    $(document).ready(function(){
      $('#myTableLapso').dataTable({
          "language"       : {
          "sProcessing"    : "Procesando...",
          "sLengthMenu"    : "Mostrar _MENU_ Registros",
          "sZeroRecords"   : "No se encontraron Resultados",
          "sEmptyTable"    : "Ningún dato disponible en esta tabla",
          "sInfo"          : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty"     : "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered"  : "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix"   : "",
          "sSearch"        : "Buscar:",
          "sUrl"           : "",
          "sInfoThousands" : ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate"      : {
          "sFirst"         : "Primero",
          "sLast"          : "Último",
          "sNext"          : "Siguiente",
          "sPrevious"      : "Anterior"
          },
          "oAria"          : {
          "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
          },'columnDefs'   : [{
          'targets'        : 5,
          'searchable'     :true,
          'orderable'      :false,
          'className'      : 'dt-body-center'
          
          }] ,
          "aLengthMenu"    : [[5,10,15,25, 50, 75, -1], [5,10,15,25, 50, 75, "Todos"]],
          "iDisplayLength" : 5
          });
      tablaDatosGeneral();

      $("#estatus").selectBoxIt({autoWidth:false , 
        // Uses the jQuery 'fadeIn' effect when opening the drop down
        showEffect: "fadeIn",

        // Sets the jQuery 'fadeIn' effect speed to 400 milleseconds
        showEffectSpeed: 400,

        // Uses the jQuery 'fadeOut' effect when closing the drop down
        hideEffect: "fadeOut",

        // Sets the jQuery 'fadeOut' effect speed to 400 milleseconds
        hideEffectSpeed: 400       });
      Renderidng_select();

    });

  </script>

  
   <script src="../js/dist/js/jquery.amaran.min.js"></script>
   <script src="../js/dist/js/jquery.amaran.js"></script>
  <script src="../js/date/jquery.datetimepicker.js"></script>
   <script type="text/javascript" src="../js/lapso_academico.js"></script>

</body></html>
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
