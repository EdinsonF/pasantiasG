<<<<<<< HEAD
<?php

include_once("../../../BASE_DATOS/Conect.php");

 $ConexionBD =new Conexion();
 $ConexionBD->Conectar();

class Solicitud{


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








function Consultar_Solicitud_Catalago($ID_INSTITUCION)
{

$sql="SELECT id,tipo_solicitud.id_tipo_solicitud ,nombre_tipo_solicitud, especialidad.id_especialidad,nombre_especialidad, cantidad, solicitud.estatus, observacion FROM pasantias.solicitud  
JOIN  pasantias.especialidad ON  especialidad.id_especialidad = pasantias.solicitud.id_especialidad
JOIN  pasantias.tipo_solicitud ON tipo_solicitud.id_tipo_solicitud=pasantias.solicitud.id_tipo_solicitud 
where pasantias.solicitud.id_organizacion='$ID_INSTITUCION' ORDER BY id ";
	 	 
	 $result=pg_query($sql);//ejecuta la tira sql

	

	 return $result;
	 
}

/*
SELECT temporadas_solicitud.codigo_temporada, codigo_temporada_especialidad, tipo_solicitud.id_tipo_solicitud ,nombre_tipo_solicitud , periodo_solicitud.id_lapso ,
numero_lapso, temporadas_especialidad.id_especialidad, nombre_especialidad, nombre_tipo_especialidad,fecha_inicio, fecha_fin FROM pasantias.tipo_solicitud  
JOIN pasantias.temporadas_solicitud ON  temporadas_solicitud.id_tipo_solicitud = pasantias.tipo_solicitud.id_tipo_solicitud 
and pasantias.temporadas_solicitud.estatus='PREPARADA'
JOIN pasantias.temporadas_especialidad ON temporadas_especialidad.codigo_temporada =temporadas_solicitud.codigo_temporada
JOIN pasantias.especialidad ON especialidad.id_especialidad=temporadas_especialidad.id_especialidad
JOIN pasantias.tipo_especialidad ON tipo_especialidad.id_tipo_especialidad=especialidad.id_tipo_especialidad
JOIN pasantias.periodo_solicitud ON periodo_solicitud.id_periodo = pasantias.temporadas_solicitud.id_periodo
JOIN pasantias.lapso_academico ON lapso_academico.id_lapso = pasantias.periodo_solicitud.id_lapso ORDER BY nombre_tipo_solicitud

*/


    function consultTipo_Solicitud()
  {
$strsql ="SELECT temporadas_solicitud.codigo_temporada, codigo_temporada_especialidad, tipo_solicitud.id_tipo_solicitud ,nombre_tipo_solicitud , periodo_solicitud.id_lapso ,
numero_lapso, temporadas_especialidad.id_especialidad, nombre_especialidad, nombre_tipo_especialidad,fecha_inicio, fecha_fin FROM pasantias.tipo_solicitud  
JOIN pasantias.temporadas_solicitud ON  temporadas_solicitud.id_tipo_solicitud = pasantias.tipo_solicitud.id_tipo_solicitud 
and pasantias.temporadas_solicitud.estatus='EN CURSO'
JOIN pasantias.temporadas_especialidad ON temporadas_especialidad.codigo_temporada =temporadas_solicitud.codigo_temporada
JOIN pasantias.especialidad ON especialidad.id_especialidad=temporadas_especialidad.id_especialidad
JOIN pasantias.tipo_especialidad ON tipo_especialidad.id_tipo_especialidad=especialidad.id_tipo_especialidad
JOIN pasantias.periodo_solicitud ON periodo_solicitud.id_periodo = pasantias.temporadas_solicitud.id_periodo
JOIN pasantias.lapso_academico ON lapso_academico.id_lapso = pasantias.periodo_solicitud.id_lapso ORDER BY nombre_tipo_solicitud;"; 

  $result=pg_query($strsql);//ejecuta la tira sql
          
return $result;

    

  }

  /// MOSTRAR SOLICITUDES
/*
SELECT distinct solicitud.codigo_solicitud, solicitud.codigo_temporada, temporadas_solicitud.id_tipo_solicitud, nombre_tipo_solicitud, fecha_solicitud, cantidad_postulantes, nombre_especialidad, solicitudes_recibidas.table_column, solicitudes_recibidas.valor FROM pasantias.solicitud  
JOIN  pasantias.solicitudes_enviadas ON solicitudes_enviadas.codigo_solicitud = pasantias.solicitud.codigo_solicitud 
and pasantias.solicitudes_enviadas.table_column='especialidad.id_especialidad'and valor='$id_especialidad' and pasantias.solicitud.descripcion='ESPECIFICA'
JOIN pasantias.solicitudes_recibidas ON solicitudes_recibidas.table_column='estudiante.codigo_estudiante' and pasantias.solicitudes_recibidas.valor='$codigo_estudiante'
JOIN pasantias.especialidad ON especialidad.id_especialidad=CAST(solicitudes_enviadas.valor as int )
JOIN pasantias.temporadas_solicitud ON temporadas_solicitud.codigo_temporada=solicitud.codigo_temporada
JOIN pasantias.tipo_solicitud ON tipo_Solicitud.id_tipo_solicitud=temporadas_solicitud.id_tipo_solicitud
*/

  function caragar_solicitudes_especificas_1($codigo_estudiante){
$strsql="SELECT distinct solicitud.codigo_solicitud, solicitud.codigo_temporada_especialidad, temporadas_solicitud.id_tipo_solicitud, nombre_tipo_solicitud,
fecha_solicitud, cantidad_postulantes, nombre_especialidad 
FROM pasantias.solicitud  
JOIN  pasantias.solicitudes_enviadas ON solicitudes_enviadas.codigo_solicitud = pasantias.solicitud.codigo_solicitud 
and pasantias.solicitud.descripcion='ESPECIFICA'

JOIN pasantias.temporadas_especialidad ON solicitud.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
JOIN pasantias.temporadas_estudiantes ON temporadas_estudiantes.codigo_temporada_especialidad= temporadas_especialidad.codigo_temporada_especialidad

AND temporadas_especialidad.codigo_temporada_especialidad = temporadas_estudiantes.codigo_temporada_especialidad
 AND temporadas_estudiantes.codigo_estudiante='$codigo_estudiante' 
JOIN pasantias.especialidad ON especialidad.id_especialidad=temporadas_especialidad.id_especialidad

JOIN pasantias.temporadas_solicitud ON temporadas_solicitud.codigo_temporada=temporadas_especialidad.codigo_temporada
JOIN pasantias.tipo_solicitud ON tipo_Solicitud.id_tipo_solicitud=temporadas_solicitud.id_tipo_solicitud";
//where pasantias.solicitud.id_especialidad='1' ORDER BY id ";
$result=pg_query($strsql);//ejecuta la tira sql
          
return $result;
}

function cargar_solicitudes_p1($codigo_estudiante){

$strsql="SELECT distinct solicitud.codigo_solicitud, solicitud.codigo_temporada_especialidad, temporadas_solicitud.id_tipo_solicitud, nombre_tipo_solicitud,
fecha_solicitud, cantidad_postulantes, nombre_especialidad 
FROM pasantias.solicitud  
JOIN  pasantias.solicitudes_enviadas ON solicitudes_enviadas.codigo_solicitud = pasantias.solicitud.codigo_solicitud 
and pasantias.solicitud.descripcion='GENERAL'

JOIN pasantias.temporadas_especialidad ON solicitud.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
JOIN pasantias.temporadas_estudiantes ON temporadas_estudiantes.codigo_temporada_especialidad= temporadas_especialidad.codigo_temporada_especialidad

AND temporadas_especialidad.codigo_temporada_especialidad = temporadas_estudiantes.codigo_temporada_especialidad
 AND temporadas_estudiantes.codigo_estudiante='$codigo_estudiante' 
JOIN pasantias.especialidad ON especialidad.id_especialidad=temporadas_especialidad.id_especialidad

JOIN pasantias.temporadas_solicitud ON temporadas_solicitud.codigo_temporada=temporadas_especialidad.codigo_temporada
JOIN pasantias.tipo_solicitud ON tipo_Solicitud.id_tipo_solicitud=temporadas_solicitud.id_tipo_solicitud";
//where pasantias.solicitud.id_especialidad='1' ORDER BY id ";
$result=pg_query($strsql);//ejecuta la tira sql
          
return $result;
}

function cargar_solicitudes_p2($codigo_solicitud){
$strsql="SELECT distinct valor FROM pasantias.solicitudes_enviadas where codigo_solicitud='$codigo_solicitud' and table_column = 'organizacionmunicipio.codigo_sucursal'";
$result=pg_query($strsql);//ejecuta la tira sql
return $result;
}

function cargar_solicitudes_p3($codigo_sucursal, $codigo_solicitud){
$strsql="SELECT distinct nombre_organizacion, organizacion.id_tipo_organizacion, nombre_tipo_organizacion, table_column, valor FROM pasantias.solicitudes_enviadas
JOIN  pasantias.organizacionmunicipio ON organizacionmunicipio.codigo_sucursal=solicitudes_enviadas.valor 
and solicitudes_enviadas.table_column = 'organizacionmunicipio.codigo_sucursal'and valor='$codigo_sucursal'
JOIN pasantias.organizacion ON organizacion.id_organizacion=organizacionmunicipio.id_organizacion
JOIN pasantias.tipo_organizacion ON tipo_organizacion.id_tipo_organizacion=organizacion.id_tipo_organizacion and solicitudes_enviadas.codigo_solicitud='$codigo_solicitud'";
$result=pg_query($strsql);//ejecuta la tira sql
return $result;
}

function cargar_solicitudes_p4($codigo_solicitud){
$strsql="SELECT distinct solicitud_requisito.id_requisito, nombre_requisito FROM pasantias.requisito
JOIN  pasantias.solicitud_requisito ON solicitud_requisito.codigo_solicitud='$codigo_solicitud' and
solicitud_requisito.id_requisito=requisito.id_requisito
";
$result=pg_query($strsql);//ejecuta la tira sql
return $result;
}


function cargar_solicitudes_p5($codigo_solicitud){
$strsql="SELECT distinct valor FROM pasantias.solicitudes_enviadas where codigo_solicitud='$codigo_solicitud' and table_column = 'persona.id_persona'";
$result=pg_query($strsql);//ejecuta la tira sql
return $result;
}

function cargar_solicitudes_p6($id_persona, $codigo_solicitud){
$strsql="SELECT distinct nombre, apellido,telefono, correo, table_column, valor FROM pasantias.solicitudes_enviadas
JOIN  pasantias.persona ON solicitudes_enviadas.table_column = 'persona.id_persona'and valor='$id_persona'
AND persona.id_persona= CAST(solicitudes_enviadas.valor as int ) and solicitudes_enviadas.codigo_solicitud='$codigo_solicitud'";
$result=pg_query($strsql);//ejecuta la tira sql
return $result;
}

//// FIN DE MOSTAR SOLICITUDES

function cargar_requisitos(){

$strsql=" SELECT id_requisito, nombre_requisito FROM pasantias.requisito where estatus='ACTIVO' ORDER BY id_requisito ";
//where pasantias.solicitud.id_especialidad='1' ORDER BY id ";
$result=pg_query($strsql);//ejecuta la tira sql
          
return $result;
}


function cargar_modal_estudiantes_especialidad($id_especialidad, $tipo_solicitud){

$strsql="SELECT persona.nombre ||' '|| persona.apellido as estudiantedate, especialidad.nombre_especialidad ,estudiante.expediente ,estudiante.codigo_estudiante FROM 
   pasantias.estudiante 
      JOIN pasantias.persona_instituto_especialidad 
      ON estudiante.id_persona = persona_instituto_especialidad.id_persona 
      AND estudiante.id_especialidad = persona_instituto_especialidad.id_especialidad AND estudiante.id_especialidad=$id_especialidad
      AND estudiante.id_ip = persona_instituto_especialidad.id_ip
      AND estudiante.id_perfil = persona_instituto_especialidad.id_perfil JOIN pasantias.instituto_principal 
      ON  instituto_principal.id_ip= persona_instituto_especialidad.id_ip JOIN pasantias.organizacion 
      ON organizacion .id_organizacion=instituto_principal.id_organizacion JOIN pasantias.organizacionmunicipio
      ON organizacionmunicipio.id_organizacion = organizacion.id_organizacion
      JOIN pasantias.persona 
      ON persona.id_persona = persona_instituto_especialidad.id_persona JOIN pasantias.especialidad
      ON especialidad.id_especialidad = persona_instituto_especialidad.id_especialidad
      JOIN pasantias.temporadas_estudiantes ON pasantias.temporadas_estudiantes.codigo_estudiante=estudiante.codigo_estudiante 
      AND pasantias.temporadas_estudiantes.codigo_temporada_especialidad='$tipo_solicitud'";
$result=pg_query($strsql);
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

function buscarcodigo()
{
   //$sql= pg_query("SELECT CAST(MAX(codigo_solicitud) as int) +1   FROM pasantias.solicitud ;");
   $sql= pg_query("SELECT  MAX( CAST(codigo_solicitud as int) ) + 1, 1 as auxiliar FROM pasantias.solicitud  ;");

   $var = pg_fetch_array($sql);
   if($var[0]==''){
    $var[0]=$var[1];
  }
   return $var[0];
}

function Incluir_Solicitud($Vista=array())
{

    $registro =0;
    $id_instituto          = $Vista['id_instituto'];
    $codigo_sucursal       = $Vista['codigo_sucursal'];
    $id_persona            = $Vista['id_persona'];
    $tipo_solicitud        = $Vista['tipo_solicitud'];
    $especialidad          = $Vista['especialidad'];
    $cantidad              = $Vista['cantidad'];
    $estatus_s             = $Vista['estatus_s'];
    $id_requisitos         = $Vista['id_requisitos'];
    $observacion           = $Vista['observacion'];
    $codigo_estudiante     = $Vista['codigo_estudiante'];

               

  
  ////////////////////////////////////////                            /////////////////////////////////////////////////////
              
            $ptj = "SELECT codigo_estudiante FROM pasantias.temporadas_estudiantes WHERE codigo_temporada_especialidad='$tipo_solicitud' limit 1";
            $ptjn=pg_query($ptj);//ejecuta la tira sql
            $na = pg_fetch_array($ptjn);
            $codigo_estudiante = $na[0];

      ////////////////////////////////////////                            /////////////////////////////////////////////////////          

             $codigo = $this->buscarcodigo();
             

            $strsql1=" INSERT INTO pasantias.solicitud (codigo_solicitud, fecha_solicitud , cantidad_postulantes, estatus, descripcion, codigo_estudiante, codigo_temporada_especialidad) 

            VALUES ('$codigo', now() ,'$cantidad' , '$estatus_s', '$observacion','$codigo_estudiante','$tipo_solicitud') "; 

            $result1 = pg_query($strsql1) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                        


            $sql22 = "SELECT  MAX( CAST(codigo_solicitud as int) ) FROM pasantias.solicitud ";

            $result22=pg_query($sql22);//ejecuta la tira sql

                            

                            $fila2 = pg_fetch_array($result22);

                            $codigo_solicitud = $fila2[0];

                                    

/////////////////////////////////////                                    ////////////////////////////////////


for($i=0;$i<count($id_requisitos);$i++)
{

            $strsql3=" INSERT INTO pasantias.solicitud_requisito (id_requisito , codigo_solicitud, estatus) 

            VALUES ( '$id_requisitos[$i]' ,'$codigo_solicitud' , 'ACTIVO') "; 

            $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

}

///////////////////////////////    INSERTO EN SOLICITUDES ENVIADAS          /////////////////////////////
/*
$strsql4=" INSERT INTO pasantias.solicitudes_enviadas (codigo_solicitud, table_column, valor, estatus) 

            VALUES ( '$codigo_solicitud' ,'especialidad.id_especialidad', '$especialidad' , 'MOSTRAR') "; 

            $result4 = pg_query($strsql4) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error()); */



$strsql5=" INSERT INTO pasantias.solicitudes_enviadas (codigo_solicitud, table_column, valor, estatus) 

            VALUES ( '$codigo_solicitud' ,'persona.id_persona', '$id_persona' , 'MOSTRAR') "; 

            $result5 = pg_query($strsql5) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());



$strsql5=" INSERT INTO pasantias.solicitudes_enviadas (codigo_solicitud, table_column, valor, estatus) 

            VALUES ( '$codigo_solicitud' ,'organizacionmunicipio.codigo_sucursal', '$codigo_sucursal' , 'MOSTRAR') "; 

            $result5 = pg_query($strsql5) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


            

/////////////////////////////                  //////////////////////////

// incluyo cuando la solicitud es dirigida de empresa a estudiantes
              if($observacion=='ESPECIFICA'){
for($i=0;$i<count($codigo_estudiante);$i++)
{

            $strsql6=" INSERT INTO pasantias.solicitudes_recibidas(codigo_solicitud, table_column, valor, estatus, fecha_postulacion) 

            VALUES ('$codigo_solicitud','estudiante.codigo_estudiante' ,'$codigo_estudiante[$i]', 'EN ESPERA',  now() ) "; 

            $result6 = pg_query($strsql6) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

}
              }

// fin de la inclusuion dirrigida

                              $registro =0;
                              $registro = pg_affected_rows($result3);

                      

            return $registro;







return $Vista['id_requisitos'];
          

}

//// verificaicon de postulacion 


