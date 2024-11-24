<?php include '../includes/header.php'; ?>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Chọn ảnh để tải lên:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Tải lên Ảnh" name="submit">
</form>

<?php include '../includes/footer.php'; ?>