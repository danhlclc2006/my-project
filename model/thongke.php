<?php
require_once "connectDB.php";

// Đếm số sản phẩm trong từng danh mục
function thongke_sanpham_danhmuc() {
    $db = new connectDB();
    $sql = "SELECT dm.id, dm.name AS tendanhmuc, COUNT(sp.id) AS soluong, 
                   MIN(sp.price) AS gia_min, MAX(sp.price) AS gia_max, 
                   AVG(sp.price) AS gia_avg
            FROM danhmuc dm
            LEFT JOIN sanpham sp ON dm.id = sp.iddm
            GROUP BY dm.id, dm.name
            ORDER BY soluong DESC";
    return $db->queryAll($sql);
}

// Lấy sản phẩm bán chạy (ví dụ: dựa trên số lượng trong bảng đơn hàng)
function thongke_sanpham_banchay($limit = 5) {
    $db = new connectDB();
    $sql = "SELECT sp.id, sp.name, SUM(ct.soluong) AS tongsoluong, SUM(ct.soluong * sp.price) AS doanhthu
            FROM chitietdonhang ct
            JOIN sanpham sp ON ct.idsanpham = sp.id
            GROUP BY sp.id, sp.name
            ORDER BY tongsoluong DESC
            LIMIT ?";
    return $db->queryAll($sql, [$limit]);
}

// Thống kê doanh thu theo tháng
function thongke_doanhthu_thang() {
    $db = new connectDB();
    $sql = "SELECT DATE_FORMAT(dh.ngaydat, '%Y-%m') AS thang, 
                   SUM(ct.soluong * sp.price) AS doanhthu
            FROM donhang dh
            JOIN chitietdonhang ct ON dh.id = ct.iddonhang
            JOIN sanpham sp ON ct.idsanpham = sp.id
            WHERE dh.trangthai = 'Hoàn tất'
            GROUP BY thang
            ORDER BY thang DESC";
    return $db->queryAll($sql);
}
?>
