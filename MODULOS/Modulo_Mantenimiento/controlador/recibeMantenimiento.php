<?php
include_once("../../../BASE_DATOS/Conect.php");
$conexion = new Conexion();
$co = $conexion->Conectar();

if(isset($_GET['Guardar']))
{		
	   	$object = new Respaldo();

		$object->Descargar_Archivo("respaldo.sql");
	
}
if(isset($_POST['Respaldar']))
{
   	$object = new Respaldo();
 	$RESPALDO = $object->respaldar();

 	$object->guardar_repaldo($RESPALDO);
 	echo json_encode($RESPALDO) ;
 	
}



else if(isset($_FILES["Archivo"]))
{
														 // $path = $_SERVER["DOCUMENT_ROOT"]; 
					 //var_dump($_FILES);									 // $file = $_POST['Archivo']; 
														 // $completo = $path.$file;
															// echo $completo;
					
					move_uploaded_file($_FILES["Archivo"]["tmp_name"], "../".$_FILES["Archivo"]["name"]);
					$object = new Respaldo();
			//echo json_encode($_POST);
		 $resultado= $object->Recuperar("../".$_FILES["Archivo"]["name"]);
		 
		 echo json_encode($resultado);
}



class Respaldo{

function respaldar(){//database name
                 
		  
		  /** $res contiene la informacion de la bd con la cantidad de tablas disponibles en la misma.*/
		  $SQLtablas = "SELECT * FROM pg_catalog.pg_tables where schemaname ='pasantias';";
		  $res= pg_query($SQLtablas);

		  $BorrorStructura = "DROP SCHEMA IF EXISTS pasantias CASCADE;\n";
		  $estructura = "CREATE SCHEMA pasantias
  			AUTHORIZATION postgres; 
  			GRANT ALL ON SCHEMA pasantias TO postgres;";
  		  
		  $str="";
		  $str .= $BorrorStructura;
		  $str .= $estructura;
		  $estructuraBD ="";
		  while($row = pg_fetch_row($res))
		  {
		  	$estructuraBD = $row[0].'.';
			$table = $row[0].'.'.$row[1];
			$str .= "\n--\n";
			$str .= "-- Estrutura de la tabla '".$table."'";
			$str .= "\n--\n";
			
			$str .= "\nCREATE TABLE $table (";
			$res2SQL ="SELECT ordinal_position,column_name,
			data_type,character_maximum_length,is_nullable,column_default
			 FROM information_schema.columns WHERE
			  table_name   = '".$row[1]."' order by ordinal_position asc; ";
			$res2= pg_query($res2SQL);
			
			
			while($r = pg_fetch_row($res2)) {
				$col_defecto = $r[5];
				// if( $col_defecto !=null ){ 
				// 		$col_defecto .= " DEFAULT ".$r[5];
				//  }

				$cadena_buscada = "nextval";
				$posicion_coincidencia = strpos($col_defecto, $cadena_buscada);
				if ($posicion_coincidencia === false) {
			    // " NO se ha encontrado la palabra deseada!!!!";
					    	if( $col_defecto != null )
					    	{
					    			$col_defecto = " DEFAULT ".$col_defecto ;
					    	}
			    		
			    	
			    } else {
	            // "\n -- Éxito!!! Se ha encontrado la palabra buscada en la posición: ".$posicion_coincidencia;
	            $col_defecto = "";
	            }


				if($resultado!="") {
					$columa_primary_key_serial= $r[1];	
					$posicion_primary_key_serial = $i;
				}
				
				$str .= "\n" . $r[1]. " " . $r[2];	

				if ($r[4]=="NO") {
					$str .= " NOT NULL";
				}else 
				{
						$str .= "  NULL" ;
				}
				$str .= $col_defecto;
				//  r[0] las estructuras ,r[1] nombre  columna r[2] tipo dato r[4] si es  null o no lo es
				$str .= ",";
			}
			
			
			$str=rtrim($str, ",");  
			$str .= "\n);\n";
			$str .= "\n--\n";
			$str .= "-- Informacion de la tabla '".$table."'";
			$str .= "\n--\n\n";
		
			$RegistrosTabla = "SELECT * FROM ".$table." order by ".$row[1]." asc";
			$res3= pg_query($RegistrosTabla);
			
			$res_colSQL = "SELECT ordinal_position,column_name,data_type,character_maximum_length,is_nullable,column_default 
			FROM information_schema.columns WHERE 
			table_name   = '".$row[1]."' order by ordinal_position asc; ";    
			$res_col= pg_query($res_colSQL);
			
			$cantidad_columnas = pg_num_rows($res_col);
			$columa_primary_key_serial = "";
			$posicion_primary_key_serial  ="";
			$columnas_insert ="(";
			$i = 1;
			while($r = pg_fetch_row($res_col)){
				
				if($i==$cantidad_columnas){
				$columnas_insert.="".$r[1] ;	
				}else{
				$columnas_insert.="".$r[1].",";	
				}
				
				$i++;
			}
			$columnas_insert.=")";
			$cantidad_filas =  pg_num_rows($res3);
			$j= 1;
			//$columnassql=str_replace(array("(",")"),"",$columnas_insert);

			while($r = pg_fetch_assoc($res3)){
				
				
				
				$columnas_insertnew = $columnas_insert;
				$buscar=array_search('',$r);
				while(array_search('',$r)!= null){
									$columnas_insertnew=split(",".array_search('',$r) , $columnas_insertnew);
									
									unset($r[array_search('',$r)]);
									$columnas_insertnew=implode($columnas_insertnew);
				}											

				
				
				$sql = "INSERT INTO  $table $columnas_insertnew  VALUES ('";
				
				$sql .= implode("','" ,$r);
				$sql .= "');";
				$str = str_replace("''","",$str);
				$str .= $sql;
				$str .= "\n";

			}
			
		  $str .= $this->gusrdarSecuencias( $table, $row[1] );
		  } // PRIMER WHILE
		  $str .= $this->guardarIndex();
		  $str .= $this->guardarViews();
		  
		  $str .= $this->guardarRestricciones(); // ESTO   TAMPOCOO 
		  $str .= $this->guardarGatillos();
		
		  return $str;	
			
	}

