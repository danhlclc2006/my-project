<div class="row">
    <div class="row frmtitel">
        <h1><i class="fas fa-box-open"></i> THÊM MỚI SẢN PHẨM</h1>
    </div>
    <div class="row frmcontent">
        <form action="index.php?act=addsp" method="post" enctype="multipart/form-data">
            <div class="row mb10">
                Tên sản phẩm <br>
                <input type="text" name="name" required>
            </div>
            <div class="row mb10">
                Giá <br>
                <input type="number" name="price" required>
            </div>
            <div class="row mb10">
                Hình ảnh <br>
                <input type="file" name="image" required>
            </div>
            <div class="row mb10">
                Mô tả <br>
                <textarea name="mota" rows="4"></textarea>
            </div>
            <div class="row mb10">
                Danh mục <br>
                <select name="iddm">
                    <?php foreach ($listdanhmuc as $dm): ?>
                        <option value="<?= $dm['id'] ?>"><?= $dm['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="row mb10">
                <input type="submit" name="themmoi" value="THÊM MỚI">
                <input type="reset" value="NHẬP LẠI">
                <a href="index.php?act=listsp"><input type="button" value="DANH SÁCH"></a>
            </div>
            <?php if (isset($thongbao) && $thongbao != ""): ?>
                <div class="row" style="color: green;">
                    <?= $thongbao ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>
