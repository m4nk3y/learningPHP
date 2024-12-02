<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<div style="display: flex; justify-content: center; margin: 10px">
    <h1>Danh sách sản phẩm</h1>
</div>

<!-- <a href="/BTVN3/public/?action=create">Thêm sản phẩm</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Tên sản phẩm</th>
        <th>Giá thành</th>
        <th>Hành động</th>
    </tr>
    <?php foreach ($products as $product): ?>
    <tr>
        <td><?= $product['id'] ?></td>
        <td><?= $product['tenSP'] ?></td>
        <td><?= $product['giaThanh'] ?></td>
        <td>
            <a href="/BTVN3/public/?action=edit&id=<?= $product['id'] ?>">Sửa</a>
            <a href="/BTVN3/public/?action=delete&id=<?= $product['id'] ?>" onclick="return confirm('Bạn có chắc chắn?')">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table> -->

<div class="container">
    <a href="/BTVN3/public/?action=create" class="btn btn-success" style="margin-bottom:20px;">Thêm sản phẩm mới</a>
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
                <td><?= $product['tenSP']; ?></td>
                <td><?= $product['giaThanh']; ?> VND</td>
                <td><a href="/BTVN3/public/?action=edit&id=<?= $product['id'] ?>"><i class="bi bi-pencil-square"></i></a></td>
                <td><a href="/BTVN3/public/?action=delete&id=<?= $product['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?');"><i class="bi bi-trash-fill"></i></a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>