<section class="auth-section" style="padding-top: 120px;">
    <div class="auth-container" style="max-width: 600px;">
        <div class="auth-header">
            <h2>Edit Product</h2>
            <p>Update product details below</p>
        </div>
        <form action="<?= base_url('products/edit/'.$product['id']); ?>" method="post" enctype="multipart/form-data" class="auth-form">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" class="form-control" required value="<?= htmlspecialchars($product['name']); ?>">
            </div>
            
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" class="form-control" required style="width: 100%; padding: 12px 15px; border: 1px solid var(--border-color); border-radius: 8px; font-family: 'Inter', sans-serif;">
                    <option value="Outerwear" <?= $product['category'] == 'Outerwear' ? 'selected' : ''; ?>>Outerwear</option>
                    <option value="Tops" <?= $product['category'] == 'Tops' ? 'selected' : ''; ?>>Tops</option>
                    <option value="Bottoms" <?= $product['category'] == 'Bottoms' ? 'selected' : ''; ?>>Bottoms</option>
                    <option value="Dresses" <?= $product['category'] == 'Dresses' ? 'selected' : ''; ?>>Dresses</option>
                    <option value="Accessories" <?= $product['category'] == 'Accessories' ? 'selected' : ''; ?>>Accessories</option>
                </select>
            </div>

            <div class="form-group">
                <label for="price">Price (Rp)</label>
                <input type="number" id="price" name="price" class="form-control" required value="<?= htmlspecialchars($product['price']); ?>">
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" id="stock" name="stock" class="form-control" required value="<?= htmlspecialchars($product['stock']); ?>">
            </div>

            <div class="form-group">
                <label for="image">Product Image <small>(Leave blank to keep current image)</small></label>
                <div style="margin-bottom: 10px;">
                    <img src="<?= base_url('assets/images/' . (!empty($product['image']) ? $product['image'] : 'default.jpg')); ?>" alt="Current Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                </div>
                <input type="file" id="image" name="image" class="form-control" accept="image/*" style="padding: 10px 15px;">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="4" style="width: 100%; padding: 12px 15px; border: 1px solid var(--border-color); border-radius: 8px; font-family: 'Inter', sans-serif; resize: vertical;"><?= htmlspecialchars($product['description']); ?></textarea>
            </div>

            <button type="submit" class="btn-primary btn-block">Update Product</button>
            <a href="<?= base_url('products'); ?>" class="btn-secondary btn-block" style="text-align: center; margin-top: 10px; display: block;">Cancel</a>
        </form>
    </div>
</section>
