<?php

require_once("../../../BASE_DATOS/Conect.php");

 $ConexionBD =new Conexion();
 $ConexionBD->Conectar();

class Especialidad{


public $id;
public $id_tipo_especialidad;
public $estatus;
public $descripcion;
public $nombre;


//---CONSTRUCTOR--->>
public function __construct( $Vista =array() )
	{
    if(isset($Vista['id'])&&(isset($Vista['tipo_especialidad'])))
      {//----MODIFICAR ESPECIALIDAD--->>>
        $this->id                   = $Vista['id'];
        $this->nombre               = $Vista['nombre'];
        $this->id_tipo_especialidad = $Vista['tipo_especialidad'];
        
        $this->estatus              = $Vista['estatus'];
        $this->descripcion          = $Vista['descripcion'];
      }else if(isset($Vista['tipo_especialidad']))
      {//--REGISTRAR ESPECIALIDAD--->>>
        $this->nombre               = $Vista['nombre'];
        $this->id_tipo_especialidad = $Vista['tipo_especialidad'];
        
        $this->estatus              = $Vista['estatus'];
        $this->descripcion          = $Vista['descripcion'];
      }else if(isset($Vista['id']))
      {//----MODIFICAR OFICINA---->>>
        //var_dump($Vista);
        $this->id                   = $Vista['id'];
        $this->nombre               = $Vista['nombre'];
        $this->estatus              = $Vista['estatus'];
        $this->descripcion          = $Vista['descripcion'];
      }else if(isset($Vista['nombre']))
      {//----REGISTRAR OFICINA------>>>>
        $this->nombre               = $Vista['nombre'];
        $this->estatus              = $Vista['estatus'];
        $this->descripcion          = $Vista['descripcion'];
      }else {
        
      }
  
    

		

                
		
	}//---FIN DEL CONTRUCTOR---->>








function Consultar_Especialidad_Catalago($id_instituto)
{

$sql=" SELECT especialidad.id_especialidad, especialidad.nombre_especialidad, especialidad.id_tipo_especialidad,nombre_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, especialidad_instituto_principal.observacion FROM pasantias.especialidad  
       JOIN  pasantias.departamento ON  especialidad.id_departamento = departamento.id_departamento
             JOIN  pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_especialidad = especialidad.id_especialidad
             JOIN  pasantias.instituto_principal ON instituto_principal.id_ip =especialidad_instituto_principal.id_ip 
             JOIN  pasantias.organizacion ON organizacion.id_organizacion = instituto_principal.id_organizacion
             JOIN  pasantias.tipo_especialidad ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad
              WHERE especialidad_instituto_principal.id_ip='$id_instituto' AND especialidad_instituto_principal.estatus!='MODIFICADO' ";
	 	 
	 $result=pg_query($sql);//ejecuta la tira sql

	

	 return $result;
	 
}



function Consultar_AsignacionEspecialidad_PErsona($id_instituto)
{

$sql="SELECT cedula, persona.nombre , persona.apellido ,perfil.id_perfil, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
 especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
 especialidad_instituto_principal.observacion FROM pasantias.persona
 
 JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona = persona.id_persona
 JOIN pasantias.especialidad ON persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad
 JOIN pasantias.instituto_principal ON instituto_principal.id_ip= persona_instituto_especialidad.id_ip
 JOIN pasantias.tipo_especialidad ON especialidad.id_tipo_especialidad = tipo_especialidad.id_tipo_especialidad
 JOIN pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_ip = instituto_principal.id_ip
  and instituto_principal.id_ip=$id_instituto
AND especialidad_instituto_principal.id_especialidad = persona_instituto_especialidad.id_especialidad 
AND  especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip 
iNNER JOIN pasantias.perfil ON perfil.id_perfil = persona_instituto_especialidad.id_perfil  ;  ";
     
   $result=pg_query($sql);//ejecuta la tira sql

  

   return $result;
   
}


function Consultar_EspecialidadActiva_Catalago(){

  $sql="SELECT * FROM pasantias.especialidad  , pasantias.departamento WHERE

 pasantias.especialidad.id_departamento  = pasantias.departamento.id_departamento AND pasantias.departamento.estado='ACTIVO'   ";
     
   $result=pg_query($sql);//ejecuta la tira sql

  

   return $result;


}



function Incluir_Especialidad($id_instituto)
{
	if($this->descripcion==null){
  	$this->descripcion='SIN DESCRIPCIÓN';

  }

          $sql="SELECT id_especialidad FROM pasantias.especialidad_instituto_principal WHERE 
              especialidad_instituto_principal.id_especialidad=(SELECT id_especialidad FROM pasantias.especialidad WHERE
              nombre_especialidad = '$this->nombre' AND id_tipo_especialidad='$this->id_tipo_especialidad');";

                 $result=pg_query($sql);//ejecuta la tira sql

                 $num=pg_num_rows($result);

                 $resultado=pg_fetch_array($result);

                 $id_especialidad=$resultado['id_especialidad'];

                 if($num>0){


                        $strsql3=" INSERT INTO pasantias.especialidad_instituto_principal ( id_ip , id_especialidad , estatus, descripcion ) 

                        VALUES ( '$id_instituto' ,'$id_especialidad' , 'ACTIVO', '$this->descripcion') "; 

                        $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


                                          $registro =0;
                                          $registro = pg_affected_rows($result3);

                                  

                        return $registro;




                 }else{


  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $strsql=" INSERT INTO pasantias.departamento ( estado,descripcion  ) 

            VALUES ( 'ACTIVO' , 'NO DESCRIPCION' ) "; 

             $result=pg_query($strsql);//ejecuta la tira sql

///////////////////////////////////////////////////////////////////////////////////////////////////////////////


            $sql = " SELECT * FROM pasantias.ultimoid_departamento ";

            $result=pg_query($sql);//ejecuta la tira sql

                            $id_departamento = 0 ;



                            while($fila = pg_fetch_array($result)){

                            $id_departamento = $fila['id'];

                                    }


  ////////////////////////////////////////                            /////////////////////////////////////////////////////

            $strsql2=" INSERT INTO pasantias.especialidad ( id_departamento , nombre_especialidad , id_tipo_especialidad ) 

            VALUES ( '$id_departamento' ,'$this->nombre' , '$this->id_tipo_especialidad') "; 

            $result2 = pg_query($strsql2) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                        


            

            $sql22 = " SELECT MAX(id_especialidad) as id_especialidad FROM pasantias.especialidad";

            $result22=pg_query($sql22);//ejecuta la tira sql

                            

                            $fila2 = pg_fetch_array($result22);

                            $id_especialidad = $fila2[0];

                                    

/////////////////////////////////////                                    ////////////////////////////////////



            $strsql3=" INSERT INTO pasantias.especialidad_instituto_principal ( id_ip , id_especialidad , estatus, descripcion ) 

            VALUES ( '$id_instituto' ,'$id_especialidad' , 'ACTIVO', '$this->descripcion') "; 

            $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


                              $registro =0;
                              $registro = pg_affected_rows($result3);

                      

            return $registro;
          }




}





//------REALIZAR OTRO REGISTRO Y ASIGNAR DE UNA VEZ---->>>
    function Incluir_NuevaEspecialidad_Asignar($id_instituto){

      $strsql=" INSERT INTO pasantias.departamento( estado,descripcion  ) 

            VALUES ( 'ACTIVO' , 'NO DESCRIPCION' ) "; 

             $result=pg_query($strsql);//ejecuta la tira sql

///////////////////////////////////////////////////////////////////////////////////////////////////////////////


            $sql = " SELECT * FROM pasantias.ultimoid_departamento ";

            $result=pg_query($sql);//ejecuta la tira sql

                            $id_departamento = 0 ;

                            $fila = pg_fetch_array($result);

                            $id_departamento = $fila['id'];

      
  ////////////////////////////////////////                            /////////////////////////////////////////////////////

            $strsql2=" INSERT INTO pasantias.especialidad ( id_departamento , nombre_especialidad , id_tipo_especialidad ) 

            VALUES ( '$id_departamento' ,'$this->nombre' , '$this->id_tipo_especialidad') "; 

            $result2 = pg_query($strsql2) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                        


            $sql22 = " SELECT MAX(id_especialidad) as id_especialidad FROM pasantias.especialidad";

            $result22=pg_query($sql22);//ejecuta la tira sql

                            

                            $fila2 = pg_fetch_array($result22);

                            $id_especialidad = $fila2[0];

                                    

/////////////////////////////////////                                    ////////////////////////////////////



            $strsql3=" INSERT INTO pasantias.especialidad_instituto_principal ( id_ip , id_especialidad , estatus, descripcion ) 

            VALUES ( '$id_instituto' ,'$id_especialidad' , 'ACTIVO', '$this->descripcion') "; 

            $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


                              $registro =0;
                              $registro = pg_affected_rows($result3);

                      

            return $registro;


             

 }///-------FIN DE ASIGNAR NUEVA ESPECIALIDAD Y ASIGNAR----->







function Consultar_ParaModificar($id_instituto)
        {


        $sql="SELECT especialidad.id_especialidad, especialidad.nombre_especialidad, especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, especialidad_instituto_principal.observacion FROM pasantias.especialidad  
             JOIN  pasantias.departamento ON  especialidad.id_departamento = departamento.id_departamento
             JOIN  pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_especialidad = especialidad.id_especialidad
             JOIN  pasantias.instituto_principal ON instituto_principal.id_ip =especialidad_instituto_principal.id_ip 
             INNER JOIN   pasantias.organizacion ON organizacion.id_organizacion = instituto_principal.id_organizacion 
             JOIN  pasantias.tipo_especialidad ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad
             WHERE especialidad.nombre_especialidad = '$this->nombre' AND especialidad.id_tipo_especialidad='$this->id_tipo_especialidad' AND 
         especialidad_instituto_principal.estatus='$this->estatus' AND especialidad_instituto_principal.descripcion='$this->descripcion' AND especialidad_instituto_principal.id_ip=$id_instituto;";

                 $result=pg_query($sql);//ejecuta la tira sql

                 $num=pg_num_rows($result);

              return $num;
        }



//////////////////////--------------EN  C O N T R U N C I O N------------------>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>


function Modificar_EspecialidadBD($id_instituto){

  $retorno=0;

  if($this->descripcion==null){
  	$this->descripcion='SIN DESCRIPCIÓN';

  }
//-----CONSULTO EL NOMBRE Y TIPO ANTERIOR--->>>
  $sqll=pg_query("SELECT nombre_especialidad, id_tipo_especialidad FROM pasantias.especialidad WHERE id_especialidad='$this->id'");
  $respuesta=pg_fetch_array($sqll);
  $nombre_e=$respuesta[0];
  $tipo_e=$respuesta[1];
  
  if(($nombre_e!=$this->nombre)||($tipo_e!=$this->id_tipo_especialidad)){

      //----QUIERE DECIR QUE ESTA MODIFICANDO EL NOMBRE O EL TIPO-->>
      //---CONSULTO EL NOMBRE O EL TIPO DE ESPECIALIDAD NUEVO HABER SI EXISTE--->>>

      $sql = pg_query(" SELECT especialidad.id_especialidad FROM pasantias.especialidad WHERE  nombre_especialidad='$this->nombre' AND  id_tipo_especialidad='$this->id_tipo_especialidad'");
      $num=pg_num_rows($sql);
      $reg=pg_fetch_array($sql);
      $id_especialidad_Nuevo=$reg[0];

          //----AQUI ES CON UN ID NUEVO-->>
          if($num>0){
            //---QUIERE DECIR QUE SI EXISTE Y EXISTE EN LA INTERMEDIA, PERO NO SE SI ES MIA O DE OTRA INSTITUCION--->>
            //---CONSULTO ENTONCES--->>

            $SQL=pg_query("SELECT * FROM pasantias.especialidad_instituto_principal WHERE id_ip=$id_instituto AND id_especialidad=$id_especialidad_Nuevo");
            $register=pg_num_rows($SQL);
            
                if($register>0){
                          // QUIERE DECIR QUE YA LA TENGO---->
                          //--PERO DEBO CONSULTA XQ PROBABLEMENTE ESTE EN ACTIVO O MODIFICADO--->>
                          $sqql=pg_query("SELECT id_especialidad FROM pasantias.especialidad_instituto_principal WHERE id_especialidad=$id_especialidad_Nuevo AND id_ip=$id_instituto AND estatus='MODIFICADO'");
                          $nume=pg_num_rows($sqql);
                          if($nume>0){
                                //----SI EXISTE EN MODIFICADO CAMBIO A ACTIVO Y EL OTRO A MODIFICADO--->>
                                //---PERO NATES DEBO CONSULTA HABER SI TIENE PERSONAS ASIGNADA--->>>
                                //---->>>> DEBO VER SI HAY PERSONAS ASIGNADAS A LA ESPECIALIDA VIEJA, PARAQ PODER CAMBIAR EL ESTATUS A MODIFICADO--->>>
                                $str_PersonasAsignadas=pg_query("SELECT * FROM pasantias.persona_instituto_especialidad WHERE id_especialidad='$this->id' AND id_ip=$id_instituto");
                                $num=pg_num_rows($str_PersonasAsignadas);
                                if($num>0){
                                    //---SI HAY PERSONAS AQUI, HAGO UN TRASPASO---SOLO EN LA INTERMEDIA--->>>

                                          $retorno =7;
                                              return $retorno;

                                            }else{
                                              $updd=pg_query("UPDATE pasantias.especialidad_instituto_principal SET estatus='ACTIVO' WHERE id_especialidad=$id_especialidad_Nuevo AND id_ip=$id_instituto");
                                              $updd2="UPDATE pasantias.especialidad_instituto_principal SET estatus='MODIFICADO' WHERE id_especialidad='$this->id' AND id_ip=$id_instituto";
                                              $result = pg_query($updd2) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                                              $registro=0;
                                              $registro=pg_affected_rows($result);
                                                  if ($registro>0) {
                                                          $retorno=2;
                                                          return $retorno;
                                                          
                                                        }else{
                                                          return $retorno;

                                                        }

                                                    }
                                


                          }else{

                              $retorno=3;
                              return $retorno;

                          }
                  

                }else{
                          //---->>>> DEBO VER SI HAY PERSONAS ASIGNADAS A LA ESPECIALIDA VIEJA, PARAQ PODER CAMBIAR EL ESTATUS A MODIFICADO--->>>
                          $str_PersonasAsignadas=pg_query("SELECT * FROM pasantias.persona_instituto_especialidad WHERE id_especialidad='$this->id' AND id_ip=$id_instituto");
                          $num=pg_num_rows($str_PersonasAsignadas);
                          if($num>0){
                              //---SI HAY PERSONAS AQUI, HAGO UN TRASPASO---SOLO EN LA INTERMEDIA--->>>

                                    $retorno =5;
                                    return $retorno;

                                      }else{

                                        //---ACTUALIZO EL REGISTRO VIEJO--->>>>
                                        $actualizoVieja=pg_query("UPDATE pasantias.especialidad_instituto_principal SET estatus='MODIFICADO' WHERE id_especialidad='$this->id' AND id_ip=$id_instituto");
                                        //----Y... HAGO LA NUEVA INSERSION "ASIGNACION"---->>
                                        $strsql2=" INSERT INTO pasantias.especialidad_instituto_principal  (id_especialidad, id_ip, estatus, descripcion)VALUES ($id_especialidad_Nuevo, $id_instituto, '$this->estatus', '$this->descripcion' ) ; "; 
                                        $result2 = pg_query($strsql2) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                                              $registro2 =0;
                                              $registro2 = pg_affected_rows($result2);
                                             
                                                  pg_free_result($result2);
                                                  
                                              if ($registro2>0) {
                                                $retorno=2;
                                                return $retorno;
                                                
                                              }else{
                                                return $retorno;

                                              }


                                      }

                      }


          }else{
                //-----HATAS AQUI... EL NOMBRE CON EL TIPO E (NUEVO) NO EXISTE EN LA MAESTRA, NO LO ESTA USANDO NADIE.
                //---DEBO VER QUE VOY HACER CON EL REGISTRO ANTERIOR---->>
                //---DEBO CONSULTAR EN LA INTERMEDIA HABER SI EXISTE EL ID DE ESPECIALIDAD, QUE LO USE OTRO INSTITUTO Y VER SI SE PUEDE MODIFICAR--->>
                  $SQLLL=pg_query("SELECT * FROM pasantias.especialidad_instituto_principal WHERE id_especialidad='$this->id' AND id_ip!=$id_instituto");
                  $nummm=pg_num_rows($SQLLL);
                  if($nummm>0){

                            //---SI EXISTE, QUIERE DECIR QUE ALGUIEN LO ESTA USANDO, LA ESPECIALIDAD QUE INTENTO MODIFICAR. NO SE PUEDE MODIFICAR EL NOMBRE--->>>
                            //---COMO LO ESTA USANDO ALGUIEN  DEBO HACER UN NUEVO REGISTRO(ESPECIALIDAD)
                            //---->>>>PERO ANTES DEBO VER SI HAY PERSONAS ASIGNADAS A ESTA ESPECIALIDAD--PARA POSTERIORMENTE HACER EL TRASPASO DE ESTUDIANTES--->>>
                            $str_PersonasAsignadas=pg_query("SELECT * FROM pasantias.persona_instituto_especialidad WHERE id_especialidad='$this->id' AND id_ip=$id_instituto");
                            $num=pg_num_rows($str_PersonasAsignadas);
                            if($num>0){

                              $retorno =4;
                              return $retorno;

                            }else{
///////////////////7-----------VER AQUI----->>>>>> CREO QUE DEBERIA DE HACER UN NUEVO REGISTRO DESDE CERO--->>>
                              //--- SE REGISTRA UN NUEVO DEPARTAMENTO Y DE UNA VES SE LE ASIGNA--->>>
                              
                              $Resultado=$this->Incluir_NuevaEspecialidad_Asignar($id_instituto);
                              //---ACTUALIZO EL REGISTRO VIEJO--->>>>
                              $actualizoVieja=pg_query("UPDATE pasantias.especialidad_instituto_principal SET estatus='MODIFICADO' WHERE id_especialidad='$this->id' AND id_ip=$id_instituto");

                              if($Resultado>0){
                                    $retorno=2;
                                    return $retorno;
                              }else{
                                    return $Resultado;
                              }


                              
                            }

                        }else{

                          //------DESDE AQUI PUEDO MODIFICAR TODO-->>>

                          //---->>>>YA AQUI NADIE ESTA USANDO EL REGISTRO EN LA INTERMEDIA, PUEDO MODIFICAR EN AMBAS--->>>
                          //---->>>>PERO ANTES DEBO VER SI HAY PERSONAS ASIGNADAS A ESTA ESPECIALIDAD, YA QUE ESTO CAMBIARIA LAS ESPECIALIDADES DE ESTUDIANTES Y ES ALGO QUE NO SE PUEDE HACER ASI NADA MAS--->>>
                          $str_PersonasAsignadas=pg_query("SELECT * FROM pasantias.persona_instituto_especialidad WHERE id_especialidad='$this->id' AND id_ip=$id_instituto");
                          $num=pg_num_rows($str_PersonasAsignadas);
                          if($num>0){
                            //---AQUI ACTUALIZO TODO, REALIZANDO EL "TRASPASO"--->>>
                            $retorno =6;
                            return $retorno;

                          }else{

                                //---EN ESTE PUNTO YA PUEDO MODIFICAR TODO---->>>
                                $strsql=" UPDATE pasantias.especialidad SET nombre_especialidad='$this->nombre' , id_tipo_especialidad='$this->id_tipo_especialidad' WHERE id_especialidad='$this->id' "; 
                                $result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                             
                                    $registro =0;
                                    $registro = pg_affected_rows($result);
                                   
                           
                                $strsql2=" UPDATE pasantias.especialidad_instituto_principal SET estatus='$this->estatus' , descripcion='$this->descripcion' WHERE id_especialidad='$this->id' AND id_ip=$id_instituto; "; 
                                $result2 = pg_query($strsql2) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                                    $registro2 =0;
                                    $registro2 = pg_affected_rows($result2);
                                                         

                                        if(($registro==1)&&($registro2==1)){
                                          $retorno =2;
                                          return $retorno;

                                        }else{

                                          return $retorno;

                                        }

                          }
                        }          

           }     
  }else{

    //---SI LOS NOMBRE SE MANTIENEN IGUALES, MODIFICO SOLO EN LA INTERMEDIA--->>>
    $strsql2=" UPDATE pasantias.especialidad_instituto_principal SET estatus='$this->estatus' , descripcion='$this->descripcion' WHERE id_especialidad='$this->id' AND id_ip=$id_instituto; "; 
    $result2 = pg_query($strsql2) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

        $registro2 =0;
        $registro2 = pg_affected_rows($result2);
                             
            if($registro2==1){
              $retorno =2;
              return $retorno;
            }else{

              return $retorno;
            }


  }
}//----FIN DE LA CLASE---.




//-----MODIFICAR 3
//------BIENE DEL RETURN 4--->>>
//------REALIZAR OTRO REGISTRO Y ASIGNAR DE UNA VEZ, REALIZANDO EL TRASPASO DE LOS ESTUDIANTES ASIGNADO A LA ANTERIOR ESPECIALIDAD---->>>
    function Incluir_NuevaEspecialidad_Asignar_y_TraspasarEstudiantes($id_instituto, $codigo_encargado, $list=array()){
      $retorno=0;
      if($list==null){

                $strsql=" INSERT INTO pasantias.departamento ( estado,descripcion  ) 
                VALUES ( 'ACTIVO' , 'NO DESCRIPCION' ) "; 

                $result=pg_query($strsql);//ejecuta la tira sql

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $sql = " SELECT * FROM pasantias.ultimoid_departamento ";
            $result=pg_query($sql);//ejecuta la tira sql

                            $id_departamento = 0 ;

                            $fila = pg_fetch_array($result);

                            $id_departamento = $fila['id'];



  ////////////////////////////////////////                            /////////////////////////////////////////////////////

            $strsql2=" INSERT INTO pasantias.especialidad ( id_departamento , nombre_especialidad , id_tipo_especialidad ) 
                        VALUES ( '$id_departamento' ,'$this->nombre' , '$this->id_tipo_especialidad') "; 

            $result2 = pg_query($strsql2) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                        

            $sql22 = " SELECT MAX(id_especialidad) as id_especialidad FROM pasantias.especialidad";

            $result22=pg_query($sql22);//ejecuta la tira sql

                            
                            $fila2 = pg_fetch_array($result22);
                            $id_especialidad = $fila2[0];
                              

/////////////////////////////////////                                    ////////////////////////////////////


            $strsql3=" INSERT INTO pasantias.especialidad_instituto_principal ( id_ip , id_especialidad , estatus, descripcion ) 
                       VALUES ( '$id_instituto' ,'$id_especialidad' , 'ACTIVO', '$this->descripcion') "; 

            $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

           

            //---- HAGO LA "INSERCION" EN LA TABLA PERSONA_INTITUTO_ESPECIALIDAD-TRASPASO-->
                    //---OBTENGO LOS ESTUDIANTES ASIGNADOS A LA ANTERIOR--->>>
                    $reciveList=array();
                    $reciveList=$this->SeleccionarEstudiantesDeEspecialidad($this->id, $id_instituto);

                    //---ACTUALIZO EL REGISTRO VIEJO--->>>>
                    $actualizoVieja=pg_query("UPDATE pasantias.especialidad_instituto_principal SET estatus='MODIFICADO' WHERE id_especialidad='$this->id' AND id_ip=$id_instituto");

                    //---RECORRO AQUI PARA IR ACTUALIZANDO CADA PERSONA--->>
                    for ($i=0; $i <count($reciveList); $i++) { 
                      # code...
                    $updat="UPDATE pasantias.persona_instituto_especialidad SET id_especialidad=$id_especialidad WHERE id_persona=$reciveList[$i] AND id_ip=$id_instituto ";
                    $resul = pg_query($updat) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                      }

                        

                        $regis =0;
                        $regis = pg_affected_rows($resul);
                                             
                            if($regis>0){
                              $retorno =2;
                              return $retorno;
                            }else{

                              return $retorno;
                            }

      
      }else{
          $retorno=$this->Incluir_NuevaEspecialidad_Asignar_y_TraspasarEstudiantes_TEMPORADAS($id_instituto, $codigo_encargado, $list);
          return $retorno;
      }

 }///-------FIN DE ASIGNAR NUEVA ESPECIALIDAD Y ASIGNAR----->

//2
 function Incluir_NuevaEspecialidad_Asignar_y_TraspasarEstudiantes_TEMPORADAS($id_instituto, $codigo_encargado, $list=array()){

    
    $id_viejo=$this->id;
    $strsql=" INSERT INTO pasantias.departamento ( estado,descripcion  ) 
                VALUES ( 'ACTIVO' , 'NO DESCRIPCION' ) "; 

                $result=pg_query($strsql);//ejecuta la tira sql

///////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $sql = " SELECT * FROM pasantias.ultimoid_departamento ";
            $result=pg_query($sql);//ejecuta la tira sql

                            $id_departamento = 0 ;

                            $fila = pg_fetch_array($result);

                            $id_departamento = $fila['id'];



  ////////////////////////////////////////                            /////////////////////////////////////////////////////

            $strsql2=" INSERT INTO pasantias.especialidad ( id_departamento , nombre_especialidad , id_tipo_especialidad ) 
                        VALUES ( '$id_departamento' ,'$this->nombre' , '$this->id_tipo_especialidad') "; 

            $result2 = pg_query($strsql2) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                        

            $sql22 = " SELECT MAX(id_especialidad) as id_especialidad FROM pasantias.especialidad";

            $result22=pg_query($sql22);//ejecuta la tira sql

                            
                            $fila2 = pg_fetch_array($result22);
                            $id_especialidad = $fila2[0];
                              

/////////////////////////////////////                                    ////////////////////////////////////


            $strsql3=" INSERT INTO pasantias.especialidad_instituto_principal ( id_ip , id_especialidad , estatus, descripcion ) 
                       VALUES ( '$id_instituto' ,'$id_especialidad' , 'ACTIVO', '$this->descripcion') "; 

            $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

           

            //----  CONSULTO LOS ESTUDIANTES CON SUS RESPECTIVAS TEMPORADAS PARA ACTUALIZAR O REGISTRAR NUEVAMENTE EN TEMPORADA --->>>
                    $todo=count($list);
                    $estudiantesTodos=array();
                    $temporadaTodos=array();
                    for($i=0; $i<$todo; $i++){

                        $strsql=pg_query("SELECT temporadas_solicitud.codigo_temporada,temporadas_solicitud.id_tipo_solicitud, temporadas_especialidad.id_especialidad, temporadas_especialidad.codigo_temporada_especialidad, temporadas_estudiantes.codigo_estudiante, estudiante.id_persona FROM pasantias.encargado 
                                    INNER JOIN pasantias.temporadas_solicitud ON temporadas_solicitud.codigo_encargado=encargado.codigo_encargado
                                    AND temporadas_solicitud.codigo_encargado='$codigo_encargado' AND estatus='EN CURSO'
                                    INNER JOIN pasantias.temporadas_especialidad ON temporadas_especialidad.codigo_temporada=temporadas_solicitud.codigo_temporada 
                                    AND temporadas_especialidad.id_especialidad=$id_viejo
                                    INNER JOIN pasantias.tipo_solicitud ON tipo_solicitud.id_tipo_solicitud=temporadas_solicitud.id_tipo_solicitud AND
                                     temporadas_solicitud.id_tipo_solicitud=$list[$i]
                                    INNER JOIN pasantias.temporadas_estudiantes ON temporadas_estudiantes.codigo_temporada_especialidad=temporadas_especialidad.codigo_temporada_especialidad
                                    INNER JOIN pasantias.estudiante ON temporadas_estudiantes.codigo_estudiante=estudiante.codigo_estudiante");
                                          
                          
                          $estudiantes=array();
                          $temporada=array();
                          while($reg=pg_fetch_array($strsql)){

                            $temporada[]=$reg['codigo_temporada'];
                            $estudiantes[]=$reg['id_persona'];
                      }
                      //var_dump($estudiantes);
                                                                                      //---PARA UNIR TODOS LOS ESTUDIANTES Y VER SI HAY OTROS DIFERENTES Y PASAR A MODIFICADOS
                                                                                      $estudiantesTodos=array_merge($estudiantesTodos, $estudiantes);
                                                                                      //----PARA UNIR TODAS LAS TEMPORADAS---->>>
                                                                                      $temporadaTodos=array_merge($temporadaTodos, $temporada);
                      //---RECORRO AQUI PARA IR ACTUALIZANDO CADA PERSONA--->>
                          $TOTAL=count($estudiantes);                                                            
                          for ($j=0; $j <$TOTAL; $j++) { 
                          $updat="UPDATE pasantias.persona_instituto_especialidad SET id_especialidad=$id_especialidad WHERE id_persona=$estudiantes[$j] AND id_ip=$id_instituto AND id_especialidad=$id_viejo ";
                          $resul = pg_query($updat) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                            }

                
                }//---FIN DEL FOR DE TEMPORADAS
                    $temporadaTodos=array_unique($temporadaTodos);
                    //var_dump($temporadaTodos);
                    //---CONSULTO A VER SI PUEDO CAMBIAR EL ESTATUS A MODIFICADO--->>>
                    $NUM=$this->VerificarSi_ExistenOtros($id_instituto, $id_viejo, $estudiantesTodos);
                    if($NUM==0){
                            //---ACTUALIZO EL REGISTRO VIEJO--->>>>
                            $actualizoVieja=pg_query("UPDATE pasantias.especialidad_instituto_principal SET estatus='MODIFICADO' WHERE id_especialidad=$id_viejo AND id_ip=$id_instituto");
                    }else{
                        //NO HAGO NADA, LOS DEJO AMBOS ACTIVOS
                    }
                  

                          //----ACTUALIZO TODAS LAS TEMPORADAS CON LA ESPECIALIDAD NUEVA--->>>
                          $UPDATING=$this->ActualizarTodasTemporadas($temporadaTodos, $id_viejo, $id_especialidad);
                    
                        $retorno=0;
                        $regis =0;
                        $regis = pg_affected_rows($UPDATING);
                                           
                            if($regis>0){

                              $retorno =2;
                              return $retorno;
                            }else{
                          
                              return $retorno;
                            }


 }//--FIN DE LA FUNCION


function VerificarSi_ExistenOtros($id_instituto, $id_especialidad, $estudiantes=array()){
$retorno=array();


  $sql=pg_query("SELECT id_persona FROM pasantias.persona_instituto_especialidad WHERE  id_ip=$id_instituto AND id_especialidad=$id_especialidad ");

  while($regis=pg_fetch_array($sql)){
    $retorno[]=$regis['id_persona'];

  }

  $retorno=array_diff($retorno, $estudiantes);

 
$num=count($retorno);
//echo "otro estudiante:".$num.".";
 return $num;   

}

 function VerificarSi_ExisteEspecialidadEN_otraTemporada($temporadaTodos=array(), $codigo_encargado, $id_viejo){

    $retorno=array();

      $sql=pg_query("SELECT temporadas_solicitud.codigo_temporada FROM pasantias.encargado 
                                    INNER JOIN pasantias.temporadas_solicitud ON temporadas_solicitud.codigo_encargado=encargado.codigo_encargado
                                    AND temporadas_solicitud.codigo_encargado='$codigo_encargado' AND estatus='EN CURSO'
                                    INNER JOIN pasantias.temporadas_especialidad ON temporadas_especialidad.codigo_temporada=temporadas_solicitud.codigo_temporada 
                                    AND temporadas_especialidad.id_especialidad=$id_viejo");

      while($regis=pg_fetch_array($sql)){
        $retorno[]=$regis['codigo_temporada'];

      }

      $retorno=array_diff($retorno, $temporadaTodos);

     
    $num=count($retorno);
    //echo "otra temporada:".$num."-";
     return $num; 

 }



 function ActualizarTodasTemporadas($temporadaTodos=array(), $id_viejo, $id_especialidad){
    
    //ACTUALIZO TEMPORADA_ESPECIALIDAD.
    $cuento=count($temporadaTodos);
    for($i=0; $i<$cuento; $i++){

       $UPDATING=pg_query("UPDATE pasantias.temporadas_especialidad SET id_especialidad=$id_especialidad WHERE id_especialidad=$id_viejo AND codigo_temporada='$temporadaTodos[$i]'");   

    }

   return $UPDATING;

 }




function InsertarTemporadaNueva($temporadaTodos, $id_viejo, $id_especialidad){

    $cuento=count($temporadaTodos);
    for($i=0; $i<$cuento; $i++){
    	
      $Estatus=pg_query("UPDATE pasantias.temporadas_especialidad SET estatus='MODIFICADO' WHERE codigo_temporada='$temporadaTodos[$i]' AND id_especialidad=$id_viejo");
      
      $inserchon=pg_query("INSERT INTO pasantias.temporadas_especialidad (codigo_temporada, id_especialidad, estatus) VALUES('$temporadaTodos[$i]', $id_especialidad, 'EN ESPERA')");

      $ultimaTemporadaEspecialidad=pg_query("SELECT MAX(codigo_temporada_especialidad) as cod_temporada_especialidad FROM pasantias.temporadas_especialidad WHERE codigo_temporada='$temporadaTodos[$i]'");
      $regist=pg_fetch_array($ultimaTemporadaEspecialidad);
      $codigo_temEspecialidaNuevo=$regist['cod_temporada_especialidad'];
      
      $consultoCodigoEspecialidad=pg_query("SELECT codigo_temporada_especialidad FROM pasantias.temporadas_especialidad WHERE codigo_temporada='$temporadaTodos[$i]' AND id_especialidad=$id_viejo");
      while($rr=pg_fetch_array($consultoCodigoEspecialidad)){

            $codigo_tempEspecialidViejo=$rr['codigo_temporada_especialidad'];

            $UPDATING=pg_query("UPDATE pasantias.temporadas_estudiantes SET codigo_temporada_especialidad='$codigo_temEspecialidaNuevo' WHERE codigo_temporada_especialidad='$codigo_tempEspecialidViejo'");

      }
    }//FOR--->>

    return $UPDATING;


}








//----MODIFICAR 4
//----BIENE DEL RETURN 6
function ActualizarTodasLasTablas_TraspasandoEstudiantes_INTERNAMENTE($id_instituto, $codigo_encargado, $list=array()){
	$retorno=0;
	if($list==null){
			//---EN ESTE PUNTO YA PUEDO MODIFICAR TODO---->>>
        $strsql=" UPDATE pasantias.especialidad SET nombre_especialidad='$this->nombre' , id_tipo_especialidad='$this->id_tipo_especialidad' WHERE id_especialidad='$this->id' "; 
        $result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
     
            $registro =0;
            $registro = pg_affected_rows($result);
           
   
        $strsql2=" UPDATE pasantias.especialidad_instituto_principal SET estatus='$this->estatus' , descripcion='$this->descripcion' WHERE id_especialidad='$this->id' AND id_ip=$id_instituto; "; 
        $result2 = pg_query($strsql2) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

            $registro2 =0;
            $registro2 = pg_affected_rows($result2);       

                if(($registro==1)&&($registro2==1)){
                  $retorno =2;
                  return $retorno;

                }else{

                  return $retorno;

                }

	}else{

		$retorno=$this->Incluir_NuevaEspecialidad_Asignar_y_TraspasarEstudiantes_TEMPORADAS($id_instituto, $codigo_encargado, $list);
		return $retorno;
	}
    

}//---FIN DE LA CLASE

 



//---MODIFICAR 5
//---VIENE DEL RETURN 7---
function ModificarEstatusEspecialidadBD($id_instituto, $codigo_encargado, $list=array()){

    $retorno=0;

      if($list==null){
      	//---CONSULTO EL NOMBRE O EL TIPO DE ESPECIALIDAD NUEVO HABER SI EXISTE--->>>
	      $sql = pg_query(" SELECT especialidad.id_especialidad FROM pasantias.especialidad WHERE  nombre_especialidad='$this->nombre' AND  id_tipo_especialidad='$this->id_tipo_especialidad'");
	      $num=pg_num_rows($sql);
	      $reg=pg_fetch_array($sql);
	      $id_especialidad_Nuevo=$reg[0];
      		//---ACTUALIZO EL REGISTRO VIEJO--->>>>
                    $actualizoVieja=pg_query("UPDATE pasantias.especialidad_instituto_principal SET estatus='MODIFICADO' WHERE id_especialidad='$this->id' AND id_ip=$id_instituto");
                    //---ACTUALIZO EL REGISTRO VIEJO--->>>>
                    $actualizoNuevo=pg_query("UPDATE pasantias.especialidad_instituto_principal SET estatus='ACTIVO' WHERE id_especialidad=$id_especialidad_Nuevo AND id_ip=$id_instituto");
                    

                    //----SEGUIDO HAGO LA "INSERCION-ACTUALIZACION" EN LA TABLA PERSONA_INTITUTO_ESPECIALIDAD-TRASPASO-->
                    $reciveList=array();
                    $reciveList=$this->SeleccionarEstudiantesDeEspecialidad($this->id, $id_instituto);
                    //---RECORRO AQUI PARA IR ACTUALIZANDO CADA PERSONA--->>
                    for ($i=0; $i <count($reciveList); $i++) { 
                      # code...
                    $updat="UPDATE pasantias.persona_instituto_especialidad SET id_especialidad=$id_especialidad_Nuevo WHERE id_persona=$reciveList[$i] AND id_ip=$id_instituto ";
                    $resul = pg_query($updat) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                      }


                        $regis =0;
                        $regis = pg_affected_rows($resul);
                                             
                            if($regis>0){
                              $retorno =2;
                              return $retorno;
                            }else{

                              return $retorno;
                            }

      }else{
      	   $retorno=$this->ModificarEstatusEspecialidadBD_TEMPORADAS($id_instituto, $codigo_encargado, $list);
      	   return $retorno;
      }


}//---FIN DE LA CLASE

//2
function ModificarEstatusEspecialidadBD_TEMPORADAS($id_instituto, $codigo_encargado, $list=array()){
	$id_viejo=$this->id;
	//---CONSULTO EL NOMBRE O EL TIPO DE ESPECIALIDAD NUEVO HABER SI EXISTE--->>>
      $sql = pg_query(" SELECT especialidad.id_especialidad FROM pasantias.especialidad WHERE  nombre_especialidad='$this->nombre' AND  id_tipo_especialidad='$this->id_tipo_especialidad'");
      $num=pg_num_rows($sql);
      $reg=pg_fetch_array($sql);
      $id_especialidad_Nuevo=$reg[0];

	//----  CONSULTO LOS ESTUDIANTES CON SUS RESPECTIVAS TEMPORADAS PARA ACTUALIZAR O REGISTRAR NUEVAMENTE EN TEMPORADA --->>>
            $todo=count($list);
            $estudiantesTodos=array();
            $temporadaTodos=array();
            for($i=0; $i<$todo; $i++){

                $strsql=pg_query("SELECT temporadas_solicitud.codigo_temporada,temporadas_solicitud.id_tipo_solicitud, temporadas_especialidad.id_especialidad, temporadas_especialidad.codigo_temporada_especialidad, temporadas_estudiantes.codigo_estudiante, estudiante.id_persona FROM pasantias.encargado 
                            INNER JOIN pasantias.temporadas_solicitud ON temporadas_solicitud.codigo_encargado=encargado.codigo_encargado
                            AND temporadas_solicitud.codigo_encargado='$codigo_encargado' AND estatus='EN CURSO'
                            INNER JOIN pasantias.temporadas_especialidad ON temporadas_especialidad.codigo_temporada=temporadas_solicitud.codigo_temporada 
                            AND temporadas_especialidad.id_especialidad=$id_viejo
                            INNER JOIN pasantias.tipo_solicitud ON tipo_solicitud.id_tipo_solicitud=temporadas_solicitud.id_tipo_solicitud AND
                             temporadas_solicitud.id_tipo_solicitud=$list[$i]
                            INNER JOIN pasantias.temporadas_estudiantes ON temporadas_estudiantes.codigo_temporada_especialidad=temporadas_especialidad.codigo_temporada_especialidad
                            INNER JOIN pasantias.estudiante ON temporadas_estudiantes.codigo_estudiante=estudiante.codigo_estudiante");
                                  
                  
                  $estudiantes=array();
                  $temporada=array();
                  while($reg=pg_fetch_array($strsql)){

                    $temporada[]=$reg['codigo_temporada'];
                    $estudiantes[]=$reg['id_persona'];
              }
              //var_dump($estudiantes);
                                                                              //---PARA UNIR TODOS LOS ESTUDIANTES Y VER SI HAY OTROS DIFERENTES Y PASAR A MODIFICADOS
                                                                              $estudiantesTodos=array_merge($estudiantesTodos, $estudiantes);
                                                                              //----PARA UNIR TODAS LAS TEMPORADAS---->>>
                                                                              $temporadaTodos=array_merge($temporadaTodos, $temporada);
              //---RECORRO AQUI PARA IR ACTUALIZANDO CADA PERSONA--->>
                  $TOTAL=count($estudiantes);                                                            
                  for ($j=0; $j <$TOTAL; $j++) { 
                  $updat="UPDATE pasantias.persona_instituto_especialidad SET id_especialidad=$id_especialidad_Nuevo WHERE id_persona=$estudiantes[$j] AND id_ip=$id_instituto ";
                  $resul = pg_query($updat) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                    }

        
        }//---FIN DEL FOR DE TEMPORADAS
            $temporadaTodos=array_unique($temporadaTodos);
            //var_dump($temporadaTodos);//---TEMPORADAS SELECCIONADAS
            //var_dump($estudiantesTodos);//---ESTUDIANTES EN TEMPORADAS ACTIVAS
            //---CONSULTO A VER SI PUEDO CAMBIAR EL ESTATUS A MODIFICADO--->>>
            $NUM=$this->VerificarSi_ExistenOtros($id_instituto, $id_viejo, $estudiantesTodos);
            if($NUM==0){
                    //---ACTUALIZO EL REGISTRO VIEJO--->>>>
			        $actualizoVieja=pg_query("UPDATE pasantias.especialidad_instituto_principal SET estatus='MODIFICADO' WHERE id_especialidad=$id_viejo AND id_ip=$id_instituto");
			        //---ACTUALIZO EL REGISTRO VIEJO--->>>>
			        $actualizoNuevo=pg_query("UPDATE pasantias.especialidad_instituto_principal SET estatus='ACTIVO' WHERE id_especialidad=$id_especialidad_Nuevo AND id_ip=$id_instituto");
            }else{
                //NO HAGO NADA, LOS DEJO AMBOS ACTIVOS
                //---ACTUALIZO EL REGISTRO VIEJO--->>>>
			        $actualizoNuevo=pg_query("UPDATE pasantias.especialidad_instituto_principal SET estatus='ACTIVO' WHERE id_especialidad=$id_especialidad_Nuevo AND id_ip=$id_instituto");
            }
            
        
                  //----ACTUALIZO TODAS LAS TEMPORADAS CON LA ESPECIALIDAD NUEVA--->>>
                  $UPDATING=$this->ActualizarTodasTemporadas($temporadaTodos, $id_viejo, $id_especialidad_Nuevo);
           

		
            $regis =0;
            $regis = pg_affected_rows($UPDATING);
                                 
                if($regis>0){
                  $retorno =2;
                  return $retorno;
                }else{

                  return $retorno;
                }


}//FIN DE LA CLASE


//---MODIFICAR 2
//---BIENE DEL RETURN 5---->>>
//------REALIZA UNA NUEVA INSERCION EN LA INTERMEDIA CON LOS DATOS DE ESTUDIANTES ANTERIORES A OTRA ESPECIALIDAD---->
function RealizarNuevaAsignacion_TraspasandoDatosEstudiantes($id_instituto, $codigo_encargado, $list=array()){

    $retorno=0;
    if($list==null){
    		//---CONSULTO EL NOMBRE O EL TIPO DE ESPECIALIDAD NUEVO HABER SI EXISTE--->>>
	      $sql = pg_query(" SELECT especialidad.id_especialidad FROM pasantias.especialidad WHERE  nombre_especialidad='$this->nombre' AND  id_tipo_especialidad='$this->id_tipo_especialidad'");
	      $num=pg_num_rows($sql);
	      $reg=pg_fetch_array($sql);
	      $id_especialidad_Nuevo=$reg[0];


            //---QUIERE DECIR QUE SI EXISTE Y EXISTE EN LA INTERMEDIA, PERO NO SE SI ES MIA O DE OTRA INSTITUCION--->>
            //---CONSULTO ENTONCES--->>

            $SQL=pg_query("SELECT * FROM pasantias.especialidad_instituto_principal WHERE id_ip=$id_instituto AND id_especialidad=$id_especialidad_Nuevo");
            $register=pg_num_rows($SQL);
            
                if($register>0){
                  // QUIERE DECIR QUE YA LA TENGO---->
                  //MANDO UN NUEVO MENSAJE---->>>
                  $retorno=1;

                  return $retorno;

                }else{

                    //COMO NO LA TENGO ME LA ASIGNO---->EN LA INTERMEDIA---->>
                    $strsql2=" INSERT INTO pasantias.especialidad_instituto_principal  (id_especialidad, id_ip, estatus, descripcion)VALUES ($id_especialidad_Nuevo, $id_instituto, '$this->estatus', '$this->descripcion' ) ; "; 
                    $result2 = pg_query($strsql2) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                    //----SEGUIDO HAGO LA "INSERCION-ACTUALIZACION" EN LA TABLA PERSONA_INTITUTO_ESPECIALIDAD-TRASPASO-->
                    $reciveList=array();
                    $reciveList=$this->SeleccionarEstudiantesDeEspecialidad($this->id, $id_instituto);

                    //---ACTUALIZO EL REGISTRO VIEJO--->>>>
                    $actualizoVieja=pg_query("UPDATE pasantias.especialidad_instituto_principal SET estatus='MODIFICADO' WHERE id_especialidad='$this->id' AND id_ip=$id_instituto");

                    //---RECORRO AQUI PARA IR ACTUALIZANDO CADA PERSONA--->>
                    for ($i=0; $i <count($reciveList); $i++) {
                      # code...
                    $updat="UPDATE pasantias.persona_instituto_especialidad SET id_especialidad=$id_especialidad_Nuevo WHERE id_persona=$reciveList[$i] AND id_ip=$id_instituto ";
                    $resul = pg_query($updat) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                      }
                        

                        $regis =0;
                        $regis = pg_affected_rows($resul);
                                             
                            if($regis>0){
                              $retorno =2;
                              return $retorno;
                            }else{

                              return $retorno;
                            }
                     }


    }else{
    	$retorno=$this->RealizarNuevaAsignacion_TraspasandoDatosEstudiantesTEMPORADAS($id_instituto, $codigo_encargado, $list);
    	return $retorno;
    }
    

}//----FIN DE LA CLASE


//2
 function RealizarNuevaAsignacion_TraspasandoDatosEstudiantesTEMPORADAS($id_instituto, $codigo_encargado, $list=array()){

 		$id_viejo=$this->id;
 		//---CONSULTO EL NOMBRE O EL TIPO DE ESPECIALIDAD NUEVO HABER SI EXISTE--->>>
	      $sql = pg_query(" SELECT especialidad.id_especialidad FROM pasantias.especialidad WHERE  nombre_especialidad='$this->nombre' AND  id_tipo_especialidad='$this->id_tipo_especialidad'");
	      $num=pg_num_rows($sql);
	      $reg=pg_fetch_array($sql);
	      $id_especialidad_Nuevo=$reg[0];


            //---QUIERE DECIR QUE SI EXISTE Y EXISTE EN LA INTERMEDIA, PERO NO SE SI ES MIA O DE OTRA INSTITUCION--->>
            //---CONSULTO ENTONCES--->>

            $SQL=pg_query("SELECT * FROM pasantias.especialidad_instituto_principal WHERE id_ip=$id_instituto AND id_especialidad=$id_especialidad_Nuevo");
            $register=pg_num_rows($SQL);
            
                if($register>0){
                  // QUIERE DECIR QUE YA LA TENGO---->
                  //MANDO UN NUEVO MENSAJE---->>>
                  $retorno=1;
                  return $retorno;

                }else{

                    //COMO NO LA TENGO ME LA ASIGNO---->EN LA INTERMEDIA---->>
                    $strsql2=" INSERT INTO pasantias.especialidad_instituto_principal  (id_especialidad, id_ip, estatus, descripcion)VALUES ($id_especialidad_Nuevo, $id_instituto, '$this->estatus', '$this->descripcion' ) ; "; 
                    $result2 = pg_query($strsql2) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                    
                    //----  CONSULTO LOS ESTUDIANTES CON SUS RESPECTIVAS TEMPORADAS PARA ACTUALIZAR O REGISTRAR NUEVAMENTE EN TEMPORADA --->>>
            $todo=count($list);
            $estudiantesTodos=array();
            $temporadaTodos=array();
            for($i=0; $i<$todo; $i++){

                $strsql=pg_query("SELECT temporadas_solicitud.codigo_temporada,temporadas_solicitud.id_tipo_solicitud, temporadas_especialidad.id_especialidad, temporadas_especialidad.codigo_temporada_especialidad, temporadas_estudiantes.codigo_estudiante, estudiante.id_persona FROM pasantias.encargado 
                            INNER JOIN pasantias.temporadas_solicitud ON temporadas_solicitud.codigo_encargado=encargado.codigo_encargado
                            AND temporadas_solicitud.codigo_encargado='$codigo_encargado' AND estatus='EN CURSO'
                            INNER JOIN pasantias.temporadas_especialidad ON temporadas_especialidad.codigo_temporada=temporadas_solicitud.codigo_temporada 
                            AND temporadas_especialidad.id_especialidad=$id_viejo
                            INNER JOIN pasantias.tipo_solicitud ON tipo_solicitud.id_tipo_solicitud=temporadas_solicitud.id_tipo_solicitud AND
                             temporadas_solicitud.id_tipo_solicitud=$list[$i]
                            INNER JOIN pasantias.temporadas_estudiantes ON temporadas_estudiantes.codigo_temporada_especialidad=temporadas_especialidad.codigo_temporada_especialidad
                            INNER JOIN pasantias.estudiante ON temporadas_estudiantes.codigo_estudiante=estudiante.codigo_estudiante");
                                  
                  
                  $estudiantes=array();
                  $temporada=array();
                  while($reg=pg_fetch_array($strsql)){

                    $temporada[]=$reg['codigo_temporada'];
                    $estudiantes[]=$reg['id_persona'];
              }
              
                                                                              //---PARA UNIR TODOS LOS ESTUDIANTES Y VER SI HAY OTROS DIFERENTES Y PASAR A MODIFICADOS
                                                                              $estudiantesTodos=array_merge($estudiantesTodos, $estudiantes);
                                                                              //----PARA UNIR TODAS LAS TEMPORADAS---->>>
                                                                              $temporadaTodos=array_merge($temporadaTodos, $temporada);
              //---RECORRO AQUI PARA IR ACTUALIZANDO CADA PERSONA--->>
                  $TOTAL=count($estudiantes);                                                            
                  for ($j=0; $j <$TOTAL; $j++) { 
                  $updat="UPDATE pasantias.persona_instituto_especialidad SET id_especialidad=$id_especialidad_Nuevo WHERE id_persona=$estudiantes[$j] AND id_ip=$id_instituto ";
                  $resul = pg_query($updat) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                    }

        
        }//---FIN DEL FOR DE TEMPORADAS
            $temporadaTodos=array_unique($temporadaTodos);
            //var_dump($temporadaTodos);//---TEMPORADAS SELECCIONADAS
            //var_dump($estudiantesTodos);//---ESTUDIANTES EN TEMPORADAS ACTIVAS
            //---CONSULTO A VER SI PUEDO CAMBIAR EL ESTATUS A MODIFICADO--->>>
            $NUM=$this->VerificarSi_ExistenOtros($id_instituto, $id_viejo, $estudiantesTodos);
            if($NUM==0){
                     //---ACTUALIZO EL REGISTRO VIEJO--->>>>
                    $actualizoVieja=pg_query("UPDATE pasantias.especialidad_instituto_principal SET estatus='MODIFICADO' WHERE id_especialidad=$id_viejo AND id_ip=$id_instituto");
            }else{
                //NO HAGO NADA, LOS DEJO AMBOS ACTIVOS
               
            }
            
        
                  //----ACTUALIZO TODAS LAS TEMPORADAS CON LA ESPECIALIDAD NUEVA--->>>
                  $UPDATING=$this->ActualizarTodasTemporadas($temporadaTodos, $id_viejo, $id_especialidad_Nuevo);
           

                        $regis =0;
                        $regis = pg_affected_rows($UPDATING);
                                             
                            if($regis>0){
                              $retorno =2;
                              return $retorno;
                            }else{

                              return $retorno;
                            }
                     }


 }//---FIN DE LA CLASE





//-------SE USA PARA HACER TRASPASOS DE LOS ESTUDIANTES---->>
function SeleccionarEstudiantesDeEspecialidad($id_especialidad, $id_instituto){

    $sql=pg_query("SELECT id_persona FROM pasantias.persona_instituto_especialidad WHERE id_ip=$id_instituto AND id_especialidad=$id_especialidad ");
    $Lista=array();

    while($registro=pg_fetch_array($sql)){

          $Lista[]=$registro["id_persona"];

    }

    return $Lista;
  }



































//-----EN CONSTRUCCION----->>>>
//------VERIFICACION DE LAS TEMPORADAS AL MODIFICAR---->>>>
  function Modificar_TemporadaEspecialidad($id_nuevo, $id_viejo, $codigo_encargado, $list=array()){
    $retorno=0;

    for($i=0; $i<count($list); $i++){

		    $strsql=pg_query("SELECT temporadas_solicitud.codigo_temporada FROM pasantias.encargado 
                INNER JOIN pasantias.temporadas_solicitud ON temporadas_solicitud.codigo_encargado=encargado.codigo_encargado AND temporadas_solicitud.codigo_encargado='$codigo_encargado'
                 AND estatus='EN CURSO'
                INNER JOIN pasantias.tipo_solicitud ON tipo_solicitud.id_tipo_solicitud=temporadas_solicitud.id_tipo_solicitud AND
                 temporadas_solicitud.id_tipo_solicitud=$list[$i];");
                			    

			    while($reg=pg_fetch_array($strsql)){

			    	$codigo=$reg['codigo_temporada'];

			    	$UPDATING=pg_query("UPDATE pasantias.temporadas_especialidad SET id_especialidad=$id_nuevo WHERE id_especialidad=$id_viejo AND codigo_temporada='$codigo'");

			}
}

    
    
  }

  function ConsultarTamporada_Modificacion($id_especialidad,$id_encargado){
    $retorno=0;

    $strsql=pg_query("SELECT temporadas_solicitud.codigo_temporada, nombre_tipo_solicitud, tipo_solicitud.id_tipo_solicitud, id_especialidad, to_char(periodo_solicitud.fecha_inicio, 'DD, TMMonth YYYY')|| ' al ' ||to_char(periodo_solicitud.fecha_fin, 'DD, TMMonth YYYY') as periodo 
                      FROM pasantias.temporadas_solicitud 
            INNER JOIN pasantias.encargado ON temporadas_solicitud.codigo_encargado=encargado.codigo_encargado AND temporadas_solicitud.codigo_encargado='$id_encargado' AND estatus='EN CURSO'
            INNER JOIN pasantias.periodo_solicitud ON periodo_solicitud.id_periodo=temporadas_solicitud.id_periodo
            INNER JOIN pasantias.tipo_solicitud ON tipo_solicitud.id_tipo_solicitud=temporadas_solicitud.id_tipo_solicitud
            INNER JOIN pasantias.temporadas_especialidad ON temporadas_especialidad.codigo_temporada = temporadas_solicitud.codigo_temporada AND id_especialidad=$id_especialidad AND temporadas_especialidad.estatus='EN ESPERA'");


    return $strsql;
   

  }

        
 function Consultar_ParaRegistrar($ID_INSTITUTO)
        {


        //$sql="SELECT * FROM pasantias.especialidad WHERE nombre_especialidad = '".$nombre."' AND id_tipo_especialidad='".$tipo."' ";
        //$sql="SELECT * FROM pasantias.especialidad WHERE nombre_especialidad = '$this->nombre' AND 
         //id_tipo_especialidad=$this->id_tipo_especialidad ;";

         $sql="SELECT * FROM pasantias.especialidad_instituto_principal WHERE 
              especialidad_instituto_principal.id_especialidad=(SELECT id_especialidad FROM pasantias.especialidad WHERE
              nombre_especialidad = '$this->nombre' AND id_tipo_especialidad='$this->id_tipo_especialidad') AND especialidad_instituto_principal.id_ip=$ID_INSTITUTO;";

                 $result=pg_query($sql);//ejecuta la tira sql

                 $num=pg_num_rows($result);

              return $num;
        }



        
//---------ASIGNACION DE LOS ESTUDIANTES A LAS ESPECIALIDADES--->>>>

        function AsignarEstudiante_EspecialidadBD($Vista=array())
        {

          $retorno=0;

          $ID_ESPECIALIDAD      =$Vista['id_especialidad'];
          $ID_INSTITUTO         =$Vista['id_instituto'];
          $EXPEDIENTE           =$Vista['expediente_e'];
          $CEDULA               =$Vista['cedula_e'];
          $NOMBRE               =$Vista['nombre_e'];
          $APELLIDO             =$Vista['apellido_e'];
          $FECHA                =$Vista['fecha'];
          $OBSERVACION          =$Vista['observacion'];
      

          //-----CONSULTO HABER SI EXISTE LA CEDULA--->>>
          $Sql=pg_query("SELECT id_persona FROM pasantias.persona WHERE cedula='$CEDULA';");
          $num=pg_num_rows($Sql);
          $rg=pg_fetch_array($Sql);
          $ID_PERSONA=$rg['id_persona'];

          if($num>0){

          		$slq=pg_query("SELECT estudiante.codigo_estudiante FROM pasantias.estudiante INNER JOIN pasantias.persona_instituto_especialidad
                              ON persona_instituto_especialidad.id_persona=estudiante.id_persona 
                              AND persona_instituto_especialidad.id_perfil=estudiante.id_perfil 
                              AND persona_instituto_especialidad.id_ip=estudiante.id_ip 
                              AND persona_instituto_especialidad.id_especialidad=estudiante.id_especialidad  
                              INNER JOIN pasantias.persona
                              ON persona.id_persona = persona_instituto_especialidad.id_persona
                              INNER JOIN pasantias.especialidad_instituto_principal
                              ON especialidad_instituto_principal.id_especialidad=persona_instituto_especialidad.id_especialidad
                              AND especialidad_instituto_principal.id_ip=persona_instituto_especialidad.id_ip
                              INNER JOIN pasantias.instituto_principal
                              ON especialidad_instituto_principal.id_ip=instituto_principal.id_ip 
                              INNER JOIN pasantias.especialidad
                              On especialidad.id_especialidad=especialidad_instituto_principal.id_especialidad
                              INNER JOIN pasantias.temporadas_especialidad
                              ON especialidad.id_especialidad=temporadas_especialidad.id_especialidad
                              INNER JOIN pasantias.temporadas_estudiantes 
                              ON temporadas_especialidad.codigo_temporada_especialidad=temporadas_estudiantes.codigo_temporada_especialidad
                              AND temporadas_estudiantes.codigo_estudiante=estudiante.codigo_estudiante
                              INNER JOIN pasantias.temporadas_solicitud
                              ON temporadas_solicitud.codigo_temporada=temporadas_especialidad.codigo_temporada
                              AND persona.id_persona='$ID_PERSONA' AND temporadas_solicitud.estatus='EN CURSO' AND instituto_principal.id_ip=$ID_INSTITUTO");

          		$numer=pg_num_rows($slq);

	          		if($numer>0){
                      
                         $retorno=2;
                        return $retorno;

	          		}else{

                          $ConsultarEspecialidad=pg_query("SELECT estudiante.codigo_estudiante FROM pasantias.estudiante INNER JOIN pasantias.persona_instituto_especialidad
                                                          ON persona_instituto_especialidad.id_persona=estudiante.id_persona 
                                                          AND persona_instituto_especialidad.id_perfil=estudiante.id_perfil 
                                                          AND persona_instituto_especialidad.id_ip=estudiante.id_ip 
                                                          AND persona_instituto_especialidad.id_especialidad=estudiante.id_especialidad  
                                                          INNER JOIN pasantias.persona
                                                          ON persona.id_persona = persona_instituto_especialidad.id_persona
                                                          INNER JOIN pasantias.especialidad_instituto_principal
                                                          ON especialidad_instituto_principal.id_especialidad=persona_instituto_especialidad.id_especialidad
                                                          AND especialidad_instituto_principal.id_ip=persona_instituto_especialidad.id_ip
                                                          INNER JOIN pasantias.instituto_principal
                                                          ON especialidad_instituto_principal.id_ip=instituto_principal.id_ip 
                                                          INNER JOIN pasantias.especialidad
                                                          On especialidad.id_especialidad=especialidad_instituto_principal.id_especialidad

                                                          AND persona.id_persona='$ID_PERSONA'  AND instituto_principal.id_ip=$ID_INSTITUTO  AND especialidad.id_especialidad=$ID_ESPECIALIDAD");
                          $resultado=pg_num_rows($ConsultarEspecialidad);

                          if($resultado>0){
                            $retorno=3;
                            return $retorno;

                          }else{

                            $inserto3=pg_query("INSERT INTO  pasantias.persona_instituto_especialidad 
                                              (id_persona, id_especialidad, id_ip, id_perfil, estado, observacion, fecha_aceptacion)VALUES
                                              ('$ID_PERSONA', $ID_ESPECIALIDAD, $ID_INSTITUTO, 3, 'PENDIENTE', '$OBSERVACION', '$FECHA')");

                            ////////////////////////////////////////////////////////////////////////////////////////////////////

                            $ConsultarExpediente=pg_query("SELECT DISTINCT estudiante.expediente FROM pasantias.estudiante INNER JOIN pasantias.persona_instituto_especialidad
                                                          ON persona_instituto_especialidad.id_persona=estudiante.id_persona 
                                                          AND persona_instituto_especialidad.id_perfil=estudiante.id_perfil 
                                                          AND persona_instituto_especialidad.id_ip=estudiante.id_ip 
                                                          AND persona_instituto_especialidad.id_especialidad=estudiante.id_especialidad  
                                                          INNER JOIN pasantias.persona
                                                          ON persona.id_persona = persona_instituto_especialidad.id_persona
                                                          INNER JOIN pasantias.especialidad_instituto_principal
                                                          ON especialidad_instituto_principal.id_especialidad=persona_instituto_especialidad.id_especialidad
                                                          AND especialidad_instituto_principal.id_ip=persona_instituto_especialidad.id_ip
                                                          INNER JOIN pasantias.instituto_principal
                                                          ON especialidad_instituto_principal.id_ip=instituto_principal.id_ip 
                                                          INNER JOIN pasantias.especialidad
                                                          On especialidad.id_especialidad=especialidad_instituto_principal.id_especialidad
                                                          AND persona.cedula='$CEDULA'  AND instituto_principal.id_ip=$ID_INSTITUTO");
                            $registroEx=pg_fetch_array($ConsultarExpediente);
                            $expedienteViejo=$registroEx['expediente'];
                            $nummm=pg_num_rows($ConsultarExpediente);

                            if($nummm>0){

                                    $inserto2=pg_query("INSERT INTO pasantias.estudiante (id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)VALUES
                                                                                ($ID_PERSONA, $ID_ESPECIALIDAD, $ID_INSTITUTO, 3, '$expedienteViejo','PASANTE')");
                            }else{
                                    $inserto2=pg_query("INSERT INTO pasantias.estudiante (id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)VALUES
                                                                                ($ID_PERSONA, $ID_ESPECIALIDAD, $ID_INSTITUTO, 3, '$EXPEDIENTE','PASANTE')");

                            }


                             $registro =0;
                             $registro = pg_affected_rows($inserto2);
                                       
                                            pg_free_result($inserto2);
                         
                               return $registro;


                          }


                    }           

                   

          }else{

                              //--------INSERTO EN LA TABLA PERSONA---->>>>

                            $inserto=pg_query("INSERT INTO pasantias.persona (cedula, nombre, apellido)VALUES('$CEDULA', '$NOMBRE', '$APELLIDO')");

                            /////////////////////////////////////////////////////////////////////////////////////////////////////////////

                            $SELECC=pg_query("SELECT MAX(id_persona) FROM pasantias.persona");
                            $regist=pg_fetch_array($SELECC);
                            $id_persona=$regist[0];

                              //////////////////                                             /////////////////////////////////////////// 

                            $inserto3=pg_query("INSERT INTO  pasantias.persona_instituto_especialidad (id_persona, id_especialidad, id_ip, id_perfil, estado, observacion, fecha_aceptacion)VALUES
                                                                                                ('$id_persona', $ID_ESPECIALIDAD, $ID_INSTITUTO, 3, 'PENDIENTE', '$OBSERVACION', '$FECHA')");

                      

                            ////////////////////////////////////////////////////////////////////////////////////////////////////

                            $inserto2=pg_query("INSERT INTO pasantias.estudiante (id_persona,id_especialidad,id_ip,id_perfil,expediente,roll)VALUES
                                                                                ($id_persona, $ID_ESPECIALIDAD, $ID_INSTITUTO, 3, '$EXPEDIENTE','PASANTE')");

                             $registro =0;
                             $registro = pg_affected_rows($inserto2);
                                       
                                            pg_free_result($inserto2);
                         
                               return $registro; 

            }                       



        
        }//---FIN DE LA CLASE




        //---------ASIGNACION DE LOS TUTOR A LAS ESPECIALIDADES--->>>>

        function AsignarTutorAcademico_EspecialidadBD($Vista=array())
        {

          $retorno=0;

          $ID_ESPECIALIDAD      =$Vista['id_especialidad'];
          $ID_INSTITUTO         =$Vista['id_instituto'];
          $CODIGO               =$Vista['codigo'];
          $CEDULA               =$Vista['cedula_TA'];
          $NOMBRE               =$Vista['nombre_TA'];
          $APELLIDO             =$Vista['apellido_TA'];
          $OBSERVACION          =$Vista['observacion'];
          $FECHA                =$Vista['fecha'];
      

          //-----CONSULTO HABER SI EXISTE LA CEDULA--->>>
          $Sql=pg_query("SELECT id_persona FROM pasantias.persona WHERE cedula='$CEDULA' ;");
          $num=pg_num_rows($Sql);
          $registro=pg_fetch_array($Sql);
          $ID_PERSONA=$registro['id_persona']; 

          if($num>0){

              $slq=pg_query("SELECT codigo FROM pasantias.tutor_academico WHERE id_persona=$ID_PERSONA AND id_especialidad=$ID_ESPECIALIDAD");
              $numer=pg_num_rows($slq);

                if($numer>0){
                  $retorno=2;
                  return $retorno;

                }else{

                        
                                $inserto3=pg_query("INSERT INTO  pasantias.persona_instituto_especialidad (id_persona, id_especialidad, id_ip, id_perfil, estado, observacion, fecha_aceptacion)VALUES
                                                                                        ('$ID_PERSONA', $ID_ESPECIALIDAD, $ID_INSTITUTO, 4, 'PENDIENTE', '$OBSERVACION', '$FECHA')");

                                ////////////////////////////////////////////////////////////////////////////////////////////////////

                                $inserto2=pg_query("INSERT INTO pasantias.tutor_academico ( id_persona, id_especialidad,id_ip,id_perfil, codigo)VALUES
                                                                                    ($ID_PERSONA, $ID_ESPECIALIDAD, $ID_INSTITUTO,4, '$CODIGO')");

                                 $registro =0;
                                 $registro = pg_affected_rows($inserto2);
                                           
                                                pg_free_result($inserto2);
                             
                                   return $registro;

                            

                          }

          }else{



            

                                  //--------INSERTO EN LA TABLA PERSONA---->>>>

                                  $inserto=pg_query("INSERT INTO pasantias.persona (cedula, nombre, apellido)VALUES('$CEDULA', '$NOMBRE', '$APELLIDO')");

                                  /////////////////////////////////////////////////////////////////////////////////////////////////////////////

                                  $SELECC=pg_query("SELECT MAX(id_persona) FROM pasantias.persona");
                                  $regist=pg_fetch_array($SELECC);
                                  $id_persona=$regist[0];

                                    //////////////////                                             /////////////////////////////////////////// 

                                  $inserto3=pg_query("INSERT INTO  pasantias.persona_instituto_especialidad (id_persona, id_especialidad, id_ip, id_perfil, estado, observacion, fecha_aceptacion)VALUES
                                                                                                      ('$id_persona', $ID_ESPECIALIDAD, $ID_INSTITUTO, 4, 'PENDIENTE', '$OBSERVACION', '$FECHA')");

                                  ////////////////////////////////////////////////////////////////////////////////////////////////////

                                  
                                    $inserto2=pg_query("INSERT INTO pasantias.tutor_academico ( id_persona, id_especialidad,id_ip,id_perfil, codigo)VALUES
                                                                                            ($id_persona, $ID_ESPECIALIDAD, $ID_INSTITUTO,4, '$CODIGO')"); 

                                   $registro =0;
                                   $registro = pg_affected_rows($inserto2);
                                             
                                                  pg_free_result($inserto2);
                               
                                     return $registro;     


                              
                    
          }
          
        
        }




function ConsultarNombre_Especialidad_AutoComplete()
          {
              

          $sql="SELECT nombre_especialidad FROM pasantias.especialidad  ";
               
             $result=pg_query($sql);//ejecuta la tira sql

             $Registros = array();
             $cont=0;
            
            while($reg=pg_fetch_assoc($result)){

                  $Registros[]=$reg;

            }   
            echo json_encode($Registros);        
}



//----CEDULA--->>>
function ConsultarCedulaPersonas_Autocomplete()
          {
              

          $sql="SELECT cedula FROM pasantias.persona  ";
               
             $result=pg_query($sql);//ejecuta la tira sql

             $Registros = array();
             
            
            while($reg=pg_fetch_assoc($result)){

                  $Registros[]=$reg;

            }   
            echo json_encode($Registros);        
}

function ConsultarPersonas_Autocomplete($cedula)
          {
              

          $sql="SELECT nombre, apellido FROM pasantias.persona WHERE cedula='$cedula' ";
               
             $result=pg_query($sql);//ejecuta la tira sql

             $Registros = array();
             
            
            $reg=pg_fetch_assoc($result);

              
            
            echo json_encode($reg);        
}
//----FIN DE LA CEDULA



//------EXPEDIENTE--->>>
function ConsultarExpedientePersonas_Autocomplete($instituto_principal)
          {
              

          $sql="SELECT DISTINCT estudiante.expediente FROM pasantias.estudiante INNER JOIN pasantias.persona_instituto_especialidad
                ON persona_instituto_especialidad.id_persona=estudiante.id_persona 
                AND persona_instituto_especialidad.id_perfil=estudiante.id_perfil 
                AND persona_instituto_especialidad.id_ip=estudiante.id_ip 
                AND persona_instituto_especialidad.id_especialidad=estudiante.id_especialidad  
                INNER JOIN pasantias.persona
                ON persona.id_persona = persona_instituto_especialidad.id_persona
                INNER JOIN pasantias.especialidad_instituto_principal
                ON especialidad_instituto_principal.id_especialidad=persona_instituto_especialidad.id_especialidad
                AND especialidad_instituto_principal.id_ip=persona_instituto_especialidad.id_ip
                INNER JOIN pasantias.instituto_principal
                ON especialidad_instituto_principal.id_ip=instituto_principal.id_ip 
                INNER JOIN pasantias.especialidad
                On especialidad.id_especialidad=especialidad_instituto_principal.id_especialidad
                INNER JOIN pasantias.perfil
                on perfil.id_perfil = persona_instituto_especialidad.id_perfil AND instituto_principal.id_ip=$instituto_principal";
               
             $result=pg_query($sql);//ejecuta la tira sql

             $Registros = array();
             
            while($reg=pg_fetch_assoc($result)){

                  $Registros[]=$reg;

            }   
            echo json_encode($Registros);        
}


function ConsultarPersonas_AutocompleteExpedinete($expediente, $instituto_principal)
          {
              

          $sql="SELECT  persona.cedula, persona.nombre, persona.apellido FROM pasantias.estudiante INNER JOIN pasantias.persona_instituto_especialidad
                ON persona_instituto_especialidad.id_persona=estudiante.id_persona 
                AND persona_instituto_especialidad.id_perfil=estudiante.id_perfil 
                AND persona_instituto_especialidad.id_ip=estudiante.id_ip 
                AND persona_instituto_especialidad.id_especialidad=estudiante.id_especialidad  
                INNER JOIN pasantias.persona
                ON persona.id_persona = persona_instituto_especialidad.id_persona
                INNER JOIN pasantias.especialidad_instituto_principal
                ON especialidad_instituto_principal.id_especialidad=persona_instituto_especialidad.id_especialidad
                AND especialidad_instituto_principal.id_ip=persona_instituto_especialidad.id_ip
                INNER JOIN pasantias.instituto_principal
                ON especialidad_instituto_principal.id_ip=instituto_principal.id_ip 
                INNER JOIN pasantias.especialidad
                On especialidad.id_especialidad=especialidad_instituto_principal.id_especialidad
                INNER JOIN pasantias.perfil
                on perfil.id_perfil = persona_instituto_especialidad.id_perfil AND instituto_principal.id_ip=$instituto_principal AND estudiante.expediente='$expediente'";
               
             $result=pg_query($sql);//ejecuta la tira sql

             $Registros = array();
             
            
            $reg=pg_fetch_assoc($result);

              
            
            echo json_encode($reg);        
}
//----FIN DEL EXPEDIENMTE






//-----CODIGO.---->>>
function ConsultarCodigoPersonas_Autocomplete($instituto_principal)
          {
              

          $sql="SELECT  DISTINCT tutor_academico.codigo FROM pasantias.tutor_academico INNER JOIN pasantias.persona_instituto_especialidad
                ON persona_instituto_especialidad.id_persona=tutor_academico.id_persona 
                AND persona_instituto_especialidad.id_perfil=tutor_academico.id_perfil 
                AND persona_instituto_especialidad.id_ip=tutor_academico.id_ip 
                AND persona_instituto_especialidad.id_especialidad=tutor_academico.id_especialidad  
                INNER JOIN pasantias.persona
                ON persona.id_persona = persona_instituto_especialidad.id_persona
                INNER JOIN pasantias.especialidad_instituto_principal
                ON especialidad_instituto_principal.id_especialidad=persona_instituto_especialidad.id_especialidad
                AND especialidad_instituto_principal.id_ip=persona_instituto_especialidad.id_ip
                INNER JOIN pasantias.instituto_principal
                ON especialidad_instituto_principal.id_ip=instituto_principal.id_ip 
                INNER JOIN pasantias.especialidad
                On especialidad.id_especialidad=especialidad_instituto_principal.id_especialidad
                INNER JOIN pasantias.perfil
                on perfil.id_perfil = persona_instituto_especialidad.id_perfil AND instituto_principal.id_ip=$instituto_principal ";
               
             $result=pg_query($sql);//ejecuta la tira sql

             $Registros = array();
             
            
            while($reg=pg_fetch_assoc($result)){

                  $Registros[]=$reg;

            }   
            echo json_encode($Registros);        
}


function ConsultarPersonas_AutocompleteCodigo($codigo, $instituto_principal)
          {
              

          $sql="SELECT  persona.cedula, persona.nombre, persona.apellido FROM pasantias.tutor_academico INNER JOIN pasantias.persona_instituto_especialidad
                ON persona_instituto_especialidad.id_persona=tutor_academico.id_persona 
                AND persona_instituto_especialidad.id_perfil=tutor_academico.id_perfil 
                AND persona_instituto_especialidad.id_ip=tutor_academico.id_ip 
                AND persona_instituto_especialidad.id_especialidad=tutor_academico.id_especialidad  
                INNER JOIN pasantias.persona
                ON persona.id_persona = persona_instituto_especialidad.id_persona
                INNER JOIN pasantias.especialidad_instituto_principal
                ON especialidad_instituto_principal.id_especialidad=persona_instituto_especialidad.id_especialidad
                AND especialidad_instituto_principal.id_ip=persona_instituto_especialidad.id_ip
                INNER JOIN pasantias.instituto_principal
                ON especialidad_instituto_principal.id_ip=instituto_principal.id_ip 
                INNER JOIN pasantias.especialidad
                On especialidad.id_especialidad=especialidad_instituto_principal.id_especialidad
                INNER JOIN pasantias.perfil
                on perfil.id_perfil = persona_instituto_especialidad.id_perfil AND instituto_principal.id_ip=$instituto_principal AND tutor_academico.codigo='$codigo'";
               
             $result=pg_query($sql);//ejecuta la tira sql

             $Registros = array();
             
            
            $reg=pg_fetch_assoc($result);

              
            
            echo json_encode($reg);        
}
//FIN DEL CODIGO









/////////////////////////////---------------------O F I C I N A----------//////////////////////////


          function CargarCatalago_PersonasAsignadas_Ofciinas($ID_ORGANIZACION_P){

            $sql=pg_query("SELECT organizacion.id_organizacion, persona_organizacion_oficina.id_perfil , persona.cedula, persona.nombre , persona.apellido , oficina.id_oficina, oficina.nombre_oficina,
                          organizacion_oficina.estado, organizacion_oficina.descripcion, persona_organizacion_oficina.observacion, persona_organizacion_oficina.fecha_aceptacion FROM pasantias.persona 
                          INNER JOIN pasantias.persona_organizacion_oficina 
                            ON persona_organizacion_oficina.id_persona = persona.id_persona
                          INNER JOIN pasantias.organizacionmunicipio 
                            ON organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal
                          INNER JOIN pasantias.organizacion 
                            ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
                          INNER JOIN pasantias. organizacion_oficina
                            ON organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
                          INNER JOIN pasantias.oficina
                            ON oficina.id_oficina = organizacion_oficina.id_oficina
                            AND persona_organizacion_oficina.id_oficina = oficina.id_oficina AND
                            organizacionmunicipio.codigo_sucursal='$ID_ORGANIZACION_P'

               ");

            return $sql;

          }

          
    function AsignarPersona_Oficina_Organizacion($Vista=array()){
          $retorno=0;

          $ID_OFICINA           =$Vista['id_oficina'];
          $ID_ORGANIZACION      =$Vista['id_organizacion'];
          $CEDULA               =$Vista['cedula_p'];
          $NOMBRE               =$Vista['nombre_p'];
          $APELLIDO             =$Vista['apellido_p'];
          $OBSERVACION          =$Vista['observacion'];
          $PERFIL               =$Vista['perfil'];

          //------VERIFICO QUE PERFIL TENDRA--->>>
          if ($PERFIL =='EMPRESARIAL') {
            $ID_PERFIL=5;

                    //-----CONSULTO HABER SI EXISTE LA CEDULA--->>>
                  $Sql=pg_query("SELECT id_persona FROM pasantias.persona WHERE cedula='$CEDULA' ;");
                  $num=pg_num_rows($Sql);
                  $rgg=pg_fetch_array($Sql);
                  $id_persona_viejo=$rgg['id_persona'];

                  if($num>0){

                        $consulto=pg_query("SELECT  tutor_empresarial.codigo_tutor_empresarial FROM pasantias.tutor_empresarial INNER JOIN pasantias.persona_organizacion_oficina
                                            ON persona_organizacion_oficina.id_persona=tutor_empresarial.id_persona 
                                            AND persona_organizacion_oficina.id_perfil=tutor_empresarial.id_perfil 
                                            AND persona_organizacion_oficina.id_oficina=tutor_empresarial.id_oficina
                                            AND persona_organizacion_oficina.codigo_sucursal=tutor_empresarial.codigo_sucursal  
                                            INNER JOIN pasantias.persona
                                            ON persona.id_persona = persona_organizacion_oficina.id_persona
                                            INNER JOIN pasantias.organizacion_oficina
                                            ON organizacion_oficina.id_oficina=persona_organizacion_oficina.id_oficina
                                            AND organizacion_oficina.codigo_sucursal=persona_organizacion_oficina.codigo_sucursal
                                            INNER JOIN pasantias.organizacionmunicipio
                                            ON organizacionmunicipio.codigo_sucursal=organizacion_oficina.codigo_sucursal
                                            INNER JOIN pasantias.organizacion
                                            ON organizacion.id_organizacion=organizacionmunicipio.id_organizacion
                                            INNER JOIN pasantias.oficina
                                            On oficina.id_oficina=organizacion_oficina.id_oficina
                                            AND persona.cedula='$CEDULA'  AND organizacionmunicipio.codigo_sucursal='$ID_ORGANIZACION' AND oficina.id_oficina=$ID_OFICINA AND persona_organizacion_oficina.id_perfil=$ID_PERFIL");

                        $numm=pg_num_rows($consulto);
                          if($numm>0){
                                $retorno =2;
                                return $retorno;

                          }else{
                             //-----INSERTO EN LA INTYERMEDIA--->>
                              $inserto3=pg_query("INSERT INTO  pasantias.persona_organizacion_oficina (id_persona, id_oficina, codigo_sucursal, id_perfil, estado, observacion)VALUES
                                                                                            ($id_persona_viejo, $ID_OFICINA, '$ID_ORGANIZACION', $ID_PERFIL, 'APROBADO', '$OBSERVACION')");

                              //---INSERTO EN TUTOR EMPRESARIAL--->>
                              $inserto=pg_query("INSERT INTO pasantias.tutor_empresarial (codigo_sucursal,id_persona, id_oficina, id_perfil)VALUES
                                                                                         ('$ID_ORGANIZACION', $id_persona_viejo, $ID_OFICINA, $ID_PERFIL )");

                              
                               $registro =0;
                               $registro = pg_affected_rows($inserto);
                                         
                                              pg_free_result($inserto);
                           
                                 return $registro;        

                          }
                        

                  }else{
                        //--------INSERTO EN LA TABLA PERSONA---->>>>

                        $inserto=pg_query("INSERT INTO pasantias.persona (cedula, nombre, apellido)VALUES('$CEDULA', '$NOMBRE', '$APELLIDO')");

                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////

                        $SELECC=pg_query("SELECT MAX(id_persona) FROM pasantias.persona");
                        $regist=pg_fetch_array($SELECC);
                        $id_persona=$regist[0];


                        $inserto3=pg_query("INSERT INTO  pasantias.persona_organizacion_oficina (id_persona, id_oficina, codigo_sucursal, id_perfil, estado, observacion)VALUES
                                                                                            ($id_persona, $ID_OFICINA, '$ID_ORGANIZACION', $ID_PERFIL, 'APROBADO', '$OBSERVACION')");

                        //---INSERTO EN TUTOR EMPRESARIAL--->>
                        $inserto=pg_query("INSERT INTO pasantias.tutor_empresarial (codigo_sucursal,id_persona, id_oficina, id_perfil)VALUES
                                                                                   ('$ID_ORGANIZACION', $id_persona, $ID_OFICINA, $ID_PERFIL )");

                        ////////////////////////////////////////////////////////////////////////////////////////////////////

                        
                         $registro =0;
                         $registro = pg_affected_rows($inserto);
                                   
                                        pg_free_result($inserto);
                     
                           return $registro;             
                      }

          }else if($PERFIL =='CONTACTO') {

            $ID_PERFIL=2;

                    //-----CONSULTO HABER SI EXISTE LA CEDULA--->>>
                  $Sql=pg_query("SELECT id_persona FROM pasantias.persona WHERE cedula='$CEDULA' ;");
                  $num=pg_num_rows($Sql);
                  $rgg=pg_fetch_array($Sql);
                  $id_persona_viejo=$rgg['id_persona'];

                  if($num>0){

                          $consulto=pg_query("SELECT  persona.id_persona FROM pasantias.persona 
                                            INNER JOIN  pasantias.persona_organizacion_oficina
                                            ON persona.id_persona = persona_organizacion_oficina.id_persona
                                            INNER JOIN pasantias.organizacion_oficina
                                            ON organizacion_oficina.id_oficina=persona_organizacion_oficina.id_oficina
                                            AND organizacion_oficina.codigo_sucursal=persona_organizacion_oficina.codigo_sucursal
                                            INNER JOIN pasantias.organizacionmunicipio
                                            ON organizacionmunicipio.codigo_sucursal=organizacion_oficina.codigo_sucursal
                                            INNER JOIN pasantias.organizacion
                                            ON organizacion.id_organizacion=organizacionmunicipio.id_organizacion
                                            INNER JOIN pasantias.oficina
                                            On oficina.id_oficina=organizacion_oficina.id_oficina
                                            AND persona.id_persona='$id_persona_viejo'  AND organizacionmunicipio.codigo_sucursal='$ID_ORGANIZACION' AND oficina.id_oficina=$ID_OFICINA AND persona_organizacion_oficina.id_perfil=$ID_PERFIL");

                        $numm=pg_num_rows($consulto);
                          if($numm>0){
                                $retorno =2;
                                return $retorno;

                          }else{

                               $inserto3=pg_query("INSERT INTO  pasantias.persona_organizacion_oficina (id_persona, id_oficina, codigo_sucursal, id_perfil, estado, observacion)VALUES
                                                                                            ($id_persona_viejo, $ID_OFICINA, '$ID_ORGANIZACION', $ID_PERFIL, 'APROBADO', '$OBSERVACION')");
                               $registro =0;
                               $registro = pg_affected_rows($inserto3);
                                         
                                              pg_free_result($inserto3);
                           
                                 return $registro;   

                          }
                        

                  }else{
                        //--------INSERTO EN LA TABLA PERSONA---->>>>

                        $inserto=pg_query("INSERT INTO pasantias.persona (cedula, nombre, apellido)VALUES('$CEDULA', '$NOMBRE', '$APELLIDO')");

                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////

                        $SELECC=pg_query("SELECT MAX(id_persona) FROM pasantias.persona");
                        $regist=pg_fetch_array($SELECC);
                        $id_persona=$regist[0];
                        
                        ////////////////////////////////////////////////////////////////////////////////////////////////////

                        $inserto3=pg_query("INSERT INTO  pasantias.persona_organizacion_oficina (id_persona, id_oficina, codigo_sucursal, id_perfil, estado, observacion)VALUES
                                                                                            ($id_persona, $ID_OFICINA, '$ID_ORGANIZACION', $ID_PERFIL, 'APROBADO', '$OBSERVACION')");
                         $registro =0;
                         $registro = pg_affected_rows($inserto3);
                                   
                                        pg_free_result($inserto3);
                     
                           return $registro;             
                      }

            
          }

        
        }//----FIN DE ASIGNAR PERSONAS--->>




            function Consultar_ParaRegistrar_Office($ID_ORGANIZACION_P){
                     
                
                $sql="SELECT id_oficina FROM pasantias.organizacion_oficina,  pasantias.organizacionmunicipio WHERE 
              organizacion_oficina.id_oficina=(SELECT id_oficina FROM pasantias.oficina WHERE
              nombre_oficina = '$this->nombre' ) AND organizacionmunicipio.codigo_sucursal=organizacion_oficina.codigo_sucursal AND organizacionmunicipio.codigo_sucursal='$ID_ORGANIZACION_P'";
                
                $result=pg_query($sql);
                
                $num=pg_num_rows($result);
                  
                return $num;
                               
                
            } 
            
            
            
            
    function Consultar_ParaModificar_Office($ID_ORGANIZACION_P)
        {

      $result=pg_query("SELECT oficina.nombre_oficina, organizacion_oficina.estado, organizacion_oficina.descripcion FROM pasantias.organizacion_oficina, pasantias.oficina, pasantias.organizacionmunicipio 
        WHERE organizacion_oficina.id_oficina=oficina.id_oficina AND oficina.nombre_oficina='$this->nombre' AND organizacion_oficina.estado='$this->estatus' AND organizacion_oficina.descripcion='$this->descripcion' 
        AND organizacionmunicipio.codigo_sucursal=organizacion_oficina.codigo_sucursal AND organizacionmunicipio.codigo_sucursal='$ID_ORGANIZACION_P'");//ejecuta la tira sql

        $num=pg_num_rows($result);

        return $num;
              
        }


       function Modificar_Office($ID_ORGANIZACION_P)
       {

        if($this->descripcion==null){
            $this->descripcion='SIN DESCRIPCIÓN';
          }


           $retorno = 0;

          //-----CONSULTO A VER SI ES EL DEPARTAMENTO DE PASANTIAS--->
          $SQL=pg_query("SELECT nombre_oficina FROM pasantias.oficina WHERE id_oficina='$this->id'");
          $regis=pg_fetch_array($SQL);
          $nombre_o=$regis['nombre_oficina'];

          if($nombre_o=='PASANTIAS'){
            $retorno=4;
            return $retorno;

          }else{
              
               //--PRIMERO CONFIRMO DE QUE ESTE MODIFICANDO EL NOMBRE O NO
              $sqll=pg_query("SELECT nombre_oficina FROM pasantias.oficina WHERE id_oficina='$this->id'");
              $respuesta=pg_fetch_array($sqll);
              $nombre_o=$respuesta[0];
              if($nombre_o!=$this->nombre){
                    
                
              
                       ////////////////////////////////////////////////////////////////////////////////////////////////////
                      //-----CONSULTO CON EL NOMBRE HABRE SI COINSIDE EN LA BASE DE DATOS--->>
                      $consulto=pg_query("SELECT id_oficina FROM pasantias.oficina WHERE nombre_oficina='$this->nombre'");
                      $regis=pg_fetch_array($consulto);
                      $num=pg_num_rows($consulto);
                      $id_oficina_nuevo=$regis['id_oficina'];
                      if($num>0){
                            //---CON ID NUEVO--->>>
                            //--- EL NOMBRE QUE ESTAMOS COLOCANDO PARA MODIFICAR EL ANTERIOR-->>
                            //---EN ESTE PUNTO EL NOMBRE EXISTE PERO NO SE SI YO YA LO TENGO Y ALGUIEN LO TIENE ASIGNADO, ENTONCES CONSULTO--->>>
                            $consull=pg_query("SELECT * FROM pasantias.organizacion_oficina WHERE id_oficina=$id_oficina_nuevo AND codigo_sucursal='$ID_ORGANIZACION_P'");
                            $num=pg_num_rows($consull);
                            if($num>0){
                                
                                // QUIERE DECIR QUE YA LA TENGO---->
                                  //--PERO DEBO CONSULTA XQ PROBABLEMENTE ESTE EN ACTIVO O MODIFICADO--->>
                                  $sqql=pg_query("SELECT id_oficina FROM pasantias.organizacion_oficina WHERE id_oficina=$id_oficina_nuevo AND codigo_sucursal='$ID_ORGANIZACION_P' AND estado='MODIFICADO'");
                                  $nume=pg_num_rows($sqql);
                                  if($nume>0){
                                        //----SI EXISTE EN MODIFICADO CAMBIO A ACTIVO Y EL OTRO A MODIFICADO--->>
                                        //---PERO NATES DEBO CONSULTA HABER SI TIENE PERSONAS ASIGNADA--->>>
                                        //---->>>> DEBO VER SI HAY PERSONAS ASIGNADAS A LA ESPECIALIDA VIEJA, PARAQ PODER CAMBIAR EL ESTATUS A MODIFICADO--->>>
                                        $str_PersonasAsignadas=pg_query("SELECT * FROM pasantias.persona_organizacion_oficina WHERE id_oficina='$this->id' AND codigo_sucursal='$ID_ORGANIZACION_P'");
                                        $num=pg_num_rows($str_PersonasAsignadas);
                                        if($num>0){
                                            //---SI HAY PERSONAS AQUI, HAGO UN TRASPASO---SOLO EN LA INTERMEDIA--->>>

                                                  $retorno =8;
                                                      return $retorno;

                                                    }else{
                                                      $updd=pg_query("UPDATE pasantias.organizacion_oficina SET estado='ACTIVO' WHERE id_oficina=$id_oficina_nuevo AND codigo_sucursal='$ID_ORGANIZACION_P'");
                                                      $updd2="UPDATE pasantias.organizacion_oficina SET estado='MODIFICADO' WHERE id_oficina='$this->id' AND codigo_sucursal='$ID_ORGANIZACION_P'";
                                                      $result = pg_query($updd2) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                                                      $registro=0;
                                                      $registro=pg_affected_rows($result);
                                                          if ($registro>0) {
                                                                  $retorno=2;
                                                                  return $retorno;

                                                                }else{
                                                                  return $retorno;

                                                                }

                                                            }



                                      }else{

                                          $retorno=3;
                                          return $retorno;

                                      }

                            }else{

                                  //----  COMO SI EXISTE Y NO LO TENGO YO SOLO DEBO INSERTAR EN LA INTERMEDIA----
                                  //--PERO ANTES DEBO VER SI LA ANTERIOR OFICINA TIENE PERSONAS ASIGNADAS--->>>
                                  $ConsulPersona=pg_query("SELECT * FROM pasantias.persona_organizacion_oficina WHERE id_oficina='$this->id' AND codigo_sucursal='$ID_ORGANIZACION_P'");
                                  $numer=pg_num_rows($ConsulPersona);
                                  if($numer>0){
                                        //---QUIERE DECIR QUE HAY PERSONAS ASIGNADAS EN LA OFICINA QUE INTENTO MODIFICAR--->>>
                                        $retorno=5;
                                        return $retorno;

                                  }else{
                                        //----NO TIENE PERSONAS ASIGNADAS--- PUEDO REGISTRAR EN LA INTERMEDIA Y CAMBIAR EL ESTATUS ANTERIOR A MODIFICADO TRANQUILAMENTE--->>
                                        $insert="INSERT INTO pasantias.organizacion_oficina (id_oficina, codigo_sucursal, estado, descripcion, observacion)
                                                  VALUES($id_oficina_nuevo, '$ID_ORGANIZACION_P', '$this->estatus', '$this->descripcion', 'NO OBSERVACION')";
                                        $res = pg_query($insert) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                                        //----CAMBIO EL ESTATUS ANTERIOR--->>>
                                        $UP=pg_query("UPDATE pasantias.organizacion_oficina SET estado='MODIFICADO' WHERE id_oficina=$this->id AND codigo_sucursal='$ID_ORGANIZACION_P'");

                                                $registro =0;
                                                $registro = pg_affected_rows($res);
                                                pg_free_result($res); 
                                                if($registro>0){
                                                  $retorno=2;
                                                  return $retorno;
                                                }else{
                                                  return $registro;
                                                }

                                    }

                                }


                      }else{
                        //---EN ESTE CASO EL NOMBRE NO EXISTE--->>
                        ////---DEBO VER QUE VOY HACER CON EL REGISTRO ANTERIOR---->>
                          //---DEBO CONSULTAR EN LA INTERMEDIA HABER SI EL ID VIEJO LO ESTA USANDO OTRA ORGANIZACION Y VER SI PUEDO MODIFICAR O NO-->>
                           $SQL=pg_query("SELECT  organizacion_oficina.* FROM pasantias.organizacion_oficina WHERE id_oficina='$this->id' AND codigo_sucursal!='$ID_ORGANIZACION_P'");

                            $num=pg_num_rows($SQL);

                            if($num>0){
                                //----AQUI QUIERE DECIR QUE EL NOMBRE ANTERIOR LO ESTA USANDO OTRA INSTITUCION POR LO TANTO NO LO PUEDO MODIFICAR--->>
                                //---COMO LO ESTA USANDO ALGUIEN  DEBO HACER UN NUEVO REGISTRO(OFICINA)
                                //---ANTES DEBO CONSULTAR A VER SI HAY PERSONAS ASIGNADAS--->>
                                    $ConsulPersona=pg_query("SELECT * FROM pasantias.persona_organizacion_oficina WHERE id_oficina='$this->id' AND codigo_sucursal='$ID_ORGANIZACION_P'");
                                    $numer=pg_num_rows($ConsulPersona);
                                    if($numer>0){
                                      //---QUIERE DECIR QUE HAY PERSONAS ASIGNADAS EN LA OFICINA QUE INTENTO MODIFICAR--->>>
                                       //----REALIZO NUEVO REGISTRO CON TRASOASO-->> 
                                      $retorno=6;
                                      return $retorno;

                                    }else{
                                      //---HAGO UN NUEVO REGISTRO DESDE DEPARTAMENTO Y ASIGNO--->>
                                      $resultado=$this->Incluir_NuevaOficina_Asignar($ID_ORGANIZACION_P);
                                      //-----CAMBIO EL ESTATUS ANTERIOR--->>
                                      $UP=pg_query("UPDATE pasantias.organizacion_oficina SET estado='MODIFICADO' WHERE id_oficina=$this->id AND codigo_sucursal='$ID_ORGANIZACION_P'");

                                            if($resultado>0){
                                              $retorno=2;
                                              return $retorno;
                                            }else{
                                              return $retorno;
                                            }


                                    }
                            }else{
                                //------DESDE AQUI PUEDO MODIFICAR TODO-->>>

                                //---->>>>YA AQUI NADIE ESTA USANDO EL REGISTRO EN LA INTERMEDIA, PUEDO MODIFICAR EN AMBAS--->>>
                                //--PRIMERO CONSULTO HABER SI HAY PERSONAS ASIGNADA A ESTA OFICINA-->>
                                $ConsulPersona=pg_query("SELECT * FROM pasantias.persona_organizacion_oficina WHERE id_oficina='$this->id' AND codigo_sucursal='$ID_ORGANIZACION_P'");
                                $numer=pg_num_rows($ConsulPersona);
                                if($numer>0){
                                      //---QUIERE DECIR QUE HAY PERSONAS ASIGNADAS EN LA OFICINA QUE INTENTO MODIFICAR--->>>
                                    //---MODIFICO TODO--->>>
                                      $retorno=7;
                                      return $retorno;

                                }else{

                                      $strsql2=" UPDATE pasantias.oficina SET nombre_oficina='$this->nombre' WHERE id_oficina='$this->id' "; 

                                      $result2 = pg_query($strsql2) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                                      ///////////////////////////////////////////////////////////////////////////////////////////////////////

                                      $strsql3=" UPDATE pasantias.organizacion_oficina SET estado='$this->estatus' , descripcion='$this->descripcion'

                                       WHERE id_oficina=$this->id AND codigo_sucursal='$ID_ORGANIZACION_P' "; 

                                      $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                                          $registro =0;
                                          $registro = pg_affected_rows($result3);
                                         
                                              pg_free_result($result3);

                                                    if($registro==1){
                                                        $retorno=2;
                                                        return $retorno;
                                                    }else{
                                                        return $retorno;
                                                    }

                                }//----ELSE SI NO TIENE PERSONAS ASIGNADAS
                                
                                
                            }//---ELSE SI NO LA ESTA USANDO OTRA INSTITUTCION


                      }//----ELSE SI EL NOMBRE NO EXISTE EN LA BASE D
                
                      }else{
                        //----LOS NOMBRES SE MANTIENEN IGUALES, MODIFICO SOL OEN LA INTERMEDIA--->>
                        ///////////////////////////////////////////////////////////////////////////////////////////////////////

                          $strsql3=" UPDATE pasantias.organizacion_oficina SET estado='$this->estatus' , descripcion='$this->descripcion'

                           WHERE id_oficina=$this->id AND codigo_sucursal='$ID_ORGANIZACION_P' "; 

                            $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                             $registro =0;
                             $registro = pg_affected_rows($result3);

                                pg_free_result($result3);

                                if($registro==1){
                                    $retorno=2;
                                    return $retorno;
                                }else{
                                    return $retorno;
                                }  
                }

                
        }//---ELSE DE SI ES = PASANTIAS
          

          
}// FIN DE MODIFICAR---->>> 


//------BIENE DEL RETURN 6--->>>
//------REALIZAR OTRO REGISTRO Y ASIGNAR DE UNA VEZ, REALIZANDO EL TRASPASO DE LOS PERSONAS ASIGNADO A LA ANTERIOR OFCIINA---->>>
    function Incluir_NuevaOficina_Asignar_y_TraspasarPersonas($id_organizacion){
      
      $sql = " SELECT * FROM pasantias.ultimoid_departamento ; ";
            $resultt=pg_query($sql);//ejecuta la tira sql
            $id_departamento = 0;

            $fila = pg_fetch_array($resultt);
            
            $id_departamento = $fila['id'];

            $id_departamento=$id_departamento+1;
            
      $strsql=" INSERT INTO pasantias.departamento (id_departamento, estado,descripcion  ) 
                VALUES ($id_departamento, 'ACTIVO' , 'NO DESCRIPCION' ) "; 

                $result=pg_query($strsql);//ejecuta la tira sql

///////////////////////////////////////////////////////////////////////////////////////////////////////////////


            $strsql2=" INSERT INTO pasantias.oficina ( id_departamento , nombre_oficina  ) 
                        VALUES ( '$id_departamento' ,'$this->nombre' ) "; 

            $result2 = pg_query($strsql2) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                        

            $sql22 = " SELECT MAX(id_oficina) as id_oficina FROM pasantias.oficina";

            $result22=pg_query($sql22);//ejecuta la tira sql

                            
                            $fila2 = pg_fetch_array($result22);
                            $id_oficina = $fila2[0];
                              

/////////////////////////////////////                                    ////////////////////////////////////


            $strsql3=" INSERT INTO pasantias.organizacion_oficina ( codigo_sucursal , id_oficina , estado, descripcion ) 
                       VALUES ( '$id_organizacion' ,'$id_oficina' , 'ACTIVO', '$this->descripcion') "; 

            $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

           

            //---- HAGO LA "INSERCION" EN LA TABLA PERSONA_ORGANIZACION_OFICINA-TRASPASO-->
                    //---OBTENGO LOS ESTUDIANTES ASIGNADOS A LA ANTERIOR--->>>
                    $reciveList=array();
                    $reciveList=$this->SeleccionarPersonasDeOficina($this->id, $id_organizacion);

                    //---ACTUALIZO EL REGISTRO VIEJO--->>>>
                    $actualizoVieja=pg_query("UPDATE pasantias.organizacion_oficina SET estado='MODIFICADO' WHERE id_oficina='$this->id' AND codigo_sucursal='$id_organizacion'");

                    //---RECORRO AQUI PARA IR ACTUALIZANDO CADA PERSONA--->>
                    for ($i=0; $i <count($reciveList); $i++) { 
                      # code...
                    $updat="UPDATE pasantias.persona_organizacion_oficina SET id_oficina=$id_oficina WHERE id_persona=$reciveList[$i] AND codigo_sucursal='$id_organizacion' ";
                    $resul = pg_query($updat) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                      }

                        $regis =0;
                        $regis = pg_affected_rows($resul);
                                             
                            if($regis>0){
                              $retorno =2;
                              return $retorno;
                            }else{

                              return $retorno;
                            }

             

 }///-------FIN DE ASIGNAR NUEVA ESPECIALIDAD Y ASIGNAR----->


//----BIENE DEL RETURN 7
function ActualizarTodasLasTablas_TraspasandoPersonas_INTERNAMENTE($id_organizacion){
    
    $retorno =0;
    //---EN ESTE PUNTO YA PUEDO MODIFICAR TODO---->>>
        $strsql=" UPDATE pasantias.oficina SET nombre_oficina='$this->nombre' WHERE id_oficina='$this->id' "; 
        $result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
     
            $registro =0;
            $registro = pg_affected_rows($result);
           
   
        $strsql2=" UPDATE pasantias.organizacion_oficina SET estado='$this->estatus' , descripcion='$this->descripcion' WHERE id_oficina='$this->id' AND codigo_sucursal='$id_organizacion' "; 
        $result2 = pg_query($strsql2) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

            $registro2 =0;
            $registro2 = pg_affected_rows($result2);       

                if(($registro==1)&&($registro2==1)){
                  $retorno =2;
                  return $retorno;

                }else{

                  return $retorno;

                }


}


//---BIENE DEL RETURN 5---->>>
//------REALIZA UNA NUEVA INSERCION EN LA INTERMEDIA CON LOS DATOS DE PERSONAS ANTERIORES A OTRA OFICINA---->
function RealizarNuevaAsignacion_TraspasandoDatosPersonas($id_organizacion){

    $retorno=0;
    //-----CONSULTO CON EL NOMBRE HABRE SI COINSIDE EN LA BASE DE DATOS--->>
          $consulto=pg_query("SELECT id_oficina FROM pasantias.oficina WHERE nombre_oficina='$this->nombre'");
          $regis=pg_fetch_array($consulto);
          $num=pg_num_rows($consulto);
          $id_oficina_nuevo=$regis['id_oficina'];

                //---CON ID NUEVO--->>>
                //--- EL NOMBRE QUE ESTAMOS COLOCANDO PARA MODIFICAR EL ANTERIOR-->>
                //---EN ESTE PUNTO EL NOMBRE EXISTE PERO NO SE SI YO YA LO TENGO Y ALGUIEN LO TIENE ASIGNADO, ENTONCES CONSULTO--->>>
                $consull=pg_query("SELECT * FROM pasantias.organizacion_oficina WHERE id_oficina=$id_oficina_nuevo AND codigo_sucursal='$id_organizacion'");
                $num=pg_num_rows($consull);
                if($num>0){
                    //---QYUIERE DECIR QUE YA LO TERNGO ASIGNADO---->>
                    $retorno=3;
                    return $retorno;

                }else{
                     //COMO NO LA TENGO ME LA ASIGNO---->EN LA INTERMEDIA---->>
                    $strsql2=" INSERT INTO pasantias.organizacion_oficina  (id_oficina, codigo_sucursal, estado, descripcion)VALUES ($id_oficina_nuevo, '$id_organizacion', '$this->estatus', '$this->descripcion' ) ; "; 
                    $result2 = pg_query($strsql2) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                    //----SEGUIDO HAGO LA "INSERCION-ACTUALIZACION" EN LA TABLA PERSONA_ORGANIZACION_OFICINA-TRASPASO-->
                    $reciveList=array();
                    $reciveList=$this->SeleccionarPersonasDeOficina($this->id, $id_organizacion);

                    //---ACTUALIZO EL REGISTRO VIEJO--->>>>
                    $actualizoVieja=pg_query("UPDATE pasantias.organizacion_oficina SET estado='MODIFICADO' WHERE id_oficina='$this->id' AND codigo_sucursal='$id_organizacion'");

                    //---RECORRO AQUI PARA IR ACTUALIZANDO CADA PERSONA--->>
                    for ($i=0; $i <count($reciveList); $i++) { 
                      # code...
                    $updat="UPDATE pasantias.persona_organizacion_oficina SET id_oficina=$id_oficina_nuevo WHERE id_persona=$reciveList[$i] AND codigo_sucursal='$id_organizacion'";
                    $resul = pg_query($updat) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                      }

                        $regis =0;
                        $regis = pg_affected_rows($resul);
                                             
                            if($regis>0){
                              $retorno =2;
                              return $retorno;
                            }else{

                              return $retorno;
                            }

                      

}
}
        
//---BIENE DEL RETURN 8--->>
function ModificarEstatus_OficinasTraspandoBD($id_organizacion){

    $retorno=0;
    //-----CONSULTO CON EL NOMBRE HABRE SI COINSIDE EN LA BASE DE DATOS--->>
          $consulto=pg_query("SELECT id_oficina FROM pasantias.oficina WHERE nombre_oficina='$this->nombre'");
          $regis=pg_fetch_array($consulto);
          $num=pg_num_rows($consulto);
          $id_oficina_nuevo=$regis['id_oficina'];

             
                     //---ACTUALIZO EL REGISTRO VIEJO--->>>>
                    $actualizoVieja=pg_query("UPDATE pasantias.organizacion_oficina SET estado='MODIFICADO' WHERE id_oficina='$this->id' AND codigo_sucursal='$id_organizacion'");
                    $actualizoNueva=pg_query("UPDATE pasantias.organizacion_oficina SET estado='ACTIVO' WHERE id_oficina=$id_oficina_nuevo AND codigo_sucursal='$id_organizacion'");
          
                    //----SEGUIDO HAGO LA "INSERCION-ACTUALIZACION" EN LA TABLA PERSONA_ORGANIZACION_OFICINA-TRASPASO-->
                    $reciveList=array();
                    $reciveList=$this->SeleccionarPersonasDeOficina($this->id, $id_organizacion);

                   
                    //---RECORRO AQUI PARA IR ACTUALIZANDO CADA PERSONA--->>
                    for ($i=0; $i <count($reciveList); $i++) { 
                      # code...
                    $updat="UPDATE pasantias.persona_organizacion_oficina SET id_oficina=$id_oficina_nuevo WHERE id_persona=$reciveList[$i] AND codigo_sucursal='$id_organizacion' ";
                    $resul = pg_query($updat) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                      }

                        $regis =0;
                        $regis = pg_affected_rows($resul);
                                             
                            if($regis>0){
                              $retorno =2;
                              return $retorno;
                            }else{

                              return $retorno;
                            }

                      

}






//-------SE USA PARA HACER TRASPASOS DE LOS PERSONAS---->>
function SeleccionarPersonasDeOficina($id_oficina, $id_organizacion){

    $sql=pg_query("SELECT id_persona FROM pasantias.persona_organizacion_oficina WHERE codigo_sucursal='$id_organizacion' AND id_oficina=$id_oficina ");
    $Lista=array();
    $cont=0;
    while($registro=pg_fetch_array($sql)){

          $Lista[$cont]=$registro["id_persona"];

          $cont++;

    }

    return $Lista;

  }
  
  
  

            
            function Incluir_Oficina($ID_ORGANIZACION_P)
        { 
          if($this->descripcion==null){
            $this->descripcion='SIN DESCRIPCIÓN';
          }
          ////--- CONSULTO SI EL NOMBRE YA ESTA REGISTRADO EN LA MAESTRA--->>>
            $SQL=pg_query("SELECT id_oficina FROM pasantias.organizacion_oficina, pasantias.organizacionmunicipio WHERE 
              organizacion_oficina.id_oficina=(SELECT id_oficina FROM pasantias.oficina WHERE
              nombre_oficina = '$this->nombre')");


                 $NUM=pg_num_rows($SQL);

                 $REGISTRO=pg_fetch_array($SQL);

                 $id_oficina=$REGISTRO['id_oficina'];



                 //------SI EXISTE EN LA MAESTRA ASIGNO SOLO EN LA INTERMEDIA--->>>
                 if($NUM>0){

                    
                    $strsql3=" INSERT INTO pasantias.organizacion_oficina ( id_oficina , codigo_sucursal , estado, descripcion ) 

                    VALUES ( $id_oficina ,'$ID_ORGANIZACION_P' , 'ACTIVO', '$this->descripcion') "; 

                      $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                              $registro =0;
                              $registro = pg_affected_rows($result3);            

                        return $registro;

                //-------POR LO CONTRARIO, REGISTRO EN TODO DESDE CERO---->>>
                 }else{

            $sql = " SELECT * FROM pasantias.ultimoid_departamento ; ";
            $resultt=pg_query($sql);//ejecuta la tira sql
            $id_departamento = 0;

            $fila = pg_fetch_array($resultt);
            
            $id_departamento = $fila['id'];

            $id_departamento=$id_departamento+1;

            $strsql=" INSERT INTO pasantias.departamento (id_departamento, estado,descripcion  ) 

            VALUES ($id_departamento, '$this->estatus','$this->descripcion' ) "; 

             $result=pg_query($strsql);//ejecuta la tira sql

          ///////////////////////////////////////////////////////////////////////////////////

            $strsql=" INSERT INTO pasantias.oficina ( id_departamento , nombre_oficina  ) 

            VALUES (  '$id_departamento','$this->nombre' ) "; 

            $result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


            //////////////////////////////////////////////////////////////////////////////////////

            $sql22 = " SELECT MAX(id_oficina) FROM pasantias.oficina";

                  $result22=pg_query($sql22);//ejecuta la tira sql

                        $fila2 = pg_fetch_array($result22);

                        $id_oficina = $fila2[0];

                                    

            /////////////////////////////////////                                    ////////////////////////////////////



             $strsql3=" INSERT INTO pasantias.organizacion_oficina ( id_oficina , codigo_sucursal , estado, descripcion ) 

              VALUES ( '$id_oficina' ,'$ID_ORGANIZACION_P' , 'ACTIVO', '$this->descripcion') "; 

                      $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                              $registro =0;
                              $registro = pg_affected_rows($result3);            

                        return $registro;


                 }

         

}//-----FIN DE REGISTRA OFFICE----








//-----INCLUIR NUEVA OFICINA Y ASIGNAR A LA EMPRESA O INSTITUCION--->>>

// function Incluir_NuevaOficina_Asignar($ID_ORGANIZACION)
// {

//             $sql = " SELECT * FROM pasantias.ultimoid_departamento ; ";
//             $resultt=pg_query($sql);//ejecuta la tira sql
//             $id_departamento = 0;

//             $fila = pg_fetch_array($resultt);
            
//             $id_departamento = $fila['id'];

//             $id_departamento=$id_departamento+1;
            


//           //---CONSULTO DE NUEVO PARA ASEGURAR--->>>

//               $nuevaSQL="SELECT id_departamento FROM pasantias.departamento WHERE id_departamento='$id_departamento'";
//               $result=pg_query($nuevaSQL);
//               $num=pg_num_rows($result);

          

//             //-----CONDICION, PARA REGISTAR--->>>

//               if($num==0){

//                 $strsql2=" INSERT INTO pasantias.departamento ( id_departamento,estado,descripcion) 

//                 VALUES ('$id_departamento','$this->estatus','$this->descripcion' ) "; 

//                  $result2=pg_query($strsql2);//ejecuta la tira sql

//                 //--INSERTO EN OFICINA-->>>

//                 $strsql3=" INSERT INTO pasantias.oficina ( id_departamento , nombre_oficina  ) 

//                 VALUES (  '$id_departamento','$this->nombre' ) "; 

//                 $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

//                 $registro =0;
//                 $registro = pg_affected_rows($result3);

//                 if($registro>0){

//                   $MaxID=pg_query("SELECT MAX(id_oficina) FROM pasantias.oficina");
//                   $reg=pg_fetch_array($MaxID);
//                   $ID_OFICINA=$reg[0];

//                   //----ASIGNO AHORA---->>>

//                   $strsql4=" INSERT INTO pasantias.organizacion_oficina ( id_oficina, codigo_sucursal, estado, descripcion  ) 

//                   VALUES ( '$ID_OFICINA' , '$ID_ORGANIZACION' , 'ACTIVO','$this->descripcion') "; 

//                   $result4 = pg_query($strsql4) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


//                               $registro2 =0;
//                               $registro2 = pg_affected_rows($result4);


//                               return $registro2;
//                               }else{
//                                 return $registro;

//                               }

// }else{



//             $id_departamento=$id_departamento+1;
            
//             $strsql2=" INSERT INTO pasantias.departamento ( id_departamento,estado,descripcion) 

//                 VALUES ('$id_departamento','$this->estatus','$this->descripcion' ) "; 

//                  $result2=pg_query($strsql2);//ejecuta la tira sql

//                 //--INSERTO EN OFICINA-->>>

//                 $strsql3=" INSERT INTO pasantias.oficina ( id_departamento , nombre_oficina  ) 

//                 VALUES (  '$id_departamento','$this->nombre' ) "; 

//                 $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

//                 $registro =0;
//                 $registro = pg_affected_rows($result3);

//                 if($registro>0){

//                   $MaxID=pg_query("SELECT MAX(id_oficina) FROM pasantias.pasantias.oficina");
//                   $reg=pg_fetch_array($MaxID);
//                   $ID_OFICINA=$reg[0];

              


//                   //----ASIGNO AHORA---->>>

//                   $strsql4=" INSERT INTO pasantias.organizacion_oficina ( id_oficina, codigo_sucursal, estado, descripcion  ) 

//                   VALUES ( '$ID_OFICINA' , '$ID_ORGANIZACION' , 'ACTIVO','$this->descripcion') "; 

//                   $result4 = pg_query($strsql4) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


//                               $registro2 =0;
//                               $registro2 = pg_affected_rows($result4);


//                               return $registro2;
//                               }else{


//                                 return $registro;

//                               }





// }
// }
//---DFIN DE INCLUIR Y ASIGNAR OFICINA--->>>







function Consultar_Oficina_Catalago($ID_ORGANIZACION_PRINCIPAL)
{

$sql="SELECT oficina.id_oficina, oficina.nombre_oficina, organizacion_oficina.estado, organizacion_oficina.descripcion, organizacion_oficina.observacion FROM pasantias.oficina  
       JOIN  pasantias.departamento ON  oficina.id_departamento = pasantias.departamento.id_departamento
       JOIN  pasantias.organizacion_oficina ON organizacion_oficina.id_oficina = oficina.id_oficina  
       JOIN  pasantias.organizacionmunicipio ON organizacionmunicipio.codigo_sucursal = organizacion_oficina.codigo_sucursal WHERE organizacionmunicipio.codigo_sucursal='$ID_ORGANIZACION_PRINCIPAL' AND organizacion_oficina.estado!='MODIFICADO'";
	 	 
	 $result=pg_query($sql);//ejecuta la tira sql

	

	 return $result;
	 
}




function Consultar_OficinaActiva_Catalago()
{

$sql="SELECT * FROM pasantias.oficina  , pasantias.departamento WHERE

 pasantias.oficina.id_departamento  = pasantias.departamento.id_departamento AND pasantias.departamento.estado='ACTIVO'   ";
     
   $result=pg_query($sql);//ejecuta la tira sql

  

   return $result;
   
}





function ConsultarNombre_Oficinas_AutoComplete()
{
    

$sql="SELECT nombre_oficina FROM pasantias.oficina  ";
     
   $result=pg_query($sql);//ejecuta la tira sql

   $Registros = array();
 
  
  while($reg=pg_fetch_assoc($result)){


        $Registros[]=$reg;

  }   
  echo json_encode($Registros);

  
         
         
}



function Consultar_Nombre_TiempoReal_Office($Dato)
{
    

$sql="SELECT * FROM pasantias.oficina WHERE nombre_oficina = '".$Dato."' ";
	 	 
	 $result=pg_query($sql);//ejecuta la tira sql
         
         $num=pg_num_rows($result);
                            
                            if(!$num) {

                                
                            }else {
                                echo'<div id=""></div><font color="red" size="1" >Este nómbre ya existe en la base de datos</font>';

                               
                             }
	 
	 
}




	 

}
?>