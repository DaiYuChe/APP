<?php
    $host  = "localhost";
	$user = "nhu1403";
	$pass = "XWXKM188";
	$db = "nhu1403";
	$con = mysqli_connect($host,$user,$pass,$db);
   header("Content-Type:text/html; charset=utf-8");
   
   $MyName = $_POST["MyName"];
   $MyMessage = $_POST["MyMessage"];
   
   $sql = "select * from name WHERE `use`='".$MyName."';";

	$res = mysqli_query($con,$sql);
	//String $getPass = null;
	if($MyName != "nhu1403"){
		while($row=mysqli_fetch_array($res)){
			//echo $row[0]."   |   ";
			//echo base64_decode($row[1])."   |   ";
			//echo $row[2]."\n";
			$getPass = base64_decode($row[1]);
		}
	}
	else {
		echo "It' a root account!!You don't have any permission to find!!";
		break;
	}
   //echo $getPass;
   //echo "My name is :" . $MyName ;
   //echo "My name is :" . $MyName  . "\nMessage of sending is : "  . $MyMessage ;
   mysqli_close($con);
   
   
 if($getPass != null){
 require 'PHPMailer-master/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();
$mail->CharSet = "utf-8";   
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "10224015@nhu.edu.tw";

//Password to use for SMTP authentication
$mail->Password = "QAZwsx753";

//Set who the message is to be sent from
$mail->setFrom('10224015@nhu.edu.tw', 'PasswordFoundSystem');

//Set an alternative reply-to address
//$mail->addReplyTo('10224015@nhu.edu.tw', 'First Last');

//Set who the message is to be sent to
//$mail->addAddress('w123a567@yahoo.com.tw', 'warm');
//$mail->addAddress('tony7962845@yahoo.com.tw', '');
$mail->addAddress($MyMessage, '');

//Set the subject line
$mail->Subject = 'PasswordFoundSystem';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

//Replace the plain text body with one created manually

$mail->Body = "使用者: $MyName 您好<br>"."您的密碼是 : $getPass";

//$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment($_COOKIE["use"].'-'.$_COOKIE["no"].'.jpg');
//$mail->addAttachment('0.gif');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
 }
 else{
	 echo "No this username!";
 }
   
 
?>  