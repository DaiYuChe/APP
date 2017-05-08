<?php

// 開啟MySQL的資料庫連接
   $link = @mysqli_connect("localhost","nhu1403","XWXKM188") 
         or die("無法開啟MySQL資料庫連接!");
   mysqli_select_db($link, "nhu1403");  // 選擇資料庫
   
	$state = $_GET['state'];
	
    $sql = "UPDATE `GcmMessageState` SET `state`= '$state'";
	//$sql = "INSERT INTO Date (Days) VALUES('$_GET['Days']')";
	//$sql ="INSERT INTO `Date` (`Days`)";
   //$sql.="VALUES ('".$_GET['Days']."')";
   $file = fopen("GCMstate.txt","w+"); //開啟檔案
	fwrite($file,$state);
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
   
//申請的API金鑰
$API_KEY = "AIzaSyBFF3lLoovM5VFDvKfWcSwqZ6qTFZEyflM";
//已知的APP推播識別ID
$APP_ID = "APA91bFOgi3dlh-RY_m3BoNRneg2suOksi7O_nh4O53c0qLT8UTvAk93LrZ_ZL2jfhBKFI83ME1y6tsQJMIneYIJWSyjjAxRebZugSLCWNKwPmAWjato9n9PQJ2W3-kAc_EnIgrLcOAu";
//$APP_ID = "APA91bHLUpTAy2P-5fbsPHmMRXqqVygvcGa3OtQFSqMXF-sjp30kgpqnEWI_0uEOyr7MI_I7WOT2DvqIBL3SjdXOS_Q_CJsCyaHLmmKy_oX3JcCwSNJWqyGabIrMPqtSL26eKzjDjoWh";
 //模擬器
//推播訊息
if($state == 1){
	//設定識別ID
	$registatoin_ids = array($APP_ID);
	//設定內容
    //$message = array("message" => $_POST['message']);
    $message = array("message" => "Warming!");
	
	$url = 'https://android.googleapis.com/gcm/send';
	$json = array(
            'to' => $APP_ID,
            'data' => $message,
        );
	
	$headers = array(
            'Authorization: key=' . $API_KEY,
            'Content-Type: application/json'
        );
		
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);	//忽略SSL驗證
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($json));
	$result = curl_exec($curl);
	curl_close($curl);
    echo $result;
}
?>
