<?php
// 数据库配置
define('DB_HOST', 'localhost');
define('DB_USER', '数据库用户名');
define('DB_PASS', '数据库密码');
define('DB_NAME', '数据库名');

// 创建数据库连接
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("数据库连接失败: " . mysqli_connect_error());
}

// 设置字符集
mysqli_set_charset($conn, 'utf8');

// 检查表是否存在，不存在则创建
$checkTable = "SHOW TABLES LIKE 'messages'";
$result = mysqli_query($conn, $checkTable);

if (mysqli_num_rows($result) == 0) {
    $createTable = "CREATE TABLE messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        ip_address VARCHAR(45),
        is_deleted TINYINT(1) DEFAULT 0
    )";
    
    if (!mysqli_query($conn, $createTable)) {
        die("创建表失败: " . mysqli_error($conn));
    }
}
?>