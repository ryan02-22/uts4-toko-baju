<style>
    .transaksi-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .transaksi-header h2 {
        margin: 0;
        color: var(--primary-color);
    }

    .filter-section {
        background: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .filter-section input,
    .filter-section select {
        padding: 8px 12px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-size: 13px;
    }

    .transaksi-table-wrapper {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .transaksi-table {
        width: 100%;
        border-collapse: collapse;
    }

    .transaksi-table thead th {
        background-color: #f5f5f5;
        padding: 15px;
        text-align: left;
        font-weight: 600;
        color: var(--primary-color);
        border-bottom: 2px solid var(--border-color);
        font-size: 13px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .transaksi-table tbody td {
        padding: 15px;
        border-bottom: 1px solid var(--border-color);
        font-size: 13px;
    }

    .transaksi-table tbody tr:hover {
        background-color: #f9f9f9;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .btn-action {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        transition: var(--transition);
        text-decoration: none;
        display: inline-block;
    }

    .btn-view {
        background-color: #0dcaf0;
        color: white;
    }

    .btn-view:hover {
        background-color: #0aa2c0;
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

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-light);
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin-top: 20px;
    }

    .pagination a,
    .pagination span {
        padding: 8px 12px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        text-decoration: none;
        color: var(--primary-color);
    }

    .pagination a:hover {
        background-color: var(--secondary-color);
        color: var(--primary-color);
    }

    .pagination .active {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
        color: var(--primary-color);
    }

    @media (max-width: 768px) {
        .transaksi-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .filter-section {
            flex-direction: column;
        }

        .filter-section input,
        .filter-section select {
            width: 100%;
        }

        .action-buttons {
            width: 100%;
        }

        .btn-action {
            flex: 1;
        }
    }
</style>

<div class="transaksi-header">
    <h2>Transaction Management</h2>
    <a href="<?= base_url('admin/create_transaksi'); ?>" class="btn-primary">
        <i class="fas fa-plus"></i> New Transaction
    </a>
</div>

<!-- Filter Section -->
<div class="filter-section">
    <input type="text" placeholder="Search by customer name or ID..." style="flex: 1; min-width: 200px;">
    <select>
        <option value="">All Status</option>
        <option value="pending">Pending</option>
        <option value="paid">Paid</option>
        <option value="shipped">Shipped</option>
        <option value="completed">Completed</option>
        <option value="canceled">Canceled</option>
    </select>
    <button class="btn-primary" style="padding: 8px 16px; font-size: 12px;">
        <i class="fas fa-search"></i> Filter
    </button>
</div>

<!-- Transactions Table -->
<div class="transaksi-table-wrapper">
    <div class="table-responsive">
        <table class="transaksi-table">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Customer</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($transaksi) > 0): ?>
                    <?php foreach ($transaksi as $trans): ?>
                        <tr>
                            <td>#<?= $trans->id; ?></td>
                            <td><?= $trans->customer_name; ?></td>
                            <td>Rp <?= number_format($trans->total_amount, 0, ',', '.'); ?></td>
                            <td>
                                <span class="badge-status badge-<?= $trans->status; ?>">
                                    <?= ucfirst($trans->status); ?>
                                </span>
                            </td>
                            <td><?= date('d M Y H:i', strtotime($trans->transaction_date)); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?= base_url('admin/view_transaksi/' . $trans->id); ?>" class="btn-action btn-view">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="<?= base_url('admin/edit_transaksi/' . $trans->id); ?>" class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= base_url('admin/delete_transaksi/' . $trans->id); ?>" class="btn-action btn-delete" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <p>No transactions found</p>
                                <a href="<?= base_url('admin/create_transaksi'); ?>" class="btn-primary" style="margin-top: 15px; display: inline-block;">
                                    Create First Transaction
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>