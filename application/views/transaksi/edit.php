<div class="container" style="padding: 20px;">
    <h1><?= $title ?> #<?= str_pad($transaksi->id, 4, '0', STR_PAD_LEFT) ?></h1>
    
    <form action="<?= base_url('transaksi/update') ?>" method="POST">
        <input type="hidden" name="id" value="<?= $transaksi->id ?>">
        
        <!-- Status -->
        <div style="margin-bottom: 15px;">
            <label><strong>Status:</strong></label><br>
            <select name="status" required style="width: 100%; padding: 10px;">
                <option value="pending" <?= ($transaksi->status == 'pending') ? 'selected' : '' ?>>Pending</option>
                <option value="paid" <?= ($transaksi->status == 'paid') ? 'selected' : '' ?>>Paid (Sudah Dibayar)</option>
                <option value="shipped" <?= ($transaksi->status == 'shipped') ? 'selected' : '' ?>>Shipped (Dikirim)</option>
                <option value="completed" <?= ($transaksi->status == 'completed') ? 'selected' : '' ?>>Completed (Selesai)</option>
                <option value="cancelled" <?= ($transaksi->status == 'cancelled') ? 'selected' : '' ?>>Cancelled (Batal)</option>
            </select>
        </div>
        
        <!-- Alamat -->
        <div style="margin-bottom: 15px;">
            <label><strong>Alamat Pengiriman:</strong></label><br>
            <textarea name="shipping_address" rows="3" required style="width: 100%; padding: 10px;"><?= $transaksi->shipping_address ?></textarea>
        </div>
        
        <!-- Submit -->
        <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="<?= base_url('transaksi') ?>" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
