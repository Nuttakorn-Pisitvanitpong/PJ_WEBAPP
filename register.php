<?php
echo "1";
require("connect_db_user_id.php");
$user_id = $_REQUEST["u_id"];
$user_pass = $_REQUEST["u_pass"];
$user_name = $_REQUEST["u_name"];
$user_mail = $_REQUEST["u_mail"];
$sql = "SELECT u_id FROM user WHERE u_id = ".$user_id."'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) == 0 ){
    $sql = "INSERT INTO user (u_id, u_pass, u_name) VALUES";
    $sql .="('". $user_id ."','".$user_pass ."','". $user_name ."')";
    echo $sql;
    if (mysqli_query($conn, $sql)) {
        echo "ลงทะเบียนเส็จสิ้น";
        header("location:login.html");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}else{
    echo "User name ถูกใช้งานเเล้ว กรุณาลงทะเบียนใหม่";
}

?>