<?php

$act = $_GET['act'] ?? 'home';

switch ($act) {
    case 'category':
        include "category.php";
        break;

    case 'sanpham':   // để hiển thị danh sách + tìm kiếm
        include "category.php";
        break;

    case 'detail':
        include "detail.php";
        break;

    default:
        include "home.php";
        break;
}


?>
