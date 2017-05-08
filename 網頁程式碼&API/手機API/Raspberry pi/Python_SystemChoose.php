<?php 
	$file = fopen("000.txt","w+"); //開啟檔案
	fwrite($file,"0000000");
//$MyName = $_POST["MyName"];
	$SystemState = $_POST["SystemState"];
	//$str='d';
	//echo $str;
	$file = fopen("000.txt","w+"); //開啟檔案
	fwrite($file,$SystemState);
	fclose($file);
	echo $SystemState;
	//echo substr("abc", -3, 1);//a
	//echo substr("abc", -2, 1);//b
	//echo substr("abc", -1, 1);//c
?> 