<?php
include ('TipoEspecialidad_Controller.php');
 		if(isset ($_POST['Modificar'])){
       
                $Control=new TipoEspecialidad_Controller();
                
                $Control->Modificar_TipoEspecialidad($_POST);

        //----SI PRESIONA CANCELAR--->>>
          }
?>