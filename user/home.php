<?php 
require_once "../model/connectDB.php";
require_once "../model/sanpham.php";
require_once "../model/danhmuc.php";

$danhmucs = get_all_danhmuc();
?>
<?php include "header.php"; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>VMartPlus - Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>

<main class="container my-4">

    <!-- Banner -->
    <div id="carouselExampleIndicators" class="carousel slide mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../uploads/banner1.jpg" class="d-block w-100" alt="Banner 1">
            </div>
            <div class="carousel-item">
                <img src="../uploads/banner2.jpg" class="d-block w-100" alt="Banner 2">
            </div>
        </div>
    </div>

    <!-- Danh mục sản phẩm -->
    <?php foreach ($danhmucs as $dm): ?>
        <section class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h4 text-danger"><?= $dm['name'] ?></h2>
                <a href="category.php?iddm=<?= $dm['id'] ?>" class="btn btn-outline-danger btn-sm">Xem thêm</a>
            </div>
            <div class="row">
                <?php 
                $products = get_sanpham_by_category($dm['id'], 6);
                foreach ($products as $pro): ?>
                    <div class="col-md-2 col-sm-4 col-6 mb-4">
                        <div class="card h-100 product-card">
                            <img src="../uploads/<?= $pro['image'] ?>" class="card-img-top" alt="<?= $pro['name'] ?>">
                            <div class="card-body text-center">
                                <h6 class="card-title"><?= $pro['name'] ?></h6>
                                <p class="text-danger fw-bold"><?= number_format($pro['price'],0,",",".") ?> đ</p>
                                <a href="detail.php?id=<?= $pro['id'] ?>" class="btn btn-sm btn-danger">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endforeach; ?>

</main>

<?php include "footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
