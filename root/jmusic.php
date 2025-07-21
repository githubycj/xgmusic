<html>
<a href="ht.php">返回</a>
</html>
<?php
$musicid = $_POST["musicid"];
$musicm = $_POST["musicidx"];
$insertContent = '    <a href="https://你的网站/' . $musicid . '">' . $musicm . '</a><br>';
$file = "../music.html";

// 读取文件内容
$lines = file($file);

if ($lines) {

    // 在倒数第14行的末尾插入回车和变量
    array_splice($lines, -14, 0, $insertContent . "\n");

    // 将修改后的内容写回文件
    file_put_contents($file, implode('', $lines));
    echo "恭喜成功";
} else {
    echo "遗憾失败";
}
?>
