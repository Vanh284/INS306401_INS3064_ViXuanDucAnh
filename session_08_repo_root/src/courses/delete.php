<?php
// courses/delete.php
require_once __DIR__ . '/../classes/Database.php';

$db = Database::getInstance();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$errorMsg = '';

// Lấy thông tin khóa học để xác nhận
$course = $db->fetch("SELECT * FROM courses WHERE id = ?", [$id]);

if (!$course) {
    die("Không tìm thấy khóa học này!");
}

// Xử lý khi người dùng bấm nút Xác nhận xóa (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Kiểm tra xem có sinh viên nào đang đăng ký khóa học này không
        $check = $db->fetch("SELECT COUNT(*) as total FROM enrollments WHERE course_id = ?", [$id]);
        
        if ($check['total'] > 0) {
            throw new Exception("Không thể xóa khóa học này vì đang có " . $check['total'] . " sinh viên đăng ký. Vui lòng hủy đăng ký trước.");
        }

        // Thực hiện lệnh DELETE nếu không bị vướng ràng buộc
        $db->query("DELETE FROM courses WHERE id = ?", [$id]);
        
        header('Location: index.php?success=deleted');
        exit;
        
    } catch (Exception $e) {
        // Bắt lỗi hệ thống hoặc lỗi do ràng buộc dữ liệu
        $errorMsg = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Xóa khóa học</title>
</head>
<body>
    <h1>Xác nhận xóa khóa học</h1>
    
    <?php if ($errorMsg): ?>
        <p style="color:red; font-weight:bold;"><?= htmlspecialchars($errorMsg) ?></p>
    <?php endif; ?>

    <div style="border: 1px solid #ccc; padding: 15px; max-width: 400px;">
        <p>Bạn có chắc chắn muốn xóa khóa học: <strong><?= htmlspecialchars($course['title']) ?></strong>?</p>
        <p><em>Hành động này không thể hoàn tác!</em></p>

        <form method="post">
            <button type="submit" style="color: red;">Xác nhận Xóa</button>
            <a href="index.php"><button type="button">Quay lại</button></a>
        </form>
    </div>
</body>
</html>