	function guardarViews()
	{
		$sqlviews = "SELECT * FROM pg_catalog.pg_views where schemaname ='pasantias';";
		$arrr = pg_query($sqlviews);
		$str = "";
		while( $rows = pg_fetch_array($arrr) )
		{	
			$str .= "\n--\n\n";
			$str .= "-- Respaldando Mis Vistas '".$rows[0].'.'.$rows[1]."' ";
			$str .= "\n\n--\n";

			$str .= "CREATE VIEW $rows[0].$rows[1] AS  $rows[3] ;";
		}
		return $str;
	}

	function guardarIndex()
	{

		$sqlindexws ="SELECT distinct * FROM pg_indexes where schemaname ='pasantias';";
		$filas = pg_query($sqlindexws);
		$str = "";
		 while( $filasw = pg_fetch_array($filas)  )
		 {
			$str .= "\n--\n";
			$str .= "-- Respaldando Mis Indexes XD '".$filasw[0].'.'.$filasw[1].'.'.$filasw[2]."' ";
			$str .= "\n\n--\n";
			//$filasw[4] =str_replace(" ON", "DEX ON", $filasw[4]);
			
			$str .= " $filasw[4] ;";
		 }

		 return $str;
	}
	function borrarRestricciones()
	{
	    $sqlElaboradoConstraints = 
	    "SELECT constraint_schema ,
	    table_name, conname,constraint_name ,
	    pg_catalog.pg_get_constraintdef(pg_constraint.oid, true) as codigo_fuente
		FROM information_schema.table_constraints join pg_catalog.pg_constraint 
		on pg_constraint.conname = table_constraints.constraint_name
		order by codigo_fuente desc";
		$datos = pg_query($sqlElaboradoConstraints);
		 $str =""; 
		 while( $fil = pg_fetch_array($datos) )
		 {
		 		$str .= "\n--\n";
				$str .= "-- Respaldo de Restricciones '".$fil[0]." ".$fil[1]." ".$fil[2]."'";
				$str .= "\n--\n\n";
				$str .= "ALTER TABLE  $fil[0].$fil[1] DROP constraint IF EXISTS $fil[2]; \n";
				$str .= "\n";
		 }

		 return $str;
	}
	function guardarRestricciones()
	{
	    $sqlElaboradoConstraints = 
	    "SELECT  constraint_schema ,
	    table_name, conname,constraint_name ,
	    pg_catalog.pg_get_constraintdef(pg_constraint.oid, true) as codigo_fuente
		FROM information_schema.table_constraints join pg_catalog.pg_constraint 
		on pg_constraint.conname = table_constraints.constraint_name
		order by codigo_fuente desc";
		$datos = pg_query($sqlElaboradoConstraints);
		 $str =""; 
		 while( $fil = pg_fetch_array($datos) )
		 {
		 		$str .= "\n--\n";
				$str .= "-- Respaldo de Restricciones '".$fil[0]." ".$fil[1]." ".$fil[2]."'";
				$str .= "\n--\n\n";
				//$fil[2] = $fil[2]."1";
				$str .= "ALTER TABLE  $fil[0].$fil[1] ".' ADD CONSTRAINT'."   $fil[2]".'TRAINT'."  $fil[4]  ;";
		
		 }

		 return $str;
	}

