<div class="row">
    <div class="row frmtitel">
        <h1>DANH SÁCH BÌNH LUẬN</h1>
    </div>
    <div class="row frmcontent">
        <form action="index.php?act=xoanhieubl" method="post">
            <div class="row mb10 formdsloai">
                <table>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>NỘI DUNG</th>
                        <th>ID NGƯỜI DÙNG</th>
                        <th>ID SẢN PHẨM</th>
                        <th>NGÀY BÌNH LUẬN</th>
                        <th>THAO TÁC</th>
                    </tr>

                    <?php if (!empty($listbinhluan)) : ?>
                        <?php foreach ($listbinhluan as $bl): ?>
                            <tr>
                                <td><input type="checkbox" name="chon[]" value="<?= $bl['id'] ?>"></td>
                                <td><?= $bl['id'] ?></td>
                                <td><?= htmlspecialchars($bl['noidung']) ?></td>
                                <td><?= $bl['iduser'] ?></td>
                                <td><?= $bl['idpro'] ?></td>
                                <td><?= $bl['ngaybinhluan'] ?></td>
                                <td>
                                    <a href="index.php?act=xoabinhluan&id=<?= $bl['id'] ?>" 
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này không?')">
                                       <input type="button" value="Xóa">
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align:center;">Chưa có bình luận nào</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>

            <div class="row mb10">
                <input type="button" value="Chọn tất cả" onclick="chonTatCa(true)">
                <input type="button" value="Bỏ chọn tất cả" onclick="chonTatCa(false)">
                <input type="submit" name="xoachon" value="Xóa các bình luận đã chọn" onclick="return confirm('Bạn có chắc muốn xóa không?')">
            </div>
        </form>

        <?php if (!empty($thongbao)): ?>
        <div class="row mb10" style="color: green; font-weight: bold;">
            <?= $thongbao ?>
        </div>
        <?php endif; ?>
    </div>

    <script>
        function chonTatCa(check) {
            const checkboxes = document.querySelectorAll('input[name="chon[]"]');
            checkboxes.forEach(cb => cb.checked = check);
        }
    </script>
</div>
