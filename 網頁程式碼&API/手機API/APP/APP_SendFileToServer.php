<?php

//$target_path = "img/";
//$target_path = "http://203.72.0.26/~nhu1403/UploadImage/";

$target_path = basename( $_FILES['uploadedfile']['name']); 

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    echo "Upload success!";
} else{
    echo "Upload fail!";
    echo "filename: " .  basename( $_FILES['uploadedfile']['name']);
    echo "target_path: " .$target_path;
}
?>