	function gusrdarSecuencias( $nombreCompleto,$soloTabla )
	{
	$sqlserials =pg_query("SELECT * from information_schema.columns where table_name = '$soloTabla' AND column_default like 'nextval%' ;");
	$str="";
	$nums =pg_num_rows($sqlserials);

	 if ($nums == 1){
	 	$array = pg_fetch_array($sqlserials);
	 	//$nombreSq = pg_query("SELECT pg_get_serial_sequence('$array[1].$array[2]', '$array[3]')"); //SQL para  trabara 1 respaldo
	 	 //Los DEMAS no funcionan OK ? ... 
	 		 
	 	$numeroStart = pg_query("SELECT MAX($array[3])+1 as id ,1 as idEmergente FROM $nombreCompleto ;");
	 	$numero = pg_fetch_array($numeroStart);
	 	//$fila = pg_fetch_array($nombreSq);
	 		  $pedasoderecho[0] = explode("'::regclass)" ,$array[5]);
			  $pedasoizquierdo= explode("nextval('" , implode($pedasoderecho[0])) ;
	 	$secuencia = implode($pedasoizquierdo);
	 	$datos = pg_query("SELECT * from  $secuencia ;");
	 	$respaldo = pg_fetch_array($datos);
	 		$str .= "\n--\n";
	 			 		$respaldo[1] = $numero[0];
	 		if($respaldo[1] == 0)
	 		{
	 			$respaldo[1] = $numero[1];
	 		}
	 		

			$str .="CREATE SEQUENCE $secuencia
			  INCREMENT $respaldo[3]
			  MINVALUE  $respaldo[5]
			  MAXVALUE  $respaldo[4]
			  START 	$respaldo[1]
			  CACHE $respaldo[6];";
			$str .= "\n--  Una Mentazon 00:10  17 Junio Fue Modificado \n" ;
            $str .="ALTER TABLE $nombreCompleto ALTER COLUMN $array[3] SET DEFAULT nextval('$secuencia'::regclass);";
	 }else 
	 {
	 	$str="\n";
	 }



		return $str;
	}

	function CrearFunctionTrigger(  )
	{
		$str="";
			$namefunction= pg_query("SELECT 'pasantias.'|| proname FROM    pg_catalog.pg_namespace n JOIN    pg_catalog.pg_proc p ON      pronamespace = n.oid
						WHERE   nspname = 'pasantias';");

			while ($file = pg_fetch_array($namefunction)) 
			{
				$str .= "\n-- \n";
				$sql =   pg_query("SELECT pg_get_functiondef('$file[0]'::regproc);");
				$var =   pg_fetch_array($sql);
				$str.=" $var[0];";
				$str .= "\n-- \n";
			}


		return $str;
	}
	function guardarGatillos()
	{
		$sql =  pg_query("SELECT pg_catalog.pg_get_triggerdef(pg_trigger.oid) ,  'pasantias.' || relname as nombretabla
 							FROM pg_catalog.pg_trigger 
 							join pg_catalog.pg_class on pg_trigger.tgrelid = pg_class.oid 
 							JOIN pg_catalog.pg_namespace ON pg_namespace.oid=pg_class.relnamespace 
							WHERE NOt tgname like 'RI_Constraint%';;");
			$str="";

			$str .= $this->CrearFunctionTrigger();

		while ($fila = pg_fetch_array($sql) )
		{
			$str .= "\n--\n";
		 	$str.="$fila[0];";
		  	$str .= "\n--\n";
		}

		return $str;
	}

		function guardar_repaldo($RESPALDO)
		{
			date_default_timezone_set('America/Caracas');
			$fecha_completa = date("Y-m-d_His");//opcional
					
			$back = fopen("respaldo.sql","w+");
			$fecha_completa = date("Y-m-d_His");//opcional
			//chmod("*", 0777);  // octal; valor de modo correcto

			fwrite($back,$RESPALDO);
		    fclose($back);
		    $file ="respaldo.sql";
		    //$this->Descargar_Archivo($file);
		}

		function Descargar_Archivo($Mi_Respaldo)
		{
		   if (!is_file($Mi_Respaldo)) 
		   	{ die("<b>404 Archivo No funcionó!</b>"); }
		   $len = filesize($Mi_Respaldo);
		   $filename = basename($Mi_Respaldo);
		   $file_extension = strtolower(substr(strrchr($filename,"."),1));
		   $ctype="application/force-download";
		   header("Pragma: public");
		   header("Expires: 0");
		   header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		   header("Cache-Control: public");
		   header("Content-Description: File Transfer");
		   header("Content-Type: $ctype");
		   $header="Content-Disposition: attachment; filename=".$filename.";";
		   header($header );
		   header("Content-Transfer-Encoding: binary");
		   header("Content-Length: ".$len);
		   @readfile($Mi_Respaldo);
   			exit;
		}

		function Recuperar($archivo){
		  //chmod($archivo, 0777);  // octal; valor de modo correcto
			 //$archivo = rename($archivo, "respaldo.sql");
		  $back = fopen($archivo,"r");
		  $contents = fread($back, filesize($archivo));
		  $res= pg_query($contents) or die(pg_last_error());
		  fclose($back);
		  unlink($archivo); 
	
		  return $res;
		}

}
