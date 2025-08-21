<?php
require_once "connectDB.php";

// Tạo đơn hàng mới
function create_order($iduser, $hoten, $phone, $diachi, $pttt, $tongtien) {
    $db = new connectDB();
    $conn = $db->getConnection();

    $sql = "INSERT INTO donhang(iduser, hoten, phone, diachi, pttt, tongtien, ngaydat, trangthai) 
            VALUES (:iduser, :hoten, :phone, :diachi, :pttt, :tongtien, NOW(), 'Đang xử lý')";
    $stmt = $conn->prepare($sql);
    $ok = $stmt->execute([
        ':iduser'   => $iduser,
        ':hoten'    => $hoten,
        ':phone'    => $phone,
        ':diachi'   => $diachi,
        ':pttt'     => $pttt,
        ':tongtien' => $tongtien
    ]);
    return $ok ? $conn->lastInsertId() : 0;
}

// Thêm sản phẩm vào chi tiết đơn hàng
function create_order_item($iddh, $idpro, $soluong, $dongia) {
    $db = new connectDB();
    $conn = $db->getConnection();

    $sql = "INSERT INTO donhang_chitiet(iddh, idpro, soluong, dongia) 
            VALUES (:iddh, :idpro, :soluong, :dongia)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        ':iddh'    => $iddh,
        ':idpro'   => $idpro,
        ':soluong' => $soluong,
        ':dongia'  => $dongia
    ]);
}

// Lấy thông tin đơn hàng theo id
function get_order_by_id($id) {
    $db = new connectDB();
    $conn = $db->getConnection();

    $sql = "SELECT * FROM donhang WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
