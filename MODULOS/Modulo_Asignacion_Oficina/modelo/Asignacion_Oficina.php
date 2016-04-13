<<<<<<< HEAD
<?php

require_once("../../../BASE_DATOS/Conect.php");

 $ConexionBD =new Conexion();
 $ConexionBD->Conectar();

class Asignacion_Oficina{


public $id_oficina;
public $id_organizacion;


//---CONSTRUCTOR--->>
public function __construct( $Vista =array() )
	{

                
		
	}//---FIN DEL CONTRUCTOR---->>




function ActualizarBD_Asignacion($Vista= array()){

            $id_organizacion=$Vista['id_organizacion'];
            $id_oficina=$Vista['id_oficina']; 
            $estatus=$Vista['estatus'];
            $descripcion=$Vista['descripcion'];

            


            $strsql=" UPDATE pasantias.organizacion_oficina SET estado='$estatus', descripcion='$descripcion' 
             WHERE id_oficina='$id_oficina' AND codigo_sucursal='$id_organizacion' "; 

            $result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

            $Actualiza =0;
            $Actualiza = pg_affected_rows($result);
     
         

            return $Actualiza;

        }


        function CosultarAsignacion($Vista=array()){


          $ID_O=$Vista['ID_ORGANIZACION'];
          $ID_OF=$Vista['ID_OFICINA'];


          $sql="SELECT * FROM pasantias.organizacion_oficina WHERE codigo_sucursal='$ID_O' AND id_oficina=$ID_OF ";

          $result=pg_query($sql);

          $num=pg_num_rows($result);

          return $num;



        }





function Asignacion_OficinaBD($Vista=array())
{



            $ID_OFICINA=$Vista['ID_OFICINA'];
            $ID_ORGANIZACION=$Vista['ID_ORGANIZACION'];
            $DESCRIPCION=$Vista['DESCRIPCION'];

            $strsql=" INSERT INTO pasantias.organizacion_oficina ( codigo_sucursal,id_oficina , estado, descripcion  ) 

            VALUES ( '$ID_ORGANIZACION' , '$ID_OFICINA' , 'ACTIVO', '$DESCRIPCION') "; 

            $result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


                              $registro =0;
                              $registro = pg_affected_rows($result);


                return $registro;


                  


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
=======
<?php

require_once("../../../BASE_DATOS/Conect.php");

 $ConexionBD =new Conexion();
 $ConexionBD->Conectar();

class Asignacion_Oficina{


public $id_oficina;
public $id_organizacion;


//---CONSTRUCTOR--->>
public function __construct( $Vista =array() )
	{

                
		
	}//---FIN DEL CONTRUCTOR---->>




function ActualizarBD_Asignacion($Vista= array()){

            $id_organizacion=$Vista['id_organizacion'];
            $id_oficina=$Vista['id_oficina']; 
            $estatus=$Vista['estatus'];
            $descripcion=$Vista['descripcion'];

            


            $strsql=" UPDATE pasantias.organizacion_oficina SET estado='$estatus', descripcion='$descripcion' 
             WHERE id_oficina='$id_oficina' AND codigo_sucursal='$id_organizacion' "; 

            $result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

            $Actualiza =0;
            $Actualiza = pg_affected_rows($result);
     
         

            return $Actualiza;

        }


        function CosultarAsignacion($Vista=array()){


          $ID_O=$Vista['ID_ORGANIZACION'];
          $ID_OF=$Vista['ID_OFICINA'];


          $sql="SELECT * FROM pasantias.organizacion_oficina WHERE codigo_sucursal='$ID_O' AND id_oficina=$ID_OF ";

          $result=pg_query($sql);

          $num=pg_num_rows($result);

          return $num;



        }





function Asignacion_OficinaBD($Vista=array())
{



            $ID_OFICINA=$Vista['ID_OFICINA'];
            $ID_ORGANIZACION=$Vista['ID_ORGANIZACION'];
            $DESCRIPCION=$Vista['DESCRIPCION'];

            $strsql=" INSERT INTO pasantias.organizacion_oficina ( codigo_sucursal,id_oficina , estado, descripcion  ) 

            VALUES ( '$ID_ORGANIZACION' , '$ID_OFICINA' , 'ACTIVO', '$DESCRIPCION') "; 

            $result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


                              $registro =0;
                              $registro = pg_affected_rows($result);


                return $registro;


                  


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
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
?>