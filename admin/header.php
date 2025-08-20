<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
$username = $_SESSION['user']['username'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X SHOP - Admin Panel</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="boxcenter">
        <div class="row mb headeradmin">
            <h1><i class="fas fa-store"></i> X SHOP ADMIN</h1>
            <div class="welcome-text">
                Xin chào, <strong><?= htmlspecialchars($username) ?></strong>
            </div>
        </div>
        <div class="row mb menu">
            <ul>
                <!-- Trang chủ -->
                <li><a href="home.php" class="<?= basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : '' ?>">
                    <i class="fas fa-home"></i> Trang chủ
                </a></li>

                <li><a href="index.php?act=adddm" class="<?= isset($_GET['act']) && in_array($_GET['act'], ['adddm', 'listdm', 'suadm', 'updatedm', 'xoanhieudm']) ? 'active' : '' ?>"><i class="fas fa-list"></i> Danh mục</a></li>
                <li><a href="index.php?act=addsp" class="<?= isset($_GET['act']) && in_array($_GET['act'], ['addsp', 'listsp', 'suasp', 'updatesp', 'xoanhieusp']) ? 'active' : '' ?>"><i class="fas fa-box"></i> Sản phẩm</a></li>
                <li><a href="index.php?act=addnd" class="<?= isset($_GET['act']) && in_array($_GET['act'], ['addnd', 'listnd', 'suand', 'updatend', 'xoanhieund']) ? 'active' : '' ?>"><i class="fas fa-users"></i> Người dùng</a></li>
                <li><a href="index.php?act=listkh" class="<?= isset($_GET['act']) && $_GET['act'] == 'listkh' ? 'active' : '' ?>"><i class="fas fa-user-friends"></i> Khách hàng</a></li>
                <li><a href="index.php?act=listbl" class="<?= isset($_GET['act']) && $_GET['act'] == 'listbl' ? 'active' : '' ?>"><i class="fas fa-comments"></i> Bình luận</a></li>
                <li><a href="index.php?act=thongke" class="<?= isset($_GET['act']) && $_GET['act'] == 'thongke' ? 'active' : '' ?>"><i class="fas fa-chart-bar"></i> Thống kê</a></li>

                <!-- Đăng xuất -->
                <li><a href="../auth/logout.php">
                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                </a></li>
            </ul>
        </div>
