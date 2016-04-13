<?php


class tutor_empresarial{

public $cedula;
public $nombre;
public $apellido;
public $codigo;
public $especialidad;
public $telefono;
public $correo;
public $id_persona;
public $id_usuario;



 function ConsultarTutoresEmpresarialesBD($ID_ORGANIZACION_P){

            $sql=pg_query("	SELECT tutor_empresarial.codigo_tutor_empresarial, tutor_empresarial.id_persona, persona.cedula, persona.nombre, persona.apellido, tutor_empresarial.id_oficina, oficina.nombre_oficina
	FROM pasantias.tutor_empresarial 

		join pasantias.persona_organizacion_oficina
		on pasantias.tutor_empresarial.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal
		and pasantias.tutor_empresarial.id_persona = persona_organizacion_oficina.id_persona
		and pasantias.tutor_empresarial.id_oficina = persona_organizacion_oficina.id_oficina
		and pasantias.tutor_empresarial.id_perfil = persona_organizacion_oficina.id_perfil

		join pasantias.organizacionmunicipio
		on pasantias.persona_organizacion_oficina.codigo_sucursal = organizacionmunicipio.codigo_sucursal
		AND organizacionmunicipio.codigo_sucursal='$ID_ORGANIZACION_P'
		
		join pasantias.organizacion
		on pasantias.organizacionmunicipio.id_organizacion=organizacion.id_organizacion
	
		
		join pasantias.persona
		on pasantias.persona_organizacion_oficina.id_persona = persona.id_persona

		join pasantias.oficina
		on pasantias.persona_organizacion_oficina.id_oficina=oficina.id_oficina
		");

            return $sql;

          }




function consultar_tutor_empresarial()
{
	 if($this->codigo==NULL){
     $strsql="SELECT pasantias.persona.*, pasantias.tutor_empresarial.* FROM pasantias.persona, pasantias.tutor_empresarial WHERE pasantias.persona.cedula='".$this->cedula."' AND pasantias.persona.id_persona=pasantias.tutor_empresarial.id_persona";
	 $result=pg_query($strsql);//ejecuta la tira sql
	 return $result;

	 }else{
     $strsql="SELECT pasantias.persona.*, pasantias.tutor_empresarial.* FROM pasantias.persona, pasantias.tutor_empresarial WHERE pasantias.tutor_empresarial.codigo='".$this->codigo."' AND pasantias.persona.id_persona=pasantias.tutor_empresarial.id_persona";
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


}*/

function actualizar_datos_basicos(){


	$strsql="UPDATE pasantias.persona SET telefono='$this->telefono', correo='$this->correo' where id_persona='$this->id_persona'";
		
		$result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		  
		  $numm =0;
		  $numm = pg_affected_rows($result);
		 
          pg_free_result($result);

return $numm;
}



public function cargarcatalogo($id_organizacion)
	{

if ($id_organizacion==null) {
	
}else {
$strsql="SELECT pasantias.persona.*, pasantias.persona_organizacion_oficina.* FROM
 pasantias.persona, pasantias.persona_organizacion_oficina WHERE
 pasantias.persona.id_persona=pasantias.persona_organizacion_oficina.id_persona 
 AND pasantias.persona_organizacion_oficina.id_organizacion='$id_organizacion'";
$result=pg_query($strsql);//ejecuta la tira sql

	
					echo"<thead>
                     <tr >
                        <td><strong ><center>"."CÓDIGO"."</center></strong></td>
                        <td><strong><center>"."CÉDULA"."</center></strong></td>
                        <td><strong><center>"."NOMBRE"."</center></strong></td>
                        <td><strong><center>"."APELLIDO"."</center></strong></td>
                        <td><strong><center>"."ESTATUS"."</center></strong></td>
                       
                    </tr>
               		</thead>";
               	
		                while($fila=pg_fetch_array($result))
                {	

							
				echo " <tr  class=estado onclick=seleccionarfila(this);' >";
						if($fila['codigo']==null){
						echo "<td class=id_estado ><center >-----</center></td>";
						}else{
						echo "<td class=id_estado ><center >".$fila['codigo']."</center></td>";
						}
					
				  echo "<td class=nombre_estado><center >".$fila['cedula']."</center></td>
						<td class=codigo><center >".$fila['nombre']."</center></td>
						<td class=codigo><center >".$fila['apellido']."</center></td>
						<td class=codigo><center >".$fila['estatus']."</center></td>
					
				</tr> ";
							
				}
}

	}



public function CargarEmpresa()
	{

$strsql="SELECT pasantias.empresa.*, pasantias.organizacion.* FROM pasantias.empresa, pasantias.organizacion where pasantias.empresa.id_organizacion=pasantias.organizacion.id_organizacion";
$result=pg_query($strsql);//ejecuta la tira sql


					echo"<thead>
                     <tr >
                        <td><strong ><center>"."ID"."</center></strong></td>
                        <td><strong><center>"."NOMBRE"."</center></strong></td>
                        <td><strong><center>"."OPERACIÓN"."</center></strong></td>
                                           
                    </tr>
               		</thead>";
               	
		                while($fila=pg_fetch_array($result))
                {	

							
				echo " <tr  class=estado onclick=seleccionarfila(this); >
						<td class=id_estado ><center >".$fila['id_empresa']."</center></td>
						<td class=codigo><center >".$fila['nombre_empresa']."</center></td>
						
				 <form name='' action='../controlador/ctr_tutor_empresarial.php' method='post' >
                              <td><center> 
                               <input type='hidden' name='id_empresa' id='id_empresa' autocomplete='off' value='".$fila['id_empresa']."'>
                               <input type='hidden' name='nombre_empresa' id='nombre_empresa' autocomplete='off' value='".$fila['nombre_empresa']."'>
							   <input type='submit' class='btn btn-primary btn-large' name='btnSeleccionarEmpresa' value='Seleccionar'>
                               </td>
                               </form>
				</tr> ";;
							
				}


	}

public function CargarInstituto()
	{

$strsql="SELECT pasantias.instituto.*, pasantias.organizacion.* FROM pasantias.instituto, pasantias.organizacion where pasantias.instituto.id_organizacion=pasantias.organizacion.id_organizacion";
$result=pg_query($strsql);//ejecuta la tira sql


					echo"<thead>
                     <tr >
                        <td><strong ><center>"."ID"."</center></strong></td>
                        <td><strong><center>"."NOMBRE"."</center></strong></td>
                         <td><strong><center>"."OPERACIÓN"."</center></strong></td>
                                           
                    </tr>
               		</thead>";
               	
		                while($fila=pg_fetch_array($result))
                {	

							
				echo " <tr  class=estado onclick=seleccionarfila(this); >
						<td class=id_estado ><center >".$fila['id_instituto']."</center></td>
						<td class=codigo><center >".$fila['nombre_instituto']."</center></td>
						
				 <form name='' action='../controlador/ctr_tutor_empresarial.php' method='post' >
                              <td><center> 
                               <input type='hidden' name='id_instituto' id='id_instituto' autocomplete='off' value='".$fila['id_instituto']."'>
                               <input type='hidden' name='nombre_instituto' id='nombre_instituto' autocomplete='off' value='".$fila['nombre_instituto']."'>
							   <input type='submit' class='btn btn-primary btn-large' name='btnSeleccionarInstitucion' value='Seleccionar'>
                               </td>
                               </form>
				</tr> ";;
							
				}


	}



public function consultar_seleccionar_empresa($id_empresa){

$strsql="SELECT pasantias.empresa.*, pasantias.organizacion.* FROM 
pasantias.empresa, pasantias.organizacion where pasantias.empresa.id_empresa='$id_empresa' AND
pasantias.empresa.id_organizacion=pasantias.organizacion.id_organizacion";
$result=pg_query($strsql);//ejecuta la tira sql
return $result;
}

public function consultar_seleccionar_instituto($id_instituto){

$strsql="SELECT pasantias.instituto.*, pasantias.organizacion.* FROM 
pasantias.instituto, pasantias.organizacion where pasantias.instituto.id_instituto='$id_instituto' AND
pasantias.instituto.id_organizacion=pasantias.organizacion.id_organizacion";
$result=pg_query($strsql);//ejecuta la tira sql
return $result;
}


	public function llenarselectoficinas($id_organizacion)
	{
		

		$insert ="SELECT pasantias.organizacion_oficina.*, pasantias.oficina.* FROM
		 pasantias.organizacion_oficina, pasantias.oficina where 
		 pasantias.organizacion_oficina.id_organizacion=$id_organizacion AND 
		 pasantias.organizacion_oficina.id_oficina=pasantias.oficina.id_oficina ;"; 
		$resultado =pg_query( $insert);

		while($fila = pg_fetch_array($resultado)){
	
		echo "<option value='".$fila['id_oficina']."'>".$fila['nombre_oficina']."</option>";
		
		
			}

}








}

?>