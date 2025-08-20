<div class="row">
    <div class="row frmtitel">
        <h1>CẬP NHẬT SẢN PHẨM</h1>
    </div>
    <div class="row frmcontent">
        <form action="index.php?act=updatesp" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $sanpham['id'] ?>">

            <div class="row mb10">
                Tên sản phẩm <br>
                <input type="text" name="name" value="<?= $sanpham['name'] ?>" required>
            </div>
            <div class="row mb10">
                Giá <br>
                <input type="number" name="price" value="<?= $sanpham['price'] ?>" required>
            </div>
            <div class="row mb10">
                Hình ảnh hiện tại <br>
                <?php if ($sanpham['image']): ?>
                    <img src="../uploads/<?= $sanpham['image'] ?>" height="50"><br>
                <?php endif; ?>
                Cập nhật hình ảnh mới <br>
                <input type="file" name="image">
            </div>
            <div class="row mb10">
                Mô tả <br>
                <textarea name="mota" rows="5" style="width: 100%;"><?= $sanpham['mota'] ?></textarea>
            </div>
            <div class="row mb10">
                Danh mục <br>
                <select name="iddm">
                    <?php foreach ($listdanhmuc as $dm): ?>
                        <option value="<?= $dm['id'] ?>" <?= $dm['id'] == $sanpham['iddm'] ? "selected" : "" ?>>
                            <?= $dm['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- 🔧 Phần bị thiếu được thêm lại -->
            <div class="row mb10">
                <input type="submit" name="capnhat" value="CẬP NHẬT">
                <input type="reset" value="NHẬP LẠI">
                <a href="index.php?act=listsp"><input type="button" value="DANH SÁCH"></a>
            </div>

            <?php if (isset($thongbao)) echo "<div class='row' style='color: green;'>$thongbao</div>"; ?>
        </form>
    </div>
</div>
