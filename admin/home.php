<?php 
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
include 'header.php';
?>

<style>
/* Toàn bộ trang */
.container {
    max-width: 1200px;
    margin: auto;
    padding: 20px;
    font-family: 'Segoe UI', Tahoma, sans-serif;
}

/* Khối chào mừng */
.welcome-box {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 40px;
    margin-bottom: 30px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.welcome-box h1 {
    font-size: 2.2rem;
    font-weight: bold;
    margin-bottom: 15px;
    color: #222;
}

.welcome-box p {
    font-size: 1rem;
    color: #555;
    margin-bottom: 20px;
}

.btn-primary {
    background-color: #0d6efd;
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    display: inline-block;
}

.btn-primary:hover {
    background-color: #0b5ed7;
}

/* Card danh mục */
.cards {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.card {
    background-color: white;
    border-radius: 8px;
    padding: 20px;
    flex: 1 1 calc(33.333% - 20px);
    min-width: 250px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    border: 1px solid #eee;
}

.card h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 10px;
}

.card p {
    font-size: 0.95rem;
    color: #555;
    margin-bottom: 15px;
}

.btn-outline {
    color: #0d6efd;
    border: 1px solid #0d6efd;
    padding: 6px 14px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
}

.btn-outline:hover {
    background-color: #0d6efd;
    color: white;
}
</style>

<div class="container">

    <!-- Khối chào mừng -->
    <div class="welcome-box">
        <h1>Chào mừng đến trang quản trị!</h1>
        <p>Tại đây bạn có thể quản lý người dùng, sản phẩm, đơn hàng và nhiều tính năng khác.</p>
        <a href="index.php?act=listsp" class="btn-primary">Bắt đầu quản lý</a>
    </div>

    <!-- Các thẻ card -->
    <div class="cards">
        <div class="card">
            <h3>Người dùng</h3>
            <p>Quản lý thông tin người dùng trong hệ thống.</p>
            <a href="index.php?act=listnd" class="btn-outline">Xem chi tiết</a>
        </div>

        <div class="card">
            <h3>Sản phẩm</h3>
            <p>Thêm, sửa, xóa và quản lý sản phẩm.</p>
            <a href="index.php?act=listsp" class="btn-outline">Xem chi tiết</a>
        </div>

        <div class="card">
            <h3>Bình luận</h3>
            <p>Theo dõi bình luận của khách.</p>
            <a href="index.php?act=listbl" class="btn-outline">Xem chi tiết</a>
        </div>
    </div>

</div>

<?php include 'footer.php'; ?>
