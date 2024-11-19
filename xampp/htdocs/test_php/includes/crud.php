<div class="container">
    <a href="#" class="btn btn-success">Thêm mới</a>
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
            <?php
            $products = [
                ["id" => 1, "name" => "Sản phẩm 1", "price" => 1000],
                ["id" => 2, "name" => "Sản phẩm 2", "price" => 2000],
                ["id" => 3, "name" => "Sản phẩm 3", "price" => 3000],
            ];

            foreach ($products as $product) {
                echo "<tr>
                        <td>{$product['name']}</td>
                        <td>{$product['price']} VND</td>
                        <td><i class='bi bi-pencil-square'></i></td>
                        <td><i class='bi bi-trash-fill'></i></td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>