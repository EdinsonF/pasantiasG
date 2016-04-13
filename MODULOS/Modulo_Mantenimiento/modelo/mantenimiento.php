<?php 

class mantenimiento
{

	public function catalagobitacora()
	{

		 $tabla =  pg_query('SELECT  * FROM pasantias.bitacorausuario ;');

		 return $tabla;
	}
	
}
?>