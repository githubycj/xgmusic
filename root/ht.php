<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>xiugoupanel 后台管理面板 - 1.1_beta</title>
</head>
<body>
<style>
body {
      background-image: url("ht.jpg");
      background-size: cover;
}
</style>
<h1 style="color: goldenrod;">修狗云音乐独立管理后台1.1_beta</h1>
<?php
$musicPath = "../"; // 替换为音乐文件夹的实际路径

$musicFiles = glob($musicPath . "*.mp3"); // 获取所有的mp3文件

if (count($musicFiles) > 0) {
    echo "音乐数量：" . count($musicFiles) . "<br><br>";
    echo "音乐文件名：<br>";
    foreach ($musicFiles as $file) {
        echo basename($file) . "<br>";
    }
} else {
    echo "没有找到音乐文件。";
}
?>
<br>
<form action="jmusic.php" method="post">
    <div>添加音乐缩略名</div>
    <input type="text" name="musicid" placeholder="音乐名(如:xxx.mp3)">
    <br>
    <div>添加音乐中文名</div>
    <input type="text" name="musicidx" placeholder="音乐名(如:海阔天空)">
    <br>
    <input type="submit" value="提交">
</form>
<br>
<form action="upload.php" method="post" enctype="multipart/form-data">
  <div>添加音乐文件</div>
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="上传文件" name="submit">
</form>
</body>
</html>