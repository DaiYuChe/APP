<?php 
   // 開啟MySQL的資料庫連接
   $con = @mysqli_connect("localhost","nhu1403","XWXKM188") 
         or die("無法開啟MySQL資料庫連接!");
   mysqli_select_db($con, "nhu1403");  // 選擇資料庫*/
   header("Content-Type:text/html; charset=utf-8");
   $year = $_POST["year"];
	$month = $_POST['month'];
	$date = $_POST['date'];
	$count = 0;
	//SELECT `userid` FROM `Temp` WHERE `datetime`>= '2016/09/14 00:00:00' AND `datetime`<= '2016/09/14 23:59:59'
    $sql = "SELECT `userid`, `datetime` FROM `Temp` WHERE `datetime`>= '$year/$month/$date 00:00:00' AND `datetime`<= '$year/$month/$date 23:59:59'";
	$res = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($res)){
		echo $row[0];
		echo "  ";
		echo $row[1];
		
		echo "\n";
		
	}
    mysqli_close($con);
	

?>