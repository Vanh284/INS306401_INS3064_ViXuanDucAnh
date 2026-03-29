<?php
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/ValidationException.php';

$db = Database::getInstance();
$id = (int)($_GET['id'] ?? 0);
$teacher = $db->fetch("SELECT * FROM teachers WHERE id = ?", [$id]);

if (!$teacher) die("Không tìm thấy giảng viên.");

$name = $teacher['name'];
$specialty = $teacher['specialty'];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $specialty = trim($_POST['specialty'] ?? '');
    $formErrors = [];

    try {
        if ($name === '') $formErrors['name'] = 'Tên giảng viên không được để trống.';
        if ($specialty === '') $formErrors['specialty'] = 'Chuyên môn không được để trống.';

        if (!empty($formErrors)) throw new ValidationException($formErrors);

        $db->query(
            "UPDATE teachers SET name = ?, specialty = ? WHERE id = ?", 
            [$name, $specialty, $id]
        );
        header('Location: index.php?msg=Cập nhật thành công');
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
    <h1>Sửa Giảng viên</h1>
    <form method="post">
        Tên: <input type="text" name="name" value="<?= htmlspecialchars($name) ?>"><br>
        <?php if(isset($errors['name'])) echo "<small style='color:red'>{$errors['name']}</small><br>"; ?>
        
        Chuyên môn: <input type="text" name="specialty" value="<?= htmlspecialchars($specialty) ?>"><br>
        <?php if(isset($errors['specialty'])) echo "<small style='color:red'>{$errors['specialty']}</small><br>"; ?>
        
        <br><button type="submit">Cập nhật</button>
        <a href="index.php">Hủy</a>
    </form>
</body>
</html>