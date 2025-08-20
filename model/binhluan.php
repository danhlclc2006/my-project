<?php
require_once "connectDB.php"; 

// Lấy tất cả bình luận
function loadall_binhluan() {
    $db = new connectDB();
    $sql = "SELECT * FROM binhluan ORDER BY id DESC";
    return $db->queryAll($sql);
}

// Lấy bình luận theo sản phẩm
function load_binhluan_by_sanpham($idsp) {
    $db = new connectDB();
    $sql = "SELECT * FROM binhluan WHERE idsp = ? ORDER BY id DESC";
    return $db->queryAll($sql, [$idsp]);
}

// Thêm bình luận mới
function insert_binhluan($noidung, $iduser, $idsp) {
    $db = new connectDB();
    $sql = "INSERT INTO binhluan (noidung, iduser, idsp, ngaybinhluan) VALUES (?, ?, ?, NOW())";
    return $db->execute($sql, [$noidung, $iduser, $idsp]);
}

// Xoá bình luận theo ID
function delete_binhluan($id) {
    $db = new connectDB();
    $sql = "DELETE FROM binhluan WHERE id = ?";
    return $db->execute($sql, [$id]);
}

// Lấy 1 bình luận
function get_one_binhluan($id) {
    $db = new connectDB();
    $sql = "SELECT * FROM binhluan WHERE id = ?";
    return $db->queryOne($sql, [$id]);
}
?>
