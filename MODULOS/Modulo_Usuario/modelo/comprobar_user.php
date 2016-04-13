<?php
require("../../../BASE_DATOS/Conect.php");
//Realizado por: Learning With You!
/***  En nuestro caso usamos una tabla llamada "Usuarios" con 2 campos: id y nombre_usuario ***/

function comprobar_disponibilidad($name)		
//Esta pequeña funcion usa la clase mysql.php para conectarse a la base de datos y realizar la consulta
{
        $pgsql = new pgsql();
        $pgsql->query("SELECT usuario FROM pasantias.usuario WHERE usuario='".$name."'"); 
        if ($pgsql->num_rows() > 0)
              return false;
        else
                return true;
}

if ($_POST['usuario'] != "")						   //Si el campo usuario tiene algo
{
    if (!comprobar_disponibilidad($_POST['usuario'])) // Usuario resgistrado
    {
        echo "0";
    }
    else											  // Usuario No registrado
    {
        echo "1";
    }
}
?>
