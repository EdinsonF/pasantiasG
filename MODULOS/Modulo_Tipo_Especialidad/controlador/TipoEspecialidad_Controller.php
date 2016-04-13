<<<<<<< HEAD
<?php
session_start();

include("../modelo/TipoEspecialidad.php");
        
//--------------------CONDICIONES PARA LOS BOTONES---------------------------------->>>

        
        
   //---SI PRESIONA REGISTRAR--->>>
    if(isset($_POST['Registrar'])){
        
  
                $Control=new TipoEspecialidad_Controller();                
                $Control->Consulta_Para_Registrar($_POST);


        //---SI PRESIONA MODIFICAR--->>>
   }else if(isset($_POST["cancelar"])){
              
          //echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/Gestion_TipoEspecialidad.php'>";

          }else if(isset($_POST["RecargarTab"])){

            $Tipo=new TipoEspecialidad();

            $Datos=$Tipo->CargarCatalago_BD();

            $lista=array();
            while($fila=pg_fetch_array($Datos))
              {
                $lista[] = $fila;
              }
              echo json_encode($lista);
              
          }else if(isset($_POST['Reporte'])){

        require_once("../reportes/Control_Reportes.php");

        $Reporte=new Control_Reportes();
        $Reporte->Reporte_TipoEspecialidad();

    }
          
          
          
	
        
          //--------------------INICIO DE LA CLASE---->>>

        class TipoEspecialidad_Controller{
            
            
            //--------FUNCIONES QUE LLAMAN AL MODELO PARA EJECUTAR LA RESPECTIVA CONSULTA--->>>>

            
            //-----REGISTRAR TIPO ESPECIALIDAD--->>>
            function Incluir_TipoEspecialidad($Formulario=array()){
                
                $TipoEspecialidad=new TipoEspecialidad();
                
                $nummer=0;
                $nummer = $TipoEspecialidad->Incluir_TipoEspecilidadBD($Formulario);


                if( $nummer==0 ) {

                   echo json_encode($nummer);


                }else {

                        $retor=2;

                        echo json_encode($retor);

                 }

                    }//----FIN DE REGISTRAR--->>>
                    
                    
  
                    
                    
            //--------MODIFICAR TIPO ESPECIALIDAD------>>>
                    
            function Modificar_TipoEspecialidad($Formulario=array()){
             
                      //---ENVIO AL CONTRUCTOR--->>>
                      $TipoEspecialidad=new TipoEspecialidad();

                      $num=$TipoEspecialidad->Modificar_TipoEspecilidad_BD($Formulario);


                          echo json_encode($num);

             
         }//----FIN FUNCTION MODICAR...
         
         
         
         
         //-----CONSULTA EN TIEMPO REAL PARA HABILITAR Y DESABILITAR EL BOTON REGISTARR--->>
         function Consulta_Para_Registrar($Formulario=array()){
             
             //---ENVIO AL CONTRUCTOR--->>>
             $TipoEspecialidad=new TipoEspecialidad();
             
             $Retorna=$TipoEspecialidad->ConsultaBD_ParaRegistrar($Formulario);
       
       
               if($Retorna==1){

                echo json_encode($Retorna);

               
                }else{

                $this->Incluir_TipoEspecialidad($Formulario);


        }
         }
        
        
        
        
             //-----CONSULTA EN TIEMPO REAL PARA HABILITAR Y DESABILITAR EL BOTON REGISTARR--->>
         function RealizarConsulta_Para_Modificar($Formulario=array()){
             
             //---ENVIO AL CONTRUCTOR--->>>
             $TipoEspecialidad=new TipoEspecialidad();
             
             $Retorna=$TipoEspecialidad->ConsultaBD_ParaModificar($Formulario);
       
       
             if($Retorna){
    


               
                }else{

                $this->Modificar_TipoEspecialidad($Formulario);


        }
             
             
         }
         
         
         
         
         
         function Consultar_TiempoReal($Dato){
                       
                         
                            $Modelo=new TipoEspecialidad();
                               
                            $Modelo->Consultar_Nombre_TiempoReal($Dato);
                            
            
        }
                    
                    
                     
          
        //---FIN DE LA CLASE...  
        }
