<html>
<head>
<link rel="SHORTCUT ICON" href="CSS/images/monitor_icon.png" />
<link rel="icon" href="CSS/images/monitor_icon.png" type="image/ico" />
<meta charset="utf-8" />
	<title>登入</title>
		<meta name="keywords" content="itinerary, list" />
        <meta name="description" content="This page provides a list of all itineraries" />
       
</head>
<body style="background-image:url(XD1.jpg);background-repeat:no-repeat;background-size:cover;">
<div id="wrapper">
   <div id="page">
                <div id="content">
					 <center><h1><font color="white">輸入登入資料</h1>

<?php 

if (isset($_POST["leave"])) {
	setcookie("use", "", time()-3600);
	setcookie("pass", "", time()-3600);
	setcookie("sure","", time()-3600);
	setcookie("begin", "", time()-3600);
	setcookie("end", "", time()-3600);
	setcookie("year", "", time()-3600);
	setcookie("month", "", time()-3600);
	setcookie("day", "", time()-3600);
	echo "已登出";
}
else if (isset($_COOKIE["use"])&&isset($_COOKIE["pass"])) {
		header("Location:work.php");
}
if (isset($_GET["use"])) {
		echo $_GET["use"];
}

?> 
<form action="set.php" method="post">
 <div id="UILabel"><font color="white">帳號:  </font></div><input class="form_tfield" type="text" name="use" size ="8"/><br/><br/>
 <div id="UILabel"><font color="white">密碼:  </font></div><input class="form_tfield" type="password" name="pass" size ="8"/><br/><br/>
<input class="form_submitb" type="submit" name="Update" value="登入"/>
</form>
</div>  
<div style="clear: both; height: 1px"></div>
            </div>
        </div>
</body>
</html>
