<?php
	error_reporting(0);
	require "APP_Init.php";
	 
	$a=true;
	if($_POST["use"]&&$_POST["pass"]){
	$name = $_POST['use'];
	$password = base64_encode($_POST["pass"]);  
	$link = @mysqli_connect("localhost","nhu1403","XWXKM188") 
         or die("無法開啟MySQL資料庫連接!");
   mysqli_select_db($link, "nhu1403");  // 選擇資料庫
   // 建立新增記錄的SQL指令字串
   $sql = "SELECT * FROM name ";
   mysqli_query($link, 'SET NAMES utf8'); 
   $result = @mysqli_query($link, $sql);
   if ( mysqli_errno($link) != 0 ) {
      echo "錯誤代碼: ".mysqli_errno($link);
      echo "錯誤訊息: ".mysqli_error($link);      
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
	//送出UTF8編碼的MySQL指令
	mysqli_query($con, 'SET NAMES utf8'); 
	if ( mysqli_query($con, $sql) ) // 執行SQL指令
		echo "Register successful".
	mysqli_affected_rows($con);
	else
		die("Insert error");
	}
	mysqli_close($con);
	}     // 關閉資料庫連接*/
	else	
		echo "Insert fail";
?>	