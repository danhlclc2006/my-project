<?php 
require_once "../model/connectDB.php";
require_once "../model/sanpham.php";
require_once "../model/danhmuc.php";
include "header.php"; 

// Lấy tham số GET
$iddm    = $_GET['iddm'] ?? '';
$search  = $_GET['search'] ?? '';
$price   = $_GET['price'] ?? '';
$page    = isset($_GET['p']) ? max(1, intval($_GET['p'])) : 1; 

// Cấu hình phân trang
$limit   = 8; 
$offset  = ($page - 1) * $limit;

// Lấy danh mục
$danhmucs = get_all_danhmuc();

// Lấy danh sách sản phẩm
$products = get_all_sanpham_paging($limit, $offset, $search, $iddm, $price);

// Tổng số sản phẩm để phân trang
$totalProducts = count_sanpham($search, $iddm, $price);
$totalPages = ceil($totalProducts / $limit);

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>VMartPlus - Danh mục sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container my-4">
    <div class="row">
        <!-- Sidebar danh mục -->
        <aside class="col-md-3 mb-4">
            <h5 class="mb-3">Danh mục sản phẩm</h5>
            <ul class="list-group">
                <?php foreach ($danhmucs as $dm): ?>
                    <li class="list-group-item <?= ($iddm == $dm['id']) ? 'active' : '' ?>">
                        <a href="category.php?iddm=<?= $dm['id'] ?>" class="d-block <?= ($iddm == $dm['id']) ? 'text-white' : '' ?>">
                            <?= htmlspecialchars($dm['name']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <h6 class="mt-4">Lọc theo giá</h6>
            <ul class="list-group">
                <li class="list-group-item <?= ($price=='1') ? 'active' : '' ?>">
                    <a href="category.php?price=1" class="<?= ($price=='1')?'text-white':'' ?>">Dưới 500.000đ</a>
                </li>
                <li class="list-group-item <?= ($price=='2') ? 'active' : '' ?>">
                    <a href="category.php?price=2" class="<?= ($price=='2')?'text-white':'' ?>">500.000đ - 1.000.000đ</a>
                </li>
                <li class="list-group-item <?= ($price=='3') ? 'active' : '' ?>">
                    <a href="category.php?price=3" class="<?= ($price=='3')?'text-white':'' ?>">Trên 1.000.000đ</a>
                </li>
            </ul>
        </aside>

        <!-- Danh sách sản phẩm -->
        <section class="col-md-9">
            <h4 class="mb-3 text-danger">
                <?php 
                if ($iddm != '') {
                    echo "Danh mục: " . htmlspecialchars(get_danhmuc_name($iddm));
                } elseif ($search != '') {
                    echo "Kết quả tìm kiếm: " . htmlspecialchars($search);
                } elseif ($price != '') {
                    echo "Lọc theo giá";
                } else {
                    echo "Tất cả sản phẩm";
                }
                ?>
            </h4>

            <div class="row g-4">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $pro): ?>
                        <div class="col-md-3 col-sm-4 col-6">
                            <div class="card h-100 product-card">
                                <img src="../uploads/<?= htmlspecialchars($pro['image']) ?>" 
                                     class="card-img-top" 
                                     alt="<?= htmlspecialchars($pro['name']) ?>">
                                <div class="card-body text-center">
                                    <h6 class="card-title"><?= htmlspecialchars($pro['name']) ?></h6>
                                    <p class="text-danger fw-bold mb-2">
                                        <?= number_format($pro['price'],0,",",".") ?> đ
                                    </p>
                                    <a href="detail.php?id=<?= $pro['id'] ?>" class="btn btn-sm btn-danger">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">Không tìm thấy sản phẩm nào.</p>
                <?php endif; ?>
            </div>

            <!-- Phân trang -->
            <?php if ($totalPages > 1): ?>
                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <?php for ($i=1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($i==$page)?'active':'' ?>">
                                <a class="page-link" 
                                   href="category.php?iddm=<?= $iddm ?>&search=<?= urlencode($search) ?>&price=<?= $price ?>&p=<?= $i ?>">
                                   <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </section>
    </div>
</div>

<?php include "footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
