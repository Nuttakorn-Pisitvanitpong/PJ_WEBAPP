<?php
require("connect_db_user_id.php");
$user_id = $_REQUEST["user_id"];
$user_pass = $_REQUEST["user_pass"];
$user_info = $_REQUEST["user_info"];
$sql = "INSERT INTO user_id (User_id, User_Pass, info_User) VALUES";
$sql .="('". $user_id ."','".$user_pass ."','". $user_info ."')";
echo $sql;
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>