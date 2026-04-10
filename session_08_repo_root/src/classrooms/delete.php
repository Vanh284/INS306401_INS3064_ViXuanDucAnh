<?php
require_once __DIR__ . '/../classes/Database.php';

$db = Database::getInstance();
$id = (int)($_GET['id'] ?? 0);
$room = $db->fetch("SELECT * FROM classrooms WHERE id = ?", [$id]);

if (!$room) die("Không tìm thấy phòng học.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db->query("DELETE FROM classrooms WHERE id = ?", [$id]);
        header('Location: index.php?msg=Xóa phòng học thành công');
        exit;
    } catch (Exception $e) {
        $error = "Lỗi khi xóa: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Xóa Phòng học</h1>
    <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    
    <p>Bạn có chắc chắn muốn xóa phòng học: <strong><?= htmlspecialchars($room['name']) ?></strong> (Sức chứa: <?= htmlspecialchars($room['capacity']) ?> người)?</p>
    
    <form method="post">
        <button type="submit" style="color:red;">Xác nhận xóa</button>
        <a href="index.php">Hủy</a>
    </form>
</body>
</html>