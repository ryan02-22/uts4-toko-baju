<style>
    .edit-form-container {
        max-width: 600px;
        background: white;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--primary-color);
        font-size: 14px;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        transition: var(--transition);
    }

    .form-group input[type="text"]:focus,
    .form-group input[type="email"]:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 30px;
    }

    .form-actions button,
    .form-actions a {
        flex: 1;
        padding: 12px;
        text-align: center;
        border: none;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
    }

    .form-actions .btn-submit {
        background-color: var(--primary-color);
        color: white;
    }

    .form-actions .btn-submit:hover {
        background-color: var(--secondary-color);
        color: var(--primary-color);
    }

    .form-actions .btn-cancel {
        background-color: var(--border-color);
        color: var(--primary-color);
    }

    .form-actions .btn-cancel:hover {
        background-color: #ddd;
    }

    .form-header {
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--border-color);
    }

    .form-header h2 {
        margin: 0;
        color: var(--primary-color);
    }

    .help-text {
        font-size: 12px;
        color: var(--text-light);
        margin-top: 4px;
    }
</style>

<div class="edit-form-container">
    <div class="form-header">
        <h2><i class="fas fa-edit"></i> Edit Profile</h2>
    </div>

    <form method="POST" action="<?= base_url('admin/update_profile'); ?>">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="<?= isset($user->name) ? $user->name : ''; ?>" required>
            <p class="help-text">Your full name as it appears in your profile</p>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="<?= isset($user->email) ? $user->email : ''; ?>" required>
            <p class="help-text">We'll use this email for account notifications</p>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">
                <i class="fas fa-save"></i> Save Changes
            </button>
            <a href="<?= base_url('admin/profile'); ?>" class="btn-cancel">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>