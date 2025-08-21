<?php
session_start();

require_once "../model/connectDB.php";
require_once "../model/sanpham.php";
require_once "../model/danhmuc.php";

$db = new connectDB();
$conn = $db->getConnection();

$id = $_GET['id'] ?? 0;
$product = get_sanpham_by_id($id);
?>

<?php include "header.php"; ?>
<!DOCTYPE html>
<html lang="vi" class="h-100">

<head>
    <meta charset="utf-8">
    <title>Chi tiết sản phẩm</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    >
    <link rel="stylesheet" href="../assets/css/product-detail.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<main role="main">
    <div class="container mt-4">
        <?php if ($product): ?>
        
        <div class="card mb-4 shadow-sm">
            <div class="container-fluid p-4">
                <form method="post" action="cart.php?action=add&id=<?= $product['id'] ?>">
                    <div class="row g-4">
                        
                        <div class="col-md-6">
                            <img src="../uploads/<?= ($product['image'] && file_exists('../uploads/'.$product['image'])) ? $product['image'] : 'default.png' ?>" 
                                 class="img-fluid rounded shadow-sm" 
                                 alt="<?= htmlspecialchars($product['name']) ?>">
                        </div>

                        
                        <div class="col-md-6">
                            <h3 class="product-title mb-3"><?= htmlspecialchars($product['name']) ?></h3>

                           
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-2 text-warning">⭐⭐⭐⭐☆</div>
                                <span class="text-muted">123 đánh giá</span>
                            </div>

                            
                            <h4 class="text-danger fw-bold mb-3">
                                <?= number_format($product['price'], 0, ',', '.') ?>đ
                            </h4>

                           
                            <p class="mb-3"><?= nl2br(htmlspecialchars($product['mota'])) ?></p>

                            
                            <p><strong>Danh mục:</strong> <?= htmlspecialchars(get_danhmuc_name($product['iddm'])) ?></p>

                            
                            <div class="mb-3">
                                <label for="soluong" class="form-label">Số lượng đặt mua:</label>
                                <input type="number" class="form-control w-25" id="soluong" name="soluong" value="1" min="1">
                            </div>

                            
                             
                            <div class="d-flex gap-2">
                              
                              <form method="post" action="cart.php?action=add&id=<?= $product['id'] ?>">
                              <input type="hidden" name="soluong" id="soluong_cart" value="1">
                              <button type="submit" class="btn btn-success">🛒 Thêm vào giỏ hàng</button>
                              </form>

                            
                             <form method="post" action="index.php?act=checkout">
                               <input type="hidden" name="id" value="<?= $product['id'] ?>">
                              <input type="hidden" name="qty" id="buyQty" value="1">
                               <button type="submit" class="btn btn-danger">Mua ngay</button>
                             </form>

                                <button type="button" class="btn btn-outline-danger">❤️ Yêu thích</button>
                                </div>

                               <script>
                             // khi thay đổi số lượng => cập nhật cho cả 2 form
                             document.getElementById('soluong').addEventListener('input', function() {
                             document.getElementById('soluong_cart').value = this.value;
                                document.getElementById('buyQty').value = this.value;
                              });
                             </script>

                           
                        </div>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="card mb-4">
            <div class="card-body">
                <h3>Thông tin chi tiết về sản phẩm</h3>
                <p><?= nl2br(htmlspecialchars($product['mota'])) ?></p>
            </div>
        </div>

        
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="mb-3">Sản phẩm liên quan</h4>
                <div class="row g-3">
                <?php
                $related = get_sanpham_lienquan($product['id'], $product['iddm']);
                if ($related):
                    foreach ($related as $pro): ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="card h-100 shadow-sm">
                                <img src="../uploads/<?= ($pro['image'] && file_exists('../uploads/'.$pro['image'])) ? $pro['image'] : 'default.png' ?>" 
                                     class="card-img-top" 
                                     alt="<?= htmlspecialchars($pro['name']) ?>">
                                <div class="card-body">
                                    <h6 class="card-title"><?= htmlspecialchars($pro['name']) ?></h6>
                                    <p class="text-danger fw-bold"><?= number_format($pro['price'], 0, ',', '.') ?>đ</p>
                                    <a href="index.php?act=detail&id=<?= $pro['id'] ?>" class="btn btn-sm btn-outline-primary">Xem</a>
                                </div>
                            </div>
                        </div>
                    
                    <?php endforeach; else: ?>
                        <p>Không có sản phẩm liên quan.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php else: ?>
            <div class="alert alert-warning">Sản phẩm không tồn tại.</div>
        <?php endif; ?>

        <!-- Bình luận -->
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="mb-3">Bình luận</h4>

                <!-- Form gửi bình luận -->
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="noidung" class="form-label">Nội dung bình luận</label>
                        <textarea name="noidung" id="noidung" rows="3" class="form-control" required></textarea>
                    </div>
                    <button type="submit" name="guibinhluan" class="btn btn-primary">Gửi bình luận</button>
                </form>

                <hr>

                <?php
if (isset($_POST['guibinhluan'])) {
    $noidung = trim($_POST['noidung']);
    $iduser  = $_SESSION['user']['id'] ?? null; // sửa lại
    $idpro   = $product['id']; // sản phẩm hiện tại

    if (!$iduser) {
        echo '<div class="alert alert-danger mt-2">Bạn cần đăng nhập để bình luận.</div>';
    } elseif ($noidung === '') {
        echo '<div class="alert alert-danger mt-2">Vui lòng nhập nội dung.</div>';
    } else {
        $sql = "INSERT INTO binhluan(noidung, iduser, idpro, ngaybinhluan)
                VALUES (:noidung, :iduser, :idpro, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':noidung' => $noidung,
            ':iduser'  => $iduser,
            ':idpro'   => $idpro
        ]);
        echo '<div class="alert alert-success mt-2">Bình luận đã được gửi!</div>';
    }
}

                

$sql = "SELECT b.noidung, b.ngaybinhluan, u.name 
        FROM binhluan b
        JOIN nguoidung u ON b.iduser = u.id
        WHERE b.idpro = :idpro
        ORDER BY b.id DESC";

$stmt = $conn->prepare($sql);

// Kiểm tra nếu product có id
if (!empty($product['id'])) {
    $ok = $stmt->execute([':idpro' => $product['id']]);
} else {
    $ok = false;
}

$binhluanList = $ok ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];

if (!empty($binhluanList)): ?>
    <?php foreach ($binhluanList as $bl): ?>
        <div class="border-bottom mb-2 pb-2">
            <p class="mb-1">
                <strong><?= htmlspecialchars($bl['name']) ?></strong>
                <span class="text-muted">(<?= htmlspecialchars($bl['ngaybinhluan']) ?>)</span>
            </p>
            <p class="mb-0"><?= htmlspecialchars($bl['noidung']) ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Chưa có bình luận nào. Hãy là người đầu tiên!</p>
<?php endif; ?>


            </div>
        </div>
    </div>
</main>
<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
