<?php 

if(!isset($_SESSION)) 
    { 
        session_start();

    } 

include("../modelo/Departamento(Especialidad-Oficina).php");
require_once("../reportes/Control_Reportes.php");


if(isset($_POST['Registrar'])){
    
    $Control=new Gestion_Oficina_Controller();
    $Control->Consultar_Para_Registrar($_POST);
    
    
      
}else if(isset($_POST['Modificar'])){
        //----MODIFICAR NORMAL
        $Control=new Gestion_Oficina_Controller();
        $Control->ConsultarPara_Modificar($_POST);
        //var_dump($_POST);

    }else if(isset($_POST['Modificar2'])){
        //----MODIFICAR ACTUALIZANDO TODOOO--->>>
        $Especialidad=new Especialidad($_POST);
        $Datos=$Especialidad->Incluir_NuevaOficina_Asignar_y_TraspasarPersonas($_POST['id_organizacion_p']);
        echo json_decode($Datos);



    }else if(isset($_POST['Modificar3'])){
        //----MODIFICAR ACTUALIZANDO TODOOO--->>>
        $Especialidad=new Especialidad($_POST);
        $Datos=$Especialidad->RealizarNuevaAsignacion_TraspasandoDatosPersonas($_POST['id_organizacion_p']);
        echo json_decode($Datos);



    }else if(isset($_POST['Modificar4'])){
        //----MODIFICAR ACTUALIZANDO TODOOO--->>>
        $Especialidad=new Especialidad($_POST);
        $Datos=$Especialidad->ActualizarTodasLasTablas_TraspasandoPersonas_INTERNAMENTE($_POST['id_organizacion_p']);
        echo json_decode($Datos);



    }else if(isset($_POST['Modificar5'])){
        //----MODIFICAR ACTUALIZANDO TODOOO--->>>
        $Especialidad=new Especialidad($_POST);
        $Datos=$Especialidad->ModificarEstatus_OficinasTraspandoBD($_POST['id_organizacion_p']);
        echo json_decode($Datos);



    }else if(isset($_POST['autocompletado'])){

    	$Especialidad=new Especialidad();
      $Datos=$Especialidad->ConsultarNombre_Oficinas_AutoComplete();



    }else if(isset($_POST['Asignar_Persona'])){

        $Control=new Gestion_Oficina_Controller();
        $Control->AsignarPersona_OrganizacioOficina($_POST);


    }else if(isset($_POST['Tabla_Oficina'])){
        //------TABLA ESPECIALIDAD LOADING....
        $Especialidad=new Especialidad();
        $Datos=$Especialidad->Consultar_Oficina_Catalago($_POST['id_organizacion']);

        $lista=array();
        while($fila=pg_fetch_array($Datos))
          {
            $lista[] = $fila;
          }
          echo json_encode($lista);


    }else if(isset($_POST['TablaE_AsignarPersonas'])){
        //------TABLA ESPECIALIDAD LOADING....
        $Especialidad=new Especialidad();
        $Datos=$Especialidad->Consultar_Oficina_Catalago($_POST['id_organizacion']);

        $lista=array();
        while($fila=pg_fetch_array($Datos))
          {
            $lista[] = $fila;
          }
          echo json_encode($lista);
    }else if(isset($_POST['Tabla_PersonasAsignadas'])){
        //------TABLA ESPECIALIDAD LOADING....
        $Especialidad=new Especialidad();
        $Datos=$Especialidad->CargarCatalago_PersonasAsignadas_Ofciinas($_POST['id_organizacion']);

        $lista=array();
        while($fila=pg_fetch_array($Datos))
          {
            $lista[] = $fila;
          }
          echo json_encode($lista);

          ////// R E P O R T E S----->>>
    }else if(isset($_POST['Reporte'])){

        

        $Reporte=new Control_Reportes();
        $Reporte->ReporteGeneral_Oficinas($_SESSION['codigo_sucursal'],$_SESSION['nombre_instituto']);



    }else if(isset($_POST['Reporte_HistorialOficinas'])){

        

        $Reporte=new Control_Reportes();
        $Reporte->Reporte_HistorialOfcinas($_SESSION['codigo_sucursal'],$_SESSION['nombre_instituto']);



    }else if(isset($_POST['Reporte_PersonasAsignadas'])){

        

        $Reporte=new Control_Reportes();
        $Reporte->Reporte_PersonasAsignas_MisOficinas($_SESSION['codigo_sucursal'],$_SESSION['nombre_instituto']);


    }else if(isset($_POST['Reporte_PE_PorFecha'])){

          if(isset($_SESSION['Reporte_PE_PorFecha'])){
             unset($_SESSION['Reporte_PE_PorFecha']);
             unset($_SESSION['fecha_i']);
             unset($_SESSION['fecha_f']);
          } 

        $_SESSION['Reporte_PE_PorFecha']=$_POST['Reporte_PE_PorFecha'];
        $_SESSION['fecha_i']=$_POST['fecha_i'];
        $_SESSION['fecha_f']=$_POST['fecha_f'];


        echo json_encode($_SESSION['Reporte_PE_PorFecha']);


    }else if(isset($_SESSION['Reporte_PE_PorFecha'])){

        unset($_SESSION['Reporte_PE_PorFecha']);

        $Reporte=new Control_Reportes();
        $Reporte->Reporte_PersonasAsignas_MisOficinas_Fecha($_SESSION['codigo_sucursal'], $_SESSION['fecha_i'], $_SESSION['fecha_f']);

        

    }




