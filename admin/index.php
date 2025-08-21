<?php
require_once "../model/connectDB.php";
require_once "../model/danhmuc.php";
require_once "../model/sanpham.php";
require_once "../model/thongke.php"; 
require_once "../model/nguoidung.php";
require_once "../model/binhluan.php";



include "header.php";

$thongbao = "";

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {

        /*QUẢN LÝ DANH MỤC*/
        case 'adddm':
            if (isset($_POST['themmoi'])) {
                $name = $_POST['tenloai'] ?? '';
                $thanhcong = insert_danhmuc($name);
                $thongbao = $thanhcong ? " Thêm mới thành công" : " Thêm mới thất bại";
            }
            include "danhmuc/add.php";
            break;

        case 'listdm':
            $listdanhmuc = get_all_danhmuc();
            include "danhmuc/list.php";
            break;

        case 'xoadm':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                delete_danhmuc($_GET['id']);
            }
            header("Location: index.php?act=listdm");
            break;

        case 'suadm':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $dm = get_one_danhmuc($_GET['id']);
            }
            include "danhmuc/update.php";
            break;

        case 'updatedm':
            if (isset($_POST['capnhat'])) {
                $id = $_POST['ID'] ?? '';
                $name = $_POST['tenloai'] ?? '';
                $thanhcong = update_danhmuc($id, $name);
                $thongbao = $thanhcong ? " Cập nhật thành công" : " Cập nhật thất bại";
            }
            $listdanhmuc = get_all_danhmuc();
            include "danhmuc/list.php";
            break;

        case 'xoanhieudm':
            if (isset($_POST['xoachon']) && isset($_POST['chon'])) {
                foreach ($_POST['chon'] as $id) {
                    delete_danhmuc($id);
                }
                $thongbao = "✅ Đã xoá các mục đã chọn!";
            }
            $listdanhmuc = get_all_danhmuc();
            include "danhmuc/list.php";
            break;

        /* QUẢN LÝ SẢN PHẨM*/
        case 'addsp':
            $listdanhmuc = get_all_danhmuc();
            if (isset($_POST['themmoi'])) {
                $name = $_POST['name'] ?? '';
                $price = $_POST['price'] ?? '';
                $iddm = $_POST['iddm'] ?? '';
                $mota = $_POST['mota'] ?? '';
                $image = "";

                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $image = basename($_FILES['image']['name']);
                    $target_path = "../uploads/" . $image;
                    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                    }
                }

                $thanhcong = insert_sanpham($name, $price, $image, $mota, $iddm);
                $thongbao = $thanhcong ? " Thêm sản phẩm thành công" : " Thêm thất bại";
            }
            include "sanpham/add.php";
            break;

        case 'listsp':
            $listsanpham = get_all_sanpham();
            include "sanpham/list.php";
            break;

        case 'xoasp':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                delete_sanpham($_GET['id']);
            }
            header("Location: index.php?act=listsp");
            break;

        case 'suasp':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $sanpham = get_one_sanpham($_GET['id']);
                $listdanhmuc = get_all_danhmuc();
            }
            include "sanpham/update.php";
            break;

        case 'updatesp':
            if (isset($_POST['capnhat'])) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $mota = $_POST['mota'];
                $iddm = $_POST['iddm'];
            
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $target_dir = "../uploads/";
                    $filename = basename($_FILES["image"]["name"]);
                    $target_file = $target_dir . $filename;
            
                    // Kiểm tra định dạng ảnh
                    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                        $image = $filename; // Gán ảnh mới nếu upload thành công
                    } else {
                        echo "<script>alert('Chỉ cho phép file ảnh JPG, JPEG, PNG, GIF');</script>";
                    }
                }
            
                // Cập nhật vào DB
                update_sanpham($id, $name, $price, $image, $mota, $iddm);
                $thongbao = "Cập nhật sản phẩm thành công!";
            }
            $listsanpham = get_all_sanpham();
            include "sanpham/list.php";
            break;

        case 'xoanhieusp':
            if (isset($_POST['xoachon']) && isset($_POST['chon'])) {
                foreach ($_POST['chon'] as $id) {
                    delete_sanpham($id);
                }
                $thongbao = "✅ Đã xoá các sản phẩm đã chọn!";
            }
            $listsanpham = get_all_sanpham();
            include "sanpham/list.php";
            break;

        /*DASHBOARD*/
        case 'thongke':
            
            $listdanhmuc = get_all_danhmuc();
            $listsanpham = get_all_sanpham();
            $listnguoidung = get_all_nguoidung();
            $listbinhluan = loadall_binhluan();
        
            
            $admin_count = 0;
            $user_count = 0;
            foreach ($listnguoidung as $nd) {
                if ($nd['role'] === 'admin') {
                    $admin_count++;
                } else {
                    $user_count++;
                }
            }
        
            include "thongke/list.php";
            break;
        
        /* QUẢN LÝ NGƯỜI DÙNG */
        case 'addnd':
            if (isset($_POST['themmoi'])) {
                $name = $_POST['name'] ?? '';
                $email = $_POST['email'] ?? '';
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $role = $_POST['role'] ?? 'user';
        
                
                $ds_email = get_email_nguoidung($email);
                if ($ds_email) {
                    $thongbao = "❌ Email đã tồn tại!";
                } else {
                    $thanhcong = insert_nguoidung($name, $email, $password, $role);
                    if ($thanhcong) {
                        header("Location: index.php?act=listnd");
                        exit();
                    } else {
                        $thongbao = "❌ Thêm thất bại (Lỗi DB)";
                    }
                }
            }
            include "nguoidung/add.php";
            break;
        
        

        case 'listnd':
            $listnguoidung = get_all_nguoidung();
            include "nguoidung/list.php";
            break;

        case 'xoand':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                delete_nguoidung($_GET['id']);
            }
            header("Location: index.php?act=listnd");
            break;

        case 'suand':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $nd = get_one_nguoidung($_GET['id']);
            }
            include "nguoidung/update.php";
            break;

        case 'updatend':
            if (isset($_POST['capnhat'])) {
                $id = $_POST['id'] ?? '';
                $name = $_POST['name'] ?? '';
                $email = $_POST['email'] ?? '';
                $role = $_POST['role'] ?? 'user';

                $thanhcong = update_nguoidung($id, $name, $email, $role);
                $thongbao = $thanhcong ? "✅ Cập nhật thành công" : "❌ Cập nhật thất bại";
            }
            $listnguoidung = get_all_nguoidung();
            include "nguoidung/list.php";
            break;

        case 'xoanhieund':
            if (isset($_POST['xoachon']) && isset($_POST['chon'])) {
                foreach ($_POST['chon'] as $id) {
                    delete_nguoidung($id);
                }
                $thongbao = "✅ Đã xoá các người dùng đã chọn!";
            }
            $listnguoidung = get_all_nguoidung();
            include "nguoidung/list.php";
            break;
            case "listkh":
                $listkhachhang = get_all_khachhang();
                include "nguoidung/listkh.php";
                break;
                /*QUẢN LÝ BÌNH LUẬN */
                case 'listbl':
                    $listbinhluan = loadall_binhluan();
                    include "binhluan/list.php";
                    break;
        
                case 'xoabinhluan':
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        delete_binhluan($_GET['id']);
                        $thongbao = " Đã xóa bình luận thành công!";
                    }
                    $listbinhluan = loadall_binhluan();
                    include "binhluan/list.php";
                    break;
        
                case 'xoanhieubl':
                    if (isset($_POST['xoachon']) && isset($_POST['chon'])) {
                        foreach ($_POST['chon'] as $id) {
                            delete_binhluan($id);
                        }
                        $thongbao = " Đã xóa các bình luận được chọn!";
                    }
                    $listbinhluan = loadall_binhluan();
                    include "binhluan/list.php";
                    break;

            //  TRANG HOME
        }
    } else {
        include "home.php";
    }
    

    include "footer.php";
?>
