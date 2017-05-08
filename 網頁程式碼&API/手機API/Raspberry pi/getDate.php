<?php 
   // 開啟MySQL的資料庫連接
   $link = @mysqli_connect("localhost","nhu1403","XWXKM188") 
         or die("無法開啟MySQL資料庫連接!");
   mysqli_select_db($link, "nhu1403");  // 選擇資料庫
   
	$getDays = $_GET['Days'];
    $sql = "UPDATE `Date` SET `Days`='".$getDays."' WHERE 1";
	//$sql = "INSERT INTO Date (Days) VALUES('$_GET['Days']')";
	//$sql ="INSERT INTO `Date` (`Days`)";
   //$sql.="VALUES ('".$_GET['Days']."')";
   $file = fopen("day.txt","w+"); //開啟檔案
	fwrite($file,$getDays);
	fclose($file);
   echo "SQL指令: ".$sql;
   //送出UTF8編碼的MySQL指令
   mysqli_query($link, 'SET NAMES utf8'); 
   if ( mysqli_query($link, $sql) ) // 執行SQL指令
      echo "資料庫新增記錄成功, 影響記錄數: ". 
           mysqli_affected_rows($link);
		   
   else
      die("資料庫新增記錄失敗");
   mysqli_close($link);      // 關閉資料庫連接*/


?>