class Gestion_Oficina_Controller{

    
    
    function AsignarPersona_OrganizacioOficina($Formulario=array()){

        $Modelo =new Especialidad();

        $num=$Modelo->AsignarPersona_Oficina_Organizacion($Formulario);

        echo json_encode($num);




    }
    
    
     function Registrar_Oficina($Formulario=array()){
        
                $ID_ORGANIZACION_P=$Formulario['id_organizacion_p'];
                $Modelo=new Especialidad($Formulario);
                
                
                $nummer=0;
                $nummer = $Modelo->Incluir_Oficina($ID_ORGANIZACION_P);


                if( $nummer==0 ) {

                   echo json_encode($nummer);


                }else {

                    $nummer=2;

                    echo json_encode($nummer);


                 }

            }
            
            
            
            function Consultar_Para_Registrar($Formulario=array()){
                
                $ID_ORGANIZACION_P=$Formulario['id_organizacion_p'];
                
                $Modelo=new Especialidad($Formulario);
                $num=$Modelo->Consultar_ParaRegistrar_Office($ID_ORGANIZACION_P);
                
                
                if($num){
                    
                   echo json_encode($num);
                }else{
                    
                    $this->Registrar_Oficina($Formulario);
                    
                    
                }
                           
                
            }
            
            
            
            
            
             function Consultar_TiempoReal($Dato){
                                
                        
                            $Modelo=new Especialidad();
                                 
                            $Modelo->Consultar_Nombre_TiempoReal_Office($Dato);     
            
        }
        
        
        
        
        function ConsultarPara_Modificar($Formulario=array()){
            
            $ID_ORGANIZACION_P=$Formulario['id_organizacion_p'];
            $Modelo=new Especialidad($Formulario);
                                 
            $num=$Modelo->Consultar_ParaModificar_Office($ID_ORGANIZACION_P); 
            
            if($num==1){
                
                  echo json_encode($num);

                }else {

                   $this->Modificar_Oficina($Formulario);

                     }
        
            
        }
        
        
        
        
        function Modificar_Oficina($Formulario=array()){   

                        $ID_ORGANIZACION_P=$Formulario['id_organizacion_p'];

                        $Modelo=new Especialidad($Formulario);
                        
                        $num=$Modelo->Modificar_Office($ID_ORGANIZACION_P);         

                           echo json_encode($num);
                        }


 
}

   
          
          ?>