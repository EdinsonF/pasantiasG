<<<<<<< HEAD
<?php
$ranStr = md5(microtime());
$ranStr = substr($ranStr, 0, 6);
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
  
<!-- MESNAJES CALIDA OPERACIONES -->
    <link rel="stylesheet" href="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.css">
    <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.js"></script>
    <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.min.js"></script>
   <!-- MESNAJES CALIDA OPERACIONES-->
  
  </head>

  <body style="padding-top: 20px;">

<!--inicio del menu -->

<?php

include("../../../BASE_DATOS/Conect.php");
$conexionBD = new Conexion();
$conexionBD->Conectar();
include("../../Modulo_Usuario/modelo/mod_usuario.php");
$persona= new usuarios();



$persona->menu(1, "Menú Principal" ,'','');
?>
 
<!-- Fin De MENU-->

<div align="center">
        <div style="width: 30%">
        <table class="table table-bordered">
          <tr class="well">
              <td><h4 align="center">Inicio Sesión</h4></td>
            </tr>
          <tr>
            <td>
                        <!--
                        <form name="form" action="../controlador/iniciar_sesion.php" method="post">
                        -->
                          <center>                           
                            <input type="hidden" id="num" name="num" value="1" placeholder="Usuario" autocomplete="off" width="95%" maxlength="10" required><br>    
                              
                             
                              <strong>Usuario:</strong><br>
                              <input type="text" id="usuario" name="usuario" value="" class="form-control" placeholder="Usuario" autocomplete="off" width="95%" maxlength="10" required><br>    
                              <strong>Contraseña:</strong><br>
                              <input type="password" id="contrasena" name="contrasena" value="" class="form-control" placeholder="Contraseña" autocomplete="off" width="95%" maxlength="8" required><br>
                                <!-- inicio del captcha -->
                                <strong>Ingrese El Siguiente Código:</strong>
                                <input type="hidden" id="captcha_a" name="captcha_a" value="<?php echo $ranStr; ?>">
                                <div style="background-image:url(captcha/cap_bg.jpg); width:48%;">
                                <h3><?php echo $ranStr; ?></h3>
                                </div>
                                <input type="text" id="captcha_b" name="captcha" value="" class="form-control" placeholder="Código" autocomplete="off" width="95%" maxlength="10" required><br>
                                <!--Fin del Captcha -->

                              <input type="submit" id="ingresar" value="Ingresar" class="btn btn-lg btn-primary btn-block">
                              <a href="#" id="recuperar_contraseña">olvidaste la contraseña?<a>
                  </center>

                     <!-- </form>  -->
                </td>
          </tr>
        </table>
    </div></div>

    <!--  MODAL RECUPERAR CONTRASEÑA  -->
      <div id="recuperar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">    
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3  align="center">Recuperar Contraseña<br></h3>
   
    </div>
    <div class="modal-body" align="center">
    <input type="hidden"  id="id_persona" value="">
    <input type="hidden"  id="id_usuario" value="">
      
          
