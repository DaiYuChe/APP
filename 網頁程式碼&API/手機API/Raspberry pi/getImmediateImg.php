<?php 
   // �}��MySQL����Ʈw�s��
   $link = @mysqli_connect("localhost","nhu1403","XWXKM188") 
         or die("�L�k�}��MySQL��Ʈw�s��!");
   mysqli_select_db($link, "nhu1403");  // ��ܸ�Ʈw
   // �إ߷s�W�O����SQL���O�r��
   //$now1 = date('Y/m/d h:i:s');
   $date = date('Y/m/d H:i:s', mktime(date('H'), date('i')-3.5, date('s'), date('m'), date('d'), date('Y')));
   
	$username = $_GET['username'];

   $sql ="INSERT INTO `ImmediateImg` (`username` , `time`)";
   $sql.="VALUES ('".$_GET['username']."','".$date."')";
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