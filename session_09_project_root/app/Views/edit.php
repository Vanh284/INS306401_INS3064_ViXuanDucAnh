<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sản phẩm</title>
</head>
<body>
    <h2>Chỉnh sửa sản phẩm #<?= $product['id'] ?></h2>
    
    <form action="/products/update" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
        
        <p>
            <label for="name">Tên sản phẩm:</label><br>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
        </p>
        
        <p>
            <label for="price">Giá (USD):</label><br>
            <input type="number" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
        </p>
        
        <button type="submit">Lưu thay đổi</button>
        <a href="/products">Hủy bỏ</a>
    </form>
</body>
</html>