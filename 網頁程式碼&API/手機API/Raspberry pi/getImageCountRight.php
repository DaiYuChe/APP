<?php 
   // �}��MySQL����Ʈw�s��
   $link = @mysqli_connect("localhost","nhu1403","XWXKM188") 
         or die("�L�k�}��MySQL��Ʈw�s��!");
   mysqli_select_db($link, "nhu1403");  // ��ܸ�Ʈw
   
	$Right_sensor = $_GET['Right_sensor'];
	
    $sql = "UPDATE `ImageCount` SET `Right_sensor`='$Right_sensor'";
	//$sql = "INSERT INTO Date (Days) VALUES('$_GET['Days']')";
	//$sql ="INSERT INTO `Date` (`Days`)";
   //$sql.="VALUES ('".$_GET['Days']."')";
   $file = fopen("count_right.txt","w+"); //�}���ɮ�
	fwrite($file,$Right_sensor);
	fclose($file);
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