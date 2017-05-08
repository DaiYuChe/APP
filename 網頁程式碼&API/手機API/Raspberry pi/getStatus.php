<?php
	$sid = $_POST[sid];
	
	include("connectDB.php");		//連結資料庫
	
	$sql = "SELECT * FROM  `deviceSerialNo` WHERE  `sid` =  '$sid'";
	$result = mysql_query($sql);
	$msg = mysql_fetch_assoc($result);
	$sql = "SELECT * FROM device WHERE deviceId = '$msg[deviceId]'";	
	$result = mysql_query($sql);
	$deviceStatus = mysql_fetch_assoc($result);
	echo json_encode($deviceStatus);
?>