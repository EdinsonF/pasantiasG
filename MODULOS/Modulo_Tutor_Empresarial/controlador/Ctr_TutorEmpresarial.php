<?php
session_start();


include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$conexion->Conectar();

 include('../modelo/mod_tutor_empresarial.php');

  
if(isset($_POST['TablaE_Tutores'])){

       $id_sucursal  =$_SESSION['codigo_sucursal'];
         $modelo=new tutor_empresarial();
         $Result=$modelo->ConsultarTutoresEmpresarialesBD($id_sucursal);
         $arreglo=array();

         while($registro=pg_fetch_array($Result)){

            $arreglo[]=$registro;
         }

         echo json_encode($arreglo);



    }

    
    
    
    
//-----INICIO DE LA CLASE--->>>
        class estudiante_controlador{
            
        

           
        
          
          
        }//---FIN DE LA CLASE---
          
          
          
?>