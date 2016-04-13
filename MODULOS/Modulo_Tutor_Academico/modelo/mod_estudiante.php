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


function ConsultarTutoresAcademicosBD($id_instituto){


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
iNNER JOIN pasantias.perfil ON perfil.id_perfil = persona_instituto_especialidad.id_perfil AND perfil.id_perfil=4 ;  ";
     
   $result=pg_query($sql);//ejecuta la tira sql

  

   return $result;
  
}






function consultar_estudiante($id_instituto, $cedula, $expediente)
{
	
	 if($this->expediente==NULL){
     $strsql="SELECT persona.*, tutor_academico.*, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
 especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
 especialidad_instituto_principal.observacion FROM pasantias.persona 
 JOIN pasantias.tutor_academico ON tutor_academico.id_persona=persona.id_persona and persona.cedula='$cedula'
 JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona = persona.id_persona and
  persona_instituto_especialidad.estado='PENDIENTE' and persona_instituto_especialidad.id_perfil='4'
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
     $strsql="SELECT persona.*, tutor_academico.*, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
 especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
 especialidad_instituto_principal.observacion FROM pasantias.persona 
 JOIN pasantias.tutor_academico ON tutor_academico.id_persona=persona.id_persona and tutor_academico.codigo='$expediente'
 JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona = persona.id_persona and
  persona_instituto_especialidad.estado='PENDIENTE' and persona_instituto_especialidad.id_perfil='4'
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

/*

function incluir()
{

	$strsql="INSERT INTO persona ( cedula_persona, nombre_persona, apellido_persona, telefono_persona, correo_persona) VALUES 
	  ('".$this->cedula."', '".$this->nombre."', '".$this->apellido."', '".$this->telefono."', '".$this->correo."');";	 
		$result=pg_query($strsql);//ejecuta la tira sql	

		$strsqlb="SELECT MAX(id_persona) FROM persona";
        $resultb=pg_query($strsqlb);//ejecuta la tira sql
        if ($row = pg_fetch_row($resultb)) 
	    {$valor = trim($row[0]);}
        $this->id_persona=$valor;

        $strsql="INSERT INTO estudiante (expediente, id_persona) VALUES ('".$this->expediente."', '".$this->id_persona."');";	 
        $result=pg_query($strsql);//ejecuta la tira sql 



        select id_persona, cedula, nombre, apellido from pasantias.persona 

select expediente from pasantias.estudiante where id_persona='16'

SELECT persona_instituto_especialidad.id_persona, persona_instituto_especialidad.id_perfil,persona_instituto_especialidad.id_ip, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
 especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
 especialidad_instituto_principal.observacion FROM pasantias.persona 
 JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona =  persona.id_persona AND persona_instituto_especialidad.id_persona= '16' and 
 persona_instituto_especialidad.id_perfil='3'
 JOIN pasantias.especialidad ON persona_instituto_especialidad.id_especialidad = especialidad.id_especialidad
 JOIN pasantias.instituto_principal ON instituto_principal.id_ip= persona_instituto_especialidad.id_ip
 JOIN pasantias.tipo_especialidad ON especialidad.id_tipo_especialidad = tipo_especialidad.id_tipo_especialidad
 JOIN pasantias.especialidad_instituto_principal ON especialidad_instituto_principal.id_ip = instituto_principal.id_ip and
  instituto_principal.id_ip='1'
AND especialidad_instituto_principal.id_especialidad = persona_instituto_especialidad.id_especialidad AND
  especialidad_instituto_principal.id_ip = persona_instituto_especialidad.id_ip


}*/

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


public function CargarInstituto()
  {

$strsql="SELECT organizacion.*, instituto_principal.* FROM 
pasantias.organizacion, pasantias.instituto_principal WHERE
pasantias.instituto_principal.id_organizacion=pasantias.organizacion.id_organizacion AND 
pasantias.instituto_principal.estatus='ACTIVO'";
$result=pg_query($strsql);//ejecuta la tira sql

  
          echo"<thead>
                     <tr >
                        <td><strong><center>"."N°"."</center></strong></td>
                        <td><strong ><center>"."NOMBRE"."</center></strong></td>
                        <td><strong><center>"."SIGLÁS"."</center></strong></td>
                        <td><strong><center>"."TELÉFONO"."</center></strong></td>
                        <!--  <td><strong><center>"."ESTATUS"."</center></strong></td>
                        <td><strong><center>"."OPCIÓN"."</center></strong></td> -->
                    </tr>
                  </thead>";
                
                    while($fila=pg_fetch_array($result))
                { 

                echo'<tr class="instituto" onclick="seleccionarfila2(this)";  id="fila_'; echo $variable; echo'" onMouseOver="ResaltarFila'; echo"('fila_"; echo $variable; echo "');"; echo'"  onMouseOut="RestablecerFila'; echo"('fila_"; echo $variable; echo"')"; echo'";>';
                             
        echo " 

            <td class=id_instituto><center >".$fila['id_ip']."</center></td>
            <td class=nombre ><center >".$fila['nombre_organizacion']."</center></td>
            <td class=sigla><center >".$fila['siglas']."</center></td>
            <td ><center >".$fila['telefono']."</center></td>";
          
        echo "</tr> ";
              
        }


  }



public function cargarcatalogoestudiantes($ID_INSTITUCION)
	{

$strsql="SELECT persona.cedula, persona.nombre , persona.apellido , tutor_academico.codigo, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
 especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
 especialidad_instituto_principal.observacion FROM pasantias.persona 
 JOIN pasantias.tutor_academico ON tutor_academico.id_persona=persona.id_persona
 JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona = persona.id_persona and 
 persona_instituto_especialidad.id_perfil='4'
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
                                    <td><strong><center>Código</center></strong></td>
                                    <td><strong><center>Cédula</center></strong></td>
                                    <td><strong><center>Nombre</center></strong></td>
                                    <td><strong><center>Apellido</center></strong></td>
                                    
                                    <td><strong><center>Nómbre</center></strong></td>
                                    <td><strong><center>Tipo</center></strong></td>
                                    
                                  
                                </tr>
                        </thead>
                        <tbody >';


                            while ($registro=pg_fetch_array($result)) {

                            	$expediente=$registro['codigo'];
                              $cedula=$registro['cedula'];
                              $nombre=$registro['nombre'];
                              $apellido=$registro['apellido'];
                             
                              $nombre_especialidad=$registro['nombre_especialidad'];
                              $nombre_tipo_especialidad=$registro['nombre_tipo_especialidad'];
                             
                              
                              

                             // $nombre_tipo_especialidad=$Tipo->ConsultarNombre_xId($id_tipo_especialidad);
                               echo'<tr class="estado" onclick="seleccionarfila(this)";  id="fila_'; echo $variable; echo'" onMouseOver="ResaltarFila'; echo"('fila_"; echo $variable; echo "');"; echo'"  onMouseOut="RestablecerFila'; echo"('fila_"; echo $variable; echo"')"; echo'";>';
                             
                       
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

                    $variable=0;
                        echo'<thead>
                                <tr class="well" >
                                <td colspan="5"><strong ><center>Personas</center></strong></td>
                                <td colspan="4"><strong ><center>Especialidad</center></strong></td>
                                </tr>
                                <tr>
                                    <td><strong><center>N°</center></strong></td>
                                    <td><strong><center>Código</center></strong></td>
                                    <td><strong><center>Cédula</center></strong></td>
                                    <td><strong><center>Nombre</center></strong></td>
                                    <td><strong><center>Apellido</center></strong></td>
                                    
                                    <td style="display: none;"><strong><center>id</center></strong></td>
                                    <td><strong><center>Nombre</center></strong></td>
                                    <td><strong><center>Tipo</center></strong></td>
                                    <td><strong><center>Observacion</center></strong></td>
                                    <td><strong><center>Fecha</center></strong></td>
                                  
                                </tr>
                        </thead>
                        <tbody >';


                            while ($registro=pg_fetch_array($result1)) {

                              $id_per=$registro['id_persona'];
                              
                              
                         // $nombre_tipo_especialidad=$Tipo->ConsultarNombre_xId($id_tipo_especialidad);
                                echo'<tr class="estado" onclick="seleccionarfilaPersona(this)";  id="fila_'; echo $variable; echo'" onMouseOver="ResaltarFila'; echo"('fila_"; echo $variable; echo "');"; echo'"  onMouseOut="RestablecerFila'; echo"('fila_"; echo $variable; echo"')"; echo'";>';
                             
                       
                          echo'<td class=id><center>'.$id_per.'</center></td>';

                           $strsql2="SELECT codigo FROM pasantias.tutor_academico where id_persona='$id_per'";
                            $result2=pg_query($strsql2); 
                            
                      $registro2=pg_fetch_array($result2);
                        
                              

                          if(isset($registro2[0])){
                            $expediente=$registro2['codigo'];
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
  persona_instituto_especialidad.id_persona= '$id_per' and 
 persona_instituto_especialidad.id_perfil='4'
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

                              $id_especialidad=$registro3['id_especialidad'];
                              $nombre_especialidad=$registro3['nombre_especialidad'];
                              $nombre_tipo_especialidad=$registro3['nombre_tipo_especialidad'];
                              $observacion=$registro3['observacion'];
                              $fecha=$registro3['fecha_solicitud'];
                              echo'<td style="display: none;" class=id_especialidad><center>'.$id_especialidad.'</center></td>';
                              echo'<td class=especialidad><center>'.$nombre_especialidad.'</center></td>';
                              echo'<td ><center>'.$nombre_tipo_especialidad.'</center></td>';
                               echo'<td class=observacion><center>'.$observacion.'</center></td>';
                              echo'<td class=fecha><center>'.$fecha.'</center></td>';
                           }
                              
                              
                              
                        echo' </tr>';

                           $variable++;

                            }
            echo "</tbody>";

        


  }





public function CargarCatalogoAprobarEstudiante($ID_INSTITUCION)
	{

$strsql="SELECT persona.cedula, persona.nombre, persona.id_persona, usuario.id_usuario, usuario.usuario, usuario.contrasena, persona.apellido, tutor_academico.codigo, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
 especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
 especialidad_instituto_principal.observacion FROM pasantias.persona 
 JOIN pasantias.tutor_academico ON tutor_academico.id_persona=persona.id_persona 
 JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona = persona.id_persona and
  persona_instituto_especialidad.estado='PENDIENTE' and persona_instituto_especialidad.id_perfil='4' and persona_instituto_especialidad.fecha_solicitud is not null
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
                                    <td><strong><center>Código</center></strong></td>
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

                            	$expediente=$registro['codigo'];
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

 $strsql="SELECT persona.cedula, persona.nombre, persona.id_persona, usuario.id_usuario, usuario.usuario, usuario.contrasena, persona.apellido, tutor_academico.codigo, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
 especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
 especialidad_instituto_principal.observacion FROM pasantias.persona 
 JOIN pasantias.tutor_academico ON tutor_academico.id_persona=persona.id_persona 
 JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona = persona.id_persona and
  persona_instituto_especialidad.estado='APROBADO' and persona_instituto_especialidad.id_perfil='4' 
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
                                    <td><strong><center>Código</center></strong></td>
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

                            	$expediente=$registro['codigo'];
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

		$strsql="SELECT persona.cedula, persona.nombre, persona.id_persona, usuario.id_usuario, usuario.usuario, usuario.contrasena, persona.apellido, tutor_academico.codigo, especialidad.id_especialidad, especialidad.nombre_especialidad, tipo_especialidad.nombre_tipo_especialidad ,
 especialidad.id_tipo_especialidad, especialidad_instituto_principal.estatus, especialidad_instituto_principal.descripcion, 
 especialidad_instituto_principal.observacion FROM pasantias.persona 
 JOIN pasantias.tutor_academico ON tutor_academico.id_persona=persona.id_persona 
 JOIN pasantias.persona_instituto_especialidad on persona_instituto_especialidad.id_persona = persona.id_persona and
  persona_instituto_especialidad.estado='REPROBADO' and persona_instituto_especialidad.id_perfil='4' 
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
                                    <td><strong><center>Código</center></strong></td>
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

                            	$expediente=$registro['codigo'];
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
    
 $strsql="UPDATE pasantias.persona_instituto_especialidad SET fecha_aceptacion=now(), estado='APROBADO', id_responsable_asignacion='$id_persona_encargada' where id_persona='$id_persona' and id_perfil='4' ";
$result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$num=0;
$num = pg_affected_rows($result);
pg_free_result($result);
return $num;
	}

public function actulizar_estatus_rechazado($id_personam, $observacion, $id_persona_encargada)
	{

 $strsql="UPDATE pasantias.persona_instituto_especialidad SET fecha_aceptacion=now(), observacion='$observacion' ,estado='REPROBADO', id_responsable_asignacion='$id_persona_encargada' where id_persona='$id_personam' and id_perfil='4' ";
 $result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$num=0;
$num = pg_affected_rows($result);
pg_free_result($result);
return $num;
		
	}

public function actulizar_estatus_cancelar($id_personam, $id_persona_encargada)
{
 $strsql="UPDATE pasantias.persona_instituto_especialidad SET fecha_aceptacion=now(), estado='PENDIENTE', id_responsable_asignacion='$id_persona_encargada' where id_persona='$id_personam' and id_perfil='4' ";
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

            $Sql2=pg_query("SELECT codigo FROM pasantias.tutor_academico WHERE id_persona='$ID_PERSONA' or codigo='$EXPEDIENTE' ");
            $num2=pg_num_rows($Sql2);
          if($num2>0){


            $inserto2=pg_query("UPDATE pasantias.tutor_academico SET id_especialidad='$ID_ESPECIALIDAD', codigo='$EXPEDIENTE' where id_persona='$ID_PERSONA' ");
             
             $inserto3=pg_query("UPDATE pasantias.persona_instituto_especialidad SET id_especialidad='$ID_ESPECIALIDAD', observacion='$OBSERVACION', id_perfil=4 where id_persona='$ID_PERSONA' ");
             $registro =0;
             $registro = pg_affected_rows($inserto3);
                       
                            pg_free_result($inserto3);
         
               return $registro;



          }else{

              $inserto=pg_query("UPDATE pasantias.persona SET cedula='$CEDULA', nombre='$NOMBRE', apellido='$APELLIDO' where id_persona='$ID_PERSONA' ");
             
            
              $inserto2=pg_query("INSERT INTO  pasantias.persona_instituto_especialidad (id_persona, id_especialidad, id_ip, estado, observacion,  id_perfil)VALUES
                                                                                   ('$ID_PERSONA', $ID_ESPECIALIDAD, $ID_INSTITUTO, 'PENDIENTE', '$OBSERVACION', 4 )");
             
              $inserto3=pg_query("INSERT INTO pasantias.tutor_academico (id_persona, id_especialidad, id_ip, id_perfil, codigo)VALUES
              ('$ID_PERSONA', '$ID_ESPECIALIDAD', '$ID_INSTITUTO', 4, '$EXPEDIENTE')");

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

              //////////////////                                             /////////////////////////////////////////// 

         
            $inserto3=pg_query("INSERT INTO  pasantias.persona_instituto_especialidad (id_persona, id_especialidad, id_ip, estado, observacion,  id_perfil)VALUES
                                                                                   ('$id_persona', $ID_ESPECIALIDAD, $ID_INSTITUTO, 'PENDIENTE', '$OBSERVACION', 4 )");
             
                $inserto2=pg_query("INSERT INTO pasantias.tutor_academico (id_persona, id_especialidad, id_ip, id_perfil, codigo)VALUES
              ('$id_persona', '$ID_ESPECIALIDAD', '$ID_INSTITUTO', 4, '$EXPEDIENTE')");


            ////////////////////////////////////////////////////////////////////////////////////////////////////


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
         
          $OBSERVACION          =$Vista['observacion'];
          $ID_ESPECIALIDAD      =$Vista['id_especialidad'];

          //-----CONSULTO HABER SI EXISTE LA CEDULA--->>>
          $Sql=pg_query("SELECT * FROM pasantias.persona WHERE id_persona='$ID_PERSONA' ;");
          $num=pg_num_rows($Sql);

          if($num>0){

             $inserto=pg_query("UPDATE pasantias.persona SET cedula='$CEDULA', nombre='$NOMBRE', apellido='$APELLIDO' where id_persona='$ID_PERSONA' ");
             
             $inserto2=pg_query("UPDATE pasantias.tutor_academico SET id_especialidad='$ID_ESPECIALIDAD', codigo='$EXPEDIENTE' where id_persona='$ID_PERSONA' ");
             
             $inserto3=pg_query("UPDATE pasantias.persona_instituto_especialidad SET id_especialidad='$ID_ESPECIALIDAD', observacion='$OBSERVACION', id_perfil=4 where id_persona='$ID_PERSONA' ");
             $registro =0;
             $registro = pg_affected_rows($inserto3);
                       
                            pg_free_result($inserto3);
         
               return $registro;

          }else{
            return $retorno;
                     
          }
          


        
        }











}

?>