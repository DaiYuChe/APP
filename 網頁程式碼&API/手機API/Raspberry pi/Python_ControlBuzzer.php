<?php 

	//fwrite($file,"-1");
	$BuzzerState = $_POST["BuzzerState"];
	$file = fopen("getBuzzerData.txt","w+"); //�}���ɮ�
	fwrite($file,$BuzzerState);
	fclose($file);
	echo $BuzzerState;
?> 