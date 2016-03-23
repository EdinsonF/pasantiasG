<?php
$Ruta=$_POST['Ruta'];
$Nombre=$_POST['Nombre'];

define("maxUpload", 256000);//250 KB
define("uploadURL", $Ruta);
define("fileName", 'foto_');
$fileType = array('image/jpeg', 'image/pjpeg', 'image/png');
// Bandera para procesar imagen
//bandera de error al procesar la imagen
$respuestaFile = false;

// nombre por default de la imagen a subir
$fileName = '';
// error del lado del servidor
$mensajeFile = 'ERROR EN EL SCRIPT';

// Obtenemos los datos del archivo
$ArchivoFoto = $_FILES['userfile'];
$tamanio = $ArchivoFoto['size'];
$tipo = $ArchivoFoto['type'];
$Arreglo = explode('.', $ArchivoFoto['name']);
$Num = count($Arreglo) - 1;
$extension=$Arreglo[$Num];
$NombreArchivo = $Nombre;
if (in_array($tipo, $fileType) &&  $tamanio>0 && $tamanio<=maxUpload && (strtolower($extension) == 'jpg' || strtolower($extension) == 'png'))
{
    // Intentamos copiar el archivo
    if (is_uploaded_file($ArchivoFoto['tmp_name']))
    {
        $ArchivoExt=$NombreArchivo.'.'.$extension;
        $Guarda=uploadURL .'/'.$ArchivoExt;
        if (move_uploaded_file($ArchivoFoto['tmp_name'], $Guarda)) 
        {
            $respuestaFile = 'done';
            $fileName = $ArchivoExt;
            $mensajeFile = $NombreArchivo;
        }
        else 
        {
            // error del lado del servidor
            $mensajeFile = 'No se pudo subir el archivo';
        }
    } 
    else 
    {
        // error del lado del servidor
        $mensajeFile = 'No se pudo subir el archivo';
    }
} 
else 
{
    // Error en el tamaño y tipo de imagen
    $mensajeFile = 'Verifique que el tamaño no supere los 250 kb';
}


$salidaJson = array(
    "respuesta" => $respuestaFile,
    "mensaje" => $mensajeFile,
    "fileName" => $fileName);
//var_dump($salidaJson);
echo json_encode($salidaJson);
?>