 function Consultar_ParaRegistrarPostulacion($Vista=array())
 {
    $codigo_estudiante      = $Vista['codigo_estudiante'];
    $id_solicitud          = $Vista['id_solicitud'];


$sql="SELECT estatus FROM pasantias.solicitudes_recibidas WHERE codigo_solicitud='$id_solicitud' and table_column='estudiante.codigo_estudiante' and valor='$codigo_estudiante'";
            
                 $result=pg_query($sql);//ejecuta la tira sql

                 $num=pg_num_rows($result);

              return $num;
        }



function Incluir_Postulacion($Vista=array())
{

 $registro =0;
    $codigo_estudiante      = $Vista['codigo_estudiante'];
    $id_solicitud          = $Vista['id_solicitud'];


              
$strsql3=" INSERT INTO pasantias.solicitudes_recibidas (codigo_solicitud, table_column, valor, estatus) 

            VALUES ( '$id_solicitud' ,'estudiante.codigo_estudiante', '$codigo_estudiante' , 'EN ESPERA') "; 

              $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


             
              $registro = pg_affected_rows($result3);

                                  

                        return $registro;

}

/// fin de verfivavion de postulacion



function Modificar_Solicitud($Vista=array())
{

 $registro =0;
    $id_instituto          = $Vista['id_instituto'];
    $id_solicitud          = $Vista['id_solicitud'];
    $tipo_solicitud        = $Vista['tipo_solicitud'];
    $especialidad          = $Vista['especialidad'];
    $cantidad              = $Vista['cantidad'];
    $requisitos            = $Vista['requisitos'];

              
$strsql3=" UPDATE pasantias.Solicitud SET  id_tipo_solicitud='$tipo_solicitud' ,id_especialidad='$especialidad' , observacion='$requisitos', cantidad='$cantidad' where id='$id_solicitud' and id_organizacion=' $id_instituto' "; 

              $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


             
              $registro = pg_affected_rows($result3);

                                  

                        return $registro;

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





//------BIENE DEL RETURN 4--->>>
//------REALIZAR OTRO REGISTRO Y ASIGNAR DE UNA VEZ, REALIZANDO EL TRASPASO DE LOS ESTUDIANTES ASIGNADO A LA ANTERIOR ESPECIALIDAD---->>>
    function Incluir_NuevaEspecialidad_Asignar_y_TraspasarEstudiantes($id_instituto){

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


//----BIENE DEL RETURN 6
function ActualizarTodasLasTablas_TraspasandoEstudiantes_INTERNAMENTE($id_instituto){

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


function ModificarEstatusEspecialidadBD($id_instituto){

    $retorno=0;
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
                                

}



//---BIENE DEL RETURN 4---->>>
//------REALIZA UNA NUEVA INSERCION EN LA INTERMEDIA CON LOS DATOS DE ESTUDIANTES ANTERIORES A OTRA ESPECIALIDAD---->
function RealizarNuevaAsignacion_TraspasandoDatosEstudiantes($id_instituto){

    $retorno=0;
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

}


//-------SE USA PARA HACER TRASPASOS DE LOS ESTUDIANTES---->>
function SeleccionarEstudiantesDeEspecialidad($id_especialidad, $id_instituto){

    $sql=pg_query("SELECT id_persona FROM pasantias.persona_instituto_especialidad WHERE id_ip=$id_instituto AND id_especialidad=$id_especialidad ");
    $Lista=array();
    $cont=0;
    while($registro=pg_fetch_array($sql)){

          $Lista[$cont]=$registro["id_persona"];

          $cont++;

    }

    return $Lista;

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
          $Sql=pg_query("SELECT * FROM pasantias.persona WHERE cedula='$CEDULA' ;");
          $num=pg_num_rows($Sql);

          if($num>0){
            $retorno=2;
            return $retorno;

          }else{
            //--------INSERTO EN LA TABLA PERSONA---->>>>

            $inserto=pg_query("INSERT INTO pasantias.persona (cedula, nombre, apellido)VALUES('$CEDULA', '$NOMBRE', '$APELLIDO')");

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $SELECC=pg_query("SELECT MAX(id_persona) FROM pasantias.persona");
            $regist=pg_fetch_array($SELECC);
            $id_persona=$regist[0];

              //////////////////                                             /////////////////////////////////////////// 

            $inserto2=pg_query("INSERT INTO pasantias.estudiante (id_persona, expediente)VALUES($id_persona, '$EXPEDIENTE')");


            ////////////////////////////////////////////////////////////////////////////////////////////////////

            $inserto3=pg_query("INSERT INTO  pasantias.persona_instituto_especialidad (id_persona, id_especialidad, id_ip, id_perfil, estado, observacion, fecha_solicitud, fecha_aceptacion)VALUES
                                                                                ('$id_persona', $ID_ESPECIALIDAD, $ID_INSTITUTO, 3, 'APROBADO', '$OBSERVACION', '$FECHA', '$FECHA' )");
             $registro =0;
             $registro = pg_affected_rows($inserto3);
                       
                            pg_free_result($inserto3);
         
               return $registro;             
          }
          


        
        }


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
          $FECHA                =$Vista['fecha'];
          $OBSERVACION          =$Vista['observacion'];
      

          //-----CONSULTO HABER SI EXISTE LA CEDULA--->>>
          $Sql=pg_query("SELECT * FROM pasantias.persona WHERE cedula='$CEDULA' ;");
          $num=pg_num_rows($Sql);

          if($num>0){
            $retorno=2;
            return $retorno;

          }else{
            //--------INSERTO EN LA TABLA PERSONA---->>>>

            $inserto=pg_query("INSERT INTO pasantias.persona (cedula, nombre, apellido)VALUES('$CEDULA', '$NOMBRE', '$APELLIDO')");

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $SELECC=pg_query("SELECT MAX(id_persona) FROM pasantias.persona");
            $regist=pg_fetch_array($SELECC);
            $id_persona=$regist[0];

              //////////////////                                             /////////////////////////////////////////// 

            $inserto2=pg_query("INSERT INTO pasantias.tutor_academico (id_persona, codigo)VALUES($id_persona, '$CODIGO')");


            ////////////////////////////////////////////////////////////////////////////////////////////////////

            $inserto3=pg_query("INSERT INTO  pasantias.persona_instituto_especialidad (id_persona, id_especialidad, id_ip, id_perfil, estado, observacion, fecha_solicitud, fecha_aceptacion)VALUES
                                                                                ('$id_persona', $ID_ESPECIALIDAD, $ID_INSTITUTO, 4, 'APROBADO', '$OBSERVACION', '$FECHA', '$FECHA' )");
             $registro =0;
             $registro = pg_affected_rows($inserto3);
                       
                            pg_free_result($inserto3);
         
               return $registro;             
          }
          


        
        }




        function ConsultarNombre_Especialidad_AutoComplete()
          {
              

          $sql="SELECT nombre_especialidad FROM pasantias.especialidad  ";
               
             $result=pg_query($sql);//ejecuta la tira sql

             $Registros = array();
             $cont=0;
            
            while($reg=pg_fetch_array($result)){


                  $Registros[$cont]=$reg['nombre_especialidad'];


                  $cont++;
            }   
            echo json_encode($Registros);

  
         
         
}

















/////////////////////////////---------------------O F I C I N A----------//////////////////////////


          function CargarCatalago_PersonasAsignadas_Ofciinas($ID_ORGANIZACION_P){

            $sql=pg_query("SELECT organizacion.id_organizacion, persona.cedula, persona.nombre , persona.apellido , oficina.id_oficina, oficina.nombre_oficina,
                          organizacion_oficina.estado, organizacion_oficina.descripcion 
                          FROM pasantias.organizacion, pasantias.persona, pasantias.oficina, pasantias.organizacion_oficina, pasantias.persona_organizacion_oficina 
                          WHERE 
                          organizacion.id_organizacion = organizacion_oficina.id_organizacion AND organizacion_oficina.id_oficina = oficina.id_oficina
                          AND organizacion.id_organizacion = persona_organizacion_oficina.id_organizacion AND persona_organizacion_oficina.id_oficina = organizacion_oficina.id_oficina
                          AND persona.id_persona = persona_organizacion_oficina.id_persona AND organizacion.id_organizacion = $ID_ORGANIZACION_P");

            return $sql;

          }

          
    function AsignarPersona_Oficina_Organizacion($Vista=array()){
          $retorno=0;

          $ID_OFICINA           =$Vista['id_oficina'];
          $ID_ORGANIZACION      =$Vista['id_organizacion'];
          $CEDULA               =$Vista['cedula_p'];
          $NOMBRE               =$Vista['nombre_p'];
          $APELLIDO             =$Vista['apellido_p'];
          $FECHA                =$Vista['fecha'];
          $OBSERVACION          =$Vista['observacion'];
          $PERFIL               =$Vista['perfil'];

          //------VERIFICO QUE PERFIL TENDRA--->>>
          if ($PERFIL =='EMPRESARIAL') {
            $ID_PERFIL=5;

                    //-----CONSULTO HABER SI EXISTE LA CEDULA--->>>
                  $Sql=pg_query("SELECT * FROM pasantias.persona WHERE cedula='$CEDULA' ;");
                  $num=pg_num_rows($Sql);

                  if($num>0){
                        $retorno =2;
                        return $retorno;

                  }else{
                        //--------INSERTO EN LA TABLA PERSONA---->>>>

                        $inserto=pg_query("INSERT INTO pasantias.persona (cedula, nombre, apellido)VALUES('$CEDULA', '$NOMBRE', '$APELLIDO')");

                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////

                        $SELECC=pg_query("SELECT MAX(id_persona) FROM pasantias.persona");
                        $regist=pg_fetch_array($SELECC);
                        $id_persona=$regist[0];
                        //---INSERTO EN TUTOR EMPRESARIAL--->>
                        $inserto=pg_query("INSERT INTO pasantias.tutor_empresarial (id_persona)VALUES($id_persona)");

                        ////////////////////////////////////////////////////////////////////////////////////////////////////

                        $inserto3=pg_query("INSERT INTO  pasantias.persona_organizacion_oficina (id_persona, id_oficina, id_organizacion, id_perfil, estado, observacion, fecha_solicitud, fecha_aceptacion)VALUES
                                                                                            ($id_persona, $ID_OFICINA, $ID_ORGANIZACION, $ID_PERFIL, 'APROBADO', '$OBSERVACION', '$FECHA' , '$FECHA' )");
                         $registro =0;
                         $registro = pg_affected_rows($inserto3);
                                   
                                        pg_free_result($inserto3);
                     
                           return $registro;             
                      }

          }else if($PERFIL =='CONTACTO') {

            $ID_PERFIL=8;

                    //-----CONSULTO HABER SI EXISTE LA CEDULA--->>>
                  $Sql=pg_query("SELECT * FROM pasantias.persona WHERE cedula='$CEDULA' ;");
                  $num=pg_num_rows($Sql);

                  if($num>0){
                        $retorno=2;
                        return $retorno;

                  }else{
                        //--------INSERTO EN LA TABLA PERSONA---->>>>

                        $inserto=pg_query("INSERT INTO pasantias.persona (cedula, nombre, apellido)VALUES('$CEDULA', '$NOMBRE', '$APELLIDO')");

                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////

                        $SELECC=pg_query("SELECT MAX(id_persona) FROM pasantias.persona");
                        $regist=pg_fetch_array($SELECC);
                        $id_persona=$regist[0];
                        //---INSERTO EN TUTOR EMPRESARIAL--->>
                        //$inserto=pg_query("INSERT INTO pasantias.tutor_empresarial (id_persona)VALUES($id_persona)");

                        ////////////////////////////////////////////////////////////////////////////////////////////////////

                        $inserto3=pg_query("INSERT INTO  pasantias.persona_organizacion_oficina (id_persona, id_oficina, id_organizacion, id_perfil, estado, observacion, fecha_solicitud, fecha_aceptacion)VALUES
                                                                                            ($id_persona, $ID_OFICINA, $ID_ORGANIZACION, $ID_PERFIL, 'APROBADO', '$OBSERVACION', '$FECHA' , '$FECHA' )");
                         $registro =0;
                         $registro = pg_affected_rows($inserto3);
                                   
                                        pg_free_result($inserto3);
                     
                           return $registro;             
                      }

            
          }

        
        }//----FIN DE ASIGNAR PERSONAS--->>



          function ConsultarEmpresas(){

            $strsql="SELECT organizacion.id_organizacion AS id_organizacion, organizacion.nombre_organizacion FROM pasantias.organizacion INNER JOIN pasantias.convenio_organizacion ON convenio_organizacion.id_organizacion=organizacion.id_organizacion";
            $result=pg_query($strsql);//ejecuta la tira sql

            return $result;



          }


            function Consultar_ParaRegistrar_Office($ID_ORGANIZACION_P){
                     
                
                $sql="SELECT * FROM pasantias.organizacion_oficina WHERE 
              organizacion_oficina.id_oficina=(SELECT id_oficina FROM pasantias.oficina WHERE
              nombre_oficina = '$this->nombre' ) AND organizacion_oficina.id_organizacion=$ID_ORGANIZACION_P";
                
                $result=pg_query($sql);
                
                $num=pg_num_rows($result);
                  
                return $num;
                               
                
            } 
            
            
            
            
    function Consultar_ParaModificar_Office($ID_ORGANIZACION_P)
        {

      $result=pg_query("SELECT oficina.nombre_oficina, organizacion_oficina.estado, organizacion_oficina.descripcion FROM pasantias.organizacion_oficina, pasantias.oficina 
        WHERE organizacion_oficina.id_oficina=oficina.id_oficina AND oficina.nombre_oficina='$this->nombre' AND organizacion_oficina.estado='$this->estatus' AND organizacion_oficina.descripcion='$this->descripcion' AND organizacion_oficina.id_organizacion=$ID_ORGANIZACION_P");//ejecuta la tira sql

        $num=pg_num_rows($result);

              return $num;
              
        }


       function Modificar_Office($ID_ORGANIZACION_P){

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
                            $consull=pg_query("SELECT * FROM pasantias.organizacion_oficina WHERE id_oficina=$id_oficina_nuevo AND id_organizacion=$ID_ORGANIZACION_P");
                            $num=pg_num_rows($consull);
                            if($num>0){
                                
                                // QUIERE DECIR QUE YA LA TENGO---->
                                  //--PERO DEBO CONSULTA XQ PROBABLEMENTE ESTE EN ACTIVO O MODIFICADO--->>
                                  $sqql=pg_query("SELECT id_oficina FROM pasantias.organizacion_oficina WHERE id_oficina=$id_oficina_nuevo AND id_organizacion=$ID_ORGANIZACION_P AND estado='MODIFICADO'");
                                  $nume=pg_num_rows($sqql);
                                  if($nume>0){
                                        //----SI EXISTE EN MODIFICADO CAMBIO A ACTIVO Y EL OTRO A MODIFICADO--->>
                                        //---PERO NATES DEBO CONSULTA HABER SI TIENE PERSONAS ASIGNADA--->>>
                                        //---->>>> DEBO VER SI HAY PERSONAS ASIGNADAS A LA ESPECIALIDA VIEJA, PARAQ PODER CAMBIAR EL ESTATUS A MODIFICADO--->>>
                                        $str_PersonasAsignadas=pg_query("SELECT * FROM pasantias.persona_organizacion_oficina WHERE id_oficina='$this->id' AND id_organizacion=$ID_ORGANIZACION_P");
                                        $num=pg_num_rows($str_PersonasAsignadas);
                                        if($num>0){
                                            //---SI HAY PERSONAS AQUI, HAGO UN TRASPASO---SOLO EN LA INTERMEDIA--->>>

                                                  $retorno =8;
                                                      return $retorno;

                                                    }else{
                                                      $updd=pg_query("UPDATE pasantias.organizacion_oficina SET estado='ACTIVO' WHERE id_oficina=$id_oficina_nuevo AND id_organizacion=$ID_ORGANIZACION_P");
                                                      $updd2="UPDATE pasantias.organizacion_oficina SET estado='MODIFICADO' WHERE id_oficina='$this->id' AND id_organizacion=$ID_ORGANIZACION_P";
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
                                  $ConsulPersona=pg_query("SELECT * FROM pasantias.persona_organizacion_oficina WHERE id_oficina='$this->id' AND id_organizacion=$ID_ORGANIZACION_P");
                                  $numer=pg_num_rows($ConsulPersona);
                                  if($numer>0){
                                        //---QUIERE DECIR QUE HAY PERSONAS ASIGNADAS EN LA OFICINA QUE INTENTO MODIFICAR--->>>
                                        $retorno=5;
                                        return $retorno;

                                  }else{
                                        //----NO TIENE PERSONAS ASIGNADAS--- PUEDO REGISTRAR EN LA INTERMEDIA Y CAMBIAR EL ESTATUS ANTERIOR A MODIFICADO TRANQUILAMENTE--->>
                                        $insert="INSERT INTO pasantias.organizacion_oficina (id_oficina, id_organizacion, estado, descripcion, observacion)
                                                  VALUES($id_oficina_nuevo, $ID_ORGANIZACION_P, '$this->estatus', '$this->descripcion', 'NO OBSERVACION')";
                                        $res = pg_query($insert) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                                        //----CAMBIO EL ESTATUS ANTERIOR--->>>
                                        $UP=pg_query("UPDATE pasantias.organizacion_oficina SET estado='MODIFICADO' WHERE id_oficina=$this->id AND id_organizacion=$ID_ORGANIZACION_P");

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
                           $SQL=pg_query("SELECT  organizacion_oficina.* FROM pasantias.organizacion_oficina WHERE id_oficina='$this->id' AND id_organizacion!=$ID_ORGANIZACION_P");

                            $num=pg_num_rows($SQL);

                            if($num>0){
                                //----AQUI QUIERE DECIR QUE EL NOMBRE ANTERIOR LO ESTA USANDO OTRA INSTITUCION POR LO TANTO NO LO PUEDO MODIFICAR--->>
                                //---COMO LO ESTA USANDO ALGUIEN  DEBO HACER UN NUEVO REGISTRO(OFICINA)
                                //---ANTES DEBO CONSULTAR A VER SI HAY PERSONAS ASIGNADAS--->>
                                    $ConsulPersona=pg_query("SELECT * FROM pasantias.persona_organizacion_oficina WHERE id_oficina='$this->id' AND id_organizacion=$ID_ORGANIZACION_P");
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
                                      $UP=pg_query("UPDATE pasantias.organizacion_oficina SET estado='MODIFICADO' WHERE id_oficina=$this->id AND id_organizacion=$ID_ORGANIZACION_P");

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
                                $ConsulPersona=pg_query("SELECT * FROM pasantias.persona_organizacion_oficina WHERE id_oficina='$this->id' AND id_organizacion=$ID_ORGANIZACION_P");
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

                                       WHERE id_oficina=$this->id AND id_organizacion=$ID_ORGANIZACION_P "; 

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

                           WHERE id_oficina=$this->id AND id_organizacion=$ID_ORGANIZACION_P "; 

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


            $strsql3=" INSERT INTO pasantias.organizacion_oficina ( id_organizacion , id_oficina , estado, descripcion ) 
                       VALUES ( '$id_organizacion' ,'$id_oficina' , 'ACTIVO', '$this->descripcion') "; 

            $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

           

            //---- HAGO LA "INSERCION" EN LA TABLA PERSONA_ORGANIZACION_OFICINA-TRASPASO-->
                    //---OBTENGO LOS ESTUDIANTES ASIGNADOS A LA ANTERIOR--->>>
                    $reciveList=array();
                    $reciveList=$this->SeleccionarPersonasDeOficina($this->id, $id_organizacion);

                    //---ACTUALIZO EL REGISTRO VIEJO--->>>>
                    $actualizoVieja=pg_query("UPDATE pasantias.organizacion_oficina SET estado='MODIFICADO' WHERE id_oficina='$this->id' AND id_organizacion=$id_organizacion");

                    //---RECORRO AQUI PARA IR ACTUALIZANDO CADA PERSONA--->>
                    for ($i=0; $i <count($reciveList); $i++) { 
                      # code...
                    $updat="UPDATE pasantias.persona_organizacion_oficina SET id_oficina=$id_oficina WHERE id_persona=$reciveList[$i] AND id_organizacion=$id_organizacion ";
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
           
   
        $strsql2=" UPDATE pasantias.organizacion_oficina SET estado='$this->estatus' , descripcion='$this->descripcion' WHERE id_oficina='$this->id' AND id_organizacion=$id_organizacion "; 
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
                $consull=pg_query("SELECT * FROM pasantias.organizacion_oficina WHERE id_oficina=$id_oficina_nuevo AND id_organizacion=$id_organizacion");
                $num=pg_num_rows($consull);
                if($num>0){
                    //---QYUIERE DECIR QUE YA LO TERNGO ASIGNADO---->>
                    $retorno=3;
                    return $retorno;

                }else{
                     //COMO NO LA TENGO ME LA ASIGNO---->EN LA INTERMEDIA---->>
                    $strsql2=" INSERT INTO pasantias.organizacion_oficina  (id_oficina, id_organizacion, estado, descripcion)VALUES ($id_oficina_nuevo, $id_organizacion, '$this->estatus', '$this->descripcion' ) ; "; 
                    $result2 = pg_query($strsql2) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                    //----SEGUIDO HAGO LA "INSERCION-ACTUALIZACION" EN LA TABLA PERSONA_ORGANIZACION_OFICINA-TRASPASO-->
                    $reciveList=array();
                    $reciveList=$this->SeleccionarPersonasDeOficina($this->id, $id_organizacion);

                    //---ACTUALIZO EL REGISTRO VIEJO--->>>>
                    $actualizoVieja=pg_query("UPDATE pasantias.organizacion_oficina SET estado='MODIFICADO' WHERE id_oficina='$this->id' AND id_organizacion=$id_organizacion");

                    //---RECORRO AQUI PARA IR ACTUALIZANDO CADA PERSONA--->>
                    for ($i=0; $i <count($reciveList); $i++) { 
                      # code...
                    $updat="UPDATE pasantias.persona_organizacion_oficina SET id_oficina=$id_oficina_nuevo WHERE id_persona=$reciveList[$i] AND id_organizacion=$id_organizacion ";
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
                    $actualizoVieja=pg_query("UPDATE pasantias.organizacion_oficina SET estado='MODIFICADO' WHERE id_oficina='$this->id' AND id_organizacion=$id_organizacion");
                    $actualizoNueva=pg_query("UPDATE pasantias.organizacion_oficina SET estado='ACTIVO' WHERE id_oficina=$id_oficina_nuevo AND id_organizacion=$id_organizacion");
          
                    //----SEGUIDO HAGO LA "INSERCION-ACTUALIZACION" EN LA TABLA PERSONA_ORGANIZACION_OFICINA-TRASPASO-->
                    $reciveList=array();
                    $reciveList=$this->SeleccionarPersonasDeOficina($this->id, $id_organizacion);

                   
                    //---RECORRO AQUI PARA IR ACTUALIZANDO CADA PERSONA--->>
                    for ($i=0; $i <count($reciveList); $i++) { 
                      # code...
                    $updat="UPDATE pasantias.persona_organizacion_oficina SET id_oficina=$id_oficina_nuevo WHERE id_persona=$reciveList[$i] AND id_organizacion=$id_organizacion ";
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

    $sql=pg_query("SELECT id_persona FROM pasantias.persona_organizacion_oficina WHERE id_organizacion=$id_organizacion AND id_oficina=$id_oficina ");
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
          ////--- CONSULTO SI EL NOMBRE YA ESTA REGISTRADO EN LA MAESTRA--->>>
            $SQL=pg_query("SELECT id_oficina FROM pasantias.organizacion_oficina WHERE 
              organizacion_oficina.id_oficina=(SELECT id_oficina FROM pasantias.oficina WHERE
              nombre_oficina = '$this->nombre')");


                 $NUM=pg_num_rows($SQL);

                 $REGISTRO=pg_fetch_array($SQL);

                 $id_oficina=$REGISTRO['id_oficina'];



                 //------SI EXISTE EN LA MAESTRA ASIGNO SOLO EN LA INTERMEDIA--->>>
                 if($NUM>0){

                    

                    $strsql3=" INSERT INTO pasantias.organizacion_oficina ( id_oficina , id_organizacion , estado, descripcion ) 

                    VALUES ( $id_oficina ,$ID_ORGANIZACION_P , 'ACTIVO', '$this->descripcion') "; 

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



             $strsql3=" INSERT INTO pasantias.organizacion_oficina ( id_oficina , id_organizacion , estado, descripcion ) 

              VALUES ( '$id_oficina' ,'$ID_ORGANIZACION_P' , 'ACTIVO', '$this->descripcion') "; 

                      $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                              $registro =0;
                              $registro = pg_affected_rows($result3);            

                        return $registro;


                 }

         

}//-----FIN DE REGISTRA OFFICE----








//-----INCLUIR NUEVA OFICINA Y ASIGNAR A LA EMPRESA O INSTITUCION--->>>

function Incluir_NuevaOficina_Asignar($ID_ORGANIZACION)
{

            $sql = " SELECT * FROM pasantias.ultimoid_departamento ; ";
            $resultt=pg_query($sql);//ejecuta la tira sql
            $id_departamento = 0;

            $fila = pg_fetch_array($resultt);
            
            $id_departamento = $fila['id'];

            $id_departamento=$id_departamento+1;
            


          //---CONSULTO DE NUEVO PARA ASEGURAR--->>>

              $nuevaSQL="SELECT id_departamento FROM pasantias.departamento WHERE id_departamento='$id_departamento'";
              $result=pg_query($nuevaSQL);
              $num=pg_num_rows($result);

          

            //-----CONDICION, PARA REGISTAR--->>>

              if($num==0){

                $strsql2=" INSERT INTO pasantias.departamento ( id_departamento,estado,descripcion) 

                VALUES ('$id_departamento','$this->estatus','$this->descripcion' ) "; 

                 $result2=pg_query($strsql2);//ejecuta la tira sql

                //--INSERTO EN OFICINA-->>>

                $strsql3=" INSERT INTO pasantias.oficina ( id_departamento , nombre_oficina  ) 

                VALUES (  '$id_departamento','$this->nombre' ) "; 

                $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                $registro =0;
                $registro = pg_affected_rows($result3);

                if($registro>0){

                  $MaxID=pg_query("SELECT MAX(id_oficina) FROM pasantias.oficina");
                  $reg=pg_fetch_array($MaxID);
                  $ID_OFICINA=$reg[0];

                  //----ASIGNO AHORA---->>>

                  $strsql4=" INSERT INTO pasantias.organizacion_oficina ( id_oficina, id_organizacion, estado  ) 

                  VALUES ( '$ID_OFICINA' , '$ID_ORGANIZACION' , 'ACTIVO') "; 

                  $result4 = pg_query($strsql4) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


                              $registro2 =0;
                              $registro2 = pg_affected_rows($result4);


                              return $registro2;
                              }else{
                                return $registro;

                              }

}else{



            $id_departamento=$id_departamento+1;
            
            $strsql2=" INSERT INTO pasantias.departamento ( id_departamento,estado,descripcion) 

                VALUES ('$id_departamento','$this->estatus','$this->descripcion' ) "; 

                 $result2=pg_query($strsql2);//ejecuta la tira sql

                //--INSERTO EN OFICINA-->>>

                $strsql3=" INSERT INTO pasantias.oficina ( id_departamento , nombre_oficina  ) 

                VALUES (  '$id_departamento','$this->nombre' ) "; 

                $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                $registro =0;
                $registro = pg_affected_rows($result3);

                if($registro>0){

                  $MaxID=pg_query("SELECT MAX(id_oficina) FROM pasantias.pasantias.oficina");
                  $reg=pg_fetch_array($MaxID);
                  $ID_OFICINA=$reg[0];

              


                  //----ASIGNO AHORA---->>>

                  $strsql4=" INSERT INTO pasantias.organizacion_oficina ( id_oficina, id_organizacion, estado  ) 

                  VALUES ( '$ID_OFICINA' , '$ID_ORGANIZACION' , 'ACTIVO') "; 

                  $result4 = pg_query($strsql4) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


                              $registro2 =0;
                              $registro2 = pg_affected_rows($result4);


                              return $registro2;
                              }else{


                                return $registro;

                              }





}
}
//---DFIN DE INCLUIR Y ASIGNAR OFICINA--->>>







function Consultar_Oficina_Catalago($ID_ORGANIZACION_PRINCIPAL)
{

$sql=" SELECT oficina.id_oficina, oficina.nombre_oficina, organizacion_oficina.estado, organizacion_oficina.descripcion, organizacion_oficina.observacion FROM pasantias.oficina  
       JOIN  pasantias.departamento ON  oficina.id_departamento = pasantias.departamento.id_departamento
             JOIN  pasantias.organizacion_oficina ON organizacion_oficina.id_oficina = oficina.id_oficina  
             JOIN  pasantias.organizacion ON organizacion.id_organizacion = organizacion_oficina.id_organizacion WHERE organizacion_oficina.id_organizacion=$ID_ORGANIZACION_PRINCIPAL AND organizacion_oficina.estado!='MODIFICADO'";
	 	 
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
   $cont=0;
  
  while($reg=pg_fetch_array($result)){


        $Registros[$cont]=$reg['nombre_oficina'];


        $cont++;
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
=======
<?php

include_once("../../../BASE_DATOS/Conect.php");

 $ConexionBD =new Conexion();
 $ConexionBD->Conectar();

class Solicitud{


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








function Consultar_Solicitud_Catalago($ID_INSTITUCION)
{

$sql="SELECT id,tipo_solicitud.id_tipo_solicitud ,nombre_tipo_solicitud, especialidad.id_especialidad,nombre_especialidad, cantidad, solicitud.estatus, observacion FROM pasantias.solicitud  
JOIN  pasantias.especialidad ON  especialidad.id_especialidad = pasantias.solicitud.id_especialidad
JOIN  pasantias.tipo_solicitud ON tipo_solicitud.id_tipo_solicitud=pasantias.solicitud.id_tipo_solicitud 
where pasantias.solicitud.id_organizacion='$ID_INSTITUCION' ORDER BY id ";
	 	 
	 $result=pg_query($sql);//ejecuta la tira sql

	

	 return $result;
	 
}

/*
SELECT temporadas_solicitud.codigo_temporada, codigo_temporada_especialidad, tipo_solicitud.id_tipo_solicitud ,nombre_tipo_solicitud , periodo_solicitud.id_lapso ,
numero_lapso, temporadas_especialidad.id_especialidad, nombre_especialidad, nombre_tipo_especialidad,fecha_inicio, fecha_fin FROM pasantias.tipo_solicitud  
JOIN pasantias.temporadas_solicitud ON  temporadas_solicitud.id_tipo_solicitud = pasantias.tipo_solicitud.id_tipo_solicitud 
and pasantias.temporadas_solicitud.estatus='PREPARADA'
JOIN pasantias.temporadas_especialidad ON temporadas_especialidad.codigo_temporada =temporadas_solicitud.codigo_temporada
JOIN pasantias.especialidad ON especialidad.id_especialidad=temporadas_especialidad.id_especialidad
JOIN pasantias.tipo_especialidad ON tipo_especialidad.id_tipo_especialidad=especialidad.id_tipo_especialidad
JOIN pasantias.periodo_solicitud ON periodo_solicitud.id_periodo = pasantias.temporadas_solicitud.id_periodo
JOIN pasantias.lapso_academico ON lapso_academico.id_lapso = pasantias.periodo_solicitud.id_lapso ORDER BY nombre_tipo_solicitud

*/


    function consultTipo_Solicitud()
  {
$strsql ="SELECT temporadas_solicitud.codigo_temporada, codigo_temporada_especialidad, tipo_solicitud.id_tipo_solicitud ,nombre_tipo_solicitud , periodo_solicitud.id_lapso ,
numero_lapso, temporadas_especialidad.id_especialidad, nombre_especialidad, nombre_tipo_especialidad,fecha_inicio, fecha_fin FROM pasantias.tipo_solicitud  
JOIN pasantias.temporadas_solicitud ON  temporadas_solicitud.id_tipo_solicitud = pasantias.tipo_solicitud.id_tipo_solicitud 
and pasantias.temporadas_solicitud.estatus='EN CURSO'
JOIN pasantias.temporadas_especialidad ON temporadas_especialidad.codigo_temporada =temporadas_solicitud.codigo_temporada
JOIN pasantias.especialidad ON especialidad.id_especialidad=temporadas_especialidad.id_especialidad
JOIN pasantias.tipo_especialidad ON tipo_especialidad.id_tipo_especialidad=especialidad.id_tipo_especialidad
JOIN pasantias.periodo_solicitud ON periodo_solicitud.id_periodo = pasantias.temporadas_solicitud.id_periodo
JOIN pasantias.lapso_academico ON lapso_academico.id_lapso = pasantias.periodo_solicitud.id_lapso ORDER BY nombre_tipo_solicitud;"; 

  $result=pg_query($strsql);//ejecuta la tira sql
          
return $result;

    

  }

  /// MOSTRAR SOLICITUDES
/*
SELECT distinct solicitud.codigo_solicitud, solicitud.codigo_temporada, temporadas_solicitud.id_tipo_solicitud, nombre_tipo_solicitud, fecha_solicitud, cantidad_postulantes, nombre_especialidad, solicitudes_recibidas.table_column, solicitudes_recibidas.valor FROM pasantias.solicitud  
JOIN  pasantias.solicitudes_enviadas ON solicitudes_enviadas.codigo_solicitud = pasantias.solicitud.codigo_solicitud 
and pasantias.solicitudes_enviadas.table_column='especialidad.id_especialidad'and valor='$id_especialidad' and pasantias.solicitud.descripcion='ESPECIFICA'
JOIN pasantias.solicitudes_recibidas ON solicitudes_recibidas.table_column='estudiante.codigo_estudiante' and pasantias.solicitudes_recibidas.valor='$codigo_estudiante'
JOIN pasantias.especialidad ON especialidad.id_especialidad=CAST(solicitudes_enviadas.valor as int )
JOIN pasantias.temporadas_solicitud ON temporadas_solicitud.codigo_temporada=solicitud.codigo_temporada
JOIN pasantias.tipo_solicitud ON tipo_Solicitud.id_tipo_solicitud=temporadas_solicitud.id_tipo_solicitud
*/

  function caragar_solicitudes_especificas_1($codigo_estudiante){
$strsql="SELECT distinct solicitud.codigo_solicitud, solicitud.codigo_temporada_especialidad, temporadas_solicitud.id_tipo_solicitud, nombre_tipo_solicitud,
fecha_solicitud, cantidad_postulantes, nombre_especialidad 
FROM pasantias.solicitud  
JOIN  pasantias.solicitudes_enviadas ON solicitudes_enviadas.codigo_solicitud = pasantias.solicitud.codigo_solicitud 
and pasantias.solicitud.descripcion='ESPECIFICA'

JOIN pasantias.temporadas_especialidad ON solicitud.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
JOIN pasantias.temporadas_estudiantes ON temporadas_estudiantes.codigo_temporada_especialidad= temporadas_especialidad.codigo_temporada_especialidad

AND temporadas_especialidad.codigo_temporada_especialidad = temporadas_estudiantes.codigo_temporada_especialidad
 AND temporadas_estudiantes.codigo_estudiante='$codigo_estudiante' 
JOIN pasantias.especialidad ON especialidad.id_especialidad=temporadas_especialidad.id_especialidad

JOIN pasantias.temporadas_solicitud ON temporadas_solicitud.codigo_temporada=temporadas_especialidad.codigo_temporada
JOIN pasantias.tipo_solicitud ON tipo_Solicitud.id_tipo_solicitud=temporadas_solicitud.id_tipo_solicitud";
//where pasantias.solicitud.id_especialidad='1' ORDER BY id ";
$result=pg_query($strsql);//ejecuta la tira sql
          
return $result;
}

function cargar_solicitudes_p1($codigo_estudiante){

$strsql="SELECT distinct solicitud.codigo_solicitud, solicitud.codigo_temporada_especialidad, temporadas_solicitud.id_tipo_solicitud, nombre_tipo_solicitud,
fecha_solicitud, cantidad_postulantes, nombre_especialidad 
FROM pasantias.solicitud  
JOIN  pasantias.solicitudes_enviadas ON solicitudes_enviadas.codigo_solicitud = pasantias.solicitud.codigo_solicitud 
and pasantias.solicitud.descripcion='GENERAL'

JOIN pasantias.temporadas_especialidad ON solicitud.codigo_temporada_especialidad = temporadas_especialidad.codigo_temporada_especialidad
JOIN pasantias.temporadas_estudiantes ON temporadas_estudiantes.codigo_temporada_especialidad= temporadas_especialidad.codigo_temporada_especialidad

AND temporadas_especialidad.codigo_temporada_especialidad = temporadas_estudiantes.codigo_temporada_especialidad
 AND temporadas_estudiantes.codigo_estudiante='$codigo_estudiante' 
JOIN pasantias.especialidad ON especialidad.id_especialidad=temporadas_especialidad.id_especialidad

JOIN pasantias.temporadas_solicitud ON temporadas_solicitud.codigo_temporada=temporadas_especialidad.codigo_temporada
JOIN pasantias.tipo_solicitud ON tipo_Solicitud.id_tipo_solicitud=temporadas_solicitud.id_tipo_solicitud";
//where pasantias.solicitud.id_especialidad='1' ORDER BY id ";
$result=pg_query($strsql);//ejecuta la tira sql
          
return $result;
}

function cargar_solicitudes_p2($codigo_solicitud){
$strsql="SELECT distinct valor FROM pasantias.solicitudes_enviadas where codigo_solicitud='$codigo_solicitud' and table_column = 'organizacionmunicipio.codigo_sucursal'";
$result=pg_query($strsql);//ejecuta la tira sql
return $result;
}

function cargar_solicitudes_p3($codigo_sucursal, $codigo_solicitud){
$strsql="SELECT distinct nombre_organizacion, organizacion.id_tipo_organizacion, nombre_tipo_organizacion, table_column, valor FROM pasantias.solicitudes_enviadas
JOIN  pasantias.organizacionmunicipio ON organizacionmunicipio.codigo_sucursal=solicitudes_enviadas.valor 
and solicitudes_enviadas.table_column = 'organizacionmunicipio.codigo_sucursal'and valor='$codigo_sucursal'
JOIN pasantias.organizacion ON organizacion.id_organizacion=organizacionmunicipio.id_organizacion
JOIN pasantias.tipo_organizacion ON tipo_organizacion.id_tipo_organizacion=organizacion.id_tipo_organizacion and solicitudes_enviadas.codigo_solicitud='$codigo_solicitud'";
$result=pg_query($strsql);//ejecuta la tira sql
return $result;
}

function cargar_solicitudes_p4($codigo_solicitud){
$strsql="SELECT distinct solicitud_requisito.id_requisito, nombre_requisito FROM pasantias.requisito
JOIN  pasantias.solicitud_requisito ON solicitud_requisito.codigo_solicitud='$codigo_solicitud' and
solicitud_requisito.id_requisito=requisito.id_requisito
";
$result=pg_query($strsql);//ejecuta la tira sql
return $result;
}


function cargar_solicitudes_p5($codigo_solicitud){
$strsql="SELECT distinct valor FROM pasantias.solicitudes_enviadas where codigo_solicitud='$codigo_solicitud' and table_column = 'persona.id_persona'";
$result=pg_query($strsql);//ejecuta la tira sql
return $result;
}

function cargar_solicitudes_p6($id_persona, $codigo_solicitud){
$strsql="SELECT distinct nombre, apellido,telefono, correo, table_column, valor FROM pasantias.solicitudes_enviadas
JOIN  pasantias.persona ON solicitudes_enviadas.table_column = 'persona.id_persona'and valor='$id_persona'
AND persona.id_persona= CAST(solicitudes_enviadas.valor as int ) and solicitudes_enviadas.codigo_solicitud='$codigo_solicitud'";
$result=pg_query($strsql);//ejecuta la tira sql
return $result;
}

//// FIN DE MOSTAR SOLICITUDES

function cargar_requisitos(){

$strsql=" SELECT id_requisito, nombre_requisito FROM pasantias.requisito where estatus='ACTIVO' ORDER BY id_requisito ";
//where pasantias.solicitud.id_especialidad='1' ORDER BY id ";
$result=pg_query($strsql);//ejecuta la tira sql
          
return $result;
}


function cargar_modal_estudiantes_especialidad($id_especialidad, $tipo_solicitud){

$strsql="SELECT persona.nombre ||' '|| persona.apellido as estudiantedate, especialidad.nombre_especialidad ,estudiante.expediente ,estudiante.codigo_estudiante FROM 
   pasantias.estudiante 
      JOIN pasantias.persona_instituto_especialidad 
      ON estudiante.id_persona = persona_instituto_especialidad.id_persona 
      AND estudiante.id_especialidad = persona_instituto_especialidad.id_especialidad AND estudiante.id_especialidad=$id_especialidad
      AND estudiante.id_ip = persona_instituto_especialidad.id_ip
      AND estudiante.id_perfil = persona_instituto_especialidad.id_perfil JOIN pasantias.instituto_principal 
      ON  instituto_principal.id_ip= persona_instituto_especialidad.id_ip JOIN pasantias.organizacion 
      ON organizacion .id_organizacion=instituto_principal.id_organizacion JOIN pasantias.organizacionmunicipio
      ON organizacionmunicipio.id_organizacion = organizacion.id_organizacion
      JOIN pasantias.persona 
      ON persona.id_persona = persona_instituto_especialidad.id_persona JOIN pasantias.especialidad
      ON especialidad.id_especialidad = persona_instituto_especialidad.id_especialidad
      JOIN pasantias.temporadas_estudiantes ON pasantias.temporadas_estudiantes.codigo_estudiante=estudiante.codigo_estudiante 
      AND pasantias.temporadas_estudiantes.codigo_temporada_especialidad='$tipo_solicitud'";
$result=pg_query($strsql);
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

function buscarcodigo()
{
   //$sql= pg_query("SELECT CAST(MAX(codigo_solicitud) as int) +1   FROM pasantias.solicitud ;");
   $sql= pg_query("SELECT  MAX( CAST(codigo_solicitud as int) ) + 1, 1 as auxiliar FROM pasantias.solicitud  ;");

   $var = pg_fetch_array($sql);
   if($var[0]==''){
    $var[0]=$var[1];
  }
   return $var[0];
}

function Incluir_Solicitud($Vista=array())
{

    $registro =0;
    $id_instituto          = $Vista['id_instituto'];
    $codigo_sucursal       = $Vista['codigo_sucursal'];
    $id_persona            = $Vista['id_persona'];
    $tipo_solicitud        = $Vista['tipo_solicitud'];
    $especialidad          = $Vista['especialidad'];
    $cantidad              = $Vista['cantidad'];
    $estatus_s             = $Vista['estatus_s'];
    $id_requisitos         = $Vista['id_requisitos'];
    $observacion           = $Vista['observacion'];
    $codigo_estudiante     = $Vista['codigo_estudiante'];

               

  
  ////////////////////////////////////////                            /////////////////////////////////////////////////////
              
            $ptj = "SELECT codigo_estudiante FROM pasantias.temporadas_estudiantes WHERE codigo_temporada_especialidad='$tipo_solicitud' limit 1";
            $ptjn=pg_query($ptj);//ejecuta la tira sql
            $na = pg_fetch_array($ptjn);
            $codigo_estudiante = $na[0];

      ////////////////////////////////////////                            /////////////////////////////////////////////////////          

             $codigo = $this->buscarcodigo();
             

            $strsql1=" INSERT INTO pasantias.solicitud (codigo_solicitud, fecha_solicitud , cantidad_postulantes, estatus, descripcion, codigo_estudiante, codigo_temporada_especialidad) 

            VALUES ('$codigo', now() ,'$cantidad' , '$estatus_s', '$observacion','$codigo_estudiante','$tipo_solicitud') "; 

            $result1 = pg_query($strsql1) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


   ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                        


            $sql22 = "SELECT  MAX( CAST(codigo_solicitud as int) ) FROM pasantias.solicitud ";

            $result22=pg_query($sql22);//ejecuta la tira sql

                            

                            $fila2 = pg_fetch_array($result22);

                            $codigo_solicitud = $fila2[0];

                                    

/////////////////////////////////////                                    ////////////////////////////////////


for($i=0;$i<count($id_requisitos);$i++)
{

            $strsql3=" INSERT INTO pasantias.solicitud_requisito (id_requisito , codigo_solicitud, estatus) 

            VALUES ( '$id_requisitos[$i]' ,'$codigo_solicitud' , 'ACTIVO') "; 

            $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

}

///////////////////////////////    INSERTO EN SOLICITUDES ENVIADAS          /////////////////////////////
/*
$strsql4=" INSERT INTO pasantias.solicitudes_enviadas (codigo_solicitud, table_column, valor, estatus) 

            VALUES ( '$codigo_solicitud' ,'especialidad.id_especialidad', '$especialidad' , 'MOSTRAR') "; 

            $result4 = pg_query($strsql4) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error()); */



$strsql5=" INSERT INTO pasantias.solicitudes_enviadas (codigo_solicitud, table_column, valor, estatus) 

            VALUES ( '$codigo_solicitud' ,'persona.id_persona', '$id_persona' , 'MOSTRAR') "; 

            $result5 = pg_query($strsql5) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());



$strsql5=" INSERT INTO pasantias.solicitudes_enviadas (codigo_solicitud, table_column, valor, estatus) 

            VALUES ( '$codigo_solicitud' ,'organizacionmunicipio.codigo_sucursal', '$codigo_sucursal' , 'MOSTRAR') "; 

            $result5 = pg_query($strsql5) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


            

/////////////////////////////                  //////////////////////////

// incluyo cuando la solicitud es dirigida de empresa a estudiantes
              if($observacion=='ESPECIFICA'){
for($i=0;$i<count($codigo_estudiante);$i++)
{

            $strsql6=" INSERT INTO pasantias.solicitudes_recibidas(codigo_solicitud, table_column, valor, estatus, fecha_postulacion) 

            VALUES ('$codigo_solicitud','estudiante.codigo_estudiante' ,'$codigo_estudiante[$i]', 'EN ESPERA',  now() ) "; 

            $result6 = pg_query($strsql6) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

}
              }

// fin de la inclusuion dirrigida

                              $registro =0;
                              $registro = pg_affected_rows($result3);

                      

            return $registro;







return $Vista['id_requisitos'];
          

}

//// verificaicon de postulacion 


 function Consultar_ParaRegistrarPostulacion($Vista=array())
 {
    $codigo_estudiante      = $Vista['codigo_estudiante'];
    $id_solicitud          = $Vista['id_solicitud'];


$sql="SELECT estatus FROM pasantias.solicitudes_recibidas WHERE codigo_solicitud='$id_solicitud' and table_column='estudiante.codigo_estudiante' and valor='$codigo_estudiante'";
            
                 $result=pg_query($sql);//ejecuta la tira sql

                 $num=pg_num_rows($result);

              return $num;
        }



function Incluir_Postulacion($Vista=array())
{

 $registro =0;
    $codigo_estudiante      = $Vista['codigo_estudiante'];
    $id_solicitud          = $Vista['id_solicitud'];


              
$strsql3=" INSERT INTO pasantias.solicitudes_recibidas (codigo_solicitud, table_column, valor, estatus) 

            VALUES ( '$id_solicitud' ,'estudiante.codigo_estudiante', '$codigo_estudiante' , 'EN ESPERA') "; 

              $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


             
              $registro = pg_affected_rows($result3);

                                  

                        return $registro;

}

/// fin de verfivavion de postulacion



function Modificar_Solicitud($Vista=array())
{

 $registro =0;
    $id_instituto          = $Vista['id_instituto'];
    $id_solicitud          = $Vista['id_solicitud'];
    $tipo_solicitud        = $Vista['tipo_solicitud'];
    $especialidad          = $Vista['especialidad'];
    $cantidad              = $Vista['cantidad'];
    $requisitos            = $Vista['requisitos'];

              
$strsql3=" UPDATE pasantias.Solicitud SET  id_tipo_solicitud='$tipo_solicitud' ,id_especialidad='$especialidad' , observacion='$requisitos', cantidad='$cantidad' where id='$id_solicitud' and id_organizacion=' $id_instituto' "; 

              $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


             
              $registro = pg_affected_rows($result3);

                                  

                        return $registro;

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





//------BIENE DEL RETURN 4--->>>
//------REALIZAR OTRO REGISTRO Y ASIGNAR DE UNA VEZ, REALIZANDO EL TRASPASO DE LOS ESTUDIANTES ASIGNADO A LA ANTERIOR ESPECIALIDAD---->>>
    function Incluir_NuevaEspecialidad_Asignar_y_TraspasarEstudiantes($id_instituto){

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


//----BIENE DEL RETURN 6
function ActualizarTodasLasTablas_TraspasandoEstudiantes_INTERNAMENTE($id_instituto){

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


function ModificarEstatusEspecialidadBD($id_instituto){

    $retorno=0;
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
                                

}



//---BIENE DEL RETURN 4---->>>
//------REALIZA UNA NUEVA INSERCION EN LA INTERMEDIA CON LOS DATOS DE ESTUDIANTES ANTERIORES A OTRA ESPECIALIDAD---->
function RealizarNuevaAsignacion_TraspasandoDatosEstudiantes($id_instituto){

    $retorno=0;
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

}


//-------SE USA PARA HACER TRASPASOS DE LOS ESTUDIANTES---->>
function SeleccionarEstudiantesDeEspecialidad($id_especialidad, $id_instituto){

    $sql=pg_query("SELECT id_persona FROM pasantias.persona_instituto_especialidad WHERE id_ip=$id_instituto AND id_especialidad=$id_especialidad ");
    $Lista=array();
    $cont=0;
    while($registro=pg_fetch_array($sql)){

          $Lista[$cont]=$registro["id_persona"];

          $cont++;

    }

    return $Lista;

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
          $Sql=pg_query("SELECT * FROM pasantias.persona WHERE cedula='$CEDULA' ;");
          $num=pg_num_rows($Sql);

          if($num>0){
            $retorno=2;
            return $retorno;

          }else{
            //--------INSERTO EN LA TABLA PERSONA---->>>>

            $inserto=pg_query("INSERT INTO pasantias.persona (cedula, nombre, apellido)VALUES('$CEDULA', '$NOMBRE', '$APELLIDO')");

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $SELECC=pg_query("SELECT MAX(id_persona) FROM pasantias.persona");
            $regist=pg_fetch_array($SELECC);
            $id_persona=$regist[0];

              //////////////////                                             /////////////////////////////////////////// 

            $inserto2=pg_query("INSERT INTO pasantias.estudiante (id_persona, expediente)VALUES($id_persona, '$EXPEDIENTE')");


            ////////////////////////////////////////////////////////////////////////////////////////////////////

            $inserto3=pg_query("INSERT INTO  pasantias.persona_instituto_especialidad (id_persona, id_especialidad, id_ip, id_perfil, estado, observacion, fecha_solicitud, fecha_aceptacion)VALUES
                                                                                ('$id_persona', $ID_ESPECIALIDAD, $ID_INSTITUTO, 3, 'APROBADO', '$OBSERVACION', '$FECHA', '$FECHA' )");
             $registro =0;
             $registro = pg_affected_rows($inserto3);
                       
                            pg_free_result($inserto3);
         
               return $registro;             
          }
          


        
        }


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
          $FECHA                =$Vista['fecha'];
          $OBSERVACION          =$Vista['observacion'];
      

          //-----CONSULTO HABER SI EXISTE LA CEDULA--->>>
          $Sql=pg_query("SELECT * FROM pasantias.persona WHERE cedula='$CEDULA' ;");
          $num=pg_num_rows($Sql);

          if($num>0){
            $retorno=2;
            return $retorno;

          }else{
            //--------INSERTO EN LA TABLA PERSONA---->>>>

            $inserto=pg_query("INSERT INTO pasantias.persona (cedula, nombre, apellido)VALUES('$CEDULA', '$NOMBRE', '$APELLIDO')");

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $SELECC=pg_query("SELECT MAX(id_persona) FROM pasantias.persona");
            $regist=pg_fetch_array($SELECC);
            $id_persona=$regist[0];

              //////////////////                                             /////////////////////////////////////////// 

            $inserto2=pg_query("INSERT INTO pasantias.tutor_academico (id_persona, codigo)VALUES($id_persona, '$CODIGO')");


            ////////////////////////////////////////////////////////////////////////////////////////////////////

            $inserto3=pg_query("INSERT INTO  pasantias.persona_instituto_especialidad (id_persona, id_especialidad, id_ip, id_perfil, estado, observacion, fecha_solicitud, fecha_aceptacion)VALUES
                                                                                ('$id_persona', $ID_ESPECIALIDAD, $ID_INSTITUTO, 4, 'APROBADO', '$OBSERVACION', '$FECHA', '$FECHA' )");
             $registro =0;
             $registro = pg_affected_rows($inserto3);
                       
                            pg_free_result($inserto3);
         
               return $registro;             
          }
          


        
        }




        function ConsultarNombre_Especialidad_AutoComplete()
          {
              

          $sql="SELECT nombre_especialidad FROM pasantias.especialidad  ";
               
             $result=pg_query($sql);//ejecuta la tira sql

             $Registros = array();
             $cont=0;
            
            while($reg=pg_fetch_array($result)){


                  $Registros[$cont]=$reg['nombre_especialidad'];


                  $cont++;
            }   
            echo json_encode($Registros);

  
         
         
}

















/////////////////////////////---------------------O F I C I N A----------//////////////////////////


          function CargarCatalago_PersonasAsignadas_Ofciinas($ID_ORGANIZACION_P){

            $sql=pg_query("SELECT organizacion.id_organizacion, persona.cedula, persona.nombre , persona.apellido , oficina.id_oficina, oficina.nombre_oficina,
                          organizacion_oficina.estado, organizacion_oficina.descripcion 
                          FROM pasantias.organizacion, pasantias.persona, pasantias.oficina, pasantias.organizacion_oficina, pasantias.persona_organizacion_oficina 
                          WHERE 
                          organizacion.id_organizacion = organizacion_oficina.id_organizacion AND organizacion_oficina.id_oficina = oficina.id_oficina
                          AND organizacion.id_organizacion = persona_organizacion_oficina.id_organizacion AND persona_organizacion_oficina.id_oficina = organizacion_oficina.id_oficina
                          AND persona.id_persona = persona_organizacion_oficina.id_persona AND organizacion.id_organizacion = $ID_ORGANIZACION_P");

            return $sql;

          }

          
    function AsignarPersona_Oficina_Organizacion($Vista=array()){
          $retorno=0;

          $ID_OFICINA           =$Vista['id_oficina'];
          $ID_ORGANIZACION      =$Vista['id_organizacion'];
          $CEDULA               =$Vista['cedula_p'];
          $NOMBRE               =$Vista['nombre_p'];
          $APELLIDO             =$Vista['apellido_p'];
          $FECHA                =$Vista['fecha'];
          $OBSERVACION          =$Vista['observacion'];
          $PERFIL               =$Vista['perfil'];

          //------VERIFICO QUE PERFIL TENDRA--->>>
          if ($PERFIL =='EMPRESARIAL') {
            $ID_PERFIL=5;

                    //-----CONSULTO HABER SI EXISTE LA CEDULA--->>>
                  $Sql=pg_query("SELECT * FROM pasantias.persona WHERE cedula='$CEDULA' ;");
                  $num=pg_num_rows($Sql);

                  if($num>0){
                        $retorno =2;
                        return $retorno;

                  }else{
                        //--------INSERTO EN LA TABLA PERSONA---->>>>

                        $inserto=pg_query("INSERT INTO pasantias.persona (cedula, nombre, apellido)VALUES('$CEDULA', '$NOMBRE', '$APELLIDO')");

                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////

                        $SELECC=pg_query("SELECT MAX(id_persona) FROM pasantias.persona");
                        $regist=pg_fetch_array($SELECC);
                        $id_persona=$regist[0];
                        //---INSERTO EN TUTOR EMPRESARIAL--->>
                        $inserto=pg_query("INSERT INTO pasantias.tutor_empresarial (id_persona)VALUES($id_persona)");

                        ////////////////////////////////////////////////////////////////////////////////////////////////////

                        $inserto3=pg_query("INSERT INTO  pasantias.persona_organizacion_oficina (id_persona, id_oficina, id_organizacion, id_perfil, estado, observacion, fecha_solicitud, fecha_aceptacion)VALUES
                                                                                            ($id_persona, $ID_OFICINA, $ID_ORGANIZACION, $ID_PERFIL, 'APROBADO', '$OBSERVACION', '$FECHA' , '$FECHA' )");
                         $registro =0;
                         $registro = pg_affected_rows($inserto3);
                                   
                                        pg_free_result($inserto3);
                     
                           return $registro;             
                      }

          }else if($PERFIL =='CONTACTO') {

            $ID_PERFIL=8;

                    //-----CONSULTO HABER SI EXISTE LA CEDULA--->>>
                  $Sql=pg_query("SELECT * FROM pasantias.persona WHERE cedula='$CEDULA' ;");
                  $num=pg_num_rows($Sql);

                  if($num>0){
                        $retorno=2;
                        return $retorno;

                  }else{
                        //--------INSERTO EN LA TABLA PERSONA---->>>>

                        $inserto=pg_query("INSERT INTO pasantias.persona (cedula, nombre, apellido)VALUES('$CEDULA', '$NOMBRE', '$APELLIDO')");

                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////

                        $SELECC=pg_query("SELECT MAX(id_persona) FROM pasantias.persona");
                        $regist=pg_fetch_array($SELECC);
                        $id_persona=$regist[0];
                        //---INSERTO EN TUTOR EMPRESARIAL--->>
                        //$inserto=pg_query("INSERT INTO pasantias.tutor_empresarial (id_persona)VALUES($id_persona)");

                        ////////////////////////////////////////////////////////////////////////////////////////////////////

                        $inserto3=pg_query("INSERT INTO  pasantias.persona_organizacion_oficina (id_persona, id_oficina, id_organizacion, id_perfil, estado, observacion, fecha_solicitud, fecha_aceptacion)VALUES
                                                                                            ($id_persona, $ID_OFICINA, $ID_ORGANIZACION, $ID_PERFIL, 'APROBADO', '$OBSERVACION', '$FECHA' , '$FECHA' )");
                         $registro =0;
                         $registro = pg_affected_rows($inserto3);
                                   
                                        pg_free_result($inserto3);
                     
                           return $registro;             
                      }

            
          }

        
        }//----FIN DE ASIGNAR PERSONAS--->>



          function ConsultarEmpresas(){

            $strsql="SELECT organizacion.id_organizacion AS id_organizacion, organizacion.nombre_organizacion FROM pasantias.organizacion INNER JOIN pasantias.convenio_organizacion ON convenio_organizacion.id_organizacion=organizacion.id_organizacion";
            $result=pg_query($strsql);//ejecuta la tira sql

            return $result;



          }


            function Consultar_ParaRegistrar_Office($ID_ORGANIZACION_P){
                     
                
                $sql="SELECT * FROM pasantias.organizacion_oficina WHERE 
              organizacion_oficina.id_oficina=(SELECT id_oficina FROM pasantias.oficina WHERE
              nombre_oficina = '$this->nombre' ) AND organizacion_oficina.id_organizacion=$ID_ORGANIZACION_P";
                
                $result=pg_query($sql);
                
                $num=pg_num_rows($result);
                  
                return $num;
                               
                
            } 
            
            
            
            
    function Consultar_ParaModificar_Office($ID_ORGANIZACION_P)
        {

      $result=pg_query("SELECT oficina.nombre_oficina, organizacion_oficina.estado, organizacion_oficina.descripcion FROM pasantias.organizacion_oficina, pasantias.oficina 
        WHERE organizacion_oficina.id_oficina=oficina.id_oficina AND oficina.nombre_oficina='$this->nombre' AND organizacion_oficina.estado='$this->estatus' AND organizacion_oficina.descripcion='$this->descripcion' AND organizacion_oficina.id_organizacion=$ID_ORGANIZACION_P");//ejecuta la tira sql

        $num=pg_num_rows($result);

              return $num;
              
        }


       function Modificar_Office($ID_ORGANIZACION_P){

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
                            $consull=pg_query("SELECT * FROM pasantias.organizacion_oficina WHERE id_oficina=$id_oficina_nuevo AND id_organizacion=$ID_ORGANIZACION_P");
                            $num=pg_num_rows($consull);
                            if($num>0){
                                
                                // QUIERE DECIR QUE YA LA TENGO---->
                                  //--PERO DEBO CONSULTA XQ PROBABLEMENTE ESTE EN ACTIVO O MODIFICADO--->>
                                  $sqql=pg_query("SELECT id_oficina FROM pasantias.organizacion_oficina WHERE id_oficina=$id_oficina_nuevo AND id_organizacion=$ID_ORGANIZACION_P AND estado='MODIFICADO'");
                                  $nume=pg_num_rows($sqql);
                                  if($nume>0){
                                        //----SI EXISTE EN MODIFICADO CAMBIO A ACTIVO Y EL OTRO A MODIFICADO--->>
                                        //---PERO NATES DEBO CONSULTA HABER SI TIENE PERSONAS ASIGNADA--->>>
                                        //---->>>> DEBO VER SI HAY PERSONAS ASIGNADAS A LA ESPECIALIDA VIEJA, PARAQ PODER CAMBIAR EL ESTATUS A MODIFICADO--->>>
                                        $str_PersonasAsignadas=pg_query("SELECT * FROM pasantias.persona_organizacion_oficina WHERE id_oficina='$this->id' AND id_organizacion=$ID_ORGANIZACION_P");
                                        $num=pg_num_rows($str_PersonasAsignadas);
                                        if($num>0){
                                            //---SI HAY PERSONAS AQUI, HAGO UN TRASPASO---SOLO EN LA INTERMEDIA--->>>

                                                  $retorno =8;
                                                      return $retorno;

                                                    }else{
                                                      $updd=pg_query("UPDATE pasantias.organizacion_oficina SET estado='ACTIVO' WHERE id_oficina=$id_oficina_nuevo AND id_organizacion=$ID_ORGANIZACION_P");
                                                      $updd2="UPDATE pasantias.organizacion_oficina SET estado='MODIFICADO' WHERE id_oficina='$this->id' AND id_organizacion=$ID_ORGANIZACION_P";
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
                                  $ConsulPersona=pg_query("SELECT * FROM pasantias.persona_organizacion_oficina WHERE id_oficina='$this->id' AND id_organizacion=$ID_ORGANIZACION_P");
                                  $numer=pg_num_rows($ConsulPersona);
                                  if($numer>0){
                                        //---QUIERE DECIR QUE HAY PERSONAS ASIGNADAS EN LA OFICINA QUE INTENTO MODIFICAR--->>>
                                        $retorno=5;
                                        return $retorno;

                                  }else{
                                        //----NO TIENE PERSONAS ASIGNADAS--- PUEDO REGISTRAR EN LA INTERMEDIA Y CAMBIAR EL ESTATUS ANTERIOR A MODIFICADO TRANQUILAMENTE--->>
                                        $insert="INSERT INTO pasantias.organizacion_oficina (id_oficina, id_organizacion, estado, descripcion, observacion)
                                                  VALUES($id_oficina_nuevo, $ID_ORGANIZACION_P, '$this->estatus', '$this->descripcion', 'NO OBSERVACION')";
                                        $res = pg_query($insert) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                                        //----CAMBIO EL ESTATUS ANTERIOR--->>>
                                        $UP=pg_query("UPDATE pasantias.organizacion_oficina SET estado='MODIFICADO' WHERE id_oficina=$this->id AND id_organizacion=$ID_ORGANIZACION_P");

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
                           $SQL=pg_query("SELECT  organizacion_oficina.* FROM pasantias.organizacion_oficina WHERE id_oficina='$this->id' AND id_organizacion!=$ID_ORGANIZACION_P");

                            $num=pg_num_rows($SQL);

                            if($num>0){
                                //----AQUI QUIERE DECIR QUE EL NOMBRE ANTERIOR LO ESTA USANDO OTRA INSTITUCION POR LO TANTO NO LO PUEDO MODIFICAR--->>
                                //---COMO LO ESTA USANDO ALGUIEN  DEBO HACER UN NUEVO REGISTRO(OFICINA)
                                //---ANTES DEBO CONSULTAR A VER SI HAY PERSONAS ASIGNADAS--->>
                                    $ConsulPersona=pg_query("SELECT * FROM pasantias.persona_organizacion_oficina WHERE id_oficina='$this->id' AND id_organizacion=$ID_ORGANIZACION_P");
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
                                      $UP=pg_query("UPDATE pasantias.organizacion_oficina SET estado='MODIFICADO' WHERE id_oficina=$this->id AND id_organizacion=$ID_ORGANIZACION_P");

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
                                $ConsulPersona=pg_query("SELECT * FROM pasantias.persona_organizacion_oficina WHERE id_oficina='$this->id' AND id_organizacion=$ID_ORGANIZACION_P");
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

                                       WHERE id_oficina=$this->id AND id_organizacion=$ID_ORGANIZACION_P "; 

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

                           WHERE id_oficina=$this->id AND id_organizacion=$ID_ORGANIZACION_P "; 

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


            $strsql3=" INSERT INTO pasantias.organizacion_oficina ( id_organizacion , id_oficina , estado, descripcion ) 
                       VALUES ( '$id_organizacion' ,'$id_oficina' , 'ACTIVO', '$this->descripcion') "; 

            $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

           

            //---- HAGO LA "INSERCION" EN LA TABLA PERSONA_ORGANIZACION_OFICINA-TRASPASO-->
                    //---OBTENGO LOS ESTUDIANTES ASIGNADOS A LA ANTERIOR--->>>
                    $reciveList=array();
                    $reciveList=$this->SeleccionarPersonasDeOficina($this->id, $id_organizacion);

                    //---ACTUALIZO EL REGISTRO VIEJO--->>>>
                    $actualizoVieja=pg_query("UPDATE pasantias.organizacion_oficina SET estado='MODIFICADO' WHERE id_oficina='$this->id' AND id_organizacion=$id_organizacion");

                    //---RECORRO AQUI PARA IR ACTUALIZANDO CADA PERSONA--->>
                    for ($i=0; $i <count($reciveList); $i++) { 
                      # code...
                    $updat="UPDATE pasantias.persona_organizacion_oficina SET id_oficina=$id_oficina WHERE id_persona=$reciveList[$i] AND id_organizacion=$id_organizacion ";
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
           
   
        $strsql2=" UPDATE pasantias.organizacion_oficina SET estado='$this->estatus' , descripcion='$this->descripcion' WHERE id_oficina='$this->id' AND id_organizacion=$id_organizacion "; 
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
                $consull=pg_query("SELECT * FROM pasantias.organizacion_oficina WHERE id_oficina=$id_oficina_nuevo AND id_organizacion=$id_organizacion");
                $num=pg_num_rows($consull);
                if($num>0){
                    //---QYUIERE DECIR QUE YA LO TERNGO ASIGNADO---->>
                    $retorno=3;
                    return $retorno;

                }else{
                     //COMO NO LA TENGO ME LA ASIGNO---->EN LA INTERMEDIA---->>
                    $strsql2=" INSERT INTO pasantias.organizacion_oficina  (id_oficina, id_organizacion, estado, descripcion)VALUES ($id_oficina_nuevo, $id_organizacion, '$this->estatus', '$this->descripcion' ) ; "; 
                    $result2 = pg_query($strsql2) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                    //----SEGUIDO HAGO LA "INSERCION-ACTUALIZACION" EN LA TABLA PERSONA_ORGANIZACION_OFICINA-TRASPASO-->
                    $reciveList=array();
                    $reciveList=$this->SeleccionarPersonasDeOficina($this->id, $id_organizacion);

                    //---ACTUALIZO EL REGISTRO VIEJO--->>>>
                    $actualizoVieja=pg_query("UPDATE pasantias.organizacion_oficina SET estado='MODIFICADO' WHERE id_oficina='$this->id' AND id_organizacion=$id_organizacion");

                    //---RECORRO AQUI PARA IR ACTUALIZANDO CADA PERSONA--->>
                    for ($i=0; $i <count($reciveList); $i++) { 
                      # code...
                    $updat="UPDATE pasantias.persona_organizacion_oficina SET id_oficina=$id_oficina_nuevo WHERE id_persona=$reciveList[$i] AND id_organizacion=$id_organizacion ";
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
                    $actualizoVieja=pg_query("UPDATE pasantias.organizacion_oficina SET estado='MODIFICADO' WHERE id_oficina='$this->id' AND id_organizacion=$id_organizacion");
                    $actualizoNueva=pg_query("UPDATE pasantias.organizacion_oficina SET estado='ACTIVO' WHERE id_oficina=$id_oficina_nuevo AND id_organizacion=$id_organizacion");
          
                    //----SEGUIDO HAGO LA "INSERCION-ACTUALIZACION" EN LA TABLA PERSONA_ORGANIZACION_OFICINA-TRASPASO-->
                    $reciveList=array();
                    $reciveList=$this->SeleccionarPersonasDeOficina($this->id, $id_organizacion);

                   
                    //---RECORRO AQUI PARA IR ACTUALIZANDO CADA PERSONA--->>
                    for ($i=0; $i <count($reciveList); $i++) { 
                      # code...
                    $updat="UPDATE pasantias.persona_organizacion_oficina SET id_oficina=$id_oficina_nuevo WHERE id_persona=$reciveList[$i] AND id_organizacion=$id_organizacion ";
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

    $sql=pg_query("SELECT id_persona FROM pasantias.persona_organizacion_oficina WHERE id_organizacion=$id_organizacion AND id_oficina=$id_oficina ");
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
          ////--- CONSULTO SI EL NOMBRE YA ESTA REGISTRADO EN LA MAESTRA--->>>
            $SQL=pg_query("SELECT id_oficina FROM pasantias.organizacion_oficina WHERE 
              organizacion_oficina.id_oficina=(SELECT id_oficina FROM pasantias.oficina WHERE
              nombre_oficina = '$this->nombre')");


                 $NUM=pg_num_rows($SQL);

                 $REGISTRO=pg_fetch_array($SQL);

                 $id_oficina=$REGISTRO['id_oficina'];



                 //------SI EXISTE EN LA MAESTRA ASIGNO SOLO EN LA INTERMEDIA--->>>
                 if($NUM>0){

                    

                    $strsql3=" INSERT INTO pasantias.organizacion_oficina ( id_oficina , id_organizacion , estado, descripcion ) 

                    VALUES ( $id_oficina ,$ID_ORGANIZACION_P , 'ACTIVO', '$this->descripcion') "; 

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



             $strsql3=" INSERT INTO pasantias.organizacion_oficina ( id_oficina , id_organizacion , estado, descripcion ) 

              VALUES ( '$id_oficina' ,'$ID_ORGANIZACION_P' , 'ACTIVO', '$this->descripcion') "; 

                      $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                              $registro =0;
                              $registro = pg_affected_rows($result3);            

                        return $registro;


                 }

         

}//-----FIN DE REGISTRA OFFICE----








//-----INCLUIR NUEVA OFICINA Y ASIGNAR A LA EMPRESA O INSTITUCION--->>>

function Incluir_NuevaOficina_Asignar($ID_ORGANIZACION)
{

            $sql = " SELECT * FROM pasantias.ultimoid_departamento ; ";
            $resultt=pg_query($sql);//ejecuta la tira sql
            $id_departamento = 0;

            $fila = pg_fetch_array($resultt);
            
            $id_departamento = $fila['id'];

            $id_departamento=$id_departamento+1;
            


          //---CONSULTO DE NUEVO PARA ASEGURAR--->>>

              $nuevaSQL="SELECT id_departamento FROM pasantias.departamento WHERE id_departamento='$id_departamento'";
              $result=pg_query($nuevaSQL);
              $num=pg_num_rows($result);

          

            //-----CONDICION, PARA REGISTAR--->>>

              if($num==0){

                $strsql2=" INSERT INTO pasantias.departamento ( id_departamento,estado,descripcion) 

                VALUES ('$id_departamento','$this->estatus','$this->descripcion' ) "; 

                 $result2=pg_query($strsql2);//ejecuta la tira sql

                //--INSERTO EN OFICINA-->>>

                $strsql3=" INSERT INTO pasantias.oficina ( id_departamento , nombre_oficina  ) 

                VALUES (  '$id_departamento','$this->nombre' ) "; 

                $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                $registro =0;
                $registro = pg_affected_rows($result3);

                if($registro>0){

                  $MaxID=pg_query("SELECT MAX(id_oficina) FROM pasantias.oficina");
                  $reg=pg_fetch_array($MaxID);
                  $ID_OFICINA=$reg[0];

                  //----ASIGNO AHORA---->>>

                  $strsql4=" INSERT INTO pasantias.organizacion_oficina ( id_oficina, id_organizacion, estado  ) 

                  VALUES ( '$ID_OFICINA' , '$ID_ORGANIZACION' , 'ACTIVO') "; 

                  $result4 = pg_query($strsql4) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


                              $registro2 =0;
                              $registro2 = pg_affected_rows($result4);


                              return $registro2;
                              }else{
                                return $registro;

                              }

}else{



            $id_departamento=$id_departamento+1;
            
            $strsql2=" INSERT INTO pasantias.departamento ( id_departamento,estado,descripcion) 

                VALUES ('$id_departamento','$this->estatus','$this->descripcion' ) "; 

                 $result2=pg_query($strsql2);//ejecuta la tira sql

                //--INSERTO EN OFICINA-->>>

                $strsql3=" INSERT INTO pasantias.oficina ( id_departamento , nombre_oficina  ) 

                VALUES (  '$id_departamento','$this->nombre' ) "; 

                $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                $registro =0;
                $registro = pg_affected_rows($result3);

                if($registro>0){

                  $MaxID=pg_query("SELECT MAX(id_oficina) FROM pasantias.pasantias.oficina");
                  $reg=pg_fetch_array($MaxID);
                  $ID_OFICINA=$reg[0];

              


                  //----ASIGNO AHORA---->>>

                  $strsql4=" INSERT INTO pasantias.organizacion_oficina ( id_oficina, id_organizacion, estado  ) 

                  VALUES ( '$ID_OFICINA' , '$ID_ORGANIZACION' , 'ACTIVO') "; 

                  $result4 = pg_query($strsql4) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


                              $registro2 =0;
                              $registro2 = pg_affected_rows($result4);


                              return $registro2;
                              }else{


                                return $registro;

                              }





}
}
//---DFIN DE INCLUIR Y ASIGNAR OFICINA--->>>







function Consultar_Oficina_Catalago($ID_ORGANIZACION_PRINCIPAL)
{

$sql=" SELECT oficina.id_oficina, oficina.nombre_oficina, organizacion_oficina.estado, organizacion_oficina.descripcion, organizacion_oficina.observacion FROM pasantias.oficina  
       JOIN  pasantias.departamento ON  oficina.id_departamento = pasantias.departamento.id_departamento
             JOIN  pasantias.organizacion_oficina ON organizacion_oficina.id_oficina = oficina.id_oficina  
             JOIN  pasantias.organizacion ON organizacion.id_organizacion = organizacion_oficina.id_organizacion WHERE organizacion_oficina.id_organizacion=$ID_ORGANIZACION_PRINCIPAL AND organizacion_oficina.estado!='MODIFICADO'";
	 	 
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
   $cont=0;
  
  while($reg=pg_fetch_array($result)){


        $Registros[$cont]=$reg['nombre_oficina'];


        $cont++;
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
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
?>