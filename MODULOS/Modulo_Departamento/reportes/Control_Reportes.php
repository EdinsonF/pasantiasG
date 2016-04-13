<?php

require_once("mod/reportes.php");
require_once('../../../tcpdf/config/lang/spa.php');
require_once('../../../tcpdf/tcpdf.php');

//require_once('../../../tcpdf-mio/tcpdf.php');






class Control_Reportes{




///////////////////////////////////////////////E S P C I A L I D A D--------------------------------->>>>>
	function ReporteGeneral_Especialidades($id_institutoP,$nombre_i){

	$obj= new reportes();

	$perfil="";
	
	$pdf=new TCPDF('p', PDF_UNIT, PDF_FORMAT, true, 'UTF-8', false);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('UPTABY Grupo-Sistema_YENEJ');
$pdf->SetTitle('ReportePDF');
$pdf->SetSubject('PNFInformatica');
$pdf->SetKeywords('Reporte, usuario, php, postgres');

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins('5', '26', '3');//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetHeaderData('logo-encabezado.jpg','202');
$pdf->SetFooterMargin('10');//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetHeaderMargin('10');//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

$pdf->SetFont('helvetica', '', 9, '', true);

// Add a page 
// This method has several options, check the source code documentation for more information.
$pdf->setPrintHeader(true); //no imprime la cabecera ni la linea 
$pdf->setPrintFooter(true); // imprime el pie ni la linea 

$pdf->AddPage();
//*************
  ob_end_clean();//rompimiento de pagina
//************* 

$html = $obj->GenerarReporteEspecialidad($id_institutoP,$nombre_i);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

$pdf->Output('Reporte_Especialidad.pdf', 'I');
}




function Reporte_Espec_Tipo($id_institutoP,$nombre_i,$id_tipoE){

	$obj= new reportes();

	$perfil="";
	
	$pdf=new TCPDF('p', PDF_UNIT, PDF_FORMAT, true, 'UTF-8', false);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('UPTABY Grupo-Sistema_YENEJ');
$pdf->SetTitle('ReportePDF');
$pdf->SetSubject('PNFInformatica');
$pdf->SetKeywords('Reporte, usuario, php, postgres');

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins('5', '26', '3');//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetHeaderData('logo-encabezado.jpg','202');
$pdf->SetFooterMargin('10');//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetHeaderMargin('10');//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

$pdf->SetFont('helvetica', '', 9, '', true);

// Add a page 
// This method has several options, check the source code documentation for more information.
$pdf->setPrintHeader(true); //no imprime la cabecera ni la linea 
$pdf->setPrintFooter(true); // imprime el pie ni la linea 

$pdf->AddPage();
//*************
  ob_end_clean();//rompimiento de pagina
//************* 

$html = $obj->GenerarReporteEspecialidad_Tipo($id_institutoP,$nombre_i,$id_tipoE);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

$pdf->Output('Reporte_PorTipo_Especialidad.pdf', 'I');
}





function Reporte_HistorialEspecialidad($id_institutoP,$nombre_i){

	$obj= new reportes();

	$perfil="";
	
	$pdf=new TCPDF('p', PDF_UNIT, PDF_FORMAT, true, 'UTF-8', false);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('UPTABY Grupo-Sistema_YENEJ');
$pdf->SetTitle('ReportePDF');
$pdf->SetSubject('PNFInformatica');
$pdf->SetKeywords('Reporte, usuario, php, postgres');

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins('5', '26', '3');//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetHeaderData('logo-encabezado.jpg','202');
$pdf->SetFooterMargin('10');//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetHeaderMargin('10');//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

$pdf->SetFont('helvetica', '', 9, '', true);

// Add a page 
// This method has several options, check the source code documentation for more information.
$pdf->setPrintHeader(true); //no imprime la cabecera ni la linea 
$pdf->setPrintFooter(true); // imprime el pie ni la linea 

$pdf->AddPage();
//*************
  ob_end_clean();//rompimiento de pagina
//************* 

$html = $obj->GenerarReporte_HistorialEspecialidades($id_institutoP,$nombre_i);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

$pdf->Output('Reporte_HistorialEspecialidad.pdf', 'I');
}



function Reporte_PersonasAsignas_MisEspecilidades($id_institutoP, $nombre_organizacion){

	$obj= new reportes();

	$perfil="";
	
	$pdf=new TCPDF('l', PDF_UNIT, PDF_FORMAT, true, 'UTF-8', false);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('UPTABY Grupo-Sistema_YENEJ');
$pdf->SetTitle('ReportePDF');
$pdf->SetSubject('PNFInformatica');
$pdf->SetKeywords('Reporte, usuario, php, postgres');

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins('5', '35', '3');//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetHeaderData('logo-encabezado.jpg','288');
$pdf->SetFooterMargin('10');//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetHeaderMargin('10');//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

$pdf->SetFont('helvetica', '', 9, '', true);

// Add a page 
// This method has several options, check the source code documentation for more information.
$pdf->setPrintHeader(true); //no imprime la cabecera ni la linea 
$pdf->setPrintFooter(true); // imprime el pie ni la linea 

$pdf->AddPage();
//*************
  ob_end_clean();//rompimiento de pagina
//************* 

$html = $obj->GenerarReporte_PersonasAsignadas_MisEspecialidades($id_institutoP, $nombre_organizacion);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

$pdf->Output('Reporte_PersonasAsignadas_MisEspecialidades.pdf', 'I');
}



function Reporte_PersonasAsignas_Fecha($id_institutoP, $fecha_i, $fecha_f){

	$obj= new reportes();

	$perfil="";
	
	$pdf=new TCPDF('l', PDF_UNIT, PDF_FORMAT, true, 'UTF-8', false);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('UPTABY Grupo-Sistema_YENEJ');
$pdf->SetTitle('ReportePDF');
$pdf->SetSubject('PNFInformatica');
$pdf->SetKeywords('Reporte, usuario, php, postgres');

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins('5', '35', '3');//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetHeaderData('logo-encabezado.jpg','288');
$pdf->SetFooterMargin('10');//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetHeaderMargin('10');//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

$pdf->SetFont('helvetica', '', 9, '', true);

// Add a page 
// This method has several options, check the source code documentation for more information.
$pdf->setPrintHeader(true); //no imprime la cabecera ni la linea 
$pdf->setPrintFooter(true); // imprime el pie ni la linea 

$pdf->AddPage();
//*************
  ob_end_clean();//rompimiento de pagina
//************* 

$html = $obj->GenerarReporte_PersonasAsignadas_MisEspecialidades_PorFecha($id_institutoP, $fecha_i, $fecha_f);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

$pdf->Output('Reporte_PersonasAsignadas_MisEspecialidades_PorFecha.pdf', 'I');
}

























////////////////////////////////////////////////////O F I C I N A ------------------------------------------>>>>>>>



function ReporteGeneral_Oficinas($id_sucursal,$nombre_instituto){

	$obj= new reportes();

	$perfil="";
	
	$pdf=new TCPDF('p', PDF_UNIT, PDF_FORMAT, true, 'UTF-8', false);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('UPTABY Grupo-Sistema_YENEJ');
$pdf->SetTitle('ReportePDF');
$pdf->SetSubject('PNFInformatica');
$pdf->SetKeywords('Reporte, usuario, php, postgres');

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins('5', '26', '3');//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetHeaderData('logo-encabezado.jpg','202');
$pdf->SetFooterMargin('10');//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetHeaderMargin('10');//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);




//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

$pdf->SetFont('helvetica', '', 9, '', true);

// Add a page 
// This method has several options, check the source code documentation for more information.
$pdf->setPrintHeader(true); //no imprime la cabecera ni la linea 
$pdf->setPrintFooter(true); // imprime el pie ni la linea 

$pdf->AddPage();
//*************
  ob_end_clean();//rompimiento de pagina
//************* 

$html = $obj->GenerarReporteOficinas($id_sucursal,$nombre_instituto);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

$pdf->Output('Reporte_Oficinas.pdf', 'I');
}




function Reporte_HistorialOfcinas($id_sucursal,$nombre_instituto){

	$obj= new reportes();

	$perfil="";
	
	$pdf=new TCPDF('p', PDF_UNIT, PDF_FORMAT, true, 'UTF-8', false);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('UPTABY Grupo-Sistema_YENEJ');
$pdf->SetTitle('ReportePDF');
$pdf->SetSubject('PNFInformatica');
$pdf->SetKeywords('Reporte, usuario, php, postgres');

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins('5', '26', '3');//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetHeaderData('logo-encabezado.jpg','202');
$pdf->SetFooterMargin('10');//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetHeaderMargin('10');//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);




//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

$pdf->SetFont('helvetica', '', 9, '', true);

// Add a page 
// This method has several options, check the source code documentation for more information.
$pdf->setPrintHeader(true); //no imprime la cabecera ni la linea 
$pdf->setPrintFooter(true); // imprime el pie ni la linea 

$pdf->AddPage();
//*************
  ob_end_clean();//rompimiento de pagina
//************* 

$html = $obj->GenerarReporte_HistorialOficinas($id_sucursal,$nombre_instituto);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

$pdf->Output('Historial_Oficinas.pdf', 'I');
}




function Reporte_PersonasAsignas_MisOficinas($id_organizacion, $nombre_organizacion){

	$obj= new reportes();

	$perfil="";
	
	$pdf=new TCPDF('l', PDF_UNIT, PDF_FORMAT, true, 'UTF-8', false);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('UPTABY Grupo-Sistema_YENEJ');
$pdf->SetTitle('ReportePDF');
$pdf->SetSubject('PNFInformatica');
$pdf->SetKeywords('Reporte, usuario, php, postgres');

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins('5', '35', '3');//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetHeaderData('logo-encabezado.jpg','288');
$pdf->SetFooterMargin('10');//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetHeaderMargin('10');//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

$pdf->SetFont('helvetica', '', 9, '', true);

// Add a page 
// This method has several options, check the source code documentation for more information.
$pdf->setPrintHeader(true); //no imprime la cabecera ni la linea 
$pdf->setPrintFooter(true); // imprime el pie ni la linea 

$pdf->AddPage();
//*************
  ob_end_clean();//rompimiento de pagina
//************* 

$html = $obj->GenerarReporte_PersonasAsignadas_MisOficinas($id_organizacion, $nombre_organizacion);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

$pdf->Output('Reporte_PersonasAsignadas_MisOficinas.pdf', 'I');
}





function Reporte_PersonasAsignas_MisOficinas_Fecha($id_organizacion, $fecha_i, $fecha_f){

	$obj= new reportes();

	$perfil="";
	
	$pdf=new TCPDF('l', PDF_UNIT, PDF_FORMAT, true, 'UTF-8', false);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('UPTABY Grupo-Sistema_YENEJ');
$pdf->SetTitle('ReportePDF');
$pdf->SetSubject('PNFInformatica');
$pdf->SetKeywords('Reporte, usuario, php, postgres');

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins('5', '35', '3');//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetHeaderData('logo-encabezado.jpg','288');
$pdf->SetFooterMargin('10');//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetHeaderMargin('10');//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

$pdf->SetFont('helvetica', '', 9, '', true);

// Add a page 
// This method has several options, check the source code documentation for more information.
$pdf->setPrintHeader(true); //no imprime la cabecera ni la linea 
$pdf->setPrintFooter(true); // imprime el pie ni la linea 

$pdf->AddPage();
//*************
  ob_end_clean();//rompimiento de pagina
//************* 

$html = $obj->GenerarReporte_PersonasAsignadas_MisOficinasFecha($id_organizacion, $fecha_i, $fecha_f);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

$pdf->Output('Reporte_PersonasAsignadas_MisOficinas.pdf', 'I');
}





}
?>