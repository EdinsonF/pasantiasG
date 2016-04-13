<?php


class estudiante{

public $cedula;
public $nombre;
public $apellido;
public $expediente;
public $especialidad;
public $telefono;
public $correo;
public $id_persona;
public $id_usuario;


public function llenarselecttipoorganizaciones()
  {

    $insert ="SELECT id_tipo_organizacion, nombre_tipo_organizacion From pasantias.tipo_organizacion"; 
    $resultado =pg_query( $insert);

    while($fila = pg_fetch_array($resultado)){
  
    echo "<option value='".$fila['id_tipo_organizacion']."'>".$fila['nombre_tipo_organizacion']."</option>";
    
    
      }

  }


function consultar_estudiantes_para_incluir(){

consultar_estudiante($id_instituto, $cedula, $expediente);

$result=$this->consultar_estudiante($id_instituto, $cedula, $expediente);
$regist=pg_fetch_array($result);
$id_persona=$regist[0];
if($result==0){
$this->consultar_usuario_estudiante($id_persona);
}else{
$num=1;
  return $num;
}

}


function consultar_usuario_estudiante($id_persona)
{
  if($id_persona==null){}else{
    
    $strsql="SELECT distinct usuario.id_usuario, usuario.usuario, usuario.contrasena, usuario.pregunta, usuario.respuesta, persona_instituto_especialidad.estado, persona_instituto_especialidad.id_perfil FROM
     pasantias.usuario, pasantias.persona_instituto_especialidad WHERE
      usuario.id_persona ='$id_persona' and
       persona_instituto_especialidad.id_perfil ='3' and 
       usuario.id_persona=persona_instituto_especialidad.id_persona";
      
      $numm=0;
    
    $result2=pg_query($strsql);//ejecuta la tira sql
   return $result2;

}
}


function consultar_estudiante_solo($vista=array())
{
                 
$id_instituto = $vista['id_instituto'];
$cedula       = $vista['cedula'];
$expediente   = $vista['expediente'];


   if($expediente==""){
     $strsql="SELECT distinct persona.*, estudiante.*, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
 especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
 especialidad_instituto_principal.observacion, persona_instituto_especialidad.estado, fecha_solicitud FROM pasantias.persona 
 JOIN pasantias.estudiante ON estudiante.id_persona=persona.id_persona and persona.cedula='$cedula'
 JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona = persona.id_persona and persona_instituto_especialidad.id_perfil='3'
 JOIN pasantias.especialidad ON persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad
 JOIN pasantias.instituto_principal ON instituto_principal.id_ip= persona_instituto_especialidad.id_ip
 JOIN pasantias.tipo_especialidad ON especialidad.id_tipo_especialidad = tipo_especialidad.id_tipo_especialidad
 JOIN pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_ip = instituto_principal.id_ip and instituto_principal.id_ip='$id_instituto'
AND especialidad_instituto_principal.id_especialidad = persona_instituto_especialidad.id_especialidad AND  especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip   


     ";
   $num=0;
   $result=pg_query($strsql);//ejecuta la tira sql
   
   return $result;
   

   }else{
     $strsql="SELECT persona.*, estudiante.*, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
 especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
 especialidad_instituto_principal.observacion, persona_instituto_especialidad.estado, fecha_solicitud FROM pasantias.persona 
 JOIN pasantias.estudiante ON estudiante.id_persona=persona.id_persona and estudiante.expediente='$expediente'
 JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona = persona.id_persona and persona_instituto_especialidad.id_perfil='3'
 JOIN pasantias.especialidad ON persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad
 JOIN pasantias.instituto_principal ON instituto_principal.id_ip= persona_instituto_especialidad.id_ip
 JOIN pasantias.tipo_especialidad ON especialidad.id_tipo_especialidad = tipo_especialidad.id_tipo_especialidad
 JOIN pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_ip = instituto_principal.id_ip and instituto_principal.id_ip='$id_instituto'
AND especialidad_instituto_principal.id_especialidad = persona_instituto_especialidad.id_especialidad AND  especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip   

     ";
     $num=0;
   $result=pg_query($strsql);//ejecuta la tira sql
   
   return $result;

   }

}


function actualizar_datos_basicos(){


	$strsql="UPDATE pasantias.persona SET telefono='$this->telefono', correo='$this->correo' where id_persona='$this->id_persona'";
		
		$result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		  
		  $numm =0;
		  $numm = pg_affected_rows($result);
		 
          pg_free_result($result);

return $numm;
}

public function llenarselectEspecialidad($ID_INSTITUCION)
  {

    $insert ="SELECT especialidad.id_especialidad, especialidad.nombre_especialidad From pasantias.especialidad
INNER JOIN pasantias.especialidad_instituto_principal ON especialidad.id_especialidad=especialidad_instituto_principal.id_especialidad 
and especialidad_instituto_principal.id_ip='$ID_INSTITUCION' "; 
    $resultado =pg_query( $insert);

    while($fila = pg_fetch_array($resultado)){
  
    echo "<option value='".$fila['id_especialidad']."'>".$fila['nombre_especialidad']."</option>";
    
    
      }

  }


public function cargar_modal_istitutos()
  {

$strsql="SELECT organizacion.*, instituto_principal.* FROM 
pasantias.organizacion, pasantias.instituto_principal WHERE
pasantias.instituto_principal.id_organizacion=pasantias.organizacion.id_organizacion AND 
pasantias.instituto_principal.estatus='ACTIVO'";
$result=pg_query($strsql);//ejecuta la tira sql
return $result;
  }



public function cargarcatalogoestudiantes($ID_INSTITUCION)
	{

$strsql="SELECT distinct persona.cedula, persona.nombre , persona.apellido , estudiante.expediente, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
 especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
 especialidad_instituto_principal.observacion FROM pasantias.persona 
 JOIN pasantias.estudiante ON estudiante.id_persona=persona.id_persona
 JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona = persona.id_persona and 
 persona_instituto_especialidad.id_perfil='3'
 JOIN pasantias.especialidad ON persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad
 JOIN pasantias.instituto_principal ON instituto_principal.id_ip= persona_instituto_especialidad.id_ip
 JOIN pasantias.tipo_especialidad ON especialidad.id_tipo_especialidad = tipo_especialidad.id_tipo_especialidad
 JOIN pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_ip = instituto_principal.id_ip and
  instituto_principal.id_ip='$ID_INSTITUCION'
AND especialidad_instituto_principal.id_especialidad = persona_instituto_especialidad.id_especialidad AND  especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip ";
$result=pg_query($strsql);//ejecuta la tira sql

                    //CONTADOR PARA INCREMNETAR EL NUMERO DE FILAS-->>>

                    $variable=0;
                        echo'<thead>
                                <tr class="well" >
                                <td colspan="4"><strong ><center>Personas</center></strong></td>
                                <td colspan="2"><strong ><center>Especialidad</center></strong></td>
                                </tr>
                                <tr>
                                    <td><strong><center>Expediente</center></strong></td>
                                    <td><strong><center>Cédula</center></strong></td>
                                    <td><strong><center>Nombre</center></strong></td>
                                    <td><strong><center>Apellido</center></strong></td>
                                    
                                    <td><strong><center>Nómbre</center></strong></td>
                                    <td><strong><center>Tipo</center></strong></td>
                                    
                                  
                                </tr>
                        </thead>
                        <tbody >';


                            while ($registro=pg_fetch_array($result)) {

                            	$expediente=$registro['expediente'];
                              $cedula=$registro['cedula'];
                              $nombre=$registro['nombre'];
                              $apellido=$registro['apellido'];
                             
                              $nombre_especialidad=$registro['nombre_especialidad'];
                              $nombre_tipo_especialidad=$registro['nombre_tipo_especialidad'];
                             
                              
                              

                             // $nombre_tipo_especialidad=$Tipo->ConsultarNombre_xId($id_tipo_especialidad);
                               echo'<tr class="estado" onclick="seleccionarfila(this)";>';
                             
                       
                        	echo'<td ><center>'.$expediente.'</center></td>';
                              echo'<td class=cedula><center>'.$cedula.'</center></td>';
                              echo'<td ><center>'.$nombre.'</center></td>';
                              echo'<td ><center>'.$apellido.'</center></td>';
                             
                              echo'<td ><center>'.$nombre_especialidad.'</center></td>';
                              echo'<td ><center>'.$nombre_tipo_especialidad.'</center></td>';
                           	  
                             
                              
                              
                        echo' </tr>';

                            $variable++;

                            }
            echo "</tbody>";

        


	}

public function cargarcatalogoPersonas($ID_INSTITUCION)
  {

$strsql1="SELECT id_persona, cedula, nombre, apellido FROM pasantias.persona";
$result1=pg_query($strsql1);
//ejecuta la tira sql

                    //CONTADOR PARA INCREMNETAR EL NUMERO DE FILAS-->>>

                    $variable=1;
                        echo'<thead>
                                <tr class="well" >
                                <td colspan="5"><strong ><center>Personas</center></strong></td>
                                <td colspan="4"><strong ><center>Especialidad</center></strong></td>
                                </tr>
                                <tr>
                                    <td hidden style="display: none;">id_persona</td>
                                    <td><strong><center>N°</center></strong></td>
                                    <td><strong><center>Expediente</center></strong></td>
                                    <td><strong><center>Cédula</center></strong></td>
                                    <td><strong><center>Nombre</center></strong></td>
                                    <td><strong><center>Apellido</center></strong></td>
                                    
                                    <td hidden style="display: none;">idEspecialidad</td>
                                    <td><strong><center>Nombre</center></strong></td>
                                    <td><strong><center>Tipo</center></strong></td>
                                    <td><strong><center>Observacion</center></strong></td>
                                    <td><strong><center>Fecha</center></strong></td>
                                  
                                </tr>
                        </thead>
                        <tbody >';

               
                            while (  $registro = pg_fetch_assoc($result1)  ) {

                          echo'<tr class="estado" onclick="seleccionarfilaPersona(this)";>';
                       
                          echo'<td hidden >'.$registro['id_persona'].'</td><td class=id><center>'.$variable.'</center></td>';

                           $strsql2="SELECT expediente FROM pasantias.estudiante where id_persona=".$registro['id_persona'].";";
                           $result2=pg_query($strsql2); 
                            
                      $registro2=pg_fetch_array($result2);
                        
                              

                          if(isset($registro2[0])){
                            $expediente=$registro2['expediente'];
                            echo'<td class=expediente><center>'.$expediente.'</center></td>';
                              
                          }else{
                              echo'<td class=expediente><center>-----</center></td>';
                          }

                        
                              $cedula=$registro['cedula'];
                              $nombre=$registro['nombre'];
                              $apellido=$registro['apellido'];
                              echo'<td class=cedula><center>'.$cedula.'</center></td>';
                              echo'<td class=nombre><center>'.$nombre.'</center></td>';
                              echo'<td class=apellido><center>'.$apellido.'</center></td>';
                             

  $strsql3="SELECT persona_instituto_especialidad.id_persona, persona_instituto_especialidad.id_perfil,persona_instituto_especialidad.id_ip ,persona_instituto_especialidad.fecha_solicitud, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
  especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
  especialidad_instituto_principal.observacion FROM pasantias.persona 
  JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona =  persona.id_persona AND
  persona_instituto_especialidad.id_persona= ".$registro['id_persona']." and 
 persona_instituto_especialidad.id_perfil='3'
 JOIN pasantias.especialidad ON persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad
 JOIN pasantias.instituto_principal ON instituto_principal.id_ip= persona_instituto_especialidad.id_ip
 JOIN pasantias.tipo_especialidad ON especialidad.id_tipo_especialidad = tipo_especialidad.id_tipo_especialidad
 JOIN pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_ip = instituto_principal.id_ip and
  instituto_principal.id_ip='$ID_INSTITUCION'
AND especialidad_instituto_principal.id_especialidad = persona_instituto_especialidad.id_especialidad AND
  especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip";
$result3=pg_query($strsql3);
                             
                    $registro3=pg_fetch_array($result3);
                        
                              
                          if(!isset($registro3[0])){

                              echo'<td style="display: none;" class=id_especialidad><center>-----</center></td>';
                              echo'<td class=especialidad><center>-----</center></td>';
                              echo'<td ><center>-----</center></td>';
                              echo'<td class=observacion><center>-----</center></td>';
                              echo'<td class=fecha><center>-----</center></td>';
                          }else{

                              echo'<td style="display: none;" class=id_especialidad><center>'.$registro3['id_especialidad'].'</center></td>';
                              echo'<td class=especialidad><center>'.$registro3['nombre_especialidad'].'</center></td>';
                              echo'<td ><center>'.$registro3['nombre_tipo_especialidad'].'</center></td>';
                              echo'<td class=observacion><center>'.$registro3['observacion'].'</center></td>';
                              echo'<td class=fecha><center>'.$registro3['fecha_solicitud'].'</center></td>';
                           }
                              
                        echo' </tr>';

                           $variable++;

                            }
            echo "</tbody>";

        


  }





public function CargarCatalogoAprobarEstudiante($ID_INSTITUCION)
	{

$strsql="SELECT persona.cedula, persona.nombre, persona.id_persona, usuario.id_usuario, usuario.usuario, usuario.contrasena, persona.apellido, estudiante.expediente, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
 especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
 especialidad_instituto_principal.observacion FROM pasantias.persona 
 JOIN pasantias.estudiante ON estudiante.id_persona=persona.id_persona 
 JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona = persona.id_persona and
  persona_instituto_especialidad.estado='PENDIENTE' and persona_instituto_especialidad.id_perfil='3' and persona_instituto_especialidad.fecha_solicitud is not null
 JOIN pasantias.especialidad ON persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad
 JOIN pasantias.instituto_principal ON instituto_principal.id_ip= persona_instituto_especialidad.id_ip
 JOIN pasantias.tipo_especialidad ON especialidad.id_tipo_especialidad = tipo_especialidad.id_tipo_especialidad
 JOIN pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_ip = instituto_principal.id_ip and instituto_principal.id_ip='$ID_INSTITUCION'
AND especialidad_instituto_principal.id_especialidad = persona_instituto_especialidad.id_especialidad AND  especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip   
JOIN pasantias.usuario ON persona.id_persona=usuario.id_persona";
$result=pg_query($strsql);//ejecuta la tira sql


					echo"<thead>
                     <tr >
                          <tr class='well' >
                                <td colspan='4'><strong ><center>Personas</center></strong></td>
                                <td colspan='3'><strong ><center>Especialidad</center></strong></td>
                                </tr>
                                <tr>
                                    <td><strong><center>Expediente</center></strong></td>
                                    <td><strong><center>Cédula</center></strong></td>
                                    <td><strong><center>Nombre</center></strong></td>
                                    <td><strong><center>Apellido</center></strong></td>
                                    
                                    <td><strong><center>Nómbre</center></strong></td>
                                    <td><strong><center>Tipo</center></strong></td>
                                    <td><strong><center>Operación</center></strong></td>
                                    
                                </tr>
                       
                    </tr>
               		</thead>";
               	
		               while ($registro=pg_fetch_array($result)) {

                            	$expediente=$registro['expediente'];
                              $cedula=$registro['cedula'];
                              $nombre=$registro['nombre'];
                              $apellido=$registro['apellido'];
                             
                              $nombre_especialidad=$registro['nombre_especialidad'];
                              $nombre_tipo_especialidad=$registro['nombre_tipo_especialidad'];
                              $id_persona=$registro['id_persona'];
                              
                              

                             // $nombre_tipo_especialidad=$Tipo->ConsultarNombre_xId($id_tipo_especialidad);
                             
                          echo'<tr >';
                        	echo'<td ><center>'.$expediente.'</center></td>';
                              echo'<td ><center>'.$cedula.'</center></td>';
                              echo'<td ><center>'.$nombre.'</center></td>';
                              echo'<td ><center>'.$apellido.'</center></td>';
                             
                              echo'<td ><center>'.$nombre_especialidad.'</center></td>';
                              echo'<td ><center>'.$nombre_tipo_especialidad.'</center></td>';
                             
                              echo "
				 <form name='' action='../controlador/ctr_estudiante.php' method='post' >
                              <td><center> 
                                <input type='hidden' name='id_persona' id='persona' autocomplete='off' value='".$registro['id_persona']."'>
                                <input type='submit' class='btn btn-primary btn-large' name='btnAprobar' id='btnAprobar' value='Aprobar'>
                                 <input type='button' class='btn btn-primary btn-large' name='btnRechazar' id='".$registro['id_persona']."' value='Rechazar'>
    
                               </form>
				</tr> ";
							
				}


	}

public function CargarCatalogoEstudianteAprobados($ID_INSTITUCION)
	{

 $strsql="SELECT persona.cedula, persona.nombre, persona.id_persona, usuario.id_usuario, usuario.usuario, usuario.contrasena, persona.apellido, estudiante.expediente, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
 especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
 especialidad_instituto_principal.observacion FROM pasantias.persona 
 JOIN pasantias.estudiante ON estudiante.id_persona=persona.id_persona 
 JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona = persona.id_persona and
  persona_instituto_especialidad.estado='APROBADO' and persona_instituto_especialidad.id_perfil='3' 
 JOIN pasantias.especialidad ON persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad
 JOIN pasantias.instituto_principal ON instituto_principal.id_ip= persona_instituto_especialidad.id_ip
 JOIN pasantias.tipo_especialidad ON especialidad.id_tipo_especialidad = tipo_especialidad.id_tipo_especialidad
 JOIN pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_ip = instituto_principal.id_ip and instituto_principal.id_ip='$ID_INSTITUCION'
AND especialidad_instituto_principal.id_especialidad = persona_instituto_especialidad.id_especialidad AND  especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip   
JOIN pasantias.usuario ON persona.id_persona=usuario.id_persona";
$result=pg_query($strsql);//ejecuta la tira sql


					echo"<thead>
                     <tr >
                          <tr class='well' >
                                <td colspan='4'><strong ><center>Personas</center></strong></td>
                                <td colspan='3'><strong ><center>Especialidad</center></strong></td>
                                </tr>
                                <tr>
                                    <td><strong><center>Expediente</center></strong></td>
                                    <td><strong><center>Cédula</center></strong></td>
                                    <td><strong><center>Nombre</center></strong></td>
                                    <td><strong><center>Apellido</center></strong></td>
                                    
                                    <td><strong><center>Nómbre</center></strong></td>
                                    <td><strong><center>Tipo</center></strong></td>
                                    <td><strong><center>Operación</center></strong></td>
                                  
                                </tr>
                       
                    </tr>
               		</thead>";
               	
		               while ($registro=pg_fetch_array($result)) {

                            	$expediente=$registro['expediente'];
                              $cedula=$registro['cedula'];
                              $nombre=$registro['nombre'];
                              $apellido=$registro['apellido'];
                             
                              $nombre_especialidad=$registro['nombre_especialidad'];
                              $nombre_tipo_especialidad=$registro['nombre_tipo_especialidad'];
                             
                              
                              

                             // $nombre_tipo_especialidad=$Tipo->ConsultarNombre_xId($id_tipo_especialidad);
                             
                          echo'<tr >';
                        	echo'<td ><center>'.$expediente.'</center></td>';
                              echo'<td class=cedula><center>'.$cedula.'</center></td>';
                              echo'<td ><center>'.$nombre.'</center></td>';
                              echo'<td ><center>'.$apellido.'</center></td>';
                             
                              echo'<td ><center>'.$nombre_especialidad.'</center></td>';
                              echo'<td ><center>'.$nombre_tipo_especialidad.'</center></td>';
                              echo "
                     <form name='' action='../controlador/ctr_estudiante.php' method='post' >
                              <td><center> 
                             <input type='button' class='btn btn-primary btn-large' name='btnRechazar' id='".$registro['id_persona']."' value='Rechazar'>
    
                               </td>
                               </form>
				</tr> ";;
							
				}


	}

