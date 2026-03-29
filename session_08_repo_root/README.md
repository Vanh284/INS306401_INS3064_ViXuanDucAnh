# School Management System (PHP CRUD)

## Giới thiệu dự án 
**School Management System** là một ứng dụng web cơ bản được xây dựng bằng **PHP thuần** và **MySQL**. Dự án này tập trung vào việc thực hành các thao tác CRUD (Create, Read, Update, Delete) nâng cao, xử lý quan hệ nhiều-nhiều (Many-to-Many) trong cơ sở dữ liệu, và áp dụng các tiêu chuẩn bảo mật cơ bản như PDO Prepared Statements để chống SQL Injection.

Dự án bao gồm quản lý các thực thể: Sinh viên (Students), Khóa học (Courses), Đăng ký học (Enrollments), Giảng viên (Teachers) và Phòng học (Classrooms).

---

## 🚀 Các tính năng đã triển khai
- **Quản lý Sinh viên (Students):** Thêm, sửa, xóa, và xem danh sách sinh viên.
- **Quản lý Khóa học (Courses):** Thêm, sửa, xóa, và xem danh sách khóa học.
- **Quản lý Đăng ký (Enrollments):** - Ghi danh sinh viên vào khóa học.
  - Lọc (Filter) danh sách đăng ký theo khóa học cụ thể.
  - Phân trang (Pagination) danh sách hiển thị.
- **Quản lý Giảng viên (Teachers):** Module CRUD bổ sung quản lý thông tin và chuyên môn của giảng viên.
- **Quản lý Phòng học (Classrooms):** Module CRUD bổ sung quản lý sức chứa của các phòng học.

### ✨ Tính năng nâng cao
- **Bảo mật Cơ sở dữ liệu:** Sử dụng 100% `PDO` và `Prepared Statements`.
- **Thiết kế Singleton Pattern:** Tối ưu hóa kết nối Database (chỉ tạo 1 instance duy nhất).
- **Custom Exception Handling:** Bắt và xử lý lỗi Validation form thông qua class `ValidationException` tự định nghĩa.
- **Quản lý Môi trường (Environment Config):** Có cơ chế bật/tắt hiển thị lỗi (`error_reporting`) giữa môi trường Development và Production.

---


## 📂 Cấu trúc thư mục tham khảo (Directory Structure)
```text
repo-root/
├── classes/
│   ├── Database.php            # Xử lý kết nối PDO (Singleton)
│   └── ValidationException.php # Xử lý lỗi form
├── config/
│   └── database.php            # File cấu hình thật (Ignored in Git)
├── database/
│   └── school_db.sql           # File export CSDL để import
├── students/                   # Module sinh viên (index, create, edit, delete)
├── courses/                    # Module khóa học
├── enrollments/                # Module đăng ký
├── teachers/                   # Module giảng viên
├── classrooms/                 # Module phòng học
└── README.md                   # Tài liệu hướng dẫn này