<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>xiugoupanel 后台管理面板 - 1.1_beta</title>
</head>
<body>
<h1>修狗云音乐独立管理后台1.1_beta</h1>
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