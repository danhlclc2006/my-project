<div class="row">
    <div class="row frmtitel">
        <h1>CẬP NHẬT DANH MỤC MỚI </h1>
    </div>

    <div class="row frmcontent">
        <form action="index.php?act=adddm" method="post">
            <div class="row mb10">
                Mã loại <br>
                <input type="text" name="maloai" disabled placeholder="Auto number">
            </div>
            <div class="row mb10">
                Tên loại <br>
                <input type="text" name="tenloai" value="<?= isset($name) ? htmlspecialchars($name) : '' ?>">
            </div>
            <div class="row mb10">
                <input type="submit" name="themmoi" value="THÊM MỚI">
                <input type="reset" value="NHẬP LẠI">
                <a href="index.php?act=listdm"><input type="button" value="DANH SÁCH"></a>
            </div>

            
            <?php if (!empty($thongbao)): ?>
                <div class="row mb10" style="color: green;">
                    <?= $thongbao ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>
