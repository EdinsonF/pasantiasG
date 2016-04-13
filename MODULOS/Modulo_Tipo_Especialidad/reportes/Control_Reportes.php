<?php

require_once("mod/reportes.php");
require_once('../../../tcpdf/config/lang/spa.php');
require_once('../../../tcpdf/tcpdf.php');

//require_once('../../../tcpdf-mio/tcpdf.php');






class Control_Reportes{




///////////////////////////////////////////////E S P C I A L I D A D--------------------------------->>>>>
	function Reporte_TipoEspecialidad(){

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

$html = $obj->GenerarReporte_TipoEspecialidad();
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

$pdf->Output('Reporte_TipoEspecialidad.pdf', 'I');
}


}
?>