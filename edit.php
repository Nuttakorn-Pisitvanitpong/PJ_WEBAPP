<?php 
    ob_start();
    session_start();
    $v_id=$_REQUEST["v_id"];
    $type_v=$_REQUEST["type_v"];
    require("connect_db_user_id.php");

//ลบวิดีโอจาก DB เเละ dir
    $send="";
    $p="0";
    if(isset($_REQUEST["send"])){$send=$_REQUEST["send"];}
    if($send == 'Delete') {
        $v_id = $_REQUEST["v_id"];
        $sql="SELECT video_pic,video_lo FROM video";
        $sql.=" WHERE video_id = '".$v_id."'";
        $result = mysqli_query($conn, $sql);
        
        

        }if($send=="Edit"){
            $v_id = $_REQUEST["v_id"];
            $sql="SELECT video_pic,video_lo,type_v,video_name FROM video";
            $sql.=" WHERE video_id = '".$v_id."'";
            $result = mysqli_query($conn, $sql);
            
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/afterglow/latest/afterglow.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css.css">
        <link rel="stylesheet" type="text/css" href="b3.css">
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
            <div class="panel panel-default">
                <div class="panel-body">
                        <?php
                            $v_id=$_REQUEST["v_id"];
                            $sql1="SELECT video_name,video_pic,video_lo,video_id FROM video";
                            $sql1.=" WHERE video_id ='".$v_id."'";
                            $result_s = mysqli_query($conn, $sql1);
                            $row1 = mysqli_fetch_assoc($result_s);
                            echo'<form action="edit.php"  enctype="multipart/form-data" method="post">';
                            //echo "<form action='edit.php'>";
                            echo '<div class="video_List">';
                                echo '<a title="video" >';
                                echo '<img class="image" src="pic/'.$row1["video_pic"].'" alt="">';
                                echo '<div class="clear"></div>';
                                echo '<div class="subject">';
                                    echo $row1["video_name"];
                                    echo '<br>';
                                    echo "<input type='text' name='v_id' hidden value='".$v_id."'>";
                                    echo "<input type='text' name='type_v' hidden value='".$type_v."'>";
                                    echo "<input type='text' name='v_name' hidden value='".$row1['video_name']."'>";
                                    echo "<input type='text' name='v_lo' hidden value='".$row1['video_lo']."'>";
                                    echo "<input type='text' name='v_pic' hidden value='".$row1['video_pic']."'>";
                                    //echo "</form>";
                                    echo "</div>";
                                    
                                echo "</a>";
                            echo "</div>";
                        ?>
                <!-- <form action="edit.php"  enctype="multipart/form-data" method="post"> -->
                    <?php echo "<input type='text' name='v_id' hidden value='".$v_id."'>"; ?>
                    Edit Video name :<input type="text" name="video_name" value="<?php $v_c=$_REQUEST["v_name"]; echo $v_c; ?>"><br><br>
                    Edit Video to upload ยังไม่พร้อมใช้ :<input type="file" name="videoToUpload"><br>
                    Edit Image to upload ยังไม่พร้อมใช้ :<input type="file" name="fileToUpload"><br><br>
                    Edit Video Type :   <select name="type_v"> 
                                            <option value="หนังหมา">หนังหมา</option>
                                            <option value="หนังจีน">หนังจีน</option>
                                            <option value="หนัง18+">หนัง18+</option>
                                            <option value="หนังโรง">หนังโรง</option>
                                        </select>
                    <button type="submit" class="btn btn-primary mb-2" name="send">Edit</button>
                </form>
    </div>
</body>
</html>
<?php 
    if(isset($_REQUEST["video_name"])){
        $v_name=$_REQUEST["video_name"];
        $v_id=$_REQUEST["v_id"];

        if($v_name != ""){
            $sql = "UPDATE video SET video_name ='".$v_name."' WHERE video_id='".$v_id."'";
            if (mysqli_query($conn, $sql)) {
                $p="1";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
    
    if(isset($_REQUEST["videoToUpload"])){
        $v_name=$_REQUEST["videoToUpload"];
        $v_id=$_REQUEST["v_id"];
        echo "pp";
        if($v_name != ""){
            $cann_v = "0";
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
                $path_v = "video/";
                $path_v .=$v_name;

                if(!unlink($path_v)){
                }
                    else{
                        if(!unlink($path_p)){
                        }
                        else{

                            if($cann_v == "1" ){
                                $sql = "UPDATE video SET video_lo ='".$v_name."' WHERE video_id='".$v_id."'";
                                if (mysqli_query($conn, $sql)) {
                                    
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }mysqli_close($conn);
                            }
                        }    

                        
                    }
            }else{
                echo "your video type not support pls  use only MP4 type";
            }
        } 
    }
    if(isset($_REQUEST["fileToUpload"])){
        $v_name=$_REQUEST["fileToUpload"];
        $v_id=$_REQUEST["v_id"];
        echo "pp";
        if($v_name != ""){
        $name=$_FILES["fileToUpload"]["name"];
        $imageFileType = explode(".",$name);
        $imageFileType = end($imageFileType);
        $ran_name = rand();
        $temp = $_FILES["fileToUpload"]["tmp_name"];
        if($imageFileType || "jpg" || $imageFileType || "png" ||$imageFileType || "jpeg"
        || $imageFileType || "gif"){
            move_uploaded_file($temp,"pic/pic".$ran_name.'.'.$imageFileType);
            $v_name ="pic".$ran_name.'.'.$type; 
            $cann_p = "1";
            $path_p = "pic/";
            $path_p .=$v_name;
            if(!unlink($path_p)){
            }
            else{
                if($cann_p=="1"){
                    $sql = "UPDATE video SET video_pic ='".$v_name."' WHERE video_id='".$v_id."'";
                    if (mysqli_query($conn, $sql)) {
                    
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }mysqli_close($conn);
                }
            }
        }   
        }
    else{
            echo "not support your type";
        }
    }
    if(isset($_REQUEST["type_v"])){
        $type_v = $_REQUEST["type_v"];
        $sql_type="SELECT video_pic,video_lo,type_v,video_name FROM video";
        $sql_type.=" WHERE video_id = '".$v_id."'";
        $resultp = mysqli_query($conn,$sql_type);

        if (mysqli_num_rows($resultp) == 1) {
            // output data of each row
            while($row_t = mysqli_fetch_assoc($resultp)) {
            $s= $row_t["type_v"]; 
            if( $s != $type_v){
            $sql_type = "UPDATE video SET type_v ='".$type_v."' WHERE video_id='".$v_id."'";
                if (mysqli_query($conn, $sql_type)) {
                    $p="1";
                            
                } else {
                    echo "Error: " . $sql_type . "<br>" . mysqli_error($conn);
                }mysqli_close($conn);

            } 
            }
        }
        }
        if($p=="1"){
            header("location:video_list.php");
        }



        

    
    
?>