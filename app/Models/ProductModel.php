<?php
// File: app/Models/ProductModel.php
require_once '../core/Model.php';

class ProductModel extends Model {
    // Implement hàm validate bắt buộc từ class cha
    public function validate($data): bool {
        if (empty($data['name']) || empty($data['price'])) {
            return false;
        }
        if (!is_numeric($data['price'])) {
            return false;
        }
        return true;
    }
}
?>