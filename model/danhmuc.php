<?php
// model/danhmuc.php
require_once "connectDB.php";

function insert_danhmuc($name) {
    $db = new connectDB();
    $sql = "INSERT INTO danhmuc(name) VALUES(?)";
    return $db->execute($sql, [$name]);
}

function get_all_danhmuc() {
    $db = new connectDB();
    $sql = "SELECT * FROM danhmuc ORDER BY id DESC";
    return $db->queryAll($sql);
}

function delete_danhmuc($id) {
    $db = new connectDB();
    $sql = "DELETE FROM danhmuc WHERE id=?";
    return $db->execute($sql, [$id]);
}

function get_one_danhmuc($id) {
    $db = new connectDB();
    $sql = "SELECT * FROM danhmuc WHERE id=?";
    return $db->queryOne($sql, [$id]);
}

function update_danhmuc($id, $name) {
    $db = new connectDB();
    $sql = "UPDATE danhmuc SET name=? WHERE id=?";
    return $db->execute($sql, [$name, $id]);
}
require_once 'connectDB.php';

function loadall_danhmuc() {
    $db = new connectDB();
    $sql = "SELECT * FROM danhmuc ORDER BY id DESC";
    return $db->queryAll($sql);
}

?>
