<?php
// enrollments/index.php
require_once __DIR__ . '/../classes/Database.php';

$db = Database::getInstance();

// 1. XỬ LÝ LỌC (FILTER)
$course_id = isset($_GET['course_id']) ? (int)$_GET['course_id'] : 0;
$where = "1=1";
$params = [];

if ($course_id > 0) {
    $where .= " AND e.course_id = ?";
    $params[] = $course_id;
}

// Lấy danh sách khóa học cho Dropdown Lọc
$courses = $db->fetchAll("SELECT id, title FROM courses ORDER BY title");

// 2. XỬ LÝ PHÂN TRANG (PAGINATION)
$limit = 10; // 10 bản ghi/trang
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page); // Đảm bảo page >= 1
$offset = ($page - 1) * $limit;

// Đếm tổng số bản ghi để tính số trang
$totalRow = $db->fetch("SELECT COUNT(*) as total FROM enrollments e WHERE $where", $params);
$totalRecords = $totalRow['total'];
$totalPages = ceil($totalRecords / $limit);

// 3. TRUY VẤN DỮ LIỆU
$sql = "SELECT e.id, s.name AS student_name, c.title AS course_title, e.enrolled_at 
        FROM enrollments e
        JOIN students s ON e.student_id = s.id
        JOIN courses c ON e.course_id = c.id
        WHERE $where 
        ORDER BY e.enrolled_at DESC 
        LIMIT $limit OFFSET $offset";

$enrollments = $db->fetchAll($sql, $params);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách đăng ký học</title>
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
<h1>Danh sách đăng ký học</h1>

<p>
    <a href="create.php" class="btn btn-add">+ Thêm đăng ký</a>
</p>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Sinh viên</th>
        <th>Email</th>
        <th>Khóa học</th>
        <th>Thời gian đăng ký</th>
        <th>Hành động</th>
    </tr>

    <?php foreach ($enrollments as $enroll): ?>
        <tr>
            <td><?= $enroll['id'] ?></td>
            <td><?= htmlspecialchars($enroll['student_name']) ?></td>
            <td><?= htmlspecialchars($enroll['email']) ?></td>
            <td><?= htmlspecialchars($enroll['course_title']) ?></td>
            <td><?= $enroll['enrolled_at'] ?></td>
            <td>
                <a href="delete.php?id=<?= $enroll['id'] ?>"
                   onclick="return confirm('Hủy đăng ký này?');">Xóa</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>