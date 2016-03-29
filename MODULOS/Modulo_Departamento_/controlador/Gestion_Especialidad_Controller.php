<?php
session_start();

require_once("../modelo/Departamento(Especialidad-Oficina).php");
require_once('../../Modulo_Tipo_Especialidad/modelo/TipoEspecialidad.php');
require_once("../reportes/Control_Reportes.php");


if(isset($_POST['Registrar'])){
    
   
        $Control=new Gestion_Especialidad_Controller();
        $Control->ConsultarPara_Registrar($_POST);
    
    }else if(isset($_POST['Modificar'])){
        //----MODIFICACION NOMRAL--->>>
        $Control=new Gestion_Especialidad_Controller();
        $Control->Modificar_Especialidad($_POST);


    }else if(isset($_POST['Modificar2'])){
        //-----MODIFICACION , INSERCION EN LA INTERMEDIA CON TRASPASO DE ESTUDIANTES--->>
        $Especialidad=new Especialidad($_POST);
        $Retorno=$Especialidad->RealizarNuevaAsignacion_TraspasandoDatosEstudiantes($_POST['id_instituto'], $_SESSION['codigo_encargado'], $_POST['list']);

        echo json_encode($Retorno);


    }else if(isset($_POST['Modificar3'])){
        //-----MODIFICACION , REALIZANDO UN NUEVO REGISTRO DESDE LA MAESTRA--->>
        $Especialidad=new Especialidad($_POST);
        $Retorno=$Especialidad->Incluir_NuevaEspecialidad_Asignar_y_TraspasarEstudiantes($_POST['id_instituto'], $_SESSION['codigo_encargado'], $_POST['list']);

        echo json_encode($Retorno);


    }else if(isset($_POST['Modificar4'])){
        //-----MODIFICACION , MODIFICAR TODO--->>
        $Especialidad=new Especialidad($_POST);
        $Retorno=$Especialidad->ActualizarTodasLasTablas_TraspasandoEstudiantes_INTERNAMENTE($_POST['id_instituto'], $_SESSION['codigo_encargado'], $_POST['list']);

        echo json_encode($Retorno);


    }else if(isset($_POST['Modificar5'])){
        //-----MODIFICACION , CAMBIAR ESTATUS--->>
        $Especialidad=new Especialidad($_POST);
        $Retorno=$Especialidad->ModificarEstatusEspecialidadBD($_POST['id_instituto'], $_SESSION['codigo_encargado'], $_POST['list']);

        echo json_encode($Retorno);


    }else if(isset($_POST['Asignar_Estudiante'])){

        
        $Control=new Gestion_Especialidad_Controller();
        $Control->AsignarEstudiante_Especialidad($_POST);

    }else if(isset($_POST['Asignar_TutorAcademico'])){

        
        $Control=new Gestion_Especialidad_Controller();
        $Control->AsignarTutorAcademico_Especialidad($_POST);



    }else if(isset($_POST['autocompletado'])){

      $Especialidad=new Especialidad();
      $Datos=$Especialidad->ConsultarNombre_Especialidad_AutoComplete();



    }else if(isset($_POST['autocompletado_personasCedula'])){

      $Especialidad=new Especialidad();
      $Datos=$Especialidad->ConsultarCedulaPersonas_Autocomplete();



    }else if(isset($_POST['autocompletado_personasExpediente'])){

      $Especialidad=new Especialidad();
      $Datos=$Especialidad->ConsultarExpedientePersonas_Autocomplete($_POST['instituto_principal']);



    }else if(isset($_POST['autocompletado_personasCodigo'])){

      $Especialidad=new Especialidad();
      $Datos=$Especialidad->ConsultarCodigoPersonas_Autocomplete($_POST['instituto_principal']);



    }else if(isset($_POST['BuscarTodosDatosCedulaSeleccionada'])){

      $Especialidad=new Especialidad();
      $Datos=$Especialidad->ConsultarPersonas_Autocomplete($_POST['BuscarTodosDatosCedulaSeleccionada']);
      


    }else if(isset($_POST['BuscarTodosDatosExpedienteSeleccionado'])){

      $Especialidad=new Especialidad();
      $Datos=$Especialidad->ConsultarPersonas_AutocompleteExpedinete($_POST['BuscarTodosDatosExpedienteSeleccionado'],$_POST['instituto_principal']);
      


    }else if(isset($_POST['BuscarTodosDatosCodigoSeleccionado'])){

      $Especialidad=new Especialidad();
      $Datos=$Especialidad->ConsultarPersonas_AutocompleteCodigo($_POST['BuscarTodosDatosCodigoSeleccionado'],$_POST['instituto_principal']);
      


    }else if(isset($_POST['Tabla_Especialidad'])){
        //------TABLA ESPECIALIDAD LOADING....
        $Especialidad=new Especialidad();
        $Datos=$Especialidad->Consultar_Especialidad_Catalago($_POST['id_instituto']);

        $lista=array();
        while($fila=pg_fetch_array($Datos))
          {
            $lista[] = $fila;
          }
          echo json_encode($lista);


    }else if(isset($_POST['TablaE_AsignarPersonas'])){
        //------TABLA ESPECIALIDAD LOADING....
        $Especialidad=new Especialidad();
        $Datos=$Especialidad->Consultar_Especialidad_Catalago($_POST['id_instituto']);

        $lista=array();
        while($fila=pg_fetch_array($Datos))
          {
            $lista[] = $fila;
          }
          echo json_encode($lista);


    }else if(isset($_POST['Temporada_Curso'])){

        
        $Especialidad=new Especialidad();
        $Datos=$Especialidad->ConsultarTamporada_Modificacion($_POST['id_especialidad'],$_SESSION['codigo_encargado']);

        $lista=array();
        while($fila=pg_fetch_array($Datos))
          {
            $lista[] = $fila;
          }
          echo json_encode($lista);


    }else if(isset($_POST['Tabla_PersonasAsignadas'])){
        //------TABLA ESPECIALIDAD LOADING....
        $Especialidad=new Especialidad();
        $Datos=$Especialidad->Consultar_AsignacionEspecialidad_PErsona($_POST['id_instituto']);

        $lista=array();
        while($fila=pg_fetch_array($Datos))
          {
            $lista[] = $fila;
          }
          echo json_encode($lista);
          /////////////////////-----R E P O R T E S---->>>>
    }else if(isset($_POST['Reporte'])){

        

        $Reporte=new Control_Reportes();
        $Reporte->ReporteGeneral_Especialidades($_SESSION['ID_INSTITUCION'],$_SESSION['nombre_instituto']);



    }else if(isset($_POST['Reporte_Tipo'])){

        

        $Reporte=new Control_Reportes();
        $Reporte->Reporte_Espec_Tipo($_SESSION['ID_INSTITUCION'],$_SESSION['nombre_instituto'], $_POST['tipo_especialidad']);

    }else if(isset($_POST['Reporte_HistorialEspecialidad'])){

        

        $Reporte=new Control_Reportes();
        $Reporte->Reporte_HistorialEspecialidad($_SESSION['ID_INSTITUCION'],$_SESSION['nombre_instituto']);

    }else if(isset($_POST['Reporte_PersonasAsignadas'])){

        

        $Reporte=new Control_Reportes();
        $Reporte->Reporte_PersonasAsignas_MisEspecilidades($_SESSION['ID_INSTITUCION'],$_SESSION['nombre_instituto']);

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
        $Reporte->Reporte_PersonasAsignas_Fecha($_SESSION['ID_INSTITUCION'], $_SESSION['fecha_i'], $_SESSION['fecha_f']);

        

    }

    
    
    
    
