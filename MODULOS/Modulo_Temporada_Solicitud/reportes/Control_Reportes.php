<<<<<<< HEAD
<?php

require_once("mod/reportes.php");
require_once('../../../tcpdf/config/lang/spa.php');
require_once('../../../tcpdf/tcpdf.php');

//require_once('../../../tcpdf-mio/tcpdf.php');

class Control_Reportes{

function Reporte_EspecificoTemporada($codigo_temporada_especialidad){

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

$html = $obj->GenerarReporte_EspecificoTemporada($codigo_temporada_especialidad);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

$pdf->Output('Reporte_Especifico_Temporada.pdf', 'I');
}




function Reporte_GeneralTemporada($codigo_temporada){

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

$html = $obj->GenerarReporte_GeneralTemporada($codigo_temporada);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

$pdf->Output('Reporte_GeneralTemporada.pdf', 'I');
}




function Reporte_DetalleTemporada($codigo_temporada){

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

		$html = $obj->GenerarReportedeEncargadodeInstituto($codigo_temporada);
		$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

		$pdf->Output('Reporte_Encargados_Instituto.pdf', 'I');
}

function ESTUDIANTES_NO_POSTULADOS($codigo_temporada_especialidad)
{
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

		$html = $obj->GenerarReportedeEstudiantes_noPostulados($codigo_temporada_especialidad);
		$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

		$pdf->Output('Reporte_No_Postulados.pdf', 'I');
}


	function REPORTE_ESTUDIANTES_TUTORES($codigo_temporada_especialidad)
	{

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

	$html = $obj->GenerarReportedeEstudiantes_Con_tutores($codigo_temporada_especialidad);
	$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

	$pdf->Output('Reporte_Estudiantes_con_tutores.pdf', 'I');

	}

	function REPORTE_POSTULADOS( $codigo_temporada_especialidad )
	{
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

	$html = $obj->GenerarReportedeEstudiantes_Postulados($codigo_temporada_especialidad);
	$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

	$pdf->Output('Reporte_Estudiantes_postulados.pdf', 'I');
	}



	function REPORTE_APROBADOS( $codigo_temporada_especialidad )
	{

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

	$html = $obj->GenerarReportedeEstudiantes_Aprobados($codigo_temporada_especialidad);
	$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

	$pdf->Output('Reporte_Estudiantes_Aprobados.pdf', 'I');
	}

	function REPORTE_SIN_TUTOR( $codigo_temporada_especialidad )
	{

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

	$html = $obj->GenerarReportedeEstudiantes_Aprobados_Sin_Tutor($codigo_temporada_especialidad);
	$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

	$pdf->Output('Reporte_Estudiantes_Sin_Tutor.pdf', 'I');
	}
}
=======
<?php

require_once("mod/reportes.php");
require_once('../../../tcpdf/config/lang/spa.php');
require_once('../../../tcpdf/tcpdf.php');

//require_once('../../../tcpdf-mio/tcpdf.php');

class Control_Reportes{

function Reporte_EspecificoTemporada($codigo_temporada_especialidad){

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

$html = $obj->GenerarReporte_EspecificoTemporada($codigo_temporada_especialidad);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

$pdf->Output('Reporte_Especifico_Temporada.pdf', 'I');
}




function Reporte_GeneralTemporada($codigo_temporada){

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

$html = $obj->GenerarReporte_GeneralTemporada($codigo_temporada);
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

$pdf->Output('Reporte_GeneralTemporada.pdf', 'I');
}




function Reporte_DetalleTemporada($codigo_temporada){

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

		$html = $obj->GenerarReportedeEncargadodeInstituto($codigo_temporada);
		$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

		$pdf->Output('Reporte_Encargados_Instituto.pdf', 'I');
}

function ESTUDIANTES_NO_POSTULADOS($codigo_temporada_especialidad)
{
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

		$html = $obj->GenerarReportedeEstudiantes_noPostulados($codigo_temporada_especialidad);
		$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

		$pdf->Output('Reporte_No_Postulados.pdf', 'I');
}


	function REPORTE_ESTUDIANTES_TUTORES($codigo_temporada_especialidad)
	{

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

	$html = $obj->GenerarReportedeEstudiantes_Con_tutores($codigo_temporada_especialidad);
	$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

	$pdf->Output('Reporte_Estudiantes_con_tutores.pdf', 'I');

	}

	function REPORTE_POSTULADOS( $codigo_temporada_especialidad )
	{
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

	$html = $obj->GenerarReportedeEstudiantes_Postulados($codigo_temporada_especialidad);
	$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

	$pdf->Output('Reporte_Estudiantes_postulados.pdf', 'I');
	}



	function REPORTE_APROBADOS( $codigo_temporada_especialidad )
	{

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

	$html = $obj->GenerarReportedeEstudiantes_Aprobados($codigo_temporada_especialidad);
	$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

	$pdf->Output('Reporte_Estudiantes_Aprobados.pdf', 'I');
	}

	function REPORTE_SIN_TUTOR( $codigo_temporada_especialidad )
	{

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

	$html = $obj->GenerarReportedeEstudiantes_Aprobados_Sin_Tutor($codigo_temporada_especialidad);
	$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='center', $autopadding=true);

	$pdf->Output('Reporte_Estudiantes_Sin_Tutor.pdf', 'I');
	}
}
>>>>>>> 5c2d1cc2998a4740e76c5d5ccb12eccefda7e905
?>