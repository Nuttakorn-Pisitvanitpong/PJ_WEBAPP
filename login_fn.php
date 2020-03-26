<?php
    if(isset($_REQUEST["u_id"])){$user_id=$_REQUEST["u_id"];}
    if(isset($_REQUEST['u_pass'])){$user_pass=$_REQUEST["u_pass"];}
    require("connect_db_user_id.php");
    $sql = "SELECT * FROM user WHERE u_id='$user_id' AND u_pass='$user_pass'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['user'] = $row['u_id'];
        $_SESSION['name'] = $row['u_name'];
        header("location:add_video.php");
    }else{
        header("lacation:login.html");
    }


    if(isset($_REQUEST["u_id"])){$user_id=$_REQUEST["u_id"];}
    




?>