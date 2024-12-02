<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Thêm sản phẩm</h1>
    <form method="POST" action="/BTVN3/public/?action=store" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="tenSP" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="tenSP" name="tenSP" placeholder="Nhập tên sản phẩm" required>
            <div class="invalid-feedback">
                Vui lòng nhập tên sản phẩm.
            </div>
        </div>
        <div class="mb-3">
            <label for="giaThanh" class="form-label">Giá thành</label>
            <input type="number" class="form-control" id="giaThanh" name="giaThanh" placeholder="Nhập giá sản phẩm" required>
            <div class="invalid-feedback">
                Vui lòng nhập giá thành.
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Thêm</button>
            <a href="/BTVN3/public/" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
