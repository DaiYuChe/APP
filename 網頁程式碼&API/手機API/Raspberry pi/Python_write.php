
<?php
   //header("Content-Type:text/html; charset=utf-8");
   $MyName = $_POST["MyName"];
   $MyMessage = $_POST["MyMessage"];
	echo "Your name is:" . $MyName."\n";
   echo "The message is : "  . $MyMessage ;
	$file = fopen("000.txt","w+"); //¶}±ÒÀÉ®×
	fwrite($file, $MyName;);

	fclose($file);
   
?>  
   
   
 