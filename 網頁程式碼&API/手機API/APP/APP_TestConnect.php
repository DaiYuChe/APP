<?php
error_reporting(0);
require "APP_Init.php";
$name = $_POST["use"];
$password = base64_encode($_POST["pass"]);
//account 
	echo $name;
	echo $password;
	
	$sql = "SELECT * FROM `name` WHERE `use`='".$name."' AND `pass`='".$password."';";
	
	$result = mysqli_query($con, $sql);
	$response = array();
//
	while($row = mysqli_fetch_array($result)){
		
		$response = array("pass"=>$row[1]);
		
	}
	echo json_encode(array("user_data"=>$response));



?>
