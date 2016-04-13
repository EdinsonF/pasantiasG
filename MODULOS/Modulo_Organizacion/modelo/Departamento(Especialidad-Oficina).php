<<<<<<< HEAD
<?php

include_once("../../../BASE_DATOS/Conect.php");

 $ConexionBD =new Conexion();
 $ConexionBD->Conectar();

class Especialidad{


public $id;
public $id_tipo_especialidad;
public $estatus;
public $descripcion;
public $nombre;


//---CONSTRUCTOR--->>
public function setFormulario( $Vista =array() )
	{

                
               
		$this->id = $Vista['id'];
		$this->id_tipo_especialidad = $Vista['tipo_especialidad'];
		$this->descripcion = $Vista['descripcion'];
		$this->estatus= $Vista['estatus'];
		$this->nombre= $Vista['nombre'];
                
		
	}//---FIN DEL CONTRUCTOR---->>




/////////////////////////////O F I C I N A----------//////////////////////////7




     
            
            function Consultar_ParaRegistrar_Office($Dato)
            {                
                $result=pg_query("SELECT id_oficina FROM pasantias.oficina WHERE nombre_oficina=upper('".$Dato."');");

              
                 $id= pg_fetch_array($result);

              return array('result'=>pg_num_rows($result),'id_oficina'=>$id['id_oficina']);
            }      
            
          function verificarprimerOficinaSistema ()
          {
            $estatusDelaPersona ="";

            $num = pg_num_rows(pg_query("SELECT count(*) FROM pasantias.persona_organizacion_oficina"));
                if($num ==0){
                          $estatusDelaPersona =  "ACTIVO";
                }else {   $estatusDelaPersona =  "INACTIVO";}

              return $estatusDelaPersona ;
          }

           function oficinaEncargado( $nombreOficina ,$descripcionOficina )
           {  
            $estatussistem = $this->verificarprimerOficinaSistema();
            $num= $this->Consultar_ParaRegistrar_Office($nombreOficina);

            if($num['result']==1){
                  
                return $num['id_oficina'];

            }else{
                $this->estatus      =  $estatussistem;
                $this->descripcion  =  $descripcionOficina;
                $this->nombre       =  $nombreOficina;
                $this->Incluir_Oficina();
                $num=  $this->Consultar_ParaRegistrar_Office($nombreOficina);
                return $num['id_oficina'];
                }

           }// FIN FUNCTION oficinaEncargado(nombreOficina) que  es Contacto;

