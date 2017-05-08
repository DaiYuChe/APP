<?php 
   // 開啟MySQL的資料庫連接
   $link = @mysqli_connect("localhost","nhu1403","XWXKM188") 
         or die("無法開啟MySQL資料庫連接!");
   mysqli_select_db($link, "nhu1403");  // 選擇資料庫
   // 建立新增記錄的SQL指令字串
   //$now1 = date('Y/m/d h:i:s');
   $date = date('Y/m/d H:i:s', mktime(date('H'), date('i')-3.5, date('s'), date('m'), date('d'), date('Y')));
   
	$username = $_GET['username'];

   $sql ="INSERT INTO `ImmediateImg` (`username` , `time`)";
   $sql.="VALUES ('".$_GET['username']."','".$date."')";
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