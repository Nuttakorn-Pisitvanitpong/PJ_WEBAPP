<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD_VIDEO</title>
</head>
<body>
    <form action="upload1.php" method="post" enctype="multipart/form-data">
        set your video name : <input type="text" name="video_name"><br>
        Select video to upload:
        <input type="file" name="videoToUpload"><br>
        Select imege to upload<input type="file" name="fileToUpload">
        <input type="submit" value="Upload" name="submit">
    </form>
</body>
</html>