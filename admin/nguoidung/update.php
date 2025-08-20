
<?php
if (isset($nd) && is_array($nd)) {
    extract($nd);
} else {
    $id = '';
    $name = '';
    $email = '';
    $role = '';
}
?>

<div class="row">
    <div class="row frmtitel">
        <h1><i class="fas fa-user-edit"></i> CẬP NHẬT NGƯỜI DÙNG</h1>
    </div>
    <div class="row frmcontent">
        <form action="index.php?act=updatend" method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
            
            <div class="row mb10">
                <label for="name">Họ tên</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required>
            </div>
            <div class="row mb10">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
            </div>
            <div class="row mb10">
                <label for="role">Vai trò</label>
                <select id="role" name="role">
                    <option value="user" <?= $role == 'user' ? 'selected' : '' ?>>Người dùng</option>
                    <option value="admin" <?= $role == 'admin' ? 'selected' : '' ?>>Quản trị viên</option>
                </select>
            </div>
            <div class="row mb10">
                <input type="submit" name="capnhat" value="CẬP NHẬT">
                <input type="reset" value="NHẬP LẠI">
                <a href="index.php?act=listnd"><input type="button" value="DANH SÁCH"></a>
            </div>

            <?php if (!empty($thongbao)): ?>
            <div class="notification success">
                <i class="fas fa-check-circle"></i>
                <?= htmlspecialchars($thongbao) ?>
            </div>
            <?php endif; ?>
        </form>
    </div>
</div>