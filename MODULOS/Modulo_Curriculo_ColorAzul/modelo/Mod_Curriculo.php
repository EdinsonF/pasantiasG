<?php
include_once("../../../BASE_DATOS/Conect.php");

 $ConexionBD =new Conexion();
 $ConexionBD->Conectar();

class Curriculo{


	function RegistraCurriculo_BD($vista=array()){

		 
		$Retorno=0;

		$id_persona              =$vista['id_persona'];
	    $profesion               =$vista['profesion'];
	    $descripcion_profesion   =$vista['descripcion_profesion'];
	    //FORMACION ACADEMICA
	    $inicio_curso          	 =$vista['inicio_curso'];
	    $fin_curso             	 =$vista['fin_curso'];
	    $nombre_instituto      	 =$vista['nombre_instituto'];
	    $descripcion_obtencion 	 =$vista['descripcion_obtencion'];
	    //ESPERIENCIA LABORAL
	    $inicio_empleo      	 =$vista['inicio_empleo'];
	    $fin_empleo         	 =$vista['fin_empleo'];
	    $nombre_empresa     	 =$vista['nombre_empresa'];
	    $cargo_en_empresa   	 =$vista['cargo_en_empresa'];
	    $funcion_en_empresa 	 =$vista['funcion_en_empresa'];


	    $fecha_actual=date("d/m/Y");

	    //TABLA CURRICULO- REGISTRAR...
	    $sql="INSERT INTO pasantias.curriculum (id_persona, fecha_actualizacion, descripcion, profesion)VALUES 
	    											    ($id_persona, '$fecha_actual','$descripcion_profesion','$profesion')";

	    $result = pg_query($sql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

                
         //SELECCIONAR ULTIMO ID CURRICULO...
         $SELECT=pg_query("SELECT MAX(id_curriculum) FROM pasantias.curriculum"); 
         $regist=pg_fetch_array($SELECT);
         $id_curriculo=$regist[0];

         //////////////////////////////////////FORMACION ACADEMICA//////////////////////////////////////////////////////////   


         for($i=0;$i<count($nombre_instituto);$i++){//----RECORRO TODAS LAS POSICIONES Y REGISTRO 

        //TABLA FORMACION ACADEMICA- REGISTRAR...
	    $sql="INSERT INTO pasantias.curriculum_formacion_academica (id_curriculum, ano_egreso, nombre_instituto, observacion, estatus)VALUES 
	    											    			($id_curriculo, '$inicio_curso[$i]/$fin_curso[$i]','$nombre_instituto[$i]','$descripcion_obtencion[$i]','ACTIVO')";

	    $result = pg_query($sql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

            } 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////77

        //////////////////////////////////////EXPERIENCIA LABORAL//////////////////////////////////////////////////////////          
         for($j=0;$j<count($nombre_empresa);$j++){//----RECORRO TODAS LAS POSICIONES Y REGISTRO           
               
        //TABLA EXPERIENCIA LABOLAR- REGISTRAR...
	    $sql="INSERT INTO pasantias.curriculum_experiencia_laboral (id_curriculum, duracion, cargo, nombre_empresa, funcion, observacion, estatus)VALUES 
	    											    			($id_curriculo, '$inicio_empleo[$j]/$fin_empleo[$j]','$cargo_en_empresa[$j]','$nombre_empresa[$j]','$funcion_en_empresa[$j]','NO OBSERVACION','ACTIVO')";

	    $result = pg_query($sql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
	     }
	     $this->RegistrarImagenURL($id_curriculo,$id_persona);

                    $registro =0;
                    $registro = pg_affected_rows($result);
                    if($registro>0){
                    	$Retorno=1;
                    	return $Retorno;
                    }else{
                    	return $registro;
                    }

           		}//------FIN DE FUNCTION 





        function Actualizar_CurriculoBD($vista=array()){

		 
				$Retorno=0;

				$id_curriculo            =$vista['id_curriculo'];

				$id_persona              =$vista['id_persona'];
			    $profesion               =$vista['profesion'];
			    $descripcion_profesion   =$vista['descripcion_profesion'];
			    //FORMACION ACADEMICA
			    $id_formacionA 			 =$vista['id_formacionA'];
			    $inicio_curso          	 =$vista['inicio_curso'];
			    $fin_curso             	 =$vista['fin_curso'];
			    $nombre_instituto      	 =$vista['nombre_instituto'];
			    $descripcion_obtencion 	 =$vista['descripcion_obtencion'];
			    //ESPERIENCIA LABORAL
			    $id_experienciaL 		 =$vista['id_ExperienciaL'];
			    $inicio_empleo      	 =$vista['inicio_empleo'];
			    $fin_empleo         	 =$vista['fin_empleo'];
			    $nombre_empresa     	 =$vista['nombre_empresa'];
			    $cargo_en_empresa   	 =$vista['cargo_en_empresa'];
			    $funcion_en_empresa 	 =$vista['funcion_en_empresa'];


			    $fecha_actual=date("d/m/Y");
			    $registro=0;
			    $registro2=0;
			    $registro3=0;

			    //TABLA CURRICULO- REGISTRAR...
			    $sql=pg_query("UPDATE pasantias.curriculum SET fecha_actualizacion='$fecha_actual', descripcion='$descripcion_profesion', profesion='$profesion' WHERE id_curriculum='$id_curriculo'");
			    
			    $registro = pg_affected_rows($sql);
		                

		         //////////////////////////////////////FORMACION ACADEMICA//////////////////////////////////////////////////////////   
		         $cont=count($vista['nombre_instituto']);

		         for($i=0;$i<$cont;$i++){//----RECORRO TODAS LAS POSICIONES Y REGISTRO 

		         		if($id_formacionA[$i]==null){
		         				//TABLA FORMACION ACADEMICA- REGISTRAR...
					    $sql="INSERT INTO pasantias.curriculum_formacion_academica (id_curriculum, ano_egreso, nombre_instituto, observacion, estatus)VALUES 
					    											    			($id_curriculo, '$inicio_curso[$i]/$fin_curso[$i]','$nombre_instituto[$i]','$descripcion_obtencion[$i]','ACTIVO')";

		         			$result = pg_query($sql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
		         			$registro2 = pg_affected_rows($result);
		         		}else{

		         			$updating=pg_query("UPDATE pasantias.curriculum_formacion_academica SET ano_egreso='$inicio_curso[$i]/$fin_curso[$i]', nombre_instituto='$nombre_instituto[$i]', observacion='$descripcion_obtencion[$i]'
		         								 WHERE id_formacion=$id_formacionA[$i] AND id_curriculum=$id_curriculo ");

		         			$registro2 = pg_affected_rows($updating);
		         		}
				        

		            } 

		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////77
		            $cont2=count($vista['nombre_empresa']);
		        //////////////////////////////////////EXPERIENCIA LABORAL//////////////////////////////////////////////////////////          
		         for($j=0;$j<$cont2;$j++){//----RECORRO TODAS LAS POSICIONES Y REGISTRO           
		            
			            if($id_experienciaL[$j]==null){
			            		//TABLA EXPERIENCIA LABOLAR- REGISTRAR...
							    $sql="INSERT INTO pasantias.curriculum_experiencia_laboral (id_curriculum, duracion, cargo, nombre_empresa, funcion, observacion, estatus)VALUES 
							    											    			($id_curriculo, '$inicio_empleo[$j]/$fin_empleo[$j]','$cargo_en_empresa[$j]','$nombre_empresa[$j]','$funcion_en_empresa[$j]','NO OBSERVACION','ACTIVO')";

							    $result = pg_query($sql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
							    $registro3 = pg_affected_rows($result);

			            }else{
			            		$updatin=pg_query("UPDATE pasantias.curriculum_experiencia_laboral SET duracion='$inicio_empleo[$j]/$fin_empleo[$j]', cargo='$cargo_en_empresa[$j]', nombre_empresa='$nombre_empresa[$j]', funcion='$funcion_en_empresa[$j]' 
			            							WHERE id_experiencia=$id_experienciaL[$j] AND id_curriculum=$id_curriculo");
			            		$registro3 = pg_affected_rows($updatin);
			            }   
			        
				     }

				     $this->RegistrarImagenURL($id_curriculo,$id_persona);

			                 
			                    

			                    if($registro>0 || $registro2>0 || $registro3>0){
			                    	$Retorno=1;
			                    	return $Retorno;
			                    }else{
			                    	return $registro;
			                    }

           		}//----FIN DE ACTUALIZAR 


        





       function EliminarSeccionBD_Estudios($arrays= array()){

       	$id_curriculo=$arrays['id_curriculo'];
       	$id_formacionA=$arrays['id_formacionA'];

       	$sql=pg_query("DELETE FROM pasantias.curriculum_formacion_academica WHERE id_formacion=$id_formacionA AND id_curriculum=$id_curriculo");

   				$alterados =0;
                $alterados = pg_affected_rows($sql);
                if($alterados>0){
                	$retorno=1;
                	return $retorno;
                }else{
                	$retorno=0;
                	return $retorno;
                }

       }



		function EliminarSeccionBD_Trabajo($arrays= array()){

		       	$id_curriculo=$arrays['id_curriculo'];
		       	$id_experiencia_L=$arrays['id_experienciaL'];

		       	$sql=pg_query("DELETE FROM pasantias.curriculum_experiencia_laboral WHERE id_experiencia=$id_experiencia_L AND id_curriculum=$id_curriculo");

		   				$alterados =0;
		                $alterados = pg_affected_rows($sql);
		                if($alterados>0){
		                	$retorno=1;
		                	return $retorno;
		                }else{
		                	$retorno=0;
		                	return $retorno;
		                }

		       }







	function RegistrarImagenURL($curriculum, $id_persona){

$carpeta="../images/ImagenesRegistradas/".$id_persona;

if(file_exists($carpeta)) {
    
}else{
    mkdir("../images/ImagenesRegistradas/".$id_persona);
}
	
	$rutaFlotante="../images/ImagenPrevia";
	$rutaNuevaEstatica="../images/ImagenesRegistradas/".$id_persona;

	    	
	 $filehandle=opendir($rutaFlotante);//abrir archivos
			while($file=readdir($filehandle)){

				if ($file=="Photo.jpg" || $file=="Photo.png"){

				$Imagen=$rutaNuevaEstatica."/".$file;         
	          
			$updat="UPDATE pasantias.curriculum SET foto='$Imagen' WHERE id_curriculum=$curriculum AND id_persona=$id_persona";
	        $resul = pg_query($updat) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

}}


closedir($filehandle);// Fin lectura archivos


		$filehandlee=opendir($rutaFlotante);//abrir archivos
		while($filee=readdir($filehandlee)){

			if ($filee=="Photo.jpg" || $filee=="Photo.png"){

			$origen=$rutaFlotante."/".$filee;
			
			$destino=$rutaNuevaEstatica."/".$filee;

			copy($origen,$destino);
		}}
		closedir($filehandlee);// Fin lectura archivos



			$filehandle=opendir($rutaFlotante);//abrir archivos
			while($file=readdir($filehandle)){

			$ImagenElimina=$rutaFlotante."/".$file;

			
			unlink($ImagenElimina);
			}



	}




	function CosutarDatosCurrriculoBD($vista=array()){


		$id_persona=$vista['id_persona'];
		
		
		$DatosPersonal=array();
		$FormacionAcademica=array();
		$ExperienciaLaboral=array();

		$sql=pg_query("SELECT curriculum.descripcion, profesion, id_curriculum, foto, persona.nombre ||' '|| persona.apellido AS nombre, especialidad.nombre_especialidad ||' - '|| tipo_especialidad.nombre_tipo_especialidad AS especialidad, organizacion.siglas FROM pasantias.curriculum 
						JOIN pasantias.persona
						ON persona.id_persona = curriculum.id_persona 
						JOIN pasantias.persona_instituto_especialidad
						ON persona_instituto_especialidad.id_persona=persona.id_persona
						JOIN pasantias.especialidad
						ON especialidad.id_especialidad = persona_instituto_especialidad.id_especialidad
						JOIN pasantias.tipo_especialidad
						ON tipo_especialidad.id_tipo_especialidad = especialidad.id_tipo_especialidad
						JOIN pasantias.instituto_principal
						ON persona_instituto_especialidad.id_ip = instituto_principal.id_ip
						JOIN pasantias.organizacion
						ON organizacion.id_organizacion = instituto_principal.id_organizacion
						WHERE curriculum.id_persona=$id_persona;");
		 
		 
		 $id_curriculo;
		 
		
        while($fila=pg_fetch_array($sql))
          {
            $DatosPersonal[] = $fila;
            $id_curriculo=$fila['id_curriculum'];
            
          }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7          
		$sql2=pg_query("SELECT * FROM pasantias.curriculum_formacion_academica WHERE id_curriculum=$id_curriculo");

		while($fila2=pg_fetch_array($sql2))
          {
            $FormacionAcademica[] = $fila2;
          }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7
          $sql3=pg_query("SELECT * FROM pasantias.curriculum_experiencia_laboral WHERE id_curriculum=$id_curriculo");

		while($fila3=pg_fetch_array($sql3))
          {
            $ExperienciaLaboral[] = $fila3;
          }

         

		return array( 'PERSONAL'=>$DatosPersonal,'ACADEMICA'=>$FormacionAcademica,'LABORAL'=>$ExperienciaLaboral);

	}
	


}


?>