<div class="row" id="for_consulta">
  <div class="col-lg-6">
    <div class="input-group">
     <label><h5>Ingrese Su Número De Cédula</h5></label>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  <div class="col-lg-6">
    <div class="input-group">
       
      <input type="text" id="cedula_recuperar_contrasena" name="cedula" class="form-control" autocomplete="off" maxlength="8" placeholder="Cédula" onkeypress="return numeros(event);">
      <span class="input-group-btn">
        <button id="consultar_recuperar_contrasena" class="btn btn-primary" type="button" >Consultar</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->


  <div class="well well-lg" id="mostar_dato_p"><label id="nombre_apellido"></label> &nbsp;&nbsp;su pregunta de seguridad para recuperar su contraseña es la siguiente:&nbsp;&nbsp;<label id="pregunta"></label></div>
   
    <div class="row" id="rspuesta_mostrar">
  <div class="col-lg-6">
    <div class="input-group">
     <label><h5>Ingrese Su Respuesta</h5></label>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  <div class="col-lg-6">
    <div class="input-group">
       
      <input type="text" id="respuesta" name="respuesta" class="form-control" autocomplete="off" placeholder="Respuesta">
      <span class="input-group-btn">
        <button id="verificar_respuesta" class="btn btn-primary" type="button" >Verificar</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->


 <div class="well well-lg" id="mostar_usuario_contraseña">Su Usuario es:&nbsp;&nbsp;<label id="usuario_recuperado"></label><br>su Contraseña es:&nbsp;&nbsp;<label id="contrasena_recuperado"></label></div>

    </div>  
    <div class="modal-footer">
    <button  class="btn" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong>
    </button>
  </div>
    
    </div>
    </div>
    </div>





    <div id="Modals" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
    <div class="modal-content">    
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4  class="modal-title"  align="center">Elije una Organizaci&oacute;n</h4>
    
    </div>
    <div class="modal-body" align="center">
    <h4 id="Personad" align="left"></h4>
    <input type="hidden"  id="id_persona" value="">
    <table class="display dataTable"  id="myTable">

    <thead>
      <tr>

          <td><center> <strong> Perf&iacute;l</strong> </center> 
            
          </td>
          <td><center> <strong> Organizaci&oacute;n</strong> </center> 
            
          </td>   
          <td><center> <strong> Estado - Municipio</strong> </center>           
       
      </tr>
    </thead>

    </table>

    </div>  
    <div class="modal-footer">
    <button id="cerrarSwite" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong>
    </button>
  </div>
    </div>
    </div></div>

    <!--Modal bloqueo -->
      <div id="Modal_Bloqueo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      	<div class="modal-dialog">
    <div class="modal-content"> 
     <div class="modal-header">
    
    <h3  align="center">LLego al maximo de intentos<br></h3>
    <h4 id="Personad"></h3>
    </div>
    <div class="modal-body" align="center">
    USTED FUE BLOQUEADO POR SEGURIDAD INTENTE NUEVAMENTE CUANDO SE CIERRE ESTA VENTANA
     <center><img src="../js/256.png" border="0"/></center>
    
    </div>  
      </div></div>  
      </div>
    <!--Fin Modal Bloqueo -->
      <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables_themeroller.css" rel="stylesheet">

    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.js"></script>
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.min.js"></script>
     <!--   Mensajes-->
 <script src="../js/dist/js/jquery.amaran.min.js"></script>
 <script src="../js/dist/js/jquery.amaran.js"></script>
   <!--  FIN  Mensajes-->
 <script src="../js/inicio_sesion.js"></script>
<footer class="footer">
      
        <p  style=" color:#fff"> &nbsp; SISTEMA PARA EL CONTROL DE PRÁCTICAS PROFESIONALES Y EGRESADOS - S.I.C.P.P.E © </p>
      
    </footer>


</body></html>
=======
<?php
$ranStr = md5(microtime());
$ranStr = substr($ranStr, 0, 6);
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
  
<!-- MESNAJES CALIDA OPERACIONES -->
    <link rel="stylesheet" href="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.css">
    <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.js"></script>
    <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.min.js"></script>
   <!-- MESNAJES CALIDA OPERACIONES-->
  
  </head>

  <body style="padding-top: 20px;">

<!--inicio del menu -->

<?php

include("../../../BASE_DATOS/Conect.php");
$conexionBD = new Conexion();
$conexionBD->Conectar();
include("../../Modulo_Usuario/modelo/mod_usuario.php");
$persona= new usuarios();



$persona->menu(1, "Menú Principal" ,'','');
?>
 
<!-- Fin De MENU-->

<div align="center">
        <div style="width: 30%">
        <table class="table table-bordered">
          <tr class="well">
              <td><h4 align="center">Inicio Sesión</h4></td>
            </tr>
          <tr>
            <td>
                        <!--
                        <form name="form" action="../controlador/iniciar_sesion.php" method="post">
                        -->
                          <center>                           
                            <input type="hidden" id="num" name="num" value="1" placeholder="Usuario" autocomplete="off" width="95%" maxlength="10" required><br>    
                              
                             
                              <strong>Usuario:</strong><br>
                              <input type="text" id="usuario" name="usuario" value="" class="form-control" placeholder="Usuario" autocomplete="off" width="95%" maxlength="10" required><br>    
                              <strong>Contraseña:</strong><br>
                              <input type="password" id="contrasena" name="contrasena" value="" class="form-control" placeholder="Contraseña" autocomplete="off" width="95%" maxlength="8" required><br>
                                <!-- inicio del captcha -->
                                <strong>Ingrese El Siguiente Código:</strong>
                                <input type="hidden" id="captcha_a" name="captcha_a" value="<?php echo $ranStr; ?>">
                                <div style="background-image:url(captcha/cap_bg.jpg); width:48%;">
                                <h3><?php echo $ranStr; ?></h3>
                                </div>
                                <input type="text" id="captcha_b" name="captcha" value="" class="form-control" placeholder="Código" autocomplete="off" width="95%" maxlength="10" required><br>
                                <!--Fin del Captcha -->

                              <input type="submit" id="ingresar" value="Ingresar" class="btn btn-lg btn-primary btn-block">
                              <a href="#" id="recuperar_contraseña">olvidaste la contraseña?<a>
                  </center>

                     <!-- </form>  -->
                </td>
          </tr>
        </table>
    </div></div>

    <!--  MODAL RECUPERAR CONTRASEÑA  -->
      <div id="recuperar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">    
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3  align="center">Recuperar Contraseña<br></h3>
   
    </div>
    <div class="modal-body" align="center">
    <input type="hidden"  id="id_persona" value="">
    <input type="hidden"  id="id_usuario" value="">
      
          
