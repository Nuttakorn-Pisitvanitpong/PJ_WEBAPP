<?php
$name=$_FILES["fileToUpload"]["name"];
$type = explode(".",$name);
$type = end($type);
$ran_name = rand();
$temp = $_FILES["fileToUpload"]["tmp_name"];
if($type=="MP4" || $type=="mp4"){
    move_uploaded_file($temp,"Video/video".$ran_name.'.'.$type);
}
?>