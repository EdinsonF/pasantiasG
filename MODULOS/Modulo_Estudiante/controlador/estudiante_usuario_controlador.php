<?php
session_start();


include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$conexion->Conectar();

 
  include('../modelo/mod_estudiante.php');
  include('../../Modulo_Usuario/modelo/mod_usuario.php');
 $estudiante=new estudiante();  
 $usuarios=new usuarios();  




 if(isset($_POST['consultar_estudiante']))
  {  
     
     $Control=new estudiante_controlador();
     $Control->Consultar_Estudiante($_POST);
     
     
  }else  
if(isset($_POST['Registrar'])){

        
        $Control=new estudiante_controlador();
        $Control->Registrar_Usuario_Estudiante($_POST);



    }else if(isset($_POST['Modificar'])){

        
        $Control=new estudiante_controlador();
        $Control->Modificar_Usuario_Estudiante($_POST);



    }else if(isset($_POST['institutos_catalogos']))
  {  
     
     $modelo=new estudiante();
     
     $resultado = $modelo->cargar_modal_istitutos();
     
     $data=array();
     while( $fila=pg_fetch_assoc($resultado))
     {
      $data[]=$fila;
     }
     echo json_encode($data);
  }

    
    
    
    
//-----INICIO DE LA CLASE--->>>
        class estudiante_controlador{
            
            // CONSULTA DE ESTUDIANTES
        
            function Consultar_Estudiante($Formulario=array()){
            

                        $Modelo=new estudiante();
           


                        $num=$Modelo->consultar_estudiante_solo($Formulario);
                        

                    $data=array();
                    while( $fila=pg_fetch_assoc($num))
                    {
                       $id_persona=$fila['id_persona'];
                       $data[]=$fila;
                    }
                   if($data!=null){
                    if($id_persona!="")
                    {
                        $num2=$Modelo->consultar_usuario_estudiante($id_persona);
                           if(pg_num_rows($num2)==0){
                             
                              $data[]="";
                              
                           }else{
                                   while( $fila2=pg_fetch_assoc($num2))
                                     {
                                      $data[]=$fila2;
                                      }
                           }
                    }
                        }     
               

                  //    $num=$Modelo->consultar_estudiante_solo($Formulario);
                 //   $data=array();
                //  while( $fila=pg_fetch_assoc($num))
               //   {
              //  $id_persona=$fila['id_persona'];
             //  if( $id_persona!='' ) $datosusuarios = pg_fetch_assoc($Modelo->consultar_usuario_estudiante($id_persona));
            //  $fila =  array_merge($fila , $datosusuarios) ; 
           //  $data =  $fila ;
          // }
                   
               

                    echo json_encode($data);
           
                        }

                /// FIN DE CONSULTA DE ESTUDIANTE

        function Registrar_Usuario_Estudiante($Formulario=array()){
            
                        $Modelo=new estudiante();
                        
                        $num=$Modelo->Registrar_Usuario_EstudianteBD($Formulario);

                            
                            echo json_encode($num);

                       

                        }

        function Modificar_Usuario_Estudiante($Formulario=array()){
            
                        $Modelo=new estudiante();
                        
                        $num=$Modelo->Modificar_Usuario_EstudianteBD($Formulario);

                            
                            echo json_encode($num);

                       

                        }        
        
          
          
        }//---FIN DE LA CLASE---
          
          
          
?>