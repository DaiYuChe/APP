<?php
	include("../connectDB.inc.php");
	include("../userPrivileges.inc.php");	//����~�H�ϥ�API
	
	$deviceId=$_POST['deviceId'];
	$json_msg=array();
	$sql="SELECT * FROM image where deviceId = '$deviceId' ";
	$result=mysql_query($sql);
	
	While($row=mysql_fetch_object($result))	//���o�@�C�ƾ�
	{	
		$json_msg[]=$row;
	}

	echo json_encode($json_msg);
?>