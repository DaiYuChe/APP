<?php
	error_reporting(0);
	require "APP_Init.php";
	 
	$a=true;
	if($_POST["use"]&&$_POST["pass"]){
	$name = $_POST['use'];
	$password = base64_encode($_POST["pass"]);  
	$link = @mysqli_connect("localhost","nhu1403","XWXKM188") 
         or die("�L�k�}��MySQL��Ʈw�s��!");
   mysqli_select_db($link, "nhu1403");  // ��ܸ�Ʈw
   // �إ߷s�W�O����SQL���O�r��
   $sql = "SELECT * FROM name ";
   mysqli_query($link, 'SET NAMES utf8'); 
   $result = @mysqli_query($link, $sql);
   if ( mysqli_errno($link) != 0 ) {
      echo "���~�N�X: ".mysqli_errno($link);
      echo "���~�T��: ".mysqli_error($link);      
   } 
   else { 
      $total_records = mysqli_num_rows($result);
	  }
	$total_fields = mysqli_num_fields($result);
	$c=$_POST["use"];
    while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
        for ( $i = 0; $i < $total_fields; $i=$i+2 )
            if($rows[$i]==$_POST["use"] && $rows[$i] != " "){
				echo "It's a same account or the username has been used!";
				$a=false;
				break;
			}
			
      }

	if($a){
	$sql ="INSERT INTO `name` (`use` , `pass` )";
	$sql.="VALUES ('".$name."','".$password."')";
	//echo "SQL : ".$sql;
	//�e�XUTF8�s�X��MySQL���O
	mysqli_query($con, 'SET NAMES utf8'); 
	if ( mysqli_query($con, $sql) ) // ����SQL���O
		echo "Register successful".
	mysqli_affected_rows($con);
	else
		die("Insert error");
	}
	mysqli_close($con);
	}     // ������Ʈw�s��*/
	else	
		echo "Insert fail";
?>	