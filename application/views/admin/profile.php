<style>
    .profile-container {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 30px;
    }

    .profile-sidebar {
        background: white;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        height: fit-content;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--secondary-color), #a08830);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 48px;
        margin: 0 auto 20px;
    }

    .profile-name {
        font-size: 22px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 10px;
    }

    .profile-role {
        text-align: center;
        color: var(--text-light);
        font-size: 14px;
        margin-bottom: 20px;
        text-transform: capitalize;
    }

    .profile-actions {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .profile-actions .btn-primary {
        display: block;
        text-align: center;
    }

    .profile-content {
        background: white;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .profile-section {
        margin-bottom: 30px;
    }

    .profile-section h3 {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--border-color);
    }

    .profile-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid var(--border-color);
    }

    .profile-item:last-child {
        border-bottom: none;
    }

    .profile-label {
        color: var(--text-light);
        font-weight: 500;
        font-size: 14px;
    }

    .profile-value {
        color: var(--primary-color);
        font-weight: 600;
    }

    .transactions-list {
        margin-top: 30px;
    }

    .transaction-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        margin-bottom: 10px;
        transition: var(--transition);
    }

    .transaction-item:hover {
        background-color: #f9f9f9;
    }

    .transaction-info h4 {
        margin: 0 0 5px 0;
        font-size: 14px;
        font-weight: 600;
    }

    .transaction-info p {
        margin: 0;
        font-size: 12px;
        color: var(--text-light);
    }

    .transaction-amount {
        font-weight: 700;
        color: var(--primary-color);
    }

    .btn-group {
        display: flex;
        gap: 10px;
    }

    @media (max-width: 768px) {
        .profile-container {
            grid-template-columns: 1fr;
        }

        .profile-sidebar {
            order: 2;
        }

        .profile-content {
            order: 1;
        }

        .profile-item {
            flex-direction: column;
            gap: 5px;
        }
    }
</style>

<div class="profile-container">
    <!-- Sidebar Profile -->
    <div class="profile-sidebar">
        <div class="profile-avatar"><?= strtoupper(substr($user->name, 0, 1)); ?></div>
        <div class="profile-name"><?= $user->name; ?></div>
        <div class="profile-role"><?= $user->role; ?></div>

        <div class="profile-actions">
            <a href="<?= base_url('admin/edit_profile'); ?>" class="btn-primary">
                <i class="fas fa-edit"></i> Edit Profile
            </a>
            <a href="#changePasswordModal" class="btn-secondary" onclick="openChangePasswordModal()">
                <i class="fas fa-key"></i> Change Password
            </a>
        </div>
    </div>

    <!-- Main Profile Content -->
    <div class="profile-content">
        <!-- Account Information -->
        <div class="profile-section">
            <h3><i class="fas fa-user-circle"></i> Account Information</h3>
            <div class="profile-item">
                <span class="profile-label">Full Name</span>
                <span class="profile-value"><?= $user->name; ?></span>
            </div>
            <div class="profile-item">
                <span class="profile-label">Email Address</span>
                <span class="profile-value"><?= $user->email; ?></span>
            </div>
            <div class="profile-item">
                <span class="profile-label">Role</span>
                <span class="profile-value" style="text-transform: capitalize;"><?= $user->role; ?></span>
            </div>
            <div class="profile-item">
                <span class="profile-label">Member Since</span>
                <span class="profile-value"><?= date('d M Y', strtotime($user->created_at)); ?></span>
            </div>
        </div>

        <!-- User Transactions -->
        <div class="transactions-list">
            <h3><i class="fas fa-history"></i> Your Transactions</h3>
            <?php if (count($transactions) > 0): ?>
                <?php foreach ($transactions as $trans): ?>
                    <div class="transaction-item">
                        <div class="transaction-info">
                            <h4>Transaction #<?= $trans->id; ?></h4>
                            <p><?= date('d M Y H:i', strtotime($trans->transaction_date)); ?> -
                                <span class="badge-status badge-<?= $trans->status; ?>">
                                    <?= ucfirst($trans->status); ?>
                                </span>
                            </p>
                        </div>
                        <div style="text-align: right;">
                            <div class="transaction-amount">Rp <?= number_format($trans->total_amount, 0, ',', '.'); ?></div>
                            <a href="<?= base_url('admin/view_transaksi/' . $trans->id); ?>" class="btn-sm btn-info" style="margin-top: 5px; display: inline-block;">
                                View Details
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="text-align: center; padding: 30px; color: var(--text-light);">
                    <i class="fas fa-inbox" style="font-size: 36px; margin-bottom: 10px;"></i>
                    <p>No transactions yet</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div id="changePasswordModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 2000; align-items: center; justify-content: center;">
    <div style="background: white; padding: 30px; border-radius: 8px; max-width: 400px; width: 90%;">
        <h2 style="margin-top: 0; margin-bottom: 20px;">Change Password</h2>

        <form method="POST" action="<?= base_url('admin/change_password'); ?>">
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Old Password</label>
                <input type="password" name="old_password" required style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">New Password</label>
                <input type="password" name="new_password" required style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 4px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Confirm Password</label>
                <input type="password" name="confirm_password" required style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 4px;">
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn-primary" style="flex: 1;">
                    Update Password
                </button>
                <button type="button" onclick="closeChangePasswordModal()" class="btn-secondary" style="flex: 1;">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openChangePasswordModal() {
        document.getElementById('changePasswordModal').style.display = 'flex';
    }

    function closeChangePasswordModal() {
        document.getElementById('changePasswordModal').style.display = 'none';
    }
</script>