<?php
// courses/index.php
require_once __DIR__ . '/../classes/Database.php';

$db = Database::getInstance();

// Lấy danh sách tất cả các khóa học, sắp xếp mới nhất lên đầu
$sql = "SELECT * FROM courses ORDER BY id DESC";
$courses = $db->fetchAll($sql);

// Bắt thông báo thành công từ các trang thêm/sửa/xóa chuyển hướng về
$successMsg = '';
if (isset($_GET['success'])) {
    if ($_GET['success'] == '1') {
        $successMsg = "Thêm khóa học thành công!";
    } elseif ($_GET['success'] == 'updated') {
        $successMsg = "Cập nhật khóa học thành công!";
    } elseif ($_GET['success'] == 'deleted') {
        $successMsg = "Xóa khóa học thành công!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Khóa học</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; border-radius: 3px; }
        .btn-add { background-color: #28a745; display: inline-block; margin-bottom: 15px; }
        .btn-edit { background-color: #ffc107; color: black; }
        .btn-delete { background-color: #dc3545; }
        .alert { padding: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; margin-bottom: 15px; }
    </style>
</head>
<body>

    <h1>Danh sách Khóa học</h1>

    <?php if ($successMsg): ?>
        <div class="alert">
            <?= htmlspecialchars($successMsg) ?>
        </div>
    <?php endif; ?>

    <a href="create.php" class="btn btn-add">+ Thêm khóa học mới</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề (Title)</th>
                <th>Mô tả (Description)</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($courses) > 0): ?>
                <?php foreach ($courses as $course): ?>
                    <tr>
                        <td><?= htmlspecialchars($course['id']) ?></td>
                        <td><strong><?= htmlspecialchars($course['title']) ?></strong></td>
                        <td><?= htmlspecialchars($course['description'] ?? 'Không có mô tả') ?></td>
                        <td>
                            <a href="edit.php?id=<?= $course['id'] ?>" class="btn btn-edit">Sửa</a>
                            <a href="delete.php?id=<?= $course['id'] ?>" class="btn btn-delete"
                               onclick="return confirm('Bạn chắc chắn muốn xóa?');">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center;">Chưa có khóa học nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>