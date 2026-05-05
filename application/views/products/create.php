<section class="auth-section" style="padding-top: 120px;">
    <div class="auth-container" style="max-width: 600px;">
        <div class="auth-header">
            <h2>Add Product</h2>
            <p>Enter product details below</p>
        </div>
        <form action="<?= base_url('products/create'); ?>" method="post" enctype="multipart/form-data" class="auth-form">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" class="form-control" required placeholder="e.g. Vintage Jacket">
            </div>
            
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" class="form-control" required style="width: 100%; padding: 12px 15px; border: 1px solid var(--border-color); border-radius: 8px; font-family: 'Inter', sans-serif;">
                    <option value="Outerwear">Outerwear</option>
                    <option value="Tops">Tops</option>
                    <option value="Bottoms">Bottoms</option>
                    <option value="Dresses">Dresses</option>
                    <option value="Accessories">Accessories</option>
                </select>
            </div>

            <div class="form-group">
                <label for="price">Price (Rp)</label>
                <input type="number" id="price" name="price" class="form-control" required placeholder="e.g. 500000">
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" id="stock" name="stock" class="form-control" required placeholder="e.g. 10">
            </div>

            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*" style="padding: 10px 15px;">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="4" style="width: 100%; padding: 12px 15px; border: 1px solid var(--border-color); border-radius: 8px; font-family: 'Inter', sans-serif; resize: vertical;"></textarea>
            </div>

            <button type="submit" class="btn-primary btn-block">Save Product</button>
            <a href="<?= base_url('products'); ?>" class="btn-secondary btn-block" style="text-align: center; margin-top: 10px; display: block;">Cancel</a>
        </form>
    </div>
</section>
