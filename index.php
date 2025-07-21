<?php
require_once 'config.php';

// 处理表单提交
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username'] ?? '');
    $message = mysqli_real_escape_string($conn, $_POST['message'] ?? '');
    
    if (!empty($username) && !empty($message)) {
        $sql = "INSERT INTO messages (username, message) VALUES ('$username', '$message')";
        mysqli_query($conn, $sql);
    }
    
    // 重定向防止重复提交
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

// 获取所有留言
$messages = [];
$result = mysqli_query($conn, "SELECT * FROM messages ORDER BY created_at DESC");
if ($result) {
    $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>留言板</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url('https://t.alcy.cc/pc');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .message-form{
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .message-list{
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        /* 新增：输入框透明模糊效果 */
        .form-group input,
        .form-group textarea {
            background: rgba(255, 255, 255, 0.3) !important;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            color: #333;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            background: rgba(255, 255, 255, 0.5) !important;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.3);
            outline: none;
        }
        
        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>留言板</h1>
        
        <!-- 留言表单 -->
        <form method="POST" class="message-form">
            <div class="form-group">
                <label for="username">用户名:</label>
                <input type="text" id="username" name="username" required placeholder="请输入昵称">
            </div>
            <div class="form-group">
                <label for="message">留言内容:</label>
                <textarea id="message" name="message" rows="4" required placeholder="请输入留言内容"></textarea>
            </div>
            <button type="submit">提交留言</button>
        </form>
        
        <!-- 留言列表 -->
        <div class="message-list">
            <h2>留言列表</h2>
            <?php if (empty($messages)): ?>
                <p class="empty-message">暂无留言</p>
            <?php else: ?>
                <?php foreach ($messages as $msg): ?>
                    <div class="message-item">
                        <div class="message-header">
                            <span class="username"><?= htmlspecialchars($msg['username']) ?></span>
                            <span class="time"><?= $msg['created_at'] ?></span>
                        </div>
                        <div class="message-content"><?= nl2br(htmlspecialchars($msg['message'])) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($conn); ?>