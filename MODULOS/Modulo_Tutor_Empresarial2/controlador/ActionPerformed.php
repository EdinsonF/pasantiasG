<<<<<<< HEAD
<?php
session_start();

include_once("TutorEmpresarial.php");
require_once("../modelo/TutorEmpresarial.php");




 if(isset($_POST['Registrar'])){
    
    $Control=new Asignacion_Oficina_Controller();
    $Control->Consultar_Para_RegistrarOficina($_POST);
    
      
}else if (isset($_POST['actualiza'])) {
  # code...

    $Control=new Asignacion_Oficina_Controller();
    $Control->ActualizarAsignacion($_POST);

}else if(isset($_POST['Reporte_Mis'])){

        require("../reportes/Control_Reportes.php");


      $Reporte=new Control_Reportes();
      $Reporte->ReporteGeneral_AsignacionesOficinas($_SESSION['codigo_sucursal'],$_SESSION['nombre_organizacion']);



    }else if(isset($_POST['Reporte_PersonasAsignadas'])){

        require("../reportes/Control_Reportes.php");

      $Reporte=new Control_Reportes();
      $Reporte->Reporte_PersonasAsignas_MisOficinas($_SESSION['codigo_sucursal'],$_SESSION['nombre_organizacion']);



    }

=======
<?php
session_start();

include_once("TutorEmpresarial.php");
require_once("../modelo/TutorEmpresarial.php");




 if(isset($_POST['Registrar'])){
    
    $Control=new Asignacion_Oficina_Controller();
    $Control->Consultar_Para_RegistrarOficina($_POST);
    
      
}else if (isset($_POST['actualiza'])) {
  # code...

    $Control=new Asignacion_Oficina_Controller();
    $Control->ActualizarAsignacion($_POST);

}else if(isset($_POST['Reporte_Mis'])){

        require("../reportes/Control_Reportes.php");


      $Reporte=new Control_Reportes();
      $Reporte->ReporteGeneral_AsignacionesOficinas($_SESSION['codigo_sucursal'],$_SESSION['nombre_organizacion']);



    }else if(isset($_POST['Reporte_PersonasAsignadas'])){

        require("../reportes/Control_Reportes.php");

      $Reporte=new Control_Reportes();
      $Reporte->Reporte_PersonasAsignas_MisOficinas($_SESSION['codigo_sucursal'],$_SESSION['nombre_organizacion']);



    }

>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
