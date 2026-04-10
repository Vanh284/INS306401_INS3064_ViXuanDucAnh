<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
    <style>
        table { width: 50%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Danh sách sản phẩm</h2>
    <a href="/products/create">Thêm sản phẩm mới</a>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $item): ?>
                <tr>
                    <td><?= $item['id'] ?? 'N/A' ?></td>
                    <td><?= $item['name'] ?? 'Sản phẩm mẫu' ?></td>
                    <td>
                        <a href="/products/edit?id=<?= $item['id'] ?? 1 ?>">Sửa</a> | 
                        <a href="/products/delete?id=<?= $item['id'] ?? 1 ?>" onclick="return confirm('Bạn có chắc muốn xóa?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>