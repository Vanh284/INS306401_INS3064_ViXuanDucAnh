<?php
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/ValidationException.php';

$errors = [];
$name = $specialty = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $specialty = trim($_POST['specialty'] ?? '');
    $formErrors = [];

    try {
        if ($name === '') $formErrors['name'] = 'Tên giảng viên không được để trống.';
        if ($specialty === '') $formErrors['specialty'] = 'Chuyên môn không được để trống.';

        if (!empty($formErrors)) {
            throw new ValidationException($formErrors);
        }

        Database::getInstance()->query(
            "INSERT INTO teachers (name, specialty) VALUES (?, ?)", 
            [$name, $specialty]
        );
        header('Location: index.php?msg=Thêm thành công');
        exit;
    } catch (ValidationException $ve) {
        $errors = $ve->getErrors();
    } catch (Exception $e) {
        $errors['general'] = "Lỗi: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Thêm Giảng viên</h1>
    <form method="post">
        <?php if(isset($errors['general'])) echo "<p style='color:red'>{$errors['general']}</p>"; ?>
        
        Tên: <input type="text" name="name" value="<?= htmlspecialchars($name) ?>"><br>
        <?php if(isset($errors['name'])) echo "<small style='color:red'>{$errors['name']}</small><br>"; ?>
        
        Chuyên môn: <input type="text" name="specialty" value="<?= htmlspecialchars($specialty) ?>"><br>
        <?php if(isset($errors['specialty'])) echo "<small style='color:red'>{$errors['specialty']}</small><br>"; ?>
        
        <br><button type="submit">Lưu</button>
        <a href="index.php">Hủy</a>
    </form>
</body>
</html>