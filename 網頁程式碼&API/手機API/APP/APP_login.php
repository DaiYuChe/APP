<?php
error_reporting(0);
require "APP_Init.php";
$name = $_POST["use"];
$password = base64_encode($_POST["pass"]);
//account 
$userName = $_POST["userName"];
$Pass = base64_encode($_POST["Password"]);


if(($name == $_POST["use"] && $password == base64_encode($_POST["pass"]))
	&& $name != null && $password != null){
		
	
	$sql = "SELECT * FROM `name` WHERE `use`='".$name."' AND `pass`='".$password."';";
	
	$result = mysqli_query($con, $sql);
	$response = array();
//
	while($row = mysqli_fetch_array($result)){
		
		$response = array("use"=>$row[0],"pass"=>base64_decode($password));
		
	}
	echo json_encode(array("user_data"=>$response));
	
	//header("Location:APP_readDB.php?use=".$name);
	$sql = "UPDATE `now` SET `use`='".$name."' WHERE 1";
	
	$result = mysqli_query($con, $sql);
		
}


?>
