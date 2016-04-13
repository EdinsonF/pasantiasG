<?php
session_start();



include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$conexion->Conectar();

 
  include('../modelo/mod_estudiante.php');
  include('../../Modulo_Usuario/modelo/mod_usuario.php');
 $estudiante=new estudiante();  
 $usuarios=new usuarios();  




   
if(isset($_POST['Registrar'])){

        
        $Control=new estudiante_controlador();
        $Control->Registrar_Datos_Basico_Estudiante($_POST);



    }else if(isset($_POST['Modificar'])){

        
        $Control=new estudiante_controlador();
        $Control->Modificar_Datos_Basico_Estudiante($_POST);



    }

    
    
    
    
//-----INICIO DE LA CLASE--->>>
        class estudiante_controlador{
            
        

        function Registrar_Datos_Basico_Estudiante($Formulario=array()){
            
                        $Modelo=new estudiante();
                        
                        $num=$Modelo->Registrar_Datos_Basico_EstudianteBD($Formulario);

                            
                            echo json_encode($num);

                       

                        }

        function Modificar_Datos_Basico_Estudiante($Formulario=array()){
            
                        $Modelo=new estudiante();
                        
                        $num=$Modelo->Modificar_Datos_Basico_EstudianteBD($Formulario);

                            
                            echo json_encode($num);

                       

                        }        
        
          
          
        }//---FIN DE LA CLASE---
          
          
          
?>