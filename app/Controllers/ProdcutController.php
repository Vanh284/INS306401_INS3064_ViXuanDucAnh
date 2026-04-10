<?php
// File: app/Controllers/ProductController.php
class ProductController {
    
    // Hiển thị danh sách sản phẩm
    public function index() {
        $model = new ProductModel();
        $products = $model->all(); // Lấy mảng dữ liệu từ Model
        
        // Gọi file View và truyền biến $products sang đó
        require_once '../app/Views/products/index.php';
    }

    // Hiển thị form Edit
    public function edit($id) {
        // Giả lập lấy dữ liệu 1 sản phẩm từ DB
        $product = [
            'id' => $id, 
            'name' => 'Điện thoại iPhone 15', 
            'price' => 1000
        ];
        
        // Gọi file View và biến $product sẽ được sử dụng trực tiếp trong file này
        require_once '../app/Views/products/edit.php';
    }
}
?>