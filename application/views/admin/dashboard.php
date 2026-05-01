<style>
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        border-left: 4px solid var(--secondary-color);
        transition: var(--transition);
    }

    .stat-card:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .stat-icon {
        font-size: 32px;
        color: var(--secondary-color);
        margin-bottom: 10px;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 14px;
        color: var(--text-light);
    }

    .card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        padding: 25px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--border-color);
    }

    .card-header h2 {
        font-size: 20px;
        margin: 0;
        color: var(--primary-color);
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table thead th {
        background-color: #f5f5f5;
        padding: 12px;
        text-align: left;
        font-weight: 600;
        color: var(--primary-color);
        border-bottom: 2px solid var(--border-color);
        font-size: 13px;
        text-transform: uppercase;
    }

    .table tbody td {
        padding: 12px;
        border-bottom: 1px solid var(--border-color);
    }

    .table tbody tr:hover {
        background-color: #f9f9f9;
    }

    .badge-status {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .badge-paid {
        background-color: #d4edda;
        color: #155724;
    }

    .badge-completed {
        background-color: #d1ecf1;
        color: #0c5460;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        display: inline-block;
    }

    .btn-info {
        background-color: #0dcaf0;
        color: white;
    }

    .btn-info:hover {
        background-color: #0aa2c0;
    }

    .text-center {
        text-align: center;
    }

    .mt-4 {
        margin-top: 30px;
    }
</style>

<div class="dashboard-stats">
    <!-- Total Users -->
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-users"></i></div>
        <div class="stat-value"><?= $total_users; ?></div>
        <div class="stat-label">Total Users</div>
    </div>

    <!-- Total Admins -->
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-crown"></i></div>
        <div class="stat-value"><?= $total_admins; ?></div>
        <div class="stat-label">Admin Users</div>
    </div>

    <!-- Total Customers -->
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-shopping-bag"></i></div>
        <div class="stat-value"><?= $total_customers; ?></div>
        <div class="stat-label">Customers</div>
    </div>

    <!-- Total Transactions -->
    <div class="stat-card">
        <div class="stat-icon"><i class="fas fa-receipt"></i></div>
        <div class="stat-value"><?= $total_transactions; ?></div>
        <div class="stat-label">Transactions</div>
    </div>
</div>

<!-- Recent Transactions -->
<div class="card">
    <div class="card-header">
        <h2>Recent Transactions</h2>
        <a href="<?= base_url('admin/transaksi'); ?>" class="btn-primary" style="padding: 8px 16px; font-size: 12px;">
            View All
        </a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($recent_transactions) > 0): ?>
                <?php foreach ($recent_transactions as $transaksi): ?>
                    <tr>
                        <td>#<?= $transaksi->id; ?></td>
                        <td><?= $transaksi->customer_name; ?></td>
                        <td>Rp <?= number_format($transaksi->total_amount, 0, ',', '.'); ?></td>
                        <td>
                            <span class="badge-status badge-<?= $transaksi->status; ?>">
                                <?= ucfirst($transaksi->status); ?>
                            </span>
                        </td>
                        <td><?= date('d M Y', strtotime($transaksi->transaction_date)); ?></td>
                        <td>
                            <a href="<?= base_url('admin/view_transaksi/' . $transaksi->id); ?>" class="btn-sm btn-info">
                                View
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center" style="padding: 30px;">No transactions yet</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-4 text-center">
    <a href="<?= base_url('admin/create_transaksi'); ?>" class="btn-primary">
        <i class="fas fa-plus"></i> Create New Transaction
    </a>
</div>