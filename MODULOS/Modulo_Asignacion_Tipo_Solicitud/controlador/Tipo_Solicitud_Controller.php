<?php

include('../modelo/Tipo_Solicitud.php');

	

class Tipo_Solicitud_Controller{


	public function Registro($formulario = array())
	{

		$class = new Tipo_Solicitud();

		$class->setTipo_Solicitud($formulario);

		$num=0;
		$num=  $class->IncluirTipo_Solicitud();

		return $num;

	}

	// public function ConsultaTiempoReal($formulario = array())
	// {

	// 	$class = new Tipo_Solicitud();

	// 	$consulta = $class->consultNombreTipo_Solicitud($formulario);

	// 	return $consulta;

	//}
	public function Modificar ($formulario = array())
	{
		$class = new Tipo_Solicitud();

		$update = $class->ActualizaTipo_Solicitud($formulario);

		return $update;
	}

	public function cargarCatal()
	{

		$class = new Tipo_Solicitud();
		$result = $class->consultTipo_Solicitud( );
					echo"<thead class="."well".">
                     <tr >
                        <td><strong ><center>"."ID"."</center></strong></td>
                        <td><strong><center>"."Nombre"."</center></strong></td>
                        <td><strong><center>"."Estatus"."</center></strong></td>
                        <td><strong><center>"."Opci&oacute;n"."</center></strong></td>
                       
                    </tr>
               		</thead>";;
		                while($fila=pg_fetch_array($result))
                {	

							
				echo " <tr class=Tipo_Solicitud onclick=seleccionarfila(this); >
						<td class=id_tipo_solicitud ><center >".$fila['id_tipo_solicitud']."</center></td>
						
						<td class=nombre_tipo_solicitud><center >".$fila['nombre_tipo_solicitud']."</center></td>
						<td class=estatus><center >".$fila['estatus']."</center></td>
					<td   ><center>
					
					<a href=#><img src=../vista/icon/editarsmol.png alt=Ginger class=left width=10% ./>
                    </a>     
                 	</center>
                    </td>
						
						
				</tr> ";;
							
				} if (pg_num_rows($result)== 0){

					echo " <tr class=estado onclick=seleccionarfila(this); >
						<td class=id_tipo_solicitud ><center ></center></td>
						
						<td class=nombre_tipo_solicitud><center ></center></td>
						<td class=estatus><center ></center></td>
					<td   ><center>
					
                 	</center>
                    </td>
						
						
				</tr> ";;

				}


	}

	public function catalFiltro( $arreglo = array() )
	{

	$class = new Tipo_Solicitud();

	$result= $class->tablaTipo_SolicitudFiltro($arreglo);

			    echo"<thead class="."well".">
                     <tr >
                        <td><strong ><center>"."ID"."</center></strong></td>
                        <td><strong><center>"."Nombre"."</center></strong></td>
                        <td><strong><center>"."Estatus"."</center></strong></td>
                        <td><strong><center>"."Opci&oacute;n"."</center></strong></td>
                       
                    </tr>
               		</thead>";;
                while($fila=pg_fetch_array($result))
                {	

							
				echo " <tr class=tipo_solicitud onclick=seleccionarfila(this);  >
						<td class=id_tipo_solicitud ><center >".$fila['id_tipo_solicitud']."</center></td>
						
						<td class=nombre_tipo_solicitud><center >".$fila['nombre_tipo_solicitud']."</center></td>
						<td class=estatus><center >".$fila['estatus']."</center></td>
						<td   ><center>
					
					<a href=#><img src=../vista/icon/editarsmol.png alt=Ginger class=left width=10% ./>
                    </a>     
                 	</center>
                    </td>
						
						
				</tr> ";;
							
				}


	}

	public function selectTipo_Solicitud()
	{

			$class = new Tipo_Solicitud();
			$execute = $class->registrosTipo_SolicitudSelect(  );


		while($fila = pg_fetch_array($execute)){
	
		echo "<option value='".$fila['id_tipo_solicitud']."'>".$fila['nombre_tipo_solicitud']."</option>";

		
			}

	}

}

?>