<?php
// courses/create.php
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/ValidationException.php'; // Require class mới

$errors = [];
$title = '';
$description = '';

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

        // Nếu có lỗi, ném ngoại lệ ValidationException
        if (!empty($formErrors)) {
            throw new ValidationException($formErrors);
        }

        // 2. Lưu vào Database nếu không có lỗi
        $db = Database::getInstance();
        $db->insert('courses', [
            'title' => $title,
            'description' => $description
        ]);

        header('Location: index.php?success=1');
        exit;

    } catch (ValidationException $ve) {
        // Bắt lỗi validate và hiển thị ra form
        $errors = $ve->getErrors();
    } catch (Exception $e) {
        $errors['general'] = 'Lỗi hệ thống: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head><title>Thêm khóa học</title></head>
<body>
    <h1>Thêm khóa học mới</h1>
    
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
        <div>
            <label>Mô tả:</label><br>
            <textarea name="description"><?= htmlspecialchars($description) ?></textarea>
        </div>
        <button type="submit">Lưu khóa học</button>
    </form>
</body>
</html>