<div class="container" style="padding: 20px;">
    <h1><?= $title ?></h1>
    
    <form action="<?= base_url('transaksi/store') ?>" method="POST">
        
        <!-- Alamat Pengiriman -->
        <div style="margin-bottom: 15px;">
            <label><strong>Alamat Pengiriman:</strong></label><br>
            <textarea name="shipping_address" rows="3" required style="width: 100%; padding: 10px;"></textarea>
        </div>
        
        <!-- Items Table -->
        <h3>Daftar Produk</h3>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;" id="items-table">
            <thead style="background-color: #333; color: white;">
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="items-body">
                <tr class="item-row">
                    <td>
                        <select name="product_id[]" class="product-select" required style="width: 200px;">
                            <option value="">-- Pilih Produk --</option>
                            <?php foreach($produk as $p): ?>
                                <option value="<?= $p->id ?>" data-price="<?= $p->price ?>">
                                    <?= $p->name ?> - Rp <?= number_format($p->price, 0, ',', '.') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <input type="number" name="price[]" class="price-input" required style="width: 150px;">
                    </td>
                    <td>
                        <input type="number" name="quantity[]" class="quantity-input" min="1" value="1" required style="width: 80px;">
                    </td>
                    <td>
                        <span class="subtotal">0</span>
                    </td>
                    <td>
                        <button type="button" class="btn-remove">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <!-- Tombol Tambah Item -->
        <button type="button" id="add-item" style="margin-top: 10px;">+ Tambah Item</button>
        
        <!-- Total -->
        <h3 style="margin-top: 20px;">Total: Rp <span id="total-amount">0</span></h3>
        
        <!-- Submit -->
        <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-success">Simpan Transaksi</button>
            <a href="<?= base_url('transaksi') ?>" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<script>
// Kode JavaScript untuk handle dynamic rows
document.addEventListener('DOMContentLoaded', function() {
    const addBtn = document.getElementById('add-item');
    const itemsBody = document.getElementById('items-body');
    const produkOptions = <?= json_encode($produk) ?>;
    
    // Tambah row baru
    addBtn.addEventListener('click', function() {
        const newRow = document.createElement('tr');
        newRow.className = 'item-row';
        newRow.innerHTML = `
            <td>
                <select name="product_id[]" class="product-select" required style="width: 200px;">
                    <option value="">-- Pilih Produk --</option>
                    <?php foreach($produk as $p): ?>
                        <option value="<?= $p->id ?>" data-price="<?= $p->price ?>">
                            <?= $p->name ?> - Rp <?= number_format($p->price, 0, ',', '.') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <input type="number" name="price[]" class="price-input" required style="width: 150px;">
            </td>
            <td>
                <input type="number" name="quantity[]" class="quantity-input" min="1" value="1" required style="width: 80px;">
            </td>
            <td>
                <span class="subtotal">0</span>
            </td>
            <td>
                <button type="button" class="btn-remove">Hapus</button>
            </td>
        `;
        itemsBody.appendChild(newRow);
        attachRowEvents(newRow);
    });
    
    // Function untuk attach events ke row
    function attachRowEvents(row) {
        const productSelect = row.querySelector('.product-select');
        const priceInput = row.querySelector('.price-input');
        const quantityInput = row.querySelector('.quantity-input');
        const removeBtn = row.querySelector('.btn-remove');
        
        // Auto fill price saat pilih produk
        productSelect.addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            priceInput.value = selected.dataset.price || 0;
            calculateSubtotal(row);
        });
        
        // Calculate subtotal saat ubah quantity
        quantityInput.addEventListener('input', function() {
            calculateSubtotal(row);
        });
        
        // Hapus row
        removeBtn.addEventListener('click', function() {
            if (document.querySelectorAll('.item-row').length > 1) {
                row.remove();
                calculateTotal();
            }
        });
        
        calculateSubtotal(row);
    }
    
    function calculateSubtotal(row) {
        const price = parseFloat(row.querySelector('.price-input').value) || 0;
        const quantity = parseInt(row.querySelector('.quantity-input').value) || 0;
        const subtotal = price * quantity;
        row.querySelector('.subtotal').textContent = subtotal.toLocaleString('id-ID');
        calculateTotal();
    }
    
    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('.item-row').forEach(function(row) {
            const price = parseFloat(row.querySelector('.price-input').value) || 0;
            const quantity = parseInt(row.querySelector('.quantity-input').value) || 0;
            total += price * quantity;
        });
        document.getElementById('total-amount').textContent = total.toLocaleString('id-ID');
    }
    
    // Attach events ke row pertama
    const firstRow = document.querySelector('.item-row');
    if (firstRow) {
        const productSelect = firstRow.querySelector('.product-select');
        const priceInput = firstRow.querySelector('.price-input');
        const quantityInput = firstRow.querySelector('.quantity-input');
        const removeBtn = firstRow.querySelector('.btn-remove');
        
        productSelect.addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            priceInput.value = selected.dataset.price || 0;
            calculateSubtotal(firstRow);
        });
        
        quantityInput.addEventListener('input', function() {
            calculateSubtotal(firstRow);
        });
        
        removeBtn.addEventListener('click', function() {
            if (document.querySelectorAll('.item-row').length > 1) {
                firstRow.remove();
                calculateTotal();
            }
        });
    }
});
</script>
