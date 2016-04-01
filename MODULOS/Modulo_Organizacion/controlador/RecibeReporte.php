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
        $Reporte->ReporteGeneralPostulados($_SESSION['codigo_sucursal']);
    }


/////////////////////////////////////////////////////////////////////

    else if(isset($_POST['PsotuladosAceptados'])){

          if(isset($_SESSION['PsotuladosAceptados'])){
             unset($_SESSION['PsotuladosAceptados']);
             
          } 

        $_SESSION['PsotuladosAceptados']=$_POST['PsotuladosAceptados'];
       


        echo json_encode($_SESSION['PsotuladosAceptados']);


    }else if(isset($_SESSION['PsotuladosAceptados'])){

        unset($_SESSION['PsotuladosAceptados']);

        $Reporte=new Control_Reportes();
        $Reporte->Reporte_PostuladosAceptados($_SESSION['codigo_sucursal']);
    }





?>