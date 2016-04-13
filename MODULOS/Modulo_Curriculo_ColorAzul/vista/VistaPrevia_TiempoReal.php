<<<<<<< HEAD
<?php
session_start();

if(isset($_SESSION['id_perfil'])){
$id_perfil=$_SESSION['id_perfil'];
$nombre_perfil=$_SESSION['nombre_perfil'];

$nombre_persona = $_SESSION['persona']; 

}else
{
  $id_perfil=1;
$nombre_perfil="Menú Principal";
echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php'>";
}

?>
<!-- saved from url=(0042)http://www.llobu.net/curriculum_vitae.html -->
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
          
          
          
          

           <link rel="stylesheet" href="../../../Menus/bootstrap/css/bootstrap-toggle.min.css"> 
          <!-- Bootstrap JS -->
                

          <script src="../../../Menus/bootstrap/js/jquery-1.11.3.min.js" ></script>
         


         



        </head>
    

    <body>




        <div class="wrapper container ">
            <div class="resume-holder">

                <div class="resume ">

                    <section id="inicio">


                        <div class="cv-title">
                            <div class="row-fluid">
                                <div class="span3">
                                    <div class="head-title">
                                        <h1><?php echo $nombre_persona;?></h1>
                                        <h3>DESARROLLADOR WEB</h3>
                                    </div>
                                </div>

                                <div class="span7">
                                    <div class="nav-menu">
 										<center><h1>CURRÍCULO</h1></center>
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
                         
                                                </div>
                                                <div class="span9">
                                            <div class="desc text-holder">
                                                <h4><p>
                                                     Profesión:
                                                </p></h4>
                                                            
                                                	       <label id="profesion"></label>
                                            </div>
                                            <div class="desc text-holder">
                                                <h4><p>
                                                     Breve Descripcion:
                                                </p></h4>
                                                	       <label id="descripcion_profesion"></label>
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
                                            <div id="contenedorr_estudios">
                                            
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
                                            <div id="contenedor2_trabajo">
                                            
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

</body>


<script src="../js/vista_previa_tiempo_real.js"></script>
<!-- SUBIR FOTO -->
<script src="../js/AjaxUpload.2.0.min.js"></script>
<link href="../css/estilos.css" type="text/css" rel="stylesheet"/>  
<!-- SUBIR FOTO -->
=======
<?php
session_start();

if(isset($_SESSION['id_perfil'])){
$id_perfil=$_SESSION['id_perfil'];
$nombre_perfil=$_SESSION['nombre_perfil'];

$nombre_persona = $_SESSION['persona']; 

}else
{
  $id_perfil=1;
$nombre_perfil="Menú Principal";
echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php'>";
}

?>
<!-- saved from url=(0042)http://www.llobu.net/curriculum_vitae.html -->
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
          
          
          
          

           <link rel="stylesheet" href="../../../Menus/bootstrap/css/bootstrap-toggle.min.css"> 
          <!-- Bootstrap JS -->
                

          <script src="../../../Menus/bootstrap/js/jquery-1.11.3.min.js" ></script>
         


         



        </head>
    

    <body>




        <div class="wrapper container ">
            <div class="resume-holder">

                <div class="resume ">

                    <section id="inicio">


                        <div class="cv-title">
                            <div class="row-fluid">
                                <div class="span3">
                                    <div class="head-title">
                                        <h1><?php echo $nombre_persona;?></h1>
                                        <h3>DESARROLLADOR WEB</h3>
                                    </div>
                                </div>

                                <div class="span7">
                                    <div class="nav-menu">
 										<center><h1>CURRÍCULO</h1></center>
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
                         
                                                </div>
                                                <div class="span9">
                                            <div class="desc text-holder">
                                                <h4><p>
                                                     Profesión:
                                                </p></h4>
                                                            
                                                	       <label id="profesion"></label>
                                            </div>
                                            <div class="desc text-holder">
                                                <h4><p>
                                                     Breve Descripcion:
                                                </p></h4>
                                                	       <label id="descripcion_profesion"></label>
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
                                            <div id="contenedorr_estudios">
                                            
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
                                            <div id="contenedor2_trabajo">
                                            
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

</body>


<script src="../js/vista_previa_tiempo_real.js"></script>
<!-- SUBIR FOTO -->
<script src="../js/AjaxUpload.2.0.min.js"></script>
<link href="../css/estilos.css" type="text/css" rel="stylesheet"/>  
<!-- SUBIR FOTO -->
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
</html>