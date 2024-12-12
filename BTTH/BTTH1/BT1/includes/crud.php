<?php
require './functions.php';
$flowers = getFlowers();
?>
<h1>Danh sách các loài hoa</h1>
<?php foreach ($flowers as $flower): ?>
    <div class="flower">
        <img src="<?php echo $flower['image']; ?>" alt="<?php echo $flower['name']; ?>">
        <h2><?php echo $flower['name']; ?></h2>
        <p><?php echo $flower['description']; ?></p>
    </div>
<?php endforeach; ?>