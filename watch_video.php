<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>main_manu</title>
    <script type="text/javascript" src="//cdn.jsdelivr.net/afterglow/latest/afterglow.min.js"></script>
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
    <?php 
        if(isset($_REQUEST["video_w"])){$v_w =$_REQUEST["video_w"]; }
    ?>
    <video class="afterglow" id="myvideo" width="800" height="600" >
    <source type="video/mp4" src="video/<?php echo $v_w ?>" />
    </video>
</body>
</html>