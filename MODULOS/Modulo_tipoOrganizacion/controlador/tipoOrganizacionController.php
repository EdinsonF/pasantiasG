<?php

include('../modelo/tipoOrganizacion.php');




class tipoOrganizacionController{


	public function Registro($arr =array() ){


		$class = new tipoOrganizacion();
		$num=0;
		$class->SetFormulario($arr);
		$num=  $class->Incluir( );

	return $num;
	
    }

    public function Modificar ( $formulario = array())
    {
    		$class = new tipoOrganizacion();
    		return  $class->ModificartipoOrganizacion($formulario);

    }

    public function tablaFiltro( $arr = array() )
    {

	$class = new tipoOrganizacion();

	$execute= $class->RegistrosT1($arr ); // DESDE  EL CAMPO DE TEXTO

	$Data = array();
	while($fila=pg_fetch_array($execute))
	    {
	    	$Data[] = $fila;
	    }
	    return $Data;

    }

    public function BusquedaTipo($arra = array())
    {

    		$clas = new tipoOrganizacion();
    		 $return= $clas->BuscandoEsteTipo($arra);
    		return $return;
    }



}


?>