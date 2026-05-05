<section class="products-section" style="padding: 120px 5% 50px;">
    <div class="section-header">
        <h2>Manage Products</h2>
        <a href="<?= base_url('products/create'); ?>" class="btn-primary" style="margin-top: 15px; display: inline-block;">+ Add Product</a>
    </div>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px; text-align: left;">
            <thead>
                <tr style="border-bottom: 2px solid #ddd; background: #f9f9f9;">
                    <th style="padding: 12px;">ID</th>
                    <th style="padding: 12px;">Image</th>
                    <th style="padding: 12px;">Name</th>
                    <th style="padding: 12px;">Category</th>
                    <th style="padding: 12px;">Price</th>
                    <th style="padding: 12px;">Stock</th>
                    <th style="padding: 12px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product): ?>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 12px;"><?= $product['id']; ?></td>
                    <td style="padding: 12px;">
                        <img src="<?= base_url('assets/images/' . (!empty($product['image']) ? $product['image'] : 'default.jpg')); ?>" alt="<?= $product['name']; ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                    </td>
                    <td style="padding: 12px;"><?= $product['name']; ?></td>
                    <td style="padding: 12px;"><?= $product['category']; ?></td>
                    <td style="padding: 12px;">Rp <?= number_format($product['price'], 0, ',', '.'); ?></td>
                    <td style="padding: 12px;"><?= $product['stock']; ?></td>
                    <td style="padding: 12px;">
                        <a href="<?= base_url('products/edit/'.$product['id']); ?>" class="btn-primary-outline" style="padding: 5px 10px; font-size: 12px; margin-right: 5px;">Edit</a>
                        <a href="<?= base_url('products/delete/'.$product['id']); ?>" class="btn-primary" style="padding: 5px 10px; font-size: 12px; background-color: #e74c3c; border-color: #e74c3c; color: white;" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($products)): ?>
                <tr>
                    <td colspan="7" style="padding: 20px; text-align: center;">No products found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
