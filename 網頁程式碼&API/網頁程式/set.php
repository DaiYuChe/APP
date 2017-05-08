<?php 
 setcookie("sure","Query");
 //setcookie("use",$_POST["use"]);
 //setcookie("pass",$_POST["pass"]);
 //header("Location:work.php");
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
	$total_fields = mysqli_num_fields($result);
    while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
        for ( $i = 0; $i < $total_fields; $i++ )
            if($rows[$i]==$_POST["use"]&&$rows[$i+1]==$base){				
				echo "登入成功<br/></small>";
				 setcookie("sure","Query");
				 setcookie("use",$_POST["use"]);
				 setcookie("pass",$_POST["pass"]);
				 header("Location:work.php");
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
?> 