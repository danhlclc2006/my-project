<?php
require_once "connectDB.php";

function insert_sanpham($name, $price, $image, $mota, $iddm) {
    $db = new connectDB();
    $sql = "INSERT INTO sanpham(name, price, image, mota, iddm) VALUES(?, ?, ?, ?, ?)";
    return $db->execute($sql, [$name, $price, $image, $mota, $iddm]);
}

function get_all_sanpham($search = '', $category_id = '', $price = '') {
    $db = new connectDB();
    $sql = "SELECT * FROM sanpham WHERE 1";
    $params = [];

    if ($search != '') {
        $sql .= " AND name LIKE ?";
        $params[] = "%$search%";
    }
    if ($category_id != '') {
        $sql .= " AND iddm = ?";
        $params[] = $category_id;
    }
    if ($price == '1') {
        $sql .= " AND price < ?";
        $params[] = 500000;
    }
    if ($price == '2') {
        $sql .= " AND price BETWEEN ? AND ?";
        $params[] = 500000;
        $params[] = 1000000;
    }
    if ($price == '3') {
        $sql .= " AND price > ?";
        $params[] = 1000000;
    }

    $sql .= " ORDER BY id DESC";
    return $db->queryAll($sql, $params);
}

function delete_sanpham($id) {
    $db = new connectDB();
    $sql = "DELETE FROM sanpham WHERE id=?";
    return $db->execute($sql, [$id]);
}

function get_one_sanpham($id) {
    $db = new connectDB();
    $sql = "SELECT * FROM sanpham WHERE id=?";
    return $db->queryOne($sql, [$id]);
}

function update_sanpham($id, $name, $price, $image, $mota, $iddm) {
    $db = new connectDB();
    if ($image != "") {
        $sql = "UPDATE sanpham SET name=?, price=?, image=?, mota=?, iddm=? WHERE id=?";
        return $db->execute($sql, [$name, $price, $image, $mota, $iddm, $id]);
    } else {
        $sql = "UPDATE sanpham SET name=?, price=?, mota=?, iddm=? WHERE id=?";
        return $db->execute($sql, [$name, $price, $mota, $iddm, $id]);
    }
}

function get_sanpham_by_id($id) {
    $db = new connectDB();
    $sql = "SELECT * FROM sanpham WHERE id = ?";
    return $db->queryOne($sql, [$id]);
}

function get_sanpham_lienquan($id, $iddm) {
    $db = new connectDB();
    $sql = "SELECT * FROM sanpham WHERE iddm = ? AND id != ? LIMIT 4";
    return $db->queryAll($sql, [$iddm, $id]);
}

function get_sanpham_by_category($iddm, $limit = 6) {
    $db = new connectDB();
    $sql = "SELECT * FROM sanpham WHERE iddm = ? ORDER BY id DESC LIMIT $limit";
    return $db->queryAll($sql, [$iddm]);
}

function search_sanpham($keyword) {
    $db = new connectDB();
    $sql = "SELECT * FROM sanpham WHERE name LIKE ?";
    return $db->queryAll($sql, ["%$keyword%"]);
}
function get_danhmuc_name($iddm) {
    $db = new connectDB();
    $sql = "SELECT name FROM danhmuc WHERE id = ?";
    return $db->queryOne($sql, [$iddm])['name'] ?? null;
}
function get_all_sanpham_paging($limit, $offset, $search = '', $category_id = '', $price = '') {
    $db = new connectDB();
    $sql = "SELECT * FROM sanpham WHERE 1";
    $params = [];

    if ($search != '') {
        $sql .= " AND name LIKE ?";
        $params[] = "%$search%";
    }
    if ($category_id != '') {
        $sql .= " AND iddm = ?";
        $params[] = $category_id;
    }
    if ($price == '1') {
        $sql .= " AND price < ?";
        $params[] = 500000;
    }
    if ($price == '2') {
        $sql .= " AND price BETWEEN ? AND ?";
        $params[] = 500000;
        $params[] = 1000000;
    }
    if ($price == '3') {
        $sql .= " AND price > ?";
        $params[] = 1000000;
    }

    $sql .= " ORDER BY id DESC LIMIT $limit OFFSET $offset";
    return $db->queryAll($sql, $params);
}

function count_sanpham($search = '', $category_id = '', $price = '') {
    $db = new connectDB();
    $sql = "SELECT COUNT(*) as total FROM sanpham WHERE 1";
    $params = [];

    if ($search != '') {
        $sql .= " AND name LIKE ?";
        $params[] = "%$search%";
    }
    if ($category_id != '') {
        $sql .= " AND iddm = ?";
        $params[] = $category_id;
    }
    if ($price == '1') {
        $sql .= " AND price < ?";
        $params[] = 500000;
    }
    if ($price == '2') {
        $sql .= " AND price BETWEEN ? AND ?";
        $params[] = 500000;
        $params[] = 1000000;
    }
    if ($price == '3') {
        $sql .= " AND price > ?";
        $params[] = 1000000;
    }

    $row = $db->queryOne($sql, $params);
    return $row['total'] ?? 0;
}

?>
