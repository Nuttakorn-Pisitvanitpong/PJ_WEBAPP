<?php 
    session_start();

    require("connect_db_user_id.php");
    $sql="SELECT video_name,video_pic,video_lo,video_id,type_v FROM video";
    $sql.=" WHERE u_id ='".$_SESSION["user"]."'";
    $result = mysqli_query($conn, $sql);
//ลบวิดีโอจาก DB เเละ dir
    $send="";
    if(isset($_REQUEST["send"])){$send=$_REQUEST["send"];}
    if($send == 'Delete') {
        $v_id = $_REQUEST["v_id"];
        $sql="SELECT video_pic,video_lo FROM video";
        $sql.=" WHERE video_id = '".$v_id."'";
        $result = mysqli_query($conn, $sql);
        
        

        if (mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $path_v = "video/";
            $path_v .=$row["video_lo"];
            $path_p = "pic/";
            $path_p .=$row["video_pic"];
            if(!unlink($path_v)){

            }
                else{
                    if(!unlink($path_p)){
                    }
                    else{
                        $sql = "DELETE FROM video WHERE video_id = $v_id";
                        if (mysqli_query($conn, $sql)) {
                            echo "Delete record successfully";
                        }else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                    }    

                    
                }  
  
            }
        }if($send=="Edit"){
            $v_id = $_REQUEST["v_id"];
            $sql="SELECT video_pic,video_lo,type_v,video_name FROM video";
            $sql.=" WHERE video_id = '".$v_id."'";
            $result = mysqli_query($conn, $sql);
            
        }


            
            



     
?>


<script>
    
</script>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="css.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="b3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/afterglow/latest/afterglow.min.js"></script>
</head>
<body>
        <nav class="navbar navbar-default" role="navigation">
			<div class="header">
				<ul class="nav navbar-nav">
					<li><a href="main_pg.php"><span class="glyphicon glyphicon-home"></span>    หน้าหลัก </a></li>
					<li><a href="add_video.php" ><span class="glyphicon glyphicon-open"></span> อัพโหลดวิดี </a></li>
                    <li><a href="video_list.php"><span class="glyphicon glyphicon-play"></span> ดูวิดีโอของตนเอง </a></li>

                    <li>
                        <form class="form-inline" action="video_list_watch.php">
                            <div class="form-group mx-sm-3 mb-2">
                            <input type="text" class="form-control" id="inputPassword2" name="s_w" style="heigth: 100%">
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">ค้นหา</button>
                        </form>
                    </li>
                    <li>
                        <form action="log_out.php">
                            <button type="submit" class="btn btn-primary mb-2" name="log_out" value="out">logout</button>
                        </form>
                    </li>
                </ul>
                
            </div>
        </nav>

    <?php 
        if (mysqli_num_rows($result) >=1) {
            
            while($row = mysqli_fetch_assoc($result)) {
                echo "<form action='video_list.php'>";
                    echo '<div class="video_List">';
                        echo '<a title="video" >';
                        echo '<img class="image" src="pic/'.$row["video_pic"].'" alt="">';
                        echo '<div class="clear"></div>';
                        echo '<div class="subject">';
                            echo $row["video_name"];
                            echo '<br>';
                            echo "<input type='submit' value='Delete' name='send'>";
                            
                            echo "<input type='text' name='v_id' hidden value='".$row['video_id']."'>";
                            echo "</form>";
                            echo "<form action='edit.php'>";
                                echo "<input type='text' name='v_id' hidden value='".$row['video_id']."'>";
                                echo "<input type='text' name='v_name' hidden value='".$row['video_name']."'>";
                                echo "<input type='text' name='v_lo' hidden value='".$row['video_lo']."'>";
                                echo "<input type='text' name='v_pic' hidden value='".$row['video_pic']."'>";
                                echo "<input type='text' name='type_v' hidden value='".$row['type_v']."'>";
                                echo "<input type='submit' value='Edit' name='send'>";
                            echo "</form>";
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
        
    
    
    ?>
</body>
</html>