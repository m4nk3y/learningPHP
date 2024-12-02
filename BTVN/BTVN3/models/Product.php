<?php
require_once '../config/database.php';

class Product {
    private $conn;
    private $table = 'products';

    public $id;
    public $tenSP;
    public $giaThanh;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAll() {
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO $this->table (tenSP, giaThanh) VALUES (:tenSP, :giaThanh)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tenSP', $this->tenSP);
        $stmt->bindParam(':giaThanh', $this->giaThanh);
        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            throw new Exception("Create error: " . $errorInfo[2]);
        }
    }
    

    public function update() {
        $query = "UPDATE $this->table SET tenSP = :tenSP, giaThanh = :giaThanh WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':tenSP', $this->tenSP);
        $stmt->bindParam(':giaThanh', $this->giaThanh);
        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            throw new Exception("Update error: " . $errorInfo[2]);
        }
    }
    

    // public function delete() {
    //     $query = "DELETE FROM $this->table WHERE id = :id";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(':id', $this->id);
    //     if ($stmt->execute()) {
    //         return true;
    //     } else {
    //         $errorInfo = $stmt->errorInfo();
    //         throw new Exception("Delete error: " . $errorInfo[2]);
    //     }
    // }

    public function delete() {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            throw new Exception("Delete error: " . $errorInfo[2]);
        }
    }    

    public function getById($id) {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
