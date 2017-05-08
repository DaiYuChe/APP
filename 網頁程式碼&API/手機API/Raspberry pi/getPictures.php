<?php
	include("../connectDB.inc.php");
	include("../userPrivileges.inc.php");	//防止外人使用API
	
	$deviceId=$_POST['deviceId'];
	$json_msg=array();
	$sql="SELECT * FROM image where deviceId = '$deviceId' ";
	$result=mysql_query($sql);
	
	While($row=mysql_fetch_object($result))	//取得一列數據
	{	
		$json_msg[]=$row;
	}

	echo json_encode($json_msg);
?>