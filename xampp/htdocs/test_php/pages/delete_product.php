<?php
session_start();

$id = $_GET['id'] ?? null;
if ($id) {
    // Xóa sản phẩm dựa trên ID
    $_SESSION['products'] = array_filter($_SESSION['products'], fn($p) => $p['id'] != $id);
}

// Chuyển hướng về trang CRUD
header("Location: home.php");
exit();
?>
