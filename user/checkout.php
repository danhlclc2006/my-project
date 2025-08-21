<?php
session_start();
require_once "../model/connectDB.php";
require_once "../model/sanpham.php";
require_once "../model/donhang.php";

$id = intval($_POST['id'] ?? $_GET['id'] ?? 0);
$qty = intval($_POST['qty'] ?? 1);

$product = get_sanpham_by_id($id);
if (!$product) {
    header("Location: index.php");
    exit;
}

$total = $product['price'] * $qty;
$thongbao = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hoten'])) {
    $hoten  = trim($_POST['hoten']);
    $phone  = trim($_POST['phone']);
    $diachi = trim($_POST['diachi']);
    $pttt   = $_POST['pttt'] ?? 'COD';
    $iduser = $_SESSION['user']['id'] ?? 0;

    if ($hoten && $phone && $diachi) {
        $iddh = create_order($iduser, $hoten, $phone, $diachi, $pttt, $total);
        if ($iddh) {
            create_order_item($iddh, $product['id'], $qty, $product['price']);
            header("Location: order_success.php?id=" . $iddh);
            exit;
        } else {
            $thongbao = "Không thể tạo đơn hàng.";
        }
    } else {
        $thongbao = "Vui lòng nhập đầy đủ thông tin.";
    }
}

include "header.php";
?>
<div class="container my-4">
  <h3>Thanh toán</h3>
  <?php if ($thongbao): ?><div class="alert alert-warning"><?= $thongbao ?></div><?php endif; ?>

  <div class="row">
    
    <div class="col-md-7">
      <form method="post">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <input type="hidden" name="qty" value="<?= $qty ?>">

        <div class="mb-3">
          <label>Họ tên</label>
          <input type="text" name="hoten" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Điện thoại</label>
          <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Địa chỉ</label>
          <input type="text" name="diachi" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Hình thức thanh toán</label>
          <select name="pttt" class="form-select">
            <option value="COD">Thanh toán khi nhận hàng</option>
            <option value="ChuyenKhoan">Chuyển khoản</option>
          </select>
        </div>
        <button class="btn btn-danger">Thanh toán</button>
      </form>
    </div>

   
    <div class="col-md-5">
      <div class="card">
        <div class="card-header">Đơn hàng</div>
        <div class="card-body">
          <p><strong><?= htmlspecialchars($product['name']) ?></strong></p>
          <p>Giá: <?= number_format($product['price'], 0, ',', '.') ?>đ</p>
          <p>Số lượng: <?= $qty ?></p>
          <p class="fw-bold text-danger">Tổng: <?= number_format($total, 0, ',', '.') ?>đ</p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
