<?php 
if (isset($_POST["Query"])){
 setcookie("sure","Query");
 }
else if (isset($_POST["search"])){
 setcookie("sure","search");
 setcookie("begin",$_POST["begin"]);
 setcookie("end",$_POST["end"]);
 }
else if (isset($_POST["date"])){
 setcookie("sure","date");
 setcookie("year",$_POST["year"]);
 setcookie("month",$_POST["month"]);
 setcookie("day",$_POST["day"]);
 }
 header("Location:work.php");
?> 