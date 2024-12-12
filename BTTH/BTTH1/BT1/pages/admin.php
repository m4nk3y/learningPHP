<?php
include '../includes/header.php';
?>

<?php
require '../includes/functions.php';
$flowers = getFlowers();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    if ($action === 'add' && isset($_FILES['image'])) {
        $uploadDir = '../assets/images/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $flowers[] = [
                "name" => $_POST['name'],
                "description" => $_POST['description'],
                "image" => $uploadFile
            ];
            saveFlowers($flowers);
            header('Location: admin.php');
            exit;
        } else {
            $error = "Lỗi khi upload ảnh.";
        }
    } elseif ($action === 'delete') {
        unset($flowers[$_POST['index']]);
        saveFlowers($flowers);
        header('Location: admin.php');
        exit;
    } elseif ($action === 'edit') {
        $flowers[$_POST['index']] = [
            "name" => $_POST['name'],
            "description" => $_POST['description'],
            "image" => $_POST['image']
        ];
        saveFlowers($flowers);
        header('Location: admin.php');
        exit;
    }
}
?>

<h1>Quản lý ảnh</h3>
<div class="form-add">
    <h2>Thêm mới</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add">
        Tên: <input type="text" name="name" required>
        Mô tả: <input type="text" name="description" required>
        Ảnh: <input type="file" name="image" required>
        <button type="submit">Thêm</button>
    </form>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
</div>
<h2>Danh sách hoa</h2>
<table>
    <tr>
        <th>STT</th>
        <th>Tên</th>
        <th>Mô tả</th>
        <th>Ảnh</th>
        <th>Hành động</th>
    </tr>
    <?php foreach ($flowers as $index => $flower): ?>
        <tr>
            <td><?php echo $index + 1; ?></td>
            <td><?php echo $flower['name']; ?></td>
            <td><?php echo $flower['description']; ?></td>
            <td><img src="<?php echo $flower['image']; ?>" alt="" width="50"></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                    <button type="submit">Xóa</button>
                </form>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                    Tên: <input type="text" name="name" value="<?php echo $flower['name']; ?>" required>
                    Mô tả: <input type="text" name="description" value="<?php echo $flower['description']; ?>" required>
                    Ảnh: <input type="text" name="image" value="<?php echo $flower['image']; ?>" required>
                    <button type="submit">Sửa</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
include '../includes/footer.php';
?>