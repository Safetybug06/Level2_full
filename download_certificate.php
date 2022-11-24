<?php
	include 'config.php';
	
	if (isset($_SESSION['fullname']) && !empty($_SESSION['fullname'])) {
		$filename = (str_replace(' ', '_', $_SESSION['fullname'])).'-'.date('d-m-Y').'.pdf';
		$pdf_file = 'temp/'.$filename;
		if (is_file($pdf_file)) {			
			header('Content-Transfer-Encoding: binary');  // For Gecko browsers mainly
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($pdf_file)) . ' GMT');
			header('Accept-Ranges: bytes');  // For download resume
			header('Content-Length: ' . filesize($pdf_file));  // File size
			header('Content-Encoding: none');
			header('Content-Type: application/pdf');  // Change this mime type if the file is not PDF
			header('Content-Disposition: attachment; filename=' . $filename);  // Make the browser display the Save As dialog
			readfile($pdf_file);  //this is necessary in order to get it to actually download the file, otherwise it will be 0Kb
			
			exit;
		}
	}
	
	header('HTTP/1.0 404 Not Found');
	exit;
?>
