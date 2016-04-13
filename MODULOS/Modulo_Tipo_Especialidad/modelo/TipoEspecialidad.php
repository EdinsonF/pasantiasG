<?php

include_once('../../../BASE_DATOS/Conect.php');

$ConexionBD =new Conexion();
$ConexionBD->Conectar();



class TipoEspecialidad{

private $id_tipo_especialidad;
private $tipo_especialidad;
private $estatus;
private $descripcion;


//----CONTRUCTOR PARA RECIVIR E IGUALAR LAS VARIABLES DEL CONTROLADOS A SUS ATRIBUTOS, EN ARRAYS--->>>>



        
        
        //---CONSULTAR EL NOMBRE POR EL ID--->>>>
        function ConsultarNombre_xId($id_tipo_e){

                $sql="SELECT * FROM pasantias.tipo_especialidad where id_tipo_especialidad=$id_tipo_e ";

                 $result=pg_query($sql);//ejecuta la tira sql

                 $reg=pg_fetch_array($result);

                 $nombre=$reg["nombre_tipo_especialidad"];


                 return $nombre;

        }

        
        
        //-----CONSULTAR TIPO ESPECIALIDAD--->>>
        function Consultar_TipoEspecialidad_BD()
        {

        $sql="SELECT * FROM pasantias.tipo_especialidad where id_tipo_especialidad='$this->id_tipo_especialidad' ";

                 $result=pg_query($sql);//ejecuta la tira sql

                  // LLENAMOS UN ARRAY CON LO QUE ENCUETRA PARA PASARLO AL CONTROLADOR Y DESPUES A LA VISTA--->>>
                 $items = array();
                   while($row = pg_fetch_array($result))
                   {
                     $items[] = $row;
                   }


                 return $items;


        }


        //---CONSULTAR TIPO ESPECIALIDAD, LLENAR SELECT--->>>
        function Consultar_TipoEspecialidad_Select()
        {

        $sql="SELECT * FROM pasantias.tipo_especialidad where  NOT estado=upper('inactivo')  ";

                 $result=pg_query($sql);//ejecuta la tira sql


                 return $result;

        }



        //-----REGISTAR TIPO DE ESPECIALIDAD--->>>
         function Incluir_TipoEspecilidadBD($vista= array())
        {
          $nombre=$vista['nombre'];
          $estatus=$vista['estatus'];
          $descripcion=$vista['descripcion'];

        $strsql=" INSERT INTO pasantias.tipo_especialidad (nombre_tipo_especialidad, estado, descripcion) VALUES ('$nombre', '$estatus', '$descripcion') "; 

        $result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


                          $registro =0;
                          $registro = pg_affected_rows($result);

                  pg_free_result($result);

        return $registro;

        }




        //-----CARGAR CATALAGO DE REGISTROS--->>>
        function CargarCatalago_BD(){


                $sql="SELECT * FROM pasantias.tipo_especialidad";

                $result=pg_query($sql);

                return $result;

        }


        //-----modifica--->>>>
        function Modificar_TipoEspecilidad_BD($vista=array())
        {
          $id=$vista['id'];
          $nombre=$vista['nombre'];
          $estatus=$vista['estatus'];
          $descripcion=$vista['descripcion'];


        $strsql=" UPDATE pasantias.tipo_especialidad SET nombre_tipo_especialidad='$nombre', estado='$estatus', descripcion='$descripcion' WHERE id_tipo_especialidad=$id "; 

        $result = pg_query($strsql) or die('ERROR AL MODIFICAR DATOS: ' . pg_last_error());


                          $registro =0;
                          $registro = pg_affected_rows($result);

                  pg_free_result($result);

        return $registro;

        }
        
        
        
        //------CONSULTA QUE ACTIVA EL JS--->>>
        function ConsultaBD_ParaRegistrar($Formulario=array()){
    

            $Dato=$Formulario['nombre'];
    
            $sql = "SELECT * FROM pasantias.tipo_especialidad where nombre_tipo_especialidad='".$Dato."'";
            $result= pg_query($sql);

            $num=pg_num_rows($result);

            return $num;
        
    
}



       function ConsultaBD_ParaModificar($Formulario=array()){
           
          
                  $Dato=$Formulario['tipo_e'];
                  $Dato2=$Formulario['estatus'];
                  $Dato3=$Formulario['descripcion'];
          

                  $sql = "SELECT * FROM pasantias.tipo_especialidad where nombre_tipo_especialidad='".$Dato."' AND estado='".$Dato2."' AND descripcion='".$Dato3."'";
                  $result= pg_query($sql);

                  $num=pg_num_rows($result);

                  return $num;
              
          
      }
      
      
      
      
      function Consultar_Nombre_TiempoReal($Dato)
{
    

$sql="SELECT * FROM pasantias.tipo_especialidad WHERE nombre_tipo_especialidad = '".$Dato."' ";
	 	 
	 $result=pg_query($sql);//ejecuta la tira sql
         
         $num=pg_num_rows($result);
                            
                            if(!$num) {

                                
                            }else {
                                echo'<div id=""></div><font color="red" size="1" >Este nómbre ya existe en la base de datos</font>';

                               
                             }
	 
	 
}








}//---FIN DE LA CLASES....
?>