<?php
session_start();
$IdPersona=$_SESSION['id_persona'];
if(isset($_SESSION['id_perfil'])){
  $id_perfil=$_SESSION['id_perfil'];
$nombre_perfil=$_SESSION['nombre_perfil'];
echo "<input type=hidden id=action value=consultar >";
$nombre_persona = $_SESSION['persona'];

}else
{
  $id_perfil=1;
$nombre_perfil="Menú Principal";
echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php'>";
}
?>

<html class=" webkit chrome win js"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



        <!--[if lt IE 9]>
	    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	    <![endif]-->
        <title>Curriculum </title>
               
		  <!--    MENU CUERPO-->

            <link type="text/css" rel="stylesheet" href="./complementos/style.blog.css">        
            <link type="text/css" rel="stylesheet" href="./complementos/responsive.css">        
            

        <link rel="stylesheet" href="../../../Menus/bootstrap/css/bootstrap.css">
          <link rel="stylesheet" href="../../../Menus/bootstrap/css/bootstrap.min22.css">
          <link rel="stylesheet" href="../../../Menus/bootstrap/css/bootstrap-theme.css">
          <link rel="stylesheet" href="../../../Menus/bootstrap/css/bootstrap-theme.min.css">
          
          <link rel="stylesheet" href="../../../Menus/bootstrap/css/sticky-footer-navbar.css">
          <link rel="stylesheet" href="../../../Menus/bootstrap/bootstrap-menu/dist/css/bootstrap-submenu.min.css">
          <link rel="stylesheet" href="../../../Menus/bootstrap/bootstrap-menu/dist/css/docs.css">
          <link rel="stylesheet" href="../../../Menus/bootstrap/css/typeahead.css"> 

           <link rel="stylesheet" href="../../../Menus/bootstrap/css/bootstrap-toggle.min.css"> 
          <!-- Bootstrap JS -->
                

          <script src="../../../Menus/bootstrap/js/jquery-1.11.3.min.js" ></script>
          <script src="../../../Menus/bootstrap/js/bootstrap.min.js" defer=""></script>
          <script src="../../../Menus/bootstrap/js/bootstrap.js" defer=""></script>


          <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/bootstrap.js" defer=""></script>

          <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/highlight.min.js" defer=""></script>
          <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/bootstrap-submenu.js" defer=""></script>
          <script src="../../../Menus/bootstrap/bootstrap-menu/dist/js/docs.js" defer=""></script>
          <script src="../../../Menus/bootstrap/js/modal.js" defer=""></script>
          <script src="../../../Menus/bootstrap/js/alert.js" ></script>
          <script src="../../../Menus/bootstrap/js/typeahead.js" ></script> 
          <script src="../../../Menus/bootstrap/js/tooltip.js" ></script>
          <script src="../../../Menus/bootstrap/js/bootstrap-toggle.min.js" ></script> 
          <script src="../../../Menus/bootstrap/js/popover.js" ></script>

          <!-- MESNAJES CALIDA OPERACIONES -->
            <link rel="stylesheet" href="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.css">
            <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.js"></script>
            <script type="text/javascript" src="../../Modulo_Estado/js/sweetalert-master/lib/sweet-alert.min.js"></script>
           <!-- MESNAJES CALIDA OPERACIONES-->
   
        </head>
    

    <body>
    <?php

include("../../../BASE_DATOS/Conect.php");
$conexionBD = new Conexion();
$conexionBD->Conectar();
include("../../Modulo_Usuario/modelo/mod_usuario.php");
  $persona= new usuarios();

