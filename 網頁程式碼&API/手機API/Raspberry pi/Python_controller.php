<?php 
	$file = fopen("000.txt","w+"); //開啟檔案
	fwrite($file,"0000000");
//$MyName = $_POST["MyName"];
	$BuzzerState = $_POST["BuzzerState"];
	//$str='d';
	//echo $str;
	$file = fopen("000.txt","w+"); //開啟檔案
	fwrite($file,$BuzzerState);
	fclose($file);
	echo $BuzzerState;
	//echo substr("abc", -3, 1);//a
	//echo substr("abc", -2, 1);//b
	//echo substr("abc", -1, 1);//c
?> 