<?php
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/ValidationException.php';

$errors = [];
$name = '';
$capacity = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $capacity = trim($_POST['capacity'] ?? '');
    $formErrors = [];

    try {
        // Validate
        if ($name === '') $formErrors['name'] = 'Tên phòng không được để trống.';
        if ($capacity === '' || !is_numeric($capacity) || (int)$capacity <= 0) {
            $formErrors['capacity'] = 'Sức chứa phải là một số lớn hơn 0.';
        }

        if (!empty($formErrors)) {
            throw new ValidationException($formErrors);
        }

        // Insert
        Database::getInstance()->query(
            "INSERT INTO classrooms (name, capacity) VALUES (?, ?)", 
            [$name, (int)$capacity]
        );
        header('Location: index.php?msg=Thêm phòng học thành công');
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
    <h1>Thêm Phòng học mới</h1>
    <form method="post">
        <?php if(isset($errors['general'])) echo "<p style='color:red'>{$errors['general']}</p>"; ?>
        
        Tên phòng: <input type="text" name="name" value="<?= htmlspecialchars($name) ?>"><br>
        <?php if(isset($errors['name'])) echo "<small style='color:red'>{$errors['name']}</small><br>"; ?>
        <br>
        Sức chứa: <input type="number" name="capacity" value="<?= htmlspecialchars($capacity) ?>"><br>
        <?php if(isset($errors['capacity'])) echo "<small style='color:red'>{$errors['capacity']}</small><br>"; ?>
        
        <br><button type="submit">Lưu</button>
        <a href="index.php">Hủy</a>
    </form>
</body>
</html>