$persona->menu($id_perfil , $nombre_perfil , $_SESSION['nombre_instituto'] ,$nombre_persona );
    ?>



        <div class="wrapper container ">
            <div class="resume-holder">

                <div class="resume ">

                    <section id="inicio">


                        <div class="cv-title">
                            <div class="row-fluid">
                                <div class="span3">
                                    <div class="head-title">
                                        <h1><?php echo $nombre_persona;?></h1>
                                    </div>
                                </div>

                                <div class="span7">
                                    <div class="nav-menu">
 										<center><font size="20">CURRÍCULO</font></center>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="about-desc">
                            <p><h4>Datos Personales:</h4>
                                <?php echo $nombre_persona;?>, Estudiante de <?php echo $_SESSION['nombre_especialidad']; ?> <br>
                                en <?php echo $_SESSION['nombre_instituto']; ?>.

                            </p>
                        </div>

                    </section>


                    <section id="perfil">
                        <div class="row-fluid">
                            <div class="span1">
                           
                                <div class="section-title">
                                    <div class="section-icon">
                                        <img  src="complementos/datosPersonales.png" width="25"> 
                                    </div>
                                    <header class="title">
                                        <h3 class="rotate">PERFIL</h3>
                                    </header>
                                </div>
                            </div>
                            <div class="span11">
                                <div class="box-holder">
                                    <div class="row-fluid">
                                        <div class="span3" align="center">

                                            <div class="avatar">
                                                                                      
                                                    <img id="fotografia"  src="../images/imagesDefaul/Default.jpg">
                                                      
                                            </div>
                                            <br> 
                                            <button id="addImage" class="btn btn-primary btn-sm">Cambiar Imagen <img  src="complementos/image.png" width="15"></button>

                                                <div class="loaderAjax" id="loaderAjax">
                                                    <img src="../images/imagesDefaul/default-loader.gif">
                                                    <span>Publicando Fotografía...</span>
                                                </div>
                                                                         
                                                </div>
                                                <div class="span9">
                                            <div class="desc text-holder">
                                                <p>
                                                     <font size="4" FACE="arial">Profesión:</font>
                                                </p>
                                                    <input type="hidden" id="id_persona" name="id_persona" value="<?php echo $IdPersona;?>" >
                                                    <input type="hidden" id="id_curriculo" name="id_curriculo" value="" >
                                                    <br>
                                                	<input type="text" id="profesion" name="profesion" placeholder="PROFESIÓN" onkeyup="this.value=this.value.toUpperCase()">
                                                    
                                            </div>
                                            <div class="desc text-holder">
                                                <p>
                                                    <font size="4" FACE="arial">Breve Descripción:</font>
                                                </p>
                                                	<textarea name="descripcion_profesion" id="descripcion_profesion" placeholder="BREVE DESCRIPCIÓN DE SU DESEMPEÑO, SEGUN SU PROFESIÓN..." onkeyup="this.value=this.value.toUpperCase()" rows="3" ></textarea>
                                            </div>    

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--  fin de informacion personal -->
                    
					        



                    
                    <!-- inicio de educacion -->
                    <section id="educacion">
                         <div class="row-fluid">
                            <div class="span1">

                                <div class="section-title">
                                    <div class="section-icon">
                                        <img  src="complementos/educacion.png" width="25">
                                    </div>
                                    <header class="title">
                                        <h3 class="rotate">EDUCACIÓN</h3>
                                    </header>
                                </div>
                            </div>

                            <!-- INICIO DE SECCION -->
                            <div class="span11">
                                <div class="box-holder exp-box">
                                     <div class="row-fluid timeline-holder">
                                        <div class="span12">
                                            <!-- AGREGAR CAMPO -->
                                            
                                            <div class="added">
                                            <div class="contenedorr_estudios">
                                                    <!-- AGREGAR SECCION -->
                                                    <article class="exp-item">
                                                    <div class="FormacionAcademica">
                                                        <div class="exp-holder">
                                                        <!-- AGREGAR OTRA SECCION -->
                                                        <button type="button" id="agregarCampo_estudio"  class="btn btn-primary btn-sm"><img  src="complementos/add.png" width="18"> Agragar sección</button>
                                                            <div class="head">
                                                                <input type="hidden" id="id_formacionAcademica0" class="formacion_academica" name="formacion_academica[]">
                                                                <div class="date-range">Fecha:<input type="date" id="inicio_curso0" class="inicio_curso" name="inicio_curso[]">-<input type="date" id="fin_curso0" class="fin_curso" name="fin_curso[]"></div>
                                                                <br><h4>Nómbre Instituto:</h4><br><input type="text" id="nombre_instituto0" class="form-control" name="nombre_instituto[]" placeholder="NOMBRE DE LA INSTITUCION DONDE EJERCIÓ SUS ESTUDIOS, SEGUN EL AÑO" onkeyup="this.value=this.value.toUpperCase()">                                                        
                                                            </div>
                                                            <div class="body"><br>
                                                                <h4><font color="#6E6E6E">Descripción</font></h4>
                                                                <textarea name="descripcion_obtencion[]" id="descripcion_obtencion0" class="descripcion_obtencion" rows="3" placeholder="DESCRIPCIÓN DE SU TITUTLO OBTENIDO Ó GRADOS CURSADO..." onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </article>

                                            <!-- FIN AGRAGAR SECCION -->
                                            </div>
                                            </div>
                                            <!-- FIN AGREGAR SECCION-->
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- FIN DE SECCION -->

                            
                        </div>
                        <hr> 
                    </section> 

                    <!-- fin de educacion -->






                    <!--  inicio de experiencia laboral -->
                    <section id="educacion">
                         <div class="row-fluid">
                            <div class="span1">

                                <div class="section-title">
                                    <div class="section-icon">
                                        <img  src="complementos/experienciaLaboral.png" width="25">    
                                    </div>
                                    <header class="title">
                                        <h3 class="rotate">EXPERIENCIA LABORAL</h3>
                                                                                
                                    </header>
                                </div>
                            </div>

                            <!-- INICIO DE SECCION -->
                            <div class="span11">
                                <div class="box-holder exp-box">
                                     <div class="row-fluid timeline-holder">
                                        <div class="span12">
                                            <!-- AGREGAR CAMPO -->
                                            
                                            <div class="added">
                                                    <!-- AGREGAR SECCION -->
                                                    <div class="contenedor2_trabajo">
                                                    <article class="exp-item">
                                                    <div class="ExperienciaLaboral">
                                                        <div class="exp-holder">
                                                        <!-- AGREGAR OTRA SECCION -->
                                                        <button type="button" id="agregarCampo_Trabajo"  class="btn btn-primary btn-sm"><img  src="complementos/add.png" width="18"> Agragar sección</button>
                                                            <div class="head">
                                                                <input type="hidden" id="id_experienciaLaboral0" class="experiencia_laboral" name="experiencia_laboral[]">
                                                                <div class="date-range">Fecha:<input type="date" id="inicio_empleo0" name="inicio_empleo[]" class="inicio_empleo">-<input type="date" id="fin_empleo0" name="fin_empleo[]" class="fin_empleo"></div>
                                                                <br><h4>Nómbre Empresa:</h4><br><input type="text" id="nombre_empresa0" name="nombre_empresa[]" class="form-control" placeholder="NOMBRE DE LA INSTITUCION O EMPRESA DONDE HA TRABAJADO" onkeyup="this.value=this.value.toUpperCase()"> <br><br>
                                                                <h4>Cargo:</h4><input type="text" id="cargo_en_empresa0" name="cargo_en_empresa[]" class="cargo_en_empresa" size="40" placeholder="CARGO EJERCIDO" onkeyup="this.value=this.value.toUpperCase()">

                                                            </div>
                                                            <div class="body"><br>
                                                                <h4><font color="#6E6E6E">Descripción De Su Función</font></h4>
                                                                <textarea name="funcion_en_empresa[]" class="funcion_en_empresa" id="funcion_en_empresa0" rows="3" placeholder="BREVE DESCRIPCIÓN DE SU FUNCIÓN Y DESEMPEÑO EN DICHA EMPRESA..." onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </article>
                                                    </div>
                                            <!-- FIN AGRAGAR SECCION -->
                                            
                                            </div>
                                            <!-- FIN AGREGAR SECCION-->
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- FIN DE SECCION -->

                            
                        </div>
                        <hr> 
                    </section> 

                    <!-- fin de experiencia laboral -->

                    <center>
                    <input type="button" id="Registrar" value="Registrar"  class="btn btn-primary btn-large" name="Registrar" >
                    <input type="button" id="Actualizar" value="Actualizar"  class="btn btn-primary btn-large" name="Actualizar" >
                    
                    <button id="VistaPrevia" name="VistaPrevia" class="btn btn-primary btn-large" value="Ver"><img src="complementos/ver.png" width="20"></button></center>
</body>
<script src="../js/curriculo.js"></script>

<!-- SUBIR FOTO -->
<script src="../js/AjaxUpload.2.0.min.js"></script>
<link href="../css/estilos.css" type="text/css" rel="stylesheet"/>  
<!-- SUBIR FOTO -->
</html>