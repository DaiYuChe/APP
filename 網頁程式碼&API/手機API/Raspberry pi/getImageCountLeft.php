<?php 
   // �}��MySQL����Ʈw�s��
   $link = @mysqli_connect("localhost","nhu1403","XWXKM188") 
         or die("�L�k�}��MySQL��Ʈw�s��!");
   mysqli_select_db($link, "nhu1403");  // ��ܸ�Ʈw
   
	$Left_sensor = $_GET['Left_sensor'];
	
    $sql = "UPDATE `ImageCount` SET `Left_sensor`= '$Left_sensor'";
	//$sql = "INSERT INTO Date (Days) VALUES('$_GET['Days']')";
	//$sql ="INSERT INTO `Date` (`Days`)";
   //$sql.="VALUES ('".$_GET['Days']."')";
   $file = fopen("count_left.txt","w+"); //�}���ɮ�
	fwrite($file,$Left_sensor);
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