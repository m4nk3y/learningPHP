<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Tạo ID mới
    $lastProduct = end($_SESSION['products']);
    $newId = $lastProduct ? $lastProduct['id'] + 1 : 1;

    // Thêm sản phẩm vào session
    $_SESSION['products'][] = ["id" => $newId, "name" => $name, "price" => $price];

    // Chuyển hướng về trang CRUD
    header("Location: home.php");
    exit();
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<!-- Nội dung thêm sản phẩm -->
<form method="POST" action="">
    <label>Tên sản phẩm:</label>
    <input type="text" name="name" required>
    <label>Giá thành:</label>
    <input type="number" name="price" required>
    <button type="submit">Thêm</button>
</form>

<?php include '../includes/footer.php'; ?>

