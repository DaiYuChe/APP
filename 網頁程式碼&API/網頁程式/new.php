<html>
<head>
<link rel="SHORTCUT ICON" href="CSS/images/monitor_icon.png" />
<link rel="icon" href="CSS/images/monitor_icon.png" type="image/ico" />
<meta charset="utf-8" />
<title>創新帳號</title>
<meta name="keywords" content="itinerary, list" />
        <meta name="description" content="This page provides a list of all itineraries" />

</head>
<body style="background-image:url(XD1.jpg);background-repeat:no-repeat;background-size:cover;">
<div id="wrapper">
   <div id="page">
                <div id="content">
					 <center><h1><font color="white">輸入帳號資料</h1>
<?php 
$a=true;
if (isset($_POST["Update"])) {
	if($_POST["use"]&&$_POST["pass"]){
	$base=base64_encode($_POST["pass"]);  
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
	$c=$_POST["use"];
    while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
        for ( $i = 0; $i < $total_fields; $i=$i+2 )
            if($rows[$i]==$_POST["use"]){
			echo "已有帳號<br/></small>";
			header("Refresh: 2");
			$a=false;
			break;
			}
      }
	  //  echo "登入失敗 <br/></small>";
   mysqli_free_result($result);
   // 開啟MySQL的資料庫連接
   if($a){
	   $link = @mysqli_connect("localhost","nhu1403","XWXKM188") 
			 or die("無法開啟MySQL資料庫連接!<br/>");
	   mysqli_select_db($link, "nhu1403");  // 選擇資料庫
	   // 建立新增記錄的SQL指令字串
	   $sql ="INSERT INTO `name`(`use`, `pass` ) VALUES ( ";
	   $sql.= "'".$_POST["use"]."','".$base."')";
	   echo "<b>SQL指令: $sql</b><br/>";
	   //送出UTF8編碼的MySQL指令
	   mysqli_query($link, 'SET NAMES utf8'); 
	   if ( mysqli_query($link, $sql) ){ // 執行SQL指令
		  echo "資料庫新增記錄成功, 影響記錄數: ". 
			   mysqli_affected_rows($link) . "<br/>";
			header("Location:2.php?use=新增成功");
			}
	   else
		  die("資料庫新增記錄失敗<br/>");
	}
   mysqli_close($link);       // 關閉資料庫連接
   //SELECT recode.when, name.use FROM recode, name WHERE (recode.know=name.use);
   }
   else{
	header("Location:0.php?use=新增失敗");
   }
}
if (isset($_GET["use"])) {
		echo "新增失敗";
}
?> 
<form action="new.php" method="post">
 <div id="UILabel"><font color="white">帳號:  </font></div><input class="form_tfield" type="text" name="use" size ="8"/><br/><br/>
 <div id="UILabel"><font color="white">密碼: </font> </div><input class="form_tfield" type="password" name="pass" size ="8"/><br/><br/>
<input class="form_submitb" type="submit" name="Update" value="新增"/>
</form>

</div>  
<div style="clear: both; height: 1px"></div>
            </div>
        </div>
</body>
</html>
