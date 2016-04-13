<?php
session_start();


include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$conexion->Conectar();

 
 
  include('../modelo/mod_usuario.php');
  
 $usuarios=new usuarios();  




 if(isset($_POST['consultar_pregunta_usuario']))
  {  
     
     $Control=new recuperar_usuarios();
     $Control->consultar_pregunta($_POST);
     
     
  }else if(isset($_POST['consultar_usuario']))
  {  
     
     $Control=new recuperar_usuarios();
     $Control->consultar_usuario_contrasena($_POST);
     
     
  }
  
    
    
    
    
//-----INICIO DE LA CLASE--->>>
        class recuperar_usuarios{
            
                  
            function consultar_pregunta($Formulario=array()){
            

                        $Modelo=new usuarios();
           


                        $num=$Modelo->consultar_pregunta_usuario($Formulario);
                        

                    $data=array();
                    while( $fila=pg_fetch_assoc($num))
                    {
                      
                       $data[]=$fila;
                    }
                   
                                     
               

                    echo json_encode($data);
           
                        }

  function consultar_usuario_contrasena($Formulario=array()){
            

                        $Modelo=new usuarios();
           


                        $num=$Modelo->consultar_usuario_y_contrasena($Formulario);
                        

                    $data=array();
                    while( $fila=pg_fetch_assoc($num))
                    {
                      
                       $data[]=$fila;
                    }
                   
                                     
               

                    echo json_encode($data);
           
                        }               

       
          
        }//---FIN DE LA CLASE---
          
          
          
?>