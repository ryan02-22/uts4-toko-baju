<div class="container" style="padding: 20px;">
    <h1><?= $title ?> #<?= str_pad($transaksi->id, 4, '0', STR_PAD_LEFT) ?></h1>
    
    <!-- Info Transaksi -->
    <div style="background: #f5f5f5; padding: 20px; margin-bottom: 20px; border-radius: 5px;">
        <p><strong>Customer:</strong> <?= $transaksi->user_id ?></p>
        <p><strong>Tanggal:</strong> <?= date('d/m/Y H:i', strtotime($transaksi->transaction_date)) ?></p>
        <p><strong>Status:</strong> <?= ucfirst($transaksi->status) ?></p>
        <p><strong>Alamat:</strong> <?= $transaksi->shipping_address ?></p>
        <p><strong>Total:</strong> Rp <?= number_format($transaksi->total_amount, 0, ',', '.') ?></p>
    </div>
    
    <!-- Detail Items -->
    <h3>Daftar Produk</h3>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead style="background-color: #333; color: white;">
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach($details as $d): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d->product_name ?></td>
                <td>Rp <?= number_format($d->price, 0, ',', '.') ?></td>
                <td><?= $d->quantity ?></td>
                <td>Rp <?= number_format($d->subtotal, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <!-- Tombol Kembali -->
    <a href="<?= base_url('transaksi') ?>" class="btn btn-primary" style="margin-top: 20px;">
        Kembali ke Daftar
    </a>
</div>
