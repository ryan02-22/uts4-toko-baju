<style>
    .transaksi-detail-wrapper {
        background: white;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        max-width: 900px;
    }

    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--border-color);
    }

    .detail-header h2 {
        margin: 0;
        color: var(--primary-color);
    }

    .detail-actions {
        display: flex;
        gap: 10px;
    }

    .detail-section {
        margin-bottom: 30px;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 6px;
        border-left: 4px solid var(--secondary-color);
    }

    .detail-section h3 {
        margin-top: 0;
        color: var(--primary-color);
        font-size: 16px;
        margin-bottom: 15px;
    }

    .detail-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 15px;
    }

    .detail-row.full {
        grid-template-columns: 1fr;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
    }

    .detail-label {
        font-size: 12px;
        color: var(--text-light);
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .detail-value {
        font-size: 16px;
        color: var(--primary-color);
        font-weight: 600;
    }

    .detail-items-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 6px;
        overflow: hidden;
    }

    .detail-items-table thead th {
        background-color: #f5f5f5;
        padding: 12px;
        text-align: left;
        font-weight: 600;
        color: var(--primary-color);
        border-bottom: 2px solid var(--border-color);
        font-size: 13px;
    }

    .detail-items-table tbody td {
        padding: 12px;
        border-bottom: 1px solid var(--border-color);
    }

    .detail-items-table tbody tr:hover {
        background-color: #f9f9f9;
    }

    .summary-table {
        width: 100%;
        border-collapse: collapse;
    }

    .summary-table tr {
        border-bottom: 1px solid var(--border-color);
    }

    .summary-table td {
        padding: 12px 0;
    }

    .summary-table td:first-child {
        color: var(--text-light);
    }

    .summary-table td:last-child {
        text-align: right;
        font-weight: 600;
        color: var(--primary-color);
    }

    .summary-table tr.total {
        border-top: 2px solid var(--secondary-color);
        border-bottom: 2px solid var(--secondary-color);
        font-size: 18px;
    }

    .summary-table tr.total td:last-child {
        color: var(--secondary-color);
        font-size: 20px;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .action-buttons a,
    .action-buttons button {
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

    .btn-back {
        background-color: var(--border-color);
        color: var(--primary-color);
    }

    .btn-back:hover {
        background-color: #ddd;
    }

    .btn-edit {
        background-color: #ffc107;
        color: #333;
    }

    .btn-edit:hover {
        background-color: #ffb300;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }

    .status-badge {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 13px;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-paid {
        background-color: #d4edda;
        color: #155724;
    }

    .status-shipped {
        background-color: #d1ecf1;
        color: #0c5460;
    }

    .status-completed {
        background-color: #c3e6cb;
        color: #155724;
    }

    @media (max-width: 768px) {
        .detail-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .detail-actions {
            width: 100%;
            flex-direction: column;
        }

        .detail-row {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }
    }
</style>

<div class="transaksi-detail-wrapper">
    <div class="detail-header">
        <div>
            <h2>Transaction #<?= $transaksi->id; ?></h2>
            <span class="status-badge status-<?= $transaksi->status; ?>">
                <?= ucfirst($transaksi->status); ?>
            </span>
        </div>
        <div class="detail-actions">
            <a href="<?= base_url('admin/edit_transaksi/' . $transaksi->id); ?>" class="btn-primary" style="padding: 10px 20px;">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>

    <!-- Transaction Header Information -->
    <div class="detail-section">
        <h3><i class="fas fa-info-circle"></i> Transaction Information</h3>
        <div class="detail-row">
            <div class="detail-item">
                <span class="detail-label">Transaction ID</span>
                <span class="detail-value">#<?= $transaksi->id; ?></span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Transaction Date</span>
                <span class="detail-value"><?= date('d M Y, H:i', strtotime($transaksi->transaction_date)); ?></span>
            </div>
        </div>
        <div class="detail-row">
            <div class="detail-item">
                <span class="detail-label">Customer</span>
                <span class="detail-value"><?= $transaksi->customer_name ?? 'N/A'; ?></span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Status</span>
                <span class="detail-value" style="text-transform: capitalize;"><?= $transaksi->status; ?></span>
            </div>
        </div>
        <div class="detail-row full">
            <div class="detail-item">
                <span class="detail-label">Shipping Address</span>
                <span class="detail-value"><?= $transaksi->shipping_address; ?></span>
            </div>
        </div>
    </div>

    <!-- Transaction Items -->
    <div class="detail-section">
        <h3><i class="fas fa-box"></i> Order Items</h3>
        <table class="detail-items-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($details as $detail): ?>
                    <tr>
                        <td><?= $detail->product_name; ?></td>
                        <td><?= $detail->quantity; ?></td>
                        <td>Rp <?= number_format($detail->price, 0, ',', '.'); ?></td>
                        <td>Rp <?= number_format($detail->subtotal, 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Order Summary -->
    <div class="detail-section">
        <h3><i class="fas fa-calculator"></i> Order Summary</h3>
        <table class="summary-table">
            <tr>
                <td>Subtotal:</td>
                <td>Rp <?= number_format($transaksi->total_amount, 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>Tax:</td>
                <td>Rp 0</td>
            </tr>
            <tr>
                <td>Shipping:</td>
                <td>Rp 0</td>
            </tr>
            <tr class="total">
                <td><strong>Total Amount:</strong></td>
                <td><strong>Rp <?= number_format($transaksi->total_amount, 0, ',', '.'); ?></strong></td>
            </tr>
        </table>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <a href="<?= base_url('admin/transaksi'); ?>" class="btn-back">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
        <a href="<?= base_url('admin/edit_transaksi/' . $transaksi->id); ?>" class="btn-edit">
            <i class="fas fa-edit"></i> Edit Transaction
        </a>
        <a href="<?= base_url('admin/delete_transaksi/' . $transaksi->id); ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this transaction?')">
            <i class="fas fa-trash"></i> Delete
        </a>
    </div>
</div>