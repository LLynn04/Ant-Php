<?php
$item = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newProduct = [
        'product_name' => $_POST['product_name'],
        'price' => $_POST['price'],
        'stock_quantity' => $_POST['stock_quantity']
    ];

    $item = file_exists('item.json') ? json_decode(file_get_contents('item.json'), true) : [];
    array_unshift($item, $newProduct);
    file_put_contents('item.json', json_encode($item, JSON_PRETTY_PRINT));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Form for Adding Products</h2>
    <form method="post">
        <table class="table table-bordered" style="max-width: 500px;">
            <tr><th>Product Name</th><td><input type="text" name="product_name" class="form-control" required></td></tr>
            <tr><th>Price</th><td><input type="number" name="price" class="form-control" step="0.01" min="0" required></td></tr>
            <tr><th>Stock Quantity</th><td><input type="number" name="stock_quantity" class="form-control" min="0" required></td></tr>
            <tr><td colspan="2" class="text-center"><button type="submit" class="btn btn-primary">Add Product</button></td></tr>
        </table>
    </form>

    <?php if ($item): ?>
        <h3 class="mt-5">Product Result</h3>
        <table class="table table-bordered" style="max-width: 500px;">
            <thead>
                <tr><th>Product Name</th><th>Price</th><th>Stock Quantity</th><th>Status</th></tr>
            </thead>
            <tbody>
                <?php foreach ($item as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['product_name']) ?></td>
                        <td><?= htmlspecialchars($product['price']) ?>$</td>
                        <td><?= htmlspecialchars($product['stock_quantity']) ?></td>
                        <td>
                            <?= ($q = $product['stock_quantity']) <= 0 ? 'Out of Stock' : ($q <= 10 ? 'Low Stock' : 'In Stock') ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
