<?php
// File: core/Router.php
class Router {
    private $routes = [];

    public function get($url, $action) {
        $this->routes['GET'][$url] = $action;
    }

    public function dispatch() {
        // Lấy URL hiện tại
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        try {
            // Giả lập tìm kiếm route...
            if (isset($this->routes[$method][$uri])) {
                $action = $this->routes[$method][$uri];
                list($controllerName, $methodName) = explode('@', $action);
                
                // Khởi tạo Controller và gọi hàm tương ứng
                $controller = new $controllerName();
                $controller->$methodName();
            } else {
                throw new Exception("404 - Không tìm thấy trang này.");
            }

        } catch (PDOException $e) {
            // Lỗi liên quan đến Database (bắt riêng)
            echo "<h1>Hệ thống đang bảo trì. Lỗi kết nối dữ liệu.</h1>";
            // Ghi log lỗi ẩn đi: error_log($e->getMessage());
            
        } catch (Exception $e) {
            // Các lỗi hệ thống khác (ví dụ 404)
            echo "<h1>Đã xảy ra lỗi: " . $e->getMessage() . "</h1>";
        }
    }
}
?>