<?php
// File: public/index.php

// 1. Cấu hình Autoloading
spl_autoload_register(function ($class) {
    // Khai báo các thư mục có thể chứa class
    $directories = [
        '../app/Controllers/',
        '../app/Models/',
        '../core/'
    ];

    foreach ($directories as $dir) {
        $file = $dir . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return; // Tìm thấy rồi thì dừng vòng lặp
        }
    }
});

// Chạy Router sau khi đã có autoload...
// $router = new Router();
?>