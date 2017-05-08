<?php
	header("Content-Type:text/html; charset=utf-8");
	mysql_query("SET NAMES 'UTF8'");
	
	$host  = "localhost";
	$user = "nhu1403";
	$pass = "XWXKM188";
	$db = "nhu1403";
	$con = mysqli_connect($host,$user,$pass,$db);
	
	$Username = $_POST["Username"];
	$ProblemMessage = $_POST["ProblemMessage"];
	$date = date('Y/m/d H:i:s', mktime(date('H'), date('i')-6.5, date('s'), date('m'), date('d'), date('Y')));
	
	$sql ="INSERT INTO `ProblemRecord` (`Username` , `ProblemMessage` , `MessageTime` )";
	$sql.="VALUES ('".$Username."','".$ProblemMessage."','".$date ."')";
	mysqli_query($con,$sql)or die ("ProblemRecord table can't insert".mysql_error());
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET CHARACTER_SET_CLIENT='utf8'");
	mysql_query("SET CHARACTER_SET_RESULTS='utf8'");
	
	echo "The Username is : "  . $Username."\n";
	echo "The message is : "  . $ProblemMessage."\n";
?>