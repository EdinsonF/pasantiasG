<?php

include('../modelo/Requisito.php');


class requisitoController{


	public function Registro($formulario = array())
	{

	$class = new requisito();

	$class->setFormulario($formulario);

	return   $class->IncluirRequisito();
	
	}

	public function actualiza( $formulario = array() )
	{

		$class = new requisito();

		
			
		return $class->ActualizarRequisito($formulario);

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
			<tr class=requisito onclick=seleccionarfila(this);>

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

	public function buscarNombre( $consulta =array()  )
	{

		$class = new requisito();

		$result= $class->consultaNombreRequisito($consulta);

		return $result ;

	}

	public function cargarTablaFil( $arreglo = array() )
	{

		$class = new requisito(); 


	$result= $class->registrosrequisito($arreglo);

								echo"<thead  class="."well".">
                     <tr >
                    <td><strong ><center>"."ID"."</center></strong></td>
                    <td><strong><center>"."Nombre "."</center></strong></td>
                    <td><strong><center>"."Estatus"."</center></strong></td>
                    <td><strong><center>"."Opci&oacute;n"."</center></strong></td>
                   
                    </tr>
               		</thead> <tbody>";;

                while($Column=pg_fetch_array($result))
                {	
							
			echo "  
					<tr class=requisito onclick=seleccionarfila(this);>
					<td class=id_requisito ><center >".$Column['id_requisito']."</center></td>				
					<td class=nombre_requisito ><center >".$Column['nombre_requisito']."</center></td>

					<td class=estatus><center >".$Column['estatus']."</center></td>
					<td   ><center>
					
					<a href=#><img src=../vista/icon/editarsmol.png alt=Ginger class=left width=20 ./>
                    </a>     
                 	</center>
                    </td>
												
				</tr> ";
							
				}
				echo'</tbody>';

	}

}

?>