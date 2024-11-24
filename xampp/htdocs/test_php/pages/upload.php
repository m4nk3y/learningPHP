<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "Tệp " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " đã được tải lên.<br>";
    
    // Hiển thị ảnh đã tải lên
    echo "Ảnh đã tải lên:<br>";
    echo "<img src='" . htmlspecialchars($target_file) . "' alt='Ảnh đã tải lên' style='max-width:300px;'>";
} else {
    echo "Xin lỗi, đã có lỗi xảy ra trong quá trình tải tệp tin của bạn.";
}
?>
