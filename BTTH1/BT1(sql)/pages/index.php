<?php
require '../includes/functions.php';
$flowers = getFlowers($pdo);
?>

<?php
include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .navbar {
            position: sticky;
            background-color: #f55384;
            top: 0;
            display: flex;
            justify-content: space-between;
            padding: 5px 10px;
            align-items: center;
            color: white;
            z-index: 1;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }
        .navbar a:hover {
            background-color: #cd4a5d;
        }
        .navbar .menu {
            display: flex;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    
<nav class="navbar">  
    <div class="logo">
        <a href="#">LOGO</a>
    </div>
    <div class="menu">
        <a href="#">Hậu Trường</a>
        <a href="#">Lifestyle</a>
        <a href="#">Xã Hội</a>
        <a href="#">Thế Giới Quanh Ta</a>
        <a href="#">Đẹp</a>
        <a href="#">Mẹ & Bé</a>
        <a href="#">Giáo Dục</a>
        <a href="#">Giải Trí</a>
        <a href="#">Yêu</a>
        <a href="#">Sức Khỏe</a>
        <a href="#">Tiêu Dùng</a>
        <a href="#">Mua Sắm</a>
        <a href="#">Ăn Ngon</a>
    </div>
</nav>
<br>
<h1 style="margin-left: 20px;">Danh sách các loài hoa</h1>
<br>
<div class="container">
    <?php foreach ($flowers as $flower): ?>
        <div class="card">
            <img src="<?php echo htmlspecialchars($flower['image']); ?>" alt="Ảnh của <?php echo htmlspecialchars($flower['name']); ?>">
            <h3><?php echo htmlspecialchars($flower['name']); ?></h3>
            <p><?php echo htmlspecialchars($flower['description']); ?></p>
        </div>
    <?php endforeach; ?>
</div>
<?php
include '../includes/footer.php';
?>