	public function CargarCatalogoEstudianteReprobados($ID_INSTITUCION)
	{

		$strsql="SELECT persona.cedula, persona.nombre, persona.id_persona, usuario.id_usuario, usuario.usuario, usuario.contrasena, persona.apellido, estudiante.expediente, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
 especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
 especialidad_instituto_principal.observacion FROM pasantias.persona 
 JOIN pasantias.estudiante ON estudiante.id_persona=persona.id_persona 
 JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona = persona.id_persona and
  persona_instituto_especialidad.estado='REPROBADO' and persona_instituto_especialidad.id_perfil='3' 
 JOIN pasantias.especialidad ON persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad
 JOIN pasantias.instituto_principal ON instituto_principal.id_ip= persona_instituto_especialidad.id_ip
 JOIN pasantias.tipo_especialidad ON especialidad.id_tipo_especialidad = tipo_especialidad.id_tipo_especialidad
 JOIN pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_ip = instituto_principal.id_ip and instituto_principal.id_ip='$ID_INSTITUCION'
AND especialidad_instituto_principal.id_especialidad = persona_instituto_especialidad.id_especialidad AND  especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip   
JOIN pasantias.usuario ON persona.id_persona=usuario.id_persona";
$result=pg_query($strsql);//ejecuta la tira sql


					echo"<thead>
                     <tr >
                          <tr class='well' >
                                <td colspan='4'><strong ><center>Personas</center></strong></td>
                                <td colspan='3'><strong ><center>Especialidad</center></strong></td>
                                </tr>
                                <tr>
                                    <td><strong><center>Expediente</center></strong></td>
                                    <td><strong><center>Cédula</center></strong></td>
                                    <td><strong><center>Nombre</center></strong></td>
                                    <td><strong><center>Apellido</center></strong></td>
                                    
                                    <td><strong><center>Nómbre</center></strong></td>
                                    <td><strong><center>Tipo</center></strong></td>
                                    <td><strong><center>Operación</center></strong></td>
                                  
                                </tr>
                       
                    </tr>
               		</thead>";
               	
		               while ($registro=pg_fetch_array($result)) {

                            	$expediente=$registro['expediente'];
                              $cedula=$registro['cedula'];
                              $nombre=$registro['nombre'];
                              $apellido=$registro['apellido'];
                             
                              $nombre_especialidad=$registro['nombre_especialidad'];
                              $nombre_tipo_especialidad=$registro['nombre_tipo_especialidad'];
                             
                              
                              

                             // $nombre_tipo_especialidad=$Tipo->ConsultarNombre_xId($id_tipo_especialidad);
                             
                         echo'<tr >';
                        	echo'<td ><center>'.$expediente.'</center></td>';
                              echo'<td class=cedula><center>'.$cedula.'</center></td>';
                              echo'<td ><center>'.$nombre.'</center></td>';
                              echo'<td ><center>'.$apellido.'</center></td>';
                             
                              echo'<td ><center>'.$nombre_especialidad.'</center></td>';
                              echo'<td ><center>'.$nombre_tipo_especialidad.'</center></td>';
                              echo "
					                     <form name='' action='../controlador/ctr_estudiante.php' method='post' >
                              <td><center> 
                               <input type='hidden' name='id_persona' id='persona' autocomplete='off' value='".$registro['id_persona']."'>
                               <input type='submit' class='btn btn-primary btn-large' name='btnCancelar' value='Cancelar'>
                               </td>
                               </form>
				</tr> ";
							
				}


	}


public function actulizar_estatus_aprobado($id_persona, $id_persona_encargada)
	{
    
 $strsql="UPDATE pasantias.persona_instituto_especialidad SET fecha_aceptacion=now(), estado='APROBADO', id_responsable_asignacion='$id_persona_encargada' where id_persona='$id_persona' and id_perfil='3' ";
$result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$num=0;
$num = pg_affected_rows($result);
pg_free_result($result);
return $num;
	}

public function actulizar_estatus_rechazado($id_personam, $observacion, $id_persona_encargada)
	{

 $strsql="UPDATE pasantias.persona_instituto_especialidad SET fecha_aceptacion=now(), observacion='$observacion' ,estado='REPROBADO', id_responsable_asignacion='$id_persona_encargada'  where id_persona='$id_personam' and id_perfil='3' ";
 $result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$num=0;
$num = pg_affected_rows($result);
pg_free_result($result);
return $num;
		
	}

public function actulizar_estatus_cancelar($id_personam, $id_persona_encargada)
{
 $strsql="UPDATE pasantias.persona_instituto_especialidad SET fecha_aceptacion=now(), estado='PENDIENTE' , id_responsable_asignacion='$id_persona_encargada' where id_persona='$id_personam' and id_perfil='3' ";
$result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$num=0;
$num = pg_affected_rows($result);
pg_free_result($result);
return $num;
		
}



//--------- Registrar_Datos_Basico_EstudianteBD--->>>>

