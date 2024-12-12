<?php
require '../includes/conn.php';

function getFlowers($pdo) {
    $stmt = $pdo->query("SELECT * FROM flowers");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addFlower($pdo, $name, $description, $imagePath) {
    $stmt = $pdo->prepare("INSERT INTO flowers (name, description, image) VALUES (?, ?, ?)");
    $stmt->execute([$name, $description, $imagePath]);
}

function editFlower($pdo, $id, $name, $description, $imagePath) {
    $stmt = $pdo->prepare("UPDATE flowers SET name = ?, description = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $description, $imagePath, $id]);
}

function deleteFlower($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM flowers WHERE id = ?");
    $stmt->execute([$id]);
}
?>
