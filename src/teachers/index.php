<?php
require_once __DIR__ . '/../classes/Database.php';
$db = Database::getInstance();

$teachers = $db->fetchAll("SELECT * FROM teachers ORDER BY id DESC");
$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý giảng viên</title>
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
    <h1>Danh sách Giảng viên</h1>
    <?php if ($msg): ?>
        <p style="color: green; font-weight: bold;"><?= htmlspecialchars($msg) ?></p>
    <?php endif; ?>
    
    <a href="create.php" style="display:inline-block; margin-bottom:10px;">+ Thêm Giảng viên</a>
    
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <tr>
            <th>ID</th>
            <th>Tên Giảng viên</th>
            <th>Chuyên môn</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($teachers as $t): ?>
        <tr>
            <td><?= $t['id'] ?></td>
            <td><?= htmlspecialchars($t['name']) ?></td>
            <td><?= htmlspecialchars($t['specialty']) ?></td>
            <td>
                <a href="edit.php?id=<?= $t['id'] ?>">Sửa</a> | 
                <a href="delete.php?id=<?= $t['id'] ?>" style="color:red;">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>