<?php 
    session_start();

    require("connect_db_user_id.php");
    $sql="SELECT video_name,video_pic,video_lo FROM video";
    $sql.=" WHERE u_id ='".$_SESSION["user"]."'";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="css.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo '<div class="video_List">';
                    echo '<a title="video1" href="">';
                    echo '<img class="image" src="pic/'.$row["video_pic"].'" alt="">';
                    echo '<div class="clear"></div>';
                    echo '<div class="subject">';
                        echo $row["video_name"];
                        echo '<br>';

                    echo "</div>";
                    echo "</a>";
                echo "</div>";
            }
        } else {
            echo "0 results";
        }
    
        mysqli_close($conn);
    
    
    ?>
</body>
</html>