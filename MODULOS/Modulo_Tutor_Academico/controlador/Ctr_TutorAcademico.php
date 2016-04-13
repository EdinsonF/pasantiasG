<<<<<<< HEAD
<?php
session_start();


include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$conexion->Conectar();

 
  include('../modelo/mod_estudiante.php');

  
 
  
if(isset($_POST['TablaE_Tutores'])){

        $ID_INSTITUCION=$_SESSION['ID_INSTITUCION'];
         $estudiante=new estudiante();
         $Result=$estudiante->ConsultarTutoresAcademicosBD($ID_INSTITUCION);
         $arreglo=array();

         while($registro=pg_fetch_array($Result)){

            $arreglo[]=$registro;
         }

         echo json_encode($arreglo);



    }

    
    
    
    
//-----INICIO DE LA CLASE--->>>
        class estudiante_controlador{
            
        

           
        
          
          
        }//---FIN DE LA CLASE---
          
          
          
=======
<?php
session_start();


include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$conexion->Conectar();

 
  include('../modelo/mod_estudiante.php');

  
 
  
if(isset($_POST['TablaE_Tutores'])){

        $ID_INSTITUCION=$_SESSION['ID_INSTITUCION'];
         $estudiante=new estudiante();
         $Result=$estudiante->ConsultarTutoresAcademicosBD($ID_INSTITUCION);
         $arreglo=array();

         while($registro=pg_fetch_array($Result)){

            $arreglo[]=$registro;
         }

         echo json_encode($arreglo);



    }

    
    
    
    
//-----INICIO DE LA CLASE--->>>
        class estudiante_controlador{
            
        

           
        
          
          
        }//---FIN DE LA CLASE---
          
          
          
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
?>