<div class="row">
    <div class="row frmtitel">
        <h1>DANH SÁCH DANH MỤC</h1>
    </div>
    <div class="row frmcontent">
        <form action="index.php?act=xoanhieudm" method="post">
            <div class="row mb10 formdsloai">
                <table>
                    <tr>
                        <th></th>
                        <th>MÃ DANH MỤC</th>
                        <th>TÊN DANH MỤC</th>
                        <th>THAO TÁC</th>
                    </tr>
                    <?php foreach ($listdanhmuc as $danhmuc): 
                        extract($danhmuc);
                        $suadm = "index.php?act=suadm&id=".$id;
                        $xoadm = "index.php?act=xoadm&id=".$id;
                    ?>
                    <tr>
                        <td><input type="checkbox" name="chon[]" value="<?= $id ?>"></td>
                        <td><?= $id ?></td>
                        <td><?= $name ?></td>
                        <td>
                            <a href="<?= $suadm ?>"><input type="button" value="Sửa"></a>
                            <a href="<?= $xoadm ?>" onclick="return confirm('Bạn chắc chắn muốn xóa?')"><input type="button" value="Xóa"></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="row mb10">
                <input type="button" value="Chọn tất cả" onclick="chonTatCa(true)">
                <input type="button" value="Bỏ chọn tất cả" onclick="chonTatCa(false)">
                <input type="submit" name="xoachon" value="Xóa các mục đã chọn" onclick="return confirm('Bạn có chắc muốn xóa không?')">
                <a href="index.php?act=adddm"><input type="button" value="Nhập thêm"></a>
            </div>
        </form>

        <?php if (isset($thongbao) && $thongbao != ""): ?>
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
