<?php 
	// �}��MySQL����Ʈw�s��
	$link = @mysqli_connect("localhost","nhu1403","XWXKM188") 
         or die("�L�k�}��MySQL��Ʈw�s��!");
	mysqli_select_db($link, "nhu1403");  // ��ܸ�Ʈw
	// �إ߷s�W�O����SQL���O�r��
	//$now1 = date('Y/m/d h:i:s');
	$now1 = date('Y/m/d H:i:s', mktime(date('H'), date('i')-3.5, date('s'), date('m'), date('d'), date('Y')));
   
	$id = $_GET['id'];
	$temp = $_GET['temp'];
	//$sql ="INSERT INTO `Temp` (`userid` , `datetime` , `temp` )";
	//$sql.="VALUES ('".$_GET['id']."','".$now1."','".$_GET['temp'] ."')";
	$sql ="UPDATE `Temp` SET `userid`='$id',`datetime`='$now1',`temp`='$temp'";
	$sql.="WHERE `userid`='$id'";
	//UPDATE `Temp` SET `userid`='nhu1403-123.jpg',`datetime`='1111/1/1 11:11:11',`temp`='LEFT1 Warming: CM = 0.290' 
	//WHERE `userid`='nhu1403-41.jpg'
	echo "SQL���O: ".$sql;
	//�e�XUTF8�s�X��MySQL���O
	mysqli_query($link, 'SET NAMES utf8'); 
	if ( mysqli_query($link, $sql) ) // ����SQL���O
		echo "��Ʈw�s�W�O�����\, �v�T�O����: ". 
           mysqli_affected_rows($link);
	else
		die("��Ʈw�s�W�O������");
	mysqli_close($link);      // ������Ʈw�s��*/


?>