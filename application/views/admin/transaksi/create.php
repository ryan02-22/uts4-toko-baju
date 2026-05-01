<style>
    .transaksi-form-wrapper {
        background: white;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        max-width: 900px;
    }

    .form-title {
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--border-color);
    }

    .form-title h2 {
        margin: 0;
        color: var(--primary-color);
    }

    .form-section {
        margin-bottom: 30px;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 6px;
        border-left: 4px solid var(--secondary-color);
    }

    .form-section h3 {
        margin-top: 0;
        color: var(--primary-color);
        font-size: 16px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 15px;
    }

    .form-row.full {
        grid-template-columns: 1fr;
    }

    .form-group {
        margin-bottom: 0;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--primary-color);
        font-size: 14px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        transition: var(--transition);
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .product-list {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 15px;
        margin-top: 20px;
    }

    .product-item {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr auto;
        gap: 10px;
        padding: 10px;
        border-bottom: 1px solid var(--border-color);
        align-items: center;
    }

    .product-item:last-child {
        border-bottom: none;
    }

    .product-item.header {
        font-weight: 600;
        background-color: #f5f5f5;
    }

    .product-item input {
        padding: 6px;
        font-size: 13px;
    }

    .btn-remove-item {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
    }

    .btn-remove-item:hover {
        background-color: #c82333;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 2px solid var(--border-color);
    }

    .form-actions button,
    .form-actions a {
        flex: 1;
        padding: 12px;
        border: none;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        transition: var(--transition);
    }

    .btn-submit {
        background-color: var(--primary-color);
        color: white;
    }

    .btn-submit:hover {
        background-color: var(--secondary-color);
        color: var(--primary-color);
    }

    .btn-cancel {
        background-color: var(--border-color);
        color: var(--primary-color);
    }

    .btn-cancel:hover {
        background-color: #ddd;
    }

    .btn-add-product {
        background-color: var(--secondary-color);
        color: var(--primary-color);
        padding: 10px 20px;
        margin-top: 10px;
        display: inline-block;
        font-size: 13px;
    }

    .btn-add-product:hover {
        background-color: #e5c158;
    }

    .help-text {
        font-size: 12px;
        color: var(--text-light);
        margin-top: 4px;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .product-item {
            grid-template-columns: 1fr;
        }

        .product-item.header {
            display: none;
        }

        .product-item {
            display: flex;
            flex-direction: column;
            border: 1px solid var(--border-color);
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 4px;
        }

        .form-actions {
            flex-direction: column;
        }
    }
</style>

<div class="transaksi-form-wrapper">
    <div class="form-title">
        <h2><i class="fas fa-plus-circle"></i> Create New Transaction</h2>
    </div>

    <form method="POST" action="<?= base_url('admin/store_transaksi'); ?>">
        <!-- Customer Information Section -->
        <div class="form-section">
            <h3>Customer Information</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="user_id">Select Customer *</label>
                    <select id="user_id" name="user_id" required>
                        <option value="">-- Choose Customer --</option>
                        <?php foreach ($customers as $customer): ?>
                            <option value="<?= $customer->id; ?>"><?= $customer->name; ?> (<?= $customer->email; ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-row full">
                <div class="form-group">
                    <label for="shipping_address">Shipping Address *</label>
                    <textarea id="shipping_address" name="shipping_address" required placeholder="Enter complete shipping address"></textarea>
                </div>
            </div>
        </div>

        <!-- Transaction Items Section -->
        <div class="form-section">
            <h3>Transaction Items</h3>

            <div class="product-list">
                <div class="product-item header">
                    <div>Product Name</div>
                    <div>Quantity</div>
                    <div>Unit Price</div>
                    <div>Subtotal</div>
                    <div>Action</div>
                </div>

                <div id="items-container">
                    <div class="product-item" id="item-0">
                        <select name="product_id[]" class="product-select" onchange="updateProductPrice(0)" required>
                            <option value="">-- Select Product --</option>
                            <?php foreach ($produk as $p): ?>
                                <option value="<?= $p->id; ?>" data-price="<?= $p->price; ?>"><?= $p->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="number" name="quantity[]" value="1" min="1" class="qty-input" onchange="calculateSubtotal(0)" required>
                        <input type="number" name="price[]" value="0" class="price-input" readonly>
                        <input type="number" class="subtotal-input" readonly>
                        <button type="button" class="btn-remove-item" onclick="removeItem(0)">Remove</button>
                    </div>
                </div>

                <button type="button" class="btn-add-product" onclick="addProductItem()">
                    <i class="fas fa-plus"></i> Add Another Product
                </button>
            </div>
        </div>

        <!-- Order Summary Section -->
        <div class="form-section">
            <h3>Order Summary</h3>
            <div class="form-row full">
                <div class="form-group">
                    <label>Total Amount</label>
                    <div style="padding: 12px; background: white; border: 1px solid var(--border-color); border-radius: 4px; font-size: 18px; font-weight: 700; color: var(--secondary-color);">
                        Rp <span id="total-amount">0</span>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="status">Order Status *</label>
                    <select id="status" name="status" required>
                        <option value="pending">Pending</option>
                        <option value="paid">Paid</option>
                        <option value="shipped">Shipped</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Create Transaction
            </button>
            <a href="<?= base_url('admin/transaksi'); ?>" class="btn-cancel">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>

<script>
    let itemCount = 1;

    function addProductItem() {
        const container = document.getElementById('items-container');
        const products = <?= json_encode($produk); ?>;

        const newItem = document.createElement('div');
        newItem.className = 'product-item';
        newItem.id = 'item-' + itemCount;

        let optionsHTML = '<option value="">-- Select Product --</option>';
        products.forEach(p => {
            optionsHTML += `<option value="${p.id}" data-price="${p.price}">${p.name}</option>`;
        });

        newItem.innerHTML = `
        <select name="product_id[]" class="product-select" onchange="updateProductPrice(${itemCount})" required>
            ${optionsHTML}
        </select>
        <input type="number" name="quantity[]" value="1" min="1" class="qty-input" onchange="calculateSubtotal(${itemCount})" required>
        <input type="number" name="price[]" value="0" class="price-input" readonly>
        <input type="number" class="subtotal-input" readonly>
        <button type="button" class="btn-remove-item" onclick="removeItem(${itemCount})">Remove</button>
    `;

        container.appendChild(newItem);
        itemCount++;
    }

    function updateProductPrice(index) {
        const select = document.querySelector(`#item-${index} .product-select`);
        const priceInput = document.querySelector(`#item-${index} .price-input`);

        const selectedOption = select.options[select.selectedIndex];
        const price = selectedOption.getAttribute('data-price') || 0;

        priceInput.value = price;
        calculateSubtotal(index);
        calculateTotal();
    }

    function calculateSubtotal(index) {
        const qty = document.querySelector(`#item-${index} .qty-input`).value;
        const price = document.querySelector(`#item-${index} .price-input`).value;
        const subtotal = document.querySelector(`#item-${index} .subtotal-input`);

        subtotal.value = qty * price;
        calculateTotal();
    }

    function calculateTotal() {
        const subtotals = document.querySelectorAll('.subtotal-input');
        let total = 0;

        subtotals.forEach(input => {
            total += parseInt(input.value) || 0;
        });

        document.getElementById('total-amount').textContent = new Intl.NumberFormat('id-ID').format(total);
    }

    function removeItem(index) {
        const item = document.getElementById('item-' + index);
        if (item) {
            item.remove();
            calculateTotal();
        }
    }
</script>