<?php
session_start();

include_once("Asignacion_Oficina_Controller.php");
require_once("../modelo/Asignacion_Oficina.php");




 if(isset($_POST['Registrar'])){
    
    $Control=new Asignacion_Oficina_Controller();
    $Control->Consultar_Para_RegistrarOficina($_POST);
    
      
}else if (isset($_POST['actualiza'])) {
  # code...

    $Control=new Asignacion_Oficina_Controller();
    $Control->ActualizarAsignacion($_POST);

}else if(isset( $_POST['Asignare'] )){

           
        $Control=new Asignacion_Oficina_Controller();

        $Control->Consultar_ParaAsignar($_POST);
     

    }else if(isset( $_POST['Restar'] )){
        unset($_SESSION['ID_ORGANIZACION']); 
     
         echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=../../Modulo_Departamento/vista/Gestion_Oficina.php'>";    //Envio hacia Incluir

     

    }else if(isset($_POST['autocompletado'])){

      require_once("../../Modulo_Departamento/modelo/Departamento(Especialidad-Oficina).php");  
      $Especialidad=new Especialidad();
      $Especialidad->ConsultarNombre_Oficinas_AutoComplete();

    }else if(isset($_POST['Tabla_OficinaAsignada'])){
        //------TABLA ESPECIALIDAD LOADING....
        $Modelo=new Asignacion_Oficina();
        $Datos=$Modelo->Consultar_Catalago_OficinaAsignadas($_POST['id_organizacion']);

        $lista=array();
        while($fila=pg_fetch_array($Datos))
          {
            $lista[] = $fila;
          }
          echo json_encode($lista);


    }else if(isset($_POST['Tabla_OficinaAsignar'])){
        //------TABLA ESPECIALIDAD LOADING....
        require_once("../../Modulo_Departamento/modelo/Departamento(Especialidad-Oficina).php");  
        $Especialidad=new Especialidad();
        $Datos=$Especialidad->Consultar_OficinaActiva_Catalago();

        $lista=array();
        while($fila=pg_fetch_array($Datos))
          {
            $lista[] = $fila;
          }
          echo json_encode($lista);


    }else if(isset($_POST['Tabla_OficinaAsignarPersonas'])){
        //------TABLA ESPECIALIDAD LOADING....
        $Modelo=new Asignacion_Oficina();
        $Datos=$Modelo->Consultar_Catalago_OficinaAsignadasACTIVAS($_POST['id_organizacion']);

        $lista=array();
        while($fila=pg_fetch_array($Datos))
          {
            $lista[] = $fila;
          }
          echo json_encode($lista);


    }//REPORTES---->>>>
    else if(isset($_POST['Reporte_Mis'])){

        require("../reportes/Control_Reportes.php");


      $Reporte=new Control_Reportes();
      $Reporte->ReporteGeneral_AsignacionesOficinas($_SESSION['codigo_sucursal'],$_SESSION['nombre_organizacion']);



    }else if(isset($_POST['Reporte_PersonasAsignadas'])){

        require("../reportes/Control_Reportes.php");

      $Reporte=new Control_Reportes();
      $Reporte->Reporte_PersonasAsignas_MisOficinas($_SESSION['codigo_sucursal'],$_SESSION['nombre_organizacion']);



    }

