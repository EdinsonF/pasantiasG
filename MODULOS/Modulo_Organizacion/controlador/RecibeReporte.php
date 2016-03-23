<?php 
session_start();

require_once("../reportes/Control_Reportes.php");

if(isset($_POST['Reporte_Postulados'])){

          if(isset($_SESSION['Reporte_Postulados'])){
             unset($_SESSION['Reporte_Postulados']);
             
          } 

        $_SESSION['Reporte_Postulados']=$_POST['Reporte_Postulados'];
       


        echo json_encode($_SESSION['Reporte_Postulados']);


    }else if(isset($_SESSION['Reporte_Postulados'])){

        unset($_SESSION['Reporte_Postulados']);

        $Reporte=new Control_Reportes();
        $Reporte->ReporteGeneralPostulados();
    }





?>