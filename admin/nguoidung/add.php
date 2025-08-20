
<div class="row">
    <div class="row frmtitel">
        <h1><i class="fas fa-user-plus"></i> THÊM MỚI NGƯỜI DÙNG</h1>
    </div>
    <div class="row frmcontent">
        <form action="index.php?act=addnd" method="post">
            <div class="row mb10">
                <label for="name">Họ tên</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="row mb10">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="row mb10">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="row mb10">
                <label for="role">Vai trò</label>
                <select id="role" name="role">
                    <option value="user">Người dùng</option>
                    <option value="admin">Quản trị viên</option>
                </select>
            </div>
            <div class="row mb10">
                <input type="submit" name="themmoi" value="THÊM MỚI">
                <input type="reset" value="NHẬP LẠI">
                <a href="index.php?act=listnd"><input type="button" value="DANH SÁCH"></a>
            </div>
            
            <?php if (isset($thongbao) && !empty($thongbao)): ?>
         <div class="notification success">
          <i class="fas fa-check-circle"></i>
          <?= $thongbao ?>
          </div>
          <?php endif; ?>

            
        </form>
    </div>
</div>