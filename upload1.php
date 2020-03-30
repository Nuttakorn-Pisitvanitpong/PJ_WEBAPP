<?php
//อัพวิดีโอ

$cann_v = "0";
$cann_p = "0";
$name = $_FILES["videoToUpload"]["name"];
$type = explode(".",$name);
$type = end($type);
$ran_name = rand();
$type_v= $_REQUEST["type_v"];
$temp = $_FILES["videoToUpload"]["tmp_name"];
if($type=="MP4" || $type=="mp4"){
    move_uploaded_file($temp,"Video/video".$ran_name.'.'.$type);
    $v_name ="video".$ran_name.'.'.$type; 
    $cann_v = "1";
}else{
    echo "your video type not support pls  use only MP4 type";
}
//อัพรูป
$name=$_FILES["fileToUpload"]["name"];
$imageFileType = explode(".",$name);
$imageFileType = end($imageFileType);
$ran_name = rand();
$temp = $_FILES["fileToUpload"]["tmp_name"];
if($imageFileType || "jpg" || $imageFileType || "png" ||$imageFileType || "jpeg"
|| $imageFileType || "gif"){
    move_uploaded_file($temp,"pic/pic".$ran_name.'.'.$imageFileType);
    $p_name = "pic".$ran_name.'.'.$imageFileType;
    $cann_p = "1";
}else{
    echo "not support your type";
}

//เก็บที่อยู่รูปลง database
session_start();
if(isset($_REQUEST["video_name"])){$video_name=$_REQUEST["video_name"];}
require("connect_db_user_id.php");
echo $_SESSION["user"];
if($cann_v == "1" and $cann_p == "1" and $video_name != ""){
    $sql="INSERT INTO video (video_name,video_pic,video_lo,u_id,type_v)";
    $sql.=" VALUES ('".$video_name."','".$p_name."','".$v_name."','".$_SESSION['user']."','".$type_v."')";
    if (mysqli_query($conn, $sql)) {
        header("location:main_pg.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }mysqli_close($conn);
}



?>