        function Registrar_Datos_Basico_EstudianteBD($Vista=array())
        {

          $retorno=0;



          
          $ID_INSTITUTO         =$Vista['id_instituto'];
          $ID_PERSONA           =$Vista['id_persona'];
          $EXPEDIENTE           =$Vista['expediente_e'];
          $CEDULA               =$Vista['cedula_e'];
          $NOMBRE               =$Vista['nombre_e'];
          $APELLIDO             =$Vista['apellido_e'];
        
          $OBSERVACION          =$Vista['observacion'];
          $ID_ESPECIALIDAD      =$Vista['id_especialidad'];

          //-----CONSULTO HABER SI EXISTE LA CEDULA--->>>
          $Sql=pg_query("SELECT id_persona FROM pasantias.persona WHERE  cedula='$CEDULA' ;");
          $num=pg_num_rows($Sql);
          if($num>0){

            $Sql2=pg_query("SELECT expediente FROM pasantias.estudiante WHERE id_persona='$ID_PERSONA' or expediente='$EXPEDIENTE' ");
            $num2=pg_num_rows($Sql2);
          if($num2>0){


            $inserto2=pg_query("UPDATE pasantias.estudiante SET id_especialidad='$ID_ESPECIALIDAD', expediente='$EXPEDIENTE' where id_persona='$ID_PERSONA' ");

          $Sqlll=pg_query("SELECT id_persona, id_perfil FROM pasantias.persona_instituto_especialidad WHERE id_persona='$ID_PERSONA' and id_perfil='3' ;");
          $num3=pg_num_rows($Sqlll);
          if($num3>0){
             
             $inserto3=pg_query("UPDATE pasantias.persona_instituto_especialidad SET id_especialidad='$ID_ESPECIALIDAD', observacion='$OBSERVACION', id_perfil=3 where id_persona='$ID_PERSONA' ");
             $registro =0;
             $registro = pg_affected_rows($inserto3);
                       
                            pg_free_result($inserto3);
         
               return $registro;
                }else{

                    $inserto3=pg_query("INSERT INTO  pasantias.persona_instituto_especialidad (id_persona, id_especialidad, id_ip, estado, observacion,  id_perfil)VALUES
                                                                                   ('$ID_PERSONA', $ID_ESPECIALIDAD, $ID_INSTITUTO, 'PENDIENTE', '$OBSERVACION', 3 )");
             $registro =0;
             $registro = pg_affected_rows($inserto3);
                       
                            pg_free_result($inserto3);
         
               return $registro;

                }


          }else{

              $inserto=pg_query("UPDATE pasantias.persona SET cedula='$CEDULA', nombre='$NOMBRE', apellido='$APELLIDO' where id_persona='$ID_PERSONA' ");
             
              $inserto2=pg_query("INSERT INTO  pasantias.persona_instituto_especialidad (id_persona, id_especialidad, id_ip, estado, observacion,  id_perfil)VALUES
                                                                                   ('$ID_PERSONA', $ID_ESPECIALIDAD, $ID_INSTITUTO, 'PENDIENTE', '$OBSERVACION', 3 )");
              
               $inserto3=pg_query("INSERT INTO pasantias.estudiante (id_persona, id_especialidad, id_ip, id_perfil, expediente)VALUES
              ('$ID_PERSONA', '$ID_ESPECIALIDAD', '$ID_INSTITUTO', 3, '$EXPEDIENTE')");

             $registro =0;
             $registro = pg_affected_rows($inserto3);
                       
                            pg_free_result($inserto3);
         
               return $registro;

          }

            return $retorno;

          }else{
            //--------INSERTO EN LA TABLA PERSONA---->>>>

            $inserto=pg_query("INSERT INTO pasantias.persona (cedula, nombre, apellido)VALUES('$CEDULA', '$NOMBRE', '$APELLIDO')");

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $SELECC=pg_query("SELECT MAX(id_persona) FROM pasantias.persona");
            $regist=pg_fetch_array($SELECC);
            $id_persona=$regist[0];

                       ////////////////////////////////////////////////////////////////////////////////////////////////////

            $inserto2=pg_query("INSERT INTO  pasantias.persona_instituto_especialidad (id_persona, id_especialidad, id_ip, estado, observacion,  id_perfil)VALUES
                                                                                   ('$id_persona', $ID_ESPECIALIDAD, $ID_INSTITUTO, 'PENDIENTE', '$OBSERVACION', 3 )");
             
                 //////////////////                                             /////////////////////////////////////////// 

            $inserto3=pg_query("INSERT INTO pasantias.estudiante (id_persona, id_especialidad, id_ip, id_perfil, expediente)VALUES
              ('$id_persona', '$ID_ESPECIALIDAD', '$ID_INSTITUTO', 3, '$EXPEDIENTE')");


             $registro =0;
             $registro = pg_affected_rows($inserto3);
                       
                            pg_free_result($inserto3);
         
               return $registro;             
          }
          


        
        }

//--------- Modificar_Datos_Basico_EstudianteBD--->>>>

        function Modificar_Datos_Basico_EstudianteBD($Vista=array())
        {

          $retorno=0;



          
          $ID_INSTITUTO         =$Vista['id_instituto'];
          $ID_PERSONA           =$Vista['id_persona'];
          $EXPEDIENTE           =$Vista['expediente_e'];
          $CEDULA               =$Vista['cedula_e'];
          $NOMBRE               =$Vista['nombre_e'];
          $APELLIDO             =$Vista['apellido_e'];
         //$FECHA                =$Vista['fecha'];
          $OBSERVACION          =$Vista['observacion'];
          $ID_ESPECIALIDAD      =$Vista['id_especialidad'];

          //-----CONSULTO HABER SI EXISTE LA CEDULA--->>>
          $Sql=pg_query("SELECT * FROM pasantias.persona WHERE id_persona='$ID_PERSONA' ;");
          $num=pg_num_rows($Sql);

          if($num>0){

             $inserto=pg_query("UPDATE pasantias.persona SET cedula='$CEDULA', nombre='$NOMBRE', apellido='$APELLIDO' where id_persona='$ID_PERSONA' ");
             
            $inserto2=pg_query("UPDATE pasantias.estudiante SET id_especialidad='$ID_ESPECIALIDAD', expediente='$EXPEDIENTE' where id_persona='$ID_PERSONA' ");

             $inserto3=pg_query("UPDATE pasantias.persona_instituto_especialidad SET id_especialidad='$ID_ESPECIALIDAD', observacion='$OBSERVACION', id_perfil=3 where id_persona='$ID_PERSONA' ");
             $registro =0;
             $registro = pg_affected_rows($inserto3);
                       
                            pg_free_result($inserto3);
         
               return $registro;

          }else{
            return $retorno;
                     
          }
          


        
        }






function buscarOrganizaciones($codigo_estudiante)
{
        $sql = pg_query(" SELECT organizacionmunicipio.observacion,  organizacion.nombre_organizacion , siglas, domicilio , nombre_municipio , nombre_estado
          ,organizacion.id_organizacion ,nombre_tipo_organizacion , organizacionmunicipio.codigo_sucursal--,
            FROM pasantias.organizacion 
      INNER JOIN pasantias.convenio_organizacion ON convenio_organizacion.id_organizacion = organizacion.id_organizacion 
      INNER JOIN pasantias.organizacionmunicipio ON organizacionmunicipio .id_organizacion = organizacion.id_organizacion 
      INNER JOIN pasantias.municipio ON municipio.id_municipio = organizacionmunicipio.id_municipio 
      INNER JOIN pasantias.estado ON estado .id_estado = municipio.id_estado 
      INNER JOIN pasantias.tipo_organizacion ON tipo_organizacion.id_tipo_organizacion = organizacion.id_tipo_organizacion
      INNER JOIN pasantias.instituto_principal ON instituto_principal.id_ip = convenio_organizacion.id_ip
      INNER JOIN pasantias.persona_instituto_especialidad ON persona_instituto_especialidad.id_ip = instituto_principal.id_ip
      INNER JOIN pasantias.estudiante ON estudiante.id_ip = persona_instituto_especialidad.id_ip 
      AND estudiante.id_persona = persona_instituto_especialidad.id_persona
      AND estudiante.id_especialidad = persona_instituto_especialidad.id_especialidad
      AND estudiante.id_perfil = persona_instituto_especialidad.id_perfil AND estudiante.codigo_estudiante='$codigo_estudiante' ORDER BY nombre_tipo_organizacion;");

return $sql;
}

function buscarcodigo()
{
   $sql= pg_query("SELECT CAST(MAX(codigo_solicitud) as int) + 1 as codigo , 1 as auxiliar FROM pasantias.solicitud ;");
   $var = pg_fetch_array($sql);
   if($var[0]==''){
    $var[0]=$var[1];
  }
   return $var[0];
}

function registrarPostulacion($array=array())
{
  $codigo     = $this->buscarcodigo();
  $estudiante = $array['estudiante'];
  $sucursal   = $array['sucursal'];
  $temporada  = $array['temporada'];
  

  $insreSolicitud=pg_query("INSERT INTO pasantias.solicitud (codigo_solicitud ,codigo_temporada_especialidad,fecha_solicitud,cantidad_postulantes,estatus)
   VALUES ('$codigo','$temporada',now(),'1','ACTIVO');");

  $insertenviadas =pg_query("INSERT INTO pasantias.solicitudes_enviadas (codigo_solicitud,table_column,valor ,estatus)
   VALUES ('$codigo','estudiante.codigo_estudiante','$estudiante','MOSTRAR');");
  
  $insertrecibudas =pg_query("INSERT INTO pasantias.solicitudes_recibidas (codigo_solicitud,table_column,valor ,estatus)
   VALUES ('$codigo','organizacionmunicipio.codigo_sucursal','$sucursal','EN ESPERA') ;");

  return pg_affected_rows($insreSolicitud);

}


function BuscarTemporadaspara($codigo_estudiante)
{

  $sql = pg_query("SELECT persona.nombre ||'  '|| persona.apellido as encargado, 
  tipo_solicitud.nombre_tipo_solicitud, 
  periodo_solicitud.fecha_inicio ||' al '|| periodo_solicitud.fecha_fin as periodo ,
  lapso_academico.numero_lapso , temporadas_especialidad.codigo_temporada_especialidad
    FROM pasantias.temporadas_solicitud 
    INNER JOIN pasantias.temporadas_especialidad ON temporadas_solicitud.codigo_temporada = temporadas_especialidad.codigo_temporada
    INNER JOIN pasantias.temporadas_estudiantes ON temporadas_especialidad.codigo_temporada_especialidad=temporadas_estudiantes.codigo_temporada_especialidad
    INNER JOIN pasantias.estudiante ON estudiante.codigo_estudiante = temporadas_estudiantes.codigo_estudiante 
    AND estudiante.codigo_estudiante='$codigo_estudiante'
    INNER JOIN pasantias.tipo_solicitud ON tipo_solicitud.id_tipo_solicitud = temporadas_solicitud.id_tipo_solicitud 
    INNER JOIN pasantias.periodo_solicitud On periodo_solicitud.id_periodo = temporadas_solicitud.id_periodo
    INNER JOIN pasantias.lapso_academico ON lapso_academico.id_lapso = periodo_solicitud.id_lapso
    INNER JOIN pasantias.encargado ON encargado.codigo_encargado = temporadas_solicitud.codigo_encargado
    INNER JOIN pasantias.persona_organizacion_oficina ON encargado.id_persona = persona_organizacion_oficina.id_persona
    AND  encargado.id_oficina = persona_organizacion_oficina.id_oficina
    AND  encargado.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal
    AND  encargado.id_perfil = persona_organizacion_oficina.id_perfil
    INNER JOIN pasantias.persona ON persona.id_persona = persona_organizacion_oficina.id_persona;");
  return $sql;
}






////----------------- NUEVO ESTUDIANTES ------------- /////////////


//--------- Registrar_Usuario_EstudianteBD--->>>>

        function Registrar_Usuario_EstudianteBD($Vista=array())
        {
          $num=1;
          $id_instituto         =$Vista['id_instituto'];
          $id_persona           =$Vista['id_persona'];
          $fecha_solicitud      =$Vista['fecha_solicitud'];
          $telefono             =$Vista['telefono'];
          $correo               =$Vista['correo'];
          $usuario              =$Vista['usuario'];
          $contrasena           =$Vista['contrasena_b'];
          $pregunta             =$Vista['pregunta'];
          $respuesta            =$Vista['respuesta'];

            
                    
                    $this->actulizar_telefono_correo_persona($telefono, $correo, $id_persona);
                    $resulta=$this->registrar_fecha_solicitud($id_persona, $fecha_solicitud);
                    $result=$this->verificar_registro($id_persona);
                    if($result==0){
                    $this->registrar_usuario($id_persona, $usuario, $contrasena, $pregunta, $respuesta);
                    }

           
                   
                 return $num;
            
        
                     
          }
          
//--------- Modificar_Usuario_EstudianteBD--->>>>

        function Modificar_Usuario_EstudianteBD($Vista=array())
        {
          
          $id_persona           =$Vista['id_persona'];
          $id_usuario           =$Vista['id_usuario'];
       // $fecha_solicitud      =$Vista['fecha_solicitud'];
          $telefono             =$Vista['telefono'];
          $correo               =$Vista['correo'];
          $usuario              =$Vista['usuario'];
          $contrasena           =$Vista['contrasena_b'];
          $pregunta             =$Vista['pregunta'];
          $respuesta            =$Vista['respuesta'];


            $this->actulizar_telefono_correo_persona($telefono, $correo, $id_persona);
            $result=$this->actualizar_usuario($id_persona, $usuario, $contrasena, $pregunta, $respuesta, $id_usuario);
                 if($result==0){
                    $nu=0;
                    return nu;
                    }else{
                    $num=1;
                      return $num;
                    }
            
                   
                    
            

        
                     
          }


function verificar_registro($id_persona)
{
$insert ="SELECT * FROM pasantias.usuario where id_persona='$id_persona' ;"; 
    $resultado =pg_query( $insert);
return pg_num_rows($resultado);
}
        
function registrar_fecha_solicitud($id_persona, $fecha_solicitud)
{
  
 $inserto3=pg_query("UPDATE pasantias.persona_instituto_especialidad SET fecha_solicitud='$fecha_solicitud' where id_persona='$id_persona' and id_perfil='3' ");
}       

function registrar_usuario($id_persona, $usuario, $contrasena, $pregunta, $respuesta)
{

$strsql="INSERT INTO pasantias.usuario (usuario, contrasena, estatus, pregunta, respuesta, id_persona) VALUES 
    ('$usuario', '$contrasena','PENDIENTE','$pregunta','$respuesta', '$id_persona');";
    $result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
      $num =0;
      $num = pg_affected_rows($result);
     
          pg_free_result($result);

return $num;

}

function actulizar_telefono_correo_persona($telefono, $correo, $id_persona){
   $inserto5=pg_query("UPDATE pasantias.persona SET telefono='$telefono', correo='$correo' where id_persona='$id_persona' ");
}


function actualizar_usuario($id_persona, $usuario, $contrasena, $pregunta, $respuesta, $id_usuario)
{


$strsql="UPDATE pasantias.usuario SET usuario='$usuario', contrasena='$contrasena', pregunta='$pregunta', respuesta='$respuesta' WHERE id_persona='$id_persona' AND id_usuario='$id_usuario'";
    
    $result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

      
      $num =0;
      $num = pg_affected_rows($result);
     
          pg_free_result($result);

return $num;
}







}


?>