           function asignacionOficinaOrganizacion( $organizacion , $oficina )
           {

          $ver = $this->verificarEstosIds($organizacion , $oficina);

          if(($ver['organizacion']==1)&&($ver['oficina'])==1)
          {


              $insert = pg_query("INSERT INTO pasantias.organizacion_oficina VALUES 
              ( $oficina , $organizacion, 'ACTIVO') ");

              return array( 'result'      =>pg_affected_rows($insert) ,
                            'organizacion'=>$organizacion ,
                            'oficina'     =>$oficina   );
          
          }

          }
           

          function verificarEstosIds ($organizacion , $oficina)
          {

          $sqlOR = pg_query("SELECT id_organizacion FROM pasantias.organizacion where id_organizacion=$organizacion ");
          $sqlOF = pg_query("SELECT id_oficina FROM pasantias.oficina WHERE id_oficina=$oficina");
           
          $organizacion = pg_num_rows($sqlOR);
          $oficina =pg_num_rows($sqlOF);

          return array('organizacion'=>$organizacion, 'oficina'=>$oficina);

          } 



    function incluir_Departamento()
    {
      $insert=pg_query(" INSERT INTO pasantias.departamento (  estado,descripcion  ) 

      VALUES ( '$this->estatus','$this->descripcion' ) ");//ejecuta la tira sql

      return $id_departamento = $this->id_DepartamentoMAX();
    }    
    function Incluir_Oficina()
    {
      $id_departamento = $this->incluir_Departamento();      
      $strsql=" INSERT INTO pasantias.oficina ( id_departamento , nombre_oficina  ) 

      VALUES (  $id_departamento,upper('$this->nombre') ) "; 

      $result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

      $registro = pg_affected_rows($result);  pg_free_result($result);     

      return $registro;
    }

    function id_DepartamentoMAX()
    {
      $fila = pg_fetch_array(pg_query(" SELECT * FROM pasantias.ultimoid_departamento ; "));
    
      $id_departamento = $fila[0];

      return $id_departamento;
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




}







	 

}
=======
<?php

include_once("../../../BASE_DATOS/Conect.php");

 $ConexionBD =new Conexion();
 $ConexionBD->Conectar();

class Especialidad{


public $id;
public $id_tipo_especialidad;
public $estatus;
public $descripcion;
public $nombre;


//---CONSTRUCTOR--->>
public function setFormulario( $Vista =array() )
	{

                
               
		$this->id = $Vista['id'];
		$this->id_tipo_especialidad = $Vista['tipo_especialidad'];
		$this->descripcion = $Vista['descripcion'];
		$this->estatus= $Vista['estatus'];
		$this->nombre= $Vista['nombre'];
                
		
	}//---FIN DEL CONTRUCTOR---->>




/////////////////////////////O F I C I N A----------//////////////////////////7




     
            
            function Consultar_ParaRegistrar_Office($Dato)
            {                
                $result=pg_query("SELECT id_oficina FROM pasantias.oficina WHERE nombre_oficina=upper('".$Dato."');");

              
                 $id= pg_fetch_array($result);

              return array('result'=>pg_num_rows($result),'id_oficina'=>$id['id_oficina']);
            }      
            
          function verificarprimerOficinaSistema ()
          {
            $estatusDelaPersona ="";

            $num = pg_num_rows(pg_query("SELECT count(*) FROM pasantias.persona_organizacion_oficina"));
                if($num ==0){
                          $estatusDelaPersona =  "ACTIVO";
                }else {   $estatusDelaPersona =  "INACTIVO";}

              return $estatusDelaPersona ;
          }

           function oficinaEncargado( $nombreOficina ,$descripcionOficina )
           {  
            $estatussistem = $this->verificarprimerOficinaSistema();
            $num= $this->Consultar_ParaRegistrar_Office($nombreOficina);

            if($num['result']==1){
                  
                return $num['id_oficina'];

            }else{
                $this->estatus      =  $estatussistem;
                $this->descripcion  =  $descripcionOficina;
                $this->nombre       =  $nombreOficina;
                $this->Incluir_Oficina();
                $num=  $this->Consultar_ParaRegistrar_Office($nombreOficina);
                return $num['id_oficina'];
                }

           }// FIN FUNCTION oficinaEncargado(nombreOficina) que  es Contacto;

           function asignacionOficinaOrganizacion( $organizacion , $oficina )
           {

          $ver = $this->verificarEstosIds($organizacion , $oficina);

          if(($ver['organizacion']==1)&&($ver['oficina'])==1)
          {


              $insert = pg_query("INSERT INTO pasantias.organizacion_oficina VALUES 
              ( $oficina , $organizacion, 'ACTIVO') ");

              return array( 'result'      =>pg_affected_rows($insert) ,
                            'organizacion'=>$organizacion ,
                            'oficina'     =>$oficina   );
          
          }

          }
           

          function verificarEstosIds ($organizacion , $oficina)
          {

          $sqlOR = pg_query("SELECT id_organizacion FROM pasantias.organizacion where id_organizacion=$organizacion ");
          $sqlOF = pg_query("SELECT id_oficina FROM pasantias.oficina WHERE id_oficina=$oficina");
           
          $organizacion = pg_num_rows($sqlOR);
          $oficina =pg_num_rows($sqlOF);

          return array('organizacion'=>$organizacion, 'oficina'=>$oficina);

          } 



    function incluir_Departamento()
    {
      $insert=pg_query(" INSERT INTO pasantias.departamento (  estado,descripcion  ) 

      VALUES ( '$this->estatus','$this->descripcion' ) ");//ejecuta la tira sql

      return $id_departamento = $this->id_DepartamentoMAX();
    }    
    function Incluir_Oficina()
    {
      $id_departamento = $this->incluir_Departamento();      
      $strsql=" INSERT INTO pasantias.oficina ( id_departamento , nombre_oficina  ) 

      VALUES (  $id_departamento,upper('$this->nombre') ) "; 

      $result = pg_query($strsql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

      $registro = pg_affected_rows($result);  pg_free_result($result);     

      return $registro;
    }

    function id_DepartamentoMAX()
    {
      $fila = pg_fetch_array(pg_query(" SELECT * FROM pasantias.ultimoid_departamento ; "));
    
      $id_departamento = $fila[0];

      return $id_departamento;
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




}







	 

}
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
?>