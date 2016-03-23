<?php
session_start();

require_once("../modelo/TutorEmpresarial.php");
require_once("../../Modulo_Departamento/modelo/Departamento(Especialidad-Oficina).php");

if(isset($_GET['Reporte']))
    {
      require_once("../reportes/Control_Reportes.php"); 

      if($_GET['Reporte']=='MisAsignaciones')
      {
        $clase = new Control_Reportes ();
        $clase->Reporte_PersonasAsignas_MisOficinas($_SESSION['codigo_sucursal'],$_SESSION['nombre_organizacion']);
      }
    
    }



 if(isset($_POST['Registrar'])){
    
    $Control=new Tutor_Controller();
    $Control->Registrar_NuevaPersona($_POST);
    
      
}else if (isset($_POST['Modificar'])) {
  # code...

    $Control=new Tutor_Controller();
    $Control->ActualizarPersona($_POST);

}else if(isset($_POST['autocompletado'])){

      $mod=new ModTutor();
      $Datos=$mod->ConsultarNombre_Cedula_AutoComplete();

      echo json_encode($Datos);

    }



class Tutor_Controller{



function CargarSelect_Oficinas($ID_ORGANIZACION){

            
  
                               $mod=new Especialidad();

                               $num=$mod->Consultar_Oficina_Catalago($ID_ORGANIZACION);

                               while($Registro=pg_fetch_array($num)){

                                $id=$Registro['id_oficina'];
                                $nombre=$Registro['nombre_oficina'];
                                
                                echo'<option value="'.$id.'">'.$nombre.'</option>';
                              
                
                                }//---FIN DEL WHILE--->>>
        }



 function ActualizarPersona($Formulario= array()){

    $Modelo=new ModTutor();
            
    $result=$Modelo->ActualizarBD_Asignacion($Formulario);

    echo  json_encode($result);


  }


 /* function Consultar_Para_RegistraPersona($Formulario=array()){

                
                
                $Modelo=new ModTutor();
                $num=$Modelo->Consultar_ParaRegistrar();
                         
                if($num){
                    
                    echo  json_encode($num);
                }else{
                    
                    $this->Registrar_NuevaPersona($Formulario);             
                }
                           
                
            }*/


function Registrar_NuevaPersona($Formulario=array()){
        
                $Modelo=new ModTutor();
                $nummer=0;
                $nummer = $Modelo->AsignarPersona_Oficina_Organizacion($Formulario);

                   echo  json_encode($nummer);

                 

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



    
    
  
            
            
            
           
    
    
    
}

   
          
          ?>