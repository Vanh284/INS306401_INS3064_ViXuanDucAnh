<?php
require_once __DIR__ . '/../classes/Database.php';
$db = Database::getInstance();

// Lấy danh sách phòng học
$classrooms = $db->fetchAll("SELECT * FROM classrooms ORDER BY id DESC");
$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <?php
require_once __DIR__ . '/../classes/Database.php';
$db = Database::getInstance();

// Lấy danh sách phòng học
$classrooms = $db->fetchAll("SELECT * FROM classrooms ORDER BY id DESC");
$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Phòng học</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background: #4CAF50; color: #fff; }
        .btn { padding: 4px 8px; text-decoration: none; border-radius: 3px; }
        .btn-add { background: #4CAF50; color: #fff; }
        .btn-edit { background: #2196F3; color: #fff; }
        .btn-delete { background: #f44336; color: #fff; }
    </style>
</head>
<body>
    <h1>Danh sách Phòng học</h1>
    <?php if ($msg): ?>
        <p style="color: green; font-weight: bold;"><?= htmlspecialchars($msg) ?></p>
    <?php endif; ?>
    
    <a href="create.php" style="display:inline-block; margin-bottom:10px;">+ Thêm Phòng học</a>
    
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <tr>
            <th>ID</th>
            <th>Tên phòng</th>
            <th>Sức chứa</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($classrooms as $room): ?>
        <tr>
            <td><?= $room['id'] ?></td>
            <td><strong><?= htmlspecialchars($room['name']) ?></strong></td>
            <td><?= htmlspecialchars($room['capacity']) ?> người</td>
            <td>
                <a href="edit.php?id=<?= $room['id'] ?>">Sửa</a> | 
                <a href="delete.php?id=<?= $room['id'] ?>" style="color:red;">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html><title>Quản lý Phòng học</title></head>
<body>
    <h1>Danh sách Phòng học</h1>
    <?php if ($msg): ?>
        <p style="color: green; font-weight: bold;"><?= htmlspecialchars($msg) ?></p>
    <?php endif; ?>
    
    <a href="create.php" style="display:inline-block; margin-bottom:10px;">+ Thêm Phòng học</a>
    
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <tr>
            <th>ID</th>
            <th>Tên phòng</th>
            <th>Sức chứa</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($classrooms as $room): ?>
        <tr>
            <td><?= $room['id'] ?></td>
            <td><strong><?= htmlspecialchars($room['name']) ?></strong></td>
            <td><?= htmlspecialchars($room['capacity']) ?> người</td>
            <td>
                <a href="edit.php?id=<?= $room['id'] ?>">Sửa</a> | 
                <a href="delete.php?id=<?= $room['id'] ?>" style="color:red;">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>