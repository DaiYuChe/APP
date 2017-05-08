<html>
<head>
<link rel="SHORTCUT ICON" href="CSS/images/monitor_icon.png" />
<link rel="icon" href="CSS/images/monitor_icon.png" type="image/ico" />
<meta charset="utf-8" />
<meta name="keywords" content="itinerary, list" />
        <meta name="description" content="This page provides a list of all itineraries" />
</head>
<body style="background-image:url(XD1.jpg);background-repeat:no-repeat;background-size:cover;">
<div id="wrapper">
   <div id="page">
                <div id="content">
					 <center><h1><font color="white">修改密碼</font></h1>
<?php 
if(isset($_COOKIE["no"])==$_COOKIE["no"]){
if (isset($_POST["search"])) {
	if($_POST["use"]&&$_POST["pass"]&&$_POST["repass"]){
		$base=base64_encode($_POST["pass"]);  
		$base2=base64_encode($_POST["repass"]);  
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
		$sql = "DELETE FROM name ";
		$sql.= "  WHERE    `use`='".$_POST["use"]."' and `pass`= '".$base."'";
		echo "<b>SQL指令: $sql</b><br/>";
		mysqli_query($link, 'SET NAMES utf8'); 
	   if ( mysqli_query($link, $sql) ) // 執行SQL指令
		  echo "資料庫刪除記錄成功, 影響記錄數: ". 
			   mysqli_affected_rows($link) . "<br/>";
	   else
		  die("資料庫刪除記錄失敗<br/>");
	if( mysqli_affected_rows($link)){
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
			if($_POST["use"]==$rows[$i]){
				$no++;
				}
      }
   $sql ="INSERT INTO `name`(`use`, `pass`) VALUES ( ";
   $sql.= "'".$_POST["use"]."','".$base2."')";
   echo "<b>SQL指令: $sql</b><br/>";
    mysqli_query($link, 'SET NAMES utf8'); 
   if ( mysqli_query($link, $sql) ) // 執行SQL指令
      echo "資料庫新增記錄成功, 影響記錄數: ". 
           mysqli_affected_rows($link) . "<br/>";
   else
      die("資料庫新增記錄失敗<br/>");
	  }
		  mysqli_close($link); // 關閉資料庫連接
	}
	}
	setcookie("no", "", time()-3600);
}
?> 
<form action="forget.php" method="post">
 <div id="UILabel"><center><h2><font color="white">請輸入帳號:  </div><input class="form_tfield" type="text" name="use" size ="8"/><br/><br/>
 <div id="UILabel"><center><h2><font color="white">請輸入密碼:  </div><input class="form_tfield" type="password" name="pass" size ="8"/><br/><br/>
 <div id="UILabel"><center><h2><font color="white">請輸入修改密碼:  </div><input class="form_tfield" type="password" name="repass" size ="8"/><br/><br/>
 <div id="UILabel"><center><h2><font color="white">請輸入認證碼:<?php echo $_COOKIE["no"]; ?>  </div><input class="form_tfield" type="text" name="no" size ="8"/><br/><br/>
 <input class="form_submitb" type="submit" name="search" value="修改"/>
</form> 
 </div>  
<div style="clear: both; height: 1px"></div>
            </div>
        </div>
</body>
</html>