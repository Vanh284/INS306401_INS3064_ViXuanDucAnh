<?php
// File: core/Model.php
abstract class Model {
    protected $db;

    public function __construct() {
        // Giả lập kết nối Database bằng PDO
        // $this->db = new PDO('mysql:host=localhost;dbname=my_app', 'root', '');
    }

    // Abstract method: Ép buộc các class con phải tự viết logic validate riêng
    abstract public function validate($data): bool;

    // Shared method: Hàm dùng chung cho mọi Model để lấy toàn bộ dữ liệu
    public function all() {
        // Ví dụ: return $this->db->query("SELECT * FROM table")->fetchAll();
        return ["item 1", "item 2"]; // Trả về mảng giả lập
    }
}
?>