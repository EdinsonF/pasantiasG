<?php
	session_name("url_amigable");
	session_start(); //Almacenamos datos del server, script y variables (pasadas por GET)
	$Server=$_SERVER['SERVER_NAME'];
	$Script=$_SERVER['PHP_SELF'];
	$Variables=$_SERVER['QUERY_STRING']; //Verificando si tiene variables por GET

//y no se han pasado datos mediante un form por POST, ya que al redireccionar un post puede ocasionar errores.
//también verificamos que la variable de sesión ‘Listo’, sea diferente a 1, esto nos eviara un bucle infinito.

	if(!empty($Variables) & $_SERVER['REQUEST_METHOD']=='GET' && $_SESSION['Listo']!=1){

//Si tiene variables pasadas por GET se procede a hacer el cambio.
//1. Agrupando $Variables por “variable=valor” en el array $Variable.
$Amigable = '';
$Variable=explode('&',$Variables); 
//2. Sustituyendo “=” por “,” y concadenandolo en variable $Amigable.
for($i=0; $i < count($Variable); $i++){
$Amigable.="/".str_replace("=",",",$Variable[$i]);
} //3. Quitando la extension “.php” a $Script para simular un directorio.

$Dir=str_replace(".php",'',$Script); //4. Generando la URL Amigable.
$URL_AMIGABLE="http://".$Server.$Dir;
//5. Colocando la variable de sesión ‘Listo’ a 1 para evitar el bucle infinito al redireccionar la web.

$_SESSION['Listo']=1;
//6. Redireccionando a la url amigable

header("Location: $URL_AMIGABLE");
// $URL_AMIGABLE;
//7. Exit hará que culmine hasta este punto el script, si no estuviera ‘exit’el script continuaría ejecutándose y llegaría hasta el final del mismo, es decir,
// a la parte donde colocamos a la variable de sesión ‘Listo’ en cero, originándose, entonces un bucle infinito.
exit;

}//Cambie $_URL_BASE por la ruta raiz de su web, ya que al simular la url amigable.
//directorios, hará que no muestre adecuadamente los orígenes de los recursos que llama su página web.

//echo $_URL_BASE="http://".$Server."/pruebas/url_amigable/index.php";
?>
<html>
<head>
<title >URL Amigables</title>
<base href = "<? echo $_URL_BASE; ?>" target="_top" />
</head>
<body>
<!-- Aquí el contenido de su página web -->
</body>
</html>
<?php
//Limpia el posible bucle, es decir, se puede volver a hacer el envío.
$_SESSION['Listo']=0;
function urls_amigables($url) {

		// Tranformamos todo a minusculas

		$url = strtolower($url);

		//Rememplazamos caracteres especiales latinos

		$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');

		$repl = array('a', 'e', 'i', 'o', 'u', 'n');

		$url = str_replace ($find, $repl, $url);

		// Añaadimos los guiones

		$find = array(' ', '&', '\r\n', '\n', '+'); 
		$url = str_replace ($find, '-', $url);

		// Eliminamos y Reemplazamos demás caracteres especiales

		$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');

		$repl = array('', '-', '');

		$url = preg_replace ($find, $repl, $url);

		return $url;

		}
?>
