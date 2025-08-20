<!-- admin/sanpham/list.php -->
<div class="row">
    <div class="row frmtitel">
        <h1>DANH SÁCH SẢN PHẨM</h1>
    </div>
    <div class="row frmcontent">
        <form action="index.php?act=xoanhieusp" method="post">
            <div class="row mb10 formdsloai">
                <table>
                    <tr>
                        <th>Chọn</th>
                        <th>MÃ SP</th>
                        <th>TÊN SP</th>
                        <th>GIÁ</th>
                        <th>HÌNH</th>
                        <th>MÔ TẢ</th>
                        <th>DANH MỤC</th>
                        <th>THAO TÁC</th>
                    </tr>
                    <?php foreach ($listsanpham as $sp): extract($sp); ?>
                        <tr>
                            <td><input type="checkbox" name="chon[]" value="<?= $id ?>"></td>
                            <td><?= $id ?></td>
                            <td><?= htmlspecialchars($name) ?></td>
                            <td><?= number_format($price, 0, ',', '.') ?> ₫</td>
                            <td>
                                <?php if (!empty($image)): ?>
                                    <img src="../uploads/<?= $image ?>" height="50">
                                <?php else: ?>
                                    Không có ảnh
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($mota) ?></td>
                            <td><?= $iddm ?></td>
                            <td>
                                <a href="index.php?act=suasp&id=<?= $id ?>"><input type="button" value="Sửa"></a>
                                <a href="index.php?act=xoasp&id=<?= $id ?>" onclick="return confirm('Bạn có chắc muốn xóa?')"><input type="button" value="Xóa"></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="row mb10">
                <input type="button" value="Chọn tất cả" onclick="chonTatCa(true)">
                <input type="button" value="Bỏ chọn tất cả" onclick="chonTatCa(false)">
                <input type="submit" name="xoachon" value="Xóa các mục đã chọn" onclick="return confirm('Bạn có chắc muốn xóa không?')">
                <a href="index.php?act=addsp"><input type="button" value="Nhập thêm"></a>
            </div>

            <?php if (!empty($thongbao)): ?>
                <div class="row mb10" style="color: green; font-weight: bold;">
                    <?= $thongbao ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>

<script>
    function chonTatCa(status) {
        const checkboxes = document.querySelectorAll('input[type="checkbox"][name="chon[]"]');
        checkboxes.forEach(cb => cb.checked = status);
    }
</script>
