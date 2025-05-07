## 🚀 Cài đặt

### 1. Cài đặt Composer

Cài đặt các package PHP cần thiết:

```bash
composer install

### 2. Tạo file cấu hình môi trường `.env`

Sao chép file `.env.example` thành `.env`
Sau đó mở file `.env` và cấu hình các thông tin kết nối cơ bản, ví dụ:
APP_NAME=LaravelApp
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ten_database
DB_USERNAME=ten_user
DB_PASSWORD=mat_khau

### 3. Tạo khóa ứng dụng

Tạo khóa mã hóa ứng dụng:
php artisan key:generate

### 4. Chạy migration và seed dữ liệu (nếu có)

Thiết lập bảng trong database và tạo dữ liệu mẫu:
php artisan migrate –seed

### 5. Khởi động server Laravel

Chạy ứng dụng ở môi trường local:
php artisan serve
Sau đó mở trình duyệt truy cập địa chỉ: http://127.0.0.1:8000
```