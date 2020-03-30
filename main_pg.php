<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main_manu</title>
    <link rel="stylesheet" type="text/css" href="b3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/afterglow/latest/afterglow.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css.css">
</head>
<?php 
    session_start();
    require("connect_db_user_id.php");
    $sql="SELECT video_name,video_pic,video_lo FROM video";
    $result = mysqli_query($conn, $sql);
?>
<body>
        <nav class="navbar navbar-default" role="navigation">
			<div class="header">
				<ul class="nav navbar-nav">
					<li><a href="main_pg.php"><span class="glyphicon glyphicon-home"></span>    หน้าหลัก </a></li>
					<li><a href="add_video.php" ><span class="glyphicon glyphicon-open"></span> อัพโหลดวิดี </a></li>
                    <li><a href="video_list.php"><span class="glyphicon glyphicon-play"></span> ดูวิดีโอของตนเอง </a></li>
                    <li>
                        
                    </li>
                    <li>
                        <form class="form-inline" action="video_list_watch.php">
                            <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" id="inputPassword2" name="s_w" style="heigth: 100%">
                            </div>
                            <select  name="type_v">
                                <option value="หนังทั้งหมด" selected>หนังทั้งหมด</option>       
                                <option value="หนังหมา">หนังหมา</option>
                                <option value="หนังจีน">หนังจีน</option>
                                <option value="หนัง18+">หนัง18+</option>
                                <option value="หนังโรง">หนังโรง</option>
                            </select>  
                            <button type="submit" class="btn btn-primary mb-2">ค้นหา</button>
                        </form>
                        <form action="video_list_watch.php">
                            
                        </form>
                    </li>
                </ul>
                
            </div>
        </nav>
        <div class="panel panel-default">
            <div class="panel-body">
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
                                    echo "<form action='watch_video.php'>";
                                            echo "<input type='submit' value='Watch'>";
                                            echo "<input type='text' hidden name='video_w' value='".$row["video_lo"]."'>";
                                    echo "</form>";
                                echo "</div>";
                                echo "</a>";
                            echo "</div>";
                            
                        }
                    } else {
                        echo "0 results";
                    }
                
                    mysqli_close($conn);
                
                
                ?>
            </div>
        </div>


</body>
</html>