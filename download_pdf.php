<?php
header('Content-disposition: attachment; filename=cutest_reader.txt');
header('Content-type: application/pdf');
readfile($site_url.'cutest_reader.txt');
?> 