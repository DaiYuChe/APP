 <!DOCTYPE html>
<html>
<head>
<link rel="SHORTCUT ICON" href="CSS/images/monitor_icon.png" />
<link rel="icon" href="CSS/images/monitor_icon.png" type="image/ico" />
<meta charset="utf-8" />
<title>紀錄</title>
<meta name="keywords" content="itinerary, list" />
        <meta name="description" content="This page provides a list of all itineraries" />
</head>
<body style="background-image:url(XD1.jpg);background-repeat:no-repeat;background-size:cover;">
<div id="wrapper">
   <div id="page">
                <div id="content">
					 <center><h1><font color="black"><?php echo$_COOKIE["use"] ?> 的個人紀錄</h1>
<?php 
		 $a=false;
		$no=0;
         $d=$_COOKIE["use"];
   //header('refresh: 60;?sure='.$_COOKIE["sure"]);
// 是否是表單送回
if ($_COOKIE["sure"]=="Query"&&!isset($_POST["Insert"])&&!isset($_POST["Delete"])) {
   // 取得SQL指令
   $sql = "SELECT * FROM Temp ORDER BY  `datetime` DESC ";
//   echo "<small>SQL指令:<b> $sql </b><br/>";
   // 開啟MySQL的資料庫連接
   $link = @mysqli_connect("localhost", "nhu1403", "XWXKM188") 
         or die("無法開啟MySQL資料庫連接!<br/>");
   mysqli_select_db($link, "nhu1403");  // 選擇資料庫
   //送出UTF8編碼的MySQL指令
   mysqli_query($link, 'SET NAMES utf8'); 
   // 執行SQL查詢
   $result = @mysqli_query($link, $sql); 
   if ( mysqli_errno($link) != 0 ) {
      echo "錯誤代碼: ".mysqli_errno($link)."<br/>";
      echo "錯誤訊息: ".mysqli_error($link)."<br/>";      
   } 
   else { 
      echo "<table border=1>";
      echo "<tr>";
      while ( $meta = mysqli_fetch_field($result) )
         echo "<td><small>".$meta->name."</small></td>";
	  echo "<td><small>image</small></td>";
      echo "</tr>";
      // 取得欄位數
      $total_fields = mysqli_num_fields($result);
      while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
         for ( $i = 0; $i < $total_fields; $i++ )
			$g=$rows[0];
			$s=explode("-",$g);
			if($s[0]==$_COOKIE["use"]){
			echo "<tr>";
            echo "<td><small>".$rows[$i-3]."</small></td>";
			echo "<td><small><a target='_blank' href='100.php?id=".$rows[$i-3]."' >".$rows[$i-2]."</a></small></td>";
			echo "<td><small>".$rows[$i-1]."</small></td>";
			echo "<td><small><img src=".$rows[$i-3]." width='40' height='40' ></small></td>";
         echo "</tr>";
		}
      }
      echo "</table>";
      // 取得記錄數
      $total_records = mysqli_num_rows($result);
      //echo "記錄總數: $total_records 筆<br/></small>";
      mysqli_free_result($result);
   }
   mysqli_close($link); // 關閉資料庫連接
}
else if ( $_COOKIE["sure"]=="search" &&!isset($_POST["Insert"])&&!isset($_POST["Delete"])) {
	$begin = sprintf("%d",$_COOKIE["begin"]);
	$end = sprintf("%d",$_COOKIE["end"]);
	if(($begin>0)&&($end>0)&&($begin<$end)){
   // 取得SQL指令
   $sql = "SELECT * FROM Temp ORDER BY  `datetime` DESC ";
//   echo "<small>SQL指令:<b> $sql </b><br/>";
   // 開啟MySQL的資料庫連接
   $link = @mysqli_connect("localhost", "nhu1403", "XWXKM188") 
         or die("無法開啟MySQL資料庫連接!<br/>");
   mysqli_select_db($link, "nhu1403");  // 選擇資料庫
   //送出UTF8編碼的MySQL指令
   mysqli_query($link, 'SET NAMES utf8'); 
   // 執行SQL查詢
   $result = @mysqli_query($link, $sql); 
   if ( mysqli_errno($link) != 0 ) {
      echo "錯誤代碼: ".mysqli_errno($link)."<br/>";
      echo "錯誤訊息: ".mysqli_error($link)."<br/>";      
   } 
   else { 
      echo "<table border=1>";
      echo "<tr>";
      while ( $meta = mysqli_fetch_field($result) )
         echo "<td><small>".$meta->name."</small></td>";
	echo "<td><small>image</small></td>";
      echo "</tr>";
      // 取得欄位數
      $total_fields = mysqli_num_fields($result);
	while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
         for ( $i = 0; $i < $total_fields; $i++ )
			$g=$rows[0];
		 $s=explode("-",$g,2);
		 $s1=explode(".",$s[1]);
			if($s[0]==$_COOKIE["use"]){
			if($s1[0]<=$end&&$s1[0]>=$begin){
			echo "<tr>";
            echo "<td><small>".$rows[$i-3]."</small></td>";
			echo "<td><small><a target='_blank' href='100.php?id=".$rows[$i-3]."' >".$rows[$i-2]."</a></small></td>";
			echo "<td><small>".$rows[$i-1]."</small></td>";
			echo "<td><small><img src=".$rows[$i-3]." width='40' height='40' ></small></td>";
         echo "</tr>";
		}
		}
      }
      echo "</table>";
      // 取得記錄數
      $total_records = mysqli_num_rows($result);
      //echo "記錄總數: $total_records 筆<br/></small>";
      mysqli_free_result($result);
   }
   mysqli_close($link); // 關閉資料庫連接
   }
   else
		echo "輸入有誤<br/></small>";
}
else if ( $_COOKIE["sure"]=="date"&&!isset($_POST["Insert"])&&!isset($_POST["Delete"]) ) {
	$year = sprintf("%d",$_COOKIE["year"]);
	$month = sprintf("%d",$_COOKIE["month"]);
	$day = sprintf("%d",$_COOKIE["day"]);
	if(($year>0)&&($month>0)&&($day>0)){
   // 取得SQL指令
   $sql = "SELECT * FROM Temp ORDER BY  `datetime` DESC ";
//   echo "<small>SQL指令:<b> $sql </b><br/>";
   // 開啟MySQL的資料庫連接
   $link = @mysqli_connect("localhost", "nhu1403", "XWXKM188") 
         or die("無法開啟MySQL資料庫連接!<br/>");
   mysqli_select_db($link, "nhu1403");  // 選擇資料庫
   //送出UTF8編碼的MySQL指令
   mysqli_query($link, 'SET NAMES utf8'); 
   // 執行SQL查詢
   $result = @mysqli_query($link, $sql); 
   if ( mysqli_errno($link) != 0 ) {
      echo "錯誤代碼: ".mysqli_errno($link)."<br/>";
      echo "錯誤訊息: ".mysqli_error($link)."<br/>";      
   } 
   else { 
      echo "<table border=1>";
      echo "<tr>";
      while ( $meta = mysqli_fetch_field($result) )
         echo "<td><small>".$meta->name."</small></td>";
	echo "<td><small>image</small></td>";
      echo "</tr>";
      // 取得欄位數
      $total_fields = mysqli_num_fields($result);
      while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
         
         for ( $i = 1; $i < $total_fields; $i+=2 ){
		 $g=$rows[0];
		 $s=explode("-",$g);
		 if($s[0]==$_COOKIE["use"]){
			$s=explode("/",$rows[1]);
			$s0 = sprintf("%d",$s[0]);
			$s1 = sprintf("%d",$s[1]);
			$s2 = sprintf("%d",$s[2]);
			if($s0==$year&&$s1==$month&&$s2==$day){
			echo "<tr>";
            echo "<td><small>".$rows[0]."</small></td>";
			echo "<td><small><a target='_blank' href='100.php?id=".$rows[0]."' >".$rows[1]."</a></small></td>";
			echo "<td><small>".$rows[2]."</small></td>";
			echo "<td><small><img src=".$rows[0]." width='40' height='40' ></small></td>";
         echo "</tr>";
		 }
		 }
		 }
      }
      echo "</table>";
      // 取得記錄數
      $total_records = mysqli_num_rows($result);
      //echo "記錄總數: $total_records 筆<br/></small>";
      mysqli_free_result($result);
   }
   mysqli_close($link); // 關閉資料庫連接
   }
   else
		echo "輸入有誤<br/></small>";
}

