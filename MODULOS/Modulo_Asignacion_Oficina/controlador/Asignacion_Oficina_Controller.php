<?php

require_once("../modelo/Asignacion_Oficina.php");
require_once("../../Modulo_Departamento/modelo/Departamento(Especialidad-Oficina).php");






class Asignacion_Oficina_Controller{





 function ActualizarAsignacion($Formulario= array()){

     $Modelo=new Asignacion_Oficina();
            
    $result=$Modelo->ActualizarBD_Asignacion($Formulario);

    echo  json_encode($result);


  }


  function Consultar_Para_RegistrarOficina($Formulario=array()){

                
                
                $Modelo2=new Especialidad($Formulario);
                $num=$Modelo2->Consultar_ParaRegistrar_Office($Formulario['id_organizacion']);
                         
                if($num>0){
                    
                    echo  json_encode($num);
                }else{
                    
                    $this->Registrar_NuevaOficina($Formulario);             
                }
                           
                
            }


function Registrar_NuevaOficina($Formulario=array()){
        
        
                $ID_ORGANIZACION=$Formulario['id_organizacion'];


                $Modelo2=new Especialidad($Formulario);
                $nummer=0;
                $nummer = $Modelo2->Incluir_Oficina($ID_ORGANIZACION);

                if( $nummer==0 ) {

                   echo  json_encode($nummer);


                }else {
                        $nummer=2;
                        echo  json_encode($nummer);

                 }

                 

            }









            /////////////////////////////////////////////////////////////77    

      function Consultar_ParaAsignar($Formulario=array()){

                $Modelo=new Asignacion_Oficina();
            
                $num=$Modelo->CosultarAsignacion($Formulario);


                if($num>0){

                 echo json_encode($num);

                }else{

                 $this->Asignar_Oficina($Formulario);
                  
                }






      }



    
    
     function Asignar_Oficina($Formulario=array()){
        
         
                $Modelo=new Asignacion_Oficina();
            
                $num=$Modelo->Asignacion_OficinaBD($Formulario);

                $ID_ORGANIZACION=$Formulario['ID_ORGANIZACION'];

                if($num==0){

                  echo json_encode($num);
                }
                else{
                  $num=2;
                  echo json_encode($num);
                }



              
             }
            
            
            
           
    
    
    
}

   
          
          ?>