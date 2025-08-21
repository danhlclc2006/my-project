<?php
session_start();
require_once __DIR__ . '/../model/connectDB.php'; 


$db = new connectDB();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($identifier === '' || $password === '') {
        $error = "Vui lòng nhập đầy đủ thông tin.";
    } else {
       
        $sql = "SELECT * FROM nguoidung WHERE email = ? OR name = ? LIMIT 1";
        
        $user = $db->queryOne($sql, [$identifier, $identifier]);

        if ($user) {
            $stored = $user['password'] ?? '';

            
            $ok = false;
            if ($stored !== '' && password_verify($password, $stored)) {
                $ok = true;
            } elseif ($password === $stored) {
                
                $ok = true;
            }

            if ($ok) {
                
                $_SESSION['user'] = $user;

                // Quy ước role: có thể là 'admin'/'user' hoặc 1/0
                $role = $user['role'] ?? '';

                if ($role === 'admin' || $role === '1' || $role === 1) {
                    header("Location: ../admin/home.php"); 
                    exit;
                } else {
                    header("Location: ../user/home.php"); 
                    exit;
                }
            } else {
                $error = "Email/username hoặc mật khẩu không đúng.";
            }
        } else {
            $error = "Tài khoản không tồn tại.";
        }
    }
}
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Đăng nhập</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="mb-3 text-center">Đăng nhập</h4>

                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form method="post" novalidate>
                        <div class="mb-3">
                            <label class="form-label">Email hoặc tên</label>
                            <input type="text" name="username" class="form-control" required value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button class="btn btn-primary w-100">Đăng nhập</button>
                        <p class="mt-3 text-center">
                            Chưa có tài khoản? <a href="register.php">Đăng ký</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