if (isset($_POST["Insert"])) {
	setcookie("sure","");
   // 開啟MySQL的資料庫連接
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
			if($_COOKIE["use"]==$rows[$i])
				$no++;
      }
   $sql ="INSERT INTO `recode`(`no`, `time`, `know`) VALUES ( ";
   $sql.= "'".($no+1)."','".date("Y/m/d H:i:s", mktime(date('H'), date('i')-3, date('s'), date('m'), date('d'), date('Y')))."','".$_COOKIE["use"]."')";
   echo "<b>SQL指令: $sql</b><br/>";
   //送出UTF8編碼的MySQL指令	
   mysqli_query($link, 'SET NAMES utf8'); 
   if ( mysqli_query($link, $sql) ) {// 執行SQL指令
      echo "資料庫新增記錄成功, 影響記錄數: ". 
           mysqli_affected_rows($link) . "<br/>";
		   setcookie("no",$no+1);
		   include ('gmail.php');
		   //include ('gmail4.php');
		   setcookie("no", "", time()-3600);
		   }
   else
      die("資料庫新增記錄失敗<br/>");
   mysqli_close($link);       // 關閉資料庫連接
}
else if (isset($_POST["Delete"])) {
	setcookie("sure","");
   // 開啟MySQL的資料庫連接
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
			if($_COOKIE["use"]==$rows[$i])
				$no++;
      }
   $link = @mysqli_connect("localhost","nhu1403","XWXKM188") 
         or die("無法開啟MySQL資料庫連接!<br/>");
   mysqli_select_db($link, "nhu1403");  // 選擇資料庫
   // 建立刪除記錄的SQL指令字串
   $sql = "DELETE FROM recode ";
   $sql.= "  WHERE  no = ".$no." and know='".$_COOKIE["use"]."'";
   echo "<b>SQL指令: $sql</b><br/>";
   //送出UTF8編碼的MySQL指令
   mysqli_query($link, 'SET NAMES utf8'); 
   if ( mysqli_query($link, $sql) ) // 執行SQL指令
      echo "資料庫刪除記錄成功, 影響記錄數: ". 
           mysqli_affected_rows($link) . "<br/>";
   else
      die("資料庫刪除記錄失敗<br/>");   
   mysqli_close($link);      // 關閉資料庫連接*/
}
else if (isset($_POST["Update"])) {
	if($_COOKIE["use"]&&$_COOKIE["pass"]){
	$base=base64_encode($_COOKIE["pass"]);  
    // 開啟MySQL的資料庫連接
   $link = @mysqli_connect("localhost","nhu1403","XWXKM188") 
         or die("無法開啟MySQL資料庫連接!<br/>");
   mysqli_select_db($link, "nhu1403");  // 選擇資料庫
   // 建立新增記錄的SQL指令字串
   $sql = "SELECT * FROM name ";
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
	$total_fields = mysqli_num_fields($result);
    while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
        for ( $i = 0; $i < $total_fields; $i++ )
            if($rows[$i]==$_COOKIE["use"]&&$rows[$i+1]==$base&&$rows[$i+2]==0){				
				echo "登入成功<br/></small>";
				$a=true;
				break;
			}
      }
	mysqli_free_result($result);
	mysqli_close($link);// 關閉資料庫連接
	if($a==false)
	  header("Location:login.php?use=登入失敗");
	}
	else{
	header("Location:login.php?use=登入失敗");
   }
}
/*<form method="post" action="work.php" >
<input type="hidden" name="no" value=<?php $no?>>
<input class="form_submitb"type="submit" name="Insert" value="新增"/>
</form>*/
 ?>
<form method="post" action="cookie.php">
<input class="form_submitb"type="submit" name="Query" value="查詢">
</form>
<form action="cookie.php" method="post">
從: <input type="text" name="begin" size ="8"/>
到: <input type="text" name="end" size ="8"/>
<input class="form_submitb" type="submit" name="search" value="部分查詢"/>
</form>
<form action="cookie.php" method="post">
<input type="text" name="year" size ="8"/>年
<input type="text" name="month" size ="8"/>月 
 <input type="text" name="day" size ="8"/>日
<input class="form_submitb" type="submit" name="date" value="日期查詢"/>
</form>

<form action="sure.php" method="post">
<input class="form_submitb"type="submit" name="Delete" value="刪除"/>
</form>
<form action="suresign.php" method="post">
<input class="form_submitb" type="submit" name="leave" value="登出"/>
</form>
</div>  
<div style="clear: both; height: 1px"></div>
            </div>
        </div>
</body>
</html>
   