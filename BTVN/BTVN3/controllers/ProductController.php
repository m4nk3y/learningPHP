<?php
require_once '../models/Product.php';

class ProductController
{
    public function index()
    {
        $product = new Product();
        $products = $product->getAll();
        require_once '../views/products/index.php';
    }

    public function create()
    {
        require_once '../views/products/create.php';
    }

    public function store()
    {
        $product = new Product();
        $product->tenSP = htmlspecialchars($_POST['tenSP']);
        $product->giaThanh = htmlspecialchars($_POST['giaThanh']);
        $product->create();
        header("Location: /BTVN3/public/");
    }

    public function edit($id)
    {
        $product = new Product();
        $productData = $product->getById($id);
        if (!$productData) {
            die('Sản phẩm không tồn tại!');
        }
        require_once '../views/products/edit.php';
    }


    public function update($id)
    {
        $product = new Product();
        $product->id = $id;
        $product->tenSP = $_POST['tenSP'];
        $product->giaThanh = $_POST['giaThanh'];
        $product->update();
        header("Location: /BTVN3/public/");
    }

    public function delete($id) {
        $product = new Product();
        $product->id = $id;
        if ($product->delete()) {
            header("Location: /BTVN3/public/");
            exit;
        } else {
            echo "Xóa sản phẩm không thành công.";
        }
    }
    
}
