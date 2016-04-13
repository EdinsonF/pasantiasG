<?php 
session_start();
include('../reportes/Control_Reportes.php');

    if(isset($_POST['Reporte_Tipo_Solicitud'])){

        

        $Reporte=new Control_Reportes();
        $Reporte->Reporte_T_Solicitud($_SESSION['ID_INSTITUCION'],$_SESSION['nombre_instituto'], $_POST['tipo_solicitud']);

    } else if(isset($_POST['Reporte_Tipo_Empresa'])){

        
    	echo $_POST['tipo_empresa'];
        $Reporte=new Control_Reportes();
        $Reporte->Reporte_T_Empresa($_SESSION['ID_INSTITUCION'],$_SESSION['nombre_instituto'], $_POST['tipo_empresa']);

    }
   