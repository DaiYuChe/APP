<?php 
	$file = fopen("000.txt","w+"); //開啟檔案
	fwrite($file,"0000");
//$MyName = $_POST["MyName"];
	$takeImg = $_POST["takeImg"];
//$stopTake = $_POST["stopTake"];
	//$str='d';
	//echo $str;
	$file = fopen("000.txt","w+"); //開啟檔案
	fwrite($file,$takeImg);
	fclose($file);
	//echo $takeImg;
	//echo substr("abc", -3, 1);//a
	//echo substr("abc", -2, 1);//b
	//echo substr("abc", -1, 1);//c
?> 