//-----INICIO DE LA CLASE--->>>
        class Gestion_Especialidad_Controller{
            
 

        function CargarSelect_TipoEspeciualidad(){

            
  
                               $tipo=new TipoEspecialidad();

                               $num=$tipo->Consultar_TipoEspecialidad_Select();

                               while($Registro=pg_fetch_array($num)){

                                $id=$Registro['id_tipo_especialidad'];
                                $nombre=$Registro['nombre_tipo_especialidad'];
                                
                                echo'<option value="'.$id.'">'.$nombre.'</option>';
 
                                }//---FIN DEL WHILE--->>>




        }
          




        function Resgistrar_Especialidad($Formulario=array()){

                $Modelo=new Especialidad($Formulario);

                  
                $nummer=0;
                $nummer = $Modelo->Incluir_Especialidad($Formulario['id_instituto']);


                if( $nummer==0 ) {

                         echo json_encode($nummer);

                }else {
                        $nummer=2;
                        echo json_encode($nummer);
                }
                  
                }
                
                
                
                
                
                //-----MODIFICAR----->>>
                
                 function Modificar_Especialidad($Formulario=array()){
            
                        $Modelo=new Especialidad($Formulario);
                        
                        $num=$Modelo->Modificar_EspecialidadBD($Formulario['id_instituto']);

                        
                        if( $num==0 ) {

                            echo json_encode($num);

                        }else {

                            
                            echo json_encode($num);

                        }


                        }
                        
                        
                        
                        
                   function Consultar_TiempoReal($Dato){
                       
                         
                        
                            $Modelo=new Especialidad();
                                 
                            $Modelo->Consultar_Nombre_TiempoReal($Dato);     
            
        }
        
        
        
        
        function ConsultarPara_Registrar($Formulario=array()){
            
            

            $Modelo=new Especialidad($Formulario);
                                 
            $num=$Modelo->Consultar_ParaRegistrar($Formulario['id_instituto']); 
            
            if($num==1){
                
                echo json_encode($num);

                }else {

                   $this->Resgistrar_Especialidad($Formulario);

                     }
     
        }
        
        
        
        // function ConsultarPara_Modificar($Formulario=array()){
            
        //     $Modelo=new Especialidad($Formulario);
                                 
        //     $num=$Modelo->Consultar_ParaModificar($Formulario['id_instituto']); 
            
        //     if($num==1){
                
        //         echo json_encode($num);

        //         }else {

        //            $this->Modificar_Especialidad($Formulario);

        //              }
        
            
        // }



        

        function AsignarEstudiante_Especialidad($Formulario=array()){
            
          $Modelo=new Especialidad();
          
          $num=$Modelo->AsignarEstudiante_EspecialidadBD($Formulario);

              
              echo json_encode($num);

                       

          }


        function AsignarTutorAcademico_Especialidad($Formulario=array()){

        $Modelo=new Especialidad();
        
        $num=$Modelo->AsignarTutorAcademico_EspecialidadBD($Formulario);

            
            echo json_encode($num);

       

        }

        
        
          
          
        }//---FIN DE LA CLASE---
          
          
          
?>