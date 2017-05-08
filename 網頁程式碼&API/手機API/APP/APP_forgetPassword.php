<?php
error_reporting(0);
require "APP_Init.php";
 
$name = $_POST["use"];
$password = base64_encode($_POST["pass"]);
//account 
$sql = "SELECT * FROM `name` WHERE `use`='".$name."' AND `pass`='".$password."';";

if($name == $_POST["use"]){
	
	$result = mysqli_query($con, $sql);
	$response = array();
//
	while($row = mysqli_fetch_array($result)){
		$response = array("pass"=>base64_decode($password));
	}
	echo json_encode(array("user_data"=>$response));
}
else{
	echo "Fail!";
}
?>