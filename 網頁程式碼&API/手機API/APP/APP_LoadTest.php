<?php

if(move_uploaded_file($_FILES['image0']['tmp_name'], $_FILES['image0']['name'])){
 print_r("File".$_FILES['image0']['name']." is valid, and was successfully uploaded");
}else{
 print_r('Pic:'.$_FILES['image0']['name'].' Uploaded unsuccessfully!');
}


?>