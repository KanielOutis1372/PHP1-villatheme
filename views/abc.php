<form action="" method="get">
    <input type="file" name="gallery[]" multiple>
    <button name="submit" type="submit">add</button>
</form>

<?php
    if (isset($_POST['submit'])) {
        if ($_FILES['gallery']['error'] !== UPLOAD_ERR_NO_FILE) {
            // Có file được chọn, thực hiện cập nhật sản phẩm
            // Các bước xử lý cập nhật sản phẩm ở đây
            echo "Cập nhật sản phẩm thành công.";
        } else {
            // Không có file nào được chọn, bỏ qua cập nhật sản phẩm
            echo "Không có file nào được chọn.";
        }}
?>