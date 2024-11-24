<?php
session_start();

// Khởi tạo danh sách sản phẩm nếu chưa tồn tại
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [
        ["id" => 1, "name" => "Sản phẩm 1", "price" => 1000],
        ["id" => 2, "name" => "Sản phẩm 2", "price" => 2000],
        ["id" => 3, "name" => "Sản phẩm 3", "price" => 3000],
    ];
}
$products = $_SESSION['products'];
?>

<div class="container">
    <a href="add_product.php" class="btn btn-success">Thêm mới</a>
    <table>
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá thành</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['name']; ?></td>
                <td><?= $product['price']; ?> VND</td>
                <td><a href="edit_product.php?id=<?= $product['id']; ?>"><i class="bi bi-pencil-square"></i></a></td>
                <td><a href="delete_product.php?id=<?= $product['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?');"><i class="bi bi-trash-fill"></i></a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
</div>
