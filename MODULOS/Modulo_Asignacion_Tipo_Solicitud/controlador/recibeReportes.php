<?php
include('reportesController.php');

		if(isset($_GET['General']))
		{
			$clase = new Reportes ();

			$clase->Requisito_General();

		
		}

