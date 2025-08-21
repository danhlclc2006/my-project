<?php
session_start();
require_once "../model/connectDB.php";
require_once "../model/donhang.php";

$id = intval($_GET['id'] ?? 0);
$order = get_order_by_id($id);
if (!$order) {
    header("Location: index.php");
    exit;
}

include "header.php";
?>
<div class="container my-4 text-center">
  <h3 class="text-success">🎉 Đặt hàng thành công!</h3>
  <p>Cảm ơn bạn <strong><?= htmlspecialchars($order['hoten']) ?></strong> đã mua hàng.</p>
  <p>Đơn hàng #<?= $order['id'] ?> với tổng tiền 
     <span class="fw-bold text-danger"><?= number_format($order['tongtien'], 0, ',', '.') ?>đ</span>
     sẽ được giao sớm nhất.</p>
  <a href="index.php" class="btn btn-primary mt-3">Về trang chủ</a>
</div>
<?php include "footer.php"; ?>
