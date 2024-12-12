<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['quizFile']) && $_FILES['quizFile']['error'] === UPLOAD_ERR_OK) {
    $quizFile = $_FILES['quizFile']['tmp_name'];
    
    move_uploaded_file($quizFile, '../quizfile/Quiz - Copy copy.txt');
    
    header('Location: index.php?file=Quiz - Copy copy.txt');
    exit;
}
?>
<?php 
include '../includes/header.php';
?>
<div class="container mt-5">
    <h1 class="text-center mb-4">Bài trắc nghiệm</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="quizFile">Chọn tệp quiz:</label>
            <input type="file" class="form-control" id="quizFile" name="quizFile" accept=".txt" required>
        </div>
        <div style="margin-top: 20px; display: flex; justify-content:center;">
        <button type="submit" class="btn btn-primary" >Tải quiz và làm bài</button>
        </div>
    </form>
</div>
<?php 
include '../includes/footer.php';
?>