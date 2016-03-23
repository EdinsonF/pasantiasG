<?php

class usuarios{

public $usuario;
public $contrasena;
public $tipo_usuario;
public $estatus;
public $id_persona;
public $id_usuario;
public $id_perfil;



function consultar_id_Institucion($id_organizacion)
{	


$strsql="SELECT instituto_principal.id_ip , siglas FROM pasantias.instituto_principal 

JOIN  pasantias.organizacion ON organizacion .id_organizacion =instituto_principal.id_organizacion
  
        AND instituto_principal.id_organizacion=$id_organizacion;";
	 
     $num=0;	 
	 $result=pg_query($strsql);//ejecuta la tira sql

	 

	 return pg_fetch_array($result); 
}

function consultar_id_Empresa($codigo_sucursal)
{
	
$strsql="SELECT organizacion.id_organizacion , organizacion.nombre_organizacion FROM pasantias.organizacion 
INNER JOIN pasantias.convenio_organizacion ON convenio_organizacion.id_organizacion = organizacion.id_organizacion 
INNER JOIN pasantias.organizacionmunicipio ON  organizacionmunicipio.id_organizacion = organizacion.id_organizacion
 AND organizacionmunicipio.codigo_sucursal='$codigo_sucursal';";
	 
     $num=0;	 
	 $result=pg_query($strsql);//ejecuta la tira sql

	 

	 return pg_fetch_array($result); 

}

function segun_perfil_donde_consulto ($id_perfil)
{

	$sql = pg_query("SELECT nombre_perfil FROM pasantias.perfil WHERE id_perfil = $id_perfil");

    $result =pg_fetch_array($sql);

    return $result[0];
}

function codigo_sucursal($id_persona)
{
	$sql = "SELECT persona_organizacion_oficina.codigo_sucursal FROM pasantias.persona 

					JOIN pasantias.persona_organizacion_oficina ON
					persona_organizacion_oficina .id_persona = persona.id_persona AND persona.id_persona = $id_persona;";

			$num = pg_num_rows( pg_query($sql) );
			if($num==0)
			{
				$sql= "SELECT organizacionmunicipio.codigo_sucursal FROM pasantias.persona 
		
		JOIN pasantias.persona_instituto_especialidad ON
		persona_instituto_especialidad .id_persona = persona.id_persona AND persona.id_persona = $id_persona
		join pasantias.instituto_principal ON instituto_principal.id_ip = persona_instituto_especialidad.id_ip
		JOIN pasantias.organizacion ON organizacion.id_organizacion  = instituto_principal.id_organizacion
		JOIN pasantias.organizacionmunicipio ON organizacionmunicipio.id_organizacion=organizacion.id_organizacion ;";
				
			}	
			$var = pg_fetch_array(pg_query($sql));

			return $var[0];
}


function buscar_nombre_organizacion($codigo_sucursal)
{

	$sql = pg_query("SELECT organizacion.nombre_organizacion FROM pasantias.organizacionmunicipio
	 JOIN pasantias.organizacion ON organizacionmunicipio.id_organizacion = organizacion.id_organizacion AND organizacionmunicipio.codigo_sucursal= '$codigo_sucursal';");
	$var = pg_fetch_assoc($sql);
	return $var['nombre_organizacion'];
}

function codigo_estudiante($id_persona , $codigo_sucursal)
{
	$sql = pg_query("SELECT especialidad.id_especialidad , codigo_estudiante , especialidad.nombre_especialidad ||'-'|| 			           			tipo_especialidad.nombre_tipo_especialidad  AS nombre_especialidad FROM pasantias.estudiante JOIN pasantias.persona_instituto_especialidad 
		ON estudiante.id_persona = persona_instituto_especialidad.id_persona
		AND estudiante.id_ip = persona_instituto_especialidad.id_ip 
		AND estudiante.id_especialidad = persona_instituto_especialidad.id_especialidad
		AND estudiante.id_perfil = persona_instituto_especialidad.id_perfil JOIN pasantias.instituto_principal 
		ON instituto_principal.id_ip = persona_instituto_especialidad.id_ip JOIN pasantias.especialidad 
		ON especialidad.id_especialidad=persona_instituto_especialidad.id_especialidad JOIN pasantias.persona
		ON persona.id_persona = persona_instituto_especialidad.id_persona JOIN pasantias.organizacion
		ON organizacion.id_organizacion = instituto_principal.id_organizacion JOIN pasantias.organizacionmunicipio 
		ON organizacionmunicipio.id_organizacion = organizacion.id_organizacion JOIN pasantias.tipo_especialidad
		ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad 
		AND organizacionmunicipio.codigo_sucursal ='$codigo_sucursal' AND persona.id_persona = $id_persona ;");
	return pg_fetch_array($sql) ;
}


function consultar_id_organizacion($id_persona , $id_perfil)
{
	$perfil = $this->segun_perfil_donde_consulto($id_perfil);

	if( ($perfil=='Menú Empresa') || ($perfil == 'Menú Tutor Empresarial') ){
		$sql = pg_query("SELECT persona_organizacion_oficina.codigo_sucursal FROM pasantias.persona 

				JOIN pasantias.persona_organizacion_oficina ON
				persona_organizacion_oficina .id_persona = persona.id_persona AND persona.id_persona =$id_persona
				JOIN pasantias.organizacionmunicipio ON organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal ;");

	}else if ($perfil=='Menú Administrador') {
			$sql = pg_query("SELECT persona_organizacion_oficina.codigo_sucursal FROM pasantias.persona 

					JOIN pasantias.persona_organizacion_oficina ON
					persona_organizacion_oficina .id_persona = persona.id_persona AND persona.id_persona = $id_persona;");

			$var = pg_fetch_array($sql);

			$id= $var[0];

				$sql = pg_query("SELECT id_organizacion FROM pasantias.organizacionmunicipio WHERE codigo_sucursal='$id' ;");
				$array = pg_fetch_assoc($sql);
				$id =$array['id_organizacion'];
			$sql = pg_query("SELECT organizacion.id_organizacion FROM pasantias.organizacionmunicipio  JOIN pasantias.organizacion ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion JOIN 
			pasantias.instituto_principal ON instituto_principal.id_organizacion = organizacion.id_organizacion WHERE  organizacion.id_organizacion=$id ; ");

	}else if (  ($perfil=='Menú Estudiante') || ($perfil=='Menú Tutor Academico') ){

		$sql = pg_query(" SELECT organizacion.id_organizacion FROM pasantias.persona 
		
		JOIN pasantias.persona_instituto_especialidad ON
		persona_instituto_especialidad .id_persona = persona.id_persona AND persona.id_persona = $id_persona
		join pasantias.instituto_principal ON instituto_principal.id_ip = persona_instituto_especialidad.id_ip
		JOIN pasantias.organizacion ON organizacion.id_organizacion  = instituto_principal.id_organizacion
		JOIN pasantias.organizacionmunicipio ON organizacionmunicipio.id_organizacion=organizacion.id_organizacion ;");
	}

	
	if(isset($sql)){
	$id= pg_fetch_array($sql);
	return $id[0];
	}
	
}

function cuantos_perfiles_persona ( $id_persona  )
{

	$tabla_1 = pg_query(" SELECT  Count(persona_organizacion_oficina.id_persona) as oficinas ,'oficina' FROM pasantias.usuario INNER join pasantias.persona 
				 ON persona.id_persona= usuario.id_persona AND usuario.id_persona = $id_persona 
				 INNER JOIN pasantias.persona_organizacion_oficina 
				 ON persona_organizacion_oficina.id_persona = persona.id_persona ;");

	$tabla_2 = pg_query("SELECT  Count(persona_instituto_especialidad.id_persona) as especialidad ,'especialidad' FROM pasantias.usuario INNER join pasantias.persona 
				 ON persona.id_persona= usuario.id_persona AND usuario.id_persona = $id_persona 
				 INNER JOIN pasantias.persona_instituto_especialidad 
				 ON persona_instituto_especialidad.id_persona = persona.id_persona ;");
	$oficinas =  pg_fetch_array($tabla_1);

	$especialidad =pg_fetch_array($tabla_2);

	return array('numeroO' =>$oficinas[0],'oficina'  =>$oficinas[1] ,
				 'numeroE' =>$especialidad[0],'especialidad'  =>$especialidad[1]  );
}


function consultar_iniciar_sesion()
{
	$result = null;
$strsql="SELECT usuario.id_usuario , usuario.id_persona , perfil.nombre_perfil ,persona_organizacion_oficina. id_perfil, persona.nombre , persona.apellido

 FROM pasantias.usuario join  pasantias.persona ON persona.id_persona = usuario.id_persona   

JOIN pasantias.persona_organizacion_oficina  ON persona.id_persona = persona_organizacion_oficina.id_persona

JOIN pasantias.perfil  ON persona_organizacion_oficina.id_perfil = perfil.id_perfil

AND  usuario ='$this->usuario' AND contrasena='$this->contrasena' AND estado='APROBADO' ;";

     $num=0;	 
	 

$strsqlOtra="SELECT usuario.id_usuario , usuario.id_persona , perfil.nombre_perfil ,persona_instituto_especialidad. id_perfil, persona.nombre , persona.apellido

 FROM pasantias.usuario join  pasantias.persona ON persona.id_persona = usuario.id_persona   

JOIN pasantias.persona_instituto_especialidad  ON persona.id_persona = persona_instituto_especialidad.id_persona

JOIN pasantias.perfil  ON persona_instituto_especialidad.id_perfil = perfil.id_perfil

AND  usuario ='$this->usuario' AND contrasena='$this->contrasena' AND estado='APROBADO' ;";
	 $comprobar =pg_fetch_array(pg_query($strsql));

if(!isset($comprobar[0]))
{
		$result=pg_query($strsqlOtra);//ejecuta la tira sql
}else{  $result=pg_query($strsql);} 	//ejecuta la tira sql }


	 return $result;
	 
}


function nombrePersona( $id_persona )
{

	$sql = pg_query("SELECT (persona.nombre::text || ' '::text) || persona.apellido::text AS persona FROM pasantias.persona WHERE id_persona = $id_persona ;");
	
	$result = pg_fetch_array($sql);
	return $result[0];
}

function Los_perfiles_de_Persona($id_persona)
{
	$sqlOINA= pg_query(" SELECT  nombre_perfil , perfil.id_perfil FROM pasantias.persona 
				 	
				 INNER JOIN pasantias.persona_organizacion_oficina 
				 	ON persona_organizacion_oficina.id_persona = persona.id_persona 
				 	AND persona.id_persona = $id_persona 
				 INNER JOIN pasantias.perfil 
				 	ON perfil.id_perfil = persona_organizacion_oficina.id_perfil ;");

	$sqlEDAD= pg_query(" SELECT  nombre_perfil , perfil.id_perfil FROM  pasantias.persona 
				 
				 INNER JOIN pasantias.persona_instituto_especialidad 
				 	ON persona_instituto_especialidad.id_persona = persona.id_persona 
				 	AND persona.id_persona = $id_persona  
				 INNER JOIN pasantias.perfil 
				 	ON perfil.id_perfil = persona_instituto_especialidad.id_perfil ;");
	return array('sql0' => $sqlOINA, 'sql1'=> $sqlEDAD);
}

function SeleccionarOrganizacionUsuario ( $nombre_perfil,  $id_persona   )
{



	if($nombre_perfil =='Menú Administrador')
	{
		$sql = pg_query($this->usuarioEncargado($id_persona));

	}else if ($nombre_perfil =='Menú Empresa')
	{
		$sql = pg_query($this->usuarioContactoEmpresa($id_persona));

	}else if ($nombre_perfil =='Menú Estudiante')
	{
		$sql = pg_query($this->usuarioEstudiante ($id_persona));

	}else if ($nombre_perfil =='Menú Tutor Academico')
	{

	}else if ($nombre_perfil =='Menú Super Usuario')
	{

	}else if ($nombre_perfil =='Menú Tutor Empresarial')
	{

	}else if ($nombre_perfil =='Menú Control Estudio')
	{

	}else if ($nombre_perfil =='Menú Ministerio')
	{

	} // ULTIMA LLAVE IF ELSE IF (){}


	return $sql;
}


// // ---------------------------------------------- 
// //   BUSCAR  LAS PERSONAS  CON VARIAS EMPRESAS  O  INSTITUCIONES  O  MUCHOS  USUARIOS REGISTRADOS  CON UNA  PERSONA
// // ---------------------------------------------- 

function usuarioEncargado ($id_persona)
{
	 $sql = " SELECT  nombre , apellido  , nombre_estado, municipio.nombre_municipio , organizacionmunicipio.domicilio , siglas 
			,organizacionmunicipio.codigo_sucursal , organizacion.id_organizacion
			FROM pasantias.persona
			JOIN pasantias.persona_organizacion_oficina 
				ON persona_organizacion_oficina.id_persona = persona.id_persona 

				AND persona_organizacion_oficina.id_persona =$id_persona
			JOIN pasantias.encargado 
				On encargado .id_persona = persona_organizacion_oficina.id_persona
				AND encargado .codigo_sucursal = persona_organizacion_oficina.codigo_sucursal
				AND encargado .id_oficina = persona_organizacion_oficina.id_oficina
				AND encargado .id_perfil = persona_organizacion_oficina.id_perfil
			
			JOIN pasantias.oficina ON oficina.id_oficina = persona_organizacion_oficina.id_oficina 
			
			JOIN pasantias.organizacionmunicipio ON organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal
			JOIN pasantias.organizacion ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
			JOIN pasantias.instituto_principal ON instituto_principal.id_organizacion = organizacion . id_organizacion
			JOIN pasantias.municipio ON municipio . id_municipio = organizacionmunicipio.id_municipio
			JOIN pasantias.estado ON municipio . id_estado = estado.id_estado				;";

	return  $sql;
}


function usuarioContactoEmpresa ($id_persona)
{

	$sql  = "SELECT nombre , apellido  , nombre_estado, municipio.nombre_municipio , organizacionmunicipio.domicilio ,
		    organizacion.nombre_organizacion AS siglas
		   ,organizacionmunicipio.codigo_sucursal , organizacion.id_organizacion
			FROM pasantias.persona
			JOIN pasantias.persona_organizacion_oficina ON persona_organizacion_oficina.id_persona = persona.id_persona 
			
			JOIN pasantias.organizacionmunicipio ON organizacionmunicipio.codigo_sucursal = persona_organizacion_oficina.codigo_sucursal
			JOIN pasantias.organizacion ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
			JOIN pasantias.municipio ON municipio . id_municipio = organizacionmunicipio.id_municipio
			JOIN pasantias.estado ON municipio . id_estado = estado.id_estado 
			JOIN pasantias.oficina ON oficina.id_oficina = persona_organizacion_oficina.id_oficina 
			
			JOIN pasantias.convenio_organizacion ON organizacion.id_organizacion = convenio_organizacion . id_organizacion
			AND persona_organizacion_oficina.id_persona = $id_persona;";


	return $sql;	
}

function usuarioEstudiante ($id_persona)
{

	$sql  = "SELECT nombre , apellido  , nombre_estado, municipio.nombre_municipio , organizacionmunicipio.domicilio ,
		    organizacion.siglas ,organizacionmunicipio.codigo_sucursal , organizacion.id_organizacion
			FROM pasantias.persona
			JOIN pasantias.persona_instituto_especialidad ON persona_instituto_especialidad.id_persona = persona.id_persona
			
			JOIN pasantias.instituto_principal ON instituto_principal.id_ip = persona_instituto_especialidad.id_ip
			JOIN pasantias.organizacion ON organizacion.id_organizacion = instituto_principal.id_organizacion
			JOIN pasantias.organizacionmunicipio ON organizacion.id_organizacion = organizacionmunicipio.id_organizacion
			JOIN pasantias.municipio ON municipio . id_municipio = organizacionmunicipio.id_municipio
			JOIN pasantias.estado ON municipio . id_estado = estado.id_estado
			JOIN pasantias.especialidad ON especialidad.id_especialidad = persona_instituto_especialidad.id_especialidad 
			
			AND persona_instituto_especialidad.id_persona = $id_persona;";


	return $sql;	
}

// ---------------------------------------------- 
//   BUSCAR  LAS PERSONAS  CON VARIAS EMPRESAS  O  INSTITUCIONES  O  MUCHOS  USUARIOS REGISTRADOS  CON UNA  PERSONA
// ---------------------------------------------- 

function usuariobitacorasesion( $usuario )
{

	$exe = pg_query(" UPDATE pasantias.usuario SET en_ejecucion='SI' WHERE id_usuario = $usuario ");

}





function consultar_funcion($id_perfil)
{
$sql="SELECT * FROM pasantias.funcion WHERE pasantias.funcion.id_perfil=$id_perfil ORDER BY id_funcion;";
$result=pg_query($sql);//ejecuta la tira sql
return $result;	
}

function consultar_submenu($id_funcion)
{
$sql="SELECT * FROM pasantias.submenu WHERE pasantias.submenu.id_funcion=$id_funcion  ORDER BY pasantias.submenu.id_submenu ;";
	 	 
	 $result=pg_query($sql);//ejecuta la tira sql

return $result;
	 
}

function consultar_submenu2($id_submenu)
{
	
$sql="SELECT * FROM pasantias.submenu2 WHERE pasantias.submenu2.id_submenu=$id_submenu  ORDER BY pasantias.submenu2.id_submenu2 ;";
	 	 
	 $result=pg_query($sql);//ejecuta la tira sql

return $result;
	 
}


function Datos_usuario($id_persona)
{

	$sql =	pg_query("SELECT persona.* , usuario.usuario , usuario.contrasena 
	 FROM pasantias.persona INNER JOIN pasantias.usuario ON usuario.id_persona = 
	persona.id_persona AND persona.id_persona = $id_persona;");
	return pg_fetch_array($sql);

}


function modificarDatos($Arreglo = array())
{
		$id_persona =$Arreglo['id_persona'];
		$telefono =$Arreglo['telefono'];
		$correo =$Arreglo['correo'];
		$usuario =$Arreglo['usuario'];
		$contrasena =$Arreglo['contrasena'];

	 	$sql = pg_query(" UPDATE pasantias.persona 
	 	SET   telefono='$telefono' , correo='$correo'
	    WHERE persona.id_persona = $id_persona  ;");

	   $sql2 = pg_query("UPDATE pasantias.usuario SET usuario= '$usuario' , contrasena = '$contrasena' 
	   WHERE  usuario.id_persona = $id_persona ;");

	 	$num =pg_affected_rows($sql);
	 		  pg_free_result($sql);
	 	return $num;
}

public function menu($id_perfil, $nombre_perfil,$nombre_organizacion, $nombre_persona){
	echo '<div class="banner"><img src="../../../img/img_1.png" align="center" height="5%" width="100%"></div>
		<br>
		<nav class="navbar navbar-default ">
        <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button> ';

        echo'
        </div>
        <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">';

		  $funcionA=$this->consultar_funcion($id_perfil);
          if($id_perfil != 1 )
          {
	    	echo'<li class="dropdown"><a tabindex="0"  data-submenu="" aria-expanded="false"> '.$nombre_organizacion.' </a></li>
	    	';

        
          }

			echo'<li class="dropdown"><a tabindex="0"  data-submenu="" aria-expanded="false"> '.$nombre_perfil.' </a></li>
			';

			while($funciones=pg_fetch_array($funcionA)){
			$id_funcion=$funciones['id_funcion'];
			$ruta_funcion=$funciones['ruta_funcion'];
			$nombre_funcion=$funciones['nombre_funcion'];

			$funcionB=$this->consultar_submenu($id_funcion);
			if(pg_num_rows($funcionB)==0){
			 echo'<li class="dropdown"><a tabindex="0"  data-submenu="" aria-expanded="false" href=" '.$ruta_funcion.' ">   '.$nombre_funcion.'  </a>';
			}
			
			
			if(pg_num_rows($funcionB)!=0){
			  echo'<li class="dropdown"><a tabindex="0" data-toggle="dropdown" data-submenu="" aria-expanded="false" href=" '.$ruta_funcion.' ">   '.$nombre_funcion.'  <span class="caret"></span></a>';

			echo'<ul class="dropdown-menu">';
			          
			  while($funciones=pg_fetch_array($funcionB)){
			  $id_submenu=$funciones['id_submenu'];
			  $ruta_submenu=$funciones['ruta_submenu'];
			  $nombre_submenu=$funciones['nombre_submenu'];

			$funcionC=$this->consultar_submenu2($id_submenu);
			if(pg_num_rows($funcionC)==0){
			echo'<li class="dropdown"><a tabindex="0" href=" '.$ruta_submenu.' "> '.$nombre_submenu.'</a>';
			 }

			$funcionC=$this->consultar_submenu2($id_submenu);
			if(pg_num_rows($funcionC)!=0){
			echo'<li class="dropdown-submenu"><a tabindex="0" href=" '.$ruta_submenu.' "> '.$nombre_submenu.'</a>';
			echo'<ul class="dropdown-menu">';
			          
			            while($funciones=pg_fetch_array($funcionC)){
			            $id_submenu2=$funciones['id_submenu2'];
			            $ruta_submenu2=$funciones['ruta_submenu2'];
			            $nombre_submenu2=$funciones['nombre_submenu2'];
			          
			           echo' <li><a tabindex="0" href="'.$ruta_submenu2.'"> '.$nombre_submenu2.'</a></li>';
			           }  
			           echo'                              
			</ul>
			</li>';

			}else{echo"</li>" ;} 

			 } 

			echo"</ul> </li>";
			}else{echo"</li>";}
			}
	


  echo '  
 </ul> ';
			 	if($id_perfil != 1 )
				{

			 echo '

			 <ul  class="nav navbar-nav navbar-right">

				 	<li class="dropdown">
				 	<a  tabindex="0" data-toggle="dropdown"> Hola!  '.$nombre_persona.' <span class="caret"></span></a>
				 			<ul class="dropdown-menu">
					                    	<li><a href="../../Index/controlador/cerrar_sesion.php">Cerrar Sesión</a></li>
					                    	<li><a href="../../Modulo_Usuario/vista/MisDatos.php">Datos Personales</a></li>
					                    	
				            </ul>
					</li>
				   
			 </ul>';
			 }
 echo '  </div>
		 </nav>';

} 


function consultar_usuario($id_persona , $id_perfil)
{
	if($id_persona==null){}else{
		
		$strsql="SELECT usuario.id_usuario, usuario.usuario, usuario.contrasena, persona_instituto_especialidad.estado, persona_instituto_especialidad.id_perfil, persona_instituto_especialidad.fecha_solicitud FROM
		 pasantias.usuario, pasantias.persona_instituto_especialidad WHERE
		  usuario.id_persona ='$id_persona' and
		   persona_instituto_especialidad.id_perfil ='$id_perfil' and 
		   usuario.id_persona=persona_instituto_especialidad.id_persona";
    	
    	$numm=0;
	 	
	 	$result2=pg_query($strsql);//ejecuta la tira sql
	 return $result2;

}
}
function registrar_usuario($id_persona, $usuario, $contrasena)
{

$strsql="INSERT INTO pasantias.usuario (usuario, contrasena, estatus, id_persona) VALUES 
	  ('$this->usuario', '$this->contrasena', 'PENDIENTE', '$this->id_persona');";
		$result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
		  $num =0;
		  $num = pg_affected_rows($result);
		 
          pg_free_result($result);

return $num;

}

function verificar_registro($id_persona, $usuario, $contrasena)
{
$insert ="SELECT * FROM pasantias.usuario where id_persona='$id_persona' and usuario='$usuario' and contrasena='$contrasena' ;"; 
		$resultado =pg_query( $insert);
return pg_num_rows($resultado);
}
function registrar_fecha_solicitud($id_persona, $fecha, $id_perfil)
{
	echo $fecha;
 $inserto3=pg_query("UPDATE pasantias.persona_instituto_especialidad SET fecha_solicitud='$fecha' where id_persona='$id_persona' and id_perfil='$id_perfil' ");
}

function verificar_registro_usuario($id_persona, $usuario, $contrasena, $id_usuario, $fecha, $id_instituto, $id_perfil)
{
$result=$this->verificar_registro($id_persona, $usuario, $contrasena);
$resulta=$this->registrar_fecha_solicitud($id_persona, $fecha, $id_perfil);

if($result==0){
$this->registrar_usuario($id_persona, $usuario, $contrasena);
}else{
$num=1;
	return $num;
}
}

function actualizar_usuario($id_persona, $usuario, $contrasena, $id_usuario, $fecha, $id_instituto, $id_perfil)
{

$resulta=$this->registrar_fecha_solicitud($id_persona, $fecha, $id_perfil);
$strsql="UPDATE pasantias.usuario SET usuario='$usuario', contrasena='$contrasena' WHERE id_persona='$id_persona' AND id_usuario='$id_usuario'";
		
		$result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

		  
		  $num =0;
		  $num = pg_affected_rows($result);
		 
          pg_free_result($result);

return $num;
}



public function llenar_principal($id_perfil)
	{

		$insert ="SELECT * FROM pasantias.publicacion where id_perfil=$id_perfil ORDER BY id_perfil ;"; 
		$resultado =pg_query( $insert);

		while($fila = pg_fetch_array($resultado)){
	
		echo " 		".$fila['titulo']." 		".$fila['texto']." 
		<img src='../../Modulo_Registrar_Roles_Perfiles/vista/uploads/".$fila['foto']."' />

		";
		
		
			}

	}

 function  codigoencargado( $id_persona , $codigo_sucursal  )
 {
 			$sql =pg_query("SELECT codigo_encargado FROM pasantias.encargado WHERE id_persona = $id_persona AND  codigo_sucursal='$codigo_sucursal';");
 			$variable = pg_fetch_array($sql);

 	return $variable[0];
 }



function consultar_pregunta_usuario($vista=array())
{
                 
$cedula       = $vista['cedula'];

  $strsql="SELECT persona.id_persona, persona.nombre, persona.apellido, usuario.id_usuario, usuario.pregunta From 
  pasantias.persona, pasantias.usuario where pasantias.persona.cedula='$cedula' 
  and pasantias.persona.id_persona=pasantias.usuario.id_persona 
     ";
   $num=0;
   $result=pg_query($strsql);//ejecuta la tira sql
   
   return $result;
   
   

}


function consultar_usuario_y_contrasena($vista=array())
{
                 
$id_usuario       = $vista['id_usuario'];
$id_persona       = $vista['id_persona'];
$respuesta       = $vista['respuesta'];

  $strsql="SELECT id_usuario, usuario, contrasena From pasantias.usuario where usuario.id_persona='$id_persona' 
  and pasantias.usuario.id_usuario='$id_usuario' and pasantias.usuario.respuesta='$respuesta' 
     ";
   $num=0;
   $result=pg_query($strsql);//ejecuta la tira sql
   
   return $result;
   
   

}


}



?>