<div class="row" id="for_consulta">
  <div class="col-lg-6">
    <div class="input-group">
     <label><h5>Ingrese Su Número De Cédula</h5></label>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  <div class="col-lg-6">
    <div class="input-group">
       
      <input type="text" id="cedula_recuperar_contrasena" name="cedula" class="form-control" autocomplete="off" maxlength="8" placeholder="Cédula" onkeypress="return numeros(event);">
      <span class="input-group-btn">
        <button id="consultar_recuperar_contrasena" class="btn btn-primary" type="button" >Consultar</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->


  <div class="well well-lg" id="mostar_dato_p"><label id="nombre_apellido"></label> &nbsp;&nbsp;su pregunta de seguridad para recuperar su contraseña es la siguiente:&nbsp;&nbsp;<label id="pregunta"></label></div>
   
    <div class="row" id="rspuesta_mostrar">
  <div class="col-lg-6">
    <div class="input-group">
     <label><h5>Ingrese Su Respuesta</h5></label>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
  <div class="col-lg-6">
    <div class="input-group">
       
      <input type="text" id="respuesta" name="respuesta" class="form-control" autocomplete="off" placeholder="Respuesta">
      <span class="input-group-btn">
        <button id="verificar_respuesta" class="btn btn-primary" type="button" >Verificar</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->


 <div class="well well-lg" id="mostar_usuario_contraseña">Su Usuario es:&nbsp;&nbsp;<label id="usuario_recuperado"></label><br>su Contraseña es:&nbsp;&nbsp;<label id="contrasena_recuperado"></label></div>

    </div>  
    <div class="modal-footer">
    <button  class="btn" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong>
    </button>
  </div>
    
    </div>
    </div>
    </div>





    <div id="Modals" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
    <div class="modal-content">    
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4  class="modal-title"  align="center">Elije una Organizaci&oacute;n</h4>
    
    </div>
    <div class="modal-body" align="center">
    <h4 id="Personad" align="left"></h4>
    <input type="hidden"  id="id_persona" value="">
    <table class="display dataTable"  id="myTable">

    <thead>
      <tr>

          <td><center> <strong> Perf&iacute;l</strong> </center> 
            
          </td>
          <td><center> <strong> Organizaci&oacute;n</strong> </center> 
            
          </td>   
          <td><center> <strong> Estado - Municipio</strong> </center>           
       
      </tr>
    </thead>

    </table>

    </div>  
    <div class="modal-footer">
    <button id="cerrarSwite" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><strong>Cerrar</strong>
    </button>
  </div>
    </div>
    </div></div>

    <!--Modal bloqueo -->
      <div id="Modal_Bloqueo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      	<div class="modal-dialog">
    <div class="modal-content"> 
     <div class="modal-header">
    
    <h3  align="center">LLego al maximo de intentos<br></h3>
    <h4 id="Personad"></h3>
    </div>
    <div class="modal-body" align="center">
    USTED FUE BLOQUEADO POR SEGURIDAD INTENTE NUEVAMENTE CUANDO SE CIERRE ESTA VENTANA
     <center><img src="../js/256.png" border="0"/></center>
    
    </div>  
      </div></div>  
      </div>
    <!--Fin Modal Bloqueo -->
      <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../../Modulo_tipoOrganizacion/js/js_tabla/media/css/jquery.dataTables_themeroller.css" rel="stylesheet">

    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.js"></script>
    <script src="../../Modulo_tipoOrganizacion/js/js_tabla/media/js/jquery.dataTables.min.js"></script>
     <!--   Mensajes-->
 <script src="../js/dist/js/jquery.amaran.min.js"></script>
 <script src="../js/dist/js/jquery.amaran.js"></script>
   <!--  FIN  Mensajes-->
 <script src="../js/inicio_sesion.js"></script>
<footer class="footer">
      
        <p  style=" color:#fff"> &nbsp; SISTEMA PARA EL CONTROL DE PRÁCTICAS PROFESIONALES Y EGRESADOS - S.I.C.P.P.E © </p>
      
    </footer>


</body></html>
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
