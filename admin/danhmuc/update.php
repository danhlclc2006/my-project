<?php
if (isset($dm) && is_array($dm)) {
    extract($dm);
} else {
    $id = '';
    $name = '';
}
?>

<div class="row">
    <div class="row frmtitel">
        <h1>CẬP NHẬT LOẠI HÀNG HÓA</h1>
    </div>

    <div class="row frmcontent">
        <form action="index.php?act=updatedm" method="post">
            <div class="row mb10">
                Mã loại <br>
                <input type="text" name="maloai_display" value="<?= htmlspecialchars($id) ?>" disabled>
                <input type="hidden" name="ID" value="<?= htmlspecialchars($id) ?>">
            </div>
            <div class="row mb10">
                Tên loại <br>
                <input type="text" name="tenloai" value="<?= htmlspecialchars($name) ?>">
            </div>
            <div class="row mb10">
                <input type="submit" name="capnhat" value="CẬP NHẬT">
                <input type="reset" value="NHẬP LẠI">
                <a href="index.php?act=listdm"><input type="button" value="DANH SÁCH"></a>
            </div>

            <?php if (!empty($thongbao)): ?>
                <div class="row mb10" style="color: green;">
                    <?= htmlspecialchars($thongbao) ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>
