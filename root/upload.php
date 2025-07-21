<html>
<a href="ht.php">返回</a>
</html>
<?php
$targetDirectory = "../"; // 上传文件保存的目录
$targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]); // 上传文件的完整路径

// 检查文件是否已经存在
if (file_exists($targetFile)) {
    echo "文件已存在。";
    exit;
}

// 检查文件大小限制（可选）
// if ($_FILES["fileToUpload"]["size"] > 1) {
//     echo "文件太大。";
//     exit;
// }

// 允许的文件类型（可选）
$allowedFileTypes = array("mp3");
$fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
if (!in_array($fileExtension, $allowedFileTypes)) {
    echo "只允许上传mp3文件。";
    exit;
}

// 保存上传的文件
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
    echo "文件上传成功。";
} else {
    echo "上传文件时出错。";
}
?>
