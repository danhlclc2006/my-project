
<div class="row">
    <div class="row frmtitel">
        <h1>DANH SÁCH NGƯỜI DÙNG</h1>
    </div>
    <div class="row frmcontent">
        <form action="index.php?act=xoanhieund" method="post">
            <div class="row mb10 formdsloai">
                <table>
                    <tr>
                        <th>Chọn</th>
                        <th>ID</th>
                        <th>HỌ TÊN</th>
                        <th>EMAIL</th>
                        <th>VAI TRÒ</th>
                        <th>NGÀY TẠO</th>
                        <th>THAO TÁC</th>
                    </tr>
                    <?php foreach ($listnguoidung as $nd):
                        extract($nd);
                        $suand = "index.php?act=suand&id=" . $id;
                        $xoand = "index.php?act=xoand&id=" . $id;
                    ?>
                    <tr>
                        <td><input type="checkbox" name="chon[]" value="<?= $id ?>"></td>
                        <td><?= $id ?></td>
                        <td><?= htmlspecialchars($name) ?></td>
                        <td><?= htmlspecialchars($email) ?></td>
                        <td>
                            <span class="badge <?= $role == 'admin' ? 'bg-danger' : 'bg-primary' ?>">
                                <?= $role == 'admin' ? 'Admin' : 'User' ?>
                            </span>
                        </td>
                        <td><?= date('d/m/Y', strtotime($created_at)) ?></td>
                        <td>
                            <a href="<?= $suand ?>"><input type="button" value="Sửa"></a>
                            <a href="<?= $xoand ?>" onclick="return confirm('Bạn có chắc muốn xóa?')"><input type="button" value="Xóa"></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <div class="row mb10">
                <input type="button" value="Chọn tất cả" onclick="chonTatCa(true)">
                <input type="button" value="Bỏ chọn tất cả" onclick="chonTatCa(false)">
                <input type="submit" name="xoachon" value="Xóa các mục đã chọn" onclick="return confirm('Bạn có chắc muốn xóa không?')">
                <a href="index.php?act=addnd"><input type="button" value="Nhập thêm"></a>
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
