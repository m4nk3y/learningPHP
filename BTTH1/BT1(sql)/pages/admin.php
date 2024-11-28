<?php
include '../includes/functions.php';
include '../includes/header.php';

$flowers = getFlowers($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add' && isset($_FILES['image'])) {
        $uploadDir = '../assets/images/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            addFlower($pdo, $_POST['name'], $_POST['description'], $uploadFile);
            header('Location: admin.php');
            exit;
        } 
        else {
            $error = "Lỗi khi upload ảnh.";
        }

    } else if ($action === 'delete') {
        deleteFlower($pdo, $_POST['id']);
        header('Location: admin.php');
        exit;

    } else if ($action === 'edit') {
        $imagePath = $_POST['image'];

        if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'images/';
            $uploadFile = $uploadDir . basename($_FILES['new_image']['name']);
            if (move_uploaded_file($_FILES['new_image']['tmp_name'], $uploadFile)) {
                $imagePath = $uploadFile;
            }
        }

        editFlower($pdo, $_POST['id'], $_POST['name'], $_POST['description'], $imagePath);
        header('Location: admin.php');
        exit;
    }
}
?>

<h1 class="text-center my-4">Quản lý hoa</h1>

<div class="container">
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h2>Thêm mới</h2>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">
                <div class="mb-3">
                    <label for="name" class="form-label">Tên</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <input type="text" id="description" name="description" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Ảnh</label>
                    <input type="file" id="image" name="image" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Thêm</button>
            </form>
            <?php if (isset($error)): ?>
                <p class="text-danger mt-3"><?php echo $error; ?></p>
            <?php endif; ?>
        </div>
    </div>

    <h2 class="text-center my-4">Danh sách hoa</h2>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Mô tả</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php $stt = 1;
            foreach ($flowers as $flower): ?>
                <tr>
                    <td><?php echo $stt++?></td>
                    <td><?php echo $flower['name']; ?></td>
                    <td><?php echo $flower['description']; ?></td>
                    <td><img src="<?php echo $flower['image']; ?>" alt="" class="img-thumbnail" width="50"></td>
                    <td>
                        <div class="d-flex">
                            <form method="POST" enctype="multipart/form-data" class="me-2">
                                <input type="hidden" name="action" value="edit">
                                <input type="hidden" name="id" value="<?php echo $flower['id']; ?>">
                                <div class="mb-2">
                                    <input type="text" name="name" value="<?php echo $flower['name']; ?>" class="form-control mb-1" required>
                                    <input type="text" name="description" value="<?php echo $flower['description']; ?>" class="form-control mb-1" required>
                                    <input type="file" name="new_image" class="form-control mb-1">
                                    <input type="hidden" name="image" value="<?php echo $flower['image']; ?>">
                                </div>
                                <button type="submit" class="btn btn-warning btn-sm">Sửa</button>
                            </form>
                            <form method="POST">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $flower['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
include '../includes/footer.php';
?>