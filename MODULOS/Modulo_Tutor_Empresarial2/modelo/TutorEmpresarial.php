<?php

require_once("../../../BASE_DATOS/Conect.php");

 $ConexionBD =new Conexion();
 $ConexionBD->Conectar();

class ModTutor{



	function ConsultarNombre_Cedula_AutoComplete()
	{
	    

	$sql="SELECT cedula FROM pasantias.persona  ";
	     
	   $result=pg_query($sql);//ejecuta la tira sql

	   $Registros = array();
	   $cont=0;
	  
	  while($reg=pg_fetch_array($result)){


	        $Registros[$cont]=$reg['cedula'];


	        $cont++;
	  }   
	  return $Registros;
        
	}



function AsignarPersona_Oficina_Organizacion($Vista=array()){
          $retorno=0;

          $ID_ORGANIZACION      =$Vista['id_organizacion'];
          $CEDULA               =$Vista['cedula'];
          $NOMBRE               =$Vista['nombre'];
          $APELLIDO             =$Vista['apellido'];
          $FECHA                =$Vista['fecha'];
          $OBSERVACION          =$Vista['observacion'];
          $OFICINA_SELECT       =$Vista['oficina_select'];
          $ID_PERFIL=5;


          		$repuesta=$this->ConsultarExistencia($ID_ORGANIZACION,$CEDULA, $OFICINA_SELECT);

          		if($repuesta>0){
          			$retorno=3;
          			return $retorno;

          		}else{


          		 $idPersona=pg_query("SELECT id_persona FROM pasantias.persona WHERE cedula='$CEDULA'");
		         $resultID=pg_fetch_array($idPersona);
		         $ID_PERSONA=$resultID['id_persona'];

		         if($resultID>0){

		         		$inserto2=pg_query("INSERT INTO  pasantias.persona_organizacion_oficina (id_persona, id_oficina, codigo_sucursal, id_perfil, estado, observacion, fecha_solicitud, fecha_aceptacion)VALUES
                                                                                            ($ID_PERSONA, $OFICINA_SELECT, '$ID_ORGANIZACION', 5, 'APROBADO', '$OBSERVACION', '$FECHA' , '$FECHA' )");

                        //---INSERTO EN TUTOR EMPRESARIAL--->>
                        $inserto3=pg_query("INSERT INTO pasantias.tutor_empresarial (codigo_sucursal,id_persona, id_oficina, id_perfil)VALUES
                                                                                   ('$ID_ORGANIZACION', $ID_PERSONA, $OFICINA_SELECT, 5 )");
                         $registro2 =0;
                         $registro2 = pg_affected_rows($inserto2);
                         $registro3 =0;
                         $registro3 = pg_affected_rows($inserto3);
                                   
                                       
                                        pg_free_result($inserto2);
                                        pg_free_result($inserto3);

                                        if(($registro2>0)&&($registro3>0)){
                                          $retorno=2;

                                        }else{
                                          $retorno=0;
                                        }
         
                           return $retorno;



		         }else{

		         		 //--------INSERTO EN LA TABLA PERSONA---->>>>

                        $inserto=pg_query("INSERT INTO pasantias.persona (cedula, nombre, apellido)VALUES('$CEDULA', '$NOMBRE', '$APELLIDO')");

                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////

                        $SELECC=pg_query("SELECT MAX(id_persona) FROM pasantias.persona");
                        $regist=pg_fetch_array($SELECC);
                        $id_persona=$regist[0];


                        $inserto2=pg_query("INSERT INTO  pasantias.persona_organizacion_oficina (id_persona, id_oficina, codigo_sucursal, id_perfil, estado, observacion, fecha_solicitud, fecha_aceptacion)VALUES
                                                                                            ($id_persona, $OFICINA_SELECT, '$ID_ORGANIZACION', 5, 'APROBADO', '$OBSERVACION', '$FECHA' , '$FECHA' )");

                        //---INSERTO EN TUTOR EMPRESARIAL--->>
                        $inserto3=pg_query("INSERT INTO pasantias.tutor_empresarial (codigo_sucursal,id_persona, id_oficina, id_perfil)VALUES
                                                                                   ('$ID_ORGANIZACION', $id_persona, $OFICINA_SELECT, 5 )");

                        ////////////////////////////////////////////////////////////////////////////////////////////////////
                         $registro =0;
                         $registro = pg_affected_rows($inserto);
                         $registro2 =0;
                         $registro2 = pg_affected_rows($inserto2);
                         $registro3 =0;
                         $registro3 = pg_affected_rows($inserto3);
                                   
                                        pg_free_result($inserto);
                                        pg_free_result($inserto2);
                                        pg_free_result($inserto3);

                                        if(($registro>0)&&($registro2>0)&&($registro3>0)){
                                          $retorno=1;

                                        }else{
                                          $retorno=0;
                                        }
         
                           return $retorno;  


		         }
		     }

                                  
                      

           
        }//----FIN DE ASIGNAR PERSONAS--->>


function ActualizarBD_Asignacion($Vista= array()){

          $ID_ORGANIZACION      =$Vista['id_organizacion'];
          $ID_OFICINA           =$Vista['id_oficina'];
          $CEDULA               =$Vista['cedula'];
          $NOMBRE               =$Vista['nombre'];
          $APELLIDO             =$Vista['apellido'];
          $FECHA                =$Vista['fecha'];
          $OBSERVACION          =$Vista['observacion'];
          $OFICINA_SELECT       =$Vista['oficina_select']; 
          
          $retorno=0;

          $modificacion=$this->ConsultarModificacion($ID_ORGANIZACION,$CEDULA, $ID_OFICINA);
          $comparo=pg_fetch_array($modificacion);
	          if($comparo['id_oficina']==$OFICINA_SELECT){

	          		$strsql=" UPDATE pasantias.persona SET nombre='$NOMBRE', apellido='$APELLIDO' 
		             WHERE cedula='$CEDULA' "; 

		            $result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		            $idPersona=pg_query("SELECT id_persona FROM pasantias.persona WHERE cedula='$CEDULA'");
		            $resultID=pg_fetch_array($idPersona);
		            $ID_PERSONA=$resultID['id_persona'];

		            //----------------------------------                             ----------------------//////


		            $strsql3=" UPDATE pasantias.persona_organizacion_oficina SET id_oficina='$OFICINA_SELECT', observacion='$OBSERVACION' 
		             WHERE id_oficina='$ID_OFICINA' AND codigo_sucursal='$ID_ORGANIZACION' AND id_persona='$ID_PERSONA' "; 

		            $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());



		            $Actualiza =0;
		            $Actualiza = pg_affected_rows($result);

		            $Actualiza3 =0;
		            $Actualiza3 = pg_affected_rows($result3);
		     
		         	if(($Actualiza>0)&&($Actualiza3>0)){
		         		$retorno=1;

		         	}else{
		         		$retorno=0;
		         	}

		            return $retorno;



	          }else{


          	$repuesta=$this->ConsultarExistencia($ID_ORGANIZACION,$CEDULA, $OFICINA_SELECT);

          		if($repuesta>0){
          			$retorno=3;
          			return $retorno;

          		}else{

            $strsql=" UPDATE pasantias.persona SET nombre='$NOMBRE', apellido='$APELLIDO' 
             WHERE cedula='$CEDULA' "; 

            $result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

            $idPersona=pg_query("SELECT id_persona FROM pasantias.persona WHERE cedula='$CEDULA'");
            $resultID=pg_fetch_array($idPersona);
            $ID_PERSONA=$resultID['id_persona'];

            //----------------------------------                             ----------------------//////

            $strsql3=" UPDATE pasantias.persona_organizacion_oficina SET id_oficina='$OFICINA_SELECT', observacion='$OBSERVACION' 
             WHERE id_oficina='$ID_OFICINA' AND codigo_sucursal='$ID_ORGANIZACION' AND id_persona='$ID_PERSONA' "; 

            $result3 = pg_query($strsql3) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


            $Actualiza =0;
            $Actualiza = pg_affected_rows($result);

            $Actualiza3 =0;
            $Actualiza3 = pg_affected_rows($result3);
     
         	if(($Actualiza>0)&&($Actualiza3>0)){
         		$retorno=1;

         	}else{
         		$retorno=0;
         	}

            return $retorno;
        }
    }

        }


  
 function ConsultarExistencia($ID_ORGANIZACION,$CEDULA, $OFICINA_SELECT){

 	$strsql=pg_query("SELECT organizacion.id_organizacion, persona_organizacion_oficina.id_perfil , persona.cedula, persona.nombre , persona.apellido , oficina.id_oficina, oficina.nombre_oficina,
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
                            organizacionmunicipio.codigo_sucursal='$ID_ORGANIZACION' AND persona.cedula='$CEDULA' AND persona_organizacion_oficina.id_oficina=$OFICINA_SELECT AND persona_organizacion_oficina.id_perfil=5");
	$result=pg_num_rows($strsql);

	return $result;

 }


 function ConsultarModificacion($ID_ORGANIZACION,$CEDULA, $OFICINA){

 		$strsql=pg_query("SELECT organizacion.id_organizacion, persona_organizacion_oficina.id_perfil , persona.cedula, persona.nombre , persona.apellido , oficina.id_oficina, oficina.nombre_oficina,
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
                            organizacionmunicipio.codigo_sucursal='$ID_ORGANIZACION' AND persona.cedula='$CEDULA' AND persona_organizacion_oficina.id_oficina=$OFICINA AND persona_organizacion_oficina.id_perfil=5");
	

	return $strsql;



 }



function Consultar_Catalago_OficinaAsignadas($ID_ORGANIZACION)
        {

        $Array=array();

        $sql="SELECT pasantias.oficina.nombre_oficina, pasantias.organizacion_oficina.* FROM  pasantias.departamento JOIN pasantias.oficina ON 
        departamento.id_departamento=oficina.id_departamento JOIN pasantias.organizacion_oficina 
        ON oficina.id_oficina=organizacion_oficina.id_oficina JOIN pasantias.organizacionmunicipio
        ON organizacionmunicipio.codigo_sucursal=organizacion_oficina.codigo_sucursal JOIN pasantias.organizacion 
        ON organizacionmunicipio.id_organizacion=organizacion.id_organizacion AND organizacionmunicipio.codigo_sucursal='$ID_ORGANIZACION' AND organizacion_oficina.estado!='MODIFICADO'
         ;";

        $result=pg_query($sql);//ejecuta la tira sql

                 

              return $result;
        }



        function Consultar_Catalago_OficinaAsignadasACTIVAS($ID_ORGANIZACION)
        {

        $Array=array();

        $sql="SELECT pasantias.oficina.nombre_oficina, pasantias.organizacion_oficina.* FROM  pasantias.departamento JOIN pasantias.oficina ON 
        departamento.id_departamento=oficina.id_departamento JOIN pasantias.organizacion_oficina 
        ON oficina.id_oficina=organizacion_oficina.id_oficina JOIN pasantias.organizacionmunicipio
        ON organizacionmunicipio.codigo_sucursal=organizacion_oficina.codigo_sucursal JOIN pasantias.organizacion 
        ON organizacionmunicipio.id_organizacion=organizacion.id_organizacion AND organizacionmunicipio.codigo_sucursal='$ID_ORGANIZACION' AND organizacion_oficina.estado='ACTIVO' 
         ;";

        $result=pg_query($sql);//ejecuta la tira sql

                 

              return $result;
        }








/*
function Modificar_Especilidad(){

echo $this->id;

$sql = " SELECT id_departamento FROM pasantias.especialidad  WHERE id_especialidad='$this->id' ; ";

$result=pg_query($sql);//ejecuta la tira sql

 		$id_departamento = 0 ;
		
		while($fila = pg_fetch_array($result)){
	
		$id_departamento = $fila['id_departamento'];

	    		}



	$strsql=" UPDATE pasantias.departamento SET estado='$this->estatus' , descripcion='$this->descripcion'

	 WHERE id_departamento='$id_departamento' "; 

	$result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		  


	$strsql=" UPDATE pasantias.especialidad SET nombre_especialidad='$this->nombre' , id_tipo_especialidad='$this->id_tipo_especialidad' WHERE id_especialidad='$this->id' "; 

	$result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		  
		  $registro =0;
		  $registro = pg_affected_rows($result);
		 
          pg_free_result($result);

            return $registro;




}







function Consultar_ParaModificar($Formulario=array())
        {


        $sql="SELECT * FROM pasantias.especialidad WHERE nombre_especialidad = '$this->nombre' and id_tipo_especialidad='$this->id_tipo_especialidad' ";

                 $result=pg_query($sql);//ejecuta la tira sql

                 $num=pg_num_rows($result);

              return $num;
        }


        
        
 function Consultar_ParaRegistrar($Dato)
        {


        $sql="SELECT * FROM pasantias.especialidad WHERE nombre_especialidad = '".$Dato."' ";

                 $result=pg_query($sql);//ejecuta la tira sql

                 $num=pg_num_rows($result);

              return $num;
        }
















/////////////////////////////O F I C I N A----------//////////////////////////7


            function Consultar_ParaRegistrar_Office($Dato){
                     
                
                $sql="SELECT * FROM pasantias.oficina WHERE nombre_oficina='".$Dato."'";
                
                $result=pg_query($sql);
                
                $num=pg_num_rows($result);
                
                
                
                return $num;
                
                
                
            } 
            
            
            
            
    function Consultar_ParaModificar_Office($Formulario=array())
        {


        $sql="SELECT * FROM pasantias.oficina WHERE nombre_oficina = '$this->nombre' ";

                 $result=pg_query($sql);//ejecuta la tira sql

                 $num=pg_num_rows($result);

              return $num;
        }
            
            
            
            
            function Incluir_Oficina()
{


            $strsql=" INSERT INTO pasantias.departamento ( estado,descripcion  ) 

            VALUES ( '$this->estatus','$this->descripcion' ) "; 

             $result=pg_query($strsql);//ejecuta la tira sql


            $sql = " SELECT * FROM pasantias.ultimoid_departamento ; ";

            $result=pg_query($sql);//ejecuta la tira sql

 		$id_departamento = 0 ;
		

		while($fila = pg_fetch_array($result)){
	
		$id_departamento = $fila['id'];

	    		}



            $strsql=" INSERT INTO pasantias.oficina ( id_departamento , nombre_oficina  ) 

            VALUES (  '$id_departamento','$this->nombre' ) "; 

            $result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


                              $registro =0;
                              $registro = pg_affected_rows($result);

                      pg_free_result($result);

            return $registro;

}


function Consultar_Oficina_Catalago()
{

$sql="SELECT * FROM pasantias.oficina  , pasantias.departamento WHERE

 pasantias.oficina.id_departamento  = pasantias.departamento.id_departamento   ";
	 	 
	 $result=pg_query($sql);//ejecuta la tira sql

	

	 return $result;
	 
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



function Modificar_Office(){

echo $this->id;

$sql = " SELECT id_departamento FROM pasantias.oficina  WHERE id_oficina='$this->id' ; ";

$result=pg_query($sql);//ejecuta la tira sql

 		$id_departamento = 0 ;
		
		while($fila = pg_fetch_array($result)){
	
		$id_departamento = $fila['id_departamento'];

	    		}



	$strsql=" UPDATE pasantias.departamento SET estado='$this->estatus' , descripcion='$this->descripcion'

	 WHERE id_departamento='$id_departamento' "; 

	$result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		  


	$strsql=" UPDATE pasantias.oficina SET nombre_oficina='$this->nombre' WHERE id_oficina='$this->id' "; 

	$result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		  
		  $registro =0;
		  $registro = pg_affected_rows($result);
		 
          pg_free_result($result);

            return $registro;




}*/







	 

}
?>