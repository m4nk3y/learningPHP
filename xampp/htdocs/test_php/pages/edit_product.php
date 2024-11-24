<?php
session_start();

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: crud.php");
    exit();
}

// Tìm sản phẩm cần sửa
$products = $_SESSION['products'];
$product = array_filter($products, fn($p) => $p['id'] == $id);
$product = reset($product);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Cập nhật sản phẩm trong session
    foreach ($_SESSION['products'] as &$p) {
        if ($p['id'] == $id) {
            $p['name'] = $name;
            $p['price'] = $price;
            break;
        }
    }

    // Chuyển hướng về trang CRUD
    header("Location: home.php");
    exit();
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<form method="POST" action="">
    <label>Tên sản phẩm:</label>
    <input type="text" name="name" value="<?= $product['name']; ?>" required>
    <label>Giá thành:</label>
    <input type="number" name="price" value="<?= $product['price']; ?>" required>
    <button type="submit">Cập nhật</button>
</form>
<?php include '../includes/footer.php'; ?>