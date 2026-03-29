<?php
// courses/edit.php
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/ValidationException.php';

$db = Database::getInstance();
$errors = [];

// Lấy ID khóa học từ URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Lấy thông tin khóa học hiện tại để hiển thị lên form
$course = $db->fetch("SELECT * FROM courses WHERE id = ?", [$id]);

if (!$course) {
    die("Không tìm thấy khóa học này!");
}

// Khởi tạo biến từ dữ liệu cũ
$title = $course['title'];
$description = $course['description'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $formErrors = [];

    try {
        // 1. Validate dữ liệu
        if ($title === '') {
            $formErrors['title'] = 'Tiêu đề không được để trống.';
        } elseif (mb_strlen($title) < 3) {
            $formErrors['title'] = 'Tiêu đề phải dài ít nhất 3 ký tự.';
        }

        // Ném lỗi nếu có
        if (!empty($formErrors)) {
            throw new ValidationException($formErrors);
        }

        // 2. Thực hiện UPDATE vào database
        $sql = "UPDATE courses SET title = ?, description = ? WHERE id = ?";
        $db->query($sql, [$title, $description, $id]);

        // Chuyển hướng về trang danh sách
        header('Location: index.php?success=updated');
        exit;

    } catch (ValidationException $ve) {
        $errors = $ve->getErrors();
    } catch (Exception $e) {
        $errors['general'] = 'Lỗi hệ thống: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head><title>Sửa khóa học</title></head>
<body>
    <h1>Sửa khóa học: <?= htmlspecialchars($course['title']) ?></h1>
    
    <?php if (!empty($errors['general'])): ?>
        <p style="color:red;"><?= htmlspecialchars($errors['general']) ?></p>
    <?php endif; ?>

    <form method="post">
        <div>
            <label>Tiêu đề (>= 3 ký tự):</label><br>
            <input type="text" name="title" value="<?= htmlspecialchars($title) ?>">
            <?php if (!empty($errors['title'])): ?>
                <span style="color:red;"><?= htmlspecialchars($errors['title']) ?></span>
            <?php endif; ?>
        </div>
        <br>
        <div>
            <label>Mô tả:</label><br>
            <textarea name="description"><?= htmlspecialchars($description) ?></textarea>
        </div>
        <br>
        <button type="submit">Cập nhật khóa học</button>
        <a href="index.php">Hủy</a>
    </form>
</body>
</html>