=======
<?php
session_start();

include("../modelo/TipoEspecialidad.php");
        
//--------------------CONDICIONES PARA LOS BOTONES---------------------------------->>>

        
        
   //---SI PRESIONA REGISTRAR--->>>
    if(isset($_POST['Registrar'])){
        
  
                $Control=new TipoEspecialidad_Controller();                
                $Control->Consulta_Para_Registrar($_POST);


        //---SI PRESIONA MODIFICAR--->>>
   }else if(isset($_POST["cancelar"])){
              
          //echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../vista/Gestion_TipoEspecialidad.php'>";

          }else if(isset($_POST["RecargarTab"])){

            $Tipo=new TipoEspecialidad();

            $Datos=$Tipo->CargarCatalago_BD();

            $lista=array();
            while($fila=pg_fetch_array($Datos))
              {
                $lista[] = $fila;
              }
              echo json_encode($lista);
              
          }else if(isset($_POST['Reporte'])){

        require_once("../reportes/Control_Reportes.php");

        $Reporte=new Control_Reportes();
        $Reporte->Reporte_TipoEspecialidad();

    }
          
          
          
	
        
          //--------------------INICIO DE LA CLASE---->>>

        class TipoEspecialidad_Controller{
            
            
            //--------FUNCIONES QUE LLAMAN AL MODELO PARA EJECUTAR LA RESPECTIVA CONSULTA--->>>>

            
            //-----REGISTRAR TIPO ESPECIALIDAD--->>>
            function Incluir_TipoEspecialidad($Formulario=array()){
                
                $TipoEspecialidad=new TipoEspecialidad();
                
                $nummer=0;
                $nummer = $TipoEspecialidad->Incluir_TipoEspecilidadBD($Formulario);


                if( $nummer==0 ) {

                   echo json_encode($nummer);


                }else {

                        $retor=2;

                        echo json_encode($retor);

                 }

                    }//----FIN DE REGISTRAR--->>>
                    
                    
  
                    
                    
            //--------MODIFICAR TIPO ESPECIALIDAD------>>>
                    
            function Modificar_TipoEspecialidad($Formulario=array()){
             
                      //---ENVIO AL CONTRUCTOR--->>>
                      $TipoEspecialidad=new TipoEspecialidad();

                      $num=$TipoEspecialidad->Modificar_TipoEspecilidad_BD($Formulario);


                          echo json_encode($num);

             
         }//----FIN FUNCTION MODICAR...
         
         
         
         
         //-----CONSULTA EN TIEMPO REAL PARA HABILITAR Y DESABILITAR EL BOTON REGISTARR--->>
         function Consulta_Para_Registrar($Formulario=array()){
             
             //---ENVIO AL CONTRUCTOR--->>>
             $TipoEspecialidad=new TipoEspecialidad();
             
             $Retorna=$TipoEspecialidad->ConsultaBD_ParaRegistrar($Formulario);
       
       
               if($Retorna==1){

                echo json_encode($Retorna);

               
                }else{

                $this->Incluir_TipoEspecialidad($Formulario);


        }
         }
        
        
        
        
             //-----CONSULTA EN TIEMPO REAL PARA HABILITAR Y DESABILITAR EL BOTON REGISTARR--->>
         function RealizarConsulta_Para_Modificar($Formulario=array()){
             
             //---ENVIO AL CONTRUCTOR--->>>
             $TipoEspecialidad=new TipoEspecialidad();
             
             $Retorna=$TipoEspecialidad->ConsultaBD_ParaModificar($Formulario);
       
       
             if($Retorna){
    


               
                }else{

                $this->Modificar_TipoEspecialidad($Formulario);


        }
             
             
         }
         
         
         
         
         
         function Consultar_TiempoReal($Dato){
                       
                         
                            $Modelo=new TipoEspecialidad();
                               
                            $Modelo->Consultar_Nombre_TiempoReal($Dato);
                            
            
        }
                    
                    
                     
          
        //---FIN DE LA CLASE...  
        }
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
?>