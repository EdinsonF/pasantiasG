<?php

include_once("../modelo/Solicitud.php");
//include_once('../../Modulo_Tipo_Solicitud/modelo/Tipo_Solicitud.php');
include_once('../../Modulo_Departamento/modelo/Departamento(Especialidad-Oficina).php');
include('../../Modulo_Requisito/modelo/Requisito.php');


if(isset($_POST['Registrar'])){
    
        $Control=new Gestion_Solicitud_Controller();
        $Control->Resgistrar_Solicitud($_POST);
        
    }else if(isset($_POST['Modificar'])){
        //----MODIFICACION NOMRAL--->>>
        $Control=new Gestion_Solicitud_Controller();
        $Control->Modificar_Especialidad($_POST);


    }else if(isset($_POST['Postulacion'])){
        //----MODIFICACION NOMRAL--->>>
        $Control=new Gestion_Solicitud_Controller();
        $Control->ConsultarPara_RegistrarPostulacion($_POST);


    }else if(isset($_POST['estudiantes']))
  {  
     
     $modelo=new  Solicitud();
     
     $resultado = $modelo->cargar_modal_estudiantes_especialidad($_POST['id_especialidad'], $_POST['tipo_solicitud']);
     
     $data=array();
     while( $fila=pg_fetch_assoc($resultado))
     {
      $data[]=$fila;
     }
     echo json_encode($data);
  }else if(isset($_POST['tipo_solicitud']))
  {  
     
     $modelo=new  Solicitud();
     
     $resultado = $modelo->consultTipo_Solicitud();
     
     $data=array();
     while( $fila=pg_fetch_assoc($resultado))
     {
      $data[]=$fila;
     }
     echo json_encode($data);
  }

    
    
    
    
//-----INICIO DE LA CLASE--->>>
        class Gestion_Solicitud_Controller{




        	function CargarSelect_TipoSolicitud(){

            
  
                               $tipo=new Solicitud();

                               $num=$tipo->consultTipo_Solicitud();

                               while($Registro=pg_fetch_array($num)){

                                $id=$Registro['codigo_temporada'];
                                $nombre=$Registro['nombre_tipo_solicitud'];
                                $numero_lapso=$Registro['numero_lapso'];
                                
                                echo'<option value="'.$id.'">'.$nombre.' '.$numero_lapso.'</option>';
                              
                
                                }//---FIN DEL WHILE--->>>




        }



        function CargarSelect_Especialidad(){

            
  
                               $especialidad=new Especialidad();

                               $num=$especialidad->Consultar_EspecialidadActiva_Catalago();

                               while($Registro=pg_fetch_array($num)){

                                $id=$Registro['id_especialidad'];
                                $nombre=$Registro['nombre_especialidad'];
                                
                                echo'<option value="'.$id.'">'.$nombre.'</option>';
                              
                
                                }//---FIN DEL WHILE--->>>




        }



public function cargarTabla()
  {

    $class = new requisito();


     $resultado = $class->tablaRequisito();
          echo"<thead  class="."well".">
                     <tr >
                    <td><strong ><center>ID</center></strong></td>
                    <td><strong><center>Nombre </center></strong></td>
                    <td><strong><center>Estatus</center></strong></td>
                    <td><strong><center>Opci&oacute;n</center></strong></td>
                   
                    </tr>
                  </thead> <tbody>";;


            while($fila=pg_fetch_array($resultado))
                { 

              
        echo "  
      <tr class=requisito onclick=seleccionarfila_solicitud(this);>

      <td class=id_requisito ><center >".$fila['id_requisito']."</center></td>
      
      <td class=nombre_requisito ><center >".$fila['nombre_requisito']."</center></td>
      <td class=estatus ><center >".$fila['estatus']."</center></td>
      <td><center>
      <a href=#>
      
      <img src=../vista/icon/editarsmol.png alt=Ginger class=left width=20 ./>
            </a>     
          </center>
            </td>
            
            
        </tr> ";;
              
        }
        echo '</tbody>';
        

  }













            
 

        function CargarCatalago_Solicitudes($ID_INSTITUCION){



                    $Especialidad=new Solicitud();
                    

                    $Datos=$Especialidad->Consultar_Solicitud_Catalago($ID_INSTITUCION);
                    //CONTADOR PARA INCREMNETAR EL NUMERO DE FILAS-->>>

                    $variable=0;
                        echo'<thead>
                                <tr class="well" >
                                    <td ><strong ><center>ID</center></strong></td>
                                    <td><strong><center>Nómbre Tipo Solicitud</center></strong></td>
                                    <td><strong><center>Area</center></strong></td>
                                    <td><strong><center>Cantidad</center></strong></td>
                                    <td><strong><center>Estatus</center></strong></td>
                                    <td><strong><center>Operación</center></strong></td>
                                    
                        </thead>
                        <tbody>';


                            while ($registro=pg_fetch_array($Datos)) {

                              $id=$registro['id'];
                              $id_tipo_solicitud=$registro['id_tipo_solicitud'];
                              $nombre=$registro['nombre_tipo_solicitud'];
                              $id_especialidad=$registro['id_especialidad'];
                              $nombre_especialidad=$registro['nombre_especialidad'];
                              $descripcion=$registro['cantidad'];
                              $estatus=$registro['estatus'];
                              $observacion=$registro['observacion'];

                              
                             
                    echo'<tr class="especialidad" onclick="seleccionarfila(this)";  id="fila_'; echo $variable; echo'" onMouseOver="ResaltarFila'; echo"('fila_"; echo $variable; echo "');"; echo'"  onMouseOut="RestablecerFila'; echo"('fila_"; echo $variable; echo"')"; echo'";>';
                              echo'<td ><center>'.$id.'</center></td>';
                              echo'<td style="display: none;" ><center>'.$id_tipo_solicitud.'</center></td>';
                              echo'<td ><center>'.$nombre.'</center></td>';
                              echo'<td style="display: none;" ><center>'.$id_especialidad.'</center></td>';
                              echo'<td ><center>'.$nombre_especialidad.'</center></td>';
                              echo'<td ><center>'.$descripcion.'</center></td>';
                              echo'<td ><center>'.$estatus.'</center></td>';
                              echo'<td><strong><center><img src=../../../img/iconos/edit.png alt=Ginger class=left width=20/></center></strong></td>';
                              echo'<td style="display: none;" >'.$observacion.'</td>
                         </tr>';

                            $variable++;

                            }
            echo'</tbody>';

        }


// cargar solicitudes generalers
        
 function CargarSolicitudes($id_especialidad){

$Especialidad=new Solicitud();
$result=$Especialidad->cargar_solicitudes_p1($id_especialidad);
$r=pg_num_rows($result);
if($r!=null){
while($fila=pg_fetch_array($result))
{
  $codigo_solicitud=$fila['codigo_solicitud'];
  $result2=$Especialidad->cargar_solicitudes_p2($codigo_solicitud);
     while ( $fila2=pg_fetch_array($result2)) {
       $codigo_sucursal=$fila2['valor'];
       $result3=$Especialidad->cargar_solicitudes_p3($codigo_sucursal, $codigo_solicitud);
         while ( $fila3=pg_fetch_array($result3)) {
          echo '<div id="contenedornoti">';
          echo '<h2 ><center><span style="font-weight: bold;  color: #000000;">'.$fila3['nombre_organizacion'].' </span></h2></center>';
          echo '<span style="font-family: Arial; font-size: 13px; font-weight: bold; color: rgb(0, 0, 0); text-shadow: rgb(70, 46, 27) 0px 0px 6px;">';
          echo ' Organización de tipo '.$fila3['nombre_tipo_organizacion'].'    &nbsp;';
          echo 'Solicita Personal para'; 
          if($fila['nombre_tipo_solicitud']=='EGRESADO'){echo' TRABAJAR ';}else{echo' '.$fila['nombre_tipo_solicitud'].' '; } 
          echo' en el area de '.$fila['nombre_especialidad'].' que cumplan con los siguientes requisitos ';
              
              $result4=$Especialidad->cargar_solicitudes_p4($codigo_solicitud);
              $res=pg_num_rows($result4);
              $i=0;
              while ( $fila4=pg_fetch_array($result4)) {
                echo ' '.$fila4['nombre_requisito'].' '; $i=$i+1; if($i!=$res){echo ',';}
                                
              }
              echo '  Cantidad de Vacantes: '.$fila['cantidad_postulantes'].'  <br>';             
              $result5=$Especialidad->cargar_solicitudes_p5($codigo_solicitud);
               while ( $fila5=pg_fetch_array($result5)) {
                    $id_persona=$fila5['valor'];
                    $result6=$Especialidad->cargar_solicitudes_p6($id_persona, $codigo_solicitud);
                    while ( $fila6=pg_fetch_array($result6)) {
                      echo '
                      <br>
                      Persona de Contacto:<br>
                      '.$fila6['nombre'].' '.$fila6['apellido'].' <br>
                      Telefono: '.$fila6['telefono'].' <br>
                      Correo: '.$fila6['correo'].'<br>
                      </span><br>';
                    }
              }

       }
 

echo '<input type="button"  name="Postularme" id="'.$codigo_solicitud.'" class="btn btn-primary btn-large" value="Postularme" >';
echo '<br><label align="right"> Publicación Realizada el '.$fila['fecha_solicitud']. ' </label>';
echo '</div></div>';
}
}
}else{
	echo '
<div id="contenedornoti">
<center><h2 ><span style="font-weight: bold;  color: #000000;">Lo Lamentamos No hay Solicitudes :-(</span></h2></center>
</div> ';
}
        }
// fin cargar solicitudes generalers
// cargar solicitudes especificas
 function CargarSolicitudes_especificas($codigo_estudiante){

$Especialidad=new Solicitud();
  $result=$Especialidad->caragar_solicitudes_especificas_1($codigo_estudiante);
  $r=pg_num_rows($result);
if($r!=null){
  while($fila=pg_fetch_array($result))
{
  $codigo_solicitud=$fila['codigo_solicitud'];
  $result2=$Especialidad->cargar_solicitudes_p2($codigo_solicitud);
     while ( $fila2=pg_fetch_array($result2)) {
       $codigo_sucursal=$fila2['valor'];
       $result3=$Especialidad->cargar_solicitudes_p3($codigo_sucursal, $codigo_solicitud);
         while ( $fila3=pg_fetch_array($result3)) {
          echo '<div id="contenedornoti">';
          echo '<h2 ><center><span style="font-weight: bold;  color: #000000;">'.$fila3['nombre_organizacion'].' </span></h2></center>';
          echo '<span style="font-family: Arial; font-size: 13px; font-weight: bold; color: rgb(0, 0, 0); text-shadow: rgb(70, 46, 27) 0px 0px 6px;">';
          echo ' Organización de tipo '.$fila3['nombre_tipo_organizacion'].'    &nbsp;';
          echo 'Solicita Personal para'; 
          if($fila['nombre_tipo_solicitud']=='EGRESADO'){echo' TRABAJAR ';}else{echo' '.$fila['nombre_tipo_solicitud'].' '; } 
          echo' en el area de '.$fila['nombre_especialidad'].' que cumplan con los siguientes requisitos ';
              
              $result4=$Especialidad->cargar_solicitudes_p4($codigo_solicitud);
              $res=pg_num_rows($result4);
              $i=0;
              while ( $fila4=pg_fetch_array($result4)) {
                echo ' '.$fila4['nombre_requisito'].' '; $i=$i+1; if($i!=$res){echo ',';}
                                
              }
       echo '  Cantidad de Vacantes: '.$fila['cantidad_postulantes'].'  y usted a sido afurtunad@ ya que posiblemente sea 1 de los seleccionad@s por favor comunicarse en el menor tiempo posible. <br>';             
              $result5=$Especialidad->cargar_solicitudes_p5($codigo_solicitud);
               while ( $fila5=pg_fetch_array($result5)) {
                    $id_persona=$fila5['valor'];
                    $result6=$Especialidad->cargar_solicitudes_p6($id_persona, $codigo_solicitud);
                    while ( $fila6=pg_fetch_array($result6)) {
                      echo '
                      <br>
                      Persona de Contacto:<br>
                      '.$fila6['nombre'].' '.$fila6['apellido'].' <br>
                      Telefono: '.$fila6['telefono'].' <br>
                      Correo: '.$fila6['correo'].'<br>
                      </span><br>';
                    }
              }

       }
 
echo '<input type="button"  name="Postularme" id="'.$codigo_solicitud.'" class="btn btn-primary btn-large" value="Postularme" >';
echo '<br><label align="right"> Publicación Realizada el '.$fila['fecha_solicitud']. ' </label>';
echo '</div></div>';
}
}
}else{
	echo '
<div id="contenedornoti">
<center><h2 ><span style="font-weight: bold;  color: #000000;">Lo Lamentamos No Tienes Solicitudes :-(</span></h2></center>
</div> ';
}
      }
        
// finde cargar solicitudes especificas

 function CargarRequisitos(){
$Especialidad=new Solicitud();
$result=$Especialidad->cargar_requisitos();
$i=1;
echo'<pre background="red"><table whith="70px" align="center" class="display dataTable">';
echo'<tr>';
while($fila=pg_fetch_array($result))
{

echo "<td style='border: inset 0pt'><label> $fila[1]</td><td style='border: inset 0pt' ><input type='checkbox' class=id_requisito name='nombre_requisito[]' id='$fila[0]'  value='$fila[0]' > </label></td>";
$i=$i+1;


if($i=='5'){
  echo'</tr>';
  echo'<tr>';
  $i=1;
 
}

}
echo'</tr>';
echo'</table></pre>';
        }






        function CargarCatalago_PersonasEspecialidad_Instituto(){


                  $ID_INSTITUCION=$_SESSION['ID_INSTITUCION'];


                    $Especialidad=new Especialidad();
                    $Tipo=new TipoEspecialidad();

                    $Datos=$Especialidad->Consultar_AsignacionEspecialidad_PErsona($ID_INSTITUCION);
                    //CONTADOR PARA INCREMNETAR EL NUMERO DE FILAS-->>>

                    $variable=0;
                        echo'<thead>
                                <tr class="well" >
                                <td colspan="5"><strong ><center>Especialidad</center></strong></td>
                                <td colspan="6"><strong ><center>Personas</center></strong></td>
                                </tr>
                                <tr>
                                    <td ><strong ><center>ID</center></strong></td>
                                    <td><strong><center>Nómbre</center></strong></td>
                                    <td><strong><center>Tipo</center></strong></td>
                                    <td><strong><center>Descripci&oacute;n</center></strong></td>
                                    <td><strong><center>Estado</center></strong></td>
                                    <td><strong><center>Cédula</center></strong></td>
                                    <td><strong><center>Nombre</center></strong></td>
                                    <td><strong><center>Apellido</center></strong></td>
                                    <td><strong><center>Perfil</center></strong></td>
                                    <td><strong><center>Opción</center></strong></td>  
                                </tr>
                        </thead>
                        <tbody >';


                            while ($registro=pg_fetch_array($Datos)) {

                              $id=$registro['id_especialidad'];
                              $nombre_especialidad=$registro['nombre_especialidad'];
                              $id_tipo_especialidad=$registro['id_tipo_especialidad'];
                              $descripcion=$registro['descripcion'];
                              $estatus=$registro['estatus'];

                              //$expediente=$registro['expediente'];
                              $cedula=$registro['cedula'];
                              $nombre=$registro['nombre'];
                              $apellido=$registro['apellido'];
                              $id_perfil=$registro['id_perfil'];
                              if($id_perfil==3){
                                $perfil='Estudiante';

                              }else if($id_perfil==4){
                                $perfil='Tutor Académico';

                              }
                              

                              $nombre_tipo_especialidad=$Tipo->ConsultarNombre_xId($id_tipo_especialidad);
                             
                        echo'<tr>';
                              echo'<td ><center>'.$id.'</center></td>';
                              echo'<td ><center>'.$nombre_especialidad.'</center></td>';
                              echo'<td ><center><input type=hidden class="id_tipo_e" value='.$id_tipo_especialidad.'>'.$nombre_tipo_especialidad.'</center></td>';
                              echo'<td ><center>'.$descripcion.'</center></td>';
                              echo'<td ><center>'.$estatus.'</center></td>';
                              echo'<td ><center>'.$cedula.'</center></td>';
                              echo'<td ><center>'.$nombre.'</center></td>';
                              echo'<td ><center>'.$apellido.'</center></td>';
                              echo'<td ><center>'.$perfil.'</center></td>';
                              echo'<td><center>-----</center></td>
                              
                         </tr>';

                            $variable++;

                            }
            echo'</tbody>';

        }




        
          
  function ConsultarPara_RegistrarPostulacion($Formulario=array()){
           
           $Modelo=new Solicitud();
                                 
            $num=$Modelo->Consultar_ParaRegistrarPostulacion($Formulario); 
            
            if($num==1){
                
                echo json_encode($num);

                }else {

                   $this->Postulacion($Formulario);

                     }
     
        }

        function Postulacion($Formulario=array()){

                $Modelo=new Solicitud();

                  
                $nummer=0;
                $nummer = $Modelo->Incluir_Postulacion($Formulario);


                if( $nummer==0 ) {

                         echo json_encode($nummer);

                }else {
                        $nummer=2;
                        echo json_encode($nummer);
                }
                  
                }



        function Resgistrar_Solicitud($Formulario=array()){

                
            
                       $Modelo=new Solicitud();
                        
                        $num=$Modelo->Incluir_Solicitud($Formulario);

                            
                        echo json_encode($num);


                  
                }
                
          
                
                
                
                //-----MODIFICAR----->>>
                
                 function Modificar_Especialidad($Formulario=array()){
            
                        
                       $Modelo=new Solicitud();
                        
                        $num=$Modelo->Modificar_Solicitud($Formulario);

                            
                            echo json_encode($num);


                  }
                        
                        
                        
                        
                   function Consultar_TiempoReal($Dato){
                       
                         
                        
                            $Modelo=new Especialidad();
                                 
                            $Modelo->Consultar_Nombre_TiempoReal($Dato);     
            
        }
        
        
        
        
        function ConsultarPara_Registrar($Formulario=array()){
            
            

            $Modelo=new Especialidad($Formulario);
                                 
            $num=$Modelo->Consultar_ParaRegistrar($Formulario['id_instituto']); 
            
            if($num==1){
                
                echo json_encode($num);

                }else {

                   $this->Resgistrar_Especialidad($Formulario);

                     }
     
        }
        
        
        
        function ConsultarPara_Modificar($Formulario=array()){
            
            $Modelo=new Especialidad($Formulario);
                                 
            $num=$Modelo->Consultar_ParaModificar($Formulario['id_instituto']); 
            
            if($num==1){
                
                echo json_encode($num);

                }else {

                   $this->Modificar_Especialidad($Formulario);

                     }
        
            
        }



        

        function AsignarEstudiante_Especialidad($Formulario=array()){
            
                        $Modelo=new Especialidad();
                        
                        $num=$Modelo->AsignarEstudiante_EspecialidadBD($Formulario);

                            
                            echo json_encode($num);

                       

                        }

        function AsignarTutorAcademico_Especialidad($Formulario=array()){

        $Modelo=new Especialidad();
        
        $num=$Modelo->AsignarTutorAcademico_EspecialidadBD($Formulario);

            
            echo json_encode($num);

       

        }

        
        
          
          
        }//---FIN DE LA CLASE---
          
          
          
?>