<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VMartPlus</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand fw-bold" href="index.php">VMartPlus</a>

    <!-- Nút menu khi màn hình nhỏ -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <!-- Form tìm kiếm -->
      <form class="d-flex ms-3" method="get" action="category.php">
     <input class="form-control me-2" type="search" name="search" placeholder="Tìm kiếm sản phẩm" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
     <button class="btn btn-light" type="submit">Tìm</button>
       </form>



      <!-- Menu bên phải -->
      <div class="ms-auto">
        <a href="index.php?act=sanpham" class="btn btn-light me-2">Sản phẩm</a>
        <a href="logout.php" class="btn btn-outline-light">Đăng xuất</a>
      </div>
    </div>
  </div>
</nav>
