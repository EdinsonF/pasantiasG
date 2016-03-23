<?php
include('reportesControllerTS.php');

		if(isset($_GET['General']))
		{
			$clase = new Reportes ();

			$clase->Tipo_Solicitud_General();

		
		}

