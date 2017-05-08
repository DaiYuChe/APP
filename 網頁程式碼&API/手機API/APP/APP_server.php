<?php

/*
	手機APP之新增，修改，刪除
*/
$recode = "localhost";
$username = "nhu1403";
$password = "XWXKM188";
$database = "nhu1403";


mysql_connect($recode, $username, $password) or die("<h1>Connect Mysql Error : </h1>" . mysql_error());
mysql_select_db($database) or die("<h1>Connect DB Error : </h1>" . mysql_error());

@$choice = $_GET['choice'];

switch ($choice) {
    case "view":
        /* 顯示資料庫的紀錄(顯示recode資料表). */
		@$know = $_GET["know"];
        $DBData = mysql_query("SELECT * FROM `recode`") or die(mysql_error());
        $data_array = array();
        while ($data = mysql_fetch_assoc($DBData)) {
            $data_array[] = $data;
        }
        echo json_encode($data_array);
        break;
		
    case "insert":
        /* 插入資料到資料庫(插入資料到recode資料表). */
		$no = 0;
		$link = @mysqli_connect("localhost","nhu1403","XWXKM188") 
         or die("無法開啟MySQL資料庫連接!<br/>");
		mysqli_select_db($link, "nhu1403");  // 選擇資料庫
		// 建立新增記錄的SQL指令字串
		$sql = "SELECT * FROM recode";
		mysqli_query($link, 'SET NAMES utf8'); 
		$result = @mysqli_query($link, $sql);
		if ( mysqli_errno($link) != 0 ) {
		  echo "錯誤代碼: ".mysqli_errno($link)."<br/>";
		  echo "錯誤訊息: ".mysqli_error($link)."<br/>";      
		} 
		else { 
		  $total_records = mysqli_num_rows($result);
		}
		$total_fields = mysqli_num_fields($result);
		while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
			for ( $i = 0; $i < $total_fields; $i++ )
				if($rows[$i]==$_GET['know'])
					$no++;
		 }
		$no++;
        @$know = $_GET['know'];
        @$time = date('Y/m/d H:i:s', mktime(date('H'), date('i')-3.5, date('s'), date('m'), date('d'), date('Y')));
		//扣掉時間誤差值
        $query_insert_data = mysql_query("INSERT INTO recode (no, know, time) VALUES('$no', '$know', '$time')");
        if ($query_insert_data) {
            echo "Data Save Successful.";
        } else {
            echo "Insert Data Error." . mysql_error();
        }
		echo "\n";
		include ('gmail2.php');
		//include ('gmail4.php');
        break;
		
    case "get_data_by_id":
        /* 根據搜尋ID來編輯. */
		
        @$no = $_GET['no'];
        $DBData = mysql_query("SELECT * FROM recode WHERE no='$no'") or die(mysql_error());
        $data_array = array();
        $data_array = mysql_fetch_assoc($DBData);
        echo "[" . json_encode($data_array) . "]";
        break;
		
    case "update":
        /* 修改資料. */
	
        @$know = $_GET['know'];
        @$time = $_GET['time'];
        @$no = $_GET['no'];
        $query_update_data = mysql_query("UPDATE recode SET know='$know' WHERE no='$no'");
		//, time='$time'
        if ($query_update_data) {
            echo "Update Data Successful.";
        } else {
            echo mysql_error();
        }
        break;
		//UPDATE recode SET know='111122' WHERE no='1' AND know='111'
    case "delete":
        /* 刪除資料. */
		//DELETE FROM recode WHERE no='1' AND know=''
        @$no = $_GET['no'];
		@$know = $_GET['know'];
        $query_delete_data = mysql_query("DELETE FROM recode WHERE no='$no'");
        if ($query_delete_data) {
            echo "Delete Data Successful.";
        } else {
            echo mysql_error();
        }
        break;
		
    default:
        break;
}
?>