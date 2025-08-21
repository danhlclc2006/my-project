<?php
$act = $_GET['act'] ?? 'home';

switch ($act) {
    case 'category':
        include "category.php";
        break;

    case 'sanpham':  
        include "category.php";
        break;

    case 'detail':
        include "detail.php";
        break;

    case 'checkout':  
        include "checkout.php";
        break;

    case 'order_success': 
        include "order_success.php";
        break;

    default:
        include "home.php";
        break;
}
?>
