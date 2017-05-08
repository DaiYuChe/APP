<?php 

	//fwrite($file,"-1");
	$BuzzerState = $_POST["BuzzerState"];
	$file = fopen("getBuzzerData.txt","w+"); //¶}±ÒÀÉ®×
	fwrite($file,$BuzzerState);
	fclose($file);
	echo $BuzzerState;
?> 