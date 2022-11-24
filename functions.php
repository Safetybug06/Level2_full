<?php
function generateserialno($is_demo = false) {
	if ($is_demo)
		$number1='DEMO';
	else
		$number1=rand(1000,9999);
	$number2=rand(1000,9999);
	$number3=rand(1000,9999);
	$number4=rand(1000,9999);
	$random=$number1.$number2.$number3.$number4;	
	$sql="select serial from user where serial='$random'";	
	$retval=mysql_query($sql) or die(mysql_error().' in '.$sql);
	$row=mysql_num_rows($retval);
	
	if($row) {
		$random=generateserialno($is_demo);
	}  // else {
	return $random;
}
//}

function getUniqueSecurityCode ()
{
    // return 8 digit random number
    return sprintf("%08d", mt_rand(1, 999999));
}



function send_email($to, $from, $host, $port, $user, $pass, $company, $subject, $message){
    
    
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = true;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $host;  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $user;                 // SMTP username
        $mail->Password = $pass;                           // SMTP password
        $mail->SMTPSecure = false;                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $port;                                    // TCP port to connect to
    
        //Recipients
        $mail->setFrom($from, $company);
        $mail->addAddress($to);     // Add a recipient
        $mail->addReplyTo($from, $company);
    
        //Attachments
       // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
       // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        return true;
    } catch (Exception $e) {
        $error = 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
        return false;
    }

    
}


function send_email_with_attachment($to, $from, $host, $port, $user, $pass, $company, $subject, $message, $cc, $attachment){
    
    
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = true;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $host;  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $user;                 // SMTP username
        $mail->Password = $pass;                           // SMTP password
        $mail->SMTPSecure = false;                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $port;                                    // TCP port to connect to
    
        //Recipients
        $mail->setFrom($from, $company);
        $mail->addAddress($to);     // Add a recipient
        $mail->addReplyTo($from, $company);
        $mail->addCC($cc);
        //Attachments
        $mail->addAttachment($attachment);         // Add attachments
       // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        return true;
    } catch (Exception $e) {
        $error = 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
        return false;
    }

    
}



function formatserialno($serial) {

	$serialno=str_split($serial,4);
	
	$serial=implode('-', $serialno);
	
	
	
	 return $serial;
}
function generatepassword()
	{

		$firstpart="BUG-";
		$alphabets=array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
		$password=$firstpart.rand(10000,99999)."-".$alphabets[rand(0,25)];
		return $password;
	}

function generateAdminPassword()
	{
		$firstpart="SB-";
		$alphabets=array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
		$secondPart = '';
		for ($i = 0; $i < 4; $i++) {
			$secondPart .= $alphabets[rand(0,25)];
//	$secondPart .= $alphabets[rand(0,count($alphabets))];
		}
		$password=$firstpart.$secondPart.'-'.rand(10000,99999);
		return $password;
	}


function getOrderPrice($users) {
         global $prices;
         foreach($prices as $key=>$value) {
         if($users <= (int)$key) {
         $unit_price = $value;
         break;
	}
}
return $users * $unit_price;
}


function log_message($type, $message) { 
}


// prev. order payment



function check_email_address($email) {
    // First, we check that there's one @ symbol, and that the lengths are right
    if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
        return false;
    }
    // Split it into sections to make life easier
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
         if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
            return false;
        }
    }    
    if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
        }
        for ($i = 0; $i < sizeof($domain_array); $i++) {
            if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
                return false;
            }
        }
    }
    return true;
}

function is_email($email) {
    // Checks for proper email format
    if (!preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", $email)) {
        return false;
    } else {
        return true;
    }
}
function generate_pdf($details=array(),$pdf_file,$completion_date='')
{		
		if($completion_date=='')
		$completion_date = date('d-m-Y');
		global $module_dir;
		require_once(dirname(__FILE__)."/fpdf/fpdf.php");
		$pdf = new FPDF('L');
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',20);
		if (DEMO_MODE)
			$pdf->Image('course/fsl2/certificate/cert-demo.jpg',0,0);
		elseif ($details['course'] == '2')
			$pdf->Image('course/allergen/certificate/cert.jpg',0,0);
		elseif ($details['course'] == '3')
			$pdf->Image('course/haccp/certificate/cert.jpg',0,0);
		elseif ($details['course'] == '4')
			$pdf->Image('course/healthSafety/certificate/cert.jpg',0,0);
		elseif ($details['course'] == '5')
			$pdf->Image('course/manualhandling/certificate/cert.jpg',0,0);
		elseif ($details['course'] == '6')
			$pdf->Image('course/corona/certificate/cert.jpg',0,0);
		elseif ($details['course'] == '7')
			$pdf->Image('course/coshh/certificate/cert.jpg',0,0);
		else
			$pdf->Image('course/fsl2/certificate/cert.jpg',0,0);
		// encode name into UTF 8
		$nameCert = $details['name'];
		$nameCertUTF8 =	utf8_decode($nameCert); 
    	$pdf->Text(140,73, $nameCertUTF8);
	    // $pdf->Text(140,73, $details['name']);
		$pdf->SetFont('Arial','',20);
		$pdf->Text(134,158, $completion_date);
		
		$pdf->SetFont('Arial','',14);
		
		$pdf->Text(204,177, formatserialno($details['serial']));
		
		
		
		$pdf->Output($pdf_file);
}

?>