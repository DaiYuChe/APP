<html>
<head>
<link rel="SHORTCUT ICON" href="CSS/images/monitor_icon.png" />
<link rel="icon" href="CSS/images/monitor_icon.png" type="image/ico" />
<meta charset="utf-8" />
<title>尋回密碼</title>
<meta name="keywords" content="itinerary, list" />
        <meta name="description" content="This page provides a list of all itineraries" />

</head>
<body style="background-image:url(XD1.jpg);background-repeat:no-repeat;background-size:cover;">
<div id="wrapper">
   <div id="page">
                <div id="content">
					 <center><h1><font color="white">尋回密碼</font></h1>
<?php 
$a=false;
if(isset($_COOKIE["no"])){
if (isset($_POST["search"])) {
	if($_POST["use"]&&$_POST["no"]==$_COOKIE["no"]){
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
			for ( $i = 0; $i < $total_fields; $i++ )
				if($rows[$i]==$_POST["use"]){
				echo "密碼為".base64_decode($rows[$i+1])."<br/></small>";
				$a=true;
				break;
				}
		  }
		if($a==false)
		  echo "查無紀錄<br/></small>";
		mysqli_free_result($result);
		mysqli_close($link); // 關閉資料庫連接
		}
		else{
		 echo "輸入有誤<br/></small>";
	   }
	   setcookie("no", "", time()-3600);
	}
}
?> 
<form action="forgetpass.php" method="post">
 <div id="UILabel"><center><h2><font color="white">帳號:  </div><input class="form_tfield" type="text" name="use" size ="8"/><br/><br/>
 <div id="UILabel"><center><h2><font color="white">請輸入認證碼:<?php echo $_COOKIE["no"]; ?>  </div><input class="form_tfield" type="text" name="no" size ="8"/><br/><br/>
 <input class="form_submitb" type="submit" name="search" value="查詢"/>
</form> 
<form action="forget.php" method="post">
 <input class="form_submitb" type="submit" name="search" value="修改密碼"/>
</form> 
 </div>  
<div style="clear: both; height: 1px"></div>
            </div>
        </div>
</body>
</html>