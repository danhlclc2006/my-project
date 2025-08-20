<?php
require_once "connectDB.php";


function insert_nguoidung($name, $email, $password, $role) {
    $db = new connectDB();
    $sql = "INSERT INTO nguoidung(name, email, password, role) VALUES(?, ?, ?, ?)";
    return $db->execute($sql, [$name, $email, $password, $role]);
}

function get_all_nguoidung() {
    $sql = "SELECT * FROM nguoidung ORDER BY id DESC"; 
    $db = new connectDB();
    return $db->queryAll($sql);
}



function delete_nguoidung($id) {
    $db = new connectDB();
    $sql = "DELETE FROM nguoidung WHERE id=?";
    return $db->execute($sql, [$id]);
}

function get_one_nguoidung($id) {
    $db = new connectDB();
    $sql = "SELECT * FROM nguoidung WHERE id=?";
    return $db->queryOne($sql, [$id]);
}

function update_nguoidung($id, $name, $email, $role) {
    $db = new connectDB();
    $sql = "UPDATE nguoidung SET name=?, email=?, role=? WHERE id=?";
    return $db->execute($sql, [$name, $email, $role, $id]);
}
function get_email_nguoidung($email) {
    $sql = "SELECT * FROM nguoidung WHERE email = ?";
    return (new connectDB())->queryOne($sql, [$email]);
}
function index() {
    $listnguoidung = get_all_nguoidung(); // Hàm lấy danh sách người dùng từ DB
    include 'view/nguoidung/list.php'; // đường dẫn đúng đến file hiển thị danh sách
}
function get_all_khachhang() {
    $sql = "SELECT * FROM nguoidung WHERE role = 'user' ORDER BY id DESC";
    $db = new connectDB();
    return $db->queryAll($sql);



    $ds_user = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $ds_user[] = $row;
        }
    }
    return $ds_user;
}




?>