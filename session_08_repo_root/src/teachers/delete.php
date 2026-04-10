<?php
require_once __DIR__ . '/../classes/Database.php';

$db = Database::getInstance();
$id = (int)($_GET['id'] ?? 0);
$teacher = $db->fetch("SELECT * FROM teachers WHERE id = ?", [$id]);

if (!$teacher) die("Không tìm thấy giảng viên.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db->query("DELETE FROM teachers WHERE id = ?", [$id]);
        header('Location: index.php?msg=Xóa thành công');
        exit;
    } catch (Exception $e) {
        $error = "Lỗi khi xóa: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Xóa Giảng viên</h1>
    <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    
    <p>Bạn có chắc chắn muốn xóa giảng viên: <strong><?= htmlspecialchars($teacher['name']) ?></strong> (Chuyên môn: <?= htmlspecialchars($teacher['specialty']) ?>)?</p>
    
    <form method="post">
        <button type="submit" style="color:red;">Xác nhận xóa</button>
        <a href="index.php">Hủy</a>
    </form>
</body>
</html>