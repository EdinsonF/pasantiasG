<<<<<<< HEAD
<?php
session_start();
include("../../bd/Conect.php");
$conexionBD = new Conexion();
$conexionBD->Conectar();
include_once("../../modelo/mod_categoria.php");


    if(isset($_POST['Registrar'])){
    
   
        $Control=new ctr_categoria();
        $Control->ConsultarPara_Registrar($_POST);
    
    }else if(isset($_POST['Modificar'])){
        
        $Control=new ctr_categoria();
        $Control->ConsultarPara_Modificar($_POST);


    }else if(isset($_POST['Eliminar'])){
        
        $Control=new ctr_categoria();
        $Control->ConsultarPara_Modificar($_POST);

    }

    
    
    
    
//-----INICIO DE LA CLASE--->>>
        class ctr_categoria{
            
 
        function CargarSelect_TipoEspeciualidad(){

            
  
                               $tipo=new TipoEspecialidad();

                               $num=$tipo->Consultar_TipoEspecialidad_Select();

                               while($Registro=pg_fetch_array($num)){

                                $id=$Registro['id_tipo_especialidad'];
                                $nombre=$Registro['nombre_tipo_especialidad'];
                                
                                echo'<option value="'.$id.'">'.$nombre.'</option>';
                              
                
                                }//---FIN DEL WHILE--->>>




        }
          




        function Resgistrar_Categoria($Formulario=array()){

                $Modelo=new categoria($Formulario);

                  
                $nummer=0;
                $nummer = $Modelo->incluir_categoria();


                if( $nummer==0 ) {

                         echo json_encode($nummer);

                }else {
                        $nummer=2;
                        echo json_encode($nummer);
                }
                  
                }
                
                
                
                
                
                //-----MODIFICAR----->>>
                
                 function Modificar_Especialidad($Formulario=array()){
            
                        $Modelo=new categoria($Formulario);
                        
                        $num=$Modelo->Modificar_Categoria();

                        
                        if( $num==0 ) {

                            echo json_encode($num);

                        }else {

                            $nunm=2;
                            echo json_encode($nunm);

                        }


                        }
                        
                        
                        
                        
                   function Consultar_TiempoReal($Dato){
                       
                         
                        
                            $Modelo=new Especialidad();
                                 
                            $Modelo->Consultar_Nombre_TiempoReal($Dato);     
            
        }
        
        
        
        
        function ConsultarPara_Registrar($Formulario=array()){
            
            

            $Modelo=new categoria($Formulario);
                                 
            $num=$Modelo->Consultar_ParaRegistrar(); 
            
            if($num==1){
                
                echo json_encode($num);

                }else {

                   $this->Resgistrar_Categoria($Formulario);

                     }
     
        }
        
        
        
        function ConsultarPara_Modificar($Formulario=array()){
            
            $Modelo=new categoria($Formulario);
                                 
            $num=$Modelo->Consultar_ParaRegistrar(); 
            
            if($num==1){
                
                echo json_encode($num);

                }else {

                   $this->Modificar_Especialidad($Formulario);

                     }
        
            
        }
        
        function llamarOrganizaciones($array=array() )
        {
            
        }
          
          
        }//---FIN DE LA CLASE---
          
          
          
=======
<?php
session_start();
include("../../bd/Conect.php");
$conexionBD = new Conexion();
$conexionBD->Conectar();
include_once("../../modelo/mod_categoria.php");


    if(isset($_POST['Registrar'])){
    
   
        $Control=new ctr_categoria();
        $Control->ConsultarPara_Registrar($_POST);
    
    }else if(isset($_POST['Modificar'])){
        
        $Control=new ctr_categoria();
        $Control->ConsultarPara_Modificar($_POST);


    }else if(isset($_POST['Eliminar'])){
        
        $Control=new ctr_categoria();
        $Control->ConsultarPara_Modificar($_POST);

    }

    
    
    
    
//-----INICIO DE LA CLASE--->>>
        class ctr_categoria{
            
 
        function CargarSelect_TipoEspeciualidad(){

            
  
                               $tipo=new TipoEspecialidad();

                               $num=$tipo->Consultar_TipoEspecialidad_Select();

                               while($Registro=pg_fetch_array($num)){

                                $id=$Registro['id_tipo_especialidad'];
                                $nombre=$Registro['nombre_tipo_especialidad'];
                                
                                echo'<option value="'.$id.'">'.$nombre.'</option>';
                              
                
                                }//---FIN DEL WHILE--->>>




        }
          




        function Resgistrar_Categoria($Formulario=array()){

                $Modelo=new categoria($Formulario);

                  
                $nummer=0;
                $nummer = $Modelo->incluir_categoria();


                if( $nummer==0 ) {

                         echo json_encode($nummer);

                }else {
                        $nummer=2;
                        echo json_encode($nummer);
                }
                  
                }
                
                
                
                
                
                //-----MODIFICAR----->>>
                
                 function Modificar_Especialidad($Formulario=array()){
            
                        $Modelo=new categoria($Formulario);
                        
                        $num=$Modelo->Modificar_Categoria();

                        
                        if( $num==0 ) {

                            echo json_encode($num);

                        }else {

                            $nunm=2;
                            echo json_encode($nunm);

                        }


                        }
                        
                        
                        
                        
                   function Consultar_TiempoReal($Dato){
                       
                         
                        
                            $Modelo=new Especialidad();
                                 
                            $Modelo->Consultar_Nombre_TiempoReal($Dato);     
            
        }
        
        
        
        
        function ConsultarPara_Registrar($Formulario=array()){
            
            

            $Modelo=new categoria($Formulario);
                                 
            $num=$Modelo->Consultar_ParaRegistrar(); 
            
            if($num==1){
                
                echo json_encode($num);

                }else {

                   $this->Resgistrar_Categoria($Formulario);

                     }
     
        }
        
        
        
        function ConsultarPara_Modificar($Formulario=array()){
            
            $Modelo=new categoria($Formulario);
                                 
            $num=$Modelo->Consultar_ParaRegistrar(); 
            
            if($num==1){
                
                echo json_encode($num);

                }else {

                   $this->Modificar_Especialidad($Formulario);

                     }
        
            
        }
        
        function llamarOrganizaciones($array=array() )
        {
            
        }
          
          
        }//---FIN DE LA CLASE---
          
          
          
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
?>