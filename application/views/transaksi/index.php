<div class="container" style="padding: 20px;">
    <h1><?= $title ?></h1>
    
    <!-- Tombol Tambah -->
    <a href="<?= base_url('transaksi/create') ?>" class="btn btn-primary" style="margin-bottom: 20px;">
        + Tambah Transaksi Baru
    </a>
    
    <!-- Tabel Daftar Transaksi -->
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead style="background-color: #333; color: white;">
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Customer</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($transaksi)): ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Belum ada transaksi</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; foreach($transaksi as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>#<?= str_pad($row->id, 4, '0', STR_PAD_LEFT) ?></td>
                    <td><?= $row->customer_name ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($row->transaction_date)) ?></td>
                    <td>Rp <?= number_format($row->total_amount, 0, ',', '.') ?></td>
                    <td>
                        <?php
                        $status_colors = [
                            'pending' => '#FFA500',
                            'paid' => '#2196F3',
                            'shipped' => '#9C27B0',
                            'completed' => '#4CAF50',
                            'cancelled' => '#F44336'
                        ];
                        $color = isset($status_colors[$row->status]) ? $status_colors[$row->status] : '#999';
                        ?>
                        <span style="background-color: <?= $color ?>; color: white; padding: 5px 10px; border-radius: 5px;">
                            <?= ucfirst($row->status) ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?= base_url('transaksi/view/'.$row->id) ?>" class="btn btn-info btn-sm">Detail</a>
                        <a href="<?= base_url('transaksi/edit/'.$row->id) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('transaksi/delete/'.$row->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
