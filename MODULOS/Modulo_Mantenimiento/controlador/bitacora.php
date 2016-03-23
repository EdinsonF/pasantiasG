<?php 

include ('../modelo/mantenimiento.php');


class bitacora
{

	function tabla()
	{

	
            $class= new  mantenimiento();

            $tabla = $class->catalagobitacora();

            while ( $fila= pg_fetch_array($tabla))
            {

                               echo'<tr >
                                    <td><center>'.$fila[3].'</center> </td>
                                    <td><center>'.$fila[1].'</center>  </td>
                                    <td><center>'.$fila[5].'</center> </td>
                                    <td><center>'.$fila[2].'</center> </td>
                                    <td><center>'.$fila[6].'</center></td>
                                    <td><center>'.$fila[7].'</center></td>
                                  </tr>';
            }